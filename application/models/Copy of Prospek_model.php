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
            $query = $this->db->get_where('gm_prospek', array('id_sales' => $id));
            $response = $query->num_rows($id);
        } else {
            $query = $this->db->get('gm_prospek');
            $response = $this->db->get('gm_prospek')->num_rows();
        }

        return $response;
    }
	
	public function open_lead_count($id=false) {
        $response = false;

        if ($id) {
            $query = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Open Lead"));
            $response = $query->num_rows($id);
        } else {
            $query = $this->db->get_where('gm_prospek', array('status' => "Open Lead"));
            $response = $query->num_rows($id);
        }

        return $response;
    }
	
	public function negosiasi_count($id=false) {
        $response = false;

        if ($id) {
            $query = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Negosiasi"));
            $response = $query->num_rows($id);
        } else {
           $query = $this->db->get_where('gm_prospek', array('status' => "Negosiasi"));
            $response = $query->num_rows($id);
        }

        return $response;
    }
	
	public function close_deal_count($id=false) {
        $response = false;

        if ($id) {
            $query = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Close Deal"));
            $response = $query->num_rows($id);
        } else {
            $query = $this->db->get_where('gm_prospek', array('status' => "Close Deal"));
            $response = $query->num_rows($id);
        }

        return $response;
    }
	
	public function close_lost_count($id=false) {
        $response = false;

        if ($id) {
            $query = $this->db->get_where('gm_prospek', array('id_sales' => $id,'status' => "Close Lost"));
            $response = $query->num_rows($id);
        } else {
             $query = $this->db->get_where('gm_prospek', array('status' => "Close Lost"));
            $response = $query->num_rows($id);
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
	
	public function get_result() {
		$this->db->select_min('selisih_waktu');
		$this->db->order_by('selisih_waktu', 'ASC');
		$result = $this->db->get('gm_prospek')->row(); 
		$query = $this->db->get_where('gm_prospek', array('selisih_waktu' => $result->selisih_waktu));
        $response = $query->row_array();
		
		return $response['odp']." ".$tarikan_spare." ".$response['site']; 
    }
	
    public function simpan() {
	
		$date = explode(" " , $this->input->post('tanggal'));
		date_default_timezone_set("Asia/Singapore");		
		$newDate = date("Y-m-d", strtotime($date[0]));
		$newY = date("Y", strtotime($date[0]));
		$newM = date("m", strtotime($date[0]));
		$newD = date("d", strtotime($date[0]));
		
		$userdata=$this->db->get_where('gm_operator', array('id' => $this->session->userdata('ses_id')))->row_array();
		$cekdata=$this->db->get_where('gm_prospek', array('nama_prospek' => $this->input->post('nama_prospek')))->row_array();
		$verifydata=$this->db->get_where('gm_prospek', array('nama_prospek' => $this->input->post('nama_prospek')))->result_array();
		
		//switch to angka [new data]
		if($this->input->post('status') == "Close Lost") { $newleading = "0"; }
		elseif($this->input->post('status') == "Data Collect") { $newleading = "1"; }
		elseif($this->input->post('status') == "Open Lead") { $newleading = "2"; }
		elseif($this->input->post('status') == "Negosiasi") { $newleading = "3"; }
		else{ $newleading = "4"; }
		
		
		//Verifikasi data jika data sudah masuk dengan user existing
		if($this->input->post('nama_prospek') == $cekdata['nama_prospek'] && $this->session->userdata('ses_id') == $cekdata['id_sales']) 
		{
			$this->session->unset_userdata('error');
			return $this->session->set_flashdata('error', 'Data telah ada. Silahkan periksa kembali !');
		}
		else
		{	
			//Validasi Lanjutan	
			foreach($verifydata as $datalead)
			{
				$tgl_existing1 = strtotime("2022-01-01"); 
				$tgl_existing2 = strtotime($datalead['waktu']); 	
				$selisih = $tgl_existing2 - $tgl_existing1;
				$first_prospek = $selisih / 60 / 60 / 24;
				
				$tgl_new1 = strtotime("2022-01-01"); 
				$tgl_new2 = strtotime($newDate); 	
				$selisih = $tgl_new2 - $tgl_new1;
				$new_prospek = $selisih / 60 / 60 / 24;
				
				//switch to angka [existing data]
				if($datalead['status'] == "Close Lost") { $existingleading = "0"; }
				elseif($datalead['status'] == "Data Collect") { $existingleading = "1"; }
				elseif($datalead['status'] == "Open Lead") { $existingleading = "2"; }
				elseif($datalead['status'] == "Negosiasi") { $existingleading = "3"; }
				else{ $existingleading = "4"; }			
				
				//Verifikasi data belum ada didatabase
				if($datalead['nama_prospek'] != NULL && $datalead['status'] != NULL)
				{
					//Verifikasi data nama prospek sama
					if($this->input->post('nama_prospek') == $datalead['nama_prospek']) 
					{
						//Verifikasi progress prospek
						if($newleading <= $existingleading)
						{
							//Verifikasi tanggal prospek
							if($new_prospek > $first_prospek)
							{
								$ket = "Duplikat-".$userdata['nama'];
							}
							else 
							{
								$ket = "Unik";
								$ket_update = "Duplikat-".$userdata['nama'];
								$data_update = array(		
								'keterangan' => $ket_update,
								);
								$this->db->where('id', $datalead['id']);
								$this->db->update('gm_prospek', $data_update);
							}
						}
						else
						{
							$ket = "Unik";
							$ket_update = "Duplikat-".$userdata['nama'];
							$data_update = array(		
							'keterangan' => $ket_update,
							);
							$this->db->where('id', $datalead['id']);
							$this->db->update('gm_prospek', $data_update);
						}
						
					} 
					else 
					{
					$ket = "Unik";
					}
				}
				else
				{
				$ket = "Unik";
				}
			}
		$ket = "Unik";
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
		'keterangan' => $ket,
		'respon' => $this->input->post('respon'),
		'lat' => $this->input->post('lat'),
		'long' => $this->input->post('long'),
        );
        $this->db->insert('gm_prospek', $data);
		$this->session->unset_userdata('success');
		return $this->session->set_flashdata('success', 'Berhasil menambah data.');
		}
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
			return true;
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
	
	
}
