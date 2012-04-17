<?php
session_start();
include_once '../class/dbclass.php';
include_once '../class/class.form.php';
$shDB =new sh_DB();
$shForm =new sh_Form();
if(isset($_REQUEST['email'])){
$email = explode(',',$_REQUEST['email']);
$success = 0;
foreach($email as $eml){
	if($shForm->validEmail($eml)==true){
		$data = array(		
					'album_id' => $_REQUEST['id'],
					'guest_id' => $eml
					);									
		$Result = $shDB->selectOnMultipleCondition($data,'album_guest');
		if(!$Result){
				//check if exist in logon
				
				$datainsert = array(
					'id' => '',
					'guest_id' => $eml,
					'album_id' => $_REQUEST['id'],
					'isowner' => 0,
					'notified' => 0
					);
					$imageResult = $shDB->insert($datainsert,'album_guest');
					if($imageResult){
						$success = 1;
					}
				
		}
	}
	
}
}
echo $success;
?>