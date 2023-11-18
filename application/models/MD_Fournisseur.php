<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Fournisseur extends CI_Model {
    // CREATE
    function save($id_categorie,$nom, $email, $contact, $adresse) {
        $sql = "insert into article (id_categorie,nom, email, contact, adresse)  values ( %s, %s, %s , %s , %s) ";
        $sql = sprintf($sql,$this->db->escape($id_categorie),$this->db->escape($nom),$this->db->escape($email),$this->db->escape($contact),$this->db->escape($adresse));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->oneAdmin($insert_id);
    }
    //SELECT
    function listAll(){
        $sql="select * from fournisseur";
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
        $this->db->where('id_fournisseur', $id);
        $query = $this->db->get('fournisseur'); 
        return $query->row(); 
    }
    //UPDATE
    public function update($id,$id_categorie,$nom, $email, $contact, $adresse) {
        $sql = "update fournisseur set id_categorie = %s ,nom = %s , email = %s, contact = %s, adresse = %s  where id_fournisseur = %s";
        $sql = sprintf($sql,$this->db->escape($id_categorie),$this->db->escape($nom),$this->db->escape($email),$this->db->escape($contact),$this->db->escape($adresse),$this->db->escape($type),$this->db->escape($id));
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from fournisseur where id_fournisseur =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }


}
?>