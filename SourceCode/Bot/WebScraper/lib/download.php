<?php
function curl_download($Url, $cookie) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 0 );	
	if ($cookie != "")		
		curl_setopt ( $ch, CURLOPT_COOKIEFILE,  $_SERVER ["DOCUMENT_ROOT"]."/cookie/$cookie");
	curl_setopt ( $ch, CURLOPT_URL, $Url );
	ob_start ();
	return curl_exec ( $ch );
	ob_end_clean ();
	curl_close ( $ch );
}
function login($url, $data, $cookie) {

	$login = curl_init ();
	if ($cookie == "")	return;
	$fp = fopen ( $_SERVER ["DOCUMENT_ROOT"]."/cookie/$cookie", "w" );
	fclose ( $fp );
	chmod ( $_SERVER ["DOCUMENT_ROOT"]."/cookie/$cookie", 0777 );
	curl_setopt ( $login, CURLOPT_COOKIEJAR, $_SERVER ["DOCUMENT_ROOT"]."/cookie/$cookie" );
	curl_setopt ( $login, CURLOPT_COOKIEFILE, $_SERVER ["DOCUMENT_ROOT"]."/cookie/$cookie" );	
	curl_setopt ( $login, CURLOPT_TIMEOUT, 0000 );
	curl_setopt ( $login, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $login, CURLOPT_URL, $url );
	curl_setopt ( $login, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] );
	curl_setopt ( $login, CURLOPT_FOLLOWLOCATION, TRUE );
	curl_setopt ( $login, CURLOPT_POST, TRUE );
	curl_setopt ( $login, CURLOPT_POSTFIELDS, $data );
	ob_start ();
	return curl_exec ( $login );
	ob_end_clean ();
	curl_close ( $login );
	unset ( $login );
}



function curl_download_old($Url)
{

	// Báº¯t Ä‘áº§u CURl
	$ch = curl_init($Url);
	// Thiáº¿t láº­p giáº£ láº­p trÃ¬nh duyá»‡t
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	// nghÄ©a lÃ  giáº£ máº¡o Ä‘ang gá»­i tá»« trÃ¬nh duyá»‡t nÃ o Ä‘Ã³, á»Ÿ Ä‘Ã¢y tÃ´i dÃ¹ng Firefox
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:27.0) Gecko/20100101 Firefox/27.0");
	// Thiáº¿t láº­p tráº£ káº¿t quáº£ vá»� chá»© khÃ´ng print ra
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Thá»�i gian timeout
	curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
	// Thá»±c hiá»‡n download file
	$result = curl_exec($ch);
	// Ä�Ã³ng CURL
	curl_close($ch);

	return $result;
}
?>