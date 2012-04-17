<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td><?php echo $productDetails['name'];?>&nbsp;(<?php echo $catName;?>)</td>
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
						<h1>Product Details</h1>
						
						<div class="">
							<div id="usual2" class="usual"> 
							  <ul> 
							    <li><a href="#summery">Summery</a></li> 
							    <li><a href="#image">Image</a></li> 
							    <li><a href="#features">Features</a></li> 
							     <li><a href="#specs">Specs</a></li> 
							      <li><a href="#items">Items</a></li> 
							  </ul> 
							  <div id="summery" class="tabDiv">
							  <?php if($_REQUEST['edit']=='summery'){
							  
							  	if($_REQUEST['productSummery']){
							  	 				$dataSummeryUpdate = array(
															'summery' => trim($_REQUEST['productSummery'])																		
															);
										 			$result = $shDB->update($dataSummeryUpdate,$_REQUEST['id'],'product');
										 			echo '<script>location.href="'.$log->baseurl.'user/index.php?pg=productdetails&id='.$_REQUEST['id'].'&tab=summery";</script>';
										 			
							  	}
							  	?>
							  
							  <form action="" method="POST" enctype="multipart/form-data" name="addProductForm" id="addProductForm">
							  <label>Product Summery</label><br />
							  <textarea class="ckeditor" type="text" name="productSummery" style="width:366px; height:70px;"> <?php echo $productDetails['summery'];?></textarea><br />
							  <input type="submit" name="submitSummeryButton" value="Submit">
							  </form>
							  
							  <?php } else {?>
							  <span class="rightFloat">
									<a id="addressEdit" class="edit" title="Edit" href="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $_REQUEST['id']?>&edit=summery">Edit</a>
								</span>
							  <?php echo $productDetails['summery'];?>
							  <?php } ?>
							  </div> 
							  <div id="image" class="tabDiv">
							  <?php 
							  if(isset($_REQUEST['submitButton'])){
							   	$prodNameDir = str_replace(' ','_',$productDetails['name']);
								$dir = str_replace(chr(92),chr(47),getcwd());
								$prodDirectory = $dir.'/product/'.$productDetails['catid'].'_'.$prodNameDir.'/';
								  if ($_FILES['productimage']) {										
											$imgArray = reArrayFiles($_FILES["productimage"]);
											foreach ($imgArray as $img){
													$imgname = $img['name'];														
													$targetpath = $prodDirectory.$img['name'];
													if(@move_uploaded_file($img['tmp_name'], $targetpath)){
													$data = array(
															'id' => '',
															'prod_id' => $_REQUEST['id'],
															'name' => $img['name']																			
															);
										 			$result = $shDB->insert($data,'prod_image');									
											}
											}
											echo '<script>location.href="'.$log->baseurl.'user/index.php?pg=productdetails&id='.$_REQUEST['id'].'&tab=image";</script>';											
									}	
							  }
							  ?>
							  <form action="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $_REQUEST['id']?>&tab=image" method="POST" enctype="multipart/form-data" name="addProductForm" id="addProductForm">
							  <label>Upload Product Image</label><br />
							  <input name="productimage[]" type="file" size="" class="none" /><input type="button" value="Add More" class="none" id="addMoreImage"><br />
							  <input type="submit" name="submitButton" value="Submit">
							  </form>
							  <?php 
							  $prodNameDir = str_replace('_',' ',$productDetails['name']);
							  foreach($prodImage as $prodimg){	?>														
									<div class="thumbProdimagediv" id="thumbProdimagediv<?php echo $prodimg['id'];?>">
										<span class="delprodimage">
											<a class="" title="Delete Image" href="javascript:void(0)" onclick="delproductimg('<?php echo $prodimg['id'];?>')">X</a>
										</span>
										<img src="<?php echo $log->baseurl;?>user/product/<?php echo $productDetails['catid'];?>_<?php echo $prodNameDir; ?>/<?php echo $prodimg["name"]?>" class="photoThumb" />
										</div>
										<?php 	}							 
							  ?>
								</div> 
							  <div id="features" class="tabDiv">
							   <?php if($_REQUEST['edit']=='features'){
							  
							  	if($_REQUEST['productFeatures']){
							  	 				$dataSummeryUpdate = array(
															'features' => trim($_REQUEST['productFeatures'])																		
															);
										 			$result = $shDB->update($dataSummeryUpdate,$_REQUEST['id'],'product');
										 			echo '<script>location.href="'.$log->baseurl.'user/index.php?pg=productdetails&id='.$_REQUEST['id'].'&tab=features";</script>';
										 			
							  	}
							  	?>
							  
							  <form action="" method="POST" enctype="multipart/form-data" name="addProductForm" id="addProductForm">
							  <label>Features</label><br />
							  <textarea class="ckeditor" type="text" name="productFeatures" style="width:366px; height:70px;"> <?php echo $productDetails['features'];?></textarea><br />
							  <input type="submit" name="submitSummeryButton" value="Submit">
							  </form>
							  
							  <?php } else {?>
							  <span class="rightFloat">
									<a id="addressEdit" class="edit" title="Edit" href="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $_REQUEST['id']?>&edit=features">Edit</a>
								</span>
							  <?php echo $productDetails['features'];?>
							  <?php } ?>
							 
								</div> 
							   <div id="specs" class="tabDiv">
							    <?php if($_REQUEST['edit']=='specs'){
							  
							  	if($_REQUEST['productspecs']){
							  	 				$dataSummeryUpdate = array(
															'specs' => trim($_REQUEST['productspecs'])																		
															);
										 			$result = $shDB->update($dataSummeryUpdate,$_REQUEST['id'],'product');
										 			echo '<script>location.href="'.$log->baseurl.'user/index.php?pg=productdetails&id='.$_REQUEST['id'].'&tab=specs";</script>';
										 			
							  	}
							  	?>
							  
							  <form action="" method="POST" enctype="multipart/form-data">
							  <label>Specs</label><br />
							  <textarea class="ckeditor" type="text" name="productspecs" style="width:366px; height:70px;"> <?php echo $productDetails['specs'];?></textarea><br />
							  <input type="submit" name="submitSpecsButton" value="Submit">
							  </form>
							  
							  <?php } else {?>
							  <span class="rightFloat">
									<a id="addressEdit" class="edit" title="Edit" href="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $_REQUEST['id']?>&edit=specs">Edit</a>
								</span>
							  <?php echo $productDetails['specs'];?>
							  <?php } ?>
							  
							   </div> 
							    <div id="items" class="tabDiv" style="padding-top:10px;">
							    <?php 
								    if(isset($_REQUEST['submittype'])){
								    	if($_REQUEST['submittype']=='add'){
								    	    	$data = array(
															'id' => '',
															'prod_id' => $_REQUEST['id'],
															'name' => $_REQUEST['itemname'],
													    	'basicprice' => $_REQUEST['baseprice'],
													    	'imgunitprice' => $_REQUEST['imgunitprice'],
								    						'maxallowedimg' => $_REQUEST['maxallowedimage']																			
															);
										 			$result = $shDB->insert($data,'product_item');
										 			if($result){
										 				echo '<div class="messSuccess">Product item added successfully.</div>';
										 			}else{
										 				echo '<div class="messError">Error in product item addition.</div>';
										 			}
								    }else{
								   				 $data = array(
															'name' => $_REQUEST['itemname'],
													    	'basicprice' => $_REQUEST['baseprice'],
													    	'imgunitprice' => $_REQUEST['imgunitprice'],
								    						'maxallowedimg' => $_REQUEST['maxallowedimage']																			
															);
										 			$result = $shDB->update($data,$_REQUEST['itemid'],'product_item');
										 			if($result){
										 				echo '<div class="messSuccess">Product item updated successfully.</div>';
										 			}else{
										 				echo '<div class="messError">Error in product item edit.</div>';
										 			}
								    }									 			
								    }
								   // select all items
								   
								    $itemData = array(
											'prod_id' => $productDetails['id']
											);
									$itemData = $shDB->selectOnMultipleCondition($itemData,'product_item');
									
							    ?>
							    <?php if($_REQUEST['item']){
							   		 $itemDatabyId = array(
											'id' => $_REQUEST['item']
											);
									 $itemDatabyId = $shDB->selectOnMultipleCondition($itemDatabyId,'product_item');
							    	$itemDatabyId = $itemDatabyId[0];
							    	?>
							    
							    
							    <form action="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $_REQUEST['id']?>&tab=items" method="POST" name="addItemForm" id="addItemForm">
							   		<fieldset>
							   		<input type="hidden" name="submittype" value="update">
							   		<input type="hidden" name="itemid"  value="<?php echo $itemDatabyId['id'];?>">
										<legend><label>Edit Item</label></legend>
										<table width="100%" cellpadding="2" cellspacing="2" class="addItemTable">
										<tr>
										<td>
										<table width="100%" cellpadding="1" cellspacing="1" id="itemContainerTable">
											<tr>
											<th width="30%">Item Name</th>
											<th width="20%">Base Price</th>
											<th width="20%">Image Unit Price</th>
											<th width="20%">Max Allowed Image</th>	
											<th>&nbsp;</th>										
											</tr>
											<tr>
											<td><input class="" type="text" name="itemname" style="width:238px;" value="<?php echo $itemDatabyId['name'];?>"></td>
											<td><input class="" type="text" name="baseprice" value="<?php echo $itemDatabyId['basicprice'];?>"></td>	
											<td><input class="" type="text" name="imgunitprice" value="<?php echo $itemDatabyId['imgunitprice'];?>"></td>	
											<td><input class="" type="text" name="maxallowedimage" value="<?php echo $itemDatabyId['maxallowedimg'];?>"></td>	
											<td>&nbsp;</td>									
											</tr>
											<tr><td colspan="5"><input type="button" name="addItemButton" id="addItemButton" value="Update"></td></tr>
										</table>
										
										</td>
										</tr>
										</table>
									
									</fieldset>
									</form>
									<?php }else{?>
									 <form action="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $_REQUEST['id']?>&tab=items" method="POST" name="addItemForm" id="addItemForm">
							   		<fieldset>
							   			<input type="hidden" name="submittype" value="add">
										<legend><label>Add Item</label></legend>
										<table width="100%" cellpadding="2" cellspacing="2" class="addItemTable">
										<tr>
										<td>
										<table width="100%" cellpadding="1" cellspacing="1" id="itemContainerTable">
											<tr>
											<th width="30%">Item Name</th>
											<th width="20%">Base Price</th>
											<th width="20%">Image Unit Price</th>
											<th width="20%">Max Allowed Image</th>	
											<th>&nbsp;</th>										
											</tr>
											<tr>
											<td><input class="" type="text" name="itemname" style="width:238px;"></td>
											<td><input class="" type="text" name="baseprice"></td>	
											<td><input class="" type="text" name="imgunitprice"></td>	
											<td><input class="" type="text" name="maxallowedimage"></td>	
											<td>&nbsp;</td>									
											</tr>
											<tr><td colspan="5"><input type="button" name="addItemButton" id="addItemButton" value="Submit"></td></tr>
										</table>
										
										</td>
										</tr>
										</table>
									
									</fieldset>
									</form>
									<?php } ?>
								<?php if($itemData){?>
								<table width="100%" cellpadding="1" cellspacing="1" id="itemContainerTable">
											<tr>
											<th width="30%">Item Name</th>
											<th width="20%">Base Price</th>
											<th width="20%">Image Unit Price</th>
											<th width="20%">Max Allowed Image</th>	
											<th>&nbsp;</th>										
											</tr>
											<?php foreach($itemData as $idata){?>
											<tr id="itemRow<?php echo $idata['id'];?>">
											<td><?php echo $idata['name'];?></td>
											<td><?php echo $idata['basicprice'];?></td>
											<td><?php echo $idata['imgunitprice'];?></td>
											<td><?php echo $idata['maxallowedimg'];?></td>
											
											<td><?php 
											echo '<a href="'.$log->baseurl.'user/index.php?pg=productdetails&id='.$_REQUEST['id'].'&tab=items&item='.$idata['id'].'">Edit</a>';
											?></td>									
											</tr>
											<?php } ?>
											
										</table>
									<?php }else{ ?>
									<div class="messError">No Item added.</div>
									<?php } ?>
								
							   </div> 
							</div> 
							 <?php 
							 
							  switch($_REQUEST['tab']){
							  	case 'items':
							  		 $tab = 'items';
							  		 break;
							  		case 'image':
							  		 $tab = 'image';
							  		 break;
							  		
							  		 case 'features':
							  		 $tab = 'features';
							  		 break;
							  		 case 'specs':
							  		 $tab = 'specs';
							  		 break;
							  		 default:
							  		 	 $tab = 'summery';
							  	
							  }
							  
							  switch($_REQUEST['edit']){
							  	case 'items':
							  		 $tab = 'items';
							  		 break;
							  		case 'image':
							  		 $tab = 'image';
							  		 break;
							  		
							  		 case 'features':
							  		 $tab = 'features';
							  		 break;
							  		 case 'specs':
							  		 $tab = 'specs';
							  		 break;
							  								  	
							  }

							 ?>
							<script type="text/javascript"> 
							  $("#usual2 ul").idTabs("<?php echo $tab;?>"); 
							</script>
						</div>
						</td>
					</tr>										
				</table>			
			
			</div>
		</div>
	</div>
</div>