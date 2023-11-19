<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class CT_BesoinAchat extends CI_Controller {
        
        public function __construct() {

            parent::__construct();
            $this->load->model('MD_Article');
            $this->load->model('MD_Employe');
            $this->load->model('MD_Departement');
            $this->load->model('MD_Utilisateur');
            
        }

        private function viewer($page, $data) {
            
            $v = array(
                'page' => $page,
                'data' => $data
            );
            $this->load->view('template/basepage', $v);

        }

        // Formulaire de demande de besoin
        public function create() {

            $user = $_SESSION['user'];
            $data['article'] = $this->MD_Article->listAll();
            $data['departement'] = $this->MD_Departement->list_Departements();
            redirect('CT_BesoinAchat/formulaire_demande_besoinachat', $data);

        }

    }

?>