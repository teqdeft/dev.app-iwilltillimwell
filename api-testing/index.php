<?php 
function curlRequest($url = false, $data = [], $post_method = false, $headers = [], $requestHeader = false)
	{
		if ($url) {
			try {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				if ($post_method && $data) {
					if ($requestHeader) {
						curl_setopt($ch, CURLOPT_HEADER, true);
					}
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				}
				$response = curl_exec($ch);
				curl_close($ch);
				return $response;
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}
	}
	
// Sandbox 	
$url = "https://staging.getlyric.com/go/api/login";
$credentials = array('email' =>'MTMIWTIW01@mytelemedicine.com', 'password' =>'U74AVL!0oh!Mfeu!o)0p');
$response = curlRequest($url, $credentials, true, [], true);	
 
 echo "Sandbox Mode ";
 echo "<pre>";
 print_r($response);
 echo "</pre>";


// live  

$url = "https://portal.getlyric.com/go/api/login";
$credentials = array('email' =>'MTMIWTIW01@mytelemedicine.com', 'password' =>'lkL}ScO5v}MHLEzZVGm]');
$response = curlRequest($url, $credentials, true, [], true);
echo "Live Mode ";
 echo "<pre>";
 print_r($response);
 echo "</pre>";
 
?>