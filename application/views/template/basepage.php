<?php 
if(!isset($isAllDirector)){ $isAllDirector = array();}
if(!isset($isShopDirector)){ $isShopDirector = array();}   

    $this->load->view('template/header');

    if($isAllDirector == 1){
        $this->load->view('template/menu_head_director');
        $this->load->view('template/menu_bar_director');
    }
    if($isShopDirector ==1 ){
        $this->load->view('template/menu_head_shop');
        $this->load->view('template/menu_bar_shop');
    }

    if($isAllDirector == 0 && $isShopDirector ==0){
        $this->load->view('template/menu_head');
        $this->load->view('template/menu_bar');
    }

    $this->load->view('pages/'.$page,$data);

    $this->load->view('template/footer');

?>