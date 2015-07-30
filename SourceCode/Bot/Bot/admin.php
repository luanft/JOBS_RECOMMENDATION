<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once 'Lib/bot.php';
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
	$('#form_test_main').submit(function () {

	    // Get the Login Name value and trim it
	    var name = $.trim($('#home_url').val());
	    var path = $.trim($('#home_pattern').val());
	    var base = $.trim($('#home_url_base').val());
	    	    
	    $.post("process.php",{home_url:name, home_pattern:path,base_url:base},function(data,status){
	    	$("#div_result").html(data);
		    });
	    return false;	    
	});

//test trang con
	$('#form_test_detail').submit(function () {

	    // Get the Login Name value and trim it
	    var name = $.trim($('#detail_url').val());
	    var path = $.trim($('#detail_pattern').val());
	    alert('aaa');	    	    	    
	    $.post("process.php",{detail_url:name, detail_pattern:path},function(data,status){
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
			<!-- Dùng để test pattern lấy link -->
			<div id="test_main">
				<h2>Test main pattern</h2>
				<p>
				
				
				<form action="" method="" id="form_test_main">
					<h2>Page url</h2>
					<input id="home_url" type="text" name="txt_url">
					<h2>Base url</h2>
					<input id="home_url_base" type="text" name="txt_url_base">
					<h2>Main pattern</h2>
					<textarea id="home_pattern" name="m_pattern"></textarea>
					<br> <input type="submit" name="btn_test" value="Test pattern">
				</form>
				</p>
				<p></p>

			</div>


			<!-- Dùng để test pattern lấy nội dung -->
			<div id="test_content">
				<form action="" method="" id="form_test_detail">
					<h2>Page url</h2>
					<input id="detail_url" type="text" name="txt_url">									
					<h2>Main pattern</h2>
					<textarea id="detail_pattern" name="m_pattern"></textarea>
					<br> <input type="submit" name="btn_test" value="Test pattern">
				</form>

			</div>

			<!-- Dùng để edit -->
			<div id="edit_pattern">edit</div>

			<!-- Dùng để save -->
			<div id="save_pattern">save</div>


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
