<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Utilisateur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_Employe');
        $this->load->model('MD_BesoinAchatFinal');
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
        $data = array();
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
		$this->load->view('login',$data);
	}	
    //CONTROL LOGIN
    public function tosignIn(){
        $pseudo = $this->input->post('pseudo');
        $mdp = $this->input->post('mdp');
        $user = $this->MD_Utilisateur->verify($pseudo, $mdp);

        echo $pseudo; echo '<br>'; echo $mdp;
        echo $user['id_employe'];
        if ($user){
            $this->session->set_userdata('user', $user);
            redirect('CT_Utilisateur/welcome');
            return;
        }
        else{
            $data['error'] = 'pseudo ou mot de passe invalide';
        }
        redirect('CT_Utilisateur/index?error=' . urlencode($data['error']));
    }
    //ACCUEIL
    public function welcome(){
        $user = $_SESSION['user'];
        $data['user'] = $user;
        $this->viewer('/formulaire_demande_besoinachat', $data);
    }
    //DECONNEXION
    public function deconnect()	{
        $this->session->unset_userdata('user');
        redirect('CT_Utilisateur/');
    }
   
}
