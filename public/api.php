<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php'; // Loads the library
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Rest\Client;
use Twilio\Jwt\Grants\PlaybackGrant;
// Required for all Twilio access tokens



$twilioAccountSid = 'ACdb5bd634e30a2051046d3ef38973dffd';
$authToken = "cb61fed0ce9f469f2ed36f81c1c5f32f";
$twilioApiKey = 'SKe59134e0bb0ccfa97650a3b0ce62e1fc';
$twilioApiSecret = 'pQ6mF5al8Qk0RY0r8bZw2rZS04JKiT0W';


if (empty($_GET['type'])) {
	die('Invalid Params');
}


$function_type = $_GET['type'];
if (!$function_type) {
	echo json_encode(['error' => true, 'msg' => 'Invalid Params']);
	die;
} else if ($function_type == 'access_token') {
	getAccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret, $authToken);
} else if ($function_type == 'start_stream') {
	startStream($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret);
} else if ($function_type == 'stop_stream') {
	stopStream($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret);
} else if ($function_type == 'audience_token') {
	audience_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret);
} else if ($function_type == 'chat_token') {
	chat_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret);
}

function getAccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret,  $authToken)
{
	// $identity = "bijay" . time();
	$roomName = urldecode($_GET['channel_name']);
	$identity = urldecode($_GET['identity']);
	$token = new AccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret, 36000, $identity);
	$videoGrant = new VideoGrant();
	$videoGrant->setRoom($roomName);
	$token->addGrant($videoGrant);

	// Start

	// $client = new  Client($twilioAccountSid, $authToken);

	// $participant = $client->video->rooms($roomName)
	// 	->participants($identity)
	// 	->fetch();

	// print_r($participant);
	// die;

	// End
	echo json_encode([
		'token' => $token->toJWT(),
		'room' => $roomName,
	]);
	die;
}




function startStream($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret)
{
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
	echo json_encode([]);
	die;
}


function stopStream($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret)
{
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

	echo json_encode([]);
	die;
}
function audience_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret)
{
	$twilio = new Client($twilioAccountSid, $authToken);

	try {
		$playerStreamer = $twilio->media->v1->playerStreamer->read(['status' => 'STARTED', "limit" => 1], 20);


		$twilio1 = new Client($twilioApiKey, $twilioApiSecret, $twilioAccountSid);

		if (!$playerStreamer) {
			echo json_encode(['error' => true, "msg" => 'No Live Streaming Found.']);
			die;
		}
		$identity = "john_doe" . time();

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
	echo json_encode(["token" => $token->toJWT()]);
	die;
}
function audience_token_bkp($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret)
{
	$twilio = new Client($twilioAccountSid, $authToken);

	try {
		$playerStreamer = $twilio->media->v1->playerStreamer->read(['status' => 'STARTED', "limit" => 1], 20);


		$twilio1 = new Client($twilioApiKey, $twilioApiSecret, $twilioAccountSid);

		if (!$playerStreamer) {
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
	echo json_encode(["token" => $token->toJWT()]);
	die;
}
function chat_token($twilioAccountSid, $authToken, $twilioApiKey, $twilioApiSecret)
{
	$identity = $_GET['identity'];
	$roomName = urldecode($_GET['channel_name']);

	// Required for all Twilio access tokens

	$twilio = new Client($twilioAccountSid, $authToken);
	$serviceSid = 'ISa641b29f8fe74affbd62ad1625134f92';

	$channels = $twilio->chat->v1->services($serviceSid)
		->channels
		->read([], 20);

	$found = false;

	foreach ($channels as $record) {
		if ($record->uniqueName == $roomName) {
			$found = true;
			break;
		}
	}

	if (!$found) {
		$twilio->chat->v1->services($serviceSid)
			->channels
			->create(["friendlyName" => $roomName, "uniqueName" => $roomName]);
	}









	// print($channel->sid);

	// Required for Chat grant

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
	echo $token->toJWT();
	die;
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
