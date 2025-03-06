<?php

class Domain_api_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('secure');
    }

    public function get($id=false) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from("tb_domain_api");
            $this->db->where('id', $id);
            $query = $this->db->get();
            $response = $query->row_array();
        } else {
            $this->db->select('*');
            $this->db->from("tb_domain_api");
            $query = $this->db->get();
            $response = $query->result_array();
        }
        return $response;
    }

    public function get_dashboard($id=false) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from("tb_domain_api");
            $this->db->where('id', $id);
            $query = $this->db->get();
            $response = $query->row_array();
        } else {
            $this->db->select('*');
            $this->db->from("tb_domain_api");
            $this->db->limit('5');
            $query = $this->db->get();
            $response = $query->result_array();
        }
        return $response;
    }
	
	public function show($id) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from("tb_domain_api");
            $this->db->where('id', $id);
            $query = $this->db->get();
            $response = $query->result_array();
        }
        return $response;
    }
	
	
	
	public function simpan() {
        $waktu = $tanggal = date('d-m-Y')." ".$tanggal = date('H:i:s');
		$data = array(
            'domain' => $this->input->post('domain'),
			'respon' => $this->input->post('respon'),
            );
        
       return $this->db->insert("tb_domain_api", $data);

   
    }
	

    public function timpa($id) {
        $waktu = $tanggal = date('d-m-Y')." ".$tanggal = date('H:i:s');
		$data = array(
           'domain' => $this->input->post('domain'),
			'respon' => $this->input->post('respon'),
            );
		

        $this->db->where('id', $id);
        return $this->db->update("tb_domain_api", $data);
    }

    public function delete($id) {
        return $this->db->delete("tb_domain_api", array('id' => $id));

        return false;
    }
	
    public function update($domain) {
        $first_db = $this->db->get_where('tb_domain_api', array('id' => $domain))->row_array();
        $conn_db2 = $this->load->database('apigratis', TRUE);
        $second_db = $conn_db2->get_where('tb_domain_api', array('id' => $first_db['id']))->row_array();

		$data = array(
			'respon' => $second_db['respon'],
            );

        $this->db->where('id', $first_db['id']);
       if($this->db->update("tb_domain_api", $data)){
            if($second_db['respon'] == "200"){
                return [
                    'Response' => $second_db['respon'],
                    'Success' => 'True',
                    'Message' => 'Successfully Updated'
                ];    
            }else{
                return [
                    'Response' => $second_db['respon'],
                    'Success' => 'False',
                    'Message' => 'Update Failed'
                ];     
            }
       }else{
            return [
                'Response' => $second_db['respon'],
                'Success' => 'False',
                'Message' => 'Update Failed'
            ];
       }
       
    }

    public function syncdb() {
        $first_db = $this->db->get_where('tb_domain_api', array('id' => $domain))->row_array();
        $conn_db2 = $this->load->database('apigratis', TRUE);
        $second_db = $conn_db2->get_where('tb_domain_api', array('id' => $first_db['id']))->row_array();
		$data = array(
			'respon' => $second_db['respon'],
            );

        $this->db->where('id', $first_db['id']);
       if($this->db->update("tb_domain_api", $data)){
            if($second_db['respon'] == "200"){
                return [
                    'Response' => $second_db['respon'],
                    'Success' => 'True',
                    'Message' => 'Successfully Updated'
                ];    
            }else{
                return [
                    'Response' => $second_db['respon'],
                    'Success' => 'False',
                    'Message' => 'Update Failed'
                ];     
            }
       }else{
            return [
                'Response' => $second_db['respon'],
                'Success' => 'False',
                'Message' => 'Update Failed'
            ];
       }
       
    }


    public function tg_domain_api_auto($domain) {
        $first_db = $this->db->get_where('tb_domain_api', array('id' => $domain))->row_array();

            if($first_db['respon'] != "200"){
                $pesan_tg = "<b>Realtime Status API</b>\n";
				$pesan_tg .= "API: <b>".$first_db['domain']."</b>\n";
				$pesan_tg .= "Response: <b>".$first_db['respon']."</b>\n";
				$pesan_tg .= "Mohon dilakukan pengecekan segera !\n";
				$this->telegram_lib->sendptam("-4147369438",$pesan_tg);
            }
       
    }

    public function tg_domain_api_manual($domain) {
        $first_db = $this->db->get_where('tb_domain_api', array('id' => $domain))->row_array();

            if($first_db['respon'] != "200"){
                $pesan_tg = "<b>Realtime Status API</b>\n";
				$pesan_tg .= "API: <b>".$first_db['domain']."</b>\n";
				$pesan_tg .= "Response: <b>".$first_db['respon']."</b>\n";
				$pesan_tg .= "Mohon dilakukan pengecekan segera !\n";
				$this->telegram_lib->sendptam("-4147369438",$pesan_tg);
            }
       
    }
	

}
