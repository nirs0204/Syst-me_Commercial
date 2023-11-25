<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class CT_FormCsv extends CI_Controller {

        public function index() {
            $this->load->view('pages/creation_Proforma');
        }

        public function save() {
            $this->request->getPost();

            // Créer un nouvel objet PHPExcel
            $objPHPExcel = new PHPExcel();

            // Créer un nouvel objet worksheet
            $objWorksheet = $objPHPExcel->createSheet();

            // Ecrire les données du formulaire dans le  fichier excel
            $objWorksheet = setCellValue();
            $objWorksheet = setCellValue();

            // Sauvegarder le fichier excel
            $objWriter = PHPExcel_IOFactory::createWriter($objWorksheet, 'Excel2021');
            $objWriter->save('proforma.csv');

            // Rediriger sur la page de confirmation
            return redirect()->to('pages/confirmation');
        }

    }

?>