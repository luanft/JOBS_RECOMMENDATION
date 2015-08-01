<?php

require_once '/Lib/connection.php';

function get_current_date_time()
{
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	return date("Y-m-d H:i:s");
}


function bot_save_job($title,$location,$salary,$description,$tag,$company_name,$company_sumary_id,$requirement,$benifit,$postdate,$source)
{
	$x = new Connection();
	$x->connect();
	$x->write("INSERT INTO `job`(`Job_title`, `Location`, `Salary`, `Description`, `Tag`, `company_name`, `Company_sumary_id`, `Requirement`, `Benifit`, `Expired`, `Source`) VALUES ('addslashes($title)','addslashes($location)','addslashes($salary)','addslashes($description)','addslashes($tag)','addslashes($company_name)',addslashes($company_sumary_id),'addslashes($requirement)','addslashes($benifit)','addslashes($postdate)','addslashes($source)')");
	$x->close();
}

function save_xpath($home_url, $base_url, $xpath_code, $job_xpath, $company_xpath, $location_xpath, $description_xpath, $salary_xpath, $requirement_xpath, $benifit_xpath, $expired_xpath, $tags_xpath)
{			
	$x = new Connection();
	$x->connect();
	$x->write("INSERT INTO `job_xpath` VALUES ('$home_url','$base_url','$xpath_code','$job_xpath','$company_xpath','$location_xpath','$description_xpath','$salary_xpath','$requirement_xpath','$benifit_xpath', '$expired_xpath', '$tags_xpath')");
	$x->close();
}




?>
