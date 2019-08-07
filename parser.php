<?php
// https://github.com/BaseMax
$input='{"update_id":993028181,
"callback_query":{"id":"253266359262956627","from":{"id":589,"is_bot":false,"first_name":"$t\u20acph!n","username":"****","language_code":"en"},"message":{"message_id":53,"from":{"id":912915320,"is_bot":true,"first_name":"Alerts","username":"AlertsAdminBot"},"chat":{"id":-1001253152862,"title":"Test","type":"supergroup"},"date":1565192650,"text":"\u2733\ufe0f\u2733\ufe0f\u2733\ufe0f Help \u2733\ufe0f\u2733\ufe0f\u2733\ufe0f\n\nAztek_btc $t\u20acph!n \nAztek_btc requested help\n\nhttps://t.me/c/1095432501/1003","entities":[{"offset":20,"length":9,"type":"text_mention","user":{"id":298878695,"is_bot":false,"first_name":"Aztetc","username":"Aztetc","language_code":"en"}},{"offset":30,"length":7,"type":"text_mention","user":{"id":5869,"is_bot":false,"first_name":"$t\u20acph!n","username":"*****","language_code":"en"}},{"offset":39,"length":9,"type":"text_mention","user":{"id":29885,"is_bot":false,"first_name":"Aztetc","username":"Aztetc","language_code":"en"}},{"offset":65,"length":30,"type":"url"}],"reply_markup":{"inline_keyboard":[[{"text":"Resolved","callback_data":"resolved|-1001095432501|1003"}]]}},"chat_instance":"-2765841522703723733","data":"resolved|-1001095432501|1003"}}';
$json=json_decode($input, true);
// print_r($json);
$message=$json["callback_query"]["message"];
$text=$message["text"];
$entities=$message["entities"];
$index=0;
// print $text."\n";
// print "------------------\n";
foreach($entities as $entitie) {
	// print_r($entitie);
	$value=mb_substr($text, $entitie["offset"]+$index, $entitie["length"]);
	// print "---> $value\n";
	if($entitie["type"] == "text_mention") {
		$replace='<a href="https://t.me/'.$entitie["user"]["username"].'">'. $value .'</a>';
		$text=mb_substr($text, 0, $entitie["offset"]+$index) . $replace . mb_substr($text, $entitie["offset"]+$index+mb_strlen($value));
		$index+=strlen($replace)-strlen($value);
	}
	else if($entitie["type"] == "url") {
		$replace='<a href="'.$value.'">'. $value .'</a>';
		$text=mb_substr($text, 0, $entitie["offset"]+$index) . $replace . mb_substr($text, $entitie["offset"]+$index+mb_strlen($value));
		$index+=strlen($replace)-strlen($value);
	}
}
print $text."\n";
