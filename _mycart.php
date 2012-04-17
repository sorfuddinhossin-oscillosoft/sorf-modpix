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

<h1 class="pagetitle">My Cart</h1>
<div class="webcontent">
<table width="100%">
<tr>
<td valign="top">
		
			
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="" style="width:96%; padding-left:2%;">
							<h2 class="subTitleh2">Order Item and Invoice Details</h2>
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
																	echo '<li class="cartPhotoImgHolder" style="height:42px;order:1px solid #33333" id="'.$prodimg['id'].'" title="'.$prodimg['id'].'">';
																		echo '<img src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
																		echo '<span class="delSpan" style="position:absolute;z-index:5000" ><a class="delCartPhoto" onclick="emptyPhotoFromProd('.$prodimg['id'].','.$tempProduct['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a></span>';																	
																		echo '</li>';
																}else{
																	echo '<li class="cartPhotoImgHolder" style="height:42px;width:42px;border:1px solid #33333" id="'.$prodimg['id'].'" title="'.$prodimg['id'].'">';
																	
																		echo '</li>';
																}
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
									<td align="left" class="botBorder2" style="width:66%"><strong>Product Name</strong></td>
									<td align="center" class="botBorder2" style="width:22%"><strong>Unit Price</strong></td>
									
									<td align="right" class="botBorder2" style="width:12%;padding-right:15px;"><strong>Amount</strong></td>
								</tr>
								<?php
								
									$subTotal = 0;
									foreach ($dataInTempProduct as $tempProduct){
										$data = array(		
															'id' => $tempProduct['productid']
															);									
														$product = $shDB->selectOnMultipleCondition($data,'product_item');
														
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
									'
									<tr>
										
										<td align="left" class="botBorder3">'.$productname.'<br /><small>'.$product["name"].'</small></td>
										<td align="center" class="botBorder3">$'.$product["basicprice"].'</td>
										<td align="right" class="botBorder3" style="padding-right:15px;"><font class="currency1">$'.$amount.'</td>
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
									<td align="right" colspan="4" style="padding-right:15px; font-size:16px; font-weight:bold;">Total ('.$settings['currency'].') - $'.$grand_total.'</td>
								</tr>
								';
								?>
								<tr>
									<td align="left" colspan="4" >
									<?php echo '<p class="greenMessage" >'.$settings['productmessage'].'</p>';?>
								</td>
								</tr>
								<tr>
									<td align="left" colspan="4" >
									<table>
									<tr>
									<td><a href="<?php echo $log->baseurl;?>index.php?pg=invitation"  class="browsephoto"></a></td>
									<td><a href="<?php echo $log->baseurl;?>index.php?pg=checkout"  class="processorder"></a></td>
									</tr>
									</table>
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
<td class="webrightcontent" valign="top">
   <!-- ################ -->
   <?php 
   if(isset($_REQUEST['secureemail'])){
				
   if($_REQUEST['loginas']==3){
				$selectAlbumByEmail = array(		
					'guest_id' => trim($_REQUEST['secureemail']),
					'isowner' => 1
					);
				}else{
					$selectAlbumByEmail = array(		
					'guest_id' => trim($_REQUEST['secureemail']),
					'isowner' => 0
					);
				}
							
						$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
						
						if(!$selectAlbumByEmail){
							echo 'No collection found';
						}else{
							//var_dump($selectAlbumByEmail);
							foreach($selectAlbumByEmail as $albByEmail){
									$selectAlbum = array(		
									'id' => $albByEmail['album_id'],
									'securitycode'  => $_REQUEST['scode']
									);									
									$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');	
							}							
						}
						if($selectAlbum){
										$_SESSION['email'] = $_REQUEST['secureemail'];
										$_SESSION['scode'] = $_REQUEST['scode'];	
										$_SESSION['userlevel'] = $_REQUEST['loginas'];
						}
			}
			
			
			if(isset($_SESSION['email'])&&isset($_SESSION['scode'])){
				$selectAlbumByEmail = array(		
							'guest_id' => $_SESSION['email']
				);

			$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
			if(!$selectAlbumByEmail){
							echo 'No collection found';
						}else{
							//var_dump($selectAlbumByEmail);
							foreach($selectAlbumByEmail as $albByEmail){
									$selectAlbum = array(		
									'id' => $albByEmail['album_id'],
									'securitycode'  => $_SESSION['scode']
									);									
									$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');	
													
							}							
						}
			}

	if($selectAlbum){?>
		
		<h1 style="font-size:12px;font-weight:bold;margin-left:12px;margin-bottom:3px;">Photo Collection:</h1>
		<p style="color:green;padding:3px 12px;margin:0px;font-size:11px;">To ascociate an image to the product, drug and drop the image to the empty product hole.</p>
		<ul class="cartAlbum">
							
							
							
							<?php foreach($selectAlbum as $collection) {
							$albumName = str_replace(' ','_',$collection['album_name']);
						$useralbumurl = $log->baseurl.'user/profile/'.$collection['album_create_by'].'/'.$collection['id'].'_'.$albumName.'/';
						$useralbumthumburl = $log->baseurl.'user/profile/'.$collection['album_create_by'].'/'.$collection['id'].'_'.$albumName.'/thumbs/';
						
						$data = array(		
									'album_id' => $collection['id']
									);
									
						$photo = $shDB->selectOnMultipleCondition($data,'album_image');
						
						?>
							<li>
							<h1 class="cartAlbumHeader"><?php echo $collection['album_name'];?><small style="float:right"><?php echo $collection['event_place'];?></small></h1>
							
							<span><?php 
						for($i=0;$i<sizeof($photo);$i++){
						echo '<a title="Drug to the empty product" href="'.$useralbumurl.$photo[$i]['image'].'" class="veryeasylightbox" rel="'.$useralbumurl.$photo[$i]['image'].'" ><div class="thumbimagediv" id="'.$photo[$i]['id'].'"><img src="'.$useralbumthumburl.$photo[$i]['image'].'" /></div></a>';
					}
					?>
							</span>
							</li>
					<?php }?>
				</ul>
			<?php  }
			if(!$selectAlbum){
			?>
		<div style="background:#E1EAEA; display:block;" class="leftFloat div100" id="addNewPhotoDiv">
		<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="secureaccessform" id="secureaccessform">
					<table cellspacing="0" cellpadding="5" style="padding-left:10px; padding-right:10px;">
							<tbody>
							<tr>
							<td>
							<p style="color:red;margin:0px;font-size:11px;">To ascociate an image to the product, Please login with your email and securecode. Sothat you can ascociate images to the product.</p>
							</td>
							</tr>
							<tr>
							<td>
							<label>Login as</label><br />
								<input type="radio" name="loginas" value="3">Couple &nbsp;
								<input type="radio" name="loginas" value="4">Guest &nbsp;
								<br />
							</td>
							</tr>
						
						<tr>
							<td align="left">
							<strong>Email</strong><br />
							<input type="text" name="secureemail" style="width:150px;">
							</td>
							</tr>
							<tr>
							<td align="left">
							<strong>Secure Code</strong><br />
							<input type="text" name="scode" style="width:150px;">
							</td>
							</tr>
							<tr>
							<td align="left" rowspan="2" valign="bottom">
							<input type="submit" name="securelogin" value="Submit">
							</td>							
						</tr>
						<tr><td colspan="3"></td></tr>
					</tbody></table>
			</form>
			</div>
			<?php } ?>	
   <!-- ################ -->	
</td>	
</tr>
</table>

</div>