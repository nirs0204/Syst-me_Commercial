<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Utilisateur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MDC_Utilisateur');
        $this->load->helper('main_helper');
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
		$this->load->view('login');
	}	
    public function tosignIn(){
        $pseudo = $this->input->post('pseudo');
        $mdp = $this->input->post('mdp');

        echo $pseudo; echo '<br>'; echo $mdp;
    }

}
