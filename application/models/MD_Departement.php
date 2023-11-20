<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class MD_Departement extends CI_Model {

        //SELECT
        public function list_Departements() {
            $this->db->select("*");
            $this->db->from('departement');
            $query = $this->db->get();
            return $query->result();
        }

    }
?>