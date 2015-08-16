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
	if (trim($cookie) == "") return;
	$fp = fopen ($_SERVER ["DOCUMENT_ROOT"]."/cookie/".$cookie, "w");
	fclose ($fp);
	chmod ( $_SERVER ["DOCUMENT_ROOT"]."/cookie/".$cookie, 0777 );
	curl_setopt ( $login, CURLOPT_COOKIEJAR, $_SERVER ["DOCUMENT_ROOT"]."/cookie/".$cookie );
	curl_setopt ( $login, CURLOPT_COOKIEFILE, $_SERVER ["DOCUMENT_ROOT"]."/cookie/".$cookie );	
	curl_setopt ( $login, CURLOPT_TIMEOUT, 1000 );
	curl_setopt ( $login, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $login, CURLOPT_URL, $url );
	curl_setopt ( $login, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0" );
	curl_setopt ( $login, CURLOPT_FOLLOWLOCATION, TRUE );
	curl_setopt ( $login, CURLOPT_POST, TRUE );
	curl_setopt ( $login, CURLOPT_POSTFIELDS, $data );
	ob_start ();
	return curl_exec ( $login );
	ob_end_clean ();
	curl_close ( $login );
	unset ( $login );
}


//get content webpage as html
function curl_download_old($Url,$cookie='')
{
	//init curl object
	$ch = curl_init($Url);	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	//emulate web browser
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//set time out value
	curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
	//set cookie
	if ($cookie != "")
		curl_setopt ( $ch, CURLOPT_COOKIEFILE,  $_SERVER ["DOCUMENT_ROOT"]."/cookie/$cookie");
	//download html web page
	$result = curl_exec($ch);
	//close curl
	curl_close($ch);
	return $result;
}
?>