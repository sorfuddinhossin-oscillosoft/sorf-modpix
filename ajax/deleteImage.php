<?php 
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$imgId = $_REQUEST['imgId'];
$imgdata = array('id' =>$imgId);
$images = $shDB->selectOnMultipleCondition($imgdata,'home_page_slider_images');
$image_name=$images[0]['image_name'];
$img = $_SERVER['DOCUMENT_ROOT'].'/images/home_page_slider_images/'.$image_name;
unlink($img);
$delresult = $shDB->delRecord($imgId,'home_page_slider_images');	
if($delresult){
		echo 1;
	}else{
		echo 0;
	}
?>