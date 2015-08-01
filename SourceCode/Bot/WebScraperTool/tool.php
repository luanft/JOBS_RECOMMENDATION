<?php
require_once 'xpath.php';
require_once 'Domxpath.php';
require_once 'Lib/save_job.php';
// txt_url:url, txt_xpath:xpath,txt_base:base
if (isset ( $_POST ['txt_url'] ) && isset ( $_POST ['txt_xpath'] ) && isset ( $_POST ['txt_base'] )) {
	$data = curl_download ( $_POST ['txt_url'] );
	$html = new simple_html_dom ();
	$html->load ( $data );
	$d = get_xpath_node ( $html, $_POST ['txt_xpath'] );
	if ($d) {
		foreach ( $d as $i ) {
			echo $_POST ['txt_base'] . ($i->href) . "<br>";
		}
	} else {
		echo "Can not find <br>";
	}
}

// txt_url:url, txt_job:job,txt_company:company,

// txt_location:location,txt_description:description,\

// txt_salary:salary,txt_requirement:requirement,txt_benifit:benifit,txt_expired:expired

if (isset ( $_POST ['txt_url'] ) && isset ( $_POST ['txt_job'] ) && isset ( $_POST ['txt_company'] ) && isset ( $_POST ['txt_location'] ) && isset ( $_POST ['txt_description'] ) && isset ( $_POST ['txt_salary'] ) && isset ( $_POST ['txt_requirement'] ) && isset ( $_POST ['txt_benifit'] ) && isset ( $_POST ['txt_expired'] )) {
	$data = curl_download ( $_POST ['txt_url'] );
	// $html = new simple_html_dom();
	// $html->load($data);
	// echo "Job :". get_by_xpath($html, $_POST['txt_job'])."<br><br>";
	// echo "Company :". get_by_xpath($html, $_POST['txt_company'])."<br><br>";
	// echo "Location :". get_by_xpath($html, $_POST['txt_location'])."<br><br>";
	// echo "Description :". get_by_xpath($html, $_POST['txt_description'])."<br><br>";
	// echo "Salary :". get_by_xpath($html, $_POST['txt_salary'])."<br><br>";
	// echo "Requirement :". get_by_xpath($html, $_POST['txt_requirement'])."<br><br>";
	// echo "Benifit :". get_by_xpath($html, $_POST['txt_benifit'])."<br><br>";
	// echo "Expired :". get_by_xpath($html, $_POST['txt_expired'])."<br><br>";
	// echo "Tag :". get_by_xpath($html, $_POST['txt_tag'])."<br><br>";
	
	libxml_use_internal_errors ( true );
	$xx = new DOMDocument ();
	$xx->loadHTML ( $data );
	$xp = new DOMXPath ( $xx );
	
	echo "Job :" . lay_du_lieu ( $xp, $_POST ['txt_job'] ) . "<br><br>";
	echo "Company :" . lay_du_lieu ( $xp, $_POST ['txt_company'] ) . "<br><br>";
	echo "Location :" . lay_du_lieu ( $xp, $_POST ['txt_location'] ) . "<br><br>";
	echo "Description :" . lay_du_lieu ( $xp, $_POST ['txt_description'] ) . "<br><br>";
	echo "Salary :" . lay_du_lieu ( $xp, $_POST ['txt_salary'] ) . "<br><br>";
	echo "Requirement :" . lay_du_lieu ( $xp, $_POST ['txt_requirement'] ) . "<br><br>";
	echo "Benifit :" . lay_du_lieu ( $xp, $_POST ['txt_benifit'] ) . "<br><br>";
	echo "Expired :" . lay_du_lieu ( $xp, $_POST ['txt_expired'] ) . "<br><br>";
	echo "Tag :" . lay_du_lieu ( $xp, $_POST ['txt_tag'] ) . "<br><br>";
}

if (isset ( $_POST ['txt_page_url'] ) && 
		isset ( $_POST ['txt_xpath_code'] ) && isset ( $_POST ['txt_job'] )
		 && isset ( $_POST ['txt_company'] ) && isset ( $_POST ['txt_location'] ) 
		&& isset ( $_POST ['txt_description'] ) && isset ( $_POST ['txt_salary'] ) 
		&& isset ( $_POST ['txt_requirement'] ) && isset ( $_POST ['txt_benifit'] ) 
		 && isset ( $_POST ['txt_tag'] )) {
	save_xpath( $_POST['txt_page_url'],  $_POST['txt_base_url'],  $_POST['txt_xpath_code'], 
			 $_POST['txt_job'],  $_POST['txt_company'],  $_POST ['txt_location'] ,  $_POST ['txt_description'],
			  $_POST ['txt_salary'],  $_POST ['txt_requirement'],  $_POST ['txt_benifit'],  $_POST ['txt_expired'],  $_POST ['txt_tag']);
	
	// $html = new simple_html_dom();
	// $html->load($data);
	// echo "Job :". get_by_xpath($html, $_POST['txt_job'])."<br><br>";
	// echo "Company :". get_by_xpath($html, $_POST['txt_company'])."<br><br>";
	// echo "Location :". get_by_xpath($html, $_POST['txt_location'])."<br><br>";
	// echo "Description :". get_by_xpath($html, $_POST['txt_description'])."<br><br>";
	// echo "Salary :". get_by_xpath($html, $_POST['txt_salary'])."<br><br>";
	// echo "Requirement :". get_by_xpath($html, $_POST['txt_requirement'])."<br><br>";
	// echo "Benifit :". get_by_xpath($html, $_POST['txt_benifit'])."<br><br>";
	// echo "Expired :". get_by_xpath($html, $_POST['txt_expired'])."<br><br>";
	// echo "Tag :". get_by_xpath($html, $_POST['txt_tag'])."<br><br>";
}

?>