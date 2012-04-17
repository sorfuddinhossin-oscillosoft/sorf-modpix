<?php 
session_start();

if($_SESSION['email'] = $_REQUEST['email'])echo 1;else echo 0;
var_dump($_SESSION);
?>