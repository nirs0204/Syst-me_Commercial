<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Email extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('email');
        $this->load->library('upload');
        $this->load->library('email'); // Assurez-vous d'avoir cette ligne pour charger la bibliothèque d'email
    }
    
    
    public function index(){
        $this->load->view('pages/test_email');
    }

    public function upload_fichier() {
        date_default_timezone_set('Indian/Antananarivo'); 
        // Configurer les paramètres d'upload
        $config['upload_path'] = 'C:/Z-ITU/uploads/';
        $config['allowed_types'] = 'csv';
        $this->upload->initialize($config);
    
        // Vérifier si le fichier a été correctement téléchargé
        if ($this->upload->do_upload('fichier')) {
            // Récupérer les informations sur le fichier téléchargé
            $fichier_info = $this->upload->data();
    
            // Charger la bibliothèque d'email ici si ce n'est pas déjà fait dans le constructeur
            // $this->load->library('email');
    
            // Configurer les paramètres de l'email
            $this->email->from('kotodevon@gmail.com', 'test24projetLol');
            $this->email->to('ravmihary@gmail.com');
            $this->email->subject('Sujet de l\'email');
            $this->email->message('Corps de l\'email.');
    
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
