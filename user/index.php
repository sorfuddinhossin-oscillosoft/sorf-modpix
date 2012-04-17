<?php
session_start();
include('../class/ps_pagination.php');
include_once '../class/class.login.php';
include_once '../class/class.user.php';
include_once '../class/imageprocessing.php';
include_once '../class/dbclass.php';
include_once '../class/class.form.php';
include_once '../class/class.email.php';
include_once '../class/easyphpthumbnail.class.php';
include_once '../class/function.php';
include_once '../config.php';
require_once '../class/paypal.class.php'; 
if($_SESSION['userid']==''){
	header( 'Location: '.$base_url.'index.php?pg=login');
}

$log = new logmein();
$user = new user();
$imageProcessor = new imageprocessor();
$shDB =new sh_DB();
$shForm =new sh_Form();
$shMail =new sh_Email();
$isUser = '';

if(($_SESSION['userlevel']==1)||($_SESSION['userlevel']==2)){
	$isUser = 'guest/';
}

if($_REQUEST['pg']=='logout'){
	$log->logout();
	header( 'Location: '.$base_url);
}

// settings data
$settingsdata = array(		
							'id' => 1
							);									
$settings = $shDB->selectOnMultipleCondition($settingsdata,'`settings`');
$settings = $settings[0];

/*
if(isset($_REQUEST['submit'])){
			// $result = $log->login($_REQUEST['username'], $_REQUEST['password']);
			 $result = $log->login(trim($_REQUEST['uname']),trim($_REQUEST['upass']));
			  if($result==true){
			 	header( 'Location: '.$base_url);
			 }else{
			 	if(isset($_REQUEST['attempt'])){
			$attemp = $_REQUEST['attempt']+1;
		}else{
			$attemp = 1;
		}
		header( 'Location: '.$base_url.'index.php?pg=login&attempt='.$attemp) ;
			 }
}
*/
include_once '../header.php';
echo '<div id="content">';
include_once $isUser.'left.php';

//$log->cratetable('logon');
if(!$_REQUEST['pg']){
include_once $isUser.'dashboard.php';
}else{
	include_once $isUser.$_REQUEST['pg'].'.php';
} 
echo '</div>';
include_once '../footer.php'; 
?>
