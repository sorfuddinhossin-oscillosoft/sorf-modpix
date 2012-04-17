<?php
/*
$selectProductDatainTemp = array(		
							'logonid' => $_SESSION['userid']
							);	
						*/	
$selectProductDatainTemp = array(		
							'sessionid' => $_SESSION['sessionid']
							);		
												
$dataInTempProduct = $shDB->selectOnMultipleCondition($selectProductDatainTemp,'temp_product');
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
							<h2 class="subTitleh2" style="width:100%">Order Item and Invoice Details</h2>
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
							<?php 
												if($dataInTempProduct){
												foreach ($dataInTempProduct as $tempProduct){
													//re-code bof
													$qry = 'select p.name from prod_item pi, product p where pi.prod_id=p.id AND pi.id='.$tempProduct['productid'];
													$q = $shDB->qry($qry); 
													$presults=mysql_fetch_array($q);
													$product_name=$presults['name'];
													//re-code eof
													/*	
													$data = array(		
															'id' => $tempProduct['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product_item');
														
														$product = $product[0];
													*/	
														// select image from table
														
														$data = array(		
															'temp_product_id' => $tempProduct['id'],
															'sideid' => 1
															);									
														$productimage = $shDB->selectOnMultipleCondition($data,'temp_product_img','img_ord');
														
														?>
														<div class="leftFloat div100" id="cartProduct<?php echo $tempProduct['id']?>">
														<div align="left" class="headerCartProduct">
														<span class="leftFloat"><strong><?php echo $product_name;?> &nbsp; <span style="color: #D95700;">(<?php echo $tempProduct['name'];?>)</span></strong></span>
														<span class="rightFloat">
														<?php 
														echo '<a class="addphoto" href="'.$log->baseurl.'index.php?pg=arrangephoto&prodid='.$tempProduct['productid'].'" onclick="writesession('.$tempProduct['productid'].')"></a>';
														?>
														
														<a class="deleteRowBtn" href="javascript:void(0)" onclick="javascript:deleteMyCartProduct('<?php echo $tempProduct['id']?>','<?php echo $tempProduct['productid']?>')" title="Delete that product from Cart.">&nbsp;</a></span>
														<div class="clearb"></div>
														</div>
														<div class="cartPhotoHolderDiv" title="<?php echo $tempProduct['id']?>">
														
														<div style="margin:3px;background:#FAFAFA;width:340px;display:block;float:left;border:1px solid #ececec;">
														<?php 
														if($productimage){
															foreach($productimage as $prodimg){
																
																	// select image details
																	
																	$datainsert = array(
																						'id' => $prodimg['img_id']
																						);
																	$imageId = $shDB->selectOnMultipleCondition($datainsert,'album_image');
																	
																	$dataSelect = array(
																						'id' => $imageId[0]['album_id']
																						);
																	$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'album');
																	
																	$albumName = str_replace(' ','_',$imageDetails[0]['album_name']);
																		$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/';
																		$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/thumbs/';
																		$noImage=$log->baseurl.'/images/nophoto.png';
																	// select image details ends her
																//	echo '<img title="'.$imageId[0]['image'].'" src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
																
																	echo '<div class="cartImgHolder">
																	<a class="imagePlaceMent" href="javascript:void(0)">
																	 <img title="'.$imageId[0]['image'].'" src="'.(($imageId[0]['image'] !="")?$useralbumthumburl.$imageId[0]['image']:$noImage).'" />
																	 </a>
																	    </div>';
															
														}
														}
														?>
														</div>
														<div style="width:190px;display:block;float:right;"></div>
														
														
														
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
										$data = array('id' => $tempProduct['productid']);									
										$product = $shDB->selectOnMultipleCondition($data,'prod_item'); 
										$product = $product[0];
										$dataforProduct = array('id' => $product['prod_id']);									
										$productname = $shDB->selectOnMultipleCondition($dataforProduct,'product');
										$productname = $productname[0]['name'];	
										
										
										/* $tempOptiondata = array('temp_product_id' => $tempProduct['id']);									
										$tempOptiondata = $shDB->selectOnMultipleCondition($tempOptiondata,'temp_item_option'); */
										
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
										<td align="center" class="botBorder3">'.$settings['currency'].' '.number_format($product["basicprice"],2,'.','').'</font></td>
										<td align="left" class="botBorder3">'.$optionDescription.'</font></td>
										<td align="right" class="botBorder3" style="padding-right:15px;"><font class="currency1">'.$settings['currency'].' '.number_format($itemTotal,2,'.','').'</td>
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
								<form action="<?php echo $log->baseurl;?>index.php?pg=confirmorder" method="POST" id="emailformsubmit">
								<tr>
									<td align="left" colspan="4" >
										<label>Order Email</label>
										<input type="text" style="width:250px;" id="orderemail" name="orderemail" value="<?php echo $_SESSION['email']?>">
									</td>
								</tr>
								<tr>
									<td align="left" colspan="4" >
									<label style="color: #FF9900;">Note</label>
									<?php echo '<p class="greenMessage" style="padding: 1px; text-align: justify;" >'.$settings['cartordermessage'].'</p>';?>
								</td>
								</tr>
								
								<tr>
									<td align="left" colspan="4" >
									<table>
									<tr>
									<td><a href="<?php echo $log->baseurl;?>index.php?pg=invitation"  class="back"></a></td>
									<td><a href="javascript:void(0)" id="continuetoorder" class="processorder"></a></td>
									</tr>
									</table>
									
										
									</td>
								</tr>
								</form>
								
							</table>
							<?php }else{?>
								 <p class="greenMessage" style="color:red">Cart is empty.</p>
							<?php } ?>
							
						</td>
					</tr>
					<tr><td align="center" colspan="2" style="padding-top:30px;">&nbsp;</td></tr>					
				</table>
</td>	


			
</tr>
</table>
</div>