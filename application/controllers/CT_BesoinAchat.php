<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class CT_BesoinAchat extends CI_Controller {

        public function __construct() {

            parent::__construct();
            $this->load->model('MD_BesoinAchat');
            $this->load->model('MD_Article');
            $this->load->model('MD_Employe');

        }

        // Affiche tous les besoins d'achat
        public function index() {
            $data['besoins_achat'] = $this->MD_BesoinAchat->get_all_besoins_achat();
            $this->load->view('besoin_achat/index', $data);
        }

        // Affiche le formulaire d'ajout de besoin
        public function create() {
            // Affichez ici le formulaire d'ajout
        }

        // Traitement du formulaire de demande de besoin d'achat
        public function store() {
            $data = array(
                // Récupérez les données du formulaire et assignez-les ici
            );
    
            $this->MD_BesoinAchat->insert_besoin_achat($data);
            redirect('besoinachat/index');
        }

        // Affiche le formulaire de màj
        public function edit($id) {
            $data['besoin_achat'] = $this->MD_BesoinAchat->get_besoin_achat_by_id($id);
            // Affichez ici le formulaire de mise à jour avec les données récupérées
        }

        // Traitement du formulaire de màj
        public function update($id) {
            $data = array(
                // Récupérez les données du formulaire de mise à jour et assignez-les ici
            );
    
            $this->MD_BesoinAchat->update_besoin_achat($id, $data);
            redirect('besoinachat/index');
        }

        // Supprimer une demande de besoin
        public function delete($id) {
            $this->MD_BesoinAchat->delete_besoin_achat($id);
            redirect('besoinachat/index');
        }

    }

?>