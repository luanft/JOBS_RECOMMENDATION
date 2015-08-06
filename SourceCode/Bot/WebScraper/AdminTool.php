<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once $_SERVER ["DOCUMENT_ROOT"].'/controller/AdminController.php';

$admin = new AdminController();

$admin->control();
?>
