<?php
// https://github.com/BaseMax/TelegramEntitiesParser
$output=file_get_contents("json.txt");
function parse($message, $entities) { 
	$URLs = [];
	$message_encode = mb_convert_encoding($message, "UTF-16", "UTF-8");
	foreach(array_reverse($entities, true) as $entitie) {
		$value=substr($message_encode, $entitie['offset']*2, $entitie['length']*2);
		$value=mb_convert_encoding($value, "UTF-8", "UTF-16");
		if($entitie['type']=='url') {
			$replace="<a href=\"$value\">" . $value . "</a>";
		}
		else if($entitie['type']=='text_mention') {
			$replace="<a href=\"https://t.me/". $entitie["user"]["username"] ."\">" . $entitie["user"]["username"] . "</a>";
		}
		else if($entitie['type']=='mention') {
			$replace="<a href=\"". substr($value, 1) ."\">" . $value . "</a>";
		}
		if(isset($replace)) {
			$message_encode=substr_replace($message_encode, $replace, $entitie['offset']*2, $entitie['length']*2);
		}
	}
	return $message_encode;
}
$output=json_decode($output, true)["callback_query"];
$message = $output['message']['text'];
$entities = $output['message']['entities'];
$result=parse($message, $entities);
print $result."\n";
// sleep(80);
