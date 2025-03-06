<?php

class Domain_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('secure');
    }

    public function get($id=false) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from("tb_domain");
            $this->db->where('id', $id);
            $query = $this->db->get();
            $response = $query->row_array();
        } else {
            $this->db->select('*');
            $this->db->from("tb_domain");
            $this->db->order_by('statusip','ASC');
            $query = $this->db->get();
            $response = $query->result_array();
        }
        return $response;
    }

    public function get_dashboard($id=false) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from("tb_domain");
            $this->db->where('id', $id);
            $query = $this->db->get();
            $response = $query->row_array();
        } else {
            $this->db->select('*');
            $this->db->from("tb_domain");
            $this->db->order_by('statusip','ASC');
            $this->db->limit('1');
            $query = $this->db->get();
            $response = $query->result_array();
        }
        return $response;
    }
	
	public function show($id) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from("tb_domain");
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
			'ipaddr' => $this->input->post('ipaddr'),
            );
        
        $insert_domain=$this->db->insert("tb_domain", $data);
        if($insert_domain){     
            $data_domain = $this->db->from('tb_domain')->where('ipaddr',$this->input->post('ipaddr'))->order_by('id',"ASC")->limit(1)->get()->row_array();
            //if(!isset($data_domain['ipaddr'])){
                    if ($this->routerosapi->connect("10.10.10.2","it-amgm-api","AMGM2024!@#","2278")){
                    $this->routerosapi->write('/tool/netwatch/add',false);				
                    $this->routerosapi->write('=host='.$this->input->post('ipaddr'), false);							
                    $this->routerosapi->write('=interval=00:00:01', false);    				
                    $this->routerosapi->write('=down-script=/tool fetch url="http://jejak.ptamgm.net/manage/domain/'.$this->input->post('ipaddr').'/down/update" keep-result=no;', false);  
                    $this->routerosapi->write('=up-script=/tool fetch url="http://jejak.ptamgm.net/manage/domain/'.$this->input->post('ipaddr').'/up/update" keep-result=no;', false); 				
                    $this->routerosapi->write('=disabled=no');				
                    return $this->routerosapi->read(); 
                    } else{
                        return $this->session->set_flashdata('error', 'Gagal menambah data.');
                    }
           // }
            $data_update_statusip = array(
                 'statusip' => $data_domain['statusip'],
                 );
            $this->db->where('domain', $this->input->post('domain'));
            $this->db->update("tb_domain", $data_update_statusip);
           return  $this->session->set_flashdata('success', 'Berhasil menambah data.'.$data_domain['ipaddr']);
        }
   
    }
	

    public function timpa($id) {
        $waktu = $tanggal = date('d-m-Y')." ".$tanggal = date('H:i:s');
		$data = array(
           'domain' => $this->input->post('domain'),
			'ipaddr' => $this->input->post('ipaddr'),
            );
		

        $this->db->where('id', $id);
        return $this->db->update("tb_domain", $data);
    }

    public function delete($id) {
        return $this->db->delete("tb_domain", array('id' => $id));

        return false;
    }
	
    public function update($ipaddr,$statusip) {
        $waktu = $tanggal = date('d-m-Y')." ".$tanggal = date('H:i:s');
		$data = array(
			'statusip' => $statusip,
            );
		

        $this->db->where('ipaddr', $ipaddr);
        return $this->db->update("tb_domain", $data);
    }
	

}
