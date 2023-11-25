<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class CT_FormCsv extends CI_Controller {

        public function __construct() {        
            parent::__construct();
            $this->load->library('Excel');
        }

        public function index() {
            $this->load->view('pages/creationProforma');
        }

        public function save() {
            //$this->request->getPost();

            // Créer un nouvel objet PHPExcel
            $objPHPExcel = new PHPExcel();

            // Créer un nouvel objet worksheet
            $objWorksheet = $objPHPExcel->createSheet();

            // Ecrire les données du formulaire dans le  fichier excel
            $objWorksheet = setCellValue('C2', $this->request->getPost('nom_societe'));
            $objWorksheet = setCellValue('C3', $this->request->getPost('adresse_societe'));
            $objWorksheet = setCellValue('C4', $this->request->getPost('telephone'));
            $objWorksheet = setCellValue('C5', $this->request->getPost('mail'));
            $objWorksheet = setCellValue('F3', $this->request->getPost('ref_proforma'));
            $objWorksheet = setCellValue('F4', $this->request->getPost('date_proforma'));
            $objWorksheet = setCellValue('C8', $this->request->getPost('nom_societe_demandeur'));
            $objWorksheet = setCellValue('C9', $this->request->getPost('adresse_sd'));
            $objWorksheet = setCellValue('C10', $this->request->getPost('telephone_sd'));
            $objWorksheet = setCellValue('C11', $this->request->getPost('email_sd'));
            $objWorksheet = setCellValue('B7', $this->request->getPost('description'));
            $objWorksheet = setCellValue('C7', $this->request->getPost('quantite'));
            $objWorksheet = setCellValue('D7', $this->request->getPost('prix_unitaire'));

            // Sauvegarder le fichier excel
            $objWriter = PHPExcel_IOFactory::createWriter($objWorksheet, 'Excel');
            $objWriter->save('D:\Etudes\Projet_Perso\SiK\S5\Mr-Tovo\UwAmp\www\Syst-me_Commercial\uploads\proforma.xslsx');

            // Rediriger sur la page de confirmation
            return redirect()->to('pages/confirmation');
        }

    }

?>