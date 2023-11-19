<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class CT_BesoinAchat extends CI_Controller {
        
        public function __construct() {

            parent::__construct();
            $this->load->model('MD_Article');
            $this->load->model('MD_Employe');
            $this->load->model('MD_Utilisateur');
            
        }

    }

?>