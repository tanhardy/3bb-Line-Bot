<?php
$access_token = 'g9dQqU7Lew8MZMX8Mj1daewAER0g4eygxB/FLDUbMecNMAJ7vyBDOtyHk2osLE1540sMUNVyDoMB1QN+708xZOyfVsFjHH3H5dqG87PenA/zLKndQskuG8WuEXYrLiHUyHmiaZVd7sbgkSAgK73O7AdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			//$sourceType = $event['source']['type'];
			//$userId = $event['source'][$sourceType.'Id'];
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			if ($text == 'HELP') {
				$msg = '1 : 1234';
			} else if ($text == 'REGISTER') {
				$msg = print_r($event['source'],true);//$userId;
			} else {
				$msg = $text;	
			}
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $msg,	//$text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>
