<?php 
include_once '../class/dbclass.php';
$shDB =new sh_DB();

$dataUpdate = array(
						'details' => htmlspecialchars($_REQUEST['notice'], ENT_QUOTES),
						'date' => date('Y-m-d')
	);
	
$insertResult = $shDB->update($dataUpdate,1,'notice');
if($insertResult){
	echo 1;
}else{
	echo 0;
}
?>