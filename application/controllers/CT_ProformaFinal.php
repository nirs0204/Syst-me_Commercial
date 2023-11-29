<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_ProformaFinal extends CI_Controller {
    public function __construct() {

        parent::__construct();
        $this->load->model('MD_ProformaFinal');
        $this->load->model('MD_Employe');
         $this->load->model('MD_Article');
         $this->load->model('MD_Fournisseur');
        $this->load->model('MD_Utilisateur');
        $this->load->model('MD_BesoinAchatFinal');
        $this->load->library('session');
        if($this->session->userdata('user') === null) 
		{
			redirect('CT_Utilisateur/index?error=' . urlencode('Vous n`êtes pas connectée!'));
		}
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
    public function listBonCommande(){
        $data['listBC'] = $this->MD_ProformaFinal->getToTellLessByArticle(6);
        $this->viewer('/listeMDArticleFrns', $data);
    }
    // Contrôleur
    public function listBonCommande2(){
        $listmd = $this->MD_ProformaFinal->getToTellLessByArticle(8);
        $data['listBC'] = $listmd;
        $this->viewer('/listeMDArticleFrns', $data);
    }
    public function importPDF(){
        $id = $_GET['id'];
        $frns = $this->MD_Fournisseur->listOne($id); 
        $cmd = $this->MD_ProformaFinal->somValeur($id); 
        $ttcLettre = $this->MD_ProformaFinal->numberToWords($cmd->ttc);
        date_default_timezone_set('Indian/Antananarivo'); 
        $date = date('Y-m-d');
        ob_start(); 
        $this->load->library('Bon');
        $pdf = new Bon();
        $header = array('Designation', 'PU HT', 'Quantite', '% TVA', 'Total TVA', 'Total TTC');
        $data =  $this->MD_ProformaFinal->getcmd($id);
        $bc = $this->MD_ProformaFinal->generate_cmd($data[0]->date_actuel,$id);
        $pdf->AddPage();
        $pdf->detailBonCommande1($date, $bc, 'Cheque', '30 jours', 'Paiement dans 60 jours',$frns->nom,$frns->contact,$frns->email,$frns->adresse); 
        $pdf->tableau($header,$data);
        $pdf->montantTotal($cmd->ht,$cmd->tva,$cmd->ttc, $ttcLettre);
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