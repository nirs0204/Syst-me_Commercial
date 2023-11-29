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
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_Article');
        $this->load->library('session');
        if($this->session->userdata('user') === null) 
		{
			redirect('CT_Utilisateur/index?error=' . urlencode('Vous n`êtes pas connectée!'));
		}

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
        $csv = '';
        
        $data['date_actuel']=$date;
        foreach ($articles as $article) {
            $frns = $this->MD_Fournisseur->list_request_providers(0, $date, $article->id_article);
            $proforma = $this->MD_Proforma->list_by_article(0,$date, $article->id_article);
            $p = count($proforma);
        
            if ($p < 3) {
                $data['fpa'][$article->id_article]['button'] = "";
                $data['fpa'][$article->id_article]['upload'] = $csv;
            } else {
                $data['fpa'][$article->id_article]['upload'] = "";
                $data['fpa'][$article->id_article]['button'] = '<a href="' . site_url("CT_Proforma/") . '?qtt=' . $article->quantite . '&&article=' . $article->id_article . '&&date_demande=' . $date . '" class="btn btn-inverse-secondary btn-fw">Moins disant</a>';
            }
            $data['fpa'][$article->id_article]['id_article'] = $article->id_article;
            $data['fpa'][$article->id_article]['nom'] = $article->nom;
            $data['fpa'][$article->id_article]['quantite'] = $article->quantite;
            $data['fpa'][$article->id_article]['fournisseurs'] = $frns;
        }
        $data['date_actuel'] = $date;
        $this->viewer('detail_demande_envoyes', $data);         
    }
    public function toImport(){
        $date_actuel = $this->input->get('date');
        if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $upload_directory = 'C:/Syst-me_Commercial/proforma/';
            $file_name = basename($_FILES['file']['name']);
            $target_path = $upload_directory . $file_name;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                $csv_content = file_get_contents($target_path);
                redirect('CT_Demande/insertCSV/'.$_FILES['file']['name'].'/'.$date_actuel);
            } else {
                echo 'Erreur';
            }
        } else {
            echo 'Aucun fichier à importer ou erreur lors du téléchargement.';
        }
    }
    public function insertCSV($filename,$date) {
        $file_path = 'C:/Syst-me_Commercial/proforma/' . $filename;
        if (($handle = fopen($file_path, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $id_fournisseur = $data[0];
                $id_article = $data[1];
                $date_demande = $data[2];
                $pu = $data[3];
                $tva = $data[4];
                $remise = $data[5];
                $ttc = $data[6];
                $stock = $data[7];
                $this->MD_Proforma->save($id_fournisseur, $id_article,$date, $date_demande, $pu, $tva, $remise, $ttc, $stock);
            }

            fclose($handle);
            redirect('CT_Demande/request_detail/'.$date);
        } else {
            echo 'Erreur lors de l\'ouverture du fichier CSV.';
        }
    }
    

}
        
