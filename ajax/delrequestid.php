<?php 
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$guestid = $_REQUEST['id'];
$delresult = $shDB->delRecord($guestid,'album_request');	
if($delresult){
		echo 1;
	}else{
		echo 0;
	}
?>