<?php
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
include_once '../class/class.email.php';
$shDB =new sh_DB();
$log =new logmein();
$shMail = new sh_Email();

	/* $v_data = array('v_name'=>trim($_REQUEST['c_visitor_name']),
				    'v_address'=>trim($_REQUEST['c_visitor_address']),
				    'v_address_1'=>trim($_REQUEST['c_visitor_address_1']),
				    'v_phone'=>trim($_REQUEST['c_visitor_phone']),
				    'v_email'=>trim($_REQUEST['c_visitor_email']),
				    'v_pcode'=>trim($_REQUEST['c_visitor_pcode']),
				    'v_city'=>trim($_REQUEST['c_visitor_city']),
				    'c_visitor_instruction'=>trim($_REQUEST['c_visitor_instruction']),
				    'photgrapher_id'=>trim($_REQUEST['photgrapher_id']),
				    'v_country'=>trim($_REQUEST['c_visitor_country']));  */

	$v_data = array('v_name'=>trim($_REQUEST['c_visitor_name']),
				    'v_address'=>trim($_REQUEST['c_visitor_address']),
				    'v_phone'=>trim($_REQUEST['c_visitor_phone']),
				    'v_email'=>trim($_REQUEST['c_visitor_email']),
				    'v_instruction'=>trim($_REQUEST['c_visitor_instruction']),
				    'photgrapher_id'=>trim($_REQUEST['photgrapher_id'])); 

						
				  
	// email notification
	$isMail = $shMail->temPlatePhotographerRequest($v_data);
	if($isMail==true){
		echo 1;
	}else{
		echo 0;
	}
?>