<?php
function curl_download($Url, $cookie) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 0 );
	if ($cookie != "")
		curl_setopt ( $ch, CURLOPT_COOKIEFILE, $cookie );
	curl_setopt ( $ch, CURLOPT_URL, $Url );
	ob_start ();
	return curl_exec ( $ch );
	ob_end_clean ();
	curl_close ( $ch );
}
function login($url, $data, $cookie) {
	$fp = fopen ( $cookie, "w" );
	fclose ( $fp );
	chmod ( $cookie, 0777 );
	$login = curl_init ();
	curl_setopt ( $login, CURLOPT_COOKIEJAR, $cookie );
	curl_setopt ( $login, CURLOPT_COOKIEFILE, $cookie );
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

?>