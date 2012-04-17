<?php 
// select order details
$selectOrderById = array(		
							'id' => $_REQUEST['id']
							);									
$order = $shDB->selectOnMultipleCondition($selectOrderById,'`order`');
$order = $order[0];

// select order product
$selectOrderProduct = array(		
							'orderid' => $_REQUEST['id']
							);									
$orderProduct = $shDB->selectOnMultipleCondition($selectOrderProduct,'`order_product`');

// select order payment
$selectOrderProduct = array(		
							'orderid' => $_REQUEST['id']
							);									
$orderPayment = $shDB->selectOnMultipleCondition($selectOrderProduct,'`order_payment`');
$orderPayment = $orderPayment[0];
?> 
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="orderListIcon">&nbsp;</div></td><td valign="middle">Order Details # <font style="color:#FF6600"><?php echo sprintf("%010d",$order['id']);?></font></td>
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
			<?php if($orderProduct){?>
				<table cellpadding="3" width="100%" cellspacing="0">
					<tr>
						<td align="left" class="tableHeader" style="width:48%; padding-left:2%;">Order Item and Invoice Details</td>
						<td align="right" valign="bottom" class="tableHeader" style="width:48%; padding-right:2%;">&nbsp;
						</td>
					</tr>
					<tr>
						<td align="left" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
						<?php 
						/*
						if($order['isalbum']==1) $albumType = 'Album';else $albumType = 'Product';
						echo '<strong>Order Type :</strong> '.$albumType.'<br />';
						echo '<strong>Order By :</strong> '.$order['useremail'];
						*/
						?>
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
						<?php
						
							if($orderProduct){
								if($order['isalbum']==1){
												foreach ($orderProduct as $ordProd){
														$data = array(		
															'id' => $ordProd['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product');														
														$product = $product[0];
														?>
														<div class="leftFloat div100" id="cartProduct<?php echo $ordProd['id']?>">
														<div align="left" class="headerCartProduct">
														<span class="leftFloat"><strong><?php echo $product['name'];?></strong></span>
														
														<div class="clearb"></div>
														</div>
														<div class="cartPhotoHolderDiv" title="<?php echo $ordProd['id']?>">
														<ul align="left" class="ordPhotoHolder" title="<?php echo $ordProd['id']?>">
														<li class="cartPhotoImgHolder" style="border:0px;width:100%">
														<table width="100%" cellpadding="3" cellspacing="0" >
														<tr>
									
									<td align="left" class="botBorder2" style="width:22%"><strong>Image</strong></td>
									<td align="left" class="botBorder2" style="width:56%"><strong>Collection Name</strong></td>
									<td align="center" class="botBorder2" style="width:22%;padding-right:15px;"><strong>Image Id</strong></td>
								</tr></table>
														</li>
														<?php 
														$dataSelectfromTempImg = array(
															'order_product_id' => $ordProd['id']
														);
														$imageInProductOrder = $shDB->selectOnMultipleCondition($dataSelectfromTempImg,'order_product_img','img_ord');
														
														if($imageInProductOrder){
															foreach ($imageInProductOrder as $ordProductImg){
																
															
															
															$datainsert = array(
																				'id' => $ordProductImg['img_id']
																				);
															$imageId = $shDB->selectOnMultipleCondition($datainsert,'album_image');
															
																$dataSelect = array(
																				'id' => $imageId[0]['album_id']
																				);
															$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'album');
															$albumName = str_replace(' ','_',$imageDetails[0]['album_name']);
																$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/';
																$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/thumbs/';															
																echo '<li style="border:none;width:100%" class="cartPhotoImgHolder" id="cartPhotoImgHolder_'.$ordProductImg['id'].'">';
																echo '<table cellpadding="3" cellspacing="0" width="100%" style="">
															<tr>								
																<td align="left" class="botBorder2" style="width:22%"><img src="'.$useralbumthumburl.$imageId[0]['image'].'" title="'.$imageId[0]['image'].'" /></td>
																<td align="left" class="botBorder2" style="width:56%">'.$imageDetails[0]['album_name'].'</td>
																<td align="center" class="botBorder2" style="width:22%;padding-right:15px;"><big>'.$imageId[0]['id'].'</big></td>
															</tr></table>';
																echo '</li>';
															}
														}
														?>
														</ul>
														<div class="clearb"></div>	
														</div>									
														</div>	
												<?php }
								}else{ 
									foreach ($orderProduct as $ordProd){
														$data = array(		
															'id' => $ordProd['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product');														
														$product = $product[0];
														?>
														<div class="leftFloat div100" id="cartProduct<?php echo $ordProd['id']?>">
														<div align="left" class="headerCartProduct">
														<span class="leftFloat"><strong><?php echo $ordProd['name'];?></strong></span>
														
														<div class="clearb"></div>
														</div>
														<div class="cartPhotoHolderDiv" title="<?php echo $ordProd['id']?>">
														<ul align="left" class="ordPhotoHolder" title="<?php echo $ordProd['id']?>">
														<li style="border:none;;width:100%" class="cartPhotoImgHolder">
															<table width="100%" cellpadding="3" cellspacing="0" style="">
														<tr>
									
									<td align="left" class="botBorder2" style="width:22%"><strong>Image</strong></td>
									<td align="left" class="botBorder2" style="width:56%"><strong>Collection Name</strong></td>
									<td align="center" class="botBorder2" style="width:22%;padding-right:15px;"><strong>Image Id</strong></td>
								</tr></table>
								</li>
														<?php 
														$dataSelectfromTempImg = array(
															'order_product_id' => $ordProd['id']
														);
														$imageInProductOrder = $shDB->selectOnMultipleCondition($dataSelectfromTempImg,'order_product_img','img_ord');
														
														if($imageInProductOrder){
															foreach ($imageInProductOrder as $ordProductImg){
																
															
															
															$datainsert = array(
																				'id' => $ordProductImg['img_id']
																				);
															$imageId = $shDB->selectOnMultipleCondition($datainsert,'album_image');
																$dataSelect = array(
																				'id' => $imageId[0]['album_id']
																				);
															$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'album');
															$albumName = str_replace(' ','_',$imageDetails[0]['album_name']);
																$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/';
																$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/thumbs/';															
																echo '<li style="border:none;width:100%" class="cartPhotoImgHolder" id="cartPhotoImgHolder_'.$ordProductImg['id'].'">';
																echo '<table cellpadding="3" cellspacing="0" width="100%">
															<tr>								
																<td align="left" class="botBorder2" style="width:22%"><img  title="'.$imageId[0]['image'].'"  src="'.$useralbumthumburl.$imageId[0]['image'].'" /></td>
																<td align="left" class="botBorder2" style="width:56%">'.$imageDetails[0]['album_name'].'</td>
																<td align="center" class="botBorder2" style="width:22%;padding-right:15px;"><big>'.$imageId[0]['id'].'</big></td>
															</tr></table>';
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
											}
							?>
						</td>
					</tr>
					<tr><td align="center" colspan="2" style="padding-left:1%; padding-right:1%; width:98%;">&nbsp;</td></tr>
					<tr>
						<td align="center" colspan="2" style="padding-left:1%; padding-right:1%; width:98%;">
							<?php if($orderProduct){
								
							?>
							
							<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
								<tr>
									<td align="left" class="botBorder2" style="width:30%"><strong>Product Name (Price)</strong></td>
									<td align="center" class="botBorder2" style="width:20%"><strong>Base Price</strong></td>
									<td align="left" class="botBorder2" style="width:40%"><strong>Product Option</strong></td>
									<td align="right" class="botBorder2" style="width:10%;padding-right:15px;"><strong>Amount</strong></td>
								</tr>
								<?php
								
									$subTotal = 0;
									foreach ($orderProduct as $tempProduct){
									$itemName = $tempProduct['name'];
									
									$data = array(		
															'id' => $tempProduct['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'prod_item');
														
														$product = $product[0];
											$dataforProduct = array(		
															'id' => $product['prod_id']
															);									
														$productname = $shDB->selectOnMultipleCondition($dataforProduct,'product');
														$productname = $productname[0]['name'];	
												$qry = 'select * from order_item_option oio, prod_item_option pio where oio.prod_item_option_id=pio.id AND oio.order_product_id='.$tempProduct['id'];
												$query = $shDB->qry($qry); 
												$tempOptiondata=array();
												while($results=mysql_fetch_array($query)){
													$tempOptiondata[]=$results;
												}
												
												
												
												$optionCost = 0;
												$optionString = '';
												$additionalLeafCost = '';	
												if($tempOptiondata){
													foreach($tempOptiondata as $optionValue){
														$itemOptiondata = array('id' => $optionValue['optionid']);		
														$itemOptiondata = $shDB->selectOnMultipleCondition($itemOptiondata,'itemoption');
														
														$optionCost = $optionCost + $optionValue['cost'];
														
														$itemOptiondataNameandValue = $itemOptiondata[0];
														
														$optionString .= $itemOptiondataNameandValue['name'].' : '.$itemOptiondataNameandValue['value'].' ('.$settings['currency'].' '. number_format($optionValue['cost'],2,'.','').')<br />';
													}
												}	
												$optionDescription = '';
												if($tempProduct['additionalleaf']>0){
													$additionalLeafCost = $tempProduct['additionalleaf']*$tempProduct['addsidecost'];
													$optionDescription .= 'Additional Sides : '.$tempProduct['additionalleaf'].'&times'.$tempProduct['addsidecost'].' = '.$settings['currency']. number_format($additionalLeafCost,2,'.','').'<br />';
													
												}
												$optionDescription .= $optionString;
												$itemTotal = $product["basicprice"] + $additionalLeafCost + $optionCost;
													
												$subTotal =$subTotal + $itemTotal;
									
									echo
									'<tr>										
										<td align="left" class="botBorder3">'.$productname.'<br /><small>'.$itemName.'</small></td>
										<td align="center" class="botBorder3">'.$settings['currency'].' '. number_format($product["basicprice"],2,'.','').'</font></td>
										<td align="left" class="botBorder3">'.$optionDescription.'</font></td>
										<td align="right" class="botBorder3" style="padding-right:15px;"><font class="currency1">'.$settings['currency'].' '. number_format($itemTotal,2,'.','').'</td>
									</tr>									
									';
								}
								
								
								// settings from database
								$settingsid = array(		
															'id' => 1
															);									
														$settings = $shDB->selectOnMultipleCondition($settingsid,'settings');
														$settings = $settings[0];
														
								$vat=($settings['gst']/100)*$subTotal;
								if($subTotal<10){
									$shipping_charge=$settings['lowershippingcharge'];
								}else{
									$shipping_charge = 0;
								}
								
								// $grand_total=$subTotal+$vat+$shipping_charge;
								$grand_total=$subTotal;
								echo
								'
								<!--
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:13px; font-weight:bold;">Sub Total ('.$settings['currency'].') - <font class="currencyBold">'.$subTotal.'</font></td>
								</tr>
								<tr>
									<td align="right" colspan="4" style="padding-right:15px;">GST ('.$settings['gst'].'%) - '.$vat.'</td>
								</tr>
								<tr>
									<td align="right" colspan="4" class="botBorder2" style="padding-right:15px;">Shipping Charge - '.$shipping_charge.'</td>
								</tr>
								-->	
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:16px; font-weight:bold;">Total - '.$settings['currency'].'&nbsp;'. number_format($grand_total,2,'.','').'</td>
								</tr>
								';
								?>		
								
							</table>
								<?php 
								
							}else{?>
								 <p class="greenMessage" style="color:red">Wrong Id Provided</p>
							<?php } ?>
						</td>
					</tr>
					<?php if($orderProduct){?>
					
					<tr>
					<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
					<table width="100%">
						<tr>
						<td width="50%" valign="top">
						<div class="leftFloat div100" id=""  style="width:314px">
														<div align="left" class="headerCartProduct" style="width:314px">
														<span class="leftFloat"><strong>Billing Address</strong></span>	
																												
														<div class="clearb"></div>
														</div>
														<div class=cartddress id="cartbilladdress" title="" style="width:308px;padding:10px;" >
														<?php 
															$data = array(		
																'order_id' => $_REQUEST['id']
															);									
															$billAddress = $shDB->selectOnMultipleCondition($data,'order_billing_address');
															
															$billAddress = $billAddress[0];
															?>
														<div id="billDetails">
														<strong>Company</strong><br />
																<?php echo $billAddress['company']?><br />
																<strong>Full Name</strong><br />
																<?php echo $billAddress['name']?><br />
															<strong>Address</strong><br />
																<?php echo $billAddress['address']?><br /><?php echo $billAddress['city']?> - <?php echo $billAddress['zip']?><br /><?php echo $billAddress['city']?>, <?php echo $billAddress['country']?><br />
																<strong>Phone</strong><br />
																<?php echo $billAddress['phone']?><br />
															<strong>Fax</strong><br />
																<?php echo $billAddress['fax']?><br />
																<strong>Email</strong><br />
																<?php echo $billAddress['email']?><br />
													</div>	
													<div class="clearb"></div>	
														</div>									
														</div>	
						</td>
						<td width="50%" valign="top">
						<div class="leftFloat div100" id=""  style="width:314px">
														<div align="left" class="headerCartProduct" style="width:314px">
														<span class="leftFloat"><strong>Shipping Address</strong></span>
																												
														<div class="clearb"></div>
														</div>
														<div class="cartddress" id="cartshipaddress" style="width:308px;padding:10px;" >
														<?php 
															$data = array(		
																'order_id' => $_REQUEST['id']
															);									
															$shipAddress = $shDB->selectOnMultipleCondition($data,'order_ship_address');
															
															$shipAddress = $shipAddress[0];
																												
														?>
														
													<div id="shipDetails">
														<strong>Company</strong><br />
																<?php echo $shipAddress['company']?><br />
																<strong>Full Name</strong><br />
																<?php echo $shipAddress['name']?><br />
															<strong>Address</strong><br />
																<?php echo $shipAddress['address']?><br /><?php echo $shipAddress['city']?> - <?php echo $shipAddress['zip']?><br /><?php echo $shipAddress['city']?>, <?php echo $shipAddress['country']?><br />
																<strong>Phone</strong><br />
																<?php echo $shipAddress['phone']?><br />
															<strong>Fax</strong><br />
																<?php echo $shipAddress['fax']?><br />
																<strong>Email</strong><br />
																<?php echo $shipAddress['email']?><br />
													</div>	
													<div class="clearb"></div>	
														</div>	
														<div class="clearb"></div>	
														</div>
														</div>									
														</div>	
						</td>
						</tr>
						</table>
					<div class="clearb"></div>	
					<br/>
					</td></tr>	
					<?php } ?>				
				</table>
			</div>
			<?php }else{ ?>	
			<p class="greenMessage" style="color:red">Wrong Id Provided</p>
			<?php } ?>			
		</div>
	</div>
</div>