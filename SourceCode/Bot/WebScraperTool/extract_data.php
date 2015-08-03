<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
require_once 'Lib/save_job.php';

if (isset ( $_GET ['run-first-time'] )) {
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
	if ($_GET ['run-first-time'] == 1) {
		$_SESSION ['num_page'] [0] = $_SESSION ['num_page'] [1] = $_SESSION ['num_page'] [2] = 60;
	} else {
		$_SESSION ['num_page'] [0] = $_SESSION ['num_page'] [1] = $_SESSION ['num_page'] [2] = 3;
	}
	
	echo '<script>window.location = "get_link.php?ses=0&page=1&offset=0";</script>';
} else {
	echo 'please enter the link as: localhost:8080/extract_data.php?run-first-time=1 - for the first time' . '<br>';
	echo 'please enter the link as: localhost:8080/extract_data.php?run-first-time=0 - for the other time' . '<br>';
}
?>