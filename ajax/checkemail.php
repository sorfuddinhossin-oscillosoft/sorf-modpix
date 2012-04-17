<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();
$dataforEmailExist = array(
					'useremail' => $_REQUEST['email']
					);
$imageIsExistResult = $shDB->selectOnMultipleCondition($dataforEmailExist,'logon');
if($imageIsExistResult){
	echo 0;
}else{
	echo 1;
}
?>