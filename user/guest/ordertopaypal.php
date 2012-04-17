<?php 
$toPaypal = false;
$orderid = '';
$selectOrderDatainTemp = array(		
							'userid' => $_SESSION['userid']
							);									
$dataInTempOrder = $shDB->selectOnMultipleCondition($selectOrderDatainTemp,'temp_order');
if($dataInTempOrder){
	$orderid = $dataInTempOrder[0]['id'];
}

if(isset($_REQUEST['randstring'])){
	if($dataInTempOrder === false){
	$datainsert = array(
							'id' => '',
							'userid' => $_SESSION['userid'],
							'randid' => $_REQUEST['randstring'],
							'totalamount' => $_REQUEST['totalprice'],
							'sub_total' => $_REQUEST['subtotal'],
							'gst' => $_REQUEST['gst'],
							'shipping_cost' => $_REQUEST['shippingcharge'],
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
							'userid' => $_SESSION['userid'],
							'randid' => $_REQUEST['randstring'],
							'totalamount' => $_REQUEST['totalprice'],
							'sub_total' => $_REQUEST['subtotal'],
							'gst' => $_REQUEST['gst'],
							'shipping_cost' => $_REQUEST['shippingcharge'],
							'message' => $_REQUEST['ordermessage'],
							'ordertime' => timetodb()
	
		);
		$result = $shDB->update($datainsert,$dataInTempOrder[0]['id'],'temp_order');	
		if($result){
			$orderid = $dataInTempOrder[0]['id'];
			$orderamount = $_REQUEST['totalprice'];
		}
	}
}


?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="orderListIcon">&nbsp;</div></td><td valign="middle">Paypal to Order</td>
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
								
					<!-- ############################################################################ -->
					<?php 
						if($orderid!=''){							
					
					//var_dump($_REQUEST);
					
				
				
					$p = new paypal_class();             // initiate an instance of the class
					$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
            
// setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
					$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) {
    
   case 'process':      // Process and order...

      
      
      $p->add_field('business', 's.zaman@oscillosoft.com.au');
      $p->add_field('return', $log->baseurl.'user/index.php?pg=paypalreturn&action=success&userid='.$_SESSION['userid'].'&orderid='.$orderid);
      $p->add_field('cancel_return', $log->baseurl.'user/index.php?pg=paypalreturn&action=cancel&userid='.$_SESSION['userid'].'&orderid='.$orderid);
      $p->add_field('notify_url', $log->baseurl.'user/index.php?pg=paypalreturn&action=ipn&userid='.$_SESSION['userid'].'&orderid='.$orderid);
      $p->add_field('item_name', 'Album Order');
	  $p->add_field('quantity', '1');
      $p->add_field('amount', $orderamount);

      $p->submit_paypal_post(); // submit the fields to paypal
      //$p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   	  case 'success': 
   	  	     // Order was successful...
   	  	     var_dump($_REQUEST);
  			 $selectOrderDatainTemp = array(		
							'id' => $_REQUEST['orderid']
							);									
			$dataInTempOrder = $shDB->selectOnMultipleCondition($selectOrderDatainTemp,'temp_order');
			var_dump('Selem temp order status'.$dataInTempOrder);
			if($dataInTempOrder){
					$datainsert = array(
							'id' => '',
							'userid' => $dataInTempOrder[0]['userid'],
							'totalamount' => $dataInTempOrder[0]['totalamount'],
							'sub_total' => $dataInTempOrder[0]['sub_total'],
							'gst' => $dataInTempOrder[0]['gst'],
							'shipping_cost' => $dataInTempOrder[0]['shipping_cost'],
							'message' => $dataInTempOrder[0]['message'],
							'ordertime' => timetodb()	
				);
				
			$insertOrderId = $shDB->insert($datainsert,'order');
			var_dump('insert order status'.$insertOrderId);
				if($insertOrderId){
					$datatoPaymentTable = array(
					  'id' => '',
					  'orderid' => $_REQUEST['orderid'],
					  'mc_gross' => $_REQUEST['mc_gross'],
					  'protection_eligibility' => $_REQUEST['protection_eligibility'],
					  'orderid' => $_REQUEST['orderid'],					
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

					$insertOrderPayemntId = $shDB->insert($datainsert,'order_payment');
					var_dump('insert order payemnt status'.$insertOrderPayemntId);
					if($insertOrderId){
						 echo "<p class=\"greenMessage\">Thank you for your order.</p>";
					}
				}
			}
      // This is where you would probably want to thank the user for their order
      // or what have you.  The order information at this point is in POST 
      // variables.  However, you don't want to "process" the order until you
      // get validation from the IPN.  That's where you would have the code to
      // email an admin, update the database with payment status, activate a
      // membership, etc.  
 		/*
      echo "<html><head><title>Success</title></head><body><h3>Thank you for your order.</h3>";
      foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      echo "</body></html>";
      */
      // You could also simply re-direct them to another page, or your own 
      // order status page which presents the user with the status of their
      // order based on a database (which can be modified with the IPN code 
      // below).
      
      break;
      
   case 'cancel':       // Order was canceled...

      // The order was canceled before being completed.
 
      echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
      echo "</body></html>";
      
      break;
      
   case 'ipn':          // Paypal is calling page for IPN validation...
   
      // It's important to remember that paypal calling this script.  There
      // is no output here.  This is where you validate the IPN data and if it's
      // valid, update your database to signify that the user has payed.  If
      // you try and use an echo or printf function here it's not going to do you
      // a bit of good.  This is on the "backend".  That is why, by default, the
      // class logs all IPN data to a text file.
      
      if ($p->validate_ipn()) {
          
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
  
         // Check the paypal documentation for specifics on what information
         // is available in the IPN POST variables.  Basically, all the POST vars
         // which paypal sends, which we send back for validation, are now stored
         // in the ipn_data() array.
  
         // For this example, we'll just email ourselves ALL the data.
         $subject = 'Instant Payment Notification - Recieved Payment';
         $to = 'YOUR EMAIL ADDRESS HERE';    //  your email
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nDetails:\n";
         
         foreach ($p->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
         mail($to, $subject, $body);
      }
      break;
 }  
 
						}else{
							 echo "<p class=\"greenMessage\" style=\"color:red\">No order placed yet.</p>";
						}
 
 ?>
 
					<!-- ############################################################################ -->
					</td></tr>					
				</table>
			</div>
		</div>
	</div>
</div>
