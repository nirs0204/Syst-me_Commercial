<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Besoin_achat extends CI_Model {
    //SELECT
    public function list_idBesoin($id, $val) {
        $this->db->select("ba.idbesoin_achat");
        $this->db->from('besoin_achat ba');
        $this->db->join('besoin_achat_final baf', 'ba.idbesoin_achat = baf.idbesoin_achat');
        $this->db->where('ba.id_article', $id);
        $this->db->where('ba.etat', $val);
        $this->db->where('baf.date_finale', 'CURRENT_DATE',  false); 
        $query = $this->db->get();
        return $query->result();
    }  

    //UPDATE
    public function update_state($id,$state) {
        $sql = "update besoin_achat set etat = %s  where idbesoin_achat =%s";
        $sql = sprintf($sql,$this->db->escape($state),$this->db->escape($id));
        $this->db->query($sql);
    }
}
?>