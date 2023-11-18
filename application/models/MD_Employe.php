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