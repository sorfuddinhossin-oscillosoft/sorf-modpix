<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log = new logmein();
$imagedata = array(
							'id' => $_REQUEST['imgid']
							);
$imagedata = $shDB->selectOnMultipleCondition($imagedata,'album_image');
$imagedata = $imagedata[0];

$collectiondata = array(
							'id' => $_REQUEST['collection']
							);
$collectiondata = $shDB->selectOnMultipleCondition($collectiondata,'album');
$collectiondata = $collectiondata[0];

	$albumName = str_replace(' ','_',$collectiondata['album_name']);
	$dir = str_replace(chr(92),chr(47),getcwd());
$imgLink = $log->rootDirectory.'user/profile/'.$collectiondata['album_create_by'].'/'.$collectiondata['id'].'_'.$albumName.'/'.$imagedata['image'];

	$dataDelete = array(
			'id' => $_REQUEST['imgid']
			);
	$result = $shDB->delRecord($_REQUEST['imgid'],'album_image');
	if($result==true){
		echo 1;
	}else{
		echo 0;
	}
?>