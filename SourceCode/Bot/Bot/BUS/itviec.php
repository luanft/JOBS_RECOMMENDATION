<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../Lib/download.php';
require_once '../Lib/simple_html_dom.php';


$url = 'https://itviec.com/';

$content = curl_download($url);




$doc = new simple_html_dom();
$doc->load($content);

$r = $doc->find("div.job_content");


foreach ($r as $e)
{
	$detail =  $e->children(1);
	$title = $detail->children(0)->plaintext;
	$employer = $detail->children(1)->plaintext;
	$salary = $detail->children(2)->plaintext;
	$description = $detail->children(3)->plaintext;
	$location = $detail->children(4)->plaintext;
	$tags = $e->children(3)->children(0)->children(0)->children(0);
		
	echo $title."<br>";
	echo $employer."<br>";
	echo $salary."<br>";
	echo $description."<br>";
	echo $location."<br>";
	
	$tag = $tags->children();
	
	foreach ($tag as $i)	
		
		echo $i->plaintext."<br>";
			
	echo "-----------------------------------<br>";
	
	
	
	//echo $e->plaintext ."<br>";
	//echo "<br><br>";	
}




?>