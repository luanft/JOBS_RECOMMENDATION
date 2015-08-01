<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once 'Lib/simple_html_dom.php';
require_once 'Lib/download.php';

//$data = curl_download('https://itviec.com/jobs/system-admin-sql-it-support-itil-2-4-years');

function get_by_xpath($data,$query)
{
	$d = $data->find($query,0);	
	if($d)
	{
		return $d->plaintext;
	}
	else 
	return '';
}

function get_xpath_link($data,$query)
{
	$d = $data->find($query,0);
	if($d)
	{
		return $d->href;
	}
	else
		return '';
}

function get_xpath_node($data,$query)
{
	return $data->find($query);	
}





// $html = new simple_html_dom();
// $html->load($data);

// echo get_by_xpath($html, '//*[@id]/div[2]/div/div[3]/div[1]/div/h1')."<br><br>";
// echo get_by_xpath($html, '//*[@id]/div[2]/div/div[2]/div[1]/h3')."<br><br>";
// echo get_by_xpath($html, '//*[@id]/div[2]/div/div[3]/div[1]/div/div[3]/span[2]')."<br><br>";
// echo get_by_xpath($html, '//*[@id]/div[2]/div/div[3]/div[1]/div/div[4]/div')."<br><br>";
// echo get_by_xpath($html, '//*[@id]/div[2]/div/div[3]/div[2]/div[2]/p')."<br><br>";
// echo get_by_xpath($html, '//*[@id]/div[2]/div/div[3]/div[4]/div[2]/p')."<br><br>";





?>