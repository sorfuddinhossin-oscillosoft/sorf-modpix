<?php
session_start();
include_once '../class/dbclass.php';

$shDB =new sh_DB();


 $result = 0;

$okForm = 0;
$oldPassword = $_REQUEST['old_password'];
$newPassword = $_REQUEST['new_password'];
$conPassword = $_REQUEST['confirm_password'];

if($oldPassword==''){
	$okForm = 1;
}
if($newPassword==''){
	$okForm = 1;
}

if($conPassword==''){
	$okForm = 1;
}

if($newPassword == $conPassword){
	$selectOrderById = array(		
							'id' => $_SESSION['userid'],
							'password' => md5($oldPassword)
							);									
$userExist = $shDB->selectOnMultipleCondition($selectOrderById,'`logon`');
}

if($okForm==0){
	if($userExist){
	      $data = array(	
			'password' => md5($newPassword)
	      );
	   }
	
	$update = $shDB->update($data,$_SESSION['userid'],'logon');
	if($update == true){
		$result = 1;
	}else{
		$result = 0;
	}
}
	
	
 sleep(1);
?>
<script language="javascript" type="text/javascript">window.top.window.passSuccess(<?php echo $result; ?>);</script>   