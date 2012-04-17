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
							<td><div class="orderListIcon">&nbsp;</div></td><td valign="middle">Checkout</td>
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
						
						<?php if($dataInTempProduct) {?>
						
						<table width="100%">
						<tr>
						<td width="50%" valign="top">
						<div class="leftFloat div100" id=""  style="width:314px">
														<div align="left" class="headerCartProduct" style="width:314px">
														<span class="leftFloat"><strong>Billing Address</strong></span>	
														<span class="rightFloat"><a class="edit" id="billEdit" href="javascript:void(0)" onclick="editaddress('bill','edit',<?php echo $_SESSION['userid'];?>)" title="Edit">Edit</a><a class="edit" id="billSave" href="javascript:void(0)" style="display:none" onclick="editaddress('bill','save',<?php echo $_SESSION['userid'];?>);" title="Save">Save</a></span>														
														<div class="clearb"></div>
														</div>
														<div class=cartddress id="cartbilladdress" title="" style="width:308px;padding:10px;" >
														<?php 
															$data = array(		
																'id' => $_SESSION['userid']
															);									
															$billAddress = $shDB->selectOnMultipleCondition($data,'bill_address');
															
															$billAddress = $billAddress[0];
															?>
														<div id="billForm" style="display:none">
																<label>Company</label><br />
																<input type="text" id="bill_company" value="<?php echo $billAddress['company']?>"><br />
																<label>Full Name</label><br />
																<input type="text" id="bill_name" value="<?php echo $billAddress['name']?>"><br />
																<label>Address</label><br />
																<textarea style="width:298px;" id="bill_address" ><?php echo $billAddress['address']?></textarea><br />
																<label>Phone</label><br />
																<input type="text" id="bill_phone" value="<?php echo $billAddress['phone']?>"><br />
																<label>Fax</label><br />
																<input type="text" id="bill_fax" value="<?php echo $billAddress['fax']?>"><br />
																<label>Email</label><br />
																<input type="text" id="bill_email" value="<?php echo $billAddress['email']?>"><br />
																<label>Zip</label><br />
																<input type="text" id="bill_zip" value="<?php echo $billAddress['zip']?>"><br />
																<label>City</label><br />
																<input type="text" id="bill_city" value="<?php echo $billAddress['city']?>"><br />
																<label>Country</label><br />
																<input type="text" id="bill_country" value="<?php echo $billAddress['country']?>"><br />
														</div>	
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
														<span class="rightFloat"><a class="edit" id="shipEdit" href="javascript:void(0)" onclick="editaddress('ship','edit',<?php echo $_SESSION['userid'];?>)" title="Edit">Edit</a><a class="edit" id="shipSave" href="javascript:void(0)" style="display:none" onclick="editaddress('ship','save',<?php echo $_SESSION['userid'];?>);" title="Save">Save</a></span>														
														<div class="clearb"></div>
														</div>
														<div class="cartddress" id="cartshipaddress" style="width:308px;padding:10px;" >
														<?php 
															$data = array(		
																'id' => $_SESSION['userid']
															);									
															$shipAddress = $shDB->selectOnMultipleCondition($data,'ship_address');
															
															$shipAddress = $shipAddress[0];
															
															
														?>
														<div id="shipForm" style="display:none">
														<label>Company</label><br />
																<input type="text" id="ship_company" value="<?php echo $shipAddress['company']?>"><br />
																<label>Full Name</label><br />
																<input type="text" id="ship_name" value="<?php echo $shipAddress['name']?>"><br />
																<label>Address</label><br />
																<textarea style="width:298px;" id="ship_address"><?php echo $shipAddress['address']?></textarea><br />
																<label>Phone</label><br />
																<input type="text" id="ship_phone" value="<?php echo $shipAddress['phone']?>"><br />
																<label>Fax</label><br />
																<input type="text" id="ship_fax" value="<?php echo $shipAddress['fax']?>"><br />
																<label>Email</label><br />
																<input type="text" id="ship_email" value="<?php echo $shipAddress['email']?>"><br />
																<label>Zip</label><br />
																<input type="text" id="ship_zip" value="<?php echo $shipAddress['zip']?>"><br />
																<label>City</label><br />
																<input type="text" id="ship_city" value="<?php echo $shipAddress['city']?>"><br />
																<label>Country</label><br />
																<input type="text" id="ship_country" value="<?php echo $shipAddress['country']?>"><br />
													</div>	
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
								<tr>
									<td align="center" colspan="4">
									<a href="<?php echo $log->baseurl;?>user/index.php?pg=confirmorder"  class="continue"></a>
									</td>
									</tr>
							</table>
							
							
						<?php } else {?>
						 <p class="greenMessage" style="color:red">Cart is empty.</p>
							<?php }?>
						</td>
					</tr>
					<tr><td align="center" colspan="2" style="padding-top:30px;">&nbsp;</td></tr>					
				</table>
			</div>
		</div>
	</div>
</div>
