<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CT_FormCsv extends CI_Controller {

    public function __construct() {        
        parent::__construct();
        //$this->load->library('PhpSpreadsheet');
        //require_once APPPATH . 'third_party/PhpSpreadsheet/autoload.php';
    }

    public function index() {
        $this->load->view('pages/creationProforma');
    }

    public function save() {
        $this->load->helper('url');

        // Create a new PhpSpreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Create a new worksheet
        $sheet = $spreadsheet->getActiveSheet();

        // Write form data to the Excel file
        $sheet->setCellValue('C2', $this->input->post('nom_societe'));
        $sheet->setCellValue('C3', $this->input->post('adresse_societe'));
        $sheet = setCellValue('C4', $this->request->post('telephone'));
        $sheet = setCellValue('C5', $this->request->post('mail'));
        $sheet = setCellValue('F3', $this->request->post('ref_proforma'));
        $sheet = setCellValue('F4', $this->request->post('date_proforma'));
        $sheet = setCellValue('C8', $this->request->post('nom_societe_demandeur'));
        $sheet = setCellValue('C9', $this->request->post('adresse_sd'));
        $sheet = setCellValue('C10', $this->request->post('telephone_sd'));
        $sheet = setCellValue('C11', $this->request->post('email_sd'));
        $sheet = setCellValue('B7', $this->request->post('description'));
        $sheet = setCellValue('C7', $this->request->post('quantite'));
        $sheet = setCellValue('D7', $this->request->post('prix_unitaire'));

        // Save the Excel file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('D:\Etudes\Projet_Perso\SiK\S5\Mr-Tovo\UwAmp\www\Syst-me_Commercial\uploads\proforma.xlsx');

        // Redirect to the confirmation page
        redirect('pages/confirmation');
    }

}
?>