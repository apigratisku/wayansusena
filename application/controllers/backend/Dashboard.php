<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('masuk')) {
            redirect('/login', 'refresh');
        }
		if(empty($this->session->userdata('ses_admin'))) {
		redirect('/login', 'refresh');
		}

        $this->load->model('operator_model');
		$this->load->model('project_model');
		$this->load->library('user_agent');
    }


    public function index() {
        if (!file_exists(APPPATH.'views/backend/dashboard.php')) {
            show_404();
        }

        $data['menu']  = 'dashboard';
        $data['title'] = 'Dashboard';
        $data['jumlah_project'] = $this->project_model->count_project();
		$data['jumlah_itemproject'] = $this->project_model->count_itemproject();
		$this->load->view('backend/header', $data);
        $this->load->view('backend/dashboard', $data);
        $this->load->view('backend/footer');
    }

}
