<?php

require_once  $_SERVER ["DOCUMENT_ROOT"].'/model/Model.php';
require_once $_SERVER ["DOCUMENT_ROOT"].'/lib/download.php';
require_once $_SERVER ["DOCUMENT_ROOT"].'/lib/connection.php';
require_once $_SERVER ["DOCUMENT_ROOT"].'/lib/simple_html_dom.php';
require_once $_SERVER ["DOCUMENT_ROOT"].'/lib/xpath.php';

class AdminController
{
	private $xpathModel;
	public function __construct()
	{
		$this->xpathModel = new XPathModel();
	}
	
	public function testHomePattern()
	{		
		if (isset ( $_POST ['txt_url'] ) && isset ( $_POST ['txt_xpath'] ) && isset ( $_POST ['txt_base'] )) {			
			$data = curl_download_old ( $_POST ['txt_url']);
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
		
	}
	
	public function testDetailPattern()
	{
		if (isset ( $_POST ['txt_url'] ) && isset ( $_POST ['txt_job'] ) && isset ( $_POST ['txt_company'] ) && isset ( $_POST ['txt_location'] ) && isset ( $_POST ['txt_description'] ) && isset ( $_POST ['txt_salary'] ) && isset ( $_POST ['txt_requirement'] ) && isset ( $_POST ['txt_benifit'] ) && isset ( $_POST ['txt_expired'] )) {
			$data = curl_download_old( $_POST ['txt_url'] );
		
			if ($data) {
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
			else
			{
				echo "<br>Can't connect!";
			}
		
		}
		
	}
	
	public function savePattern()
	{
		if (isset ( $_POST ['txt_page_url'] ) && isset ( $_POST ['txt_xpath_code'] ) && isset ( $_POST ['txt_job'] ) && isset ( $_POST ['txt_company'] ) && isset ( $_POST ['txt_location'] ) && isset ( $_POST ['txt_description'] ) && isset ( $_POST ['txt_salary'] ) && isset ( $_POST ['txt_requirement'] ) && isset ( $_POST ['txt_benifit'] ) && isset ( $_POST ['txt_tag'] )) {
			$model = new XPathModel();
			$ret = $model->save( $_POST ['txt_page_url'], $_POST ['txt_base_url'], $_POST ['txt_xpath_code'], $_POST ['txt_login_url'], $_POST ['txt_login_data'],$_POST ['txt_job'], $_POST ['txt_company'], $_POST ['txt_location'], $_POST ['txt_description'], $_POST ['txt_salary'], $_POST ['txt_requirement'], $_POST ['txt_benifit'], $_POST ['txt_expired'], $_POST ['txt_tag'] );
			if($ret)
			{
				echo "Done!";
			}
			else 
			{
				echo "Error!";	
			}
		}
	}
	
	public function getView()
	{
		require_once $_SERVER ["DOCUMENT_ROOT"].'/view/Admin.php';
	}
	
	public function control()
	{
		if(isset($_POST['func']))
		{			
			$this->$_POST['func']();
		}
		else 
		{
			$this->getView();			
		}
	}
	
	function getOldPattern()
	{
		if (isset ( $_POST ['txt_url'] )) {				
			
			$data = $this->xpathModel->get ( $_POST ['txt_url']  );
			if ($data->num_rows > 0) {
				$row = $data->fetch_assoc ();
				echo json_encode ( $row );
			} else
				echo "Khong co du lieu!";		
		}
		else
		{
			if (! isset ( $_POST ['txt_page_url'] )) echo "Chua nhap home url!";
		}
	}
	
	public function updatePattern()
	{
		
		if (isset ( $_POST ['txt_page_url'] ) && isset ( $_POST ['txt_xpath_code'] ) && isset ( $_POST ['txt_job'] ) && isset ( $_POST ['txt_company'] ) && isset ( $_POST ['txt_location'] ) && isset ( $_POST ['txt_description'] ) && isset ( $_POST ['txt_salary'] ) && isset ( $_POST ['txt_requirement'] ) && isset ( $_POST ['txt_benifit'] ) && isset ( $_POST ['txt_expired'] ) && isset ( $_POST ['txt_tag'] )) {
			
			$this->xpathModel->update( $_POST ['txt_page_url'], $_POST['txt_base_url'], $_POST ['txt_xpath_code'], $_POST['txt_login_url'], $_POST['txt_login_data'], $_POST ['txt_job'], $_POST ['txt_company'], $_POST ['txt_location'], $_POST ['txt_description'], $_POST ['txt_salary'], $_POST ['txt_requirement'], $_POST ['txt_benifit'], $_POST ['txt_expired'], $_POST ['txt_tag'] );
			echo "success";
			return true;
		}
		else
		{
			if (! isset ( $_POST ['txt_url'] )) echo "Thieu du lieu!";
			return false;
			
		}
		return false;
	}
}

?>