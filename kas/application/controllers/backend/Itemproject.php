<?php
class Itemproject extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('masuk')) {
            redirect('/login', 'refresh');
        }

        $this->load->model('project_model');
		$this->load->library('user_agent');
		$this->load->library('TCPDF');
    }
	
    public function index() {
        if (!file_exists(APPPATH.'views/backend/itemproject/index.php')) {
            show_404();
        }

        $data['menu']  = 'itemproject';
        $data['title'] = 'Item Project';
        
		if($this->session->userdata('ses_admin')=='1')
		{ 
		$data['items'] = $this->project_model->get($id=false,"tb_itemproject");
			
			$this->load->view('backend/header', $data);
			$this->load->view('backend/itemproject/index', $data); 
			$this->load->view('backend/footer');
		}
		else
		{
		show_404();
		}
       
    }

    public function tambah() {
        if (!file_exists(APPPATH.'views/backend/project/input.php')) {
            show_404();
        }
		if($this->session->userdata('ses_admin')=='1')
		{ 
        $data['menu']  = 'itemproject';
        $data['title'] = 'Tambah Data';
		$data['items1'] = $this->project_model->get($id=false,"tb_project");
		$data['items2'] = $this->project_model->get($id=false,"tb_itemproject");
        $footer['scripts'] = "
            $('#konten').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['undo', 'redo']],
                    ['insert', ['link']]
                ]
            });
        ";
		
			$this->load->view('backend/header', $data);
			$this->load->view('backend/itemproject/input', $data);
       		$this->load->view('backend/footer', $footer);
		}
		else
		{
		show_404();
		}
    }
	

	
    public function simpan() {
        if (!file_exists(APPPATH.'views/backend/itemproject/input.php')) {
            show_404();
        }
		
		if($this->session->userdata('ses_admin')=='1')
		{ 
        $this->project_model->simpan("tb_itemproject");
        redirect('manage/itemproject');
		}
		else
		{
		show_404();
		}
    }

    public function ubah($id) {
        if (!file_exists(APPPATH.'views/backend/itemproject/input.php')) {
            show_404();
        }

        
      	if($this->session->userdata('ses_admin')=='1') 
		{
		$data['item'] = $this->project_model->get($id,"tb_itemproject");
		$data['menu']  = 'itemproject';
        $data['title'] = 'Ubah Data';
        $footer['scripts'] = "
            $('#konten').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['undo', 'redo']],
                    ['insert', ['link']]
                ]
            });
        ";

      
		$this->load->view('backend/header', $data);
         $this->load->view('backend/itemproject/input', $data);
         $this->load->view('backend/footer', $footer);
		 
		}
		else
		{
		show_404();
		}
    }

    public function timpa($id) {
        if (!file_exists(APPPATH.'views/backend/itemproject/input.php')) {
            show_404();
        }
		
		if($this->session->userdata('ses_admin')=='1') 
		{
		
        if ($this->project_model->timpa($id,"tb_itemproject")) {
            $this->session->unset_userdata('success');
            $this->session->set_flashdata('success', 'Berhasil mengubah data.');
        } else {
            $this->session->unset_userdata('error');
            $this->session->set_flashdata('error', 'Gagal mengubah data.');
        }

        redirect('manage/itemproject');
		
		}
		else
		{
		show_404();
		}
    }
	
	
    public function hapus($id) {
		if($this->session->userdata('ses_admin')=='1') 
		{
        if ($this->project_model->delete($id,"tb_itemproject")) {
            $this->session->unset_userdata('success');
            $this->session->set_flashdata('success', 'Berhasil menghapus data.');
        } else {
            $this->session->unset_userdata('error');
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('manage/itemproject');
		
		}
		else
		{
		show_404();
		}
    }
	
	


}
