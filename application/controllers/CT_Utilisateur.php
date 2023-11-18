<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Utilisateur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MD_Utilisateur');
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
            $this->session->set_userdata('user', $users);
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
        $this->viewer('/index',array());
    }
}
