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
        
        public function getMoinsDisant() {
            $this->db->select('ba.idbesoin_achat, e.nom as employe_nom, d.nom as departement_nom, a.nom as article_nom, ba.raison, ba.quantite, ba.date_limite');
            $this->db->from('besoin_achat ba');
            $this->db->join('employe e', 'e.id_employe = ba.id_employe');
            $this->db->join('poste p', 'p.id_poste = e.id_poste');
            $this->db->join('departement d', 'd.id_departement = p.id_departement');
            $this->db->join('article a', 'ba.id_article = a.id_article');
            $this->db->join('categorie c', 'a.id_categorie = c.id_categorie');
            $this->db->join('besoin_achat_final baf', 'ba.idbesoin_achat = baf.idbesoin_achat');
            $this->db->join('demande_proforma dp', 'a.id_article = dp.id_article', 'left');
            $this->db->where('dp.etat', 6);
            $this->db->where('dp.date_actuel', '2023-11-21');
            $this->db->where_in('ba.idbesoin_achat', 'baf.idbesoin_achat');
            $this->db->group_by('ba.idbesoin_achat, e.nom, d.nom, a.nom, ba.raison, ba.quantite, ba.date_limite');

            $query = $this->db->get();
            $result = $query->result();
        }

        /**
         * CRUD
         */
        //UPDATE
        public function update_state($id,$state) {
            $sql = "update besoin_achat set etat = %s  where idbesoin_achat =%s";
            $sql = sprintf($sql,$this->db->escape($state),$this->db->escape($id));
            $this->db->query($sql);
        }
        
        // CREATE demande besoin
        public function createDemandeBesoin($id_emp, $id_item, $id_service, $quantite, $raison, $etat, $date_expiration, $priorite) {

            $sql = "INSERT INTO besoin_achat (id_employe, id_departement, id_article, quantite, raison, etat, date_limite, priorite) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)";
            $sql = sprintf( $sql, $this->db->escape($id_emp), $this->db->escape($id_service), $this->db->escape($id_item), $this->db->escape($quantite), $this->db->escape($raison), $this->db->escape($etat), $this->db->escape($date_expiration), $this->db->escape($priorite) );
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
        // Décomposition des demandes de besoin achat
        public function decomposition_demande_besoin_achat($date){
            $this->db->select('ba.idbesoin_achat, e.nom as employe_nom, d.nom as departement_nom, a.nom as article_nom, ba.raison, ba.quantite, ba.date_limite');
            $this->db->from('besoin_achat ba');
            $this->db->join('employe e', 'e.id_employe = ba.id_employe');
            $this->db->join('poste p', 'p.id_poste = e.id_poste');
            $this->db->join('departement d', 'd.id_departement = p.id_departement');
            $this->db->join('article a', 'ba.id_article = a.id_article');
            $this->db->join('categorie c', 'a.id_categorie = c.id_categorie');
            $this->db->join('besoin_achat_final baf', 'ba.idbesoin_achat = baf.idbesoin_achat');
            $this->db->join('demande_proforma dp', 'a.id_article = dp.id_article', 'left');
            $this->db->where('dp.date_actuel', $date);
            $this->db->where("ba.idbesoin_achat IN (SELECT idbesoin_achat FROM besoin_achat_final)", null, false); // Utilisez null, false pour éviter l'échappement
            
            $this->db->group_by('ba.idbesoin_achat, e.nom, d.nom, a.nom, ba.raison, ba.quantite, ba.date_limite');
            
            $query = $this->db->get();
            return $query->result();
        }
        

    }
?>