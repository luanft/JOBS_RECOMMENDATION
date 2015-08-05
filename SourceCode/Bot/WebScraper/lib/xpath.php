<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once  $_SERVER ["DOCUMENT_ROOT"].'/Lib/simple_html_dom.php';
require_once  $_SERVER ["DOCUMENT_ROOT"].'/Lib/download.php';

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

function lay_du_lieu($xdata,$query)
{
	try {
		$data = $xdata->query($query);
		if($data)
		{
			if($data->length> 0)
				return $data->item(0)->nodeValue;
			else
				return '';
		}
		else
		{
			return '';
		}
	}
	catch (Exception $r)
	{
		return '';
	}

}

function get_nodes_list($data,$query)
{
	return $data->query($query);
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