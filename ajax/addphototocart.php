<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();

$updateData = array(
					'img_id' => $_REQUEST['id']
					);
$imageUpdate = $shDB->update($updateData,$_REQUEST['tempproductimgid'],'temp_product_img');
if($imageUpdate){
	$datainsert = array(
						'id' => $_REQUEST['id']
						);
	$imageId = $shDB->selectOnMultipleCondition($datainsert,'album_image');
	
	$dataSelect = array(
						'id' => $imageId[0]['album_id']
						);
	$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'album');
	
	$albumName = str_replace(' ','_',$imageDetails[0]['album_name']);
		$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$albumName.'/';
		$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/thumbs/';
		
	echo '<span class="delSpan" style="position:absolute;z-index:5000;margin:2px 0px 0px 14px;" ><a class="delCartPhoto" onclick="emptyPhotoFromProd('.$_REQUEST['tempproductimgid'].','.$_REQUEST['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a></span>';		
	echo '<img src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
	
}
?>