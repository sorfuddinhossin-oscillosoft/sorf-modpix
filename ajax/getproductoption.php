<?php
include_once '../class/dbclass.php';
$shDB =new sh_DB();
//$prodcatdata = array(
//								'name' => $_REQUEST['productname']
//								);
//						$productcat = $shDB->selectOnMultipleCondition($prodcatdata,'product_cat');
//						$productcatid = $productcat[0]['id']; 
						$prodcatdata = array(
								'catid' => $_REQUEST['productname']
								);
						$product = $shDB->selectOnMultipleCondition($prodcatdata,'product');
						echo '<option value="">Select a product</option>';
foreach($product as $prod){
				echo '<option value="'.$prod['id'].'">'.$prod['name'].'</option>';
} ?>