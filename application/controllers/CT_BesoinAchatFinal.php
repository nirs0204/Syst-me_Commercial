<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_BesoinAchatFinal extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Employe');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_BesoinAchatFinal');
        // $this->load->helper('main_helper');
        $this->load->library('session');

    }

	private function viewer($page, $data){
		$v = array(
			'page' => $page,
			'data' => $data
		);
		$this->load->view('template/basepage', $v);
	}

	public function index(){
		$this->load->view('welcome_message');
		
	}	
  
    // Responsable
	public function listAllBesoinAchatParResp(){
		$user = $_SESSION['user'];
        $idDept = $this->MD_Utilisateur->getIdDeptByUser($user['id_utilisateur']);
        $data['besoinAchat'] = $this->MD_BesoinAchatFinal->getAllNeedBuyByDeptByStatus($idDept, 1);
		$this->viewer('/listeBesoinAchatResp', $data);
	}		

    public function approuvedBesoinAchat(){
        $idBesoinAchat = $this->input->get('idbesoinachat');
        $this->MD_BesoinAchatFinal->updateStatusNeedBuy($idBesoinAchat, 3);
        redirect('CT_BesoinAchatFinal/listAllBesoinAchatParResp');
    }

    public function rejectedBesoinAchat(){
        $idBesoinAchat = $this->input->get('idbesoinachat');
        $this->MD_BesoinAchatFinal->updateStatusNeedBuy($idBesoinAchat, 5);
        redirect('CT_BesoinAchatFinal/listAllBesoinAchatParResp');
    }

    // Service Achat
    public function listAllBesoinAchatParServiceAchat(){
        $user = $_SESSION['user'];
        $data['besoinAchat'] = $this->MD_BesoinAchatFinal->getAllNeedBuyNotFinalized();
		$this->viewer('/listeBesoinAchatServiceAchat', $data);
    }

    public function besoinAchatApprouve(){

    }

    public function besoinAchatRejete(){

    }
}
