<?php
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$dataDelete = array(
		'temp_product_id' => $_REQUEST['prodid']
		);
$result = $shDB->deleteOnMultipleCondition($dataDelete,$_REQUEST['tablename']);
if($result==true){
	echo 1;
}else{
	echo 0;
}
?>