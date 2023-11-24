<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class CT_Email extends CI_Controller {

        public function index() {
		    $this->load->view('pages/send_email');
	    }

        public function sendEmail() {
            $sendToEmail = 'ralambo20@gmail.com';
            $subject = "One Piece";
            $message="Strings Attached";

            $config = array(
                'protocol' =>'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => '465',
                'smtp_user' => 'kotodevon@gmail.com',
                'smtp_pass' =>  'test24projetLol',
                'mailtype' =>'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => true,
            );

            $this->load->library('email',$config);
            $this->email->set_newline("\r\n");
            $this->email->from('kotodevon@gmail.com');
            $this->email->to($sendToEmail);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->attach(base_url('uploads/LuffySleeps.jpg'));
            if($this->email->send()) {
                echo 'successfully Sent Email';
            }
            else {
                echo 'Email Sending Error!';
            }

	    }

    }
?>