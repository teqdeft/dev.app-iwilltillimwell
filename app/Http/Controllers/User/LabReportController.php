<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Session;

class LabReportController extends Controller
{
    public function index(Request $request) {
		$this->labsReportList($request);
	}
    public function labsReportList(Request $request) {
		
		$tele_data = [];
		$post_url=Config::get('constants.tel_api_url')."lab/getRequested";
		$data = (new ConsultationController)->postToteleMedicine($tele_data, $post_url, false, false);
		if(ismobile()){	
			return view("user.mobile.labs-report-list",compact('data'));
		}
		return view("user.labs-report-list",compact('data')); 
		
	}
    public function labsReportDownload(Request $request) {
		
		
		/* $token = str_replace(array("\r\n", "\n", "\r"), '', Session::get('member_auth'));
        $headers = array($token);
		$headers = ["Authorization: Bearer $token"];
		$userAttachment_id = $_GET['attachment_id'];
		$streamMethod = "inline";
		if(ismobile()){	
			$streamMethod = "attachment";
		}
		
		$userId = Auth::user()->userid;
		
		$url = Config::get('constants.tel_api_url') . "attachment/stream/$userAttachment_id/$streamMethod/$userId";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$headers = substr($response, 0, $headerSize);
		$body = substr($response, $headerSize);
		$filename = "downloaded_file.pdf"; 
		if (preg_match('/filename="(.+?)"/', $headers, $matches)) {
			$filename = $matches[1];
		}
		$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

		curl_close($ch);

		if ($httpCode == 200) {
			header("Content-Type: $contentType");
			header("Content-Disposition: $streamMethod; filename=\"$filename\"");
			header("Content-Length: " . strlen($body));
			echo $body;
			exit;
		} else {
			echo "Failed to download file. HTTP Status: $httpCode";
		} */
		?>
		<iframe src="/john-smith-results.pdf" width="100%" height="1000px"></iframe>

		<?php 
	}
	
	public function myConsultationsDownloadAudio(Request $request) {
		
		
		$token = str_replace(array("\r\n", "\n", "\r"), '', Session::get('member_auth'));
        $headers = array($token);
		$headers = ["Authorization: Bearer $token"];
		$consultation_id = $_GET['consultation_id'];
		
		
		$userId = Auth::user()->userid;
		
		$postFields = [
			'consultId' => $consultation_id,
		];
		$url = Config::get('constants.tel_api_url') . "api/consultationHistory/getSoundFiles";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

		$response = curl_exec($ch);
		$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$headers = substr($response, 0, $headerSize);
		$body = substr($response, $headerSize);
		$filename = ""; 
		if (preg_match('/filename="(.+?)"/', $headers, $matches)) {
			$filename = $matches[1];
		}
		$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

		curl_close($ch);

		if ($httpCode == 200) {
			header("Content-Type: $contentType");
			header("Content-Disposition: $streamMethod; filename=\"$filename\"");
			header("Content-Length: " . strlen($body));
			echo $body;
			exit;
		} else {
			echo "Failed to download file. HTTP Status: $httpCode";
		}
		 
	}
}
