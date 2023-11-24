<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class MD_Email extends CI_Model {
        public function envoyer($message){
            date_default_timezone_set('Europe/Paris');
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.gmail.com';
            $config['smtp_port'] = 465;
            $config['smtp_user'] = 'kotodevon@gmail.com'; // Remplacez par votre adresse gmail
            $config['smtp_pass'] = 'test24projetLol'; // Mot de passe Gmail donner par ce dernier
            $config['mailtype'] = 'html';
            $config['chartset'] = 'utf-8';

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->set_crlf("\r\n");
            $this->email->from("kotodevonest@gmail.com");
            $this->email->to("ralambo20@gmail.com");
            $this->email->subject("Test email");
            $this->email->message($message);

            if($this->email->send()){
                echo "Email envoyé avec succés.";
            } else {
                echo "Echec de l'envoi de l'email." . $this->email->print_debugger();
            }
        }
    }
?>