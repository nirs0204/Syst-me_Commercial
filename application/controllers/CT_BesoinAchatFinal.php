<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_BesoinAchatFinal extends CI_Controller {

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
	public function hello(){
		$_SESSION['hello'] = "Hola!";
		$this->viewer('/index',array());
	}		
}
