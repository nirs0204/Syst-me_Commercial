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
        $this->load->library('MD_Employe');

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
      
	}	
    
}
