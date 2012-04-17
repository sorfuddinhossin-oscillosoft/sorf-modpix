<?php
$prodSelectData = array(
	'status' => 1
	);
$prodData = $shDB->selectOnMultipleCondition($prodSelectData,'product','id','DESC'); 

if(isset($_REQUEST['prod'])){
	$prodduct = $_REQUEST['prod'];
}else{
		$prodduct = $prodData[0]['id'];
}
$message = '';
if(isset($_REQUEST['submittype'])){
	if($_REQUEST['submittype']=='additem'){
$data = array(
															'id' => '',
															'prod_id' => $_REQUEST['productidselect'],
															'name' => $_REQUEST['itemname'],

															'size' => $_REQUEST['size'],
															'cornerstyle' => $_REQUEST['cornerstyle'],
															'papertype' => $_REQUEST['papertype'],
															'gildededging' => $_REQUEST['gildededging'],
															'boxed' => $_REQUEST['boxed'],
															'embossing' => $_REQUEST['embossing'],
															'frontcover' => $_REQUEST['frontcover'],
													    	'insideback' => $_REQUEST['insideback'],
															'maxsides' => $_REQUEST['maxsides'],
															'basicprice' => $_REQUEST['basicprice'],
								    	    				'maxallowedimg' => 1																
															);
															
										 			$result = $shDB->insert($data,'product_item');
										 			if($result){
										 				$message = '<div class="messSuccess">Product item added successfully.</div>';
										 			}else{
										 				$message =  '<div class="messError">Error in product item addition.</div>';
										 			}
	}
	if($_REQUEST['submittype']=='edititem'){
	$editdata = array(
															'prod_id' => $_REQUEST['productidselect'],
															'name' => $_REQUEST['itemname'],
															'size' => $_REQUEST['size'],
															'cornerstyle' => $_REQUEST['cornerstyle'],
															'papertype' => $_REQUEST['papertype'],
															'gildededging' => $_REQUEST['gildededging'],
															'boxed' => $_REQUEST['boxed'],
															'embossing' => $_REQUEST['embossing'],
															'frontcover' => $_REQUEST['frontcover'],
													    	'insideback' => $_REQUEST['insideback'],
															'maxsides' => $_REQUEST['maxsides'],
															'basicprice' => $_REQUEST['basicprice'],
								    	    				'maxallowedimg' => 1																
															);
															
										 			$result = $shDB->update($editdata,$_REQUEST['itemid'],'product_item');
										 			if($result){
										 				$message = '<div class="messSuccess">Product item added successfully.</div>';
										 			}else{
										 				$message =  '<div class="messError">Error in product item addition.</div>';
										 			}
	}
}
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Item Listing</td>
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
					<td id="addAnItemtoItemList">
					<strong>Add an Item</strong>
 					<?php echo $message;?>
 					<?php if(isset($_REQUEST['edit'])){
 					
 						 $itemEditData = array(
											'id' => $_REQUEST['edit']
											);
									$itemEditData = $shDB->selectOnMultipleCondition($itemEditData,'product_item');
									$itemEditData = $itemEditData[0];
 						?>
 					
 					<form action="<?php echo $log->baseurl;?>user/index.php?pg=itemlist&prod=<?php echo $prodduct;?>" method="post">
 					<input type="hidden" name="submittype" value="edititem">
 					<input type="hidden" name="itemid" value="<?php echo $itemEditData['id'];?>">
					<table>
					<tr><td>Choose a product</td><td colspan="2">Item Name</td></tr>
					<tr><td>
					
					<select name="productidselect">
					<?php foreach($prodData as $prod){
							if($prod['id']==$itemEditData['prod_id']){
						
						?>
						
						<option value="<?php echo $prod['id']?>" selected="selected"><?php echo $prod['name']?></option>
						
						<?php }else{?>
							<option value="<?php echo $prod['id']?>"><?php echo $prod['name']?></option>
						<?php }?>
					<?php } 
					?>
					</select></td>
					<td colspan="2"><input type="text" name="size" name="itemname" value="<?php echo $itemEditData['name'];?>" style="width:160px;"></td>
					</tr>
					<tr><td>Size</td><td>Corner Style</td><td>Paper Type</td></tr>
					<tr>
					<td><input type="text" name="size" name="size" style="width:160px;" value="<?php echo $itemEditData['size'];?>"></td>
					<td>
					<select name="cornerstyle">
						<option value="" <?php if($itemEditData['cornerstyle']==''){echo 'selected="selected"';}?> >None</option>
						<option value="Round" <?php if($itemEditData['cornerstyle']=='Round'){echo 'selected="selected"';}?>>Round</option>
						<option value="Square" <?php if($itemEditData['cornerstyle']=='Square'){echo 'selected="selected"';}?>>Square</option>
					</select>
					</td>
					<td>
					<select name="papertype">
						<option <?php if($itemEditData['papertype']=='Luster'){echo 'selected="selected"';}?>>Luster</option>
						<option <?php if($itemEditData['papertype']=='Metalic'){echo 'selected="selected"';}?>>Metalic</option>
						<option  <?php if($itemEditData['papertype']=='Irish Lilen'){echo 'selected="selected"';}?>>Irish Lilen</option>
						<option  <?php if($itemEditData['papertype']=='Standard Paper'){echo 'selected="selected"';}?>>Standard Paper</option>
						<option  <?php if($itemEditData['papertype']=='Mate Finish'){echo 'selected="selected"';}?>>Mate Finish</option>
					</select>
					</td>
					</tr>
					<tr><td>Gilded Edging</td><td>Boxed</td><td>Embossing</td></tr>
					</tr>
					<tr><td><select name="gildededging">
						<option value=""  <?php if($itemEditData['gildededging']=='None'){echo 'selected="selected"';}?>>None</option>
						<option value="Bright Gold" <?php if($itemEditData['gildededging']=='Bright Gold'){echo 'selected="selected"';}?>>Bright Gold</option>
						<option value="Marbled Silver" <?php if($itemEditData['gildededging']=='Marbled Silver'){echo 'selected="selected"';}?>>Marbled Silver</option>
						<option value="Metallic Black" <?php if($itemEditData['gildededging']=='Metallic Black'){echo 'selected="selected"';}?>>Metallic Black</option>
						<option value="Marbled Gold" <?php if($itemEditData['gildededging']=='Marbled Gold'){echo 'selected="selected"';}?>>Marbled Gold</option>
					</select></td>
					<td><select name="boxed">
						<option value=""  <?php if($itemEditData['boxed']=='None'){echo 'selected="selected"';}?>>None</option>
						<option value="Presentation Box"  <?php if($itemEditData['Presentation Box']=='None'){echo 'selected="selected"';}?>>Presentation Box</option>
						<option value="Premier Box"  <?php if($itemEditData['boxed']=='Premier Box'){echo 'selected="selected"';}?>>Premeir Box</option>
						<option value="Silver Box"  <?php if($itemEditData['boxed']=='Silver Box'){echo 'selected="selected"';}?>>Silver Box</option>
						<option value="Premier Book Box"  <?php if($itemEditData['boxed']=='Premier Book Box'){echo 'selected="selected"';}?>>Premier Book Box</option>
					</select></td>
					<td>
					<select name="embossing">
						<option value=""  <?php if($itemEditData['embossing']==''){echo 'selected="selected"';}?>></option>
						<option value="One Line"   <?php if($itemEditData['embossing']=='One Line'){echo 'selected="selected"';}?>>One Line</option>
						<option value="Two Line"   <?php if($itemEditData['embossing']=='Two Line'){echo 'selected="selected"';}?>>Two Line</option>
						<option value="Three Line"   <?php if($itemEditData['embossing']=='Three Line'){echo 'selected="selected"';}?>>Three Line</option>
					</select>
					</td>
					
					</tr>
					<tr><td>Front Cover</td><td>Inside Back</td><td>Max Sides</td></tr>
					<tr><td>
					<select name="frontcover">
						<option value="" <?php if($itemEditData['frontcover']==''){echo 'selected="selected"';}?>></option>
						<option value="Yes"  <?php if($itemEditData['frontcover']=='Yes'){echo 'selected="selected"';}?>>Yes</option>
						<option value="Upto Two Line"  <?php if($itemEditData['frontcover']=='Upto Two Line'){echo 'selected="selected"';}?>>Upto Two Line</option>						
						<option value="Upto Three Line"  <?php if($itemEditData['frontcover']=='Upto Three Line'){echo 'selected="selected"';}?>>Upto Three Line</option>					
					</select>
					</td>
						<td><select name="insideback">
						<option value=""  <?php if($itemEditData['insideback']==''){echo 'selected="selected"';}?>></option>
						<option value="Yes"  <?php if($itemEditData['insideback']=='Yes'){echo 'selected="selected"';}?>>Yes</option>
						<option value="Upto Two Line"  <?php if($itemEditData['insideback']=='Upto Two Line'){echo 'selected="selected"';}?>>Upto Two Line</option>						
						<option value="Upto Three Line"  <?php if($itemEditData['insideback']=='Upto Three Line'){echo 'selected="selected"';}?>>Upto Three Line</option>				
					</select></td>
							
						<td><input type="text" max style="width:160px;" name="maxsides" value="<?php echo $itemEditData['maxsides'];?>"></td>
						</tr>
						<tr><td colspan="3">Price</td></tr>
						<tr><td colspan="3"><input type="text" style="width:160px;" name="basicprice" value="<?php echo $itemEditData['basicprice'];?>"></td></tr>
						<tr><td colspan="3"><input type="submit" value="Edit Item"></td></tr>
						
					</table>
					</form>
 					<?php }else{?>
 					<form action="" method="post">
 					<input type="hidden" name="submittype" value="additem">
					<table>
					<tr><td>Choose a product</td><td colspan="2">Item Name</td></tr>
					<tr><td>
					
					<select name="productidselect">
					<?php foreach($prodData as $prod){?>
						
						<option value="<?php echo $prod['id']?>" selected="selected"><?php echo $prod['name']?></option>
						<?php } ?>
					</select></td>
					<td colspan="2"><input type="text" name="size" name="itemname" style="width:160px;"></td>
					</tr>
					<tr><td>Size</td><td>Corner Style</td><td>Paper Type</td></tr>
					<tr>
					<td><input type="text" name="size" name="size" style="width:160px;"></td>
					<td>
					<select name="cornerstyle">
						<option value="">None</option>
						<option value="Round">Round</option>
						<option value="Square">Square</option>
					</select>
					</td>
					<td>
					<select name="papertype">
						<option>Luster</option>
						<option>Metalic</option>
						<option>Irish Lilen</option>
						<option>Standard Paper</option>
						<option>Mate Finish</option>
					</select>
					</td>
					</tr>
					<tr><td>Gilded Edging</td><td>Boxed</td><td>Embossing</td></tr>
					</tr>
					<tr><td><select name="gildededging">
						<option value="">None</option>
						<option value="Bright Gold">Bright Gold</option>
						<option value="Marbled Silver">Marbled Silver</option>
						<option value="Metallic Black">Metallic Black</option>
						<option value="Marbled Gold">Marbled Gold</option>
					</select></td>
					<td><select name="boxed">
						<option value="">None</option>
						<option value="Presentation Box">Presentation Box</option>
						<option value="Premier Box">Premeir Box</option>
						<option value="Silver Box">Silver Box</option>
						<option value="Premier Book Box">Premier Book Box</option>
					</select></td>
					<td>
					<select name="embossing">
						<option value=""></option>
						<option value="One Line">One Line</option>
						<option value="Two Line">Two Line</option>
						<option value="Three Line">Three Line</option>
					</select>
					</td>
					
					</tr>
					<tr><td>Front Cover</td><td>Inside Back</td><td>Max Sides</td></tr>
					<tr><td>
					<select name="frontcover">
						<option value=""></option>
						<option value="Yes">Yes</option>
						<option value="Upto Two Line">Upto Two Line</option>						
						<option value="Upto Three Line">Upto Three Line</option>					
					</select>
					</td>
						<td><select name="insideback">
						<option value=""></option>
						<option value="Yes">Yes</option>
						<option value="Upto Two Line">Upto Two Line</option>						
						<option value="Upto Three Line">Upto Three Line</option>				
					</select></td>
							
						<td><input type="text" style="width:160px;" name="maxsides"></td>
						</tr>
						<tr><td colspan="3">Price</td></tr>
						<tr><td colspan="3"><input type="text" style="width:160px;" name="basicprice"></td></tr>
						<tr><td colspan="3"><input type="submit" value="Add Item"></td></tr>
						
					</table>
					</form>
					<?php } ?>
					
					
					
					</td>
					</tr>
					<tr>
						<td align="left">
									
						<div class="">
							<div id="" class=""> 
							
							  
							  
							   
							    <div id="items" class="tabDiv" style="padding-top:10px;">
							    <?php 

							   
								    $itemData = array(
											'prod_id' => $prodduct
											);
									$itemData = $shDB->selectOnMultipleCondition($itemData,'product_item','id','DESC');
								
									//$itemData = $shDB->selectWithoutPaging('product_item');
							    ?>
							
								
								<table cellpadding="1" cellspacing="1" id="itemContainerTable" style="width:678px;">
											<tr>
											<th width="70%">Product : 
											<select id="productid">
											<?php foreach($prodData as $prod){?>
											
											<?php 
											
											if($prod['id']==$prodduct){?>
												<option value="<?php echo $prod['id']?>" selected="selected"><?php echo $prod['name']?>-<?php $prod['id'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $prod['id']?>"><?php echo $prod['name']?>-<?php $prod['id'];?></option>
											<?php }
											}?>
											</select>
											</th>
											<th width="50%">Price</th>
											</tr>
											<?php if($itemData){?>
											<?php
											// foreach($itemData as $idata){
											
												for($i=0;$i<sizeof($itemData);$i++){
												?>
											<tr id="itemRow<?php echo $itemData[$i]['id'];?>">
											<td><?php echo $itemData[$i]['name'];?>&nbsp;<?php echo $itemData[$i]['size'];?></td>
											<td class="itempricetd" tabindex="<?php echo $i+100;?>" id="itempricetd<?php echo $itemData[$i]['id'];?>">
											<span class="itemprice" onclick="convertTextField('<?php echo $itemData[$i]['id'];?>','<?php echo $itemData[$i]['basicprice'];?>');"><?php echo $settings['currency'];?><?php echo $itemData[$i]['basicprice'];?>											
											</span><a class="smalledit" href="<?php echo $log->baseurl;?>user/index.php?pg=itemlist&prod=<?php echo $prodduct;?>&edit=<?php echo $itemData[$i]['id'];?>"></a></td>
											</tr>
											<?php } }else{ ?>
										<tr>
										<td colspan="3">	
									<div class="messError">No Item added.</div>
									</td>
									</tr>
									<?php } ?>
											
										</table>
									
								
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