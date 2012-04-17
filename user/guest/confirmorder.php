<?php 
$selectProductDatainTemp = array(		
							'logonid' => $_SESSION['userid']
							);									
$dataInTempProduct = $shDB->selectOnMultipleCondition($selectProductDatainTemp,'temp_product');

$selectOrderDatainTemp = array(		
							'userid' => $_SESSION['userid']
							);									
$dataInTempOrder = $shDB->selectOnMultipleCondition($selectOrderDatainTemp,'temp_order');

?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="orderListIcon">&nbsp;</div></td><td valign="middle">Confirm Checkout</td>
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
						<td align="left" class="tableHeader" style="width:48%; padding-left:2%;">Order Confirm and Continue to Paypal</td>
						<td align="right" valign="bottom" class="tableHeader" style="width:48%; padding-right:2%;">						
						</td>
					</tr>
					<?php if($dataInTempProduct){?>
					<tr>
						<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
						<p class="greenMessage">
						We don't take photos just so later they will be forgotten on a disc or in a folder. These memories need to be shared and enjoyed, displayed, on a holiday card, under a gallery light or in a wedding album.
						</p>
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
								
								$gst=0;
								$shipping_charge=100;
								$grand_total=$subTotal+$vat+$shipping_charge;
								echo
								'
								<tr>
									<td align="right" colspan="4" style="padding-right:15px; font-size:13px; font-weight:bold;">Sub Total - <font class="currencyBold">'.$subTotal.'</font></td>
								</tr>
								<tr>
									<td align="right" colspan="4" style="padding-right:15px;">GST (0%) - '.$gst.'</td>
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
							<form action="<?php echo $log->baseurl;?>user/index.php?pg=ordertopaypal" id="confirmOrdertoPaypal" method="post">
							<table cellpadding="2" cellspacing="2" width="100%">
							<tr>
							<input type="hidden" name="randstring" value="<?php echo randStrGenerator();?>">
							<input type="hidden" name="totalprice" value="<?php echo $grand_total;?>">
							<input type="hidden" name="subtotal" value="<?php echo $subTotal;?>">
							<input type="hidden" name="gst" value="<?php echo $gst;?>">
							<input type="hidden" name="shippingcharge" value="<?php echo $shipping_charge;?>">
							<td colspan="2" align="left"><label>Leave a message about the order <span style="font-size:10px;font-weight:normal;color:#999999">(Optional)</span></label><br />
																<textarea style="width:668px;height:100px;" name="ordermessage" id="ordermessage"><?php echo $dataInTempOrder[0]['message'];?></textarea>
																</td></tr>
							<tr><td width="115" align="right">
							<a href="<?php echo $log->baseurl;?>user/index.php?pg=checkout"  class="back"></a>
							</td><td align="left">
							<a href="javascript:void(0);" onclick="formSubmit('confirmOrdertoPaypal')"  class="continuetopaypal"></a>
							</td></tr>
							</table>
							</form>						
						</td>
					</tr>
					<?php }else{?>
								 <tr><td align="center" colspan="2"><p class="greenMessage" style="color:red">Cart is empty.</p></td></tr>
							<?php } ?>
					<tr><td align="center" colspan="2" style="padding-top:30px;">&nbsp;</td></tr>					
				</table>
			</div>
		</div>
	</div>
</div>
