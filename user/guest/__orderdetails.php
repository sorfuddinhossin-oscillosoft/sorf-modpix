<?php 
// select order details
//var_dump($_SESSION['userid']);
$selectOrderById = array(		
							'id' => $_REQUEST['id'],
							'userid' => $_SESSION['userid']
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
			<?php if($order){?>
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:48%; padding-left:2%;">Order Item and Invoice Details</td>
						<td align="right" valign="bottom" class="tableHeader" style="width:48%; padding-right:2%;">&nbsp;
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
							<?php
							if($orderProduct){
												foreach ($orderProduct as $ordProd){
														$data = array(		
															'id' => $ordProd['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product_item');
														
														$product = $product[0];
														?>
														<div class="leftFloat div100" id="cartProduct<?php echo $ordProd['id']?>">
														<div align="left" class="headerCartProduct">
														<span class="leftFloat"><strong><?php echo $product['name'];?></strong></span>
														
														<div class="clearb"></div>
														</div>
														<div class="cartPhotoHolderDiv" title="<?php echo $ordProd['id']?>">
														<ul align="left" class="ordPhotoHolder" title="<?php echo $ordProd['id']?>">
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
																$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_owner_id'].'/'.$albumName.'/';
																$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_owner_id'].'/'.$albumName.'/thumbs/';															
																echo '<li class="cartPhotoImgHolder" id="cartPhotoImgHolder_'.$ordProductImg['id'].'"><img src="'.$useralbumthumburl.$imageId[0]['image'].'" />';

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
							<?php if($orderProduct){?>
							<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
								<tr>
									<td align="center" class="botBorder2" style="width:8%; padding-left:2%;"><strong>Sl. No</strong></td>
									<td align="left" class="botBorder2" style="width:40%"><strong>Product Name (Price)</strong></td>
									<td align="center" class="botBorder2" style="width:40%"><strong>Image Qty and Price</strong></td>
									<td align="right" class="botBorder2" style="width:12%;padding-right:15px;"><strong>Amount</strong></td>
								</tr>
								<?php
								
									$subTotal = 0;
									foreach ($orderProduct as $ordProduct){
										$data = array(	
													'id' => $ordProduct['productid']
															);											
														$product = $shDB->selectOnMultipleCondition($data,'product');
														
														$product = $product[0];
														
										$dataTotal = array(		
												'order_product_id' => $ordProduct['id']												
												);
																					
										$imgTotal = $shDB->totalCount($dataTotal,'order_product_img');
										$imgTotalPrice = $imgTotal*$ordProduct["imgunitprice"];
										$amount = $ordProduct["basicprice"]+$imgTotalPrice;
										
									
									echo
									'
									<tr>
										<td align="center" class="botBorder3" style="padding-left:2%;"><strong>'.$sl.'</strong></td>
										<td align="left" class="botBorder3">'.$ordProduct["name"].' <font class="currency1">('.$ordProduct["basicprice"].')</font></td>
										<td align="center" class="botBorder3">'.$imgTotal.' &times; '.$product["imgunitprice"].' <font class="currency1">('.$imgTotalPrice.')</font></td>
										<td align="right" class="botBorder3" style="padding-right:15px;"><font class="currency1">'.$amount.'</td>
									</tr>									
									';
								}
																
								$vat=0;
								$shipping_charge=100;
								$grand_total=$subTotal+$vat+$shipping_charge;
								echo
								'
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:13px; font-weight:bold;">Sub Total - <font class="currencyBold">'.$order['sub_total'].'</font></td>
								</tr>
								<tr>
									<td align="right" colspan="4" style="padding-right:15px;">GST (0%) - '.$order['gst'].'</td>
								</tr>
								<tr>
									<td align="right" colspan="4" class="botBorder2" style="padding-right:15px;">Shipping Charge - '.$order['shipping_cost'].'</td>
								</tr>	
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:16px; font-weight:bold;">Total - '.$order['totalamount'].'</td>
								</tr>
								';
								?>		
								
							</table>
							<?php }else{?>
								 <p class="greenMessage" style="color:red">Wrong Id Provided</p>
							<?php } ?>
						</td>
					</tr>
					<?php if($orderProduct){?>
					<tr>
					<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
					<!-- #################### -->
					<div class="leftFloat div100" >
														<div align="left" class="headerCartProduct">
														<span class="leftFloat"><strong>Payment Details</strong></span>
														
														<div class="clearb"></div>
														</div>
														<div class="cartPhotoHolderDiv" title="">
														
														<div style="display:block;padding:20px;" align="left">
																<strong>Total Paid</strong><br />
																<?php echo $orderPayment['mc_currency'].' : '.$orderPayment['mc_gross']?><br />
															<strong>Paid Date</strong><br />
																<?php echo $orderPayment['payment_date']?><br />
																<strong>Payer Email</strong><br />
																<?php echo $orderPayment['payer_email']?><br />
															<strong>TXN Id</strong><br />
																<?php echo $orderPayment['txn_id']?><br />
																<strong>Verify Sign</strong><br />
																<?php echo $orderPayment['verify_sign']?><br />
																<strong>Currency</strong><br />
																<?php echo $orderPayment['mc_currency']?><br />
																<div class="clearb"></div>	
																
													</div>	
														<div class="clearb"></div>	
														</div>									
														</div>
					
					
					<!-- #################### -->
					<div class="clearb"></div>	
					<br/>
					</td></tr>
					
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