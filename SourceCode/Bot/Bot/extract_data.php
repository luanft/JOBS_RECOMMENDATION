<?php
session_start ();
header ( 'Content-Type: text/html; charset=utf-8' );
require_once 'Lib/bot.php';

if (isset ( $_GET ['page'] )) {
	if (! isset ( $_SESSION ['link'] )) {
		echo "Please extract link before";
	} else {
		
		$keys_map = analyze_file_struct ( 'PATTERN/detail.html' );		
		$content = curl_download ($_SESSION ['link'][$_GET['page']]  );
		$doc = new simple_html_dom ();
		$doc->load ( $content );
		$job = $doc->find ( $element_container,0 );				
		if ($job) {			
			$dom = new simple_html_dom ();
			$dom->load ( $job);
			echo "Job: " . extract_data ( $dom, '@job' ) . '<br>';
			echo "Company : " . extract_data ( $dom, '@company' ) . '<br>';
			echo "Salary: " . extract_data ( $dom, '@salary' ) . '<br>';
			echo "Description:  " . extract_data ( $dom, '@description' ) . '<br>';
			echo "City: " . extract_data ( $dom, '@city' ) . '<br>';
			$tg =  extract_list( $dom, '@tag' );
			echo "Tag: ";
			if(is_array($tg))	
			{
				foreach ($tg as $t)
					echo $t.' ';
			}		
			else 
			{
				echo $tg;
			}
			echo '<br>';			
		}
		if(count($_SESSION['link']) > $_GET['page'])
			//echo '<script>window.location = "extract_data.php?page='.($_GET['page'] +1).'";</script>';
		//else 
			echo 'done!';					
	}
} else {
	echo "Page not set";
}


?>

