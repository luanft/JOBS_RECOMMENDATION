<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
require_once 'Lib/bot.php';
$keys_map = analyze_file_struct ( 'PATTERN/new.html' );
$page_url = 'https://www.careerlink.vn/viec-lam/cntt-phan-mem/19?view=detail&page=';
// $page_url=  "https://itviec.com/?page=";
//$page_url=  "http://www.vietnamworks.com/it-software-jobs-i35-en/page-";
session_unset();
set_time_limit(0);
for($i = 0; $i < 1; $i ++) {	
	$jobs = get_job_from_url ( $page_url.$i, $element_container );
	if ($jobs) {		
		foreach ( $jobs as $job ) {
			$dom = new simple_html_dom ();
			$dom->load ( $job );
			$link = extract_full_link ( $dom, '@job', 'https://www.careerlink.vn' );
			$title = extract_data( $dom, '@job');
			$company = extract_data( $dom, '@company');
			$item = new JobItem($company,$title,$link);	
			$_SESSION ['link'][] = serialize( $item);			
		}
		
	}
	else 
	{
		var_dump($_SESSION['link']);
		die( "error");
	}
}

?>

<script>
window.location = "extract_data.php?page=1";
</script>