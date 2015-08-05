<?php
class XpathObject
{
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
	public function __construct()
	{

	}

}
require_once 'Lib/save_job.php';
if(isset($_POST['txt_url']))
{
	
	get_Xpath_input($_POST['txt_url']);
}
else 
{
	if(!isset($_POST['txt_page_url']))
		echo "Chua nhap home url!";
}
if(isset($_POST['txt_page_url']) && isset($_POST['txt_xpath_code']) &&isset($_POST['txt_job'])&&
		isset($_POST['txt_company']) && isset($_POST['txt_location']) &&isset($_POST['txt_description'])
		&&isset($_POST['txt_salary'])&&isset($_POST['txt_requirement'])&&isset($_POST['txt_benifit'])
		&&isset($_POST['txt_expired'])&&isset($_POST['txt_tag']))
{
	update_xpath($_POST['txt_page_url'], $_POST['txt_xpath_code'],
			 $_POST['txt_job'], $_POST['txt_company'], 
			$_POST['txt_location'], $_POST['txt_description'],
			 $_POST['txt_salary'], $_POST['txt_requirement'], 
			$_POST['txt_benifit'], $_POST['txt_expired'],
			 $_POST['txt_tag']);
	echo "success";
}
else{
if(!isset($_POST['txt_url']))
	echo "Thieu du lieu!";
	
}
function get_xpath_input($home_url)
{
	$xpath= new XpathObject();
	$data= get_xpath($home_url);
		if($data->num_rows>0)
		{
			$row= $data->fetch_assoc();
			echo json_encode($row);
		}
		else
			echo"Khong co du lieu!";
}
