<?php
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();
// settings data
$type = $_REQUEST['type'];
$albumid = $_REQUEST['id'];
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
	if($product){	
		?>
		<label>Select a product item</label>
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
		
		<td>&nbsp;<?php echo $settings['currency'];?>&nbsp;<?php echo number_format($idata['basicprice'],2,'.','');?></td>
		<!--<td><?php echo '<a href="Javascript:void(0)" onclick="productToCart('.$idata['id'].')" class="addtocart">Add to cart</a>';?></td>
		-->
		<td><?php echo '<a href="'.$log->baseurl.'index.php?pg=productorder&id='.$idata['id'].'&type='.$type.'&albumid='.$albumid.'" class="addtocart">Order Product</a>';?></td>
		</tr>
								<?php } ?>
								
						</table>
<?php }else{?>
	<p class="greenMessage" style="color:red">No item found. Please choose another product.</p>
<?php }?>