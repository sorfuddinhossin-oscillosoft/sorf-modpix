<?php 
$data = array(		
					'id' => $_REQUEST['id']
					);									
		$Result = $shDB->selectOnMultipleCondition($data,'product');
		$Result = $Result[0];
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Add a New Product</td>
						</th>
					</table>
				</div>
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="javascript: history.back(1);" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>		
			</div>
			<div class="leftFloat div100">
				<table cellpadding="5" cellspacing="0" style="width:100%; padding-left:10px; padding-right:10px;">
					<tr>
						<td align="left">
						We don't take photos just so later they will be forgotten on a disc or in a folder. These memories need to be shared and enjoyed, displayed, on a holiday card, under a gallery light or in a wedding album.
						</td>
					</tr>
					<tr>
						<td align="left">
						<h1>Add a New Product</h1>
						<div class="content">
							<div>
								<?php
									if(isset($_REQUEST['productName'])){
										
										
										$data = array(
										'id' => '',
										'name' => trim($_REQUEST['productName']),
										'description' => trim($_REQUEST['productDesc']),
										'unit_price' =>$_REQUEST['productName'],
										'img_unit_price' =>$_REQUEST['productName'],
										'createtime' => $log->timetodb()
									);
									$table = 'logon';
									$result = $shDB->update($data,$_REQUEST['id'],'product');	
						
										
										if($result==true){
											echo '<div class="messSuccess">Product edited successfully.</div>';
											echo '<script>
													alert("Product edited successfully");
													location.href='.$log->baseurl.'user/index.php?pg=?pg=productlist;
													</script>';
										}
										else{
											echo '<script>
													alert("Error in product addition.");
													location.href='.$log->baseurl.'user/index.php?pg=?pg=productlist;
													</script>';
										}
									} 
								
								if(!isset($_REQUEST['addProductBtn'])){								
								?>		
								<div class="formGuide">
									<ul style="color:#000000">
										<li class="optional">Optional</li>
										<li class="mandatory">Mandatory</li>
										<li class="duplicate">Duplicate</li>
									</ul>
								</div>														
								<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="addProductForm" id="addProductForm">
									<label>Product Name</label><br />
									<input class="mandatory" type="text" name="productName" value="<?php echo $Result['name']?>"><br />
									<label>Description</label><br />
									<textarea class="mandatory" type="text" name="productDesc" style="width:366px; height:70px;"><?php echo $Result['description']?></textarea><br />
									<label>Product Price</label><br />
									<input class="mandatory" type="text" name="productPrice" value="<?php echo $Result['unit_price']?>"> AUD<br />	
									<label>Product Image Unit Price</label><br />
									<input class="mandatory" type="text" name="productImgPrice" value="<?php echo $Result['img_unit_price']?>"> AUD<br />									
									<input type="button" Value="Submit" name="addProductBtn" id="addProductBtn">
									<input type="reset" Value="Reset">
								</form>
								<?php } ?>
							</div>
						</div>
						</td>
					</tr>										
				</table>			
			
			</div>
		</div>
	</div>
</div>