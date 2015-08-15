<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/xpath.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/model/Model.php ';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/model/config.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/session.php';
//--------------------------------------
// WRITE LOG WHEN DETECT WRONG XPATH
//---------------------------------------
// main_page
// case 1: not have any links =>wrong home page xpath
// case 2: link haven't data (<10% data) =>wrong home page xpath
// detail_page
// case 2: 30% data null =>wrong detail page xpath
// case 3: have data, but wrong data =>wrong detail page xpath
// can't solve (but something can help to defect. For example: data too long,
define("MAX_NUM_PAGE", 1);
define("MAX_WRONG_LINK", 0.1);
define("MAX_WRONG_DATA",0.1);
class TestGUI
{
	private $xpathModel;
	private $log;
	public function __construct()
	{
		$this->xpathModel= new XPathModel();
		$this->log = new LogJobModel();
		
	}
	public function control()
	{
		if (isset ( $_GET ['task'] )) {
			$this->$_GET ['task'] ();
		}
		
	}

	public function testLink()
	{
		global $test_max_page;
		
		if ($_GET ['xpath_id'] < Session::count ()) {
			
			// lay xpath hien tai
			$url = Session::get_home_url ()[$_GET ['xpath_id']];
			$next_page = 1;
			$next_xpath = $_GET ['xpath_id'];
			
			if ($_GET ['page'] <= $test_max_page) {
				
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
						// number of links of the website $next_xpath
						//for example, itviet.com have 40 links, 40 is the number I refer to.
						$_SESSION['num_link'][$_GET ['xpath_id']]++;
						echo Session::get_base_url ()[$_GET ['xpath_id']] . $i->href . "<br>";
					}
					
				} else {
					
					//echo $url. " page don't have links <br>";
					sleep(1);
					//Case 1
					$this->log->write_log($url, "page ".$_GET['page']." don't have links");
	
				}
				//dữ liệu trang null=>bỏ qua, tiếp trang mới. 
				$next_page = $_GET ['page'] + 1;
				
			}
			//đã duyệt hết 3 page của 1 website 
			else {
				$next_xpath = $_GET ['xpath_id'] + 1;
				$next_page = 1;	
				//echo $_SESSION['num_link'][$_GET ['xpath_id']];
				//die("AAAA");
				//sleep(10);			
			}
			//xong hết một page
			$next = "TestGUI.php?task=testLink&page=" . $next_page . "&xpath_id=" . $next_xpath;
			echo "<script>window.location =\"$next\";</script>";
			exit ();
		}
		//xong hết các page của 1 website
		else{
			//die("xong main");
			//tach du lieu
			$_SESSION ['total_url'] = count ( $_SESSION ['link'] );
			
			//nếu có link công việc
			if($_SESSION['total_url']){
			$next = "TestGUI.php?task=testData&page=0";
			echo "<script>window.location =\"$next\";</script>";
			}
			else {
				echo"nothing to do";
			}
		}
	}
	public function testData()
	{
		
		if (isset ( $_GET ['page'] )) {
			//link của mỗi trang job, lấy thuộc tính url của session link ở page 0
			$url = $_SESSION ['link'] [$_GET ['page']] ['url'];
				
			$type = $_SESSION ['link'] [$_GET ['page']] ['type'];
			//trang ko can dang nhap download dc NULL
			$data = curl_download_old ( $url, Session::get_cookie_name ()[$type] );
			if ($data != '') {
				
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
				$i=0;
				if ($djob!= '' ) {
					
					echo "Completed: " . $_GET ['page'] . '/' . $_SESSION ['total_url'] . "<br><br>";
					echo "Url :" . $_SESSION ['link'] [$_GET ['page']] ['url'] . "<br><br>";
					echo "Job :" . $djob . "<br><br>";
				}
				//count data null
				if($djob=='')$i++;
				if($dcompany=='')$i++;
				if($dlocation=='')$i++;
				if($ddes=='')$i++;
				if($dsalary=='')$i++;
				if($dbenifit=='')$i++;
				if(!$dd)$i++;
				if($drequirement=='')$i++;
				if($dexpired=='')$i++;
				
				if($i>=7){
					
					$_SESSION['wrong_link']++;
					//echo "wrong links: ".$_SESSION['wrong_link'];
					//die("AAAA");
					
				}
				//4-6/9 data null=> fail xpath
				if($i>3 && $i<7)
				{
					//echo "wrong job: ".$url;
					$this->log->write_log($url, "wrong detail xpath");
				}
				
			}
			//link not exist
			else
			{
				$_SESSION['wrong_link']++;
				//echo "wrong links: ".$_SESSION['wrong_link'];
			}
			//finished a job
			if ($_GET ['page']+1<$_SESSION['total_url']) {
					
				$next = "TestGUI.php?task=testData&page=" . ($_GET ['page'] + 1);
				echo "<script>window.location =\"$next\";</script>";
					
				exit ();
				//there're no jobs else
			}
			// finished all links of a website
			if($_GET['page']+1==($type+1)*$_SESSION['num_link'][$type]){
				//case 3: links exist, but no data
					
					//case 2: link not exist
					if($_SESSION['wrong_link']/$_SESSION['total_url']>MAX_WRONG_LINK){
						$this->log->write_log($this->getUrl($url),"too much wrong links, ".($_SESSION['wrong_link']/$_SESSION['total_url']*100)." %");
						
					}
			}		
			
				
		}
		else{
			session_unset ();
			echo "Done!";
		}

	}
	public function getUrl($detail_url){
		$end_pos= strpos($detail_url,'/',8);
		return substr($detail_url, 0,$end_pos); 		
	}
	public function showLog()
	{
		$table= $this->log->get_log();
		foreach ($table as $row){
			echo $row['EvenTime']." ".$row['PageUrl']." ".$row['Error']."<br>";
		}
	}
	public function updateLog($EvenTime)
	{
		$this->log->updateChecked($EvenTime);
	}
	
}
?>