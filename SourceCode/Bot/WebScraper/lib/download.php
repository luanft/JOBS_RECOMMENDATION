<?php
function curl_download($Url) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 0 );
	curl_setopt ( $ch, CURLOPT_COOKIEFILE, "cookie.txt" );
	curl_setopt ( $ch, CURLOPT_URL, $Url );
	ob_start ();
	return curl_exec ( $ch );
	ob_end_clean ();
	curl_close ( $ch );
}

?>