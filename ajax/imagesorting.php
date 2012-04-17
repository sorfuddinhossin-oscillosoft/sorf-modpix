<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB = new sh_DB();
$i = 1;
$err = 0;
$indexOrder = explode(',',$_REQUEST['sortstring']);
//var_dump($indexOrder);
for($i=0;$i<sizeof($indexOrder);$i++){
	$dataForUpdate = '';
	$dataForUpdate = array(
						'img_ord' => $i
						);
	$result  = $shDB->update($dataForUpdate,$indexOrder[$i],'temp_product_img');
	if($result == false){
		$err = 1;
	}
	}
echo $err;
?>