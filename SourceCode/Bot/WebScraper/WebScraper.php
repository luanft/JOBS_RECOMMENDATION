<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once $_SERVER ["DOCUMENT_ROOT"].'/controller/WebScraperController.php';
set_time_limit(0);

$controller = new WebScraperController();
$controller->control();


?>