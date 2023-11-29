<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_BesoinAchatFinal extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Employe');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->model('MD_Article');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_Fournisseur');
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
	public function index(){
		$this->load->view('welcome_message');
		
	}	
  
    // Responsable
	public function listAllBesoinAchatParResp(){
		$user = $_SESSION['user'];
        $idDept = $this->MD_Utilisateur->getIdDeptByUser($user['id_utilisateur']);
        $data['besoinAchat'] = $this->MD_BesoinAchatFinal->getAllNeedBuyByDeptByStatus($idDept, 1);
		$this->viewer('/listeBesoinAchatResp', $data);
	}		

    public function approuvedBesoinAchat(){
        $idBesoinAchat = $this->input->get('idbesoinachat');
        $this->MD_BesoinAchatFinal->updateStatusNeedBuy($idBesoinAchat, 3);
        redirect('CT_BesoinAchatFinal/listAllBesoinAchatParResp');
    }

    public function rejectedBesoinAchat(){
        $idBesoinAchat = $this->input->get('idbesoinachat');
        $this->MD_BesoinAchatFinal->updateStatusNeedBuy($idBesoinAchat, 5);
        redirect('CT_BesoinAchatFinal/listAllBesoinAchatParResp');
    }

    // Service Achat
    public function listAllBesoinAchatParServiceAchat(){
        $user = $_SESSION['user'];
        $data['besoinAchat'] = $this->MD_BesoinAchatFinal->getAllNeedBuyNotFinalized(3);
		$this->viewer('/listeBesoinAchatServiceAchat', $data);
    }

    public function besoinAchatApprouve(){
        $user = $_SESSION['user'];
        $idBesoinAchat = $this->input->get('idbesoinachat');
        $this->MD_BesoinAchatFinal->saveNeedBuyFinal($idBesoinAchat, $user['id_employe']);
        redirect('CT_BesoinAchatFinal/listAllBesoinAchatParServiceAchat');
    }

    public function besoinAchatRejete(){
        $idBesoinAchat = $this->input->get('idbesoinachat');
        $this->MD_BesoinAchatFinal->updateStatusNeedBuy($idBesoinAchat, 5);
        redirect('CT_BesoinAchatFinal/listAllBesoinAchatParServiceAchat');
    }
    //After purchase validation
    public function get_Achat(){
        $data['achat'] = $this->MD_Article->listAchat();
        $this->viewer('/choix_Fournisseur',$data);
    }
    public function send_Achat(){
        $data = array();
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
        $id = $_GET['article'];
        $data['article'] = $this->MD_Article->listAchat_article($id);
        $data['fournisseur'] = $this->MD_Fournisseur->list_with_category($id);
        $this->viewer('/envoi_Fournisseur',$data);
    }
}
