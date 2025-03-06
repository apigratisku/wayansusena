<?php

class Project_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get($id=false,$tb) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from($tb);
            $this->db->where('id', $id);
            $query = $this->db->get();
            $response = $query->row_array();
        } else {
            $this->db->select('*');
            $this->db->from($tb);
            $query = $this->db->get();
            $response = $query->result_array();
        }
        return $response;
    }
	
	public function show($id) {
        $response = false;

        if ($id) {
            $this->db->select('*');
            $this->db->from("tb_itemproject");
            $this->db->where('project', $id);
            $query = $this->db->get();
            $response = $query->result_array();
        }
        return $response;
    }
	
	public function count_project() {
	$this->db->select('*');
	$this->db->from("tb_project");
	$query = $this->db->get();
	$response = $query->num_rows();
	return $response;
	}
	public function count_itemproject() {
	$this->db->select('*');
	$this->db->from("tb_itemproject");
	$query = $this->db->get();
	$response = $query->num_rows();
	return $response;
	}
	
	public function simpan($tb) {
   		if($tb == "tb_project"){
        $data = array(
              	'nama' => $this->input->post('nama'),
				'status' => $this->input->post('status'),
            );
		}else{
		$data = array(
				'project' => $this->input->post('project'),
              	'nama' => $this->input->post('nama'),
				'nilai' => $this->input->post('nilai'),
            );
		}
        return $this->db->insert($tb, $data);
    }
	

    public function timpa($id,$tb) {
		
        if($tb == "tb_project"){
        $data = array(
              	'nama' => $this->input->post('nama'),
				'status' => $this->input->post('status'),
            );
		}else{
		$data = array(
				'project' => $this->input->post('project'),
              	'nama' => $this->input->post('nama'),
				'nilai' => $this->input->post('nilai'),
            );
		}

        $this->db->where('id', $id);
        return $this->db->update($tb, $data);
    }

    public function delete($id,$tb) {
        return $this->db->delete($tb, array('id' => $id));

        return false;
    }
	
	

}
