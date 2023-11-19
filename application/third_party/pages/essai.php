<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf.php');

class Essai extends FPDF {
    function Header()
    {
        // A propos de la societe
        $this->SetFont('Arial','B',18);
        $this->Cell(65);
        $this->Cell(10,5,'CONTRAT ESSAI',0,0,'L');
        $this->Ln(25);
    }

    function ajouterEmp($nmatricule, $nom, $prenom, $dtn, $ln, $smatri, $adresse, $tel, $pere, $mere, $salaire, $debut, $fin, $lieu, $creation)
    {
        // A propos du client
        $this->SetFont('Arial','',12);
        $this->Cell(10);
        $this->Cell(10,5,"Numero matricule : $nmatricule",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Nom et prenoms : $nom $prenom",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Date et lieu de naissance : $dtn a $ln",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Situation matrimoniale : $smatri",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Adresse : $adresse",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Contact : $tel",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Pere : $pere",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Mere : $mere",0,0,'L');

        $this->Ln(25);
        $this->Cell(10);
        $this->Cell(10,5,"Salaire : $salaire",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Debut de l'essai : $debut",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Fin de l'essai : $fin",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Lieu de travail : $lieu",0,0,'L');
        $this->Ln(30);
        
        $this->Cell(100);
        $this->Cell(10,5,"Tape le $creation a Antananarivo",0,0,'L');
        $this->Ln(20);

        $this->Cell(150);
        $this->Cell(10,5,"Signature",0,0,'L');
        $this->Ln(10);

    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->ajouterEmp('No002092e8781', 'Nom ', 'Prenom', '10 Juin 2002', 'Madagascar', 'Celibataire', 'Ambalavao', '0348902873', 'mdkncwdir', 'hdbhwgiqwwi', '202000', '02 fev 2023', '05 mmai 2023', 'Antsirabe', '23 oct 2022');
$pdf->Output();
?>4