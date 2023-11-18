<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_BesoinAchatFinal extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Employe');
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
		$_SESSION['hello'] = "Hola!";

		$this->viewer('/listeBesoinAchatResp',array());
	}		

    public function approuvedBesoinAchat(){

    }

    public function rejectedBesoinAchat(){

    }

    // Service Achat
    public function listAllBesoinAchatParServiceAchat(){
        $_SESSION['hello'] = "Hola!";

		$this->viewer('/listeBesoinAchatServiceAchat',array());
    }

    public function besoinAchatApprouve(){

    }

    public function besoinAchatRejete(){

    }
}
