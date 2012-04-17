<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Item Option</td>
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
					
					<?php if(isset($_REQUEST['submittype'])){
						if($_REQUEST['submittype']=='add'){
						$itemInsertData = array(
										'id' => '',
										'name' => trim($_REQUEST['itemname']),
										'value' => trim($_REQUEST['itemvalue']),
										'status' => 1
										);
					$itemInsertResult = $shDB->insert($itemInsertData,'itemoption'); 
					if($itemInsertResult){?>
						 <p class="greenMessage" style="color:green">Item option added successfully.</p>
					<?php }
						}
						if($_REQUEST['submittype']=='edit'){
						$itemEditData = array(
										'name' => trim($_REQUEST['itemname']),
										'value' => trim($_REQUEST['itemvalue']),
										'status' => 1
										);
					$itemEditResult = $shDB->update($itemEditData,$_REQUEST['itemid'],'itemoption'); 
					
					if($itemEditResult){?>
						 <p class="greenMessage" style="color:green">Item edited successfully.</p>
					<?php }else { ?>
						 <p class="greenMessage" style="color:red">Error in update. Please try later.</p>
					<?php }
						}
					}
					if(isset($_REQUEST['edit'])){
						$itemEditData = array(
										'id' => $_REQUEST['id']
										);
					$itemEditData = $shDB->selectOnMultipleCondition($itemEditData,'itemoption'); 
					$itemEditData = $itemEditData[0];
					?>
					<strong>Edit an Option</strong>		
 					<form action="<?php echo $log->baseurl;?>user/index.php?pg=itemoption"  id="itemoptionForm" method="post">
 					<input type="hidden" name="submittype" value="edit">
 					<input type="hidden" name="itemid" value="<?php echo $itemEditData['id'];?>">
 					<table>
					<tr>
					<td><input type="text"  name="itemname" style="width:160px;" id="itemname" value="<?php echo $itemEditData['name'];?>"></td>
					<td>
					<input type="text"  name="itemvalue" style="width:160px;"  value="<?php echo $itemEditData['value'];?>" id="itemvalue">
					</td>
					<td valign="top">
					<input type="button" value="Edit" name="additemoption" id="additemoption">
					<input type="button" onclick="pageChange('<?php echo $log->baseurl;?>user/index.php?pg=itemoption');" value="Cancel">
					</td>
					</tr>	
					</table>
					</form>
					<?php } else{?> 
					<strong>Add an Option</strong>		
 					<form action="<?php echo $log->baseurl;?>user/index.php?pg=itemoption"  id="itemoptionForm" method="post">
 					<input type="hidden" name="submittype" value="add">
 					<table>
					<tr>
					<td><input type="text"  name="itemname" style="width:160px;" id="itemname" value=""></td>
					<td>
					<input type="text"  name="itemvalue" style="width:160px;" value="" id="itemvalue">
					</td>
					<td valign="top">
					<input type="button" value="Add" name="additemoption" id="additemoption">
					</td>
					</tr>	
					</table>
					</form>
					<?php }?>
					</td>
					</tr>
					<tr>
						<td align="left">
							<?php
$itemOptionData = array(
	'status' => 1
	);
$itemOptionData = $shDB->selectOnMultipleCondition($itemOptionData,'itemoption','id','DESC'); 
?>		
						<table cellpadding="3" cellspacing="0" style="width:100%;">
						<?php if($itemOptionData){?>
					<tr>
						<td align="left" class="tableHeader" width="45%">Item Name</td>
						<td align="left" class="tableHeader"  width="45%">Item Value</td>
						<td align="left" class="tableHeader" >Action</td>
					</tr>					
					<?php foreach($itemOptionData as $idata){?>
					<tr>
						<td align="left" style="padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><?php echo $idata['name'];?></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $idata['value'];?></td>					
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;">					
						<a class="editRowBtn" href="<?php echo $log->baseurl;?>user/index.php?pg=itemoption&id=<?php echo $idata['id'];?>&edit=edit" title="Record Details">&nbsp;</a>
						<a class="deleteRowBtn" href="javascript:void(0)" onclick="changeDelStatus(<?php echo $idata['id'];?>)" title="Delete">&nbsp;</a>
						</td>
					</tr>
				<?php } 
					}else{?>
						<tr>
						<td colspan="3" align="left" style="padding-left:2%;">
						 <p class="greenMessage" style="color:red">No item option found.</p>
						</td>
						
					</tr>
					<?php  }?>
																
				</table>
						</td>
					</tr>										
				</table>			
			
			</div>
		</div>
	</div>
</div>