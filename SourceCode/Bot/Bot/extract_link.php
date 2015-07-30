<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
require_once 'Lib/bot.php';
$keys_map = analyze_file_struct ( 'PATTERN/careerbuider.html' );
$page_url = 'https://www.careerlink.vn/viec-lam/cntt-phan-mem/19?view=detail';


$jobs = get_job_from_url ( $page_url, $element_container );
if ($jobs) {
	foreach ( $jobs as $job ) {
		$dom = new simple_html_dom ();
		$dom->load ( $job );		
		$_SESSION ['link'] [] = extract_full_link ( $dom, '@job', 'https://www.careerlink.vn' );
	}	
}

?>

<script>
window.location = "extract_data.php?page=1";
</script>