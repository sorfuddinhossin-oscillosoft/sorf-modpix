<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
include_once '../class/class.email.php';
$shDB =new sh_DB();
$log =new logmein();
$shMail = new sh_Email();
$data = array(
	  "id" => '',
	  "name"=>trim($_REQUEST['name']),
	  "email"=>trim($_REQUEST['email']),
	  "message"=>trim($_REQUEST['message']),
	  "collectionid"=>trim($_REQUEST['collectionid']),
	  "responsestatus"=>0,
	  "request_date"=>$log->timetodb()	
	  );  
 $userId = $shDB->insert($data,'album_request');
 if($userId){
 		// email notification
 		$name = $_REQUEST['name'];
 		$by = $_REQUEST['email'];
 		$isMail = $shMail->requestforcode($name,$by,$_REQUEST['collectionid']);
 		echo 1;
 }else{ 
 	echo 0;
 }
?>