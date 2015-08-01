<?php
header ( 'Content-Type: text/html; charset=utf-8' );

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin page</title>
<meta http-equiv="Content-Language" content="German" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/style.css"
	media="screen" />
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed'
	rel='stylesheet' type='text/css' />
<script language="javascript" src="ckeditor/ckeditor.js"
	type="text/javascript"></script>


<head>
<script src="Lib/jquery-2.1.4.min.js"></script>
</head>




<body>
	<script type="text/javascript">
$(document).ready(function(){

	$("#test_main").show();
	$("#test_content").hide();
	$("#edit_pattern").hide();
	$("#save_pattern").hide();
	
	$("#menu_main").click(function(){
		$("#test_main").show();
		$("#test_content").hide();
		$("#edit_pattern").hide();
		$("#save_pattern").hide();
		}); 

	$("#menu_detail").click(function(){
		$("#test_main").hide();
		$("#test_content").show();
		$("#edit_pattern").hide();
		$("#save_pattern").hide();
		}); 


	$("#menu_edit").click(function(){
		$("#test_main").hide();
		$("#test_content").hide();
		$("#edit_pattern").show();
		$("#save_pattern").hide();
		}); 

	$("#menu_save").click(function(){
		$("#test_main").hide();
		$("#test_content").hide();
		$("#edit_pattern").hide();
		$("#save_pattern").show();
		}); 


	
//test home
	$('#form_get_link').submit(function () {

		$("#div_result").html('Ä�ang xá»­ lĂ½');
	    // Get the Login Name value and trim it
	    var url = $.trim($('#gl_url').val());
	    var xpath = $.trim($('#gl_xpath').val());
	    var base = $.trim($('#gl_base_url').val());
	    	    
	    $.post("tool.php",{txt_url:url, txt_xpath:xpath,txt_base:base},function(data,status){
	    	$("#div_result").html(data);
		    });
	    return false;	    
	});



	$('#form_get_detail').submit(function () {

		$("#div_result").html('Ä�ang xá»­ lĂ½');
		
	    var url = $.trim($('#gd_url').val());
	    var job = $.trim($('#gd_job').val());
	    var company = $.trim($('#gd_company').val());
	    var location = $.trim($('#gd_location').val());
	    var description = $.trim($('#gd_description').val());
	    var salary = $.trim($('#gd_salary').val());
	    var requirement = $.trim($('#gd_requirement').val());
	    var benifit = $.trim($('#gd_benifit').val());
	    var expired = $.trim($('#gd_expired').val());
	    var tag = $.trim($('#gd_tag').val());
	    	    	    	    	    	  
	    $.post("tool.php",{txt_url:url, txt_job:job,txt_company:company,txt_location:location,txt_description:description,txt_salary:salary,txt_requirement:requirement,txt_benifit:benifit,txt_expired:expired,txt_tag:tag},function(data,status){
	    	$("#div_result").html(data);
		    });
	    
	    return false;	    
	});

//form save xpath
	$('#form_save_xpath').submit(function () {

		$("#div_result").html('Ä�ang xá»­ lĂ½');
		var page_url = $.trim($('#save_xpath_url').val());
	    var base_url = $.trim($('#save_xpath_base_url').val());
	    var xpath_code = $.trim($('#save_xpath_code').val());
	    var job = $.trim($('#save_xpath_job').val());
	    var company = $.trim($('#save_xpath_company').val());
	    var location = $.trim($('#save_xpath_location').val());
	    var description = $.trim($('#save_xpath_description').val());
	    var salary = $.trim($('#save_xpath_salary').val());
	    var requirement = $.trim($('#save_xpath_requirement').val());
	    var benifit = $.trim($('#save_xpath_benifit').val());
	    var expired = $.trim($('#save_xpath_expired').val());
	    var tag = $.trim($('#save_xpath_tag').val());
	    	    	    	    	    	  
	    $.post("tool.php",{txt_page_url:page_url,txt_base_url:base_url,txt_xpath_code:xpath_code, txt_job:job,txt_company:company,txt_location:location,txt_description:description,txt_salary:salary,txt_requirement:requirement,txt_benifit:benifit,txt_expired:expired,txt_tag:tag},function(data,status){
	    	$("#div_result").html(data);
		    });
	    
	    return false;	    
	});
	

	}); 
</script>
	<div id="wrap">
		<div id="header">
			<div id="headerlinks">
				<a href="#" title="Portfolio">Portfolio</a> <a href="#" title="Blog">Blog</a>
				<a href="#" title="About Us">About Us</a> <a href="#"
					title="Contact">Contact</a>
			</div>
			<h1>
				<a>Admin page</a>
			</h1>
		</div>

		<div id="sidebar">
			<h2>Last Posts:</h2>
			<div class="box">
				<ul>
					<li><a id="menu_main" href="#">Main pattern</a></li>
					<li><a id="menu_detail" href="#">Detail pattern</a></li>
					<li><a id="menu_edit" href="#">Edit pattern</a></li>
					<li><a id="menu_save" href="#">Save pattern</a></li>
				</ul>
			</div>
		</div>

		<div id="content">
			<!-- DĂ¹ng Ä‘á»ƒ test pattern láº¥y link
			cac bien bat dau == gl(get link)
			 -->
			<div id="test_main">
				<h2>Get link</h2>
				<p>
				
				
				<form action="" method="" id="form_get_link">
					<h2>Page url</h2>
					<input id="gl_url" type="text" name="txt_gl_url">
					<h2>Base url</h2>
					<input id="gl_base_url" type="text" name="txt_gl_base">
					<h2>Xpath code</h2>
					<input id="gl_xpath" type="text" name="txt_gl_xpath"> <input
						type="submit" name="btn_test" value="Test pattern">
				</form>
				</p>
				<p></p>
			</div>


			<!-- DĂ¹ng Ä‘á»ƒ test pattern láº¥y ná»™i dung 
			bien bat dau bang gd get detail
			-->
			<div id="test_content">
				<h2>Get detail</h2>
				<form action="" method="" id="form_get_detail">
					<h2>Page url</h2>
					<input id="gd_url" type="text">
					<h2>Job</h2>
					<input id="gd_job" type="text">
					<h2>Company</h2>
					<input id="gd_company" type="text">
					<h2>Location</h2>
					<input id="gd_location" type="text">
					<h2>Description</h2>
					<input id="gd_description" type="text">
					<h2>Salary</h2>
					<input id="gd_salary" type="text">
					<h2>Requirement</h2>
					<input id="gd_requirement" type="text">
					<h2>Benifit</h2>
					<input id="gd_benifit" type="text">
					<h2>Expired</h2>
					<input id="gd_expired" type="text">
					<h2>Tags</h2>
					<input id="gd_tag" type="text"> <input type="submit"
						name="btn_test_2" value="Test pattern">
				</form>

			</div>

			<!-- DĂ¹ng Ä‘á»ƒ edit -->
			<div id="edit_pattern">edit</div>

			<!-- DĂ¹ng Ä‘á»ƒ save -->
			<div id="save_pattern">
				<h1>Save xpath</h1>
				<form action="" method="POST" id="form_save_xpath">
					<h2>Page url</h2>
					<input id="save_xpath_url" type="text">
					<h2>Base url</h2>
					<input id="save_xpath_base_url" type="text">
					<h2>xpath code</h2>
					<input id="save_xpath_code" type="text">
					<h2>Job</h2>
					<input id="save_xpath_job" type="text">
					<h2>Company</h2>
					<input id="save_xpath_company" type="text">
					<h2>Location</h2>
					<input id="save_xpath_location" type="text">
					<h2>Description</h2>
					<input id="save_xpath_description" type="text">
					<h2>Salary</h2>
					<input id="save_xpath_salary" type="text">
					<h2>Requirement</h2>
					<input id="save_xpath_requirement" type="text">
					<h2>Benifit</h2>
					<input id="save_xpath_benifit" type="text">
					<h2>Expired</h2>
					<input id="save_xpath_expired" type="text">
					<h2>Tags</h2>
					<input id="save_xpath_tag" type="text"> <input type="submit"
						name="btn_test_2" value="Test pattern">
				</form>
			</div>

			<!-- result -->
			<h2>Result:</h2>
			<div id="div_result"></div>

		</div>


		<div id="footer">
			<div style="float: right;">
				<a href="#" title="Contact Us"><img src="img/contact.gif"
					alt="Contact" /></a> <a href="#" title="Sitemap"><img
					src="img/sitemap.gif" alt="Sitemap" /></a> <a href="#"
					title="Rss Feed"><img src="img/rss.png" alt="Rss Feed" /></a>
			</div>
			Theme #4 &copy; 2013 |
			<!-- You can use it for practically any personal or commercial use so long as you keep our footer credit links intact. -->
			Theme by <a target="_blank" href="http://codingdev.de"
				title="CodingDev">CodingDev</a>
		</div>
	</div>
</body>
</html>
