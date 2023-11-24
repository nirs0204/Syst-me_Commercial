<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Valid_cmd extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_ProformaFinal');
        $this->load->model('MD_Employe');
         $this->load->model('MD_Article');
         $this->load->model('MD_Fournisseur');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->model('MD_Demande_proforma');
        $this->load->library('session');

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
    //VUE LOGIN
	public function index(){
        $data['invalid'] =  $this->MD_ProformaFinal->getcmd2(6);
        $this->viewer('/valid_bon_cmd',$data);
    }
    public function valid(){
        $this->MD_Demande_proforma->update_bd($_GET['date'],$_GET['frns'],$_GET['article'],8);
        redirect('CT_Valid_cmd/');
    }
    public function invalid(){
        $this->MD_Demande_proforma->update_bd($_GET['date'],$_GET['frns'],$_GET['article'],10);
        redirect('CT_Valid_cmd/');
    }
   
}
