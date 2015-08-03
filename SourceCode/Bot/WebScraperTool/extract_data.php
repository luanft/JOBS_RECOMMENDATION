<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
require_once 'Lib/save_job.php';

if (isset ( $_GET ['id1'] ) && isset ( $_GET ['id2'] ) && isset ( $_GET ['id3'] )) {
	$data = get_all_xpaths ();
	if (mysqli_num_rows ( $data ) > 0) {
		while ( $row = mysqli_fetch_assoc ( $data ) ) {
			$_SESSION ['home_url'] [] = $row ['home_url'];
			$_SESSION ['base_url'] [] = $row ['base_url'];
			$_SESSION ['xpath_code'] [] = $row ['xpath_code'];
			$_SESSION ['job_xpath'] [] = $row ['job_xpath'];
			$_SESSION ['company_xpath'] [] = $row ['company_xpath'];
			$_SESSION ['location_xpath'] [] = $row ['location_xpath'];
			$_SESSION ['description_xpath'] [] = $row ['description_xpath'];
			$_SESSION ['salary_xpath'] [] = $row ['salary_xpath'];
			$_SESSION ['requirement_xpath'] [] = $row ['requirement_xpath'];
			$_SESSION ['benifit_xpath'] [] = $row ['benifit_xpath'];
			$_SESSION ['expired_xpath'] [] = $row ['expired_xpath'];
			$_SESSION ['tags_xpath'] [] = $row ['tags_xpath'];
		}
	}
	$_SESSION ['num_page'] [0] = $_GET ['id1'];
	$_SESSION ['num_page'] [1] = $_GET ['id2'];
	$_SESSION ['num_page'] [2] = $_GET ['id3'];
	echo '<script>window.location = "get_link.php?ses=0&page=1&offset=0";</script>';
} else
	echo 'Tuyen\'exceptions :v :v' . '<br>' . 'please set link as: extract_data.php?id1=24&id2=58&id3=34 -- for the first times you run it' . '<br>' . ' and: extract_data.php?id1=1&id2=1&id3=1 -- for other times' . '<br>' . 'id1=24, 24 is the number of page of your site that you want to get data' . '<br>' . 'id1 is the first site save in your database' . '<br>' . 'id2 is the 2nd site save in your database' . '<br>' . 'id3 is the 3th site save in your database' . '<br>' . 'please enter exactly all values :D';
?>