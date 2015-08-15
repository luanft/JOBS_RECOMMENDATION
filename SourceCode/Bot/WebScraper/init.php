<?php
require_once $_SERVER ["DOCUMENT_ROOT"]. '/lib/session.php';
require_once $_SERVER ["DOCUMENT_ROOT"]. '/lib/download.php';
session_unset();
Session::init();
$url = Session::get_login_url();
$data = Session::get_login_data();
$cookie = Session::get_cookie_name();

for ($i=0; $i < Session::count(); $i++ )
{
	try {		
		login($url[$i], $data[$i], $cookie[$i]);		
	}
	catch (Exception $e)
	{
		
	}
		
}
echo '<script>window.location="WebScraper.php?task=getLink&page=1&xpath_id=0";</script>';
 
?>
