<?php
class XpathObject {
	public $xpath_code;
	public $job;
	public $company;
	public $location;
	public $description;
	public $salary_xpath;
	public $requirement;
	public $benifit;
	public $expired;
	public $tags;
	public function __construct() {
	}
}
require_once 'Lib/save_job.php';
if (isset ( $_POST ['txt_url'] )) {	
	
	get_Xpath_input ( $_POST ['txt_url'] );
	
} 
else 
{
	if (! isset ( $_POST ['txt_page_url'] )) echo "Chua nhap home url!";
}



function get_xpath_input($home_url) 
{
	$xpath = new XpathObject ();
	$data = get_xpath ( $home_url );
	if ($data->num_rows > 0) {
		$row = $data->fetch_assoc ();
		echo json_encode ( $row );
	} else
		echo "Khong co du lieu!";
}
