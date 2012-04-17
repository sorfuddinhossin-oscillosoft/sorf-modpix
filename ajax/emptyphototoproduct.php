<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();

$dataSelect = array(
					'id' => $_REQUEST['productid']
					);
$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'temp_product');
	
//if($imageDetails[0]['maxallowedimg']!=''){
	$updateData = array(
						'img_id' => ''
						);
	$imageUpdate = $shDB->update($updateData,$_REQUEST['id'],'temp_product_img');
	if($imageUpdate){
		echo 1;
	}else{
		echo 0;
	}
//}
/*
else{
	$result = $shDB->delRecord($_REQUEST['id'],'temp_product_img');
	if($result){
		echo 3;
	}else{
		echo 2;
	}
}*/