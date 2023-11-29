<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Fournisseur extends CI_Model {
    // CREATE
    function save($id_categorie,$nom, $email, $contact, $adresse) {
        $sql = "insert into fournisseur (id_categorie,nom, email, contact, adresse)  values ( %s, %s, %s , %s , %s) ";
        $sql = sprintf($sql,$this->db->escape($id_categorie),$this->db->escape($nom),$this->db->escape($email),$this->db->escape($contact),$this->db->escape($adresse));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->oneAdmin($insert_id);
    }
    //SELECT
    function listAll(){
        $sql="select * from fournisseur";
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
        $this->db->where('id_fournisseur', $id);
        $query = $this->db->get('fournisseur'); 
        return $query->row(); 
    }
    public function list_with_category($id) {
        $subquery = $this->db->select('id_categorie')
                             ->from('get_achat')
                             ->where('id_article', $id)
                             ->get_compiled_select();
    
        $this->db->where_in('id_categorie', $subquery, false);
        $query = $this->db->get('fournisseur'); 
        return $query->result();  
    }
    public function list_request_providers($state, $date, $art) {
        $this->db->select("dp.id_fournisseur, f.nom, f.email");
        $this->db->from('demande_proforma dp');
        $this->db->join('fournisseur f', 'dp.id_fournisseur = f.id_fournisseur');
        $this->db->where('dp.etat', $state);
        $this->db->where('dp.date_actuel', $date);
        $this->db->where('dp.id_article', $art);
        $query = $this->db->get();
        return $query->result();
    }
    function getDemande($state,$id){
        $this->db->select('dp.id_article, a.nom, dp.quantite, dp.date_actuel');
        $this->db->from('demande_proforma dp');
        $this->db->join('article a', 'a.id_article = dp.id_article');
        $this->db->where('dp.etat', $state);
        $this->db->where('dp.id_fournisseur', $id);
        $this->db->group_by('dp.id_article, a.nom, dp.quantite, dp.date_actuel');
        $query = $this->db->get();
        return $query->result();
    }
    //UPDATE
    public function update($id,$id_categorie,$nom, $email, $contact, $adresse) {
        $sql = "update fournisseur set id_categorie = %s ,nom = %s , email = %s, contact = %s, adresse = %s  where id_fournisseur = %s";
        $sql = sprintf($sql,$this->db->escape($id_categorie),$this->db->escape($nom),$this->db->escape($email),$this->db->escape($contact),$this->db->escape($adresse),$this->db->escape($type),$this->db->escape($id));
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from fournisseur where id_fournisseur =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }

    function verify($nom, $mdp) {
        $query = $this->db->get_where('fournisseur', array('nom' => $nom, 'mdp' => $mdp));
        $client = $query->row_array();
        return $client;
    }

}
?>