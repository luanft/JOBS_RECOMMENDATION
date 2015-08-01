<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start();
require_once 'xpath.php';
require_once 'Domxpath.php';
// $url = "https://www.careerlink.vn/vieclam/tim-kiem-viec-lam?sid=34124164&token=sPRnDMgM&page=";
// $based_url = "https://www.careerlink.vn";
// $xpath = '//*[@id="save-job-form"]/div//div/h2/a';



$url = "http://www.vietnamworks.com/it-hardware-networking-it-software-jobs-i55,35-en/page-";
$based_url = "";
// $xpath = '//*[@id="job-list"]/div[1]/div/table/tbody/tr/td/div/div[1]/div[2]/div[1]/a';
// $xpath = '//*[@id="job-list"]/div[1]/table/tbody/tr[1]/td/div/div[1]/div[2]/div[1]/a';
$xpath = '//*[@id="job-list"]/div[1]/table/tbody/tr/td/div/div[1]/div[2]/div[1]/a';
//*[@id="job-list"]/div[1]/div/table/tbody/tr[11]/td/div/div[1]/div[1]/div/div/a
//*[@id="job-list"]/div[1]/div/table/tbody/tr[35]/td/div/div[1]/div[1]/div[2]/div/a
$max = 25;
if(isset($_GET['page']))
{
	if($_GET['page'] < $max)
	{
		$data = curl_download($url.$_GET['page']);
		$html = new simple_html_dom();
		$html->load($data);
		$d = get_xpath_node($html, $xpath);
		if($d)
		{
			foreach ($d as $i)
			{
				$_SESSION['link'][] = $based_url.($i->href);
			}
			echo '<script>window.location = "get_link.php?page='.($_GET['page'] + 1).'";</script>';
		}
		else
		{
			echo "Can not find <br>";
		}
	}
	else 
	{
		echo '<script>window.location = "get_data.php?page=1";</script>';
	}
}
else 
{
	echo "Page not set";
}


?>

