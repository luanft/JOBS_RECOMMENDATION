<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
require_once 'xpath.php';
require_once 'Domxpath.php';

if ($_GET ['page'] < $_SESSION ['num_page'] [$_GET ['ses']]) {

	$data = curl_download ( $_SESSION ['home_url'] [$_GET ['ses']] . $_GET ['page'] );
	
	$html = new simple_html_dom ();
	$html->load ( $data );
	$d = get_xpath_node ( $html, $_SESSION ['xpath_code'] [$_GET ['ses']] );
	if ($d) {
		foreach ( $d as $i ) {echo $i->href. "<br>";
			$_SESSION ['link'] [] = $_SESSION ['base_url'] [$_GET ['ses']] . ($i->href);
		}
		echo '<script>window.location = "get_link.php?ses=' . ($_GET ['ses']) . '&offset=' . ($_GET ['offset']) . '&page=' . ($_GET ['page'] + 1) . '";</script>';
	} else {
		echo '<script>window.location = "get_data.php?ses=' . ($_GET ['ses']) . '&offset=' . ($_GET ['offset']) . '";</script>';
	}
} else {
	echo '<script>window.location = "get_data.php?ses=' . ($_GET ['ses']) . '&offset=' . ($_GET ['offset']) . '";</script>';
}
?>

