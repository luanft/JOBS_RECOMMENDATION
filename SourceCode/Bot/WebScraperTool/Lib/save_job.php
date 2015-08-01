<?php

require_once '../Lib/connection.php';

function get_current_date_time()
{
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	return date("Y-m-d H:i:s");
}


function bot_save_job($title,$location,$salary,$description,$tag,$company_sumary_id,$requirement,$benifit,$postdate,$source)
{
	$x = new Connection();
	$x->connect();
	$x->write("INSERT INTO `job`(`Job_title`, `Location`, `Salary`, `Description`, `Tag`, `Company_sumary_id`, `Requirement`, `Benifit`, `Post_date`, `Source`) VALUES ('$title','$location','$salary','$description','$tag',$company_sumary_id,'$requirement','$benifit','$postdate','$source')");
	$x->close();
}






?>
