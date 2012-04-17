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
													/*	
													$data = array(		
															'id' => $tempProduct['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product_item');
														
														$product = $product[0];
													*/	
														// select image from table
														
														$data = array(		
															'temp_product_id' => $tempProduct['id']
															);									
														$productimage = $shDB->selectOnMultipleCondition($data,'temp_product_img','img_ord');
														?>
														<div class="leftFloat div100" id="cartProduct<?php echo $tempProduct['id']?>">
														<div align="left" class="headerCartProduct">
														<span class="leftFloat"><strong><?php echo $tempProduct['name'];?></strong></span>
														<span class="rightFloat"><a class="deleteRowBtn" href="javascript:void(0)" onclick="javascript:deleteMyCartProduct('<?php echo $tempProduct['id']?>','<?php echo $tempProduct['productid']?>')" title="Delete that product from Cart.">&nbsp;</a></span>
														<div class="clearb"></div>
														</div>
														<div class="cartPhotoHolderDiv" title="<?php echo $tempProduct['id']?>">
														
														<ul align="left" class="cartPhotoHolder" title="<?php echo $tempProduct['id']?>">
														<?php
														if($productimage){
															foreach($productimage as $prodimg){
																if($prodimg['img_id']){
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
														
																	// select image details ends her
																	echo '<li style="clear:both;list-style:none;"><ul style="margin:0px;padding:0px;">';
																	echo '<li class="cartPhotoImgHolder" style="height:42px;order:1px solid #33333" id="'.$prodimg['id'].'" title="'.$prodimg['id'].'">';
																		echo '<img title="'.$imageId[0]['image'].'" src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
																		echo '<span class="delSpan" style="position:absolute;z-index:5000" ><a class="delCartPhoto" onclick="emptyPhotoFromProd('.$prodimg['id'].','.$tempProduct['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a></span>';																	
																		echo '</li>';
																		echo '<li class="cartPhotoaddHolder" style="float:right;"><a class="changephoto" href="'.$log->baseurl.'index.php?pg=addphototoproduct&prodid='.$prodimg['id'].'"></a></li>';
																}else{
																	echo '<li class="cartPhotoImgHolder" style="height:42px;width:42px;border:1px solid #33333" id="'.$prodimg['id'].'" title="'.$prodimg['id'].'">';
																	
																		echo '</li>';
																		echo '<li class="cartPhotoaddHolder" style="float:right;"><a class="addphoto" href="'.$log->baseurl.'index.php?pg=addphototoproduct&prodid='.$prodimg['id'].'"></a></li>';
																}
																echo '</ul></li>';
															}
														}
														/* 
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
														*/
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
						<?php if($dataInTempProduct){?>
							<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
								<tr>
									<td align="left" class="botBorder2" style="width:44%"><strong>Product Name (Price)</strong></td>
									<td align="center" class="botBorder2" style="width:44%"><strong>Unit Price</strong></td>
									<td align="right" class="botBorder2" style="width:12%;padding-right:15px;"><strong>Amount</strong></td>
								</tr>
								<?php
								
									$subTotal = 0;
									foreach ($dataInTempProduct as $tempProduct){
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
										$dataTotal = array(		
												'temp_product_id' => $tempProduct['id']
												);
																					
										$imgid = $shDB->selectOnMultipleCondition($dataTotal,'temp_product_img');
										$imgid = $imgid[0]['img_id'];
										
										$imgTotalPrice = 1*$product["imgunitprice"];
										//$imgTotalPrice = $product["maxallowedimg"]*$product["imgunitprice"];
										$amount = $product["basicprice"]+$imgTotalPrice;
										$subTotal = $amount+$subTotal;
									
									echo
									'<tr>										
										<td align="left" class="botBorder3">'.$productname.'<br /><small>'.$product["name"].'</small></td>
										<td align="center" class="botBorder3">'.$settings['currency'].' '.$product["basicprice"].'</font></td>
										<td align="right" class="botBorder3" style="padding-right:15px;"><font class="currency1">'.$settings['currency'].' '.$amount.'</td>
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
									<td align="right" colspan="4" style="padding-right:15px; font-size:16px; font-weight:bold;">Total - '.$settings['currency'].'&nbsp;'.$grand_total.'</td>
								</tr>
								';
								?>
								<form action="<?php echo $log->baseurl;?>index.php?pg=confirmorder" method="POST" id="emailformsubmit">
								<tr>
									<td align="left" colspan="4" >
										<label>Order Email</label><br />
										<input type="text" style="width:250px;" id="orderemail" name="orderemail" value="<?php echo $_SESSION['email']?>">
									</td>
								</tr>
								<tr>
									<td align="left" colspan="4" >
									<?php echo '<p class="greenMessage" >'.$settings['productmessage'].'</p>';?>
								</td>
								</tr>
								
								<tr>
									<td align="left" colspan="4" >
									<table>
									<tr>
									<td><a href="<?php echo $log->baseurl;?>index.php?pg=invitation"  class="continueback"></a></td>
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