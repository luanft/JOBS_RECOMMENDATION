<?php
// this file is stick to mr.Luan's file. all wrong information i will not reponsible for it :v :v
header ( 'Content-Type: text/html; charset=utf-8' );
require_once '../Lib/download.php';
require_once '../Lib/simple_html_dom.php';
require_once '../Lib/save_job.php';
set_time_limit(0);
function get_job_from_itviec($page_url) {
	try {
		$content = curl_download ( $page_url );
		$doc = new simple_html_dom ();
		$doc->load ( $content );
		$r = $doc->find ( "div.list-group-item" );
		foreach ( $r as $e ) {
			
			// title
			$e0 = $e->children ( 0 );
			$title = $e0->plaintext;
// 			
			
			// get post url
			$source = "https://www.careerlink.vn" . $e0->children ( 1 )->href;

			// download html page with link $source
			$post_detail_html = curl_download ( $source );
			// create and load new object simple_html_dom
			$html = new simple_html_dom ();
			$html->load ( $post_detail_html );
			// find object. !!! attension: remember the '0' behind to return an object, or else it return an array
			$post_detail = $html->find ( "div.job-data", 0 );
			// get address
			$address = $post_detail->children ( 0 )->children ( 1 )->plaintext;
			
			// get salary
			$salary = $post_detail->children ( 0 )->children ( 2 )->plaintext;
			
			// get description. i have two description
			$description1 = $post_detail->children ( 4 )->plaintext;
			$description2 = $post_detail->children ( 8 )->plaintext;
			$description = $description1 . "\r\n" . $description2;
			
			// get requirement
			$requirement = $post_detail->children ( 6 )->plaintext;
			
			// my page have no benifit content
			$benifit = "";
			// get and custom tags
			$tmp = "";
			foreach ( $html->find ( 'a.tag-lg' ) as $tag ) {
				$tmp .= $tag->plaintext . ", ";
			}
// 			echo $requirement . '<br>\n';
// 			echo $description . '<br>\n';
// 			echo $salary . '<br>\n';
// 			echo $address . '<br>\n';
// 			echo $title . '<br>\n';
// 			echo $source . '<br>\n';
// 			echo $tmp . '<br>';
			bot_save_job ( $title, $address, $salary, addslashes ( $description ), $tmp, 0, addslashes ( $requirement ), addslashes ( $benifit ), get_current_date_time (), $source );
			// bot_save_job('ádasd', 'ádasdad', 'ádasdasdasd', 'ádasdasd', 'ádasda', 0, 'âsdasdasd', 'ádasdasd', get_current_date_time(), 'ádasdads');
		}
	} catch ( Exception $oe ) {
		echo $oe->getMessage ();
	}
}

//
if (isset ( $_GET ['page'] )) {
	
	$url = 'https://www.careerlink.vn/viec-lam/cntt-phan-mem/19?view=detail&page=';
	get_job_from_itviec ( $url . $_GET ['page'] );
	
	if ($_GET ['page'] < 50) {		
		$_GET ['page'] += 1;		
		header ("Location: careerlink.php?page=" . $_GET ['page'] );
	} else {
		echo "Done!";
	}
} else {
	echo "not set page";
}
?>
