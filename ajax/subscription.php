<?php 
include_once '../class/dbclass.php';
include_once '../class/function.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();
$updateData = array(
					'id' => '',
					'email' => $_REQUEST['email'],
				    'date' => timetodb()
					);
$subscription = $shDB->insert($updateData,'subscriber');
if($subscription){
	echo 1;
}else{
	echo 0;
}
?>