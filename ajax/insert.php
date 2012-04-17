<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();
$dataArray = $_REQUEST['insertdata'];
$table = $_REQUEST['tablename'];
$id = $dataArray['email'];
//unset($arr[5]);
$selectData = array(
					'email' => $id
					);
$IsRecordExist = $shDB->selectOnMultipleCondition($selectData,$table);

if(!$IsRecordExist){
	$tempProductImgResult = $shDB->insert($dataArray,$table);
	
	if($tempProductImgResult){
		echo 1;
	}
}else{
	unset($dataArray['email']);
	$result = $shDB->update($dataArray,$IsRecordExist[0]['id'],$table);
	if($result===true){
		echo 1;
	}else{
		echo 0;
	}
}
?>