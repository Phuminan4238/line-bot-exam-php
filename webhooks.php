<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'e5Fy1klRtGHeYWeDaBMzaNrvaBwkUNr/u3u7Vh1WbZa43zzfQDfqGF83WEJOWLetTVzY/9HNQAnYbT8gHolRU5bLnZu81acq2F01oXifab9gWOAZU8K5v3k2/Ye+0Pc5981KdKPS9ryy1PGHgmbQQQdB04t89/1O/w1cDnyilFU=';

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
			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			 $textMessage = $event['message']['text'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $textMessage
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
			$result = curl_exec($ch);
			echo $textMessage;
			curl_close($ch);
			
		}
	}
}

<script type="text/javascript">


var str = "<?php echo $event['message']['text']?>"; // "A string here"
console.log(str);
</script>
echo "OK";
