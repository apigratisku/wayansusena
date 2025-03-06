<?php

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
		$this->load->model('operator_model');
		$this->load->library('user_agent');
    }

    public function index() {
        if (!file_exists(APPPATH.'views/backend/login.php')) {
            show_404();
        }
		
		if($this->agent->is_mobile()) 
		{ 
		$this->load->view('backend/login_mobile');
		} 
		else
		{
		$this->load->view('backend/login');
		}	
    }

    public function login() {
        $userid     = strip_tags($this->input->post('userid'));
		$password   = strip_tags($this->input->post('password'));

		$cek_operator=$this->operator_model->auth_operator($userid);
        if($cek_operator->num_rows() > 0){ 
				
                $data=$cek_operator->row_array();
				if (password_verify($password, $data['password'])) 
				{
                $this->session->set_userdata('masuk',TRUE);
                $this->session->set_userdata('ses_id',$data['id']);
                $this->session->set_userdata('ses_userid',$data['email']);
				$this->session->set_userdata('ses_admin',$data['admin']);
				$this->session->set_userdata('ses_foto',$data['foto']);
				$this->session->set_userdata('ses_nama',$data['nama']);
				redirect('/manage', 'refresh'); 
				} 
				else
				{
				$this->session->unset_userdata('masuk');
				$this->session->sess_destroy();
				echo "<script>alert('Kesalahan autentikasi user atau password !');</script>";
				redirect('/login', 'refresh');
				}
		}
		else
		{
		$this->session->unset_userdata('masuk');
		$this->session->sess_destroy();
        echo "<script>alert('Kesalahan autentikasi user atau password !');</script>";
		redirect('/login', 'refresh');
		}
    }

    public function logout() {
        $this->session->unset_userdata('masuk');
		$this->session->sess_destroy();
        redirect('/login', 'refresh');
    }
	

}
