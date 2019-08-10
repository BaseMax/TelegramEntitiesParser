<?php
// https://github.com/BaseMax
// header('Content-type: text/html; charset=utf-8');
$input=file_get_contents("json.txt");
// $json=json_decode($input, true, 512, JSON_UNESCAPED_UNICODE);
$json=json_decode($input, true, 512,  JSON_INVALID_UTF8_IGNORE);//JSON_INVALID_UTF8_SUBSTITUTE);
// $json=utf8_decode($json);
// print_r($json);
$message=$json["callback_query"]["message"];
$text=$message["text"];
$entities=$message["entities"];
$index=0;
$pointer=0;
// $text=utf8_encode($text);
// print json_encode([$text])."\n";
function nextchar($string, &$pointer, &$index, &$last){
	if(!isset($string[$pointer])) return false;
	$char = ord($string[$pointer]);
	$index += $last;
	if($char < 128) {
		$result=$string[$pointer];
		$pointer += 1;
		// $index += 1;
		$last=1;
		return $result;
		// return [$string[$pointer++], $index];
	} else{
		if($char < 224){
			$bytes = 2;
		}elseif($char < 240){
			$bytes = 3;
		}else{
			$bytes = 4;
		}
		$result =  substr($string, $pointer, $bytes);
		$bytesNew=$bytes;
		if($bytes >= 4) {
			$bytesNew=2;
		}
		else {
			$bytesNew=1;
		}
		$pointer += $bytes;
		$last=$bytesNew;
		// $index += $bytesNew;
		return $result;
	}
}
$i=0;
$last=0;
$currents=0;
$detects=[];
while(($chr = nextchar($text, $pointer, $i, $last)) !== false) {
	// echo $pointer." : " . ($i) . " : " . $chr."\n";
	foreach($entities as $entitieIndex=>$entitie) {
		if($entitie["offset"] == $i) {
			$detects[]=[$currents, $entitie];
			// $value=mb_substr($text, $currents, $entitie["length"]);
			// print "===> $value\n";
		}
	}
	// ANOTHER METHOD
	// foreach($entities as $entitieIndex=>$entitie) {
	// 	// unset($entities[$entitieIndex]);
	// 	if($entitie["offset"] == $i) {
	// 		//$entitie["offset"]+$index
	// 		// $value=mb_substr($text, $pointer-$last, $entitie["length"]);
	// 		// print "===> $value\n";
	// 		// $value=mb_substr($text, $i, $entitie["length"]);
	// 		// print "===> $value\n";
	// 		// $value=substr($text, $pointer-$last, $entitie["length"]);
	// 		$value=mb_substr($text, $currents, $entitie["length"]);
	// 		print "===> $value\n";
	// 		if($entitie["type"] == "text_mention") {
	// 			$replace='<a href="https://t.me/'.$entitie["user"]["username"].'">'. $value .'</a>';
	// 			$_text=mb_substr($text, 0, $currents);
	// 			$_text.=$replace;
	// 			$_text.=mb_substr($text, $currents+$entitie["length"]);
	// 			$text=$_text;
	// 			// $pointer+=mb_strlen($replace)-mb_strlen($value);
	// 			// $pointer-=strlen($replace);
	// 			// $pointer-=strlen($replace)-strlen($value);
	// 		}
	// 		// print "===> $_text\n";
	// 		// print "===> $_text\n";
	// 		// $value=substr($text, $i, $entitie["length"]);
	// 		// print "===> $value\n";
	// 		break;
	// 	}
	// }
	$currents++;
}
// print $text."\n";
$index=0;
foreach($detects as $detect) {
	$entitie=$detect[1];
	$value=mb_substr($text, $detect[0]+$index, $entitie["length"]);
	print $value."\n";
	if($entitie["type"] == "text_mention") {
		$replace='<a href="https://t.me/'.$entitie["user"]["username"].'">'. $value .'</a>';
		// $replace="{".$value."}";
		// $replace=$value;
		// print ">>>> ". mb_substr($text, 0, $detect[0]+$index) ."\n";
		// print ">>>> ". $replace ."\n";
		// print ">>>> ". mb_substr($text, $detect[0]+$index+$entitie["length"]+1) ."\n";
		$text=mb_substr($text, 0, $detect[0]+$index) . $replace . mb_substr($text, $detect[0]+$index+$entitie["length"]);
		$index+=mb_strlen($replace)-mb_strlen($value);
		// $index+=2;
	}
	else if($entitie["type"] == "mention") {
		$replace='<a href="https://t.me/'.mb_substr($value, 1).'">'. $value .'</a>';
		$text=mb_substr($text, 0, $detect[0]+$index) . $replace . mb_substr($text, $detect[0]+$index+$entitie["length"]);
		$index+=mb_strlen($replace)-mb_strlen($value);
	}
}
// exit();
// foreach($entities as $entitie) {
// 	$value=substr($text, $entitie["offset"]+$index, $entitie["length"]);
// 	print "===> $value\n";
// 	$value=utf8_decode($value);
// 	print "===> $value\n";
// 	$value=mb_substr($text, $entitie["offset"]+$index, $entitie["length"]);
// 	print "---> $value\n";
// 	$value=utf8_decode($value);
// 	print "---> $value\n";
// 	exit();
// 	// if($entitie["type"] == "text_mention") {
// 	// 	$replace='<a href="https://t.me/'.$entitie["user"]["username"].'">'. $value .'</a>';
// 	// 	$text=mb_substr($text, 0, $entitie["offset"]+$index) . $replace . mb_substr($text, $entitie["offset"]+$index+mb_strlen($value));
// 	// 	$index+=mb_strlen($replace)-mb_strlen($value);
// 	// }
// }
print $text."\n";
