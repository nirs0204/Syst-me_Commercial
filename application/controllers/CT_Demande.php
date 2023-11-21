<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Demande extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Demande_proforma');
        $this->load->model('MD_Proforma');
        $this->load->model('MD_Besoin_achat');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->model('MD_Employe');
        $this->load->model('MD_Fournisseur');
        $this->load->model('MD_Article');
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
    //VUE 
	public function index() {
        $l = count($_POST["frns"]);
        if($l ==3){
            foreach ($_POST["frns"] as $value) {
                $this->MD_Demande_proforma->save( $value, $_POST['article'] , $_POST['qtt']);
              }
              $ba = $this->MD_Besoin_achat->list_idBesoin($_POST["article"],3);
      
              foreach ($ba as $value) { 
                  $this->MD_Besoin_achat->update_state($value->idbesoin_achat,6);
              }
             redirect('CT_BesoinAchatFinal/get_Achat');
        }else{
            $data['error'] = '3 fournisseur à cocher';
            redirect('CT_BesoinAchatFinal/send_Achat?error='.urlencode($data['error']).'&&article='.$_POST['article'] );
        }    
	}

    public function request_progress() {
        $data['demande'] = $this->MD_Demande_proforma->list_request_wait(0) ;
        $this->viewer('demande_proforma_envoyes',$data);
    }
    public function request_detail($date) {
        $data = array();
        $articles = $this->MD_Article->list_request(0, $date);
        $data['fpa'] = array();
        
        $data['date_actuel']=$date;
        foreach ($articles as $article) {
            $frns = $this->MD_Fournisseur->list_request_providers(0, $date, $article->id_article);
            $proforma = $this->MD_Proforma->list_by_article(0, $date, $article->id_article);
            $p = count($proforma);
        
            if ($p < 3) {
                $data['fpa'][$article->id_article]['button'] = "";
            } else {
                $data['fpa'][$article->id_article]['button'] = '<a href="' . site_url("CT_Proforma/") . '?qtt=' . $article->quantite . '&&article=' . $article->id_article . '&&date_demande=' . $date . '" class="btn btn-inverse-secondary btn-fw">Moins disant</a>';
            }
        
            // Ajouter le nom et la quantité de l'article au tableau $fpa
            $data['fpa'][$article->id_article]['id_article'] = $article->id_article;
            $data['fpa'][$article->id_article]['nom'] = $article->nom;
            $data['fpa'][$article->id_article]['quantite'] = $article->quantite;
            $data['fpa'][$article->id_article]['fournisseurs'] = $frns;
        }
        $data['date_actuel'] = $date;
        $this->viewer('detail_demande_envoyes', $data);         
    }

}
        
