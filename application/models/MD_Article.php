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
    public function list_with_category($c) {
        $this->db->select("*");
        $this->db->from('article  a');
        $this->db->join('categorie c', 'a.id_categorie = c.id_categorie');
        $this->db->where('a.id_categorie', $c);
        $query = $this->db->get();
        return $query->result();  
    }
    //ARTICLE DEMANDE PROFORMA
    public function list_request($state, $date) {
    $this->db->select("dp.id_article, a.nom, dp.quantite");
    $this->db->from('demande_proforma dp');
    $this->db->join('article a', 'dp.id_article = a.id_article');
    $this->db->where('dp.etat', $state);
    $this->db->where('dp.date_actuel', $date); 
    $this->db->group_by('dp.id_article, a.nom, dp.quantite');
    $query = $this->db->get();
    return $query->result();
    }
    public function list_detail($date) {
        $this->db->select("dp.id_article, a.nom, dp.quantite");
        $this->db->from('demande_proforma dp');
        $this->db->join('article a', 'dp.id_article = a.id_article');
        $this->db->where('dp.date_actuel', $date); 
        $this->db->group_by('dp.id_article, a.nom, dp.quantite');
        $query = $this->db->get();
        return $query->result();
    }

    //ACHAT
    public function listAchat_article($id) {
        $this->db->where('id_article', $id);
        $query = $this->db->get('get_achat'); 
        return $query->row_array(); 
    }
    public function listAchat() {
        $this->db->select("*");
        $this->db->from('get_achat');
        $query = $this->db->get();
        return $query->result(); 
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