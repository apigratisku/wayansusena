<?php
require_once('vendor/autoload.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Amgm extends CI_Controller {
    function __construct(){
        parent::__construct();
		$this->load->model('domain_api_model');
    }
 
    function index(){
		//include APPPATH.'libraries/telegram/Telegram.php';
		$telegram = new Telegram('6562265381:AAFFnYju4xyxJ6O5foeqpdYTXAffPuHjXrM');
		$private = $telegram->getData();
		$chat_id = $telegram->ChatID();
		$msg_id = $telegram->MessageID();
        $TOKEN = "6562265381:AAFFnYju4xyxJ6O5foeqpdYTXAffPuHjXrM";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        $up = json_decode(file_get_contents("php://input"), TRUE);
        $chatID = $up["message"]["chat"]["id"];
		$fname = $up["message"]["chat"]["first_name"];
		$lname = $up["message"]["chat"]["last_name"];
        $message = $up["message"]["text"];
        $msgdata = explode(" ", $message);
		$msgcount = count($msgdata);
		$fullname = "$fname $lname";
			
		if (strpos($message, "/start") === 0) 
		{
		file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=Hai kak <b>".$fname." ".$lname."</b>. Perkenalkan saya robot PT. Air Minum Giri Menang Mataram, Salam kenal ya. Terima kasih&parse_mode=HTML");
		}
		elseif (strpos($message, "/id") === 0) 
		{
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=Hai kak ".$fname." ".$lname.". ID Telegram: `".$chatID."`.&parse_mode=MARKDOWN");
		}
		elseif (strpos($message, "/emote") === 0) 
		{
			file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=TESTTTTT".json_decode('"\u2714\u2714\u2705"')."Tanggal ".date("d-M-Y H:i:s")." WITA\n\n&parse_mode=HTML");
		}
		elseif (strpos($message, "/status_api") === 0) 
		{
			if($chatID == "250170651" || $chatID == "-4147369438"){
				if($msgdata[1] == NULL){
					$data_api = $this->domain_api_model->get_dashboard();
					$reply_msg = "";
					foreach($data_api as $api){
						$reply_msg .= urlencode("[".$api['id']."] - ".$api['domain']. " - [".$api['respon']."]\n");	
					}
					$reply_msg .= urlencode("\nUntuk pengecekan detail API gunakan perintah berikut: \n[Method GET] \n<b>/status_api [URL API]</b> \nContoh <b>/status_api https://umum.app-pdamgm.xyz/api/kendaraan</b> \n\n[Method POST] \n<b>/status_api [URL API] [UID] [PASSWORD]</b>\nContoh <b>/status_api https://pelayanan.app-pdamgm.xyz/auth 123 123</b>");

					if($reply_msg == NULL){
						file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=Data tidak ditemukan.&parse_mode=HTML");
					}
					else{
						file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$reply_msg."&parse_mode=HTML");
					}
				}else{
						/////////////////////get jobs/////////////////
						if($msgdata[1] == "https://pelayananv2.app-pdamgm.xyz/api/upload-file"){
							$api_path = "https://pelayananv2.app-pdamgm.xyz/api/upload-file";
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $api_path); // URL tujuan
							$fields = [
									'file'  => new CURLFile(base_url("/static/photos/tukang.png"),"image/png", "tester.png"),
									'folder' => "string",
									'user' => "string",
									'user' => "string",
								];
							$postFields = http_build_query($fields);
							curl_setopt($ch, CURLOPT_POST, true);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields); // Data yang dikirim
							curl_setopt($ch, CURLOPT_HTTPHEADER, [
									'Content-Type: application/x-www-form-urlencoded',
									'Content-Disposition: form-data',
									'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOiIyMDIwMDQzNzAiLCJuYW1hIjoiWkFOVUwgSEFSSVIsIFMuS29tIiwiaWF0IjoxNzM3NTI5NDU0LCJleHAiOjE3NDAxMjE0NTR9.ervy8noQJaT7KgX5GyKsmQUxg4BOG4SDq4N9Bp0E5bA',
								]);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Kembalikan respons sebagai string
							$featuredJobs = curl_exec($ch);
							// check the HTTP status code of the request
							$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
								$reply_msg = urlencode("<b>Hasil Pengcekan API</b>\n");
								$reply_msg .= urlencode("<b>URL API:</b> ".$api_path."\n\n<b>Response:</b> \n");
								if(empty($msgdata[2])){
									$reply_msg .= urlencode($featuredJobs);
								}else{
									$reply_msg .= urlencode($featuredJobs);
								}
								
								file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$reply_msg."&parse_mode=HTML");
						}else{
							$api_path = $msgdata[1];
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $api_path); // URL tujuan
							if(!empty($msgdata[2])){
								$fields = [
									'uid'  => $msgdata[2],
									'password' => $msgdata[3],
									'notif' => "string",
								];
								$postFields = http_build_query($fields);
								curl_setopt($ch, CURLOPT_POST, true);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields); // Data yang dikirim
								curl_setopt($ch, CURLOPT_HTTPHEADER, [
									'Content-Type: application/x-www-form-urlencoded',
									'Content-Length: ' . strlen($postFields),
								]);
							}
							curl_setopt($ch, CURLOPT_HTTPHEADER, [
								'Content-Type: application/x-www-form-urlencoded',
							]);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Kembalikan respons sebagai string
							
							$featuredJobs = curl_exec($ch);

							if(curl_errno($ch)) {    
								$reply_msg =  'Curl error: ' . curl_error($ch);  
								file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$reply_msg."&parse_mode=HTML");
								exit();  
							} else {    
								// check the HTTP status code of the request
									$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
									
									if ($resultStatus == 200) {
										$reply_msg = urlencode("<b>Hasil Pengcekan API</b>\n");
										$reply_msg .= urlencode("<b>URL API:</b> ".$api_path."\n\n<b>Response:</b> \n");
										if(empty($msgdata[2])){
											$reply_msg .= urlencode("".substr($featuredJobs, 0, 268)."\n\ndst. . . . . . . . . .");
										}else{
											$reply_msg .= urlencode($featuredJobs);
										}
										
										file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$reply_msg."&parse_mode=HTML");
									}else{
										$reply_msg = urlencode("<b>Hasil Pengcekan API</b>\n");
										$reply_msg .= urlencode("<b>URL API:</b> ".$api_path."\n\n<b>Response:</b> \n");
										if(empty($msgdata[2])){
											$reply_msg .= urlencode($featuredJobs);
										}else{
											$reply_msg .= urlencode($featuredJobs);
										}
										
										file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=".$reply_msg."&parse_mode=HTML");
									}
							}	
						}
						
				/////////////////////end jobs/////////////////		
				}
			}else{
				file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=<b>Maaf anda tidak memiliki akses.</b>&parse_mode=HTML");
			}
		}
        $response_json = [
            'Response' => '200',
            'Success' => 'True',
            'Message' => 'Connected'
        ];
        
        return $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response_json)); 
		
	}
	//END SYNTAX DENGAN AKSES TERDAFTAR

		
	
//END SCRIPT

}  




