<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Utilisateur extends CI_Model {
    // CREATE
    function save($id_employe, $pseudo, $mdp) {
        $sql = "insert into admin (id_employe, pseudo, mdp)  values ( %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_employe),$this->db->escape($pseudo),$this->db->escape($mdp));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->oneAdmin($insert_id);
    }
    //SELECT
    function listAll(){
        $sql="select * from utilisateur";
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
    public function update($id,$pseudo,$mdp){
        $sql = "update employe set pseudo = %s, mdp = %s  where id_employe =%s";
        $sql = sprintf($sql,$this->db->escape($pseudo),$this->db->escape($mdp),$this->db->escape($id));
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