<?php
session_start();
session_unset();
require_once $_SERVER ["DOCUMENT_ROOT"] . '/lib/session.php';
Session::init();
echo '<script>window.location="WebScraper.php?task=getLink&page=1&xpath_id=0";</script>'; 
?>
