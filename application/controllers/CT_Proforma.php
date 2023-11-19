<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Proforma extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Demande_proforma');
        $this->load->model('MD_Proforma');
        $this->load->model('MD_Fournisseur');
        $this->load->library('session');

    }
    
	private function viewer($page, $data){
		$v = array(
			'page' => $page,
			'data' => $data
		);
		$this->load->view('template/basepage', $v);
	}	
    //VUE PROFORMA
	public function index(){
      
	}	
    
}
