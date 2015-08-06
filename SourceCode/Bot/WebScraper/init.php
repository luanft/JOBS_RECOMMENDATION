<?php
require_once $_SERVER ["DOCUMENT_ROOT"]. '/lib/session.php';
session_unset();
Session::init();
echo '<script>window.location="WebScraper.php?task=getLink&page=1&xpath_id=0";</script>';
 
?>
