<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Proforma extends CI_Model {
    // CREATE
    function save($id_demande,$id_fournisseur,$id_article,$pu,$ht,$tva,$remise ) {
        $sql = "insert into proforma (id_demande,id_fournisseur,id_article,pu,ht,tva,remise )  values ( %s, %s, %s, %s,%s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($id_demande),$this->db->escape($id_fournisseur),$this->db->escape($id_article),$this->db->escape($pu),$this->db->escape($ht),$this->db->escape($tva),,$this->db->escape($remise));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->oneAdmin($insert_id);
    }
    //SELECT
    function listAll(){
        $sql="select * from proforma";
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
        $this->db->where('id_proforma', $id);
        $query = $this->db->get('proforma'); 
        return $query->row(); 
    }
    //UPDATE
    public function update($id,$pseudo,$mdp){
        $sql = "update proforma set id_demande =%s,id_fournisseur =%s,id_article =%s,pu =%s,ht =%s,tva =%s,remise =%s  where id_proforma =%s";
        $sql = sprintf($sql,$this->db->escape($id_demande),$this->db->escape($id_fournisseur),$this->db->escape($id_article),$this->db->escape($pu),$this->db->escape($ht),$this->db->escape($tva),,$this->db->escape($remise),$this->db->escape($id));
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from proforma where id_proforma =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }s
}
?>