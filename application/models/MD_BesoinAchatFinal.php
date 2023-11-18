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

    // Mise à jour de l'état de besoin_achat
    public function updateStatusNeedBuy($id_besoin_achat, $etat){
        $sql = "update besoin_achat set etat = %s  where idbesoin_achat = %s";
        $sql = sprintf($sql,$this->db->escape($etat),$this->db->escape($id_besoin_achat));
        $this->db->query($sql);
    }

    // Liste de besoin_achat non finalisé 
    public function getAllNeedBuyNotClosed(){
        $this->db->select('ba.*');
        $this->db->from('besoin_achat ba');
        $this->db->join('besoin_achat_final baf', 'ba.idbesoin_achat = baf.idbesoin_achat', 'left');
        $this->db->where('baf.idbesoin_achat_final IS NULL');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }

    // Insertion de besoin_achat_final
    public function saveNeedBuy($id_besoin_achat, $id_employe, $date_finale){
        $sql = "insert into besoin_achat_final(idbesoin_achat, id_employe, date_finale) values ( %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_besoin_achat),$this->db->escape($id_employe),$this->db->escape($date_finale));
        $this->db->query($sql);
    }

    // Liste de besoin_achat_final
    public function getAllNeedBuy(){
        $this->db->select('*');
        $this->db->from('besoin_achat');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }
}
