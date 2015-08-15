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


<head>
<script src="lib/jquery-2.1.4.min.js"></script>
</head>




<body>
	<script type="text/javascript">
$(document).ready(function(){

	$("#test_main").show();
	$("#test_content").hide();
	$("#edit_pattern").hide();
	$("#save_pattern").hide();
	$("#update_pattern").hide();
	
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



		//copy du lieu
		var d_url = $.trim($('#gl_url').val());
    	var d_xpath = $.trim($('#gl_xpath').val());
    	var d_base = $.trim($('#gl_base_url').val());		    
	    var d_job = $.trim($('#gd_job').val());
	    var d_company = $.trim($('#gd_company').val());
	    var d_location = $.trim($('#gd_location').val());
	    var d_description = $.trim($('#gd_description').val());
	    var d_salary = $.trim($('#gd_salary').val());
	    var d_requirement = $.trim($('#gd_requirement').val());
	    var d_benifit = $.trim($('#gd_benifit').val());
	    var d_expired = $.trim($('#gd_expired').val());
	    var d_tag = $.trim($('#gd_tag').val());	    				
		//kiem tra du lieu
	    if($.trim($('#save_xpath_url').val())=="")
	    {
			$('#save_xpath_url').val(d_url);
		    $('#save_xpath_base_url').val(d_base);
		    $('#save_xpath_code').val(d_xpath);
		    $('#save_xpath_job').val(d_job);
		    $('#save_xpath_company').val(d_company);
		    $('#save_xpath_location').val(d_location);
		    $('#save_xpath_description').val(d_description);
		    $('#save_xpath_salary').val(d_salary);
		    $('#save_xpath_requirement').val(d_requirement);
		    $('#save_xpath_benifit').val(d_benifit);
		    $('#save_xpath_expired').val(d_expired);
		    $('#save_xpath_tag').val(d_tag);
		}
		}); 



	//test home
	$('#form_get_link').submit(function () {
		
		$("#div_result").html("Processing...");
	    // Get the Login Name value and trim it
	    var url = $.trim($('#gl_url').val());
	    var xpath = $.trim($('#gl_xpath').val());
	    var base = $.trim($('#gl_base_url').val());
	    
	    $.post("AdminTool.php",{func:"testHomePattern",txt_url:url, txt_xpath:xpath,txt_base:base},function(data,status){
	    	$("#div_result").html(data);
		    });
	    return false;	    
	});



	$('#form_get_detail').submit(function () {

		$("#div_result").html('Processing...');
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
	    	    	    	    	    	  
	    $.post("AdminTool.php",{func:"testDetailPattern",txt_url:url, txt_job:job,txt_company:company,txt_location:location,txt_description:description,txt_salary:salary,txt_requirement:requirement,txt_benifit:benifit,txt_expired:expired,txt_tag:tag},function(data,status){
	    	$("#div_result").html(data);
		    });
	    
	    return false;	    
	});



	






	//form save xpath
		$('#form_save_xpath').submit(function () {
			//lay gia tri cua xpath
			var page_url = $.trim($('#save_xpath_url').val());
		    var base_url = $.trim($('#save_xpath_base_url').val());
		    var xpath_code = $.trim($('#save_xpath_code').val());
		    var login_url = $.trim($('#save_login_url').val());
		    var login_data = $.trim($('#save_login_data').val());
		    var job = $.trim($('#save_xpath_job').val());
		    var company = $.trim($('#save_xpath_company').val());
		    var location = $.trim($('#save_xpath_location').val());
		    var description = $.trim($('#save_xpath_description').val());
		    var salary = $.trim($('#save_xpath_salary').val());
		    var requirement = $.trim($('#save_xpath_requirement').val());
		    var benifit = $.trim($('#save_xpath_benifit').val());
		    var expired = $.trim($('#save_xpath_expired').val());
		    var tag = $.trim($('#save_xpath_tag').val());		    
		    	    	    	    	    	  
		    $.post("AdminTool.php",{func:"savePattern",txt_page_url:page_url,txt_base_url:base_url,txt_xpath_code:xpath_code, txt_login_url:login_url, txt_login_data:login_data, txt_job:job,txt_company:company,txt_location:location,txt_description:description,txt_salary:salary,txt_requirement:requirement,txt_benifit:benifit,txt_expired:expired,txt_tag:tag},function(data,status){
		    	$("#div_result").html(data);
			});
		    
		    return false;	    
		});
		
	//form update xpath
	$('#form_update_xpath').submit(function () {
		$('#update_pattern').hide();
	 		var page_url = $.trim($('#ed_xpath_url').val());
	 		var base_url = $.trim($('#ed_xpath_base_url').val());
	 	    var xpath_code = $.trim($('#ed_xpath_code').val());
	 	   var login_url = $.trim($('#ed_login_url').val());
	 	  var login_data = $.trim($('#ed_login_data').val());
	 	    var job = $.trim($('#ed_xpath_job').val());
			var company = $.trim($('#ed_xpath_company').val());
	 	    var location = $.trim($('#ed_xpath_location').val());
	 	    var description = $.trim($('#ed_xpath_description').val());
	 	    var salary = $.trim($('#ed_xpath_salary').val());
	 	    var requirement = $.trim($('#ed_xpath_requirement').val());
	 	    var benifit = $.trim($('#ed_xpath_benifit').val());
	 	    var expired = $.trim($('#ed_xpath_expired').val());
	 	    var tag = $.trim($('#ed_xpath_tag').val());
	 	   $.post("AdminTool.php",{func:"updatePattern",txt_page_url:page_url,txt_base_url:base_url,txt_xpath_code:xpath_code, txt_login_url:login_url, txt_login_data:login_data,txt_job:job,txt_company:company,txt_location:location,txt_description:description,txt_salary:salary,txt_requirement:requirement,txt_benifit:benifit,txt_expired:expired,txt_tag:tag},function(data){
		    	$("#div_result").html(data);

		    			    });
		    return false;	    
		});
	//form edit xpath
	$('#form_edit_xpath').submit(function () {
		
		var home_url= $.trim($('#ed_home_url').val());
		$('#update_pattern').show();
	    $.post("AdminTool.php",{func:"getOldPattern",txt_url:home_url},
	    	function(data)
	  		{
	    	$("#div_result").html('Done!');
	    	var obj = JSON.parse(data);
	    	$('#ed_xpath_url').val(obj.home_url);
	    	$('#ed_xpath_base_url').val(obj.base_url);
	    	$('#ed_xpath_code').val(obj.xpath_code);
	    	$('#ed_login_url').val(obj.login_url);
	    	$('#ed_login_data').val(obj.login_data);
	    	$('#ed_xpath_job').val(obj.job_xpath);
	    	$('#ed_xpath_company').val(obj.company_xpath);
	    	$('#ed_xpath_location').val(obj.location_xpath);
	    	$('#ed_xpath_description').val(obj.description_xpath);
	    	$('#ed_xpath_salary').val(obj.salary_xpath);
	    	$('#ed_xpath_requirement').val(obj.requirement_xpath);
	    	$('#ed_xpath_benifit').val(obj.benifit_xpath);
	    	$('#ed_xpath_expired').val(obj.expired_xpath);
	    	$('#ed_xpath_tag').val(obj.tags_xpath);
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
			<h3>Last Posts:</h3>
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
					<h3>Page url</h3>
					<input id="gl_url" type="text" name="txt_gl_url">
					<h3>Base url</h3>
					<input id="gl_base_url" type="text" name="txt_gl_base">
					<h3>Xpath code</h3>
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
					<h3>Page url</h3>
					<input id="gd_url" type="text">
					<h3>Job</h3>
					<input id="gd_job" type="text">
					<h3>Company</h3>
					<input id="gd_company" type="text">
					<h3>Location</h3>
					<input id="gd_location" type="text">
					<h3>Description</h3>
					<input id="gd_description" type="text">
					<h3>Salary</h3>
					<input id="gd_salary" type="text">
					<h3>Requirement</h3>
					<input id="gd_requirement" type="text">
					<h3>Benifit</h3>
					<input id="gd_benifit" type="text">
					<h3>Expired</h3>
					<input id="gd_expired" type="text">
					<h3>Tags</h3>
					<input id="gd_tag" type="text"> <input type="submit"
						name="btn_test_2" value="Test pattern">
				</form>

			</div>

			<!-- Edit XPath-->
			<div id="edit_pattern">
				<h2>Edit Page</h2>
				<form action="" method="" id="form_edit_xpath">

					<h3>Home Url</h3>
					<input id="ed_home_url" " type="text"> <input type="submit"
						name="btn_edit" value="Edit XPath">
				</form>

			</div>
			<!-- Update XPath-->
			<div id="update_pattern">
				<h2>Update xpath</h2>

				<form action="" method="POST" id="form_update_xpath">
					<h3>Page url</h3>
					<input id="ed_xpath_url" type="text">
					<h3>Base url</h3>
					<input id="ed_xpath_base_url" type="text">
					<h3>xpath code</h3>
					<input id="ed_xpath_code" type="text">
					<h3>Login path</h3>
					<input id="ed_login_url" type="text">
					<h3>Login data</h3>
					<input id="ed_login_data" type="text">
					<h3>Job</h3>
					<input id="ed_xpath_job" type="text">
					<h3>Company</h3>
					<input id="ed_xpath_company" type="text">
					<h3>Location</h3>
					<input id="ed_xpath_location" type="text">
					<h3>Description</h3>
					<input id="ed_xpath_description" type="text">
					<h3>Salary</h3>
					<input id="ed_xpath_salary" type="text">
					<h3>Requirement</h3>
					<input id="ed_xpath_requirement" type="text">
					<h3>Benifit</h3>
					<input id="ed_xpath_benifit" type="text">
					<h3>Expired</h3>
					<input id="ed_xpath_expired" type="text">
					<h3>Tags</h3>
					<input id="ed_xpath_tag" type="text"> <input type="submit"
						name="btn_test_2" value="Update">
				</form>
			</div>

			<!-- DĂ¹ng Ä‘á»ƒ save -->
			<div id="save_pattern">
				<h2>Save xpath</h2>
				<form action="" method="POST" id="form_save_xpath">
					<h3>Page url</h3>
					<input id="save_xpath_url" type="text">
					<h3>Base url</h3>
					<input id="save_xpath_base_url" type="text">
					<h3>xpath code</h3>
					<input id="save_xpath_code" type="text">
					<h3>Login path</h3>
					<input id="save_login_url" type="text">
					<h3>Login data</h3>
					<input id="save_login_data" type="text">
					<h3>Job</h3>
					<input id="save_xpath_job" type="text">
					<h3>Company</h3>
					<input id="save_xpath_company" type="text">
					<h3>Location</h3>
					<input id="save_xpath_location" type="text">
					<h3>Description</h3>
					<input id="save_xpath_description" type="text">
					<h3>Salary</h3>
					<input id="save_xpath_salary" type="text">
					<h3>Requirement</h3>
					<input id="save_xpath_requirement" type="text">
					<h3>Benifit</h3>
					<input id="save_xpath_benifit" type="text">
					<h3>Expired</h3>
					<input id="save_xpath_expired" type="text">
					<h3>Tags</h3>
					<input id="save_xpath_tag" type="text"> <input type="submit"
						name="btn_test_2" value="Save">
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
