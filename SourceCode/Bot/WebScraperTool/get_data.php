<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();

require_once 'xpath.php';
require_once 'Domxpath.php';
require_once 'Lib/save_job.php';

// careerlink
// $job='/html/body/div[2]/div[1]/h1';
// $based_url = '';
// $company='/html/body/div[2]/div[2]/div[1]/div/ul[1]/li[1]/a';
// $location='/html/body/div[2]/div[2]/div[1]/div/ul[1]/li[2]';
// $salary='/html/body/div[2]/div[2]/div[1]/div/ul[1]/li[3]';
// $description='/html/body/div[2]/div[2]/div[1]/div/ul[2]';
// $requiement='/html/body/div[2]/div[2]/div[1]/div/div[3]';
// $expired='/html/body/div[2]/div[2]/div[1]/div/dl/dd[2]';
// $tag='/html/body/div[2]/div[2]/div[1]/div/p';
// $benifit='';

// vietnamworks
$job = '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[1]/div[1]/div/div/h1';
$based_url = '';
$company = '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[1]/div[1]/div/div/span[1]/strong';
$location = '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[1]/div[1]/div/div/span[2]';
$salary = '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[2]/div[1]/div/span';
$description = '//*[@id="job-description"]';
$requiement = '//*[@id="job-requirement"]/div/div';
$expired = '';
$tag = '//*[@id="job-detail"]/div[1]/div';
$benifit = '//*[@id="what-we-offer"]/div/div[2]/div';

if (isset ( $_GET ['page'] )) {
	
	if ($_GET ['page'] < count ( $_SESSION ['link'] )) {
		$data = curl_download ( $_SESSION ['link'] [$_GET ['page']] );
		libxml_use_internal_errors ( true );
		$xx = new DOMDocument ();
		$xx->loadHTML ( $data );
		$xp = new DOMXPath ( $xx );
		
		$djob = trim ( lay_du_lieu ( $xp, $job ) );
		$dcompany = lay_du_lieu ( $xp, $company );
		$dlocation = lay_du_lieu ( $xp, $location );
		$ddes = lay_du_lieu ( $xp, $description );
		$dsalary = lay_du_lieu ( $xp, $salary );
		$drequirement = lay_du_lieu ( $xp, $requiement );
		$dbenifit = lay_du_lieu ( $xp, $benifit );
		$dexpired = lay_du_lieu ( $xp, $expired );
		if ($dexpired == '')
			$dexpired = date ( "m" ) + 1 . "-" . date ( "d" ) . "-" . date ( "Y" );
		$dtag = '';
		echo "Url :" . $_SESSION ['link'] [$_GET ['page']] . "<br><br>";
		echo "Job :" . $djob . "<br><br>";
		echo "Company :" . $dcompany . "<br><br>";
		echo "Location :" . $dlocation . "<br><br>";
		echo "Description :" . $ddes . "<br><br>";
		echo "Salary :" . $dsalary . "<br><br>";
		echo "Requirement :" . $drequirement . "<br><br>";
		echo "Benifit :" . $dbenifit . "<br><br>";
		echo "Expired :" . $dexpired . "<br><br>";
		$dd = get_nodes_list ( $xp, $tag )->item ( 0 );
		if ($djob != '') {
			if ($dd->hasChildNodes ()) {
				echo "Tag :  <br>";
				for($i = 0; $i < $dd->childNodes->length; $i ++) {
					$dtag .= $dd->childNodes->item ( $i )->nodeValue . "|";
				}
			}
			echo "Tag :" . $dtag . "<br><br>";
			
			bot_save_job ( $djob, $dlocation, $dsalary, $ddes, $dtag, $dcompany, 0, $drequirement, $dbenifit, $dexpired, $_SESSION ['link'] [$_GET ['page']] );
		}
		
		echo '<script>window.location = "get_data.php?page=' . ($_GET ['page'] + 1) . '";</script>';
	} else {
		echo 'done!';
		session_unset ();
	}
} else {
	echo "Page not set";
}

?>