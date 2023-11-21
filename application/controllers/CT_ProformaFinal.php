<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_ProformaFinal extends CI_Controller {
    public function __construct() {

        parent::__construct();
        $this->load->model('MD_Article');
        $this->load->model('MD_Besoin_Achat');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->model('MD_Employe');
        $this->load->model('MD_Departement');
        $this->load->model('MD_Utilisateur');
        
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

    public function listBonCommande(){
        
    }
}
?>