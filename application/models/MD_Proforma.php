<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Proforma extends CI_Model {
    // CREATE
    function save($id_fournisseur,$id_article,$dd,$pu,$tva,$remise, $ttc,$stock ) {
        $sql = "insert into proforma(id_fournisseur, id_article,date_demande ,date_proforma,pu, tva, remise, ttc,stock)  values ( %s, %s, %s, current_date, %s, %s,%s, %s,%s) ";
        $sql = sprintf($sql,$this->db->escape($id_fournisseur),$this->db->escape($id_article),$this->db->escape($dd),$this->db->escape($pu),$this->db->escape($tva),$this->db->escape($remise), $this->db->escape($ttc),$this->db->escape($stock));
        $this->db->query($sql);

        $insert_id = $this->db->insert_id();
        return $this->listOne($insert_id);
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
    public function update($id_fournisseur,$id_article,$dd,$dp,$pu,$tva,$remise, $ttc,$stock) {
        $sql = "update proforma set id_demande =%s,id_fournisseur =%s,id_article =%s,date_demande=%s ,date_proforma=%s,pu =%s,tva =%s,remise =%s,ttc = %s,stock=%s  where id_proforma =%s";
        $sql = sprintf($sql,$this->db->escape($id_fournisseur),$this->db->escape($id_article),$this->db->escape($dd),$this->db->escape($dp),$this->db->escape($pu),$this->db->escape($tva),$this->db->escape($remise),$this->db->escape($ttc),$this->db->escape($stock),$this->db->escape($id));
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from proforma where id_proforma =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }

    public function montantTTC($pu, $tva, $remise){
        $montantTVA = ($pu * $tva)/100;
        $montantTTC = $pu + $montantTVA;
        $montantRemise = ($montantTTC * $remise)/100;
        $montantTTCFinal = $montantTTC - $montantRemise;
        return $montantTTCFinal;
    }
}
?>