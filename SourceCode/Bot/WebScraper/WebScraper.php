<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once $_SERVER ["DOCUMENT_ROOT"].'/controller/WebScraperController.php';
$controller = new WebScraperController();
$controller->control();


?>