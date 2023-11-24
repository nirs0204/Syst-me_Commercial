<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Utilisateur extends CI_Model {
    // CREATE
    function save($id_employe, $pseudo, $mdp) {
        $sql = "insert into utilisateur (id_employe, pseudo, mdp)  values ( %s, %s, %s) ";
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
        $query = $this->db->get('utilisateur'); 
        return $query->row(); 
    }
    //UPDATE
    public function update($id,$pseudo,$mdp){
        $sql = "update utilisateur set pseudo = %s, mdp = %s  where id_employe =%s";
        $sql = sprintf($sql,$this->db->escape($pseudo),$this->db->escape($mdp),$this->db->escape($id));
        $this->db->query($sql);
    }
    //DELETE
    public function delete($id){
        $sql = "delete from utilisateur where id_employe =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }
    //LOGIN
    function verify($pseudo, $mdp) {
        $query = $this->db->get_where('utilisateur', array('pseudo' => $pseudo, 'mdp' => $mdp));
        $client = $query->row_array();
        return $client;
    }

    public function getIdDeptByUser($id_utilisateur) {
        $this->db->select('d.id_departement');
        $this->db->from('utilisateur u');
        $this->db->join('employe e', 'u.id_employe = e.id_employe');
        $this->db->join('poste p', 'e.id_poste = p.id_poste');
        $this->db->join('departement d', 'p.id_departement = d.id_departement');
        $this->db->where('u.id_utilisateur', $id_utilisateur);

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result->id_departement;
        } else {
            return null;
        }
    }
    public function getAll_ByUser($id_utilisateur) {
        $this->db->select('d.id_departement,p.id_poste');
        $this->db->from('utilisateur u');
        $this->db->join('employe e', 'u.id_employe = e.id_employe');
        $this->db->join('poste p', 'e.id_poste = p.id_poste');
        $this->db->join('departement d', 'p.id_departement = d.id_departement');
        $this->db->where('u.id_utilisateur', $id_utilisateur);

        $query = $this->db->get();
        return $query->row();


    }

}
?>