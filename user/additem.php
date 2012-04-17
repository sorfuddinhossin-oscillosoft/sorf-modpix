<?php 
$prodSelectData = array(
	'status' => 1
	);
$prodData = $shDB->selectOnMultipleCondition($prodSelectData,'product','id','DESC');

$itemOption = array(
	'status' => 1
	);
$itemOption = $shDB->selectOnMultipleCondition($itemOption,'itemoption'); 


?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Add Item</td>
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
					<?php 
					
					if(isset($_REQUEST['itemname'])){
						$itemName = trim($_REQUEST['itemname']);
						$prodId = trim($_REQUEST['productidselect']);
						
						$itemCost = trim($_REQUEST['itemcost']);
						$defaultSides = trim($_REQUEST['defaultsides']);
						$defaultSideHole = trim($_REQUEST['defaultsideshole']);
						$maxSides = trim($_REQUEST['addmaxsides']);
						$additionalSideCost = $_REQUEST['addsidecost'];
						if($itemCost==''){
							$itemCost = 0;
						}						
						if($additionalSideCost==''){
								$additionalSideCost = 0;
							}
							
						$itemaddData = array(
								'id' => '',
								'prod_id' => $prodId,
								'name' => $itemName,
								'defaultsides' => $defaultSides,
								'sidehole' => $defaultSideHole,
								'addmaxsides' => $maxSides,
								'addsidecost' => $additionalSideCost,
								'basicprice' => $itemCost
							);
						
						$updateItemResult = $shDB->insert($itemaddData,'prod_item');   // right and ok
						if($updateItemResult){
						
							$optionId = $_REQUEST['visibility'];
							if($optionId){
								foreach($optionId as $optId){
									$corresCostId = 'optioncost'.$optId;
									$corresMandId = 'mandatory'.$optId;
									$selfid = '';
									$catId = '';
									$optionCost = '';
									$itemid = $updateItemResult;
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
					
					?>
					<form action="" method="POST" id="addProductItemForm">
					<table width="100%">
					<tr><td colspan="5">
					<select id="productidselect" name="productidselect" style="width:300px;">
					<option value="">Choose a product</option>
					<?php foreach($prodData as $prod){ ?>						
						
						<option value="<?php echo $prod['id']?>"><?php echo $prod['name']?></option>
						
						
					<?php } 
					?>
					</select>
					</td></tr>
					<tr>
					<td colspan="5">
						<h5 style="border-bottom:1px solid #4B6465;font-weight:bold;font-size:11px;margin:0px;padding:2px 0px;">Album Details</h5>
					</td></tr>
					<tr>
						<td colspan="6"><small style="color:red">(If you create an item for product type, please put "Default no of Sides = 1", and "Side Hole = 1")</small></td>
						</tr>
					<tr>
						<td>Item Name</td>
						<td>Default no of Sides</td>
						<td>Side Hole</td>
						<td>Additional maximum Sides</td>
						<td>Additional Side Cost</td>
						<td>Basic Price</td>
					</tr>
					
					<tr>
						<td><input type="text" name="itemname" style="width:174px;"></td>
						<td><input type="text" name="defaultsides" style="width:99px;" value="1"></td>
						<td><input type="text" name="defaultsideshole" style="width:30px;" value="1"></td>
						<td><input type="text" name="addmaxsides" style="width:122px;"></td>
						<td><input type="text" name="addsidecost" style="width:89px;"></td>
						<td><input type="text" name="itemcost" value="0.00" style="width:43px;"></td>
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
					<?php foreach($itemOption as $iOption){?>
					<tr id="itemTr<?php echo $iOption['id'];?>">
						<td align="left"><?php echo $iOption['name'];?></td>
						<td align="left"><?php echo $iOption['value'];?></td>
						<td align="center">
						<input type="checkbox" name="visibility[]" value="<?php echo $iOption['id'];?>" >
						</td>
						<td align="center">
							<input type="checkbox" name="mandatory<?php echo $iOption['id'];?>">
						</td>
						<td align="left">
							<input type="text" name="optioncost<?php echo $iOption['id'];?>" style="width:50px;" value="0.00">
						</td>
					</tr>	
					<?php } ?>
					</table>
					</td></tr>
					<tr>
					<td colspan="6">
						<h5 style="border-bottom:1px solid #4B6465;font-weight:bold;font-size:11px;margin:0px;padding:2px 0px;"></h5>
					</td></tr>
					<tr><td colspan="6"><input type="button" value="Add Item" id="addProductItem"></td></tr>						
					</table>
					</form>
					</td>
					</tr>
													
				</table>			
			
			</div>
		</div>
	</div>
</div>