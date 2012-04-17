<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$res = $shDB->update($_REQUEST['updatedata'],$_REQUEST['id'],$_REQUEST['tablename']);
if($res === true){
	echo 1;
}else{
	echo 0;
}