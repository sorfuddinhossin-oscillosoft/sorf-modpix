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
											'name' => trim($_REQUEST['productName']),
											'catid' => $_REQUEST['catid']										
											);									
										$isExist = $shDB->selectOnMultipleCondition($data,'product');
										if($isExist==false){
									
										$prodNameDir = str_replace(' ','_',$_REQUEST['productName']);
										$dir = str_replace(chr(92),chr(47),getcwd());
										$prodDirectory = $dir.'/product/'.$_REQUEST['catid'].'_'.$prodNameDir.'/';									

										$data = array(
										'id' => '',
										'catid' => $_REQUEST['catid'],
										'basic_price' => $_REQUEST['productPrice'],
										'addition_leaf_price' => $_REQUEST['addLeafPrice'],
										'leaf_hole' => $_REQUEST['addLeafhole'],
										'img_quantity' => $_REQUEST['imgquantity'],
										'name' => trim($_REQUEST['productName']),
										'summery' => trim($_REQUEST['productSummery']),										
										'features' => trim($_REQUEST['productFeatures']),
										'specs' => trim($_REQUEST['productSpec']),
										'createtime' => $log->timetodb()
									);
									
									$prodresult = $shDB->insert($data,'product');	
						
										
										if($prodresult==true){
											$dircreated = $imageProcessor->makeDirectory($prodDirectory);
											if($dircreated==true){
												if ($_FILES['productimage']) {										
														$imgArray = reArrayFiles($_FILES["productimage"]);		
														foreach ($imgArray as $img){
															$imgname = $img['name'];														
															$targetpath = $prodDirectory.$img['name'];
															if(@move_uploaded_file($img['tmp_name'], $targetpath)){
																$data = array(
																				'id' => '',
																				'prod_id' => $prodresult,
																				'name' => $img['name']																			
																				);
																			
																			  $result = $shDB->insert($data,'prod_image');	
																									
															}
														}												
													}
											}
											echo '<div class="messSuccess">Product Added Successfully.</div>';
										}
										else{
											echo '<div class="messError">Error in product addition.</div>';
										}
									}
								} 
								
								if(!isset($_REQUEST['addProductBtn'])){	
									$selectCategory = array(		
																'active_status' => 1
																);									
									$productcat = $shDB->selectOnMultipleCondition($selectCategory,'`product_cat`');
																		
								?>		
<!--								<div class="formGuide" style="">-->
<!--									<ul style="color:#000000">-->
<!--										<li class="optional">Optional</li>-->
<!--										<li class="mandatory">Mandatory</li>-->
<!--										<li class="duplicate">Duplicate</li>-->
<!--									</ul>-->
<!--								</div>		-->

								<form action="" method="POST" enctype="multipart/form-data" name="addProductForm" id="addProductForm">
									<label>Product Name</label><br />
									<input class="mandatory" type="text" name="productName"><br />
									<label>Product Category</label><br />
									<select name="catid" id="catid">
									<?php 
										foreach($productcat as $cat){
											echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
										}
									?>
									</select>
									<br />	
									<label>Price</label><br />
									<input type="text" name="productPrice"><br />
									<label>Minimum Image Quantity</label><br />
									<input type="text" name="imgquantity"><br />
									<label>Additional Leaf Price</label>&nbsp;<small>(Required if product is album type) </small></small><br />
									<input type="text" name="addLeafPrice"><br />
									<label>No of Leaf Hole</label><br />
									<input type="text" name="addLeafhole"><br />
									<label>Product Image</label><br />
									<input name="productimage[]" type="file" size="" class="none" /><br /><input type="button" value="Add More" class="none" id="addMoreImage"><br />								
									<label>Product Summery</label><br />
									<textarea class="ckeditor" type="text" name="productSummery" style="width:366px; height:70px;"></textarea><br />
									<label>Product Features</label><br />
									<textarea class="ckeditor" type="text" name="productFeatures" style="width:366px; height:70px;"></textarea><br />
									<label>Product Spec</label><br />
									<textarea class="ckeditor" type="text" name="productSpec" style="width:366px; height:70px;"></textarea><br />								
									
									<!-- 
									
									 -->
									<input type="button" Value="Continue" name="addProductBtn" id="addProductBtn">
									<input type="reset" Value="Cancel">
								</form>
								<?php } ?>
								<script>
							
									CKEDITOR.replace( 'summery',
											{
												toolbar : 'Full'
											});
								</script>
							</div>
						</div>
						</td>
					</tr>										
				</table>			
			
			</div>
		</div>
	</div>
</div>