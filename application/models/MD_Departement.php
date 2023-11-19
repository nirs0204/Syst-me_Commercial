<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class MD_Departement extends CI_Model {
        //SELECT
        public function list_Departements() {

            $this->db->select("*");
            $this->db->from('besoin_achat ba');
            $this->db->join('besoin_achat_final baf', 'ba.idbesoin_achat = baf.idbesoin_achat');
            $this->db->where('ba.id_article', $id);
            $this->db->where('ba.etat', $val);
            $this->db->where('baf.date_finale', 'CURRENT_DATE',  false); 
            $query = $this->db->get();
            return $query->result();
        }  

    }
?>