<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();
$updateData = array(
					'paypal_email' => $_REQUEST['paypalemail'],
					'admin_email' => $_REQUEST['adminemail'],
					'gst' => $_REQUEST['gst'],
					'lowershippingcharge' => $_REQUEST['lshiprate'],
					'currency' => $_REQUEST['currency1']					
					);
$settingsUpdate = $shDB->update($updateData,1,'settings');
if($settingsUpdate){
	echo 1;
}else{
	echo 0;
}
?>