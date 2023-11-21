<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_BesoinAchatFinal extends CI_Model {
    // Liste de besoin_achat par état
    public function getAllNeedBuyByStatus($etat){
        $this->db->select('*');
        $this->db->from('besoin_achat');
        $this->db->where('etat', $etat);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }

    // Liste de besoin_achat par état par département
    public function getAllNeedBuyByDeptByStatus($id_dept, $etat){
        $this->db->select('
            ba.idbesoin_achat,
            e.nom AS nom_employe,
            a.nom AS nom_article,
            ba.id_departement,
            ba.quantite,
            ba.raison,
            ba.etat,
            ba.date_limite,
            ba.priorite
        ');
        $this->db->from('besoin_achat ba');
        $this->db->join('employe e', 'ba.id_employe = e.id_employe');
        $this->db->join('article a', 'ba.id_article = a.id_article');
        $this->db->where('ba.id_departement', $id_dept);
        $this->db->where('ba.etat', $etat);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }
    public function notify_Resp($etat,$id_dept){
        $this->db->select('COUNT(*) as total');
        $this->db->from('besoin_achat ba');
        $this->db->join('employe e', 'ba.id_employe = e.id_employe');
        $this->db->join('article a', 'ba.id_article = a.id_article');
        $this->db->join('departement d', 'ba.id_departement = d.id_departement');
        $this->db->where('d.id_departement',$id_dept);
        $this->db->where('ba.etat', $etat);

        $query = $this->db->get();
        $result = $query->row();

        $total = $result->total;
        return $total;
    }
    public function notify_Shop($etat){
        $this->db->select('COUNT(*) as total');
        $this->db->from('besoin_achat ba');
        $this->db->join('employe e', 'ba.id_employe = e.id_employe');
        $this->db->join('article a', 'ba.id_article = a.id_article');
        $this->db->join('departement d', 'ba.id_departement = d.id_departement');
        $this->db->join('besoin_achat_final baf', 'ba.idbesoin_achat = baf.idbesoin_achat', 'left');
        $this->db->where('baf.id_besoin_achat_final IS NULL', null, false); // Utilisation du troisième paramètre de where pour éviter l'auto-échappement
        $this->db->where('ba.etat', $etat);

        $query = $this->db->get();
        $result = $query->row();

        $total = $result->total;
        return $total;
    }

    // Mise à jour de l'état de besoin_achat
    public function updateStatusNeedBuy($id_besoin_achat, $etat){
        $sql = "update besoin_achat set etat = %s  where idbesoin_achat = %s";
        $sql = sprintf($sql,$this->db->escape($etat),$this->db->escape($id_besoin_achat));
        $this->db->query($sql);
    }

    // Liste de besoin_achat non finalisé 
    public function getAllNeedBuyNotFinalized($etat){
        $this->db->select('
            ba.idbesoin_achat,
            e.nom AS nom_employe,
            a.nom AS nom_article,
            d.nom AS nom_departement,
            ba.quantite,
            ba.raison,
            ba.etat,
            ba.date_limite,
            ba.priorite
        ');
        $this->db->from('besoin_achat ba');
        $this->db->join('besoin_achat_final baf', 'ba.idbesoin_achat = baf.idbesoin_achat', 'left');
        $this->db->join('employe e', 'ba.id_employe = e.id_employe');
        $this->db->join('article a', 'ba.id_article = a.id_article');
        $this->db->join('departement d', 'ba.id_departement = d.id_departement');
        $this->db->where('ba.etat', $etat);
        $this->db->where('baf.id_besoin_achat_final IS NULL');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }

    // Insertion de besoin_achat_final
    public function saveNeedBuyFinal($id_besoin_achat, $id_employe){
        $sql = "insert into besoin_achat_final(idbesoin_achat, id_employe, date_finale) values ( %s, %s, current_date) ";
        $sql = sprintf($sql,$this->db->escape($id_besoin_achat),$this->db->escape($id_employe));
        $this->db->query($sql);
    }

    // Liste de besoin_achat_final
    public function getAllNeedBuyFinal(){
        $this->db->select('*');
        $this->db->from('besoin_achat_final');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }
}
