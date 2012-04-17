<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<h1 class="pagetitle">Inquiry</h1>
<div class="webcontent">
<table width="100%" cellpadding="10" cellspacing="5">
<tr>
<td style="width:230px" align="right"  valign="top">
<img src="<?php echo $log->baseurl;?>images/inquiry.jpg" alt="" >
</td>	
<td style="border-left:1px solid #ececec;" align="left"  valign="top">
<label>Please choose an option</label><br />
<select id="inquirytype" style="width:325px;">
	<option value="printing">Printing</option>
	<option value="comentry">Wedding Photography Competition Entry</option>
	<option value="pckginquiry">Wedding Photography Inquiry</option>
	<option value="packagebooking">Wedding Photography Booking</option>
</select>
<div style="clear:both">
	<div id="printing" style="display:block">
		<p style="color:black;">
		We can print your photos on a wide variety of products with many options and choice of finishes. <br />
		We will require the original full size images uncompressed.<br />
		For all Printing enquiries, you will have free access to the Modpix online services. To access these services and your account you will require a Login and Password.
Once registered, please complete your account contact details.<br />
		<a href="index.php?pg=registration">Register New</a>
		
		<? 
		if($_POST['cmmail']=='1'){
		
		
		$email_attendee=$_POST['cmemail'];
		$bridFirstname=$_POST['cmbrideFirstname'];
		$bridLastname=$_POST['cmbrideLastname'];
		$bridephone=$_POST['cmbridephone'];
		$groomFirstname=$_POST['cmgroomFirstname'];
		$groomLastname=$_POST['cmgroomLastname'];
		$groomphone=$_POST['cmgroomphone'];
		$city=$_POST['cmcity'];
		$wedding=$_POST['cmwedding'];
		$hearfrom=$_POST['hearfrom1'];
		$bestsuit1=$_POST['bestsuit1'];
		$receiveemail1=$_POST['receiveemail1'];
		
	
		if($receiveemail1=='on'){
		$con='Yes';
		}else{
		$con='No';
		}
		
		
/*Send comentry mail*/
		
$Name = "Modpix Gallery"; //senders name
$emailSender = "enquery@modpix.com.au"; //senders e-mail adress
//$recipient = 's.hossin@oscillosoft.com.au'; //recipient
$recipient = 'info@modpix.com.au'; //recipient
$subject = "Wedding Photography Competition Entry"; //subject
$header = "From: ". $Name . " <" . $emailSender . ">\r\n"; //optional headerfields

// message
$message = '
<table>

<tr>
<td>Bride First Name</td>
<td>'.$bridFirstname.' </td>
</tr>
<tr>
<td>Bride Last Name</td>
<td>'.$bridLastname.' </td>
</tr>
<tr>
<td>Bride Phone</td>
<td>'.$bridephone.' </td>
</tr>

<tr>
<td>Groom First Name</td>
<td>'.$groomFirstname.' </td>
</tr>
<tr>
<td>Groom Last Name</td>
<td>'.$groomLastname.' </td>
</tr>
<tr>
<td>Groom Phone</td>
<td>'.$groomphone.' </td>
</tr>

<tr>
<td>Email</td>
<td>'.$email_attendee.' </td>
</tr>

<tr>
<td>Wedding Location/City</td>
<td>'.$city.' </td>
</tr>

<tr>
<td>Wedding Date</td>
<td>'.$wedding.' </td>
</tr>

<tr>
<td>Which would suit your wedding requirements</td>
<td>'.$bestsuit1.' </td>
</tr>

<tr>
<td>Hear from</td>
<td>'.$hearfrom.' </td>
</tr>

<tr>
<td>Receive promotional emails</td>
<td>'.$con.' </td>
</tr>




</table>

';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= "From: ". $Name . " <" . $emailSender . ">\r\n";

mail($recipient, $subject, $message, $headers); //mail command :)


}
		
		
		
		if($_POST['pckmail']=='1'){
		
		
		$email_attendee=$_POST['pckemail'];
		$bridFirstname=$_POST['pckbrideFirstname'];
		$bridLastname=$_POST['pckbrideLastname'];
		$bridephone=$_POST['pckbridephone'];
		$groomFirstname=$_POST['pckgroomFirstname'];
		$groomLastname=$_POST['pckgroomLastname'];
		$groomphone=$_POST['pckgroomphone'];
		$city=$_POST['pckcity'];
		$wedding=$_POST['pckwedding'];
		//$hearfrom=$_POST['hearfrom1'];
		$bestsuit1=$_POST['pckbestsuit'];
		$receiveemail1=$_POST['pckreceiveemail'];
		
			
		if($receiveemail1=='on'){
		$con='Yes';
		}else{
		$con='No';
		}
		
		
/*Send packeging mail*/
		
$Name = "Modpix Gallery"; //senders name
$emailSender = "enquery@modpix.com.au"; //senders e-mail adress
$recipient = 'info@modpix.com.au'; //recipient
$subject = "Wedding Photography Inquiry"; //subject
$header = "From: ". $Name . " <" . $emailSender . ">\r\n"; //optional headerfields

// message
$message = '
<table>

<tr>
<td>Bride First Name</td>
<td>'.$bridFirstname.' </td>
</tr>
<tr>
<td>Bride Last Name</td>
<td>'.$bridLastname.' </td>
</tr>

<tr>
<td>Bride Phone</td>
<td>'.$bridephone.' </td>
</tr>

<tr>
<td>Groom First Name</td>
<td>'.$groomFirstname.' </td>
</tr>

<tr>
<td>Groom Last Name</td>
<td>'.$groomLastname.' </td>
</tr>

<tr>
<td>Groom Phone</td>
<td>'.$groomphone.' </td>
</tr>

<tr>
<td>Email</td>
<td>'.$email_attendee.' </td>
</tr>

<tr>
<td>Wedding Location/City</td>
<td>'.$city.' </td>
</tr>

<tr>
<td>Wedding Date</td>
<td>'.$wedding.' </td>
</tr>

<tr>
<td>Which would suit your wedding requirements:</td>
<td>'.$bestsuit1.' </td>
</tr>

<tr>
<td>Receive promotional emails</td>
<td>'.$con.' </td>
</tr>




</table>

';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= "From: ". $Name . " <" . $emailSender . ">\r\n";

mail($recipient, $subject, $message, $headers); //mail command :)


}



	
		if($_POST['bookingmail']=='1'){
		
	
		
		$bridFirstname=$_POST['bookbrideFirstname'];
		$bridLastname=$_POST['bookbrideLastname'];
		
		$bridephone=$_POST['bookbridephone'];
		$groomFirstname=$_POST['bookgroomFirstname'];
		$groomLastname=$_POST['bookgroomLastname'];
		$groomphone=$_POST['bookgroomphone'];
		
		$brideemail=$_POST['bookbrideemail'];
		$groomemail=$_POST['bookgroomemail'];
		
		$bookbrideaddress=$_POST['bookbrideaddress'];
		$bookgroomaddress=$_POST['bookgroomaddress'];
		$bookchurchaddress=$_POST['bookchurchaddress'];
		
		$username=$_POST['username'];
		$password=$_POST['password'];
	
		$bestsuit1=$_POST['bookbestsuit'];
		$receiveemail1=$_POST['bookreceiveemail'];
		
			
		if($receiveemail1=='on'){
		$con='Yes';
		}else{
		$con='No';
		}
		
		
/*Send Booking mail*/
		
$Name = "Modpix Gallery"; //senders name
$emailSender = "enquery@modpix.com.au"; //senders e-mail adress
// $recipient = 'sales@modpix.com.au'; //recipient
$recipient = 's.hossin@oscillosoft.com.au'; //recipient
$subject = "Wedding Photography Booking"; //subject
$header = "From: ". $Name . " <" . $emailSender . ">\r\n"; //optional headerfields

// message
$message = '
<table>

<tr>
<td>Bride First Name</td>
<td>'.$bridFirstname.' </td>
</tr>

<tr>
<td>Bride Last Name</td>
<td>'.$bridLastname.' </td>
</tr>

<tr>
<td>Bride Email</td>
<td>'.$brideemail.' </td>
</tr>

<tr>
<td>Bride Phone</td>
<td>'.$bridephone.' </td>
</tr>

<tr>
<td>Groom First Name</td>
<td>'.$groomFirstname.' </td>
</tr>

<tr>
<td>Groom Last Name</td>
<td>'.$groomLastname.' </td>
</tr>

<tr>
<td>Groom Email</td>
<td>'.$groomemail.' </td>
</tr>

<tr>
<td>Groom Phone</td>
<td>'.$groomphone.' </td>
</tr>

<tr>
<td>Bride Address</td>
<td>'.$bookbrideaddress.' </td>
</tr>

<tr>
<td>Groom Address</td>
<td>'.$bookgroomaddress.' </td>
</tr>

<tr>
<td>Church Address</td>
<td>'.$bookchurchaddress.' </td>
</tr>
<tr>
<td>Which would suit your wedding requirements:</td>
<td>'.$bestsuit1.' </td>
</tr>
</table>

';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= "From: ". $Name . " <" . $emailSender . ">\r\n";

mail($recipient, $subject, $message, $headers); //mail command :)
}
?>
		</p>
	</div>
	<div id="comentry"  style="display:none">
	
	
	<h2>Wedding Photography Competition Entry</h2>
	<form method="post" action="" name="comentry">
	<input type="hidden" name="subject1" value="Wedding Photography Competition Entry">
	<p style="color:black">
	Please complete the details below for a free no obligation inquiry. An email will be sent to you with details of available photographers for your wedding day.<Br /><br />
	Your details are kept confidential and will not be passed onto or sold to third parties.</p>
	<table>
	<tr><td colspan="3" style="border-bottom:1px solid #999"><label>Brides Informaiton</label></td></tr>
	<tr><td>First Name</td><td>Last Name</td><td>Phone</td></tr>
	<tr><td><input style="width:180px;" type="text" name="cmbrideFirstname" id="cmbrideFirstname"></td><td><input style="width:180px;" type="text" name="cmbrideLastname" id="cmbrideLastname"></td><td><input style="width:180px;"  type="text" name="cmbridephone" id="cmbridephone"></td></tr>
	<tr><td colspan="3" style="border-bottom:1px solid #999"><label>Grooms Informaiton</label></td></tr>
	<tr><td>First Name</td><td>Last Name</td><td>Phone</td></tr>
	<tr><td><input style="width:180px;"  type="text" name="cmgroomFirstname" id="cmgroomFirstname"></td><td><input style="width:180px;"  type="text" name="cmgroomLastname" id="cmgroomLastname"></td><td><input style="width:180px;"  type="text" name="cmgroomphone" id="cmgroomphone"></td></tr>
	<tr><td colspan="3"><label>Email</label></td></tr>
	<tr><td colspan="3"><input type="text" name="cmemail" id="cmemail"></td></tr>
	<tr><td colspan="3"><label>Wedding Date</label></td></tr>
	<tr><td colspan="3"><input type="text" name="cmwedding" id="cmwedding"></td></tr>
	<tr><td colspan="3"><label>Wedding Location/City</label></td></tr>
	<tr><td colspan="3"><input type="text" name="cmcity" id="cmcity"></td></tr>
	<tr><td colspan="3"><label>How did you hear about this competition</label></td></tr>
	<tr><td colspan="3">
		<select name="hearfrom1">
		<option selected="selected" value="Bridal Show">Bridal Show</option>
		<option value="Google">Google</option>
		<option value="Radio">Radio</option>
		<option value="Newspaper">Newspaper</option>
		<option value="Word of Mouth">Word of mouth</option>		
	</select>
	</td></tr>
	<tr><td colspan="3"><label>Please select one of the following which would suit your wedding requirements</label></td></tr>
	<tr><td colspan="3">
	<input type="radio" checked="checked" name="bestsuit1" value="Modpix Wedding Photo Package">Modpix Wedding Photo Package<br />
	<input type="radio" name="bestsuit1"  value="Modpix Deluxe Wedding Photo Package">Modpix Deluxe Wedding Photo Package<br />
	<input type="radio" name="bestsuit1"  value="Modpix Premium Wedding Photo Package">Modpix Premium Wedding Photo Package<br /></td></tr>
	<!-- <tr><td colspan="3"><label><input type="checkbox" value="1" name="receiveemail1">Modpix may occasionally send you promotional information, please tick this box if you do not wish to receive promotional emails.<br /></label></td></tr>  -->
	<tr><td colspan="3"><a href="index.php?pg=termsandcondition">Terms and Condition</a><br /></td></tr>
	<tr><td colspan="3"><input type="button" name="inquiryOne" value="Send Inquiry" onclick="check_comentry()"></td></tr>
	<input type="hidden" name="cmmail" id="cmmail" value="1" />
	</table>
	</form>
	
<script type="text/javascript">

function check_comentry(){ 

var bridFirstname=$('#cmbrideFirstname').val();
var bridLastname=$('#cmbrideLastname').val();
var bridephone=$('#cmbridephone').val();
var groomFirstname=$('#cmgroomFirstname').val();
var groomLastname=$('#cmgroomLastname').val();

var groomphone=$('#cmgroomphone').val();
var cm_email=$('#cmemail').val();
var city=$('#cmcity').val();
var wedding=$('#cmwedding').val();
var cmmail=$('#cmmail').val();


var err=1;




/*else if(cm_email!=''){
	
	if(checkEmail(cm_email)==false){
		alert('Invalid admin email');
		return false;
		
	}
	
	err=0;
		}

*/	
	
if(bridFirstname==''){
alert("Please enter Bride first name");
err=0;
}

else if(bridLastname==''){
	alert("Please enter Bride last name");
	err=0;
	}

else if(bridephone==''){
alert("Please enter a Bride phone");
err=0;
}

else if(groomFirstname==''){
alert("Please enter grooms first name");
err=0;
}

else if(groomLastname==''){
	alert("Please enter grooms last name");
	err=0;
	}
else if(cm_email==''){
	alert("Please enter a Email Address");
	err=0;
	}
else if(groomphone==''){
alert("Please enter a Groom Phone");
err=0;
}

else if(city==''){
alert("Please enter a City"); 
err=0;
}

else if(wedding==''){
alert("Please enter a Wedding Date");
err=0;
}
	

if(err=="1"){
document.comentry.submit();
}

}


function validate(cm_email) {
 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
 if(reg.test(cm_email) == false) {
     alert("Please enter a valid Email Address");
      return false;
   }
 return true;
	   
	
}

</script>
	
	
	</div>
	
	
	
	
	
	<div id="pckginquiry"  style="display:none">
	<h2>Wedding Photography Inquiry</h2>
		<form action="" method="post" name="pckging">
	<p style="color:black">
	Please complete the details below for a free no obligation inquiry. An email will be sent to you with details of available photographers for your wedding day.<Br /><br />
	Your details are kept confidential and will not be passed onto or sold to third parties.</p>
	<table>
	<tr><td colspan="3" style="border-bottom:1px solid #999"><label>Brides Informaiton</label></td></tr>
	<tr><td>First Name</td><td>Last Name</td><td>Phone</td></tr>
	<tr><td><input style="width:180px;" type="text" name="pckbrideFirstname" id="pckbrideFirstname"></td><td><input style="width:180px;" type="text" name="pckbrideLastname" id="pckbrideLastname"></td><td><input style="width:180px;"  type="text" name="pckbridephone" id="pckbridephone"></td></tr>
	<tr><td colspan="3" style="border-bottom:1px solid #999"><label>Grooms Informaiton</label></td></tr>
	<tr><td>First Name</td><td>Last Name</td><td>Phone</td></tr>
	<tr><td><input style="width:180px;"  type="text" name="pckgroomFirstname" id="pckgroomFirstname"></td><td><input style="width:180px;"  type="text" name="pckgroomLastname" id="pckgroomLastname"></td><td><input style="width:180px;"  type="text" name="pckgroomphone" id="pckgroomphone"></td></tr>
	<!-- 
	<tr><td><label>Brides name</label></td><td>Phone</td></tr>
	<tr><td><label><input style="width:235px;" type="text" name="pckbridename" id="pckbridename"></label></td><td><input style="width:235px;"  type="text" name="pckbridephone" id="pckbridephone"></td></tr>
	<tr><td><label>Grooms name</label></td><td>Phone</td></tr>
	<tr><td><label><input style="width:235px;"  type="text" name="pckgroomname" id="pckgroomname"></label></td><td><input style="width:235px;"  type="text" name="pckgroomphone" id="pckgroomphone"></td></tr>
	 -->
	<tr><td colspan="3"><label>Email</label></td></tr>
	<tr><td colspan="3"><input type="text" name="pckemail" id="pckemail"></td></tr>
	<tr><td colspan="3"><label>Wedding Date</label></td></tr>
	<tr><td colspan="3"><input type="text" name="pckwedding" id="pckwedding"></td></tr>
	<tr><td colspan="3"><label>Wedding Location/City</label></td></tr>
	<tr><td colspan="3"><input type="text" name="pckcity" id="pckcity"></td></tr>
	
	<tr><td colspan="3"><label>Please select one of the following which would suit your wedding requirements</label></td></tr>
	<tr><td colspan="3">
	<input type="radio" checked="checked" name="pckbestsuit" value="Modpix Wedding Photo Package">Modpix Wedding Photo Package<br />
	<input type="radio" name="pckbestsuit"  value="Modpix Deluxe Wedding Photo Package">Modpix Deluxe Wedding Photo Package<br />
	<input type="radio" name="pckbestsuit"  value="Modpix Premium Wedding Photo Package">Modpix Premium Wedding Photo Package<br /></td></tr>
	<!-- <tr><td colspan="3"><label><input type="checkbox" name="pckreceiveemail">Modpix may occasionally send you promotional information, please tick this box if you do not wish to receive promotional emails.<br /></label></td></tr>  -->
	
	<tr><td colspan="3"><input type="button" name="inquiryOne" value="Send Inquiry" onclick="check_pckinquiry()"></td></tr>
	<input type="hidden" name="pckmail" id="pckmail" value="1" />
	</table>
	</form>
	
	
	<script type="text/javascript">

function check_pckinquiry(){ 

var pckbridFirstname=$('#pckbrideFirstname').val();
var pckbridLastname=$('#pckbrideLastname').val();

var pckbridephone=$('#pckbridephone').val();
var pckgroomFirstname=$('#pckgroomFirstname').val();
var pckgroomLastname=$('#pckgroomLastname').val();

var pckgroomphone=$('#pckgroomphone').val();
var pckemail=$('#pckemail').val();
var pckcity=$('#pckcity').val();
var pckwedding=$('#pckwedding').val();



var err=1;




/*else if(cm_email!=''){
	if(validate(email)==false){
	
	err=0;
		}
	}*/
	
	
if(pckbridFirstname==''){
alert("Please enter a brides first name");
err=0;
}
else if(pckbridLastname==''){
	alert("Please enter a brides last name");
	err=0;
	}
else if(pckbridephone==''){
alert("Please enter a Bride phone");
err=0;
}

else if(pckgroomFirstname==''){
alert("Please enter a grooms first name");
err=0;
}

else if(pckgroomLastname==''){
	alert("Please enter a grooms last Name");
	err=0;
	}
	
else if(pckgroomphone==''){
alert("Please enter a Groom Phone");
err=0;
}

else if(pckemail==''){
alert("Please enter a Email Address");
err=0;
}

else if(pckcity==''){
alert("Please enter a City"); 
err=0;
}

else if(pckwedding==''){
alert("Please enter a Wedding Date");
err=0;
}
	

if(err=="1"){
document.pckging.submit();
}

}

</script>
	
	
	
	</div>
	<div id="packagebooking"  style="display:none">
	<h2>Wedding Photography Booking</h2>
		<form method="post" action="" name="booking">
	<p style="color:black">
	Please complete the details below for a free no obligation inquiry. An email will be sent to you with details of available photographers for your wedding day.<Br /><br />
	Your details are kept confidential and will not be passed onto or sold to third parties.</p>
	<table>
	<tr><td colspan="3" style="border-bottom:1px solid #999"><label>Brides Informaiton</label></td></tr>
	<tr><td>First Name</td><td>Last Name</td><td>Email</td></tr>
	<tr><td><input style="width:180px;" type="text" name="bookbrideFirstname" id="bookbrideFirstname" ></td><td><input style="width:180px;" type="text" name="bookbrideLastname" id="bookbrideLastname" ></td><td><input style="width:180px;"  type="text" name="bookbrideemail" id="bookbrideemail"></td></tr>
	<tr><td>Phone</td><td colspan="2">Bride Address</td></tr>
	<tr><td valign="top"><input style="width:180px;"  type="text" name="bookbridephone" id="bookbridephone"></td>
	<td colspan="2">
		<input type="text" name="bookbrideaddress" id="bookbrideaddress">
	</td></tr>
	<tr><td colspan="3" style="border-bottom:1px solid #999"><label>Grooms Informaiton</label></td></tr>
	<tr><td>First Name</td><td>Last Name</td><td>Email</td></tr>
	<tr><td><input style="width:180px;" type="text" name="bookgroomFirstname" id="bookgroomFirstname" ></td><td><input style="width:180px;" type="text" name="bookgroomLastname" id="bookgroomLastname" ></td><td><input style="width:180px;"  type="text" name="bookgroomemail" id="bookgroomemail"></td></tr>
		
	<tr><td>Phone</td><td colspan="2">Groom Address</td></tr>
	<tr>
	<td  valign="top" ><input style="width:180px;"  type="text" name="bookgroomphone" id="bookgroomphone"></td>
	<td colspan="2">
		<input type="text" name="bookgroomaddress" id="bookgroomaddress">
	</td></tr>
	<tr><td colspan="3"><label>Church Address</label></td></tr>
	<tr><td colspan="3">
		<textarea style="width:320px;" type="text" name="bookchurchaddress" id="bookchurchaddress"></textarea>
	</td></tr>
	<!-- 
	<tr><td colspan="3">
		<p>For all Wedding Packages, you will have free access to the Modpix online services. To access these services and your account you will require a Login and Password.</p>
	</td></tr>
	
	<tr><td colspan="3"><label>Login Username (Email)</label></td></tr>
	<tr><td colspan="3"><input type="text" name="username" id="username"></td></tr>
	<tr><td colspan="3"><label>Password</label></td></tr>
	<tr><td colspan="3"><input type="text" name="password" id="password"></td></tr>
	-->
		<tr><td colspan="3"><label>Please select one of the following which would suit your wedding requirements</label></td></tr>
	<tr><td colspan="3">
	<input type="radio" checked="checked" name="bookbestsuit" value="Modpix Wedding Photo Package">Modpix Wedding Photo Package<br />
	<input type="radio" name="bookbestsuit"  value="Modpix Deluxe Wedding Photo Package">Modpix Deluxe Wedding Photo Package<br />
	<input type="radio" name="bookbestsuit"  value="Modpix Premium Wedding Photo Package">Modpix Premium Wedding Photo Package<br /></td></tr>
	<tr><td colspan="3">
	Modpix will send you a confirmation email and from time to time special offers and promotions, you can unsubscribe from these emails at anytime.
	<!-- 
	<label><input type="checkbox" name="bookreceiveemail">Modpix may occasionally send you promotional information, please tick this box if you do not wish to receive promotional emails.<br /></label>
	 -->
	</td></tr>
	
	<tr><td colspan="3"><input type="button" name="" value="Send Inquiry" onclick="check_bookinquiry()" /></td></tr>
	<input type="hidden" name="bookingmail" id="bookingmail" value="1" />
	</table>
	</form>
	
	<script type="text/javascript">

function check_bookinquiry(){ 

var bookbrideFirstname=$('#bookbrideFirstname').val();
var bookbrideLastname=$('#bookbrideLastname').val();
var bookbridephone=$('#bookbridephone').val();
var bookgroomFirstname=$('#bookgroomFirstname').val();
var bookgroomLastname=$('#bookgroomLastname').val();
var bookgroomphone=$('#bookgroomphone').val();
var bookbrideemail=$('#bookbrideemail').val();
var bookgroomemail=$('#bookgroomemail').val();

var bookbrideaddress=$('#bookbrideaddress').val();
var bookgroomaddress=$('#bookgroomaddress').val();
var bookchurchaddress=$('#bookchurchaddress').val();

var err=1;






/*else if(cm_email!=''){
	if(validate(email)==false){
	
	err=0;
		}
	}*/
	
	
if(bookbrideFirstname==''){
alert("Please enter a bride first name");
err=0;
}
else if(bookbrideLastname==''){
	alert("Please enter a bride last name");
	err=0;
	}

else if(bookbrideemail==''){
alert("Please enter bride email");
err=0;
}

else if(bookbridephone==''){
alert("Please enter a bride phone");
err=0;
}

else if(bookgroomFirstname==''){
alert("Please enter grooms first name");
err=0;
}

else if(bookgroomLastname==''){
	alert("Please enter grooms last name");
	err=0;
	}

else if(bookgroomemail==''){
alert("Please enter groom email");
err=0;
}

else if(bookgroomphone==''){
alert("Please enter a Groom Phone");
err=0;
}

else if(bookbrideaddress==''){
alert("Please enter Bride Address"); 
err=0;
}

else if(bookgroomaddress==''){
alert("Please enter Groom Address");
err=0;
}

else if(bookchurchaddress==''){
alert("Please enter Church Address");
err=0;
}

if(err=="1"){
document.booking.submit();
}

}

</script>
	
	
	</div>
</div>
</td>
</tr>
</table>
</div>