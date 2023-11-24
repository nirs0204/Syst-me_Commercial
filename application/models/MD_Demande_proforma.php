<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Demande_proforma extends CI_Model {
    // CREATE
    function save($id_fournisseur,$id_article, $qtt) {
        $sql = "insert into demande_proforma (id_fournisseur,id_article, quantite)  values ( %s, %s, %s ) ";
        $sql = sprintf($sql,$this->db->escape($id_fournisseur),$this->db->escape($id_article),$this->db->escape($qtt));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->listOne($insert_id);
    }
    //SELECT
    function listAll(){
        $sql="select * from demande_proforma";
        $req=$this->db->query($sql);
        $table=array();
        $i=0;
        foreach ($req->result() as $r){
            $table[$i]=$r;
            $i++;
        }
        return $table;
    }
    public function list_request_wait($state) {
        $this->db->select("dp.date_actuel");
        $this->db->from('demande_proforma dp');
        $this->db->where('dp.etat', $state);
        $this->db->group_by('dp.date_actuel');
        $query = $this->db->get();
        return $query->result();
    }
    public function list_request() {
        $this->db->select("dp.date_actuel");
        $this->db->from('demande_proforma dp');
        $this->db->group_by('dp.date_actuel');
        $query = $this->db->get();
        return $query->result();
    }
    public function listOne($id) {
        $this->db->where('id_demande', $id);
        $query = $this->db->get('demande_proforma'); 
        return $query->row(); 
    }
    //UPDATE
    public function update($date,$qtt,$art,$etat) {
        $sql = "update demande_proforma set etat= %s  where date_actuel = %s and id_article= %s and quantite = %s";
        $sql = sprintf($sql,$this->db->escape($etat),$this->db->escape($date),$this->db->escape($art),$this->db->escape($qtt));
        echo $this->db->last_query();
        $this->db->query($sql);
    }
    public function update_bd($date,$frns,$art,$etat) {
        $sql = "update demande_proforma set etat= %s  where date_actuel = %s and id_article= %s and id_fournisseur = %s";
        $sql = sprintf($sql,$this->db->escape($etat),$this->db->escape($date),$this->db->escape($art),$this->db->escape($frns));
        echo $this->db->last_query();
        $this->db->query($sql);
    }
  
    //DELETE
    public function delete($id){
        $sql = "delete from demande_proforma where id_fournisseur =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }


}
?>