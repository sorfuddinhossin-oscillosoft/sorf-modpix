<?php 
$prodSelectData = array(
	'status' => 1
	);
$prodData = $shDB->selectOnMultipleCondition($prodSelectData,'product','id','DESC');



if(isset($_REQUEST['prod'])){
	$itemData = array(
	'prod_id' => $_REQUEST['prod'],
	'status' => 1
	);
}else{
	$itemData = array(
	'status' => 1
	);
}

$itemData = $shDB->selectOnMultipleCondition($itemData,'prod_item','id','DESC');


									
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Item List</td>
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
			<table width="100%" cellpadding="5">
			<tr><td>
			Filter by Product :<br />
			<select id="productid">
			<option value="0">&nbsp;</option>
							<?php foreach($prodData as $prod){											
											if($prod['id']==$_REQUEST['prod']){?>
												<option value="<?php echo $prod['id']?>" selected="selected"><?php echo $prod['name']?>-<?php $prod['id'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $prod['id']?>"><?php echo $prod['name']?>-<?php $prod['id'];?></option>
											<?php }
											}?>
											</select>
			</td></tr>
			<tr><td>
			<table width="100%">
			<?php if($itemData) { ?>
					<tr>
						<td  class="tableHeader">Item Name</td>
						<td class="tableHeader">No# of Sides</td>
						<td class="tableHeader">Side Hole</td>
						<td  class="tableHeader">Additional maximum Sides</td>
						<td  class="tableHeader">Additional Side Cost</td>
						<td  class="tableHeader">Basic Price</td>
						<td  class="tableHeader">&nbsp;</td>
						
					</tr>
					<?php
					
					foreach($itemData as $idata){?>
					<tr>
						<td><?php echo $idata['name'];?></td>
						<td><?php echo $idata['defaultsides'];?></td>
						<td><?php echo $idata['sidehole'];?></td>
						<td><?php echo $idata['addmaxsides'];?></td>
						<td><?php echo $idata['addsidecost'];?></td>
						<td><?php echo $idata['basicprice'];?></td>
						<td  class="tableHeader">
						
						<a class="editRowBtn" href="<?php echo $log->baseurl;?>user/index.php?pg=edititem&id=<?php echo $idata['id'];?>" title="Record Details">&nbsp;</a>
						<a class="deleteRowBtn" href="javascript:void(0)" onclick="changeItemDelStatus(<?php echo $idata['id'];?>)" title="Delete">&nbsp;</a>
						</td>
					</tr>
					<?php } 
					}else{ ?>
						<tr>
						<td colspan="5">
						<p class="greenMessage" style="color:red">Cart is empty.</p>
						</td>						
					</tr>
					<?php } ?>
			</table>
			</td></tr>
			</table>
				
			</div>
		</div>
	</div>
</div>