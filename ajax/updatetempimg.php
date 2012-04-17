<?php 
session_start();
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$data = array('img_id' => $_REQUEST['id']);									
						$product = $shDB->update($data,$_REQUEST['tempproductimgid'],'temp_product_img');
						if($product){
							if($_SESSION['prodid']!=''){
								echo $_SESSION['prodid'];
							}else{
							echo -1;
							}
						}else { echo 0;
						}
?>