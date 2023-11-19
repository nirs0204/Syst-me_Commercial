<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class MD_BesoinAchat extends CI_Model {

        // Insertion Besoin Achat
        public function insert_besoin_achat($data) {
            $this->db->insert('besoin_achat', $data);
            return $this->db->insert_id();
        }

        // Récupérer la liste de tous les demandes des besoins
        public function get_all_besoins_achat() {
            $query = $this->db->get('besoin_achat');
            return $query->result();
        }

        // Récupérer une demande de besoin
        public function get_besoin_achat_by_id($id) {
            $query = $this->db->get_where('besoin_achat', array('idbesoin_achat' => $id));
            return $query->row();
        }

        // Mettre à jour une demande de besoin
        public function update_besoin_achat($id, $data) {
            $this->db->where('idbesoin_achat', $id);
            $this->db->update('besoin_achat', $data);
        }

        // Supprimer une demande de besoin
        public function delete_besoin_achat($id) {
            $this->db->where('idbesoin_achat', $id);
            $this->db->delete('besoin_achat');
        }

    }
    
?>