<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_ProformaFinal extends CI_Model {
 // Modèle MD_ProformaFinal

public function getToTellLessByArticle($etat) {
    $this->db->select('f.id_fournisseur, f.nom AS nom_fournisseur, a.nom AS nom_article, p.pu, p.tva, p.remise, pf.qtt');
    $this->db->from('proforma_final pf');
    $this->db->join('proforma p', 'pf.id_proforma = p.id_proforma');
    $this->db->join('demande_proforma dp', 'pf.id_article = p.id_article');
    $this->db->join('fournisseur f', 'p.id_fournisseur = f.id_fournisseur');
    $this->db->join('article a', 'pf.id_article = a.id_article');
    $this->db->where('dp.etat', $etat);
    $this->db->group_by('f.id_fournisseur, f.nom, a.nom, p.pu, p.tva, p.remise, pf.qtt');

    $query = $this->db->get();
    
    // Organiser les résultats par fournisseur
    $result = array();
    foreach ($query->result() as $row) {
        $result[$row->id_fournisseur]['nom_fournisseur'] = $row->nom_fournisseur;
        $result[$row->id_fournisseur]['articles'][] = array(
            'nom_article' => $row->nom_article,
            'pu' => $row->pu,
            'tva' => $row->tva,
            'remise' => $row->remise,
            'qtt' => $row->qtt
        );
    }

    return $result;
}

}
?>