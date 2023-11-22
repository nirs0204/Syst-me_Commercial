<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_ProformaFinal extends CI_Controller {
    public function __construct() {

        parent::__construct();
        $this->load->model('MD_ProformaFinal');
        $this->load->model('MD_Employe');
        // $this->load->model('MD_Article');
        // $this->load->model('MD_Fournisseur');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->library('session');
        
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

    public function listBonCommande(){
        $data['listBC'] = $this->MD_ProformaFinal->getToTellLessByArticle(6);
        $this->viewer('/listeMDArticleFrns', $data);
    }

    // Contrôleur
    public function listBonCommande2(){
        $listmd = $this->MD_ProformaFinal->getToTellLessByArticle(6);
        $data['listBC'] = $listmd;
            $this->viewer('/listeMDArticleFrns', $data);
    }
    public function importPDF(){

        ob_start(); 
        $this->load->library('Bon');
        $pdf = new Bon();
        $header = array('Designation', 'Unite', 'PU HT', 'Quantite', '% TVA', 'Total TVA', 'Total TTC');
        $data = array();
        $ht = 6789;
        $tva = 647;
        $ttc = 9365;
        $ttcLettre = 'vingt million';
        $pdf->AddPage();
        $pdf->detailBonCommande1('2023-10-23', '123', 'Cheque', '30 jours', 'Paiement dans 60 jours', 'Super U', '020 23 456 78', 'email@example.com', 'Rakoto'); 
        $pdf->tableau($header,$data);
        $pdfData = $pdf->Output('','S'); 
        ob_end_clean(); 
    
        $pdfData = base64_encode($pdfData); 


        
        echo '<script>';
        echo 'var win = window.open();';
        echo 'win.document.write(\'<iframe width="100%" height="100%" src="data:application/pdf;base64,' . $pdfData . '"></iframe>\');'; 
        echo 'window.location.href = "' . base_url() . 'CT_ProformaFinal/listBonCommande2";'; 
        echo '</script>'; 
    }
}
?>