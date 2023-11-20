<?php 
require('../fpdf.php');

class PDF extends FPDF {
    function Header()
    {
        // A propos de la societe
        $this->SetFont('Arial','B',18);
        $this->Cell(65);
        $this->Cell(10,5,'FICHE DE POSTE',0,0,'L');
        $this->Ln(25);
    }

    function ajouterEmp($service, $lieu, $temps, $horaire, $mission, $moyen, $suphierarchique, $subordonne, $date)
    {
        // A propos du client
        $this->SetFont('Arial','B',14);
        $this->Cell(10);
        $this->Cell(10,5,"Intitule du poste");
        $this->Ln(10);

        $this->SetFont('Arial','',12);
        $this->Cell(10);
        $this->Cell(10,5,"Service : $service",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Lieu de travail : $lieu",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Temps de travail : $temps",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Horaire de travail : $horaire",0,0,'L');
        $this->Ln(15);

        $this->SetFont('Arial','B',14);
        $this->Cell(10);
        $this->Cell(10,5,"Missions du poste");
        $this->Ln(10);

        $this->SetFont('Arial','',12);
        $this->Cell(10);
        $this->Cell(10,5,"Mission principale : $mission",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Moyens mis a disposition : $moyen",0,0,'L');
        $this->Ln(15);

        $this->SetFont('Arial','B',14);
        $this->Cell(10);
        $this->Cell(10,5,"Positionnement hierarchique");
        $this->Ln(10);

        $this->SetFont('Arial','',12);
        $this->Cell(10);
        $this->Cell(10,5,"Superieur hierarchique : $suphierarchique",0,0,'L');
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(10,5,"Subordonnee : $subordonne",0,0,'L');
        $this->Ln(20);

        $this->Cell(10);
        $this->Cell(10,5,"Date de creation : $date",0,0,'L');

    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->ajouterEmp('', '', '', '', '', '', '', '', '');
$pdf->Output();
?>4