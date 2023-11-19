<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Demande extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Demande_proforma');
        $this->load->model('MD_Besoin_achat');
        $this->load->model('MD_Fournisseur');
        $this->load->model('MD_Article');
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
    //VUE 
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
    public function request_progress() {
        $data['demande'] = $this->MD_Demande_proforma->list_request_wait(0) ;
        $this->viewer('demande_proforma_envoyes',$data);
    }
    public function request_detail() {
        echo $_GET['date_actuel'];
        $data = array();
        $articles = $this->MD_Article->list_request(0, $_GET['date_actuel']);
        $data['fpa'] = array();
    
        foreach ($articles as $article) {
            $frns = $this->MD_Fournisseur->list_request_providers(0, $_GET['date_actuel'], $article->id_article);
            
            // Ajouter le nom et la quantité de l'article au tableau $fpa
            $data['fpa'][$article->id_article]['nom'] = $article->nom;
            $data['fpa'][$article->id_article]['quantite'] = $article->quantite;
            $data['fpa'][$article->id_article]['fournisseurs'] = $frns;
        }
    
       
        $this->viewer('detail_demande_envoyes', $data);   
    }
}
        
