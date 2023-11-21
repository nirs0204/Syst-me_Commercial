<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_ProformaFinal extends CI_Model {
    public function getToTellLessByArticle($etat){
        $this->db->select('f.nom AS nom_fournisseur, a.nom AS nom_article, p.pu, p.tva, p.remise, pf.qtt');
        $this->db->from('proforma_final pf');
        $this->db->join('proforma p', 'pf.id_proforma = p.id_proforma');
        $this->db->join('demande_proforma dp', 'pf.id_article = p.id_article');
        $this->db->join('fournisseur f', 'p.id_fournisseur = f.id_fournisseur');
        $this->db->join('article a', 'pf.id_article = a.id_article');
        $this->db->where('dp.etat', $etat);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); 
        }
    }
}
?>