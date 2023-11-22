<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf.php');


class Bon extends FPDF {
    function Header()
    {
        // A propos de la societe
        $this->Cell(10);
        $this->SetFont('Arial','B',20);
        $this->Cell(10,5,'Bon de commande',0,0,'L');
        $this->Ln(15);
        $this->SetFont('Arial','B',11);
        $this->Cell(10);
        $this->Cell(10,5,'Nom de notre societe',0,0,'L');
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(10);
        $this->Cell(10,5,'Company Celestial',0,0,'L');
        $this->Ln(25);
    }

    function detailBonCommande1($date, $idcommande, $modepaiement, $delailivraison, $conditionpaiemnet, $nomFournisseur, $contactFournisseur, $emailFournisseur, $respFournisseur){
        // Bon de commande
        $this->SetFont('Arial','',10);
        $this->Cell(10);
        $this->Cell(10,5,'Date : ',0,0,'L');
        $this->Cell(30);
        $this->Cell(10,5,$date,0,0,'L');
        // Fournisseur
        $this->SetFont('Arial','B',11);
        $this->Cell(60);
        $this->Cell(10,5,'Fournisseur',0,0,'L');
        // Bon de commande
        $this->Ln(5);
        $this->Cell(10);
        $this->SetFont('Arial','',10);
        $this->Cell(10,5,'Bon de commande N° : ',0,0,'L');
        $this->Cell(30);
        $this->Cell(10,5,$idcommande,0,0,'L');
        // Fournisseur
        $this->Cell(60);
        $this->Cell(10,5,'Nom : ',0,0,'L');
        $this->Cell(15);
        $this->Cell(10,5,$nomFournisseur,0,0,'L');
        // Bon de commande
        $this->Ln(5);
        $this->Cell(10);
        $this->Cell(10,5,'Mode de paiement : ',0,0,'L');
        $this->Cell(30);
        $this->Cell(10,5,$modepaiement,0,0,'L');
        // Fournisseur
        $this->Cell(60);
        $this->Cell(10,5,'Contact : ',0,0,'L');
        $this->Cell(15);
        $this->Cell(10,5,$contactFournisseur,0,0,'L');
        // Bon de commande
        $this->Ln(5);
        $this->Cell(10);
        $this->Cell(10,5,'Delai de livraison : ',0,0,'L');
        $this->Cell(30);
        $this->Cell(10,5,$delailivraison,0,0,'L');
        // Fournisseur
        $this->Cell(60);
        $this->Cell(10,5,'Email : ',0,0,'L');
        $this->Cell(15);
        $this->Cell(10,5,$emailFournisseur,0,0,'L');
        // Bon de commande
        $this->Ln(5);
        $this->Cell(10);
        $this->Cell(10,5,'Condition de paiement : ',0,0,'L');
        $this->Cell(30);
        $this->Cell(10,5,$conditionpaiemnet,0,0,'L');
        // Fournisseur
        $this->Cell(60);
        $this->Cell(10,5,'Responsable : ',0,0,'L');
        $this->Cell(15);
        $this->Cell(10,5,$respFournisseur,0,0,'L');

        $this->Ln(15);
    }

    // Tableau
    function tableau($header, $data)
    {
        // Largeurs des colonnes
        $w = array(55, 30, 15, 30, 30, 30);
        // En-t�te
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        // Donn�es
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row->nom_article,'LR',0,'L',$fill);
            $this->Cell($w[1],6,number_format($row->pu,0,',',' '),'LR',0,'R',$fill);
            $this->Cell($w[2],6,number_format($row->qtt,0,',',' '),'LR',0,'R',$fill);
            $this->Cell($w[3],6,number_format($row->tva,0,',',' '),'LR',0,'R',$fill);
            $this->Cell($w[4],6,number_format($row->ttl_tva,0,',',' '),'LR',0,'R',$fill);
            $this->Cell($w[5],6,number_format($row->ttl_ttc,0,',',' '),'LR',0,'R',$fill);
            $this->Ln();
        }
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(5);
    }

    function montantTotal($ht, $tva, $ttc, $ttcLettre)
    {
        $this->SetFont('Arial','',10);
        $this->Cell(139);
        $this->Cell(10,5,"Total HT : ",0,0,'L');
        $this->Cell(15);
        $this->Cell(10,5,$ht,0,0,'L');
        $this->Ln(5);
        $this->Cell(137);
        $this->Cell(10,5,"Total TVA : ",0,0,'L');
        $this->Cell(17);
        $this->Cell(10,5,$tva,0,0,'L');
        $this->Ln(5);
        $this->Cell(137);
        $this->Cell(10,5,"Total TTC : ",0,0,'L');
        $this->Cell(17);
        $this->Cell(10,5,$ttc,0,0,'L');
        $this->Ln(10);
        $this->SetFont('Arial','I',10);
        $this->Cell(10,5,"Arretee le pris en bon de commande a la somme de $ttcLettre",0,0,'L');
        $this->Ln(20);
        
        $this->SetFont('Arial','I',10);
        $this->Cell(20);
        $this->Cell(10,5,'Notre societe',0,0,'L');
        $this->Cell(120);
        $this->Cell(10,5,'Fournisseur',0,0,'L');
    }
}

// $pdf = new PDF();
//$header = array('Designation', 'Unite', 'PU HT', 'Quantite', '% TVA', 'Total TVA', 'Total TTC');
// $data = array();
// $ht = 6789;
// $tva = 647;
// $ttc = 9365;
// $ttcLettre = 'vingt million';
// $pdf->AddPage();
// $pdf->detailBonCommande1('2023-10-23', '123', 'Cheque', '30 jours', 'Paiement dans 60 jours', 'Super U', '020 23 456 78', 'email@example.com', 'Rakoto');
// $pdf->tableau($header,$data);
// $pdf->montantTotal($ht, $tva, $ttc, $ttcLettre);
// $pdf->Output();
?>