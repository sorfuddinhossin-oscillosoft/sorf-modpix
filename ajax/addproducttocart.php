<?php 
session_start();
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$data = array(	'id' => $_REQUEST['id']	);									
						$product = $shDB->selectOnMultipleCondition($data,'prod_item');
						$product = $product[0];

if($_SESSION['sessionid']){
$datainsert = array(
					'id' => '',
					'sessionid' => $_SESSION['sessionid'],
					'productid' => $product['id'],
					'name' => $product['name'],
					'basicprice' => $product['basicprice']					
					);

					$tempProductResult = $shDB->insert($datainsert,'temp_product');
					
					if($tempProductResult){
								for($i=1;$i<=(int)$product['defaultsides'];$i++){
								$datainsert = array(
								'id' => '',
								'sideid' => $i,
								'temp_product_id' => $tempProductResult
								);
								$tempProductImgResult = $shDB->insert($datainsert,'temp_product_img');
							}	
					}
 }else {echo 0;} ?>
<script>// $( addImageToProduct );</script>