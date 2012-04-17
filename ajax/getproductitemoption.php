<?php
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();
// settings data
$settingsdata = array(		
							'id' => 1
							);									
$settings = $shDB->selectOnMultipleCondition($settingsdata,'`settings`');
$settings = $settings[0];



						$prodcatdata = array(
								'prod_id' => $_REQUEST['productitemid'],
								'status' => 1
								);
						$product = $shDB->selectOnMultipleCondition($prodcatdata,'prod_item');
						/*
						echo '<option value="">Select an item</option>';
foreach($product as $prod){
				echo '<option value="'.$prod['id'].'">'.$prod['name'].'</option>';
} 

*/


if($product){	
		?>
		
		<table width="100%" id="itemDetailsTable" cellpadding="0" cellspacing="0">
									<tr>
								
								<th style="width:75%">Item Name</th>
								<th>Price</th>
								<th style="width:20%">&nbsp;</th>
								</tr>
								
								<?php foreach($product as $idata){?>
								
								<tr>
			
		<td>
		<b> <?php echo $idata['name'];?></b>				
		</td>
		
		<td>&nbsp;<?php echo $settings['currency'];?>&nbsp;<?php echo $idata['basicprice'];?></td>
		<!--<td><?php echo '<a href="Javascript:void(0)" onclick="productToCart('.$idata['id'].')" class="addtocart">Add to cart</a>';?></td>
		-->
		<td>
		<?php
		if(isset($_REQUEST['imgId'])){
			echo '<a href="'.$log->baseurl.'index.php?pg=productorder&id='.$idata['id'].'&imgid='.$_REQUEST['imgId'].'" class="addtocart">Order Product</a>';
		}else{
			echo '<a href="'.$log->baseurl.'index.php?pg=productorder&id='.$idata['id'].'" class="addtocart">Order Product</a>';
		}
		?></td>
		</tr>
								<?php } ?>
								
						</table>
<?php }else{?>
	<p class="greenMessage" style="color:red">No item found. Please choose another product.</p>
<?php }?>

