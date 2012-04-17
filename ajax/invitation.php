<?php 
include_once '../class/dbclass.php';
include_once '../class/function.php';
$shDB =new sh_DB();
$user = $_REQUEST['userid'];
$success = 0;
$collectionid = $_REQUEST['collectionid'];
$conditionData = array(
						'id' => $_REQUEST['collectionid']
							);
	$album = $shDB->selectOnMultipleCondition($conditionData,'album');
	$album = $album[0];
	foreach($user as $userid){
		$data = array(		
					'id' => $userid
					);									
		$Result = $shDB->selectOnMultipleCondition($data,'album_guest');
		if($Result){
			$res = $Result[0];
				$isSentMail = sendMailInvitation($res['guest_id'],$_REQUEST['collectionid']);
				if($isSentMail==true){
					$updatedata = array(		
						'notified' => '1'
					);	
					$updateresult = $shDB->update($updatedata,$res['id'],'album_guest');	
					if($updateresult){
						$success = 1;
					}else{ $success = 0; }			
				}			
		}else{
			$success = 0;
		}
	}
	echo $success;
?>