<?php 
session_start();
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$data = array(	'id' => $_REQUEST['productitemid']	);									
						$product = $shDB->selectOnMultipleCondition($data,'product_item');
						$product = $product[0];
						
$albumData = array(	'album_id' => $_REQUEST['albumid']);									
						$albumImg = $shDB->selectOnMultipleCondition($albumData,'album_image');
if($_SESSION['sessionid']){
$datainsert = array(
					'id' => '',
					'sessionid' => $_SESSION['sessionid'],
					'productid' => $product['id'],
					'name' => $product['name'],
					'isalbum' => 1,
					'basicprice' => $product['basicprice']					
					);

					$tempProductResult = $shDB->insert($datainsert,'temp_product');
					
					if($tempProductResult){
							
								foreach($albumImg as $albimg){
								$datainsert = array(
								'id' => '',
								'img_id' => $albimg['id'],
								'temp_product_id' => $tempProductResult
								);
								$tempProductImgResult = $shDB->insert($datainsert,'temp_product_img');
								
							}	
					}
					echo 1;
 }else {echo 0;} ?>