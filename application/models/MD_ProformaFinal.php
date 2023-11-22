<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_ProformaFinal extends CI_Model {
 // Modèle MD_ProformaFinal

public function getToTellLessByArticle($etat) {
    $this->db->select('f.id_fournisseur, f.nom AS nom_fournisseur, a.nom AS nom_article, p.pu, p.tva, p.remise, pf.qtt,((p.pu * pf.qtt * p.tva) /100 ) as ttl_tva,((p.pu * pf.qtt ) + ((p.pu * pf.qtt * p.tva) /100 ) ) as ttl_ttc');
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
        $result[$row->id_fournisseur]['id_fournisseur'] = $row->id_fournisseur;
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

    public function getcmd($etat,$id) {
        $this->db->select('f.id_fournisseur, f.nom AS nom_fournisseur, a.nom AS nom_article, p.pu, p.tva, p.remise, pf.qtt,((p.pu * pf.qtt * p.tva) /100 ) as ttl_tva,((p.pu * pf.qtt ) + ((p.pu * pf.qtt * p.tva) /100 ) ) as ttl_ttc');
        $this->db->from('proforma_final pf');
        $this->db->join('proforma p', 'pf.id_proforma = p.id_proforma');
        $this->db->join('demande_proforma dp', 'pf.id_article = p.id_article');
        $this->db->join('fournisseur f', 'p.id_fournisseur = f.id_fournisseur');
        $this->db->join('article a', 'pf.id_article = a.id_article');
        $this->db->where('dp.etat', $etat);
        $this->db->where('f.id_fournisseur', $id);
        $this->db->group_by('f.id_fournisseur, f.nom, a.nom, p.pu, p.tva, p.remise, pf.qtt');

        $query = $this->db->get();
        return $query->result();
    }

    public function somValeur ($id){
        $this->db->select('SUM(pu * qtt) as ht, SUM(ttl_tva) as tva, SUM(ttl_ttc) as ttc');
        $this->db->from('cmd');
        $this->db->where('id_fournisseur', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function numberToWords($number) {
        $formatter = new NumberFormatter('fr', NumberFormatter::SPELLOUT);
        $formatter->setTextAttribute(NumberFormatter::FRACTION_DIGITS, 2); // Définir le nombre de décimales à 2
        $words = $formatter->format($number);

        // Remplacer "virgule" par "virgule"
        $words = str_replace('virgule', 'virgule ', $words);

        return $words;
    }

}
?>