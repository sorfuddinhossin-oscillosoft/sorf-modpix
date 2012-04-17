<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();

$data = array(
											'name' => trim($_REQUEST['prodname']),
											'catid' => $_REQUEST['catid']										
											);									
										$isExist = $shDB->selectOnMultipleCondition($data,'product');
if($isExist){
	echo 1;
}else{
	echo 0;
}
?>