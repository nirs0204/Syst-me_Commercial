<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class CT_BesoinAchat extends CI_Controller {
        
        public function __construct() {

            parent::__construct();
            $this->load->model('MD_Article');
            $this->load->model('MD_Besoin_Achat');
            $this->load->model('MD_Utilisateur');
            $this->load->model('MD_BesoinAchatFinal');
            $this->load->model('MD_Employe');
            $this->load->model('MD_Departement');
            $this->load->model('MD_Utilisateur');
            
        }
        private function viewer($page, $data){
            if(isset($_SESSION['user'])){
                $userId = $_SESSION['user']['id_employe'];
                $tab = $this->MD_Employe->get_admin(  $_SESSION['user']['id_employe']);
                $dept = $this->MD_Utilisateur->getIdDeptByUser($_SESSION['user']['id_utilisateur']);
                $v = array(
                    'page' => $page,
                    'data' => $data
                );
                $v['notify'] =  $this->MD_BesoinAchatFinal->notify_Shop(3);
                $v['notifyr'] =  $this->MD_BesoinAchatFinal->notify_Resp(1,$dept);
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
        // Formulaire de demande de besoin
        public function create() {

            $employe = $_SESSION['user']['id_utilisateur'];
            $data['article'] = $this->MD_Article->listAll();
            $dept = $this->MD_Utilisateur->getIdDeptByUser($employe);
    
            $this->viewer('/formulaire_demande_besoinachat', $data);

        }

        // Insertion des données de demande de besoin dans la BD
        public function storeDemandeBesoin() {

            $employe = $_SESSION['user']['id_utilisateur'];
            $dept = $this->MD_Utilisateur->getIdDeptByUser($employe);
           
            $item = $this->input->post('article');
            $quantite = $this->input->post('quantite');
            $raison = $this->input->post('raison');
            $etat = $this->input->post('etat');
            $date_expiration = $this->input->post('date');
            $priorite = $this->input->post('priorite');

            $this->MD_Besoin_Achat->createDemandeBesoin($employe, $item, $dept, $quantite, $raison, $etat, $date_expiration, $priorite);

            redirect('CT_BesoinAchat/create');

        }

        public function listeEnAttente(){
            $user = $_SESSION['user'];
            $idDept = $this->MD_Utilisateur->getIdDeptByUser($user['id_utilisateur']);
            $data['besoinAchat'] = $this->MD_BesoinAchatFinal->getAllNeedBuyByDeptByStatus($idDept, 1);
            $this->viewer('/listeBesoinAchatEnAttente', $data);
        }

        public function listeApprouve(){
            $user = $_SESSION['user'];
            $idDept = $this->MD_Utilisateur->getIdDeptByUser($user['id_utilisateur']);
            $data['besoinAchat'] = $this->MD_BesoinAchatFinal->getAllNeedBuyByDeptByStatus($idDept, 3);
            $this->viewer('/listeBesoinAchatApprouve', $data);
        }

        public function listRejete(){
            $user = $_SESSION['user'];
            $idDept = $this->MD_Utilisateur->getIdDeptByUser($user['id_utilisateur']);
            $data['besoinAchat'] = $this->MD_BesoinAchatFinal->getAllNeedBuyByDeptByStatus($idDept, 5);
            $this->viewer('/listeBesoinAchatRejete', $data);
        }

        public function list_decomposee(){
            $user = $_SESSION['user'];
            $idDept = $this->MD_Utilisateur->getIdDeptByUser($user['id_utilisateur']);
            $date = $this->input->post('date');
            $data['besoinAchat'] = $this->MD_BesoinAchat->decomposition_demande_besoin_achat($date);
            $this->viewer('/listeDecomposeeBA', $data);
        }

    }

?>