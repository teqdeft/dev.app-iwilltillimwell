<?php 

require __DIR__ . '/vendor/autoload.php'; // Loads the library
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Rest\Client;
    use Twilio\Jwt\Grants\PlaybackGrant;
// Required for all Twilio access tokens
$twilioAccountSid = 'ACba04692f7fde0e8669cc45a9f7373760';
$authToken = "cfe4bb9d32c332b354ebba7759ab2f60";
$twilioApiKey = 'SK3a08c584aaf6455b83b851c618ebdce9';
$twilioApiSecret = 'HCwjiPpHrleQbTX58FgXGKBxB7HOTiUv';


if(empty($_GET['type'])){
	die('Invalid Params');
}


$function_type = $_GET['type'];
if(!$function_type){
	echo json_encode(['error' => true, 'msg' => 'Invalid Params']);die;
}else if($function_type == 'access_token'){
	getAccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret);
}else if($function_type == 'start_stream'){
	startStream($twilioAccountSid,$authToken, $twilioApiKey, $twilioApiSecret);
}else if($function_type == 'stop_stream'){
	stopStream($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret);
}else if($function_type == 'audience_token'){
	audience_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret);
}else if($function_type == 'chat_token'){
	chat_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret);
}

function getAccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret){
	$identity = "bijay" . time();
	$roomName = "DemoStandUp";
	$token = new AccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret, 36000, $identity);
	$videoGrant = new VideoGrant();
	$videoGrant->setRoom($roomName);
	$token->addGrant($videoGrant);
	echo json_encode([
		'token'=> $token->toJWT(),
    	'room'=> $roomName,
	]);die;
}




function startStream($twilioAccountSid,$authToken, $twilioApiKey, $twilioApiSecret){
	$room = $_GET['room'];
	$twilio = new Client($twilioAccountSid, $authToken);
	$player_streamer = $twilio->media->v1->playerStreamer
    ->create();



	$media_processor = $twilio->media->v1->mediaProcessor
	    ->create(
	        "video-composer-v1", // extension
	        json_encode([
	            "identity" => "video-composer-v1",
	            "room" => [
	                "name" => $room
	            ],
	            "outputs" => [$player_streamer->sid]
	        ])
	);
	echo json_encode([]);die;
}


function stopStream($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret){
	$twilio = new Client($twilioAccountSid, $authToken);

    try {
        $playerStreamer = $twilio->media->v1->playerStreamer
            ->read([], 20);
        foreach ($playerStreamer as $record) {
            // print($record->sid);
            // echo "<br>";
            $twilio->media->v1->playerStreamer($record->sid)
                ->update("ended");
        }
    } catch (Exception $e) {
        print_r($e->getMessage());
    }

	echo json_encode([]);die;
}
function audience_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret){
	$twilio = new Client($twilioAccountSid, $authToken);

    try {
        $playerStreamer = $twilio->media->v1->playerStreamer->read(['status' => 'STARTED', "limit"=> 1], 20);


        $twilio1 = new Client($twilioApiKey, $twilioApiSecret, $twilioAccountSid);

        if(!$playerStreamer){
        	echo json_encode(['error' => true, "msg" => 'No Live Streaming Found.']);die;
        }
        $identity = "john_doe".time();

	    // Create access token, which we will serialize and send to the client
	    $token = new AccessToken(
	        $twilioAccountSid,
	        $twilioApiKey,
	        $twilioApiSecret,
	        3600,
	        $identity
	    );

	    $playbackGrant = $twilio1->media->v1->playerStreamer($playerStreamer[0]->sid)
        ->playbackGrant()
        ->create(["ttl" => 60]);

        $wrappedPlaybackGrant = new PlaybackGrant();
	    $wrappedPlaybackGrant->setGrant($playbackGrant->grant);

	    // Attach the PlaybackGrant to the Access Token
	    // $token->identity = time();
	    $token->addGrant($wrappedPlaybackGrant);
        
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
	echo json_encode(["token" => $token->toJWT()]);die;
}
function audience_token_bkp($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret){
	$twilio = new Client($twilioAccountSid, $authToken);

    try {
        $playerStreamer = $twilio->media->v1->playerStreamer->read(['status' => 'STARTED', "limit"=> 1], 20);


        $twilio1 = new Client($twilioApiKey, $twilioApiSecret, $twilioAccountSid);

        if(!$playerStreamer){
        	echo json_encode(['error' => true, "msg" => 'No Live Streaming Found.']);
        }

	    $identity = "temp User" . time();
		$roomName = "DemoStandUp";
		$token = new AccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret, 3600, $identity);
		$videoGrant = new VideoGrant();
		$videoGrant->setRoom($roomName);
		$token->addGrant($videoGrant);
		
        
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
	echo json_encode(["token" => $token->toJWT()]);die;
}
function chat_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret){
	$identity = $_GET['identity'];

	// Required for all Twilio access tokens

	// Required for Chat grant
	$serviceSid = 'IS579c535c41824d31a3f7496684888290';
	// choose a random username for the connecting user

	// Create access token, which we will serialize and send to the client
	$token = new AccessToken(
	    $twilioAccountSid,
	    $twilioApiKey,
	    $twilioApiSecret,
	    3600,
	    $identity
	);

	// Create Chat grant
	$chatGrant = new ChatGrant();
	$chatGrant->setServiceSid($serviceSid);

	// Add grant to token
	$token->addGrant($chatGrant);

	// render token to string
	echo $token->toJWT();die;
// __________________________________________________________
	// $twilio = new Client($twilioAccountSid, $authToken);

 //    try {
 //    	// IS579c535c41824d31a3f7496684888290
	    
	// 	$roomName = "DemoStandUp";
	// 	$token = new AccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret, 3600, $identity);
	// 	$chatGrant = new ChatGrant();
	// 	$token->addGrant($chatGrant);
 //    } catch (Exception $e) {
 //        print_r($e->getMessage());
 //    }
	// echo json_encode($token->toJWT());die;
}

?>