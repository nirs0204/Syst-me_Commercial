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
            $data['user'] = $_SESSION['user'];
            $this->viewer('/formulaire_demande_besoinachat', $data);

        }

        // Insersion des données de demande de besoin dans la BD
        public function storeDemandeBesoin() {

            $id_emp = $this->input->post('employe');
            $service = $this->input->post('departement');
            $item = $this->input->post('article');
            $quantite = $this->input->post('quantite');
            $raison = $this->input->post('raison');
            $etat = $this->input->post('etat');
            $date_expiration = $this->input->post('date');
            $priorite = $this->input->post('priorite');

            $this->MD_Besoin_Achat->createDemandeBesoin($id_emp, $service, $item, $quantite, $raison, $etat, $date_expiration, $priorite);

            redirect('CT_BesoinAchat/createDemandeBesoin');

        }

    }

?>