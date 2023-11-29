<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Proforma extends CI_Model {
    // CREATE
    function save($id_fournisseur,$id_article,$dd,$dp,$pu,$tva,$remise, $ttc,$stock ) {
        $sql = "insert into proforma(id_fournisseur, id_article,date_demande,date_proforma,pu, tva, remise, ttc,stock)  values ( %s, %s, %s,%s, %s, %s,%s, %s,%s) ";
        $sql = sprintf($sql,$this->db->escape($id_fournisseur),$this->db->escape($id_article),$this->db->escape($dd),$this->db->escape($dp),$this->db->escape($pu),$this->db->escape($tva),$this->db->escape($remise), $this->db->escape($ttc),$this->db->escape($stock));
        $this->db->query($sql);
        echo $this->db->last_query();

        $insert_id = $this->db->insert_id();
        return $this->listOne($insert_id);
    }

    function insert($id_proforma ,$qtt , $date , $article ) {
        $sql = "insert into proforma_final(id_proforma ,qtt, date_demande,id_article)  values ( %s,%s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_proforma),$this->db->escape($qtt),$this->db->escape($date),$this->db->escape($article));
        echo $this->db->last_query();
        echo $sql;
        $this->db->query($sql);

      }
    //SELECT
    function listAll(){
        $sql="select * from proforma";
        $req=$this->db->query($sql);
        $table=array();
        $i=0;
        foreach ($req->result() as $r){
            $table[$i]=$r;
            $i++;
        }
        return $table;
    }
    public function listOne($id) {
        $this->db->where('id_proforma', $id);
        $query = $this->db->get('proforma'); 
        return $query->row(); 
    }
    public function get_ttc($artcile,$date){
        $this->db->select('*');
        $this->db->from('proforma p');
        $this->db->where('p.id_article', $artcile);
        $this->db->where('p.date_demande', $date);
        $this->db->order_by('p.ttc', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
  public function get_moins_disant($article, $date, $qtt) {
    $proformas = $this->get_ttc($article, $date);

    foreach ($proformas as $proforma) {
        if ($proforma->stock >= $qtt) {
            $quantite_restante = $proforma->stock - $qtt;
            $this->insert($proforma->id_proforma, $qtt, $date, $article);
            $this->update($proforma->id_proforma, $quantite_restante);
            return;
        } elseif ($proforma->stock > 0) {
            $quantite_restante = -($proforma->stock - $qtt);
            $this->insert($proforma->id_proforma, $proforma->stock, $date, $article);
            $this->update($proforma->id_proforma, 0);
            $qtt -= $proforma->stock;
        }
        if ($qtt <= 0) {
            return;
        }
    }
    return "Insuffisance de stock pour votre commande, les autres commandes sont effectuées avec les quantités en stock de chaque fournisseur";
}

    public function getAllProforma(){
        $this->db->select('p.id_proforma,f.id_fournisseur,f.nom as nom_fournisseur, a.nom as nom_article, p.pu, p.tva, p.remise, p.stock');
        $this->db->from('proforma p');
        $this->db->join('fournisseur f', 'p.id_fournisseur = f.id_fournisseur');
        $this->db->join('article a', 'p.id_article = a.id_article');

        $query = $this->db->get();
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->id_fournisseur]['id_fournisseur'] = $row->id_fournisseur;
            $result[$row->id_fournisseur]['nom_fournisseur'] = $row->nom_fournisseur;
            $result[$row->id_fournisseur]['articles'][] = array(
                'nom_article' => $row->nom_article,
                'pu' => $row->pu,
                'tva' => $row->tva,
                'remise' => $row->remise,
                'stock' => $row->stock  
            );
        }

        return $result;
    }


     
    
    public function list_by_article($etat, $date_actuel, $id_article) {
        $subquery = $this->db->select('dp.id_fournisseur')
            ->from('demande_proforma dp')
            ->join('fournisseur f', 'dp.id_fournisseur = f.id_fournisseur')
            ->where('dp.etat', $etat)
            ->where('dp.date_actuel', $date_actuel)
            ->where('dp.id_article', $id_article)
            ->get_compiled_select();
    
        $this->db->select('*');
        $this->db->from('proforma p');
        $this->db->where("p.id_article",$id_article);
        $this->db->where("p.id_fournisseur IN ($subquery)", null, false);
    
        $query = $this->db->get();
        return $query->result();
    }      
    //UPDATE
    public function update($id,$stock) {
        $sql = "update proforma set stock = %s  where id_proforma =%s";
        $sql = sprintf($sql,$this->db->escape($stock),$this->db->escape($id));
        echo $this->db->last_query();
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from proforma where id_proforma =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }


    public function montantTTC($pu, $tva, $remise){
        $montantTVA = ($pu * $tva)/100;
        $montantTTC = $pu + $montantTVA;
        $montantRemise = ($montantTTC * $remise)/100;
        $montantTTCFinal = $montantTTC - $montantRemise;
        return $montantTTCFinal;
    }
}
?>