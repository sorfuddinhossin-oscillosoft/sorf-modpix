<?php 
$selectProductDatainTemp = array(		
							'logonid' => $_SESSION['userid']
							);									
$dataInTempProduct = $shDB->selectOnMultipleCondition($selectProductDatainTemp,'temp_product');
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="orderListIcon">&nbsp;</div></td><td valign="middle">My Cart</td>
						</th>
					</table>
				</div>
				<div class="rightFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="javascript: history.back();" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>			
			</div>
			<div class="leftFloat div100">
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:48%; padding-left:2%;">Order Item and Invoice Details</td>
						<td align="right" valign="bottom" class="tableHeader" style="width:48%; padding-right:2%;">						
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
							<?php 
												if($dataInTempProduct){
												foreach ($dataInTempProduct as $tempProduct){
														$data = array(		
															'id' => $tempProduct['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product');
														
														$product = $product[0];
														?>
														<div class="leftFloat div100" id="cartProduct<?php echo $tempProduct['id']?>">
														<div align="left" class="headerCartProduct">
														<span class="leftFloat"><strong><?php echo $product['name'];?></strong></span>
														<span class="rightFloat"><a class="deleteRowBtn" href="javascript:void(0)" onclick="javascript:deleteMyCartProduct('<?php echo $tempProduct['id']?>','<?php echo $tempProduct['productid']?>')" title="Delete that product from Cart.">&nbsp;</a></span>
														<div class="clearb"></div>
														</div>
														<div class="cartPhotoHolderDiv" title="<?php echo $tempProduct['id']?>">
														<ul align="left" class="cartPhotoHolder" title="<?php echo $tempProduct['id']?>">
														<?php 
														$dataSelectfromTempImg = array(
															'user_id' => $_SESSION['userid'],
															'temp_product_id' => $tempProduct['id']
														);
														$imageInTempFolder = $shDB->selectOnMultipleCondition($dataSelectfromTempImg,'temp_product_img','img_ord');
														
														if($imageInTempFolder){
															foreach ($imageInTempFolder as $tempProductImg){
																
															
															
															$datainsert = array(
																				'id' => $tempProductImg['img_id']
																				);
															$imageId = $shDB->selectOnMultipleCondition($datainsert,'album_image');
																$dataSelect = array(
																				'id' => $imageId[0]['album_id']
																				);
															$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'album');
															$albumName = str_replace(' ','_',$imageDetails[0]['album_name']);
																$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_owner_id'].'/'.$albumName.'/';
																$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_owner_id'].'/'.$albumName.'/thumbs/';															
																echo '<li class="cartPhotoImgHolder" id="cartPhotoImgHolder_'.$tempProductImg['id'].'"><img src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
																echo '<span class="delSpan" style="position:absolute;z-index:5000" ><a class="delCartPhoto" onclick="delPhotoFromMyCart('.$tempProductImg['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a></span>';
																echo '</li>';
															}
														}
														?>
														</ul>
														<div class="clearb"></div>	
														</div>									
														</div>	
												<?php }
											}
											?>
						</td>
					</tr>
					<tr><td align="center" colspan="2" style="padding-left:1%; padding-right:1%; width:98%;">&nbsp;</td></tr>
					<tr>
						<td align="center" colspan="2" style="padding-left:1%; padding-right:1%; width:98%;">
							<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
								<tr>
									<td align="center" class="botBorder2" style="width:8%; padding-left:2%;"><strong>Sl. No</strong></td>
									<td align="left" class="botBorder2" style="width:40%"><strong>Product Name (Price)</strong></td>
									<td align="center" class="botBorder2" style="width:40%"><strong>Image Qty and Price</strong></td>
									<td align="right" class="botBorder2" style="width:12%;padding-right:15px;"><strong>Amount</strong></td>
								</tr>
								<?php
								if($dataInTempProduct){
									$subTotal = 0;
									foreach ($dataInTempProduct as $tempProduct){
										$data = array(		
															'id' => $tempProduct['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product');
														
														$product = $product[0];
														
										$dataTotal = array(		
												'temp_product_id' => $tempProduct['id'],
												'user_id' => $_SESSION['userid']
												);
																					
										$imgTotal = $shDB->totalCount($dataTotal,'temp_product_img');
										$imgTotalPrice = $imgTotal*$product["img_unit_price"];
										$amount = $product["unit_price"]+$imgTotalPrice;
										$subTotal = $amount+$subTotal;
									
									echo
									'
									<tr>
										<td align="center" class="botBorder3" style="padding-left:2%;"><strong>'.$sl.'</strong></td>
										<td align="left" class="botBorder3">'.$product["name"].'<font class="currency1">('.$product["unit_price"].')</font></td>
										<td align="center" class="botBorder3">'.$imgTotal.' &times; '.$product["img_unit_price"].' <font class="currency1">('.$imgTotalPrice.')</font></td>
										<td align="right" class="botBorder3" style="padding-right:15px;"><font class="currency1">'.$amount.'</td>
									</tr>									
									';
								}
								}
								
								$vat=0;
								$shipping_charge=100;
								$grand_total=$subTotal+$vat+$shipping_charge;
								echo
								'
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:13px; font-weight:bold;">Sub Total - <font class="currencyBold">'.$subTotal.'</font></td>
								</tr>
								<tr>
									<td align="right" colspan="4" style="padding-right:15px;">GST (0%) - '.$vat.'</td>
								</tr>
								<tr>
									<td align="right" colspan="4" class="botBorder2" style="padding-right:15px;">Shipping Charge - '.$shipping_charge.'</td>
								</tr>	
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:16px; font-weight:bold;">Total - '.$grand_total.'</td>
								</tr>
								';								
								?>
							</table>
							<a href="<?php echo $log->baseurl;?>user/index.php?pg=checkout"  class="checkout"></a>
						</td>
					</tr>
					<tr><td align="center" colspan="2" style="padding-top:30px;">&nbsp;</td></tr>					
				</table>
			</div>
		</div>
	</div>
</div>
