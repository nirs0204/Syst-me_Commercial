<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Fournisseur extends CI_Controller {
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

        $this->load->helper('form');
        $this->load->helper('email');
        $this->load->library('upload');
        $this->load->library('email');

    }
    private function viewer($page, $data){
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['user']['id_fournisseur'];
            $tab = $this->MD_Employe->get_admin($_SESSION['user']['id_fournisseur']);
            $dept = $this->MD_Utilisateur->getAll_ByUser($_SESSION['user']['id_fournisseur']);
            $v = array(
                'page' => $page,
                'data' => $data
            );
            //$v['finance'] = $dept->id_poste;
            $v['notify'] =  $this->MD_BesoinAchatFinal->notify_Shop(3);
            //$v['notifyr'] =  $this->MD_BesoinAchatFinal->notify_Resp(1,$dept->id_departement);
            $v['isAllDirector']=$tab[0];
            $v['isShopDirector']=$tab[1];
            $this->load->view('template/basepage_frns', $v);

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
		$this->load->view('login_frns',$data);
	}	
    //CONTROL LOGIN
    public function tosignIn(){
        $pseudo = $this->input->post('pseudo');
        $mdp = $this->input->post('mdp');
        $user = $this->MD_Fournisseur->verify($pseudo, $mdp);

        echo $pseudo; echo '<br>'; echo $mdp;
        echo $user['id_fournisseur'];
        if ($user){
            $this->session->set_userdata('user', $user);
            redirect('CT_Fournisseur/welcome');
            return;
        }
        else{
            $data['error'] = 'pseudo ou mot de passe invalide';
        }
        redirect('CT_Fournisseur/index?error=' . urlencode($data['error']));
    }
    //ACCUEIL
    public function welcome(){
        $user = $_SESSION['user'];
        $data['user'] = $user;
        $this->viewer('/fournisseur_form', $data);
    }
    public function demande(){
        $user = $_SESSION['user'];
        $data['user'] = $user;
        $data['demande'] = $this->MD_Fournisseur->getDemande(0);
        $this->viewer('/demande', $data);
    }
    //DECONNEXION
    public function deconnect()	{
        $this->session->unset_userdata('user');
        redirect('CT_Fournisseur/');
    }
    //
    
    public function upload_fichier() {
        date_default_timezone_set('Indian/Antananarivo'); 
        // Configurer les paramètres d'upload
        $config['upload_path'] = 'C:\Syst-me_Commercial\uploads';
        $config['allowed_types'] = '*';
        $this->upload->initialize($config);
    
        // Vérifier si le fichier a été correctement téléchargé
        if ($this->upload->do_upload('fichier')) {
            // Récupérer les informations sur le fichier téléchargé
            $fichier_info = $this->upload->data();
    
            // Charger la bibliothèque d'email ici si ce n'est pas déjà fait dans le constructeur
            // $this->load->library('email');
    
            // Configurer les paramètres de l'email
            $this->email->from('kotodevon@gmail.com', 'Proforma de Fournisseurssss');
            $this->email->to('ravmihary@gmail.com');
            $this->email->subject($_POST['titre']);
            $this->email->message($_POST['objet']);
    
            // Joindre le fichier
            $this->email->attach($fichier_info['full_path']);
    
            // Envoyer l'email
            if ($this->email->send()) {
                echo 'Email envoyé avec succès avec le fichier joint.';
            } else {
                show_error($this->email->print_debugger());
            }
        } else {
            // Afficher les erreurs d'upload s'il y en a
            echo $this->upload->display_errors();
        }
    }

}