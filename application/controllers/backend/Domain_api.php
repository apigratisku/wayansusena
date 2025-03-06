<?php
class Domain_api extends CI_Controller {

    public function __construct() {
        parent::__construct();

       // if (!$this->session->userdata('masuk')) {
       //     redirect('/login', 'refresh');
       // }

        $this->load->model('domain_api_model');
		$this->load->library('user_agent');
		$this->load->library('TCPDF');
    }
	
    public function index() {
        if (!file_exists(APPPATH.'views/backend/domain_api/index.php')) {
            show_404();
        }

        $data['menu']  = 'domain_api';
        $data['title'] = 'Data Domain Internal';
        $data['items'] = $this->domain_api_model->get();
		if($this->session->userdata('ses_admin')=='1')
		{ 
			$this->load->view('backend/header', $data);
			$this->load->view('backend/domain_api/index', $data); 
			$this->load->view('backend/footer');
		}
		else
		{
		redirect('/login', 'refresh');
		}
    }
	

	public function tambah() {
        if (!file_exists(APPPATH.'views/backend/domain_api/input.php')) {
            show_404();
        }

        $data['menu']  = 'domain_api';
        $data['title'] = 'Tambah Data';
        $this->load->view('backend/header', $data);
        $this->load->view('backend/domain_api/input', $data);
        $this->load->view('backend/footer');
    }

	public function ubah($id) {
        if (!file_exists(APPPATH.'views/backend/domain_api/input.php')) {
            show_404();
        }

        $data['menu']  = 'domain_api';
        $data['title'] = 'Ubah Data';
		$data['item']  = $this->domain_model->get($id);
        $this->load->view('backend/header', $data);
        $this->load->view('backend/domain_api/input', $data);
        $this->load->view('backend/footer');
    }

    public function simpan() {
        if (!file_exists(APPPATH.'views/backend/domain_api/input.php')) {
            show_404();
        }

        if ($this->domain_api_model->simpan()){
            $this->session->unset_userdata('success');
            $this->session->set_flashdata('success', 'Berhasil menambah data.');
        } else {
            $this->session->unset_userdata('error');
            $this->session->set_flashdata('error', 'Gagal menambah data.');
        }

		$data['menu']  = 'domain_api';
        $data['title'] = 'Tambah Data';
        	
		$this->load->view('backend/header', $data);
        $this->load->view('backend/domain_api/input', $data);
        $this->load->view('backend/footer');

	}

		public function timpa($id) {
			if (!file_exists(APPPATH.'views/backend/domain_api/input.php')) {
				show_404();
			}
	
			if ($this->domain_api_model->timpa($id)){
				$this->session->unset_userdata('success');
				$this->session->set_flashdata('success', 'Berhasil mengubah data.');
			} else {
				$this->session->unset_userdata('error');
				$this->session->set_flashdata('error', 'Gagal mengubah data.');
			}
	
			$data['menu']  = 'domain_api';
			$data['title'] = 'Ubah Data';
				
			$this->load->view('backend/header', $data);
			$this->load->view('backend/domain_api/input', $data);
			$this->load->view('backend/footer');
		}
	
		public function hapus($id) {
            if ($this->domain_api_model->delete($id)) {
                $this->session->unset_userdata('success');
                $this->session->set_flashdata('success', 'Berhasil menghapus data.');
            } else {
                $this->session->unset_userdata('error');
                $this->session->set_flashdata('error', 'Gagal menghapus data.');
            }
    
            redirect('manage/domain_api');
		}
		
		public function update($domain) {
	
			$update_json = $this->domain_api_model->update($domain);
			
            $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($update_json));
		}

        public function syncdb() {
	
                $fields = [
                        'uid'  => "202004370",
                        'password' => "202004370",
                    ];

                $postFields = http_build_query($fields);
                /////////////////////get jobs/////////////////
                $data_api = $this->domain_api_model->get_dashboard("4");
                if($data_api['domain'] == "https://pelayanan.app-pdamgm.xyz"){
                    $exe_api = "/auth";
                }else{
                    $exe_api="";
                }
                $api_path = "https://umum.app-pdamgm.xyz/api/kendaraan";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_path); // URL tujuan
           
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Kembalikan respons sebagai string
                
              
                $featuredJobs = curl_exec($ch);

                if(curl_errno($ch)) {    
                    $reply_msg =  'Curl error: ' . curl_error($ch);  
                    echo $reply_msg;
                    exit();  
                } else {    
                    // check the HTTP status code of the request
                        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        if ($resultStatus != 200) {
                            echo stripslashes($featuredJobs);
                            $reply_msg = 'Request failed: HTTP status code: ' . $resultStatus;
                            echo $reply_msg;
                        }else{
                            echo $featuredJobs;
                          
                        } 
                }
		}

        public function tg_domain_api_auto($domain) {
			$this->domain_api_model->tg_domain_api_auto($domain);
		}
        public function tg_domain_api_manual($domain) {
			$this->domain_api_model->tg_domain_api_manual($domain);
		}

        
		


}
