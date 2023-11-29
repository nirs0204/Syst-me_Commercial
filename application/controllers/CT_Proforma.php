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
        $this->load->model('MD_Demande_proforma');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->library('session');
        $this->load->model('MD_Employe');
        if($this->session->userdata('user') === null) 
		{
			redirect('CT_Utilisateur/index?error=' . urlencode('Vous n`êtes pas connectée!'));
		}
    }
    private function viewer($page, $data){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']['id_employe'];
            $tab = $this->MD_Employe->get_admin(  $_SESSION['user']['id_employe']);
            $dept = $this->MD_Utilisateur->getAll_ByUser($_SESSION['user']['id_utilisateur']);
            $v = array(
                'page' => $page,
                'data' => $data
            );
            $v['finance'] = $dept->id_poste;
            $v['notify'] =  $this->MD_BesoinAchatFinal->notify_Shop(3);
            $v['notifyr'] =  $this->MD_BesoinAchatFinal->notify_Resp(1,$dept->id_departement);
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
      $this->MD_Demande_proforma->update($date,$qtt,$article,6);
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
    
    public function listProforma(){
        $data['listBC'] = $this->MD_Proforma->getAllProforma();
        $this->viewer('/listeProforma', $data);
    }
}
