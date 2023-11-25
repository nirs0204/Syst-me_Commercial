<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_ProformaFinal extends CI_Model {
 // Modèle MD_ProformaFinal

    public function getToTellLessByArticle($etat) {
            $this->db->select('*');
            $this->db->from('cmd');
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

    public function getcmd($id) {
        $this->db->select('id_fournisseur, nom_fournisseur,id_article,id_final, nom_article, pu, tva, remise, qtt ,ttl_tva, ttl_ttc,date_actuel');
        $this->db->from('cmd');
        $this->db->where('id_fournisseur', $id);
        $this->db->group_by('id_fournisseur, nom_fournisseur,id_article,id_final, nom_article, pu, tva, remise, qtt ,ttl_tva, ttl_ttc,date_actuel');

        $query = $this->db->get();
        return $query->result();
    }
    public function getcmd2() {
        $this->db->select(' f.id_fournisseur,a.id_article,
        pf.id_final,
        f.nom AS nom_fournisseur,
        a.nom AS nom_article,
        dp.date_actuel,
        p.pu,
        p.tva,
        p.remise,
        pf.qtt,
        ((p.pu * pf.qtt * p.tva) / 100) AS ttl_tva,
        ((p.pu * pf.qtt) + ((p.pu * pf.qtt * p.tva) / 100)) AS ttl_ttc');

    $this->db->from('proforma_final pf');
    $this->db->join('proforma p', 'pf.id_proforma = p.id_proforma');
    $this->db->join('fournisseur f', 'f.id_fournisseur =  p.id_fournisseur');
    $this->db->join('article a', 'a.id_article =  pf.id_article');
    $this->db->join('demande_proforma dp', 'p.id_fournisseur = dp.id_fournisseur AND p.id_article = dp.id_article');
    
    $this->db->where('dp.etat', 6);

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
        $formatter->setTextAttribute(NumberFormatter::FRACTION_DIGITS, 2);
        $words = $formatter->format($number);
        $words = str_replace('virgule', 'virgule ', $words);

        return $words;
    }

    public function generate_cmd($date,$frns){
        date_default_timezone_set('Indian/Antananarivo'); 
        $timestamp = strtotime($date);
        $j = date('d', $timestamp);
        $m = date('m', $timestamp);
        $a = date('Y', $timestamp);
        $cmd = 'BC'.$frns.'-'.$j.$m.$a;
        return $cmd;
    }

}
?>