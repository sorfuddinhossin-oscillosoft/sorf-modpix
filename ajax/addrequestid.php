<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$guestid = $_REQUEST['id'];
$albumid =  $_REQUEST['albumid'];
$data = array(		
	'id' => $guestid
);		
						
$guestDetails = $shDB->selectOnMultipleCondition($data,'album_request');	
$guestEmail = $guestDetails[0]['email'];

$dataSelectGuestEmail = array(		
	'guest_id' => $guestEmail,
	'album_id' => $albumid
);		
$dataSelectGuestEmail = $shDB->selectOnMultipleCondition($dataSelectGuestEmail,'album_guest');
if($dataSelectGuestEmail==false){
	$insertGuestIdData = array(		
	'guest_id' => $guestEmail,
	'album_id' => $albumid
	);
	$insertGuestIdData = $shDB->insert($insertGuestIdData,'album_guest');
	if($insertGuestIdData){
		$shDB->delRecord($guestid,'album_request');	
		echo 1;
	}else{
		echo 0;
	}
}else{	
	$updateGuestIdData = array(		
	'notified' => 0
	);
	$isupdate = $shDB->update($updateGuestIdData,$dataSelectGuestEmail[0]['id'],'album_guest');
	if($isupdate){
		$shDB->delRecord($guestid,'album_request');	
		echo 1;
	}else{
		echo 0;
	}
}
?>