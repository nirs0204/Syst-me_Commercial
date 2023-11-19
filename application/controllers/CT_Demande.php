<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Demande extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Demande_proforma');
        $this->load->model('MD_Besoin_achat');
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
        $ba = $this->MD_Besoin_achat->list_idBesoin($_POST["article"],3);

        foreach ($ba as $value) { 
            $this->MD_Besoin_achat->update_state($value->idbesoin_achat,6);
        }
       redirect('CT_BesoinAchatFinal/get_Achat');
	}	
}
