<?php 
session_start();
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$data = array(	'id' => $_REQUEST['productid']);									
						$product = $shDB->selectOnMultipleCondition($data,'product_item');
						$product = $product[0];

$err = 0;
if($_SESSION['sessionid']){
for($i=1;$i<=$_REQUEST['noofCopies'];$i++){
$datainsert = array(
					'id' => '',
					'sessionid' => $_SESSION['sessionid'],
					'productid' => $product['id'],
					'name' => $product['name'],
					'basicprice' => $product['basicprice']
					);

					$tempProductResult = $shDB->insert($datainsert,'temp_product');
					
					if($tempProductResult){						
								$datainsert = array(
								'id' => '',
								'img_id' => $_REQUEST['imgid'],
								'temp_product_id' => $tempProductResult
								);
								$tempProductImgResult = $shDB->insert($datainsert,'temp_product_img');	
								if($tempProductImgResult===false) $err = 0;													
					}
	}
if($err == 0)echo 1;else echo 0;
 }else {echo 0;} 
 ?>