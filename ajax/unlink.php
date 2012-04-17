<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$imagedata = array(
							'id' => $_REQUEST['id']
							);
$imagedata = $shDB->selectOnMultipleCondition($imagedata,'prod_image');
$imagedata = $imagedata[0];

$imglink = $log->baseurl.'user/product/'.$imagedata['catid'].'_'.$prodNameDir.'/'.$imagedata["name"];

/*
$myFile = "testFile.txt";
unlink('http://demo.oscillosoft.com/modpix_final/user/product/1_Prints/1310541100_plug_in.png');
*/
?>