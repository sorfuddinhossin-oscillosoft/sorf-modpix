<?php 
$proddata = array(
							'id' => $_REQUEST['id']
							);
					$product = $shDB->selectOnMultipleCondition($proddata,'product');
					
					$productDetails = $product[0];
					
					
						$catdata = array(
							'id' => $productDetails['catid']
							);
					$catName = $shDB->selectOnMultipleCondition($catdata,'product_cat');
					$catName = $catName[0]['name'];
					
					$imagedata = array(
							'prod_id' => $productDetails['id']
							);
					$prodImage = $shDB->selectOnMultipleCondition($imagedata,'prod_image');
?>
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
							    <li><a href="#summery">Summary</a></li> 
							    <li><a href="#image">Image</a></li> 
							    <li><a href="#features">Features</a></li> 
							     <li><a href="#specs">Specs</a></li> 
							      <li><a href="#items">Items</a></li> 
							  </ul> 
							  <div id="summery" class="tabDiv" style="width:673px;">
							  <?php if($_REQUEST['edit']=='summery'){
							  	
							  	// keep old directory
							  	$dir = str_replace(chr(92),chr(47),getcwd());
							  	
							  	$olddir = $dir.'/profile/'.$album['album_owner_id'].'/'.$albumOldName;
							  	$prodOldNameDir = str_replace(' ','_',$productDetails['name']);
							  	$prodNewNameDir = str_replace(' ','_',$_REQUEST['prodname']);
										
								$olddir = $dir.'/product/'.$productDetails['catid'].'_'.$prodOldNameDir.'/';
								$newdir = $dir.'/product/'.$productDetails['catid'].'_'.$prodNewNameDir.'/';	
										
							  	if($_REQUEST['prodname']){
							  		
							  	 				$dataSummeryUpdate = array(
							  	 							'name' => trim($_REQUEST['prodname']),
							  	 							'catid' => trim($_REQUEST['productcat']),							  	 				
												  	 		'basic_price' => $_REQUEST['productPrice'],
															'addition_leaf_price' => $_REQUEST['addLeafPrice'],
															'leaf_hole' => $_REQUEST['addLeafhole'],
															'img_quantity' => $_REQUEST['imgquantity'],
															'summery' => trim($_REQUEST['productSummery'])																		
															);
										 			$result = $shDB->update($dataSummeryUpdate,$_REQUEST['id'],'product');
											
										if($result!=false){
											
												if($newdir!=$olddir){
													rename($olddir, $newdir);
												}
											echo '<script>location.href="'.$log->baseurl.'user/index.php?pg=productdetails&id='.$_REQUEST['id'].'&tab=summery";</script>';
										}
							 			
									 			
							  	}
							  	?>
							  
							  <form action="" method="POST" enctype="multipart/form-data" name="addProductForm" id="addProductForm">
							  <label>Name</label><br />
							 <input type="text" name="prodname" value="<?php echo $productDetails['name'];?>"><br />
							  <label>Product Category</label><br />
							 <?php 
							$catdata = array('active_status'=>1);
						$category = $shDB->selectOnMultipleCondition($catdata,'product_cat'); 
		?>
		<select id="productcat" name="productcat">
						<?php foreach($category as $cat){
			
					if($productDetails['catid']==$cat['id']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
				
				echo '<option value="'.$cat['id'].'" '.$selected.'>'.$cat['name'].'</option>';
		 	} ?>
		</select><br />
							 <label>Price</label><br />
									<input type="text" name="productPrice"  value="<?php echo $productDetails['basic_price'];?>"><br />
									<label>Minimum Image Quantity</label><br />
									<input type="text" name="imgquantity"  value="<?php echo $productDetails['img_quantity'];?>"><br />
									<label>Additional Leaf Price</label>&nbsp;<small>(Required if product is album type) </small></small><br />
									<input type="text" name="addLeafPrice"  value="<?php echo $productDetails['addition_leaf_price'];?>"><br />
									<label>No of Leaf Hole</label><br />
									<input type="text" name="addLeafhole"  value="<?php echo $productDetails['leaf_hole'];?>"><br />
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
							  if(isset($_REQUEST['isphotosubmitted'])){ 
							   	$prodNameDir = str_replace(' ','_',$productDetails['name']);
								$dir = str_replace(chr(92),chr(47),getcwd());
								$prodDirectory = $dir.'/product/'.$productDetails['catid'].'_'.$prodNameDir.'/';
								echo '<script>alert("'.$prodDirectory.'");</script>';
								
								$dircreated = $imageProcessor->makeDirectory($prodDirectory);
								  if ($_FILES['productimage']) {										
											$imgArray = reArrayFiles($_FILES["productimage"]);
											foreach ($imgArray as $img){
													$imgname = $img['name'];														
													$targetpath = $prodDirectory.$img['name'];
													$thumbpath = $prodDirectory."thumb_".$img['name'];
													if(@move_uploaded_file($img['tmp_name'], $targetpath)){
													createthumb($targetpath,$thumbpath,180);
													/* echo $targetpath." TTTTTTTTTT ".$thumbpath;
													exit; */
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
							  <form action="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $_REQUEST['id']?>&tab=image" method="POST" enctype="multipart/form-data" name="addProductForm" id="addProductImageForm">
							  <label>Upload Product Image</label><br />
							  <input name="productimage[]" type="file" size="" class="none" /><input type="button" value="Add More" class="none" id="addMoreImage"><br />
							  <span id="uploadStatus">
							  <img style="margin-top:10px;margin-left:0px;display:none" src="<?php echo $log->baseurl;?>/images/ajax-loader.gif">
							  </span><br />
							  <input type="hidden" name="isphotosubmitted" value="1">
							  <input type="button" name="submitButton" id="prodImageSubmitButton" value="Submit">
							  </form>
							  <?php 
							  $prodNameDir = str_replace(' ','_',$productDetails['name']);
							  if($prodImage){
							  foreach($prodImage as $prodimg){	?>														
									<div class="thumbProdimagediv" id="thumbProdimagediv<?php echo $prodimg['id'];?>">
										<span class="delprodimage">
											<a class="" title="Delete Image" href="javascript:void(0)" onclick="delproductimg('<?php echo $prodimg['id'];?>')">X</a>
										</span>
										<img src="<?php echo $log->baseurl;?>user/product/<?php echo $productDetails['catid'];?>_<?php echo $prodNameDir; ?>/<?php echo $prodimg["name"]?>" class="photoThumb" />
									 
										</div>
										<?php 	}}							 
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
								    		/*
								    		if($_REQUEST['maxallowedimage']==''){
								    			$maximg = NULL;
								    		}else{
								    			$maximg = $_REQUEST['maxallowedimage'];
								    		}
								    		
								    		*/
								    	    	$data = array(
															'id' => '',
															'prod_id' => $_REQUEST['id'],
															'name' => $_REQUEST['itemname'],
													    	'basicprice' => $_REQUEST['baseprice'],
								    	    				'maxallowedimg' => 1																
															);
															
										 			$result = $shDB->insert($data,'product_item');
										 			if($result){
										 				echo '<div class="messSuccess">Product item added successfully.</div>';
										 			}else{
										 				echo '<div class="messError">Error in product item addition.</div>';
										 			}
								    }else{
								    	
								    	/*
											    if($_REQUEST['maxallowedimage']==''){
											    			$maximg = NULL;
											    		}else{
											    			$maximg = $_REQUEST['maxallowedimage'];
											    		}
											    		
											    		*/
								   				 $data = array(
															'name' => $_REQUEST['itemname'],
													    	'basicprice' => $_REQUEST['baseprice']																	
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
									$itemData = $shDB->selectOnMultipleCondition($itemData,'prod_item');
									
									
							    ?>
							    
							   	<?php if($itemData){?>
								<table width="100%" cellpadding="1" cellspacing="1" id="itemContainerTable" style="width:648px;">
											<?php if(isset($_REQUEST['msg']) &&  $_REQUEST['msg'] == 'success'){ ?>
												<tr>
													<td colspan="3" style="text-align: center; font-weight: bold;color: green;">
														<div class="messSuccess" style="text-align: center;">Item has been successfully updated.</div>
													</td>
												</tr>
											<?php } ?>
											<tr>
												<th width="60%">Item Name</th>
												<th width="20%">Base Price</th>
												<!-- 
												<th width="20%">Image Unit Price</th>
												<th width="20%">Max Allowed Image</th>	
												 -->
												<th>&nbsp;</th>										
											</tr>
											<?php foreach($itemData as $idata){?>
											<tr id="itemRow<?php echo $idata['id'];?>">
											<td><?php echo $idata['name'];?></td>
											<td>$<?php echo number_format($idata['basicprice'],2,'.','');?></td>
											<!-- 
											<td><?php echo $idata['imgunitprice'];?></td>
											<td><?php echo $idata['maxallowedimg'];?></td>
											 -->
											
											<td><?php 
											echo '<a href="'.$log->baseurl.'user/index.php?pg=edititem&origin=1&id='.$idata['id'].'">Edit</a>';
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
<?php
	function createthumb($source, $dest, $width){
			$size = getimagesize($source); 
			$w = $size[0];    //Images width 
			$h = $size[1];    //Images height 
			
			$nw = $width;
			$nh = floor( $h * ( $nw / $w ) );
			
       
			
			
			
			$stype = explode(".", $source);
			$stype = $stype[count($stype)-1];
			
			switch($stype) {     
				case 'gif':    
					$simg = imagecreatefromgif($source);     
					break;    
				case 'jpg':     
					$simg = imagecreatefromjpeg($source);     
					break;     
				case 'png':     
					$simg = imagecreatefrompng($source);     
					break; 
			} 
			
			$dimg = imagecreatetruecolor($nw, $nh);
			$wm = $w/$nw; 
			$hm = $h/$nh; 
			$h_height = $nh/2; 
			$w_height = $nw/2;     
			
			if($w> $h){
				$adjusted_width = $w / $hm;
				$half_width = $adjusted_width / 2;
				$int_width = $half_width - $w_height;
				imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
			} elseif(($w <$h) || ($w == $h)) {
				$adjusted_height = $h / $wm;
				$half_height = $adjusted_height / 2;
				$int_height = $half_height - $h_height;
			 
				imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
			} else {
				imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
			}
			 
			imagejpeg($dimg,$dest,100);
    }

?>