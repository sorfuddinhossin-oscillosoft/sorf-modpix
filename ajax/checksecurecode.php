<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();
$dataforEmailExist = array(
					'securitycode' => $_REQUEST['securecode']
					);
$imageIsExistResult = $shDB->selectOnMultipleCondition($dataforEmailExist,'album');
if($imageIsExistResult){
	echo 1;
}else{
	echo 0;
}
?>