<?php

class Operator extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('masuk')) {
            redirect('/login', 'refresh');
        }
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        $this->load->model('operator_model');
		$this->load->library('user_agent');
    }

    public function index() {
        if (!file_exists(APPPATH.'views/backend/operator/index.php')) {
            show_404();
        }

        $data['menu']  = 'operator';
        $data['title'] = 'Data Pengguna';
        $data['items'] = $this->operator_model->get();

        $this->load->view('backend/header', $data);
        $this->load->view('backend/operator/index', $data);
        $this->load->view('backend/footer');
    }

    public function detil($id) {
        if (!file_exists(APPPATH.'views/backend/operator/show.php')) {
            show_404();
        }

        $data['menu']  = 'operator';
        $data['title'] = 'Detil Data Pengguna';
        $data['item']  = $this->operator_model->get($id);
        
		$this->load->view('backend/header', $data);
        $this->load->view('backend/operator/show', $data);
        $this->load->view('backend/footer');
    }

    public function tambah() {
        if (!file_exists(APPPATH.'views/backend/operator/input.php')) {
            show_404();
        }

        $data['menu']  = 'operator';
        $data['title'] = 'Tambah Data';
        $this->load->view('backend/header', $data);
        $this->load->view('backend/operator/input', $data);
        $this->load->view('backend/footer');
    }

    public function simpan() {
        if (!file_exists(APPPATH.'views/backend/operator/input.php')) {
            show_404();
        }

        if ($this->operator_model->simpan()) {
            $this->session->unset_userdata('success');
            $this->session->set_flashdata('success', 'Berhasil menambah data.');
        } else {
            $this->session->unset_userdata('error');
            $this->session->set_flashdata('error', 'Gagal menambah data.');
        }

        $data['menu']  = 'operator';
        $data['title'] = 'Tambah Data';
        	
		$this->load->view('backend/header', $data);
        $this->load->view('backend/operator/input', $data);
        $this->load->view('backend/footer');
    }

    public function ubah($id) {
        if (!file_exists(APPPATH.'views/backend/operator/input.php')) {
            show_404();
        }

        $data['menu']  = 'operator';
        $data['title'] = 'Ubah Data Sales';
        $data['item']  = $this->operator_model->get($id);
        	
		$this->load->view('backend/header', $data);
        $this->load->view('backend/operator/input', $data);
        $this->load->view('backend/footer');
    }

    public function timpa($id) {
        if (!file_exists(APPPATH.'views/backend/operator/input.php')) {
            show_404();
        }
		
        if ($this->operator_model->timpa($id)) {
            $this->session->unset_userdata('success');
            $this->session->set_flashdata('success', 'Berhasil mengubah data.');
        } else {
            $this->session->unset_userdata('error');
            $this->session->set_flashdata('error', 'Gagal mengubah data.');
        }

        $data['menu']  = 'operator';
        $data['title'] = 'Ubah Data';
        $data['item']  = $this->operator_model->get($id);

        	
		$this->load->view('backend/header', $data);
        $this->load->view('backend/operator/input', $data);
        $this->load->view('backend/footer');
    }

    public function hapus($id) {
        $opfoto = $this->operator_model->get($id);
        $foto   = $opfoto['foto'];

        if ($this->operator_model->delete($id)) {
            unlink('./static/photos/operator/' . $foto);
            $this->session->unset_userdata('success');
            $this->session->set_flashdata('success', 'Berhasil menghapus data.');
        } else {
            $this->session->unset_userdata('error');
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }

        redirect('manage/operator');
    }
	
	public function gantipwd() {

        $data['menu']  = 'gantipwd';
        $data['title'] = 'Ubah Password';
	
		$this->load->view('backend/header', $data);
        $this->load->view('backend/operator/gantipwd', $data);
        $this->load->view('backend/footer');
    }
	public function prosespwd() {
		$this->operator_model->prosespwd();

        $data['menu']  = 'gantipwd';
        $data['title'] = 'Ubah Password';

		$this->load->view('backend/header', $data);
        $this->load->view('backend/operator/gantipwd', $data);
        $this->load->view('backend/footer');
    }

}
