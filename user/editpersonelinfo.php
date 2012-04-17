<?php
session_start();
include_once '../class/dbclass.php';

$shDB =new sh_DB();

$dir = str_replace(chr(92),chr(47),getcwd());
$mkdir = $dir.'/profile/'.$_SESSION['userid'].'/';	
$target_path = $mkdir . basename( $_FILES['mypic']['name']);
$photoName = basename( $_FILES['mypic']['name']);
 $result = 0;

$okForm = 0;
if($_REQUEST['fname']==''){
	$okForm = 1;
}
if($_REQUEST['address']==''){
	$okForm = 1;
}
if($okForm==0){
	if(@move_uploaded_file($_FILES['mypic']['tmp_name'], $target_path)) {
	      $data = array(	
			'fname' => trim($_REQUEST['fname']),
			'lname' => trim($_REQUEST['lname']),
			'address' => trim($_REQUEST['address']),
			'addresstwo' => trim($_REQUEST['addresstwo']),
			'phone' => trim($_REQUEST['phone']),
			'zip' => trim($_REQUEST['zip']),
			'city' => trim($_REQUEST['city']),
			'country' => trim($_REQUEST['country']),
	      	'photo' => $photoName	   
			);
	   }else{
	   		$data = array(	
			'fname' => trim($_REQUEST['fname']),
			'lname' => trim($_REQUEST['lname']),
			'address' => trim($_REQUEST['address']),
			'addresstwo' => trim($_REQUEST['addresstwo']),
			'phone' => trim($_REQUEST['phone']),
			'zip' => trim($_REQUEST['zip']),
			'city' => trim($_REQUEST['city']),
			'country' => trim($_REQUEST['country'])
	   		);
	   }
	}	
	$result = $shDB->update($data,$_SESSION['userid'],'logon');
	
	if($result == true){
		$result = 1;
	}else{
		$result = 0;
	}
 sleep(1);
?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result; ?>);</script>   