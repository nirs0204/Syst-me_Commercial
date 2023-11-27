<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CT_FormCsv extends CI_Controller {

    public function __construct() {        
        parent::__construct();
        //$this->load->library('PhpSpreadsheet');
        //require_once APPPATH . 'third_party/PhpSpreadsheet/autoload.php';
    }

    private function viewer($page, $data){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']['id_fournisseur'];
            //$tab = $this->MD_Employe->get_admin($_SESSION['user']['id_fournisseur']);
           // $dept = $this->MD_Utilisateur->getAll_ByUser($_SESSION['user']['id_fournisseur']);
            $v = array(
                'page' => $page,
                'data' => $data
            );
            //$v['finance'] = $dept->id_poste;
           // $v['notify'] =  $this->MD_BesoinAchatFinal->notify_Shop(3);
            //$v['notifyr'] =  $this->MD_BesoinAchatFinal->notify_Resp(1,$dept->id_departement);
            //$v['isAllDirector']=$tab[0];
            //$v['isShopDirector']=$tab[1];
            $this->load->view('template/basepage', $v);

        }else{
            $v = array(
                'page' => $page,
                'data' => $data
            );
            $this->load->view('template/basepage', $v);
        }  
	}


    public function index() {
        $this->load->view('pages/creationProforma');
    }

    public function pass() {
        $data['nom_societe']= $this->input->post('nom_societe');
        $data['adresse_societe']= $this->input->post('adresse_societe');
        $data['telephone']= $this->input->post('telephone');
        $data['mail']= $this->input->post('mail');
        $data['ref_proforma']= $this->input->post('ref_proforma');
        $data['date_proforma']= $this->input->post('date_proforma');
        $data['nom_societe_demandeur']= $this->input->post('nom_societe_demandeur');
        $data['adresse_sd']= $this->input->post('adresse_sd');
        $data['telephone_sd']= $this->input->post('telephone_sd');
        $data['email_sd']= $this->input->post('email_sd');
        $data['description']= $this->input->post('description');
        $data['quantite']= $this->input->post('quantite');
        $data['prix_unitaire']= $this->input->post('prix_unitaire');
        $this->viewer('/set_pdf_proforma', $data);

    }

    public function save() {
        $fileName = 'proforma.xlsx'; 

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B2', 'Societe');
        $sheet->setCellValue('B3', 'Adresse');
        $sheet->setCellValue('B4', 'Telephone');
        $sheet->setCellValue('B5', 'Mail');
	    $sheet->setCellValue('E3', 'Ref_proforma');
        $sheet->setCellValue('E4', 'Date');   
        $sheet->setCellValue('B8', 'Client');   
        $sheet->setCellValue('B9', 'Adresse');   
        $sheet->setCellValue('B10', 'Telephone');   
        $sheet->setCellValue('B11', 'Email');   
        $sheet->setCellValue('C13', 'Description');   
        $sheet->setCellValue('D13', 'Quantite');   
        $sheet->setCellValue('E13', 'Prix Unitaire');   

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
        $sheet = setCellValue('C14', $this->request->post('description'));
        $sheet = setCellValue('D14', $this->request->post('quantite'));
        $sheet = setCellValue('E14', $this->request->post('prix_unitaire'));

        $writer = new Xlsx($spreadsheet);
		$writer->save("uploads/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/uploads/".$fileName); 
    }

}
?>