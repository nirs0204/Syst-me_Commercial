<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Demande extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Demande_proforma');
        $this->load->library('session');

    }
    
	private function viewer($page, $data){
		$v = array(
			'page' => $page,
			'data' => $data
		);
		$this->load->view('template/basepage', $v);
	}	
    //VUE LOGIN
	public function index(){
        foreach ($_POST["frns"] as $value) {
           $this->MD_Demande_proforma->save( $value, $_POST['article'] , $_POST['qtt']);
        }
       redirect('CT_BesoinAchatFinal/get_Achat');
	}	
}
