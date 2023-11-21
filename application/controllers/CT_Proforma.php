<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Proforma extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Proforma');
        $this->load->model('MD_Employe');
        $this->load->model('MD_Article');
        $this->load->model('MD_Fournisseur');
        $this->load->library('session');
        $this->load->model('MD_Employe');

    }
    
	private function viewer($page, $data){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']['id_employe'];
            $tab = $this->MD_Employe->get_admin( $userId);
            $v = array(
                'page' => $page,
                'data' => $data
            );
            $v['isAllDirector']=$tab[0];
            $v['isShopDirector']=$tab[1];
            $this->load->view('template/basepage', $v);

        }else{
            $v = array(
                'page' => $page,
                'data' => $data
            );
            $this->load->view('template/basepage', $v);
        }  
	}		
    //VUE PROFORMA
	public function index(){
      $date = $_GET['date_demande'];
      $qtt = $_GET['qtt'];
      $article = $_GET['article'];
      $data['error'] = $this->MD_Proforma->get_moins_disant($article, $date, $qtt);
      $this->MD_Demande_proforma->update($date,$qtt,$article,2);
      $data['date_actuel'] = $date;
      redirect('CT_Demande/request_detail/'.$date);
	}	
      

    
    public function proformaForm(){
        $data['articleList'] = $this->MD_Article->listAll();
        $data['fournisseurList'] = $this->MD_Fournisseur->listAll();
        $this->viewer('/proforma_form',$data);
    }

    public function proformaSubmit(){
        $id_article = $this->input->post('article');
        $id_fournisseur = $this->input->post('fournisseur');
        $demande = $this->input->post('date');
        $pu = $this->input->post('pu');
        $tva = $this->input->post('tva');
        $remise = $this->input->post('remise');
        $stock = $this->input->post('stock');
        $ttc = $this->MD_Proforma->montantTTC($pu, $tva, $remise);
        $sql = $this->MD_Proforma->save($id_fournisseur, $id_article, $demande, $pu, $tva, $remise, $ttc, $stock);
        redirect('CT_Proforma/proformaForm');
    }
    
    
}
