<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Employe extends CI_Model {
    // CREATE
    function save($id_poste,$id_manager,$nom,$prenom,$adresse,$contact) {
        $sql = "insert into employe (id_poste, id_manager, nom, prenom, adresse, contact)  values ( %s, %s, %s,%s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_poste),$this->db->escape($id_manager),$this->db->escape($nom),$this->db->escape($prenom),$this->db->escape($contact),$this->db->escape($adresse));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->oneAdmin($insert_id);
    }
    //SELECT
    function listAll(){
        $sql="select * from employe";
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
        $this->db->where('id_employe', $id);
        $query = $this->db->get('employe'); 
        return $query->row(); 
    }
    public function getAll_director() {

        $sql = "SELECT e.id_employe, d.id_departement, p.id_poste
                FROM employe e
                JOIN poste p ON p.id_poste = e.id_poste
                JOIN departement d ON p.id_departement = d.id_departement
                WHERE e.id_poste IN (
                    SELECT r.id_poste FROM responsable r
                    JOIN departement d ON r.id_departement = d.id_departement
                    JOIN poste p ON p.id_poste = r.id_poste
                    WHERE p.id_poste NOT IN (6)
                )";
    
        $query = $this->db->query($sql);
        return $query->result();
    }  
    public function getShop_director($departementId) {
        $this->db->select('e.id_employe, d.id_departement, p.id_poste');
        $this->db->from('responsable r');
        $this->db->join('departement d', 'r.id_departement = d.id_departement');
        $this->db->join('poste p', 'p.id_poste = r.id_poste');
        $this->db->join('employe e', 'e.id_poste = p.id_poste');
        $this->db->where('d.id_departement', $departementId);

        $query = $this->db->get();
        return $query->result();
    }
    public function isUserDirector($directors, $userId) {
        foreach ($directors as $director) {
            if ($director->id_employe == $userId) {
                return 1;
            }
        }
        return 0;
    }
    public function get_admin( $userId){
        $allDirectors = $this->MD_Employe->getAll_director();
        $shopDirectors = $this->MD_Employe->getShop_director(5);
        $isAllDirector = $this->MD_Employe->isUserDirector($allDirectors, $userId);
        $isShopDirector = $this->MD_Employe->isUserDirector($shopDirectors, $userId);
        $tab[0] = $isAllDirector;
        $tab[1] = $isShopDirector;
        return $tab;
    }
    //UPDATE
    public function update($id,$id_poste,$id_manager,$nom,$prenom,$adresse,$contact){
        $sql = "update employe set id_poste = %s, id_manager = %s, nom = %s, prenom = %s, adresse = %s, contact= %s  where id_employe =%s";
        $sql = sprintf($sql,$this->db->escape($id_poste),$this->db->escape($id_manager),$this->db->escape($nom),$this->db->escape($prenom),$this->db->escape($contact),$this->db->escape($adresse),$this->db->escape($id));
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from employe where id_employe =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }

}
?>