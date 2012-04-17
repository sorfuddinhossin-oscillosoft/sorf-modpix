<?php 
if($_SESSION['email']==''){
	echo '	<script>
														location.href="'.$log->base_url.'index.php?pg=checkout";
														</script>';
}
$toPaypal = false;
$orderid = '';
$delete = true;
$selectOrderDatainTemp = array(		
							'sessionid' => $_SESSION['sessionid']
							);									
$dataInTempOrder = $shDB->selectOnMultipleCondition($selectOrderDatainTemp,'temp_order');

if($dataInTempOrder){
	$orderid = $dataInTempOrder[0]['id'];
}

if(isset($_REQUEST['randstring'])){
	
	if($dataInTempOrder === false){
	$datainsert = array(
							'id' => '',
							'sessionid' => $_SESSION['sessionid'],
							'useremail' => $_SESSION['email'],
							'randid' => $_REQUEST['randstring'],
							'totalamount' => $_REQUEST['totalprice'],
							'sub_total' => $_REQUEST['subtotal'],
							'message' => $_REQUEST['ordermessage'],
							'ordertime' => timetodb()
	
		);
		$tempProductImgResult = $shDB->insert($datainsert,'temp_order');
		if($tempProductImgResult){
			$orderid = $tempProductImgResult;
			$orderamount = $_REQUEST['totalprice'];
		}
	}else{
		$datainsert = array(
							'sessionid' => $_SESSION['sessionid'],
							'useremail' => $_SESSION['email'],
							'randid' => $_REQUEST['randstring'],
							'totalamount' => $_REQUEST['totalprice'],
							'sub_total' => $_REQUEST['subtotal'],
							'message' => $_REQUEST['ordermessage'],
							'ordertime' => timetodb()
	);
		$result = $shDB->update($datainsert,$dataInTempOrder[0]['id'],'temp_order');
	}	
		if($orderid){
			
			$selectOrderDatainTempOrderNow = array(		
							'id' => $orderid
							);									
$selectOrderDatainTempOrderNow = $shDB->selectOnMultipleCondition($selectOrderDatainTempOrderNow,'temp_order');
			// ########################################
		$datainsert = array(
							'id' => '',
							'useremail' => $selectOrderDatainTempOrderNow[0]['useremail'],
							'totalamount' => $selectOrderDatainTempOrderNow[0]['totalamount'],
							'sub_total' => $selectOrderDatainTempOrderNow[0]['sub_total'],
							'gst' => $selectOrderDatainTempOrderNow[0]['gst'],
							'shipping_cost' => $selectOrderDatainTempOrderNow[0]['shipping_cost'],
							'message' => $selectOrderDatainTempOrderNow[0]['message'],
							'ordertime' => timetodb(),
							'status' => 'Enlisted'
					);				
					$insertOrderId = $shDB->insert($datainsert,'`order`');
					
					if($insertOrderId){
						
						$ok = true;
						/*
						//insert payment information against an order						
						$datatoPaymentTable = array(
							  'id' => '',
							  '`orderid`' => $insertOrderId,
							  'mc_gross' => $_REQUEST['mc_gross'],
							  'protection_eligibility' => $_REQUEST['protection_eligibility'],
							  'address_status' => $_REQUEST['address_status'],
							  'payer_id' => $_REQUEST['payer_id'],
							  'tax' => $_REQUEST['tax'],
							  'address_street' => $_REQUEST['address_street'],
							  'payment_date' => $_REQUEST['payment_date'],  
							  'payment_status' => $_REQUEST['payment_status'],
							  'charset' => $_REQUEST['charset'],
							  'address_zip' => $_REQUEST['address_zip'],
							  'first_name' => $_REQUEST['first_name'],
							  'address_country_code' => $_REQUEST['address_country_code'],
							  'address_name' => $_REQUEST['address_name'],
							  'notify_version' => $_REQUEST['notify_version'],
							  'custom' => $_REQUEST['custom'],
							  'payer_status' => $_REQUEST['payer_status'],
							  'business' => $_REQUEST['business'],
							  'address_country' => $_REQUEST['address_country'],
							  'address_city' => $_REQUEST['address_city'],  
							  'quantity' => $_REQUEST['quantity'],
							  'payer_email' => $_REQUEST['payer_email'],
							  'verify_sign' => $_REQUEST['verify_sign'],
							  'txn_id' => $_REQUEST['txn_id'],
							  'payment_type' => $_REQUEST['payment_type'],
							  'last_name' => $_REQUEST['last_name'], 
							  'address_state' => $_REQUEST['address_state'],
							  'receiver_email' => $_REQUEST['receiver_email'],
							  'pending_reason' => $_REQUEST['pending_reason'],
							  'txn_type' => $_REQUEST['txn_type'],
							  'item_name' => $_REQUEST['item_name'],  
							  'mc_currency' => $_REQUEST['mc_currency'],
							  'item_number' => $_REQUEST['item_number'],
							  'residence_country' => $_REQUEST['residence_country'],
							  'test_ipn' => $_REQUEST['test_ipn'],
							  'transaction_subject' => $_REQUEST['transaction_subject'],
							  'handling_amount' => $_REQUEST['handling_amount'],
							  'payment_gross' => $_REQUEST['payment_gross'],
							  'shipping' => $_REQUEST['shipping'] 
							);

					$insertOrderPayemntId = $shDB->insert($datatoPaymentTable,'`order_payment`');
					
				*/
					
					//########### Insert to Shipping Address   #############///
						$selectShippingAddress = array(		
							'email' => $_SESSION['email']
							);									
			$selectShippingAddress = $shDB->selectOnMultipleCondition($selectShippingAddress,'ship_address');
			$selectShippingAddress = $selectShippingAddress[0];
			
			// select billing address
			$selectBillingAddress = array(		
							'email' => $_SESSION['email']
							);									
			$selectBillingAddress = $shDB->selectOnMultipleCondition($selectBillingAddress,'bill_address');
			$selectBillingAddress = $selectBillingAddress[0];
					$datatoShipTable = array(
						'id' => '',
						'`order_id`' => $insertOrderId,
						'`company`' => $selectShippingAddress['company'],
						'`name`' => $selectShippingAddress['name'],
						'`address`' => $selectShippingAddress['address'],
						'`phone`' => $selectShippingAddress['phone'],
						'`fax`' => $selectShippingAddress['fax'],
						'`zip`' => $selectShippingAddress['zip'],
						'`city`' => $selectShippingAddress['city'],
						'`country`' => $selectShippingAddress['country'],
						'`email`' => $selectShippingAddress['email']						   
						);
					
					$insertShiptoOrder = $shDB->insert($datatoShipTable,'`order_ship_address`');
					
					//################### close insert shipping address ########///
				
					//########### Insert to billing Address   #############///
					$datatoBillTable = array(
						'id' => '',
						'`order_id`' => $insertOrderId,
						'`company`' => $selectBillingAddress['company'],
						'`name`' => $selectBillingAddress['name'],
						'`address`' => $selectBillingAddress['address'],
						'`phone`' => $selectBillingAddress['phone'],
						'`fax`' => $selectBillingAddress['fax'],
						'`zip`' => $selectBillingAddress['zip'],
						'`city`' => $selectBillingAddress['city'],
						'`country`' => $selectBillingAddress['country'],
						'`email`' => $selectBillingAddress['email']						   
						);
					
					$insertBilltoOrder = $shDB->insert($datatoBillTable,'`order_billing_address`');
					
					//################### close insert billing address ########///
					
					
					//select data from temp_product table
					
					$selectOrderDatainTemp = array(		
							'sessionid' => $_SESSION['sessionid']
							);									
					$dataInTempProduct = $shDB->selectOnMultipleCondition($selectOrderDatainTemp,'temp_product');
					
					
					
					foreach ($dataInTempProduct as $tempProd){
						
						// insert product against order 
						
						$datainsert = array(
							'id' => '',
							'orderid' => $insertOrderId,
							'productid' => $tempProd['productid'],
							'name' => $tempProd['name'],
							'album_id' => $tempProd['album_id'],
							'basicprice' => $tempProd['basicprice'],
							'imgquantity' => $tempProd['imgquantity'],
							'addsidecost' => $tempProd['addsidecost'],
							'additionalleaf' => $tempProd['additionalleaf'],
							'sidehole' => $tempProd['sidehole'],
							'addmaxsides' => $tempProd['addmaxsides'],
							'isalbum' => $tempProd['isalbum'],
							'noofcopy' => $tempProd['noofcopy']
						);				
						$insertOrderProduct = $shDB->insert($datainsert,'`order_product`');
						
						if($insertOrderProduct){
						// select image agains order product id
						$selectOrderImgDatainTemp = array(		
							'temp_product_id' => $tempProd['id']
							);									
						$dataInTempProductImg = $shDB->selectOnMultipleCondition($selectOrderImgDatainTemp,'temp_product_img');
						
							if($dataInTempProductImg){
							foreach ($dataInTempProductImg as $dataTPImg){
								
									// insert img id against an order product
									$datainserttoorderimg = array(
										'id' => '',
										'order_product_id' => $insertOrderProduct,
										'album_id' => $dataTPImg['album_id'],
										'sideid' => $dataTPImg['sideid'],
										'img_id' => $dataTPImg['img_id'],
										'img_ord' => $dataTPImg['img_ord']
									);				
									$insertOrderProductImg = $shDB->insert($datainserttoorderimg,'`order_product_img`');
									if(!$insertOrderProductImg){
										$delete = false;
									}
							}
							}
						
						///  
						$selectOrderItemDatainTemp = array(		
							'temp_product_id' => $tempProd['id']
							);									
						$selectOrderItemDatainTemp = $shDB->selectOnMultipleCondition($selectOrderItemDatainTemp,'temp_item_option');
						
						if($selectOrderItemDatainTemp){
							foreach ($selectOrderItemDatainTemp as $dataTPItem){
								
									// insert img id against an order product
									$datainserttoorderitemOption = array(
										'id' => '',
										'order_product_id' => $insertOrderProduct,
										'prod_item_option_id' => $dataTPItem['prod_item_option_id']
									);				
									$insertOrderProductOptionItem = $shDB->insert($datainserttoorderitemOption,'`order_item_option`');
									if(!$insertOrderProductOptionItem){
										$delete = false;
									}
							}
						}	
							
						}						
					}					
				}
			// ########################################
		}
	
}
?>
<h1 class="pagetitle">Order Confirmation</h1>
<div class="webcontent">
<table width="100%">
<tr>
<td valign="top">
		<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="" style="width:96%; padding-left:2%;">
							
						</td>
					</tr>
					<tr>
					<td align="center"> 
					<h1 style="text-align:center;color:green;font-weight:bold;font-size:15px;">Thanks for your order.</h1>
					<a href="<?php echo $log->baseurl;?>index.php?pg=payment">Make your Payment</a>
					
					<?php 
					
					if($delete === true){

						/*
						 * Delete all the temp data from cart
						 */
						
						$clearTorder = array(
								'sessionid' => $_SESSION['sessionid']
								);
						$result = $shDB->deleteOnMultipleCondition($clearTorder,'temp_order');

						$clearTempProduct = array(
								'sessionid' => $_SESSION['sessionid']
								);
						$result = $shDB->deleteOnMultipleCondition($clearTempProduct,'temp_product');
						
						/*
						 * 
						 * 
						 * 
						 * 
						 */
						/*
						$clearTempProduct = array(
								'sessionid' => $_SESSION['sessionid']
								);
						$result = $shDB->deleteOnMultipleCondition($clearTempProduct,'temp_product_img');
					*/
						
					}
					
					?>
								
					</td>
					</tr>
										
			</table>					
</td>
</tr>
</table>
</div>