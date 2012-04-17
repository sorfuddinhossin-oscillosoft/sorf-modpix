<?php 
if(isset($_REQUEST['orderemail'])){
	$_SESSION['email']=$_REQUEST['orderemail'];
}

if($_SESSION['email']==''){
	echo '<script>
														location.href="'.$log->base_url.'index.php?pg=checkout";
														</script>';
}
$selectProductDatainTemp = array(		
							'sessionid' => $_SESSION['sessionid']
							);									
$dataInTempProduct = $shDB->selectOnMultipleCondition($selectProductDatainTemp,'temp_product');
$selectOrderDatainTemp = array(		
							'useremail' => $_SESSION['email']
							);									
$dataInTempOrder = $shDB->selectOnMultipleCondition($selectOrderDatainTemp,'temp_order');
$selectSettings = array(		
																	'id' => 1
																	);									
										$settings = $shDB->selectOnMultipleCondition($selectSettings,'`settings`');
										$settings = $settings[0];
?>
<h1 class="pagetitle">Checkout</h1>
<div class="webcontent">
<table width="100%">
<tr>
<td valign="top">
		
			
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="" style="width:96%; padding-left:2%;">
							<h2 class="subTitleh2" style="width:529px;">Order Confirm</h2>
						</td>
					</tr>
						<tr>
						<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
						<?php echo '<p class="greenMessage" >'.$settings['productmessage'].'</p>';?>
						</td>
					</tr>
					
					<tr>
						<td align="center" colspan="2" style="padding-left:1%; padding-right:1%; width:98%;">
						<?php if($dataInTempProduct){?>
							<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
								<tr>
									<td align="left" class="botBorder2" style="width:30%"><strong>Product Name (Price)</strong></td>
									<td align="center" class="botBorder2" style="width:20%"><strong>Base Price</strong></td>
									<td align="left" class="botBorder2" style="width:40%"><strong>Product Option</strong></td>
									<td align="right" class="botBorder2" style="width:10%;padding-right:15px;"><strong>Amount</strong></td>
								</tr>
								<?php
								
									$subTotal = 0;
									foreach ($dataInTempProduct as $tempProduct){
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
												$qry = 'select * from temp_item_option tio, prod_item_option pio where tio.prod_item_option_id=pio.id AND tio.temp_product_id='.$tempProduct['id'];
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
											
											/*
												$qry = 'select * from prod_item_option pto, itemoption io where pto.optionid = io.id AND pto.item_id='.$optionValue['prod_item_option_id'];
												$query = $shDB->qry($qry); 
												$itemOptiondata=mysql_fetch_array($query);
												
												var_dump($itemOptiondata);
												
												*/
												
												 $itemOptiondata = array('id' => $optionValue['optionid']);		

														
												$itemOptiondata = $shDB->selectOnMultipleCondition($itemOptiondata,'itemoption');
											
												
												//
												//$itemOptiondata = $itemOptiondata[0]; 
												
												
												$optionCost = $optionCost + $optionValue['cost'];
												
												/* $itemOptiondataNameandValue = array('id' => $itemOptiondata['optionid']);									
												$itemOptiondataNameandValue = $shDB->selectOnMultipleCondition($itemOptiondataNameandValue,'itemoption');
												$itemOptiondataNameandValue = $itemOptiondataNameandValue[0]; */
												
												$itemOptiondataNameandValue = $itemOptiondata[0];
												
												$optionString .= $itemOptiondataNameandValue['name'].' : '.$itemOptiondataNameandValue['value'].' ('.$settings['currency'].' '. number_format($optionValue['cost'],2,'.','').')<br />';
											}
										}	
										$optionDescription = '';
										if($tempProduct['additionalleaf']>0){
											$additionalLeafCost = $tempProduct['additionalleaf']*$tempProduct['addsidecost'];
											$optionDescription .= 'Additional Sides : '.$tempProduct['additionalleaf'].'&times'.$tempProduct['addsidecost'].' = '.$settings['currency'].number_format($additionalLeafCost,2,'.','').'<br />';
											
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
									<td align="right" colspan="4" style="padding-right:15px; font-size:13px; font-weight:bold;">Sub Total ('.$settings['currency'].') - <font class="currencyBold">$'.$subTotal.'</font></td>
								</tr>
								<tr>
									<td align="right" colspan="4" style="padding-right:15px;">GST ('.$settings['gst'].'%) - '.$vat.'</td>
								</tr>
								<tr>
									<td align="right" colspan="4" class="botBorder2" style="padding-right:15px;">Shipping Charge - '.$shipping_charge.'</td>
								</tr>	
								-->
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:16px; font-weight:bold;">Total - '.$settings['currency'].' '. number_format($grand_total,2,'.','').'</td>
								</tr>
								';
								?>
								<tr>
									<td align="right" colspan="4" >
										<form action="<?php echo $log->baseurl;?>index.php?pg=finalorder" id="confirmOrdertoPaypal" method="post">
							<table cellpadding="2" cellspacing="2" width="100%">
							<tr>
							<input type="hidden" name="randstring" value="<?php echo randStrGenerator();?>">
							<input type="hidden" name="totalprice" value="<?php echo $grand_total;?>">
							<input type="hidden" name="subtotal" value="<?php echo $subTotal;?>">
							<input type="hidden" name="gst" value="<?php echo $vat;?>">
							<input type="hidden" name="shippingcharge" value="<?php echo $shipping_charge;?>">
							<td colspan="2" align="left">
							<label>Leave a message about the order <span style="font-size:10px;font-weight:normal;color:#999999">(Optional)</span></label><br />
							<textarea style="width:528px;height:100px;" name="ordermessage" id="ordermessage"><?php echo $dataInTempOrder[0]['message'];?></textarea>
							<br />
							<!-- 
							<label>Shipping Method</label><br />
							<input type="radio" name="paymentmethod" value="paypal">Paypal<br />
							<input type="radio" name="paymentmethod" value="banktransfer">Bank Transfer<br />
							<div style="border:1px solid #ececec;padding:3px;display:block;background:#F2F7F7;margin-left:20px;font-size:10px;line-height:1.6em;">
								<strong>Bank Details</strong><br />
								Md Sorfuddin Hossin<br />
								  Dutch Bank<br />
								  127101127406
							</div>
							<input type="radio" name="paymentmethod" value="checkdeposit">Check Deposit<br />
							<div style="border:1px solid #ececec;padding:3px;display:block;background:#F2F7F7;margin-left:20px;font-size:10px;line-height:1.6em;">
								<span>Bank Name</span><br />
								<input type="text" name="bankname"><br />
								<span>Check Number</span><br />
								<input type="text" name="checknumber"><br />
								
							</div>
							 -->
							</td></tr>
							<tr><td colspan="2" align="left">
							<table>
							<tr>
							<td><a href="<?php echo $log->baseurl;?>index.php?pg=checkout"  class="back"></a></td>
							<td><a href="javascript:void(0);" onclick="formSubmit('confirmOrdertoPaypal')"  class="continue"></a></td>
							</tr>
							</table>							
							
							
							</td></tr>
							</table>
							</form>		
									</td>
								</tr>
								
							</table>
							<?php }else{?>
								 <p class="greenMessage" style="color:red">Cart is empty.</p>
							<?php } ?>
							
						</td>
					</tr>
					<tr><td align="center" colspan="2" style="padding-top:30px;">&nbsp;</td></tr>					
				</table>
</td>
<td class="webrightcontent" style="" valign="top">
 	<table width="100%">
						<tr>
						<td width="100%" valign="top">
						<div class="leftFloat div100" id=""  style="width:280px;overflow:hidden">
														<?php 
															$data = array(		
																'email' => $_SESSION['email']
															);									
															$billAddress = $shDB->selectOnMultipleCondition($data,'bill_address');
															$billAddress = $billAddress[0];
															
															if($billAddress){
																$billFormEdit = 'none';
																$billFormShow = 'block';
																$billBtnEdit = 'block';
																$billBtnSave = 'none';
															}else{
																$billFormEdit = 'block';
																$billFormShow = 'none';
																$billBtnEdit = 'none';
																$billBtnSave = 'block';
															}
															?>
														<div align="left" class="headerCartProduct" style="width:264px;margin-top:0px;">
														<span class="leftFloat"><strong>Billing Address</strong></span>	
														<span class="rightFloat"><a class="edit" id="billEdit" style="display:<?php echo $billBtnEdit;?>" href="javascript:void(0)" onclick="editaddress('bill','edit','<?php echo $_SESSION['email'];?>')" title="Edit">Edit</a><a class="edit" id="billSave" href="javascript:void(0)"  style="display:<?php echo $billBtnSave;?>"  onclick="editaddress('bill','save','<?php echo $_SESSION['email'];?>');" title="Save">Save</a></span>														
														<div class="clearb"></div>
														</div>
														<div class=cartddress id="cartbilladdress" title="" style="width:258px;padding:10px;" >
														
														<div id="billForm" style="display:<?php echo $billFormEdit;?>">
														
																<label>Company</label><br />
																<input type="text" id="bill_company" value="<?php echo $billAddress['company']?>"><br />
																<label>Full Name</label><br />
																<input type="text" id="bill_name" value="<?php echo $billAddress['name']?>"><br />
																<label>Address</label><br />
																<textarea style="width:250px;" id="bill_address" ><?php echo $billAddress['address']?></textarea><br />
																<label>Phone</label><br />
																<input type="text" id="bill_phone" value="<?php echo $billAddress['phone']?>"><br />
																<label>Fax</label><br />
																<input type="text" id="bill_fax" value="<?php echo $billAddress['fax']?>">
																
																<input type="hidden" id="bill_email" value="<?php echo $_SESSION['email'];?>"><br />
																<label>Zip</label><br />
																<input type="text" id="bill_zip" value="<?php echo $billAddress['zip']?>"><br />
																<label>City</label><br />
																<input type="text" id="bill_city" value="<?php echo $billAddress['city']?>"><br />
																<label>Country</label><br />
																<input type="text" id="bill_country" value="<?php echo $billAddress['country']?>"><br />
														</div>	
														<div id="billDetails" style="display:<?php echo $billFormShow;?>">
														
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
						</tr>
						<tr>
						<td width="100%" valign="top">
						<div class="leftFloat div100" id=""  style="width:280px;overflow:hidden">
						<?php 
															$data = array(		
																'email' => $_SESSION['email']
															);									
															$shipAddress = $shDB->selectOnMultipleCondition($data,'ship_address');
															
															$shipAddress = $shipAddress[0];
															if($shipAddress){
																$shipFormEdit = 'none';
																$shipFormShow = 'block';
																$shipBtnEdit = 'block';
																$shipBtnSave = 'none';
															}else{
																$shipFormEdit = 'block';
																$shipFormShow = 'none';
																$shipBtnEdit = 'none';
																$shipBtnSave = 'block';
															}
															
															
														?>
														<div align="left" class="headerCartProduct" style="width:264px;margin-top:0px;">
														<span class="leftFloat"><strong>Shipping Address</strong></span>
														<span class="rightFloat"><a class="edit" style="display:<?php echo $shipBtnEdit;?>" id="shipEdit" href="javascript:void(0)" onclick="editaddress('ship','edit','<?php echo $_SESSION['userid'];?>')" title="Edit">Edit</a><a class="edit" id="shipSave" href="javascript:void(0)"  style="display:<?php echo $shipBtnSave;?>"  onclick="editaddress('ship','save','<?php echo $_SESSION['userid'];?>');" title="Save">Save</a></span>														
														<div class="clearb"></div>
														</div>
														<div class="cartddress" id="cartshipaddress" style="width:258px;padding:10px;" >
														
														<div id="shipForm" style="display:<?php echo $shipFormEdit;?>">
														<label>Company</label><br />
																<input type="text" id="ship_company" value="<?php echo $shipAddress['company']?>"><br />
																<label>Full Name</label><br />
																<input type="text" id="ship_name" value="<?php echo $shipAddress['name']?>"><br />
																<label>Address</label><br />
																<textarea style="width:250px;" id="ship_address"><?php echo $shipAddress['address']?></textarea><br />
																<label>Phone</label><br />
																<input type="text" id="ship_phone" value="<?php echo $shipAddress['phone']?>"><br />
																<label>Fax</label><br />
																<input type="text" id="ship_fax" value="<?php echo $shipAddress['fax']?>">
																
																<input type="hidden" id="ship_email" value="<?php echo $_SESSION['email'];?>">
															<br />
																<label>Zip</label><br />
																<input type="text" id="ship_zip" value="<?php echo $shipAddress['zip']?>"><br />
																<label>City</label><br />
																<input type="text" id="ship_city" value="<?php echo $shipAddress['city']?>"><br />
																<label>Country</label><br />
																<input type="text" id="ship_country" value="<?php echo $shipAddress['country']?>"><br />
													</div>	
													<div id="shipDetails" style="display:<?php echo $shipFormShow;?>">
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
</table>
</div>