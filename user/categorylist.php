<?php 
 $cat = $shDB->select('product_cat');
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="rightFloat"><a title="Add New" href="<?php echo $log->baseurl;?>user/index.php?pg=addcategory" class="addNew">Add New</a></div>
		
	</div>
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="coupleListIcon">&nbsp;</div></td><td>Product Category Listing</td>
						</th>
					</table>
				</div>
				<!--
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="#" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>	
				-->			
			</div>
			<div class="leftFloat div100">
				<table cellpadding="3" cellspacing="0" style="width:100%;">
					<tr>
						<td align="left" class="tableHeader" >Category Name</td>
						
						<td align="left" class="tableHeader" >Action</td>
					</tr>					
					<?php
					foreach ($cat['records'] as $category)
					{						
					?>
					<tr>
						<td align="left" style="padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><?php echo $category['name'];?></td>
								
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;">
						<a title="Record Details" href="<?php echo $log->baseurl;?>user/index.php?pg=catedit&id=<?php echo $category['id'];?>" class="editRowBtn">&nbsp;</a>&nbsp;
						</td>
					</tr>
					<?php
					}
					?>	
					<tr>
						<td align="center" colspan="4">
							<?php echo $cat['pagination']?>
						</td>
					</tr>											
				</table>
			</div>
		</div>
	</div>
</div>
