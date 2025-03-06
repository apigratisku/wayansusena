<?php

class Beranda extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {
        if (!file_exists(APPPATH.'views/backend/login.php')) {
            show_404();
        }
		
        $this->load->view('backend/login');
    }


}
