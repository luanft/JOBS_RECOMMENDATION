<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/session.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/model/config.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/download.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/xpath.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/simple_html_dom.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/model/Model.php';
class WebScraperController {
	private $jobModel;
	public function __construct() {
		$this->jobModel = new JobModel ();
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
		if (! $get_all_page) {
			$max_page = $min_page;
		}
		// voi moi xpath
		if ($_GET ['xpath_id'] < Session::count ()) {
			// lay xpath hien tai
			$url = Session::get_home_url ()[$_GET ['xpath_id']];
			$next_page = 0;
			$next_xpath = $_GET ['xpath_id'];
			if ($_GET ['page'] < $max_page) {
				$url .= $_GET ['page'];
				$data = curl_download_old ( $url );
				$html = new simple_html_dom ();
				$html->load ( $data );
				$listA = get_xpath_node ( $html, Session::get_xpath_code ()[$_GET ['xpath_id']] );
				if ($listA) {
					// lay url
					foreach ( $listA as $i ) {
						$link = array ();
						$link ['type'] = $_GET ['xpath_id'];
						$link ['url'] = Session::get_base_url ()[$_GET ['xpath_id']] . $i->href;
						$_SESSION ['link'] [] = $link;
						echo Session::get_base_url ()[$_GET ['xpath_id']] . $i->href . "<br>";
					}
					$next_page = $_GET ['page'] + 1;
				} else {
					$next_xpath = $_GET ['xpath_id'] + 1;
					$next_page = 1;
				}
				$next = "WebScraper.php?task=getLink&page=" . $next_page . "&xpath_id=" . $next_xpath;
				echo "<script>window.location =\"$next\";</script>";
				exit ();
			} else {
				// tach du lieu
				$_SESSION ['total_url'] = count ( $_SESSION ['link'] );
				$next = "WebScraper.php?task=getData&page=0";
				echo "<script>window.location =\"$next\";</script>";
			}
		}
	}
	public function getData() {
		if (isset ( $_GET ['page'] )) {
			$url = $_SESSION ['link'] [$_GET ['page']] ['url'];
			
			$type = $_SESSION ['link'] [$_GET ['page']] ['type'];
			
			$data = curl_download ( $url, Session::get_cookie_name ()[$type] );
			if ($data != '') {				
				// $data = curl_download_old ($url);
				libxml_use_internal_errors ( true );
				$xx = new DOMDocument ();
				$xx->loadHTML ( $data );
				$xp = new DOMXPath ( $xx );
				
				$djob = trim ( lay_du_lieu ( $xp, Session::get_job_xpath ()[$type]) );
				$dcompany = trim ( lay_du_lieu ( $xp, Session::get_company_xpath ()[$type] ) );
				$dlocation = trim ( lay_du_lieu ( $xp, Session::get_location_xpath ()[$type]) );
				$ddes = trim ( lay_du_lieu ( $xp, Session::get_description_xpath ()[$type]) );
				$dsalary = trim ( lay_du_lieu ( $xp, Session::get_salary_xpath ()[$type]) );
				$drequirement = trim ( lay_du_lieu ( $xp, Session::get_requirement_xpath ()[$type]) );
				$dbenifit = trim ( lay_du_lieu ( $xp, Session::get_benifit_xpath ()[$type]) );
				$dexpired = trim ( lay_du_lieu ( $xp, Session::get_expired_xpath ()[$type]) );
				if ($dexpired == '')
					$dexpired = date ( "m" ) + 1 . "-" . date ( "d" ) . "-" . date ( "Y" );
				$dd = get_nodes_list ( $xp, Session::get_tags_xpath ()[$type] )->item ( 0 );
				if ($djob != '') {
					echo "Completed: " . $_GET ['page'] . '/' . $_SESSION ['total_url'] . "<br><br>";
					echo "Url :" . $_SESSION ['link'] [$_GET ['page']] ['url'] . "<br><br>";
					echo "Job :" . $djob . "<br><br>";
					echo "Company :" . $dcompany . "<br><br>";
					echo "Location :" . $dlocation . "<br><br>";
					echo "Description :" . $ddes . "<br><br>";
					echo "Salary :" . $dsalary . "<br><br>";
					echo "Requirement :" . $drequirement . "<br><br>";
					echo "Benifit :" . $dbenifit . "<br><br>";
					echo "Expired :" . $dexpired . "<br><br>";
					$dtag = "";
					if ($dd->hasChildNodes ()) {
						for($i = 0; $i < $dd->childNodes->length; $i ++) {
							$tg = $dd->childNodes->item ( $i )->nodeValue;
							if (trim ( $tg ))
								$dtag .= $tg . "|";
						}
					}
					echo "Tag :" . $dtag . "<br><br>";
					$source = $_SESSION ['link'] [$_GET ['page']] ['url'];
					if (! $this->jobModel->isExist ( $source )) {
						// $ret = $this->jobModel->AddNewJob("1", $djob, $dlocation, $dsalary, $ddes, $dcompany, $dtag, $drequirement, $dbenifit, $dexpired, $source);
					} else {
						echo "Exist";
					}
				}
			}
			else
			{
				echo "Completed: " . $_GET ['page'] . '/' . $_SESSION ['total_url'] . "<br><br>";
				echo "Url :" . $_SESSION ['link'] [$_GET ['page']] ['url'] . "<br><br>";
				echo "Empty page!";
			}
			if ($_SESSION ['total_url'] > $_GET ['page']) {
				$next = "WebScraper.php?task=getData&page=" . ($_GET ['page'] + 1);
				echo "<script>window.location =\"$next\";</script>";
				exit ();
			} else {
				session_unset ();
				echo "Done!";
			}
		}
	}
}
;

?>

