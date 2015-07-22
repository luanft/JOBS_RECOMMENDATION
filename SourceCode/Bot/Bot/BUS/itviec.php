<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once '../Lib/download.php';
require_once '../Lib/simple_html_dom.php';
require_once '../Lib/save_job.php';
function get_job_from_itviec($page_url) {
	$content = curl_download ( $page_url );
	$doc = new simple_html_dom ();
	$doc->load ( $content );
	$r = $doc->find ( "div.job_content" );
	foreach ( $r as $e ) {
		try {
			// lấy thẻ deltail
			$detail = $e->children ( 1 );
			// lấy thẻ title
			$title = $detail->children ( 0 )->plaintext;
			// lấy post url
			$source = "https://itviec.com" . $detail->children ( 0 )->children ( 0 )->href;
			// lấy tên công ty tuyển dụng
			//$employer = $detail->children ( 1 )->plaintext;
			// lấy mức lương
			$salary = $detail->children ( 2 )->plaintext;
			// lấy location
			$city = $detail->children ( 4 )->children ( 0 );
			$dist = $detail->children ( 4 )->children ( 1 );
			$location = $dist ? ($dist->plaintext . ",") : "" . $city ? $city->plaintext : "";
			$tags = $e->children ( 3 )->children ( 0 )->children ( 0 )->children ( 0 );
			// đi vào bài viết để lấy dữ liệu(bài viết chi tiết)
			$post_detail = curl_download ( $source );
			$html = new simple_html_dom ();
			$html->load ( $post_detail );
			// lay mo tả công việc
			$mota = $html->find ( "div.description", 0 );
			$description = $mota->plaintext;
			// lấy yêu cầu công việc
			$requirement = $html->find ( "div.skills_experience", 0 )->plaintext;
			// lấy yêu cầu lợi ích
			$benifit = $html->find ( "div.love_working_here", 0 );
			$benifit = $benifit ? $benifit->plaintext: ""; 
			// lấy tag của công việc
			$tag = $tags->children ();
			$tags = "";
			foreach ( $tag as $i )
				$tags .= $i->plaintext . ",";
			$tags = substr ( $tags, 0, - 1 );
			
			bot_save_job($title, $location, $salary, addslashes($description), $tags, 0, addslashes($requirement), addslashes($benifit), get_current_date_time(), $source);
			//bot_save_job('ádasd', 'ádasdad', 'ádasdasdasd', 'ádasdasd', 'ádasda', 0, 'âsdasdasd', 'ádasdasd', get_current_date_time(), 'ádasdads');
		} catch ( Exception $oe ) {
			echo $oe->getMessage();
		}
	}
}

if(isset($_GET['page']))
{
	$url = 'https://itviec.com/?page=';
	get_job_from_itviec ( $url.$_GET['page'] );
	
	if($_GET['page'] < 10 )
	{
		$_GET['page'] += 1;
		header("Location: itviec.php?page=".$_GET['page']);
	}
	else 
	{
		echo "Done!";
	}

}
else 
{
	echo "not set page";
}


?>