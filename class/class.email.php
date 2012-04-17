<?php 
class sh_Email {
		
	 //public $hostname_logon = 'localhost';				//Database server LOCATION
	
	public function __construct() {	
		
	}
	
	public function __destruct() {	
		
	}
	
function requestforcode($name,$by,$collectionid) {
 			//include_once 'dbclass.php';

			$log = new logmein();
 			//var_dump($albumid);
			$shDB =new sh_DB();

			$settingsid = array(		
					'album_id' => $collectionid,
					'isowner' => 1
					);									
			$settings = $shDB->selectOnMultipleCondition($settingsid,'album_guest');
			$ownerEmail = $settings[0]['guest_id'];
			$collectionselectdata = array(		
					'id' => $collectionid
					);									
			$collectionselectdata = $shDB->selectOnMultipleCondition($collectionselectdata,'album');
			$albumName = $collectionselectdata[0]['album_name'];
			
			
			$from = $settings['admin_email'];
						
			//var_dump($albumDetails);			
			$subject = 'Modpix : Album Code Requested';
			
			$message = '<html><body style="background: #6E9091;font-size:8pt;font-family:tahoma,arial;padding:20px;">';
			$message .= '<img src="'.$log->baseurl.'images/modpix_logo.png" width="180" alt="Modpix" />';
			$message .= '<table width="80%" rules="" cellpadding="0" cellspacing="0">';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top left;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '<td style="background: #fff;border-top:1px solid #6E9091"></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top right;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background: #fff;"></td>';
			$message .= '<td style="background: #fff;font-size:11px;line-height:2.1em;">';
			$message .= '<table rules="" style="border-color: #666;" cellpadding="10">';
			$message .= '<tr ><td style="width:100px;font-size:11px;">Subject:</td><td style="font-size:11px;"><strong>'.$subject.'</strong> </td></tr>';
			$message .= '<tr ><td colspan="2" style="font-size:11px;">Dear Album Owner,<br /><strong>'.$name.'</strong> has request secure code for <strong>'.$albumName.'</strong></td></tr>';
			$message .= '<tr ><td style="font-size:11px;">Requester email:</td><td style="font-size:11px;"><strong>'.$by.'</strong> </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">Album Id:</td><td style="font-size:11px;"><strong>'.$collectionselectdata[0]['id'].'</strong></td></tr>';
			$message .= '<tr ><td style="font-size:11px;">Album Name:</td><td style="font-size:11px;"><strong>'.$name.'</strong></td></tr>';						
			$message .= '</table>';			 
			$message .= '</td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom left;width:14px;height:14px"></td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom right;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '</table><br />';
			$message .= '<p style="color:#fff;">';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=whoweare">Who we are?</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=products">Products</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=inquiry">Inquiry</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=contactus">Contact Us</a></p>';
			$message .= '<p style="color:black;font-size:10px;">Copyright 2011 &copy; Modpix. All rights reserved. </p>';
			$message .= '</body>';
			
			
			$headers = "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
            if (mail($ownerEmail, $subject, $message, $headers)) {
              return true;
            } else {
              return false;
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
    }
    
	function temPlateRegistration($name,$to,$pass) {
 			//include_once 'dbclass.php';

			$log = new logmein();
 			//var_dump($albumid);
			$shDB =new sh_DB();

			$settingsid = array(		
					'id' => 1
					);									
			$settings = $shDB->selectOnMultipleCondition($settingsid,'settings');
			$settings = $settings[0];
			$from = $settings['admin_email'];
						
			//var_dump($albumDetails);
			
			$subject = 'Modpix : Registration Successful';
			
					
			$message = '<html><body style="background: #6E9091;font-size:8pt;font-family:tahoma,arial;padding:20px;">';
			$message .= '<img src="'.$log->baseurl.'images/modpix_logo.png" width="180" alt="Modpix" />';
			$message .= '<table width="80%" rules="" cellpadding="0" cellspacing="0">';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top left;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '<td style="background: #fff;border-top:1px solid #6E9091"></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top right;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background: #fff;"></td>';
			$message .= '<td style="background: #fff;font-size:11px;line-height:2.1em;">';
			$message .= '<table rules="" style="border-color: #666;" cellpadding="10">';
			$message .= '<tr ><td style="width:100px;font-size:11px;">Subject:</td><td style="font-size:11px;"><strong>'.$subject.'</strong> </td></tr>';
			$message .= '<tr ><td colspan="2" style="font-size:11px;">Dear '.$name.'<br />Thank you for register on Modpix. Here is your login credentials - </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">User Id:</td><td style="font-size:11px;"><strong>'.$to.'</strong> </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">Password:</td><td style="font-size:11px;"><strong>'.$pass.'</strong> </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">Login URL:</td><td style="font-size:11px;"><strong><a href="'.$log->baseurl.'index.php?pg=login">'.$log->baseurl.'index.php?pg=login</a></strong> </td></tr>';			
			$message .= '</table>';			 
			$message .= '</td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom left;width:14px;height:14px"></td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom right;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '</table><br />';
			$message .= '<p style="color:#fff;">';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=whoweare">Who we are?</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=products">Products</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=inquiry">Inquiry</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=contactus">Contact Us</a></p>';
			$message .= '<p style="color:black;font-size:10px;">Copyright 2011 &copy; Modpix. All rights reserved. </p>';
			$message .= '</body>';
			
			
			$headers = "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
            if (mail($to, $subject, $message, $headers)) {
              return true;
            } else {
              return false;
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
    }
   
function temPlatePasswordReset($password, $to) {
 			//include_once 'dbclass.php';

			$log = new logmein();
 			//var_dump($albumid);
			$shDB =new sh_DB();

		//	$from = 'admin@modpix.com.au';
			$settingsid = array(		
					'id' => 1
					);									
			$settings = $shDB->selectOnMultipleCondition($settingsid,'settings');
			$settings = $settings[0];
			$from = $settings['admin_email'];
			//var_dump($albumDetails);
			
			$subject = 'Password reset : Modpix';
							
			$message = '<html><body style="background: #6E9091;font-size:8pt;font-family:tahoma,arial;padding:20px;">';
			$message .= '<img src="'.$log->baseurl.'images/modpix_logo.png" width="180" alt="Modpix" />';
			$message .= '<table width="80%" rules="" cellpadding="0" cellspacing="0">';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top left;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '<td style="background: #fff;border-top:1px solid #6E9091"></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top right;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background: #fff;"></td>';
			$message .= '<td style="background: #fff;font-size:11px;line-height:2.1em;">';
			$message .= '<table rules="" style="border-color: #666;" cellpadding="10">';
			$message .= '<tr ><td style="width:100px;font-size:11px;">User email:</td><td style="font-size:11px;"><strong>'.$to.'</strong> </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">New password:</td><td style="font-size:11px;"><strong>'.$password.'</strong> </td></tr>';
			
			$message .= '<tr ><td colspan="2" style="font-size:11px;">Your password is set as per above. Your old password is not valid anymore. If you want to change the password, you can do it from you dashboard.</td></tr>';
			$message .= '</table>';
			 
			$message .= '</td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom left;width:14px;height:14px"></td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom right;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '</table><br />';
			$message .= '<p style="color:#fff;">';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=whoweare">Who we are?</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=products">Products</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=inquiry">Inquiry</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=contactus">Contact Us</a></p>';
			$message .= '<p style="color:black;font-size:10px;">Copyright 2011 &copy; Modpix. All rights reserved. </p>';
			$message .= '</body>';
			
			
			$headers = "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
            if (mail($to, $subject, $message, $headers)) {
              return true;
            } else {
              return false;
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
    }
    
    
 function temPlateInvitation($albumid, $to) {
 			include_once 'dbclass.php';
 			include_once 'class.login.php';

			$log = new logmein();
 			//var_dump($albumid);
			$shDB =new sh_DB();

			$settingsid = array(		
					'id' => 1
					);									
			$settings = $shDB->selectOnMultipleCondition($settingsid,'settings');
			$settings = $settings[0];
			$from = $settings['admin_email'];
			
			$albumdata = array(		
					'id' => $albumid
					);									
			$albumDetails = $shDB->selectOnMultipleCondition($albumdata,'album');
			
			//var_dump($albumDetails);
			
			$subject = 'Album Invitation : '.$albumDetails[0]['album_name'].' ';
			if($albumDetails[0]['event_date']!=''){
				$subject .= 'on '.date('F j, Y',strtotime($albumDetails[0]['event_date']));
			}
 			if($albumDetails[0]['event_place']!=''){
				$subject .= ' at '.$albumDetails[0]['event_place'];
			}
				
					
			$message = '<html><body style="background: #6E9091;font-size:8pt;font-family:tahoma,arial;padding:20px;">';
			$message .= '<img src="'.$log->baseurl.'images/modpix_logo.png" width="180" alt="Modpix" />';
			$message .= '<table width="80%" rules="" cellpadding="0" cellspacing="0">';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top left;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '<td style="background: #fff;border-top:1px solid #6E9091"></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top right;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background: #fff;"></td>';
			$message .= '<td style="background: #fff;font-size:11px;line-height:2.1em;">';
			$message .= '<table rules="" style="border-color: #666;" cellpadding="10">';
			$message .= '<tr ><td style="width:100px;font-size:11px;">Subject:</td><td style="font-size:11px;"><strong>'.$subject.'</strong> </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">Email:</td><td style="font-size:11px;"><strong>'.$to.'</strong> </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">Security Code:</td><td style="font-size:11px;"><strong>'.$albumDetails[0]['securitycode'].'</strong> </td></tr>';
			$message .= '<tr ><td style="font-size:11px;">URL:</td><td style="font-size:11px;"><strong><a href="'.$log->baseurl.'index.php?pg=invitation">'.$log->baseurl.'index.php?pg=invitation</a></strong> </td></tr>';
			$message .= '<tr ><td colspan="2" style="font-size:11px;">'.html_entity_decode($albumDetails[0]['description']).'</td></tr>';
			$message .= '</table>';
			 
			$message .= '</td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom left;width:14px;height:14px"></td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom right;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '</table><br />';
			$message .= '<p style="color:#fff;">';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=whoweare">Who we are?</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=products">Products</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=inquiry">Inquiry</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=contactus">Contact Us</a></p>';
			$message .= '<p style="color:black;font-size:10px;">Copyright 2011 &copy; Modpix. All rights reserved. </p>';
			$message .= '</body>';
			
			
			$headers = "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			//$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Content-type: text/html; charset=utf-8' \r\n";
			
            if (mail($to, $subject, $message, $headers)) {
              return true;
            } else {
              return false;
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
    }
	
	//generate order notification template bof
	function temPlateOrderNotification($user_email){
 			include_once 'dbclass.php';
 			include_once 'class.login.php';

			$log = new logmein();
 			//var_dump($albumid);
			$shDB =new sh_DB();

			$settingsid = array('id' => 1);									
			$settings = $shDB->selectOnMultipleCondition($settingsid,'settings');
			$settings = $settings[0];
			$from = $settings['admin_email'];
			
			
			
			//process products bof
			$selectProductDatainTemp = array('sessionid' => $_SESSION['sessionid']);									
			$dataInTempProduct = $shDB->selectOnMultipleCondition($selectProductDatainTemp,'temp_product');
			
			$products ='<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">';
			$products .='<tr>
							<td align="left" style="border-bottom:solid 1px #EAF0F0;width:30%"><strong>Product Name (Price)</strong></td>
							<td align="center" style="border-bottom:solid 1px #EAF0F0;width:20%"><strong>Base Price</strong></td>
							<td align="left" style="border-bottom:solid 1px #EAF0F0;width:40%"><strong>Product Option</strong></td>
							<td align="right" style="border-bottom:solid 1px #EAF0F0;width:10%;padding-right:15px;"><strong>Amount</strong></td>
						</tr>';
						$subTotal = 0;
						foreach ($dataInTempProduct as $tempProduct){
							$itemName = $tempProduct['name'];
						
						    $data = array('id' => $tempProduct['productid']);									
							$product = $shDB->selectOnMultipleCondition($data,'prod_item');
											
							$product = $product[0];
							$dataforProduct = array('id' => $product['prod_id']);									
							$productname = $shDB->selectOnMultipleCondition($dataforProduct,'product');
							$productname = $productname[0]['name'];	
							$tempOptiondata = array('temp_product_id' => $tempProduct['id']);									
							$tempOptiondata = $shDB->selectOnMultipleCondition($tempOptiondata,'temp_item_option');
							$optionCost = 0;
							$optionString = '';
							$additionalLeafCost = '';
							if($tempOptiondata){
								foreach($tempOptiondata as $optionValue){
									$itemOptiondata = array(		
												'id' => $optionValue['prod_item_option_id']
												);									
									$itemOptiondata = $shDB->selectOnMultipleCondition($itemOptiondata,'prod_item_option');
									$itemOptiondata = $itemOptiondata[0];
									$optionCost = $optionCost + $itemOptiondata['cost'];
									$itemOptiondataNameandValue = array(		
												'id' => $itemOptiondata['optionid']
												);									
									$itemOptiondataNameandValue = $shDB->selectOnMultipleCondition($itemOptiondataNameandValue,'itemoption');
									$itemOptiondataNameandValue = $itemOptiondataNameandValue[0];
									$optionString .= $itemOptiondataNameandValue['name'].' : '.$itemOptiondataNameandValue['value'].' ('.$settings['currency'].' '.$itemOptiondata['cost'].')<br />';
								}
							}	
							$optionDescription = '';
							if($tempProduct['additionalleaf']>0){
								$additionalLeafCost = $tempProduct['additionalleaf']*$tempProduct['addsidecost'];
								$optionDescription .= 'Additional Sides : '.$tempProduct['additionalleaf'].'&times'.$tempProduct['addsidecost'].' = '.$settings['currency'].$additionalLeafCost.'<br />';
								$optionDescription .= $optionString;
								
							}
							
							$itemTotal = $product["basicprice"] + $additionalLeafCost + $optionCost;
								
							$subTotal =$subTotal + $itemTotal;
						
						
			$products .='<tr>										
							<td align="left" class="botBorder3">'.$productname.'<br /><small>'.$itemName.'</small></td>
							<td align="center" class="botBorder3">'.$settings['currency'].' '.$product["basicprice"].'</font></td>
							<td align="left" class="botBorder3">'.$optionDescription.'</font></td>
							<td align="right" class="botBorder3" style="padding-right:15px;"><font class="currency1">'.$settings['currency'].' '.$itemTotal.'</td>
						</tr>									
						';
					}
					$grand_total=$subTotal;
			$products .='<tr>
							<td align="right" colspan="4" style="padding-right:15px; font-size:16px; font-weight:bold;">Total - '.$settings['currency'].' '.$grand_total.'</td>
						</tr>';
			$products .='</table>';
			
			
			//process products eof
			
			$subject = 'New order has been placed';
				
			//get customer name bof	
			/* $selectBillingAddress = $shDB->selectOnMultipleCondition($selectBillingAddress,'bill_address');
			$selectBillingAddress = $selectBillingAddres s[0];
			$custName=$selectBillingAddress['name'];*/
			//get customer name eof	
				
					
			$message = '<html><body style="background: #6E9091;font-size:8pt;font-family:tahoma,arial;padding:20px;">';
			$message .= '<img src="'.$log->baseurl.'images/modpix_logo.png" width="180" alt="Modpix" />';
			$message .= '<table width="80%" rules="" cellpadding="0" cellspacing="0">';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top left;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '<td style="background: #fff;border-top:1px solid #6E9091"></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top right;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '</tr>';
			
			$message .= '<tr>';
			$message .= '<td style="background: #fff;"></td>';
			$message .= '<td style="background: #fff;font-size:11px;line-height:2.1em;">';
				$message .= '<table rules="" style="border-color: #666;" width="100%" cellpadding="10">';
					$message .= '<tr><td style="width:100px;font-size:11px;">Hi </td></tr>';
					$message .= '<tr ><td style="font-size:11px;">Your order have been successfully placed. Thank You! We Appreciate your Business! </td></tr>';
					$message .= '<tr ><td style="font-size:11px;">Your order details are given below: </td></tr>';
				$message .= '</table>';
			$message .= '</td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '</tr>';
			
			$message .= '<tr>';
			$message .= '<td style="background: #fff;"></td>';
			$message .= '<td style="background: #fff;font-size:11px;line-height:2.1em;">';
				$message .= $products;
			$message .= '</td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '</tr>';
			
			
			
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom left;width:14px;height:14px"></td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom right;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '</table><br />';
			$message .= '<p style="color:#fff;">';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=whoweare">Who we are?</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=products">Products</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=inquiry">Inquiry</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=contactus">Contact Us</a></p>';
			$message .= '<p style="color:black;font-size:10px;">Copyright 2011 &copy; Modpix. All rights reserved. </p>';
			$message .= '</body>';
			
			
			$headers = "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
            if (mail($user_email, $subject, $message, $headers)) {
              return true;
            } else {
              return false;
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
    }
	//generate order notification template eof
	
	//send admin notification for visitor request bof
	function temPlatePhotographerRequest($v_data){
 			include_once 'dbclass.php';
 			include_once 'class.login.php';

			$log = new logmein();
 			//var_dump($albumid);
			$shDB =new sh_DB();
			
			$photgrapher_id=$v_data['photgrapher_id'];
			$selectUser = array('id' =>$photgrapher_id);									
			$selectUser = $shDB->selectOnMultipleCondition($selectUser,'`logon`');
			$photographerdetails = $selectUser[0];
			
			
			
			$settingsid = array('id' => 1);									
			$settings = $shDB->selectOnMultipleCondition($settingsid,'settings');
			$settings = $settings[0];
			$from = $settings['admin_email'];
						
			//var_dump($albumDetails);
			
			$subject = 'Photographer Contact Request';
			
					
			$message = '<html><body style="background: #6E9091;font-size:8pt;font-family:tahoma,arial;padding:20px;">';
			$message .= '<img src="'.$log->baseurl.'images/modpix_logo.png" width="180" alt="Modpix" />';
			$message .= '<table width="80%" rules="" cellpadding="0" cellspacing="0">';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top left;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '<td style="background: #fff;border-top:1px solid #6E9091"></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-position:top right;background-repeat:no-repeat;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '<tr>';
				$message .= '<td style="background: #fff;"></td>';
				$message .= '<td style="background: #fff;font-size:11px;">';
					$message .= '<table style="border-color: #666;" cellpadding="10" width="100%">';
						$message .= '<tr ><td style="font-size:11px;" colspan="2">Hi</td></tr>';
						$message .= '<tr ><td style="font-size:11px;" colspan="2">'.$v_data['v_name'].' want to contact '.$photographerdetails['fname'].' '.$photographerdetails['lname'].' photographer.</td></tr>';
						
						$message .= '<tr ><td style="font-size:11px; text-align: justify;" colspan="2" align="left"><strong> Details of Visitor interests: </strong><br />'.$v_data['v_instruction'].'</td></tr>';
						$message .= '<tr ><td style="font-size:11px;" colspan="2">The details information of requested visitors and photographer are given below: </td></tr>';
						
						$message .= '<tr ><th width="50%" style="font-size:11px;" align="left">Requested Visitor Details Information: </th><th width="50%" style="font-size:11px;" align="left">Photographer Details Information:</th></tr>';
						//$message .= '<tr ><td width="50%"style="font-size:11px;" align="left" valign="top">Name: '.$v_data['v_name'].'<br />Address: '.$v_data['v_address'].(($v_data['v_address_1'] != "") ? ', '.$v_data['v_address_1'] : '').'<br /> Phone: '.$v_data['v_phone'].'<br /> Email: '.$v_data['v_email'].(($v_data['v_pcode'] != "") ? '<br /> Post Code: '.$v_data['v_pcode'] : '').'<br /> City : '.$v_data['v_city'].'<br /> Country : '.$v_data['v_country'].'</td>';
						$message .= '<tr ><td width="50%"style="font-size:11px;" align="left" valign="top">Name: '.$v_data['v_name'].'<br />Address: '.$v_data['v_address'].'<br /> Phone: '.$v_data['v_phone'].'<br /> Email: '.$v_data['v_email'].'</td>';
						$message .= '<td width="50%" style="font-size:11px;" align="left" valign="top">Name: '.$photographerdetails['fname'].' '.$photographerdetails['lname'].'<br /> Address: '.$photographerdetails['address'].'<br /> Phone: '.$photographerdetails['phone'].'<br /> Email: '.$photographerdetails['useremail'].'<br /> Post Code: '.$photographerdetails['zip'].'<br />City: '.$photographerdetails['city'].'<br />Country: '.$photographerdetails['country'].'</td></tr>';
					$message .= '</table>';			 
				$message .= '</td>';
				$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom left;width:14px;height:14px"></td>';
			$message .= '<td style=\'background: #fff;\'></td>';
			$message .= '<td style="background-image: url('.$log->baseurl.'images/email_round.png);background-repeat:no-repeat;background-position:bottom right;width:14px;height:14px"></td>';
			$message .= '</tr>';
			$message .= '</table><br />';
			$message .= '<p style="color:#fff;">';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=whoweare">Who we are?</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=products">Products</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=inquiry">Inquiry</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
			$message .= '<a style="color:#fff;text-decoration:none;font-weight:bold" href="'.$log->baseurl.'index.php?pg=contactus">Contact Us</a></p>';
			$message .= '<p style="color:black;font-size:10px;">Copyright 2011 &copy; Modpix. All rights reserved. </p>';
			$message .= '</body>';
			
			
			$headers = "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
            if (mail('a.rahman@oscillosoft.com.au', $subject, $message, $headers)) {
              return true;
            } else {
              return false;
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
    }
	//send admin notification for visitor request bof
}
?>
