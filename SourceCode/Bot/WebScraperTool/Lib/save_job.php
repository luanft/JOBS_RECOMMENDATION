<?php

require_once '/Lib/connection.php';

function get_current_date_time()
{
	date_default_timezone_set('Asia/Ho_Chi_Minh');
 	return date("Y-m-d H:i:s");
	//return date("j-n-y");
}


function bot_save_job($title,$location,$salary,$description,$tag,$company_name,$company_sumary_id,$requirement,$benifit,$postdate,$source)
{
	$title = addslashes($title);
	$location = addslashes($location);
	$salary = addslashes($salary);
	$description = addslashes($description);
	$tag = addslashes($tag);
	$company_name = addslashes($company_name);
	$company_sumary_id = addslashes($company_sumary_id);
	$requirement = addslashes($requirement);
	$benifit = addslashes($benifit);
	$postdate = addslashes($postdate);
	$source = addslashes($source);
	$x = new Connection();
	$x->connect();
	$query = "INSERT INTO `job`(`Job_title`, `Location`, `Salary`, `Description`, `Tag`, `company_name`, `Company_sumary_id`, `Requirement`, `Benifit`, `Expired`, `Source`) VALUES ('$title','$location','$salary','$description','$tag','$company_name',$company_sumary_id,'$requirement','$benifit','$postdate','$source')";
	$result = $x->write($query);
	
	if(!$result)
		die($query);
	$x->close();
	return $result;
}

function save_xpath($home_url, $base_url, $xpath_code, $job_xpath, $company_xpath, $location_xpath, $description_xpath, $salary_xpath,
		 $requirement_xpath, $benifit_xpath, $expired_xpath, $tags_xpath)
{			
	$home_url = addslashes($home_url);
	$base_url = addslashes($base_url);
	$xpath_code = addslashes($xpath_code);
	$job_xpath = addslashes($job_xpath);
	$company_xpath = addslashes($company_xpath);
	$location_xpath = addslashes($location_xpath);
	$description_xpath = addslashes($description_xpath);
	$salary_xpath = addslashes($salary_xpath);
	$requirement_xpath = addslashes($requirement_xpath);
	$benifit_xpath = addslashes($benifit_xpath);
	$expired_xpath = addslashes($expired_xpath);
	$tags_xpath = addslashes($tags_xpath);
	$x = new Connection();
	$x->connect();
	$x->write("INSERT INTO `job_xpath` VALUES ('$home_url','$base_url','$xpath_code','$job_xpath','$company_xpath','$location_xpath','$description_xpath','$salary_xpath','$requirement_xpath','$benifit_xpath', '$expired_xpath', '$tags_xpath')");
	$x->close();
}
function get_xpath($home_url)
{
	$x = new Connection();
	$x->connect();
	$data = $x->read("SELECT  home_url,xpath_code,job_xpath,
    company_xpath,
    location_xpath,
    description_xpath,
    salary_xpath,
    requirement_xpath,
    benifit_xpath,
    expired_xpath,
    tags_xpath from job_xpath where home_url='".$home_url."'");
	$x->close();
	return $data;
}
function get_all_xpaths()
{
	$x = new Connection();
	$x->connect();
	$data = $x->read("SELECT * from job_xpath");
	$x->close();
	return $data;
}
function update_xpath($page_url, $xpath_code, $job, $company, $location,$decription, $salary, $requirement, $benifit, $exprired, $tags)
{
	$x = new Connection();
	$x->connect();
	$sql="Update job_xpath set
			xpath_code='".$xpath_code."',
			job_xpath='".$job."',
    		company_xpath='".$company."',
    		location_xpath='".$location."',
    		description_xpath='".$decription."',
    salary_xpath='".$salary."',
    requirement_xpath='".$requirement."',
    benifit_xpath='".$benifit."',
    expired_xpath='".$exprired."',
    tags_xpath='".$tags."' where home_url='".$page_url."'";
	//echo $sql;
	$x->write($sql);

	$x->close();
}



?>
