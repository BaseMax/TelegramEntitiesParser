<?php
// https://github.com/BaseMax
$input=file_get_contents("json.txt");
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
		$index+=mb_strlen($replace)-mb_strlen($value);
	}
	else if($entitie["type"] == "url") {
		$replace='<a href="'.$value.'">'. $value .'</a>';
		$text=mb_substr($text, 0, $entitie["offset"]+$index) . $replace . mb_substr($text, $entitie["offset"]+$index+mb_strlen($value));
		$index+=mb_strlen($replace)-mb_strlen($value);
	}
}
print $text."\n";
