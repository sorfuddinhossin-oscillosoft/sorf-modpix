<?php
if(isset($_REQUEST['id'])){
	$itemid = $_REQUEST['id'];
}
if($itemid==''){
	echo '<script>
		location.href="'.$log->base_url.'index.php?pg=itemlist";
		</script>';
}

// edit item and option
					
					if(isset($_REQUEST['itemid'])){
						$itemName = trim($_REQUEST['itemname']);
						$prodId = trim($_REQUEST['productidselect']);
						$itemId = $_REQUEST['itemid'];
						$itemCost = trim($_REQUEST['itemcost']);
						$defaultSides = trim($_REQUEST['defaultsides']);
						$maxSides = trim($_REQUEST['addmaxsides']);
						$defaultSideHole = trim($_REQUEST['defaultsideshole']);
						$additionalSideCost = $_REQUEST['addsidecost'];
						if($itemCost==''){
							$itemCost = 0;
						}						
						if($additionalSideCost==''){
								$additionalSideCost = 0;
							}
							
						$itemaddData = array(
								'prod_id' => $prodId,
								'name' => $itemName,
								'defaultsides' => $defaultSides,
								'addmaxsides' => $maxSides,
								'sidehole' => $defaultSideHole,
								'addsidecost' => $additionalSideCost,
								'basicprice' => $itemCost
							);
						
						$updateItemResult = $shDB->update($itemaddData,$itemId,'prod_item');   // right and ok
						if($updateItemResult){
							
							$optionItemDelData = array(
								'item_id' => $itemId
							);
						
						$deleteItemOptionResult = $shDB->deleteOnMultipleCondition($optionItemDelData,'prod_item_option');   // right and ok
							
							$optionId = $_REQUEST['visibility'];
							
							if($optionId){
								foreach($optionId as $optId){
									$corresCostId = 'optioncost'.$optId;
									$corresMandId = 'mandatory'.$optId;
									$selfid = '';
									$catId = '';
									$optionCost = '';
									$itemid = $itemId;
									$catId = $optId;
									
									if($_REQUEST[$corresMandId]=='on'){
										$mandId = 1;
									}else{
										$mandId = 0;
									}
									
									$optionCost = $_REQUEST[$corresCostId];
									
									$itemaddOptionData = array(
										'id' => '',
										'item_id' => $itemid,
										'optionid' => $catId,
										'mandatory' => $mandId,
										'cost' => $optionCost
									);
									
								 $updateOptionItemResult = $shDB->insert($itemaddOptionData,'prod_item_option');   // right and ok
									
								}
								}
							
							}
						
						
						
					}
					
				
					
$prodSelectData = array(
	'status' => 1
	);
$prodData = $shDB->selectOnMultipleCondition($prodSelectData,'product','id','DESC');

$itemOption = array(
	'status' => 1
	);
$itemOption = $shDB->selectOnMultipleCondition($itemOption,'itemoption'); 


$itemDetailsData = array(
	'id' => $itemid
	);
	
$itemDetailsData = $shDB->selectOnMultipleCondition($itemDetailsData,'prod_item'); 
$itemDetailsData = $itemDetailsData[0];

$itemOptionDetailsData = array(
	'item_id' => $itemDetailsData['id']
	);
	
$itemOptionDetailsData = $shDB->selectOnMultipleCondition($itemOptionDetailsData,'prod_item_option');


$itemOptionArray=array();
if($itemOptionDetailsData){
foreach($itemOptionDetailsData as $iOptDetData){
	array_push($itemOptionArray,$iOptDetData['optionid']);
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
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Edit Item</td>
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
					<td id="">
					
					<form action="" method="POST" id="addProductItemForm">
					<input type="hidden" name="itemid" value="<?php echo $itemDetailsData['id'];?>">
					<table width="100%">
					<tr><td colspan="5">
					<select id="productidselect" name="productidselect" style="width:300px;">
					<option value="">Choose a product</option>
					<?php foreach($prodData as $prod){
							if($itemDetailsData['prod_id']==$prod['id']){ ?>
								<option value="<?php echo $prod['id']?>" selected><?php echo $prod['name']?></option>
						<?php	}else{
						?>						
						
						<option value="<?php echo $prod['id']?>"><?php echo $prod['name']?></option>
						
						
					<?php } }
					?>
					</select>
					</td></tr>
					<tr>
					<td colspan="6">
						<h5 style="border-bottom:1px solid #4B6465;font-weight:bold;font-size:11px;margin:0px;padding:2px 0px;">Album Details</h5>
					</td></tr>
					<tr>
						<td>Item Name</td>
						<td>Default no of Sides</td>
						<td>Side Hole</td>
						<td>Additional maximum Sides</td>
						<td>Additional Side Cost</td>
						<td>Basic Price</td>
					</tr>
									
					<tr>
						<td><input type="text" name="itemname" style="width:174px;"value="<?php echo $itemDetailsData['name'];?>"></td>
						<td><input type="text" name="defaultsides" style="width:99px;" value="<?php echo $itemDetailsData['defaultsides'];?>"></td>
						<td><input type="text" name="defaultsideshole" style="width:30px;" value="<?php echo $itemDetailsData['sidehole'];?>"></td>
						<td><input type="text" name="addmaxsides" style="width:122px;" value="<?php echo $itemDetailsData['addmaxsides'];?>"></td>
						<td><input type="text" name="addsidecost" style="width:89px;" value="<?php echo $itemDetailsData['addsidecost'];?>"></td>
						<td><input type="text" name="itemcost" style="width:43px;" value="<?php echo $itemDetailsData['basicprice'];?>"></td>
					</tr> 
					
					<tr>
					<td colspan="6">
						<h5 style="border-bottom:1px solid #4B6465;font-weight:bold;font-size:11px;margin:0px;padding:2px 0px;">Album Options</h5>
					</td></tr>
					<tr>
					<td colspan="6">
						<table cellpadding="3" cellspacing="0" style="width:100%;">
						
					<tr>
						<td align="left" class="tableHeader">Category</td>
						<td align="left" class="tableHeader">Value</td>
						<td align="center" class="tableHeader">Visibility</td>
						<td align="center" class="tableHeader">Mandatory Status</td>
						<td align="left" class="tableHeader">Cost</td>
					</tr>
					<?php foreach($itemOption as $iOption){
						if (in_array($iOption['id'],$itemOptionArray)){
							$prodItemOptionSelectData = array(
								'item_id' => $_REQUEST['id'],
								'optionid' => $iOption['id']
							);
							$prodItemOptionSelectData = $shDB->selectOnMultipleCondition($prodItemOptionSelectData,'prod_item_option');
							$prodItemOptionSelectData = $prodItemOptionSelectData[0];							
						?>
					
					<tr id="itemTr<?php echo $iOption['id'];?>">
						<td align="left"><?php echo $iOption['name'];?></td>
						<td align="left"><?php echo $iOption['value'];?></td>
						<td align="center">
						<?php if($iOption)?>
						<input type="checkbox" name="visibility[]" checked="checked" value="<?php echo $iOption['id'];?>" >
						</td>
						<td align="center">
							<?php if($prodItemOptionSelectData['mandatory']==1){?>
							<input type="checkbox" checked="checked" name="mandatory<?php echo $iOption['id'];?>">
							<?php }else{?>
							<input type="checkbox" name="mandatory<?php echo $iOption['id'];?>">
							<?php } ?>
						</td>
						<td align="left">
							<input type="text" name="optioncost<?php echo $iOption['id'];?>" style="width:50px;" value="<?php echo $prodItemOptionSelectData['cost'];?>">
						</td>
					</tr>	
					<?php 
						}else{ ?>
						<tr id="itemTr<?php echo $iOption['id'];?>">
						<td align="left"><?php echo $iOption['name'];?></td>
						<td align="left"><?php echo $iOption['value'];?></td>
						<td align="center">
						<?php if($iOption)?>
						<input type="checkbox" name="visibility[]" value="<?php echo $iOption['id'];?>" >
						</td>
						<td align="center">
							<input type="checkbox" name="mandatory<?php echo $iOption['id'];?>">
						</td>
						<td align="left">
							<input type="text" name="optioncost<?php echo $iOption['id'];?>" style="width:50px;" value="0">
						</td>
					</tr>	
					<?php } }?>
					</table>
					</td></tr>
					<tr>
					<td colspan="6">
						<h5 style="border-bottom:1px solid #4B6465;font-weight:bold;font-size:11px;margin:0px;padding:2px 0px;"></h5>
					</td></tr>
					<tr><td colspan="5">
					<input type="button" value="Update Item" id="addProductItem">
					<input type="button" onclick="pageChange('<?php echo $log->baseurl;?>user/index.php?pg=itemlist');" value="Cancel">
					</td></tr>						
					</table>
					</form>
					</td>
					</tr>
													
				</table>			
			
			</div>
		</div>
	</div>
</div>