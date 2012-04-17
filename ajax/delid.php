<?php
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$result = $shDB->delRecord($_REQUEST['id'],$_REQUEST['tablename']);
if($result==true){
	echo 1;
}else{
	echo 0;
}
?>