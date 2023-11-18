<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Article extends CI_Model {
    // CREATE
    function save($id_categorie, $nom, $type) {
        $sql = "insert into article (id_categorie,nom, type)  values ( %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_categorie),$this->db->escape($nom),$this->db->escape($type));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->oneAdmin($insert_id);
    }
    //SELECT
    function listAll(){
        $sql="select * from article";
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
        $this->db->where('id_article', $id);
        $query = $this->db->get('article'); 
        return $query->row(); 
    }
    //UPDATE
    public function update($id,$id_categorie, $nom, $type) {
        $sql = "update article set id_categorie = %s ,nom = %s , type = %s   where id_article =%s";
        $sql = sprintf($sql,$this->db->escape($id_categorie),$this->db->escape($nom),$this->db->escape($type),$this->db->escape($id));
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from article where id_article =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }


}
?>