<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/TestTool.php';
set_time_limit(0);
$testObject= new TestGUI();
$testObject->control();	 
?>