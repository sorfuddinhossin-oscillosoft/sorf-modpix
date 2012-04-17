<?php
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
include_once '../class/class.email.php';
$shDB =new sh_DB();
$log =new logmein();
$shMail = new sh_Email();
$pass = $log->createPassword();
$dataforEmailExist = array(
					'useremail' => $_REQUEST['email']
					);
$imageIsExistResult = $shDB->selectOnMultipleCondition($dataforEmailExist,'logon');

if(!$imageIsExistResult){
	$data = array(
	  "id" => '',
	  "fname"=>trim($_REQUEST['fname']),
	  "lname"=>trim($_REQUEST['lname']),
	  "address"=>trim($_REQUEST['address']),
	  "addresstwo"=>trim($_REQUEST['addresstwo']),
	  "phone"=>trim($_REQUEST['phone']),
	  "useremail"=>trim($_REQUEST['email']),
	  "password"=>md5($pass),
	  "zip"=>trim($_REQUEST['zip']),
	  "city"=>trim($_REQUEST['city']),
	  "country"=>trim($_REQUEST['country']),
	  "userlevel"=>2,
	  "status"=>1,
	  "registration_date"=>$log->timetodb()	
	  );  
 $userId = $shDB->insert($data,'logon');
 if($userId){
 		// email notification
 		$username = $_REQUEST['fname'].' '.$_REQUEST['lname'];
 		$mail = $_REQUEST['email'];
 		$isMail = $shMail->temPlateRegistration($username,$mail,$pass);
		if($isMail==true){
			echo 1;
		}else{
			echo 0;
		}
 }else{ 
 	echo 0;
 }
}else{
	echo 0;
}
?>