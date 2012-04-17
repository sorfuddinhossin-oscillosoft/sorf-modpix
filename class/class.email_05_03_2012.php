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
			$message .= '<tr ><td colspan="2" style="font-size:11px;">'.$albumDetails[0]['description'].'</td></tr>';
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
}
?>
