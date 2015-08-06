<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/session.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/model/config.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/download.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/xpath.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/simple_html_dom.php';

class WebScraperController {
	public function __construct() {
	}
	public function control() {
		
		if (isset ( $_GET ['task'] )) {			
			$this->$_GET ['task'] ();			
		}
	}
	public function getLink() {
		
		global $max_page;
		global $min_page;
		global $get_all_page;
		if ($get_all_page) {			
			// voi moi xpath
			//$_GET['page'];
			if ($_GET['xpath_id'] < Session::count ()) {
				
				// lay xpath hien tai														
				$url = Session::get_home_url ()[$_GET['xpath_id']];				
				if ($_GET['page'] < $max_page) {
					$url .=$_GET['page'];
					$data = curl_download ( $url, Session::get_cookie_name ()[$_GET['xpath_id']] );					
					$html = new simple_html_dom ();
					$html->load ( $data );
					$listA = get_xpath_node ( $html, Session::get_xpath_code ()[$_GET['xpath_id']] );
					if ($listA) {					
						//lay url
						foreach ( $listA as $i ) {							
							$_SESSION['link'][]['type']=$_GET['xpath_id'];
							$_SESSION['link'][]['url']=$i->href;
							echo $i->href."<br>";						
						}						
						$_GET['xpath_id']+=1;						
						
					} else {
						$_GET['xpath_id']+=1;
						$_GET['page']=1;
					}					
					$next = "WebScraper.php?task=getLink&page=".$_GET['page']."&xpath_id=".$_GET['xpath_id'];
					echo "<script>window.location='$next';</script>";
				}
				else 
				{
					
					//tach du lieu
				}
			}
		}
		
	}
	public function getData() {
	}
}
;

?>

