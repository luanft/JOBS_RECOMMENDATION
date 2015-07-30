<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once 'Lib/bot.php';

//xu ly test main pattern

if(isset($_POST['home_pattern']) && isset($_POST['home_url']))
{	
	$keys_map = analyze_string_struct($_POST['home_pattern']);	
	
	$jobs = get_job_from_url ($_POST['home_url'], $element_container );
	if ($jobs) {
		foreach ( $jobs as $job ) {
			$dom = new simple_html_dom ();
			$dom->load ( $job );
			echo extract_full_link ( $dom, '@job', $_POST['base_url'] ).'<br>';
		}
	}
}

if(isset($_POST['detail_pattern']) && isset($_POST['detail_url']))
{
	$keys_map = analyze_string_struct($_POST['detail_pattern']);

	$jobs = get_job_from_url ($_POST['detail_url'], $element_container );
	if ($jobs) {
		foreach ( $jobs as $job ) {
			$dom = new simple_html_dom ();
			$dom->load ( $job );
			echo extract_data( $dom, '@job' ).'<br>';
			echo extract_data( $dom, '@description' ).'<br>';
			echo extract_data( $dom, '@salary' ).'<br>';
			echo extract_data( $dom, '@company' ).'<br>';
			echo extract_data( $dom, '@city' ).'<br>';
			echo extract_data( $dom, '@tag' ).'<br>';
			
		}
	}
}

?>