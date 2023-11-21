<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_ProformaFinal extends CI_Controller {
    public function __construct() {

        parent::__construct();
        $this->load->model('MD_ProformaFinal');
        $this->load->model('MD_Employe');
        // $this->load->model('MD_Article');
        // $this->load->model('MD_Fournisseur');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->library('session');
        
    }

    private function viewer($page, $data){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']['id_employe'];
            $tab = $this->MD_Employe->get_admin(  $_SESSION['user']['id_employe']);
            $dept = $this->MD_Utilisateur->getIdDeptByUser($_SESSION['user']['id_utilisateur']);
            $v = array(
                'page' => $page,
                'data' => $data
            );
            $v['notify'] =  $this->MD_BesoinAchatFinal->notify_Shop(3);
            $v['notifyr'] =  $this->MD_BesoinAchatFinal->notify_Resp(1,$dept);

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
        $data['listBC'] = $this->MD_ProformaFinal->getToTellLessByArticle(6);
        $this->viewer('/listeMDArticleFrns', $data);
    }

    public function listBonCommande2(){
        $listmd = $this->MD_ProformaFinal->getToTellLessByArticle(6);
        $data['listBC'] = array();
        foreach ($listmd as $besoin) {
            $fournisseurNom = $besoin->nom_fournisseur;
            if (!isset($data['listBC'][$fournisseurNom])) {
                $data['listBC'][$fournisseurNom] = array();
            }
            $data['listBC'][$fournisseurNom][] = array(
                'nom_article' => $besoin->nom_article,
                'pu' => $besoin->pu,
                'tva' => $besoin->tva,
                'remise' => $besoin->remise,
                'qtt' => $besoin->qtt
            );
        }
        $this->viewer('/listeMDArticleFrns', $data);
    }
}
?>