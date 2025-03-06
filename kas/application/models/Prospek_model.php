<?php
require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Prospek_model extends CI_Model {

    public function __construct() {
        $this->load->database();
		$this->load->library('TCPDF');
    }
	
	
	public function data_collect_count($id=false) {
        $response = false;

        if ($id) {
            $query1 = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Data Collect"));
			$response = $query1->num_rows($id);
			
        } else {
		
           $query = $this->db->get_where('gm_prospek', array('status' => "Data Collect"));
		   $response = $query->result();
			if(isset($response))
			{
			$response = $query->num_rows();
			}
        }

        return $response;
    }
	
	public function open_lead_count($id=false) {
        $response = false;

        if ($id) {
			$open_lead = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		    $negosiasi = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		    $close_deal = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		    $close_lost = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
            $query1 = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Open Lead"));
            $response1 = $query1->num_rows();
		   	$response = $response1+$open_lead;

        } else {
		   $open_lead = $this->db->get_where('gm_prospek', array('status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		   $negosiasi = $this->db->get_where('gm_prospek', array('status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		   $close_deal = $this->db->get_where('gm_prospek', array('status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		   $close_lost = $this->db->get_where('gm_prospek', array('status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
		   
           $query1 = $this->db->get_where('gm_prospek', array('status' => "Open Lead"));
           $response1 = $query1->num_rows();
		   $response = $response1+$open_lead;
        }

        return $response;
    }
	
	public function negosiasi_count($id=false) {
        $response = false;

        if ($id) {
			$open_lead = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		    $negosiasi = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		    $close_deal = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		    $close_lost = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
            $query1 = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Negosiasi"));
            $response1 = $query1->num_rows();
		   	$response = $response1+$negosiasi;

        } else {
		   $open_lead = $this->db->get_where('gm_prospek', array('status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		   $negosiasi = $this->db->get_where('gm_prospek', array('status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		   $close_deal = $this->db->get_where('gm_prospek', array('status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		   $close_lost = $this->db->get_where('gm_prospek', array('status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
		   
           $query1 = $this->db->get_where('gm_prospek', array('status' => "Negosiasi"));
           $response1 = $query1->num_rows();
		   $response = $response1+$negosiasi;
        }

        return $response;
    }
	
	public function close_deal_count($id=false) {
        $response = false;

        if ($id) {
			$open_lead = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		    $negosiasi = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		    $close_deal = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		    $close_lost = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
            $query1 = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Close Deal"));
            $response1 = $query1->num_rows();
		   	$response = $response1+$close_deal;

        } else {
		   $open_lead = $this->db->get_where('gm_prospek', array('status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		   $negosiasi = $this->db->get_where('gm_prospek', array('status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		   $close_deal = $this->db->get_where('gm_prospek', array('status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		   $close_lost = $this->db->get_where('gm_prospek', array('status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
		   
           $query1 = $this->db->get_where('gm_prospek', array('status' => "Close Deal"));
           $response1 = $query1->num_rows();
		   $response = $response1+$close_deal;
        }

        return $response;
    }
	
	public function close_lost_count($id=false) {
        $response = false;

        if ($id) {
			$open_lead = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		    $negosiasi = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		    $close_deal = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		    $close_lost = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
            $query1 = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Close Lost"));
            $response1 = $query1->num_rows();
		   	$response = $response1+$close_lost;

        } else {
		   $open_lead = $this->db->get_where('gm_prospek', array('status !=' => "Open Lead",'status_perubahan' => "Open Lead"))->num_rows();
		   $negosiasi = $this->db->get_where('gm_prospek', array('status !=' => "Negosiasi",'status_perubahan' => "Negosiasi"))->num_rows();
		   $close_deal = $this->db->get_where('gm_prospek', array('status !=' => "Close Deal",'status_perubahan' => "Close Deal"))->num_rows();
		   $close_lost = $this->db->get_where('gm_prospek', array('status !=' => "Close Lost",'status_perubahan' => "Close Lost"))->num_rows();
		   
           $query1 = $this->db->get_where('gm_prospek', array('status' => "Close Lost"));
           $response1 = $query1->num_rows();
		   $response = $response1+$close_lost;
        }
        return $response;
    }
	
    public function get_all($id=false) {
        $response = false;

        if ($id) {
            $query = $this->db->get_where('gm_prospek', array('id' => $id));
            $response = $query->row_array();
        } else {
            $query = $this->db->get('gm_prospek');
            $response = $query->result_array();
        }

        return $response;
    }
	public function get_sales($id=false) {
        $response = false;

        if ($id) {
            $query = $this->db->get_where('gm_prospek', array('id_sales' => $id));
            $response = $query->result_array();
        } else {
            $query = $this->db->get('gm_prospek');
            $response = $query->result_array();
        }

        return $response;
    }
	
	

	public function result() {
		$this->db->select('*');
		$this->db->from('gm_prospek_capel');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$response = $query->result_array();	
        return $response;
    }
	
	public function delete_result($id) {	
        return $this->db->delete('gm_prospek_capel', array('id' => $id));
    }
	
	public function flushdata() {
		if($this->input->post('yakin') == "sayayakin")
		{
		date_default_timezone_set("Asia/Singapore");

        $this->load->dbutil();
        $pref = [
            'format' => 'zip',
            'filename' => 'prospek.sql',
			'tables' => 'gm_prospek',
        ];
        $backup     = $this->dbutil->backup($pref);
        $db_name    = 'backup_data_prospek_' . date("d-m-Y_H-i-s") . '.zip'; // nama backup dalam bentuk zip
        $save       = base_url().'/save/' . $db_name; //folder tempat database disimpan

        $this->load->helper('file'); // load helper file
        write_file($save, $backup);

       // $this->load->helper("download"); // load helper download
        //force_download($db_name, $backup);
        $this->db->truncate('gm_prospek');
		return $this->session->set_flashdata('success', 'Flush data berhasil.');
		}
		else
		{
		return $this->session->set_flashdata('error', 'Gagal flush data.');
		}
    }
	public function verifikasi_import() {
		$data_exist = $this->db->get('gm_prospek')->result_array();
		foreach($data_exist as $identitas_prospek)
		{
			$this->db->truncate('gm_prospek_verifikator');
			//STEP 1
			$verifydata=$this->db->get_where('gm_prospek', array('nama_prospek' => $identitas_prospek['nama_prospek']))->result_array();
			//Validasi selisih waktu	
			foreach($verifydata as $datalead)
			{
			$tgl_existing1 = strtotime("2022-01-01"); 
			$tgl_existing2 = strtotime($datalead['waktu']); 	
			$selisih = $tgl_existing2 - $tgl_existing1;
			$selisih_waktu = $selisih / 60 / 60 / 24;
			
			//switch to angka [existing data]
			if($datalead['status'] == "Close Lost") { $existingleading = "0"; }
			elseif($datalead['status'] == "Data Collect") { $existingleading = "1"; }
			elseif($datalead['status'] == "Open Lead") { $existingleading = "2"; }
			elseif($datalead['status'] == "Negosiasi") { $existingleading = "3"; }
			else{ $existingleading = "4"; }	
			
			//Array
			$id_sales= $datalead['id_sales'];
			$id_prospek=$datalead['id'];	
			$waktu=$datalead['waktu'];
			$jenis_kegiatan=$datalead['jenis_kegiatan'];
			$nama_prospek=$datalead['nama_prospek'];
			$segmentasi=$datalead['segmentasi'];
			$status=$datalead['status'];		
			$respon=$datalead['respon'];
			$lat=$datalead['lat'];
			$long=$datalead['long'];		
			
			$data1 = array(
			'id_sales' => $id_sales,
			'id_prospek' => $id_prospek,	
			'waktu' => $waktu,
			'jenis_kegiatan' => $jenis_kegiatan,
			'nama_prospek' => $nama_prospek,
			'segmentasi' => $segmentasi,
			'status' => $existingleading,		
			'respon' => $respon,
			'lat' => $lat,
			'long' => $long,
			'selisih_waktu' => $selisih_waktu,
			);
			$this->db->insert('gm_prospek_verifikator', $data1);
			}
			
			//STEP 2
			$this->db->select_min('selisih_waktu');
			$this->db->order_by('selisih_waktu', 'ASC');
			$result = $this->db->get('gm_prospek_verifikator')->row(); 
			$query = $this->db->get_where('gm_prospek_verifikator', array('selisih_waktu' => $result->selisih_waktu));
			$result_selisih = $query->row_array();
			
			//Update data Unik 
			$update_unik = array(		
			'keterangan' => "Unik",
			);
			$this->db->where('id', $result_selisih['id_prospek']);
			$this->db->update('gm_prospek', $update_unik);
			
			//STEP3
			//Update data Duplikat
			$verifydata2=$this->db->get_where('gm_prospek_verifikator', array('nama_prospek' => $identitas_prospek['nama_prospek']))->result_array();
			
			foreach($verifydata2 as $datalead2)
			{
				$this->db->select_min('selisih_waktu');
				$this->db->order_by('selisih_waktu', 'ASC');
				$result = $this->db->get('gm_prospek_verifikator')->row(); 
				$query = $this->db->get_where('gm_prospek_verifikator', array('selisih_waktu' => $result->selisih_waktu));
				$result_selisih = $query->row_array();
				$userdata=$this->db->get_where('gm_operator', array('id' => $result_selisih['id_sales']))->row_array();
				if($datalead2['selisih_waktu'] > $result_selisih['selisih_waktu'])
				{
				$data_duplikat = "Duplikat";
				$update_duplikat = array(		
				'keterangan' => $data_duplikat,
				'ket_sales' => $userdata['nama'],
				);
				$this->db->where('id', $datalead2['id_prospek']);
				$this->db->update('gm_prospek', $update_duplikat);
				}
			}	
		}
		return $this->session->set_flashdata('success', 'Berhasil menambah data.');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function step_result1($identitas_prospek) {
		$verifydata=$this->db->get_where('gm_prospek', array('nama_prospek' => $identitas_prospek))->result_array();
		//Validasi selisih waktu	
		foreach($verifydata as $datalead)
		{
		$tgl_existing1 = strtotime("2022-01-01"); 
		$tgl_existing2 = strtotime($datalead['waktu']); 	
		$selisih = $tgl_existing2 - $tgl_existing1;
		$selisih_waktu = $selisih / 60 / 60 / 24;
		
		//switch to angka [existing data]
		if($datalead['status'] == "Close Lost") { $existingleading = "0"; }
		elseif($datalead['status'] == "Data Collect") { $existingleading = "1"; }
		elseif($datalead['status'] == "Open Lead") { $existingleading = "2"; }
		elseif($datalead['status'] == "Negosiasi") { $existingleading = "3"; }
		else{ $existingleading = "4"; }	
		
		//Array
		$id_sales= $datalead['id_sales'];
		$id_prospek=$datalead['id'];	
		$waktu=$datalead['waktu'];
		$jenis_kegiatan=$datalead['jenis_kegiatan'];
		$nama_prospek=$datalead['nama_prospek'];
		$segmentasi=$datalead['segmentasi'];
		$status=$datalead['status'];		
		$respon=$datalead['respon'];
		$lat=$datalead['lat'];
		$long=$datalead['long'];		
		
		$data = array(
		'id_sales' => $id_sales,
		'id_prospek' => $id_prospek,	
		'waktu' => $waktu,
		'jenis_kegiatan' => $jenis_kegiatan,
		'nama_prospek' => $nama_prospek,
		'segmentasi' => $segmentasi,
		'status' => $existingleading,		
		'respon' => $respon,
		'lat' => $lat,
		'long' => $long,
		'selisih_waktu' => $selisih_waktu,
        );
        $this->db->insert('gm_prospek_verifikator', $data);
		}
		return $this->step_result2($identitas_prospek); 
    }
	
	public function step_result2($identitas_prospek) {
		$this->db->select_min('selisih_waktu');
		$this->db->order_by('selisih_waktu', 'ASC');
		$result = $this->db->get('gm_prospek_verifikator')->row(); 
		$query = $this->db->get_where('gm_prospek_verifikator', array('selisih_waktu' => $result->selisih_waktu));
        $result_selisih = $query->row_array();
		
		//Update data Unik 
		$update_unik = array(		
		'keterangan' => "Unik",
		);
		$this->db->where('id', $result_selisih['id_prospek']);
		$this->db->update('gm_prospek', $update_unik);
				
		
		return $this->step_result3($identitas_prospek);
    }
	
	public function step_result3($identitas_prospek) {
		$this->db->select_min('selisih_waktu');
		$this->db->order_by('selisih_waktu', 'ASC');
		$result = $this->db->get('gm_prospek_verifikator')->row(); 
		$query = $this->db->get_where('gm_prospek_verifikator', array('selisih_waktu' => $result->selisih_waktu));
        $result_selisih = $query->row_array();
		
		//Update data Duplikat
		$verifydata=$this->db->get_where('gm_prospek_verifikator', array('nama_prospek' => $identitas_prospek))->result_array();
		
		foreach($verifydata as $datalead)
		{
			$userdata=$this->db->get_where('gm_operator', array('id' => $result_selisih['id_sales']))->row_array();
			if($datalead['selisih_waktu'] > $result_selisih['selisih_waktu'])
			{
			$data_duplikat = "Duplikat";
			$update_duplikat = array(		
			'keterangan' => $data_duplikat,
			'ket_sales' => $userdata['nama'],
			);
			$this->db->where('id', $datalead['id_prospek']);
			$this->db->update('gm_prospek', $update_duplikat);
			}
		}	
		$this->session->unset_userdata('success');
		return $this->session->set_flashdata('success', 'Berhasil menambah data.');
    }

    public function simpan() {
		$this->db->truncate('gm_prospek_verifikator');
		$date = explode(" " , $this->input->post('tanggal'));
		date_default_timezone_set("Asia/Singapore");		
		$newDate = date("Y-m-d", strtotime($date[0]));
		$newY = date("Y", strtotime($date[0]));
		$newM = date("m", strtotime($date[0]));
		$newD = date("d", strtotime($date[0]));
		
		$data = array(
		'id_sales' => $this->session->userdata('ses_id'),
		'waktu' => $newDate,
		'tahun' => $newY,
		'bulan' => $newM,
		'tanggal' => $newD,
		'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
		'nama_prospek' => $this->input->post('nama_prospek'),
		'segmentasi' => $this->input->post('segmentasi'),
		'status' => $this->input->post('status'),		
		//'keterangan' => $ket,
		'respon' => $this->input->post('respon'),
		'lat' => $this->input->post('lat'),
		'long' => $this->input->post('long'),
        );
        $this->db->insert('gm_prospek', $data);		
		return $this->step_result1($this->input->post('nama_prospek'));
    }

    public function timpa($id) {
       $date = explode(" " , $this->input->post('tanggal'));
			date_default_timezone_set("Asia/Singapore");		
			$newDate = date("Y-m-d", strtotime($date[0]));
			$newY = date("Y", strtotime($date[0]));
			$newM = date("m", strtotime($date[0]));
			$newD = date("d", strtotime($date[0]));
			$ket = $this->db->get_where('gm_prospek', array('id' => $id))->row_array();
			
      	    $data = array(
			'id_sales' => $this->input->post('id_sales'),
			'tahun' => $newY,
			'bulan' => $newM,
            'tanggal' => $newD,
			'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
			'nama_prospek' => $this->input->post('nama_prospek'),
			'segmentasi' => $this->input->post('segmentasi'),
			'keterangan' => $ket['keterangan'],
			'respon' => $this->input->post('respon'),
			'lat' => $this->input->post('lat'),
			'long' => $this->input->post('long'),
			'waktu_perubahan' => $newDate,
			'status_perubahan' => $this->input->post('status'),
			
        );
		
        $this->db->where('id', $id);
        return $this->db->update('gm_prospek', $data);
    }

    public function delete($id) {	
        return $this->db->delete('gm_prospek', array('id' => $id));
    }
	

	
	public function insert($data){
		$insert = $this->db->insert_batch('gm_prospek', $data);
		if($insert){
			return $this->verifikasi_import();
		}
	}
	public function getData(){
		$this->db->select('*');
		return $this->db->get('gm_prospek')->result_array();
	}
	
	public function get_export($tgl_a,$tgl_b){
	$this->db->select('*');
	$this->db->from('gm_prospek');
	$this->db->where("DATE_FORMAT(waktu,'%Y-%m-%d') >='$tgl_a'");
    $this->db->where("DATE_FORMAT(waktu,'%Y-%m-%d') <='$tgl_b'");
	//$this->db->where('area',$area);
	$this->db->order_by("waktu", "desc");
	$response = $this->db->get()->result_array();
	return $response;
	}
	
	public function export_tg_xls($a,$b,$area) {
		$fileName = "Data Mapping Capel GMEDIA ".$a." sd ".$b.".xlsx";  
		$xls = $this->get_export_tg($a,$b,$area);
		date_default_timezone_set("Asia/Singapore");
		$tanggal = date("Y-m-d H:i:s");
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		//$spreadsheet->getActiveSheet()->getStyle('A1:J10')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
		$header = [
					'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					],
					'borders' => [
						'allBorders' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
							'color' => ['rgb' => '000000'],
						],
					],
					'font' => array('bold' => true),
				];
		//horizontal center
		$horizontalCenter = [
			'alignment' => [
			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			],
			'borders' => [
						'allBorders' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
							'color' => ['rgb' => '000000'],
						],
			],
		];
		$sheet = $spreadsheet->getActiveSheet();
		
		//title
		$sheet->setCellValue('A1', "Data Mapping Capel GMEDIA");
		$sheet->mergeCells('A1:K1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
					
		$sheet->setCellValue('A2', "Tanggal Export: ".$tanggal);
		$sheet->mergeCells('A2:K2'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$sheet->getStyle('A2')->getFont()->setSize(11); // Set font size 15 untuk kolom A1
		$sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$sheet->setCellValue('A3', "Hasil Data Mapping: ".$a." s.d ".$b);
		$sheet->mergeCells('A3:K3'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
		$sheet->getStyle('A3')->getFont()->setSize(11); // Set font size 15 untuk kolom A1
		$sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		
		$sheet->setCellValue('A6', 'No');
			$sheet->setCellValue('B6', 'Area');
			$sheet->setCellValue('C6', 'Capel');
			$sheet->setCellValue('D6', 'Media');
			$sheet->setCellValue('E6', 'ODP');
			$sheet->setCellValue('F6', 'Jarak');
			$sheet->setCellValue('G6', 'Latitude');    
			$sheet->setCellValue('H6', 'Longtitude');
			$sheet->setCellValue('I6', 'Site');
			$sheet->setCellValue('J6', 'Status');
			$sheet->setCellValue('K6', 'Tgl.Survey');   
			
			$sheet->getColumnDimension('A')->setAutoSize(true);
			$sheet->getColumnDimension('B')->setAutoSize(true);
			$sheet->getColumnDimension('C')->setAutoSize(true);
			$sheet->getColumnDimension('D')->setAutoSize(true);
			$sheet->getColumnDimension('E')->setAutoSize(true);
			$sheet->getColumnDimension('F')->setAutoSize(true);
			$sheet->getColumnDimension('G')->setAutoSize(true);
			$sheet->getColumnDimension('H')->setAutoSize(true);
			$sheet->getColumnDimension('I')->setAutoSize(true);
			$sheet->getColumnDimension('J')->setAutoSize(true);
			$sheet->getColumnDimension('K')->setAutoSize(true);
			
			$sheet->getColumnDimension('A')->setAutoSize(true);
			$sheet->getColumnDimension('B')->setAutoSize(true);
			$sheet->getColumnDimension('C')->setAutoSize(true);
			$sheet->getColumnDimension('D')->setAutoSize(true);
			$sheet->getColumnDimension('E')->setAutoSize(true);
			$sheet->getColumnDimension('F')->setAutoSize(true);
			$sheet->getColumnDimension('G')->setAutoSize(true);
			$sheet->getColumnDimension('H')->setAutoSize(true);
			$sheet->getColumnDimension('I')->setAutoSize(true);
			$sheet->getColumnDimension('J')->setAutoSize(true);
			$sheet->getColumnDimension('K')->setAutoSize(true);
			
			$sheet->getStyle('A6')->applyFromArray($header);
			$sheet->getStyle('B6')->applyFromArray($header);
			$sheet->getStyle('C6')->applyFromArray($header);
			$sheet->getStyle('D6')->applyFromArray($header);
			$sheet->getStyle('E6')->applyFromArray($header);
			$sheet->getStyle('F6')->applyFromArray($header);
			$sheet->getStyle('G6')->applyFromArray($header);
			$sheet->getStyle('H6')->applyFromArray($header);
			$sheet->getStyle('I6')->applyFromArray($header);
			$sheet->getStyle('J6')->applyFromArray($header);
			$sheet->getStyle('K6')->applyFromArray($header);

		$rows = 7;
		$no = 1;
		foreach ($xls as $data){
			$sheet->setCellValue('A' . $rows, $no);
			$sheet->setCellValue('B' . $rows, $data['area']);
			$sheet->setCellValue('C' . $rows, $data['capel']);
			$sheet->setCellValue('D' . $rows, $data['media']);
			$sheet->setCellValue('E' . $rows, $data['odp']);
			$sheet->setCellValue('F' . $rows, $data['jarak']."m");
			$sheet->setCellValue('G' . $rows, $data['lat']);
			$sheet->setCellValue('H' . $rows, $data['long']);
			$sheet->setCellValue('I' . $rows, $data['site']);
			$sheet->setCellValue('J' . $rows, $data['status']);
			$sheet->setCellValue('K' . $rows, $data['date']);
			
			$sheet->getStyle('A'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('B'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('C'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('D'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('E'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('F'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('G'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('H'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('I'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('J'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
				$sheet->getStyle('K'.$rows.':K'.$rows)->applyFromArray($horizontalCenter);
			
			$rows++;
			$no++;
		} 
		
		$filelocation = $_SERVER['DOCUMENT_ROOT']."/xdark/doc/mapping";
		$writer = new Xlsx($spreadsheet);
		$writer->save($filelocation."/".$fileName);
		return header("Content-Type: application/vnd.ms-excel");
		//redirect(base_url('xdark/doc/mapping/').$fileName);
	}
	 
		private function addRow($pdf, $no, $item) {
			if($item['media'] == "FO") {$ketLL = $item['jarak']."m";} else {if($item['jarak'] <= 5) {$ketLL = "1 Pipa";}elseif($item['jarak'] <= 10) {$ketLL = "2 Pipa";}elseif($item['jarak'] <= 15){$ketLL = "3 Pipa";}elseif($item['jarak'] <= 20){$ketLL = "4 Pipa";}elseif($item['jarak'] <= 25){$ketLL = "5 Pipa";}else{$ketLL = "Tinggi 30m+";}}
			$pdf->Cell(15, 8, $no, 1, 0, 'C');
			$pdf->Cell(15, 8, $item['area'], 1, 0, 'C');
			$pdf->Cell(50, 8, $item['capel'], 1, 0, 'L');
			$pdf->Cell(15, 8, $item['media'], 1, 0, 'C');
			$pdf->Cell(25, 8, $item['odp'], 1, 0, 'C');
			$pdf->Cell(30, 8, $item['lat'], 1, 0, 'C');
			$pdf->Cell(30, 8, $item['long'], 1, 0, 'C');
			$pdf->Cell(20, 8, $item['site'], 1, 0, 'C');
			$pdf->Cell(25, 8, $ketLL, 1, 0, 'C');
			$pdf->Cell(25, 8, $item['status'], 1, 0, 'C');
			$pdf->Cell(25, 8, $item['date'], 1, 1, 'C');
		}
	public function detail_dashboard() {

      	$this->db->select('*');
		$this->db->from('gm_operator');
		$this->db->where('nama !=',"NOC NTB");
		$this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$response = $query->result_array();	
        return $response;
    }
	public function persentase_all($id=false) {
        $response = false;
		if ($id) 
		{
		$count_data_collect = $this->data_collect_count($id);
		$count_open_lead = $this->open_lead_count($id);
		$count_negosiasi = $this->negosiasi_count($id);
		$count_close_deal = $this->close_deal_count($id);
		$count_close_lost = $this->close_lost_count($id);	
		
		$total 			= $count_data_collect+$count_open_lead+$count_negosiasi+$count_close_deal+$count_close_lost;
		$data_collect 	= round(($count_data_collect/$total)*100,1);
		$open_lead 	= round(($count_open_lead/$total)*100,1);
		$negosiasi 	= round(($count_negosiasi/$total)*100,1);
		$close_deal 	= round(($count_close_deal/$total)*100,1);
		$close_lost 	= round(($count_close_lost/$total)*100,1);
		$response = "$data_collect $open_lead $negosiasi $close_deal $close_lost $total";
		}
		else
		{
		
      	$count_data_collect = $this->data_collect_count();
		$count_open_lead = $this->open_lead_count();
		$count_negosiasi = $this->negosiasi_count();
		$count_close_deal = $this->close_deal_count();
		$count_close_lost = $this->close_lost_count();	
		
		$total 			= $count_data_collect+$count_open_lead+$count_negosiasi+$count_close_deal+$count_close_lost;
		if($total == "0") 
		{
		$data_collect 	= "0";
		$open_lead 	= "0";
		$negosiasi 	= "0";
		$close_deal = "0";
		$close_lost = "0";
		$totals		= "0";
		} 
		else 
		
		{
		$data_collect 	= round(($count_data_collect/$total)*100,1);
		$open_lead 	= round(($count_open_lead/$total)*100,1);
		$negosiasi 	= round(($count_negosiasi/$total)*100,1);
		$close_deal 	= round(($count_close_deal/$total)*100,1);
		$close_lost 	= round(($count_close_lost/$total)*100,1);
		$totals		= $count_data_collect+$count_open_lead+$count_negosiasi+$count_close_deal+$count_close_lost;
		}
		
		
		$response = "$data_collect $open_lead $negosiasi $close_deal $close_lost $totals";
		}
			
        return $response;
    }
	
	public function top10_rating() {
		$this->db->select('*');
		$this->db->from('gm_prospek');
		$this->db->join('gm_operator','gm_operator.id = gm_prospek.id_sales');
		$query = $this->db->get();
		$response = $query->result_array();
		return $response; 
    }
	
	public function top10_sales() {
		$this->db->select('*');
		$this->db->from('gm_operator');
		$this->db->where('nama !=',"NOC NTB");
		$this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$response = $query->result_array();	
        return $response; 
    }
	
	
	
	
}
