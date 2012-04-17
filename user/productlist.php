<?php 
	$aclass='';
	$dclass='';
	if(isset($_REQUEST['status'])){
		if($_REQUEST['status'] === 'active'){
			$status = 1;
			$dclass='class="active"';
		}else{
			$status = '0';
			$aclass='class="active"';
		}
	}else{
		$status = 1;
		$dclass='class="active"';
	}
	//$product = $shDB->select('`product`','status',$status);
	$condition=array('status'=>$status);
	$product = $shDB->selectOnMultipleCondition($condition,'product','name','ASC');
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="rightFloat" style="margin-right: 8px;"><a title="Add New" href="<?php echo $log->baseurl;?>user/index.php?pg=addproduct" class="addNew">Add New</a></div>
		
	</div>
	<div class="rightContentDiv">
		<div class="leftFloat div100">
			<li class="orderMenu">&nbsp;&nbsp;</li>
			<li class="orderMenu"><a title="On Process Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=productlist&status=inactive" <?php echo $dclass;?>>Inactive</a></li>
			<li class="orderMenu"><a title="Delivered Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=productlist&status=active" <?php echo $aclass;?>>Active</a></li>
		</div>
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="coupleListIcon">&nbsp;</div></td><td>Product List and Pricing</td>
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
					<?php if($product){ ?>	
						<tr>
							<td align="left" class="tableHeader" >Product Name</td>
							<td align="left" class="tableHeader" >Product Category</td>
							<td align="left" class="tableHeader" >Action</td>
						</tr>					
						<?php
						foreach ($product as $prod)
						{
							$catdata = array(
								'id' => $prod['catid']
								);
						$catName = $shDB->selectOnMultipleCondition($catdata,'product_cat');
						$catName = $catName[0]['name'];
							
						?>
						<tr>
							<td align="left" style="padding-left:2%; border-bottom:dotted #CCCCCC 1px;padding-top: 8px;"><?php echo $prod['name'];?></td>
							<td align="left" style="border-bottom:dotted #CCCCCC 1px; padding-top: 8px;">&nbsp;<?php echo $catName;?></td>					
							<td align="left" style="border-bottom:dotted #CCCCCC 1px; padding-top: 8px;">
							<a title="Record Details" href="<?php echo $log->baseurl;?>user/index.php?pg=productdetails&id=<?php echo $prod['id'];?>" class="detailsRowBtn">&nbsp;</a>&nbsp;
							<?php if($prod['status'] == 1){ ?>
								<a class="deleteRowBtn" href="javascript:void(0)" onclick="changeProductStatus(<?php echo $prod['id'];?>, 0, 'inactive')" title="Inactive">&nbsp;</a>
							<?php }else{?>
								<a class="activeRowBtn" href="javascript:void(0)" onclick="changeProductStatus(<?php echo $prod['id'];?>, 1, 'active')" title="Active">&nbsp;</a>
							<?php } ?>
							</td>
						</tr>
						<?php
						}
						?>	
						<tr>
							<td align="center" colspan="4">
								<?php echo $product['pagination']?>
							</td>
						</tr>
					<?php }else{?>
						<tr>
							<td align="center" colspan="4" style="padding: 40px 0px; font-weight: bold;">
								No product found!
							</td>
						</tr>
					<?php } ?>	
				</table>
			</div>
		</div>
	</div>
</div>
