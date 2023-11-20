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
            echo $this->db->last_query();
            return $query->result();
        }  

        /**
         * CRUD
         */
        //UPDATE
        public function update_state($id,$state) {
            $sql = "update besoin_achat set etat = %s  where idbesoin_achat =%s";
            $sql = sprintf($sql,$this->db->escape($state),$this->db->escape($id));
            echo $this->db->last_query();
            $this->db->query($sql);
        }
        
        // CREATE demande besoin
        public function createDemandeBesoin( $id_item, $quantite, $raison, $date_expiration, $priorite) {

            $sql = "INSERT INTO besoin_achat (id_article, quantite, raison, date_limite, priorite) VALUES (%s, %s, %s, %s, %s)";
            $sql = sprintf( $sql, $this->db->escape($id_item), $this->db->escape($quantite), $this->db->escape($raison), $this->db->escape($date_expiration), $this->db->escape($priorite) );
            $this->db->query($sql);

        }

        // DELETE demande besoin
        public function deleteDemandeBesoin($id) {

            $sql = "DELETE FROM besoin_achat WHERE idbesoin_achat=%s";
            $sql = sprintf( $sql, $this->db->escape($id) );
            $this->db->query($sql);

        }

        // UPDATE demande besoin
        public function updateDemandeBesoin($id_item, $quantite, $raison, $date_expi, $priorite, $id_besoin) {

            $sql = "UPDATE besoin_achat SET id_article=%s, quantite=%s, raison=%s, date_limite=%s, priorite=%s WHERE idbesoin_achat=%s";
            $sql = sprintf( $sql, $this->db->escape($id_item), $this->db->escape($quantite), $this->db->escape($raison), $this->db->escape($date_expi), $this->db->escape($priorite), $this->db->escape($id_besoin) );
            $this->db->query($sql);

        }

    }
?>