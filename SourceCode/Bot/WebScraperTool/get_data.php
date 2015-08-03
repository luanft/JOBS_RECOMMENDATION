<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();

require_once 'xpath.php';
require_once 'Domxpath.php';
require_once 'Lib/save_job.php';


if (isset ( $_GET ['offset'] )) {
	
	if ($_GET ['offset'] < count ( $_SESSION ['link'] )) {
		
// 		echo count ( $_SESSION ['link'] );
// 		foreach ( $_SESSION ['link'] as $a)
// 			echo $a."<br>";
// 		die(cc);
		$data = curl_download ( $_SESSION ['link'] [$_GET ['offset']] );
		libxml_use_internal_errors ( true );
		$xx = new DOMDocument ();
		$xx->loadHTML ( $data );
		$xp = new DOMXPath ( $xx );
		
		$djob = trim ( lay_du_lieu ( $xp, $_SESSION ['job_xpath'] [$_GET ['ses']] ) );
		$dcompany = lay_du_lieu ( $xp, $_SESSION ['company_xpath'] [$_GET ['ses']] );
		$dlocation = lay_du_lieu ( $xp, $_SESSION ['location_xpath'] [$_GET ['ses']] );
		$ddes = lay_du_lieu ( $xp, $_SESSION ['description_xpath'] [$_GET ['ses']] );
		$dsalary = lay_du_lieu ( $xp, $_SESSION ['salary_xpath'] [$_GET ['ses']] );
		$drequirement = lay_du_lieu ( $xp, $_SESSION ['requirement_xpath'] [$_GET ['ses']] );
		$dbenifit = lay_du_lieu ( $xp, $_SESSION ['benifit_xpath'] [$_GET ['ses']] );
		$dexpired = lay_du_lieu ( $xp, $_SESSION ['expired_xpath'] [$_GET ['ses']] );
		if ($dexpired == '')
			$dexpired = date ( "m" ) + 1 . "-" . date ( "d" ) . "-" . date ( "Y" );
		$dtag = '';
		echo "Url :" . $_SESSION ['link'] [$_GET ['offset']] . "<br><br>";
		echo "Job :" . $djob . "<br><br>";
		echo "Company :" . $dcompany . "<br><br>";
		echo "Location :" . $dlocation . "<br><br>";
		echo "Description :" . $ddes . "<br><br>";
		echo "Salary :" . $dsalary . "<br><br>";
		echo "Requirement :" . $drequirement . "<br><br>";
		echo "Benifit :" . $dbenifit . "<br><br>";
		echo "Expired :" . $dexpired . "<br><br>";
		$dd = get_nodes_list ( $xp, $_SESSION ['tags_xpath'] [$_GET ['ses']] )->item ( 0 );
		if ($djob != '') {
			if ($dd->hasChildNodes ()) {
				echo "Tag :  <br>";
				for($i = 0; $i < $dd->childNodes->length; $i ++) {
					$dtag .= $dd->childNodes->item ( $i )->nodeValue . "|";
				}
			}
			echo "Tag :" . $dtag . "<br><br>";
			
			if(!bot_save_job ( $djob, $dlocation, $dsalary, $ddes, $dtag, $dcompany, 0, $drequirement, $dbenifit, $dexpired, $_SESSION ['link'] [$_GET ['offset']] ))
				die(aaaaa);
		}
		
		echo '<script>window.location = "get_data.php?ses=' . ($_GET ['ses']) . '&offset=' . ($_GET ['offset'] + 1) . '";</script>';
	} else {
		if ($_GET ['ses'] < 3)
			echo '<script>window.location = "get_link.php?ses=' . ($_GET ['ses'] + 1) . '&page=1&offset=' . ($_GET ['offset']) .'";</script>';
		else {
			echo 'Done. haha!!!';
			session_unset ();
		}
	}
} else {
	echo "Page not set";
}

?>