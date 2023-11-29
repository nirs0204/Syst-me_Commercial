<?php 
    $this->load->view('template/header');

    $this->load->view('template/menu_head');

    $this->load->view('template/menu_bar_frns');

    $this->load->view('pages/'.$page,$data);

    $this->load->view('template/footer');

?>