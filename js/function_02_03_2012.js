var base_url = 'http://www.modpix.com.au/';

function IsNumeric(strString)
//  check for valid numeric strings	
{
var strValidChars = "0123456789.-";
var strChar;
var blnResult = true;

if (strString.length == 0) return false;

//  test strString consists of valid characters listed above
for (i = 0; i < strString.length && blnResult == true; i++)
   {
   strChar = strString.charAt(i);
   if (strValidChars.indexOf(strChar) == -1)
      {
      blnResult = false;
      }
   }
return blnResult;
}

function writesession(prodid){
	
	if(prodid==''){return false;}
	$.post(base_url+"ajax/writesession.php",
  			{prodid:prodid}, 
			   function(data){
  								
				});	
}
function delImgFromCollection(collection, imgid){
		 $.post(base_url+"ajax/delcollectionimage.php",
	  			{collection:collection,imgid:imgid}, 
				   function(data){
	  				if(parseInt(data)==1){
	  					$('#collImageId'+imgid).fadeOut('slow');
					 }else{
						 alert('Error in image deletion. Please try later');
					 }
					});	
}

function addtocart(id){
	alert(id);
}

function formSubmit(formid){
	$('#'+formid).submit();
}

function changeDelStatus(id){
	if(id=='')return false;
	var answer = confirm("Change status!!! Confirm?");
	if (answer){
		var status = 0;
		array = {"status" : status};
		$.post(base_url+"ajax/update.php",
	  			{updatedata: array,tablename : 'itemoption', id : id}, function(data){			  				
	  				if(parseInt(data)==1){
	  					 alert('Delete successfull');
	  					 location.href=base_url+"user/index.php?pg=itemoption";
	  				}
				});			
	}
	}

function changeItemDelStatus(id){
		if(id=='')return false;
		var answer = confirm("Delete !!! Confirm?");
		if (answer){
			var status = 0;
			array = {"status" : status};
			$.post(base_url+"ajax/update.php",
		  			{updatedata: array,tablename : 'prod_item', id : id}, function(data){
		  				
		  				if(parseInt(data)==1){
		  					 alert('Delete successfull');
		  					 location.href=base_url+"user/index.php?pg=itemlist";
		  				}
					});			
		}
		}

function orderformsubmit(formid){
	// alert(formid);
	var shippingmethod = $('input[name="paymentmethod"]:checked').val();
	if(shippingmethod==undefined){
		alert('Please choose a shipping method');
		return false;
	}
	if(shippingmethod=='checkdeposit'){
		if($('input[name="bankname"]').val()==''){
			alert('Please put a bank name');
			$('input[name="bankname"]').focus();
			return false;
		}
		if($('input[name="checknumber"]').val()==''){
			alert('Please put a check number');
			$('input[name="checknumber"]').focus();
			return false;
		}
	}
	formSubmit(formid);
}
function startUpload(){
    document.getElementById('f1_upload_process').style.visibility = 'visible';
    document.getElementById('f1_upload_form').style.visibility = 'hidden';
    return true;
}

function changePass(){
    document.getElementById('f1_changepassword_form').style.visibility = 'hidden';
   
    return true;
}

function stopUpload(success){
	var result = '';
    if (success == 1){
    	$('#personelInfo').slideDown('slow');
    	$('#personelInfo').load(base_url+"ajax/userdetailsbyid.php");
		$('#addressEdit').show();
		$('#addressSave').hide();
		$('#personalInformationEditDiv').hide();
		$('#addressEditCancel').hide();	
		$('#pInfoTitle').html('Personal Information');
    }
}
function passSuccess(success){
	$('#ChangeSuccess').show();
	if (success == 1){
  		$('#ChangeSuccess').html('Change Successfull');
    }else{
  		$('#ChangeSuccess').html('Error in Password change.');
    }
    setTimeout("editPassword('cancel')",3000);
}


function editPersonelInfo(mode){
	if(mode == 'edit'){
		$('#personelInfo').hide();
		$('#addressEdit').hide();
		$('#addressSave').show();	
		$('#addressEditCancel').show();	
		$('#personalInformationEditDiv').slideDown('slow');
		$('#pInfoTitle').html('Edit Personal Information');		
	}else if(mode == 'save'){
		/*
		$('#personelInfo').slideDown('slow');
		$('#addressEdit').show();
		$('#addressSave').hide();
		$('#personalInformationEditDiv').hide();
		$('#pInfoTitle').html('Personal Information');
	*/
		$('#f1_upload_process').fadeIn();	
		$('#editPersonelInfoForm').submit();
		/*
		var res = startUpload();
		alert(res);
		if(res==1){
			$('#personelInfo').slideDown('slow');
			$('#addressEdit').show();
			$('#addressSave').hide();
			$('#personalInformationEditDiv').hide();
			$('#pInfoTitle').html('Personal Information');
		}
		*/
	}else{
		$('#personelInfo').slideDown('slow');
    	$('#addressEdit').show();
		$('#addressSave').hide();
		$('#personalInformationEditDiv').hide();
		$('#pInfoTitle').html('Personal Information');
		$('#addressEditCancel').hide();	
	}
}

function settings(mode){
	if(mode == 'edit'){
		$('#settingsInfoDiv').hide();
		$('#settingsEditDiv').show();
		$('#settingsEdit').hide();
		$('#settingsSave').show();
	}
	if(mode == 'save'){
		var adminemail = $('input[name="adminemail"]').val();
		var paypalemail = $('input[name="paypalemail"]').val();
		var gst = $('input[name="gst"]').val();
		var lshiprate = $('input[name="lshipcharge"]').val();
		var currency1 = $('input[name="currency"]').val();
		
		if((adminemail=='')||(paypalemail=='')||(gst=='')||(lshiprate=='')||(currency1=='')){alert('Please put all the fields');return false;}
		if(adminemail!=''){
			if(checkEmail(adminemail)==false){
				alert('Invalid admin email');
				return false;
			}
		}
		if(paypalemail!=''){
			if(checkEmail(paypalemail)==false){
				alert('Invalid paypal email');
				return false;
			}
		}
		
		if(IsNumeric(gst)==false){
			 alert('GST must be numeric');
			 return false;
		 }
		
		 if(IsNumeric(lshiprate)==false){
				 alert('Lower shipping rate must be numeric');
				 return false;
			 }
		
		 $.post(base_url+"user/settingsupdate.php",
		  			{adminemail:adminemail,paypalemail:paypalemail,gst:gst,lshiprate:lshiprate,currency1:currency1}, 
					   function(data){		  				
		  				if(parseInt(data)==1){
		  					location.href=base_url+"user/index.php?pg=dashboard";
						 }	
						});	
	}
}
function editPassword(mode){
	if(mode == 'change'){
		$('#ChangeSuccess').hide();
		 document.getElementById('f1_changepassword_form').style.visibility = 'visible';
		$('#passEdit').hide();
		$('#passSave').show();	
		$('#passEditCancel').show();
		$('#f1_changepassword_form').show();
		$('#changePasswordFrmDiv').slideDown('slow');
		$('#passTitle').html('Save Password');
		$('#editPasswordForm').reset();
	}else if(mode == 'save'){
		$('#editPasswordForm').submit();
		
		/*
		$('#passEdit').show();
		$('#passSave').hide();	
		$('#changePasswordFrmDiv').slideUp('slow');
		$('#passTitle').html('Change Password');
		*/
		changePass();
	}else{
		$('#passEdit').show();
		$('#passSave').hide();
		$('#passEditCancel').hide();
		$('#f1_changepassword_form').show();
		$('#changePasswordFrmDiv').slideUp('slow');
		$('#passTitle').html('Change Password');
		$('#editPasswordForm').reset();
	}
}

function inquiryone(){
	var subject = $('input[name="subject"]').val();
	var bridename = $('input[name="bridename1"]').val();
	var bridephone = $('input[name="bridephone1"]').val();
	var groomname = $('input[name="groomname1"]').val();
	var groomphone = $('input[name="groomphone1"]').val();
	var email = $('input[name="email1"]').val();
	var weddingdate = $('input[name="weddingdate1"]').val();
	var city = $('input[name="city1"]').val();
	var hearFrom = $('input[name="hearfrom1"]').val();
	var bestsuit1 = $('input[name="bestsuit1"]').val();
	var receiveemail = $('input[name="receiveemail1"]:checked').val();
	alert(hearFrom);
	alert(hearFrom);
	if((bridename == '')||(bridephone == '')||(groomname == '')||(groomphone == '')||(email == '')||(weddingdate == '')||(city == '')||(hearFrom == '')||(bestsuit1 == undefined)){
		alert('Please put the all the fields properly');
		return false;
	}else{
		alert('Success');
	}
}
function userregistration(){
	
	var fname = $('input[name="fname"]').val();
	var lname = $('input[name="lname"]').val();
	var address = $('input[name="address"]').val();
	var addresstwo = $('input[name="addresstwo"]').val();
	var phone = $('input[name="phone"]').val();
	var email = $('input[name="email"]').val();
	var zip = $('input[name="zip"]').val();
	var city = $('input[name="city"]').val();
	var country = $('input[name="country"]').val();
	//var regtype = $('input[name="regtype"]:checked').val();
	
	var regtype = $('input[name="regtype"]').val();

	
	if(fname == ''){
		alert('First name is mandatory');
		$('input[name="fname"]').focus();
		return false;
	}
	if(address == ''){
		alert('Address is mandatory');
		$('input[name="address"]').focus();
		return false;
	}
	if(email == ''){
		alert('Please enter a valid email');
		$('input[name="email"]').focus();
		return false;
	}else{
		if(checkEmail(email)==false){
			alert('Invalid email id');
			$('input[name="email"]').focus();
			return false;
		}
	}
	
	$.post(base_url+"ajax/registration.php",
  			{fname:fname,lname:lname,address:address,addresstwo:addresstwo,phone:phone,email:email,zip:zip,city:city,country:country,regtype:regtype}, 
			   function(data){
  				if(parseInt(data)==1){
  					$('#registrationFormDiv').slideUp('slow');	
  					$('#registrationFormSuccess').slideDown('slow');
				 }	
				});	
	
}

function checkEmail(email) {
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) {
		return false;
	}else{
		return true;
	}
}

function delproductimg(id){	
	var tablename = 'prod_image';
			$.post(base_url+"ajax/delid.php?id="+id,
		  			{tablename: tablename}, function(data){
		  				if(parseInt(data)==1){
		  					$('#thumbProdimagediv'+id).fadeOut('slow');
						 }else{
							 alert('Sorry !!! Can not delete now. Please try later');			 
						 }			
					});	
				
		}
		
function delById(id,tablename){	
	$.post(base_url+"ajax/delid.php?id="+id,
  			{tablename: tablename}, function(data){
  				if(parseInt(data)==1){
  					return 1;					
				 }else{
					 return 0;
				 }			
			});	
}

function delByIdTempGuest(id){
	var tablename = 'album_guest';
	$.post(base_url+"ajax/delid.php?id="+id,
  			{tablename: tablename}, function(data){
  				if(parseInt(data)==1){
  					$('#tempGuestEmailId'+id).slideUp('slow');			
				 }else{
					 alert('Error in deletion. Please try later');
				 }			
			});	
}

function editaddress(item,mode,id){
	if(mode == 'edit'){
		$('#'+item+'Form').fadeIn();
		$('#'+item+'Details').hide();
		$('#'+item+'Edit').hide();
		$('#'+item+'Save').fadeIn();
	}
	if(mode == 'save'){
		//alert('hmm working ');
		var tablename = item+'_address';
		var company = $('#'+item+'_company').val();
		var name = $('#'+item+'_name').val();
		var address = $('#'+item+'_address').val();
		var phone = $('#'+item+'_phone').val();
		var fax = $('#'+item+'_fax').val();
		var email = $('#'+item+'_email').val();
		var zip = $('#'+item+'_zip').val();
		var city = $('#'+item+'_city').val();
		var country = $('#'+item+'_country').val();
		
		array = {"email" : email, "company" : company,"name":name,"address":address,"phone":phone,"address":address,"fax":fax,"zip":zip,"city":city,"country":country};
		
		$.post(base_url+"ajax/insert.php",
		  			{insertdata: array,tablename : tablename}, function(data){
		  				if(parseInt(data)==1){
		  					$('#cart'+item+'address').load(base_url+"ajax/address.php?item="+item);
		  					$('#'+item+'Form').fadeOut();
		  					$('#'+item+'Edit').fadeIn();
		  					$('#'+item+'Save').hide();
		  				}
					});	
		
	}
}

function updateTable(updateval,table,id){
		alert(updateval['status']);
		$.post(base_url+"ajax/update.php",
		  			{updatedata: updateval,tablename : table, id : id}, function(data){
		  				
		  				if(parseInt(data)==1){
		  					 location.href=base_url+"user/index.php?pg=orderdetails&id="+id;
		  				}
					});		
	}

function deleteCartProduct(id,productid){
	var answer = confirm("Delete!!! Sure?");
	var fname = $('#fname').val();
	if (answer){
		if((id == '')||(productid == '')){return false;}
		$.post(base_url+"ajax/delid.php?id="+id,
	  			{tablename: 'temp_product',fname : fname}, function(data){
	  				
	  				if(parseInt(data)==1){
	  					$.post(base_url+"ajax/delonmulcondition.php",
	  				  			{tablename: 'temp_product_img',prodid : id}, function(data){
	  				  					$('#cartProduct'+id).fadeOut().remove();
	  				  					$('#productList'+productid).fadeIn();					
	  										
	  							});					
					 }			
				});	
	}
	
}

function deleteMyCartProduct(id,productid){
	var answer = confirm("Delete!!! Sure?");
	var fname = $('#fname').val();
	if (answer){
		if((id == '')||(productid == '')){return false;}
		$.post(base_url+"ajax/delid.php?id="+id,
	  			{tablename: 'temp_product',fname : fname}, function(data){
	  				
	  				if(parseInt(data)==1){
	  					$.post(base_url+"ajax/delonmulcondition.php",
	  				  			{tablename: 'temp_product_img',prodid : id}, function(data){
	  				  					$('#cartProduct'+id).fadeOut().remove();
	  				  					$('#productList'+productid).fadeIn();	
	  				  				    location.href=base_url+"index.php?pg=checkout";
	  										
	  							});					
					 }			
				});	
	}
	
}

function productToCart(productid) {
	
	if(productid=='') return false;
		
	$.post(base_url+"ajax/addproducttocart.php",
  			{id: productid}, function(data){ 
  				if(data.length >0) {
  					 location.href=base_url+"index.php?pg=checkout";
				}				
			});	  
}

function productImgToCart(productid,imgid) {
	
	if(productid=='') return false;
		
	$.post(base_url+"ajax/addproducttocart.php",
  			{id: productid}, function(data){  					 				
				if(data.length >0) {
					alert('Product added to the cart');
					$("#dropableList").append(data);
				 	$("#productList"+productid).fadeOut();
				}				
			});
}


function productAdd(){
	$('.productList').draggable( {
	      containment: '#rightContentShoppingCart',
	      cursor: 'move',
	      revert: true
	    });
    
	$('#dropableList').droppable( {
	      accept: '.productList',
	      hoverClass: 'hovered',
	      drop: handleProductDrop
	    } );
}















function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestionsList').fadeOut();
			return false;
		} else {
		$('#suggestionsList').fadeIn();
		//$('#country').addClass('load');
		$.post(base_url+"ajax/autouser.php",
  			{search: inputString}, function(data){
  					 				
				if(data.length >0) {
					$('#suggestionsList').fadeIn();
					$('#suggestionsList').html(data);
				}				
			});
		}
	}

function fill(id,value) {		
		
		$('#albumWoner').val(value);
		$('#ownerhiddenfiled').val(id);
		setTimeout("$('#suggestionsList').fadeOut();", 300);
	}

function addTempGuest(albumid){
	var email = $('#addMulEmailBox').val();
	var type = $('#addMulEmailBox').attr('rel');
	
	if(email.length <= 0) {
		return false;
	}
	$.post(base_url+"ajax/addtempemail.php?id="+albumid,
  			{email: email}, function(data){
  				if(parseInt(data)==1){
  					if(type=='photographer'){
  					location.href=base_url+"user/index.php?pg=albuminvitation&id="+albumid+"&tab=features&subtab=pending";
  				}else if(type == 'admin'){
  					location.href=base_url+"user/index.php?pg=albuminvitation&id="+albumid+"&tab=features&subtab=pending";
  				}else{
  					location.href=base_url+"index.php?pg=photocollection&id="+albumid+"&tab=features&subtab=pending";
  				}
  					/*
  					$('#guestFromExistingList').html('');
  					$('#guestFromExistingList').load(base_url+"ajax/loadtempemail.php?id="+albumid);
  					$('#addMulEmailBox').val('Enter a valid email');
  					*/
				 }			
			});
}

function addTempGuestId(id,albumid,userid){
  					$('#tempGuestEmailId'+id).removeClass('rounded5box').addClass('rounded5boxActive');
					$('#addGuestIdAnchor'+id).removeClass('tickRowBtn').addClass('tickRowBtnChecked');
}
/*
function addTempGuestId(id,albumid,userid){
	//alert('wroking fine');
	$.post(base_url+"ajax/addtempemail.php?id="+albumid,
  			{userid: userid}, function(data){
  					if(parseInt(data)==1){
  					$('#allTempEmailGuestDiv').load(base_url+"ajax/loadtempemail.php?id="+albumid);
  					$('#tempGuestEmailId'+id).removeClass('rounded5box').addClass('rounded5boxActive');
					$('#addGuestIdAnchor'+id).removeClass('tickRowBtn').addClass('tickRowBtnChecked');
				 }			
			});
	
}
*/

function addTempGuestByEmail(albumid,email){
	$.post(base_url+"ajax/addtempemail.php?id="+albumid,
  			{email: email}, function(data){
  				if(parseInt(data)==1){
  					$('#allTempEmailGuestDiv').load(base_url+"ajax/loadtempemail.php?id="+albumid);  					
				 }			
			});
}


function delPhotoFromCart(id){
	var tablename = 'temp_product_img';
	$.post(base_url+"ajax/delid.php?id="+id,
  			{tablename: tablename}, function(data){
  				if(parseInt(data)==1){
  					$('#cartPhotoImgHolder_'+id).fadeOut("slow").remove();
  					 }			
			});	
}
function delPhotoFromMyCart(id){
	var tablename = 'temp_product_img';
	$.post(base_url+"ajax/delid.php?id="+id,
  			{tablename: tablename}, function(data){
  				if(parseInt(data)==1){
  					$('#cartPhotoImgHolder_'+id).fadeOut("slow").remove();
  					location.href=base_url+"user/index.php?pg=checkout";
  					 }			
			});	
}

function emptyPhotoFromProd(id,prodid){
	var tablename = 'temp_product_img';
	$.post(base_url+"ajax/emptyphototoproduct.php",
  			{id: id,productid:prodid}, function(data){
  				location.href=base_url+"index.php?pg=checkout";  								
			});	
}


function deletefromtable(domid,id,tablename,userid){

	$.post(base_url+"ajax/delid.php?id="+id,
  			{tablename: tablename}, function(data){
  				if(parseInt(data)==1){
  					$('#'+domid).slideUp();
  					
  					$('#tempGuestEmailId'+userid).removeClass('rounded5boxActive').addClass('rounded5box');
					$('#addGuestIdAnchor'+userid).removeClass('tickRowBtnChecked').addClass('tickRowBtn');
					
				 }			
			});	
}

function deletefromtablebyEmail(domid,id,tablename){
	$.post(base_url+"ajax/delbyemailid.php?id="+id,
  			{tablename: tablename}, function(data){
  				if(parseInt(data)==1){
  					$('#'+domid).slideUp();
				 }			
			});	
}
function guestRequestReject(id){
	var answer = confirm("Reject!!! Confirm?");
	if (answer){
	if(id==''){		
		return false;
	}	
	$.post(base_url+"ajax/delrequestid.php",
	  			{id: id}, function(data){	  				
	  				if(parseInt(data)==1){
	  					$('#requestEmailId'+id).slideUp();
					 }							
				});
	}else{
		return false;
	}
}
function guestRequestAdd(id,albumid){
	if((id=='')||(albumid=='')){		
		return false;
	}
	var type = $('addMulEmailBox').attr('rel');
	$.post(base_url+"ajax/addrequestid.php",
	  			{id: id,albumid:albumid}, function(data){
	  				if(parseInt(data)==1){
	  					$('#requestEmailId'+id).slideUp();
	  					if(type='photographer'){	  					
	  					location.href=base_url+"user/index.php?pg=albuminvitation&id="+albumid+"&subtab=pending";
	  					}else if(type='photographer'){	 
	  						location.href=base_url+"user/index.php?pg=albuminvitation&id="+albumid+"&subtab=pending";
	  					}else{
	  						location.href=base_url+"index.php?pg=photocollection&id="+albumid+"&tab=features&subtab=pending";
	  					}
	  					//$('#guestFromExistingList').load(base_url+"ajax/loadtempemail.php?id="+albumid);
					 }							
				});	
	
	
}

function load(id,myurl){
	//alert(id+' = '+myurl);
	var targeturl = base_url+myurl;
	$('#'+id).load(targeturl);
}
function saveProfile(){
	
	var id = $('#profileid').val();
	var table = 'album_guest';
	var name = $('#profilename').val();
	var address = $('#profileaddress').val();
	var phone = $('#profilephone').val();
	var fax = $('#profilefax').val();
	var zip = $('#profilezip').val();
	var city = $('#profilecity').val();
	var country = $('#profilecountry').val();
	
	array = {"name":name,"address":address,"phone":phone,"fax":fax,"zip":zip,"city":city,"country":country};
	$.post(base_url+"ajax/update.php",
  			{updatedata: array,tablename : table, id : id}, function(data){
  				if(parseInt(data)==1){
  					$('#editprofile').hide();
  					$.post(base_url+"ajax/loadprofile.php?id="+id,
  					 function(data){
  						$('#viewprofile').html(data);
  					});	
  					$('#viewprofile').fadeIn('slow');
  					$('#profileeditcancel').hide();
  					$('#profileedit').show();  					
  				}
			});	
	
}
function cancelEditProfile(){
	$('#editprofile').hide();
	$('#viewprofile').fadeIn('slow');
	$('#profileeditcancel').hide();
	$('#profileedit').show();
}
function priceeditcancel(id,price){
	var html = '<span class="itemprice" onclick="convertTextField('+id+','+price+');">$'+price+'<a class="smalledit" href="javascript:void(0)"></a></span>';
		$('#itempricetd'+id).html(html);
}
function priceeditsave(id){
	if(id=='')return false;
	var value = $('#priceeditfield'+id).val();
	if(isNaN(value)==true){
		alert('Please put numeric value');
		return false;
	}else{
		array = {"basicprice" : value};
		$.post(base_url+"ajax/update.php",
	  			{updatedata: array,tablename : 'product_item', id : id}, function(data){			  				
	  				if(parseInt(data)==1){
	  					var html = '<span class="itemprice" onclick="convertTextField('+id+','+value+');">$'+value+'<a class="smalledit" href="javascript:void(0)"></a></span>';
	  					$('#itempricetd'+id).html(html);
	  				}
				});	
	}
}
function convertTextField(id,price){
	var inputField = '<input type="text" style="width:32px;" class="itempriceField" id="priceeditfield'+id+'" onkeyup="itempriceedit(event,this.value,'+id+')" value="'+price+'">'+
	'<a class="smallcancel" onclick="priceeditcancel('+id+','+price+');"></a><a class="smallsave" onclick="priceeditsave('+id+');"></a>';
	
	
	$('#itempricetd'+id).html(inputField);
}
function itempriceedit(e,value,id){
	var unicode=e.keyCode? e.keyCode : e.charCode
	
	if(unicode==13){
		if(isNaN(value)==true){
			alert('Please put numeric value');
		}else{
			array = {"basicprice" : value};
			$.post(base_url+"ajax/update.php",
		  			{updatedata: array,tablename : 'product_item', id : id}, function(data){			  				
		  				if(parseInt(data)==1){
		  					var html = '<span class="itemprice" onclick="convertTextField('+id+','+value+');">$'+value+'<a class="smalledit" href="javascript:void(0)"></a></span>';
		  					$('#itempricetd'+id).html(html);
		  				}
					});	
		}
	}
}
function pageChange(page){
	if(page==''){
		return false;
	}
	else
	{
		location.href=page;
	}
}




$(document).ready(function() {
	/*
	 $(document).bind("contextmenu",function(e){
	        return false;
	    });
	   */
	$('#addProductItem').click(function(){
		var prodId = $('#productidselect').val();
		if(prodId==''){alert('Please select a product');return false;}
		var itemname = $('input[name=itemname]').val();
		var itemcost = $('input[name=itemcost]').val();
		var sideHole = $('input[name=defaultsideshole]').val();
		var defaultSide = $('input[name=defaultsides]').val();
		
		if((defaultSide=='')||(defaultSide==0)){alert('If you create an item for product type, please put "Default no of Sides = 1"');return false;}
		if((sideHole=='')||(sideHole==0)){alert('If you create an item for product type, please put "Side Hole = 1"');return false;}
		if(itemname==''){alert('Please put a item name');return false;}
		if(itemcost==''){alert('Please put a item cost. Leave atleast 0');return false;}
		$('#addProductItemForm').submit();		
	});
	
	$('#additemoption').click(function(){
		
		var itemname = $('#itemname').val();
		var itemvalue = $('#itemvalue').val();
		if(itemname==''){
			alert('Please put item name');return false;
		}
		if(itemvalue==''){
			alert('Please put item value');return false;
		}
		
		$('#itemoptionForm').submit();
		
	});
	$('.itempriceField').click(function(){
		var rel = $(this).attr('rel');
//		alert(rel);
	});
	$('#productid').change(function(){
		var id = $(this).val();
		if(id!=0){
		location.href=base_url+"user/index.php?pg=itemlist&prod="+id;
		}
	});
	
	$('#inquirytype').change(function(){
		$('#printing').hide();
		$('#comentry').hide();
		$('#pckginquiry').hide();
		$('#packagebooking').hide();
		var id = $(this).val();
		$('#'+id).show();
	});
	
	
	$('.itemprice').click(function(){
		var rel = $(this).attr('rel');
		var rel1 = rel.split("_");
		var id = rel1[0];
		var price = rel1[1];
		
		var inputField = '<input type="text" style="width:32px;" rel="'+rel+'" class="itempriceField" onkeyup="itempriceedit(event,this.value,'+id+')" value="'+price+'"><a class="smallcancel"></a>'+
		'<a class="smallsave"></a>';
		
		
		$('#itempricetd'+id).html(inputField);
	});
	$('#profileedit').click(function(){
		$('#viewprofile').hide();
		$('#editprofile').fadeIn('slow');
		$('#profileedit').hide();
		$('#profileeditcancel').show();
	});
	
	$('#profileeditcancel').click(function(){
		$('#editprofile').hide();
		$('#viewprofile').fadeIn('slow');
		$('#profileeditcancel').hide();
		$('#profileedit').show();
	});
	
	$('#secureloginReuest').click(function(){
		var name = $('input[name="requestname"]').val();
		var email = $('input[name="requestemail"]').val();
		var message = $('#requestmessage').val();
		var collectionid = $('#collectionid').val();
		if(collectionid==''){	
			alert('Invalid collection');
			return false;
		}
		
		if(name==''){
			alert('Name can not be null');
			$('input[name="requestname"]').val('')
			$('input[name="requestname"]').focus();
			return false;			
		}
		if(email==''){
			alert('Email can not be  null');
			$('input[name="requestemail"]').val('')
			$('input[name="requestemail"]').focus();
			return false;			
		}
		if(email!=''){
			if(checkEmail(email)==false){
				alert('Invalid email id provided');
				$('input[name="requestemail"]').val('')
				$('input[name="requestemail"]').focus();
				return false;				
			}else{
				$.post(base_url+"ajax/requestcode.php?collectionid="+collectionid,
						{name: name,email: email,message:message}, function(data){
							if(parseInt(data)==1){
								$('#collectionRequestDiv').html('<p class="greenMessage" style="color:green">Request has been sent to collection owner.</p>');
								$('#collectionRequestDiv').slideDown('slow');
								$('#requestcodeform').slideUp('slow');
							 }else{
								 $('#collectionRequestDiv').html('<p class="greenMessage" style="color:ren">Can not send the request right now. Please try later.</p>');
								$('#collectionRequestDiv').slideDown('slow');									
							 }			
						});	
			}
		}
	});
	$('#inviteguest').click(function(){
		var description  = $('#albumDescription').val();
		if(description==''){
			alert('Description field is empty');
			return false;		
		}else{
			$('#guestInvitationForm').submit();
		}
	/*
		var matches = [];
		$('input[name="userid[]"]:checked').each(function() {
		    matches.push(this.value);
		});   
		
		if(matches==''){
			alert('You havn\'t select any guest to invite');
					return false;			
		}else{
			$('#guestInvitationForm').submit();
		}
		*/
	});
	
	$('.del').click(function(){
	var id = $(this).attr('rel');
	if(id!=''){
		delByIdTempGuest(id,'album_guest');		
	}
	});
	$('#sendnotifyemail').click(function(){
		var type = $(this).attr('rel');
		
		var collectionid = $('#collectionid').val();
		if((collectionid==undefined)||(collectionid=='')){return false;}		
		var matches = [];
		$('input[name="userid[]"]:checked').each(function() {
		    matches.push(this.value);
		});
		
		if(matches.length>=1){
			$.post(base_url+"ajax/invitation.php",
		  			{userid: matches,collectionid:collectionid}, function(data){	
		  				if(parseInt(data)==1){	
		  					alert('Notified successfully.');
		  					if(type='photographer'){
			  				location.href=base_url+"user/index.php?pg=albuminvitation&id="+collectionid+"&subtab=pending";
		  					}else if (type='admin'){
				  				location.href=base_url+"user/index.php?pg=albuminvitation&id="+collectionid+"&subtab=pending";
			  					}else{
		  					location.href=base_url+"index.php?pg=photocollection&id="+collectionid+"&tab=features&subtab=pending";
		  					}
		  				}
					});
		}else{
			alert('You have not select any user to notify');
			return false;
		}	
	});
	
	$('#notifyagain').click(function(){
		var type = $(this).attr('rel');
		var collectionid = $('#collectionid').val();
		if((collectionid==undefined)||(collectionid=='')){return false;}		
		var matches = [];
		$('input[name="useridconfirmed[]"]:checked').each(function() {
		    matches.push(this.value);
		});
		
		if(matches.length>=1){
			$.post(base_url+"ajax/invitation.php",
		  			{userid: matches,collectionid:collectionid}, function(data){	
		  				if(parseInt(data)==1){	
		  					alert('Notified successfully.');
		  					if(type='photographer'){
			  				location.href=base_url+"user/index.php?pg=albuminvitation&id="+collectionid+"&subtab=guestFromExistingList";
		  					}else if (type='admin'){
		  						location.href=base_url+"user/index.php?pg=albuminvitation&id="+collectionid+"&subtab=guestFromExistingList";
		  					}else{
		  						location.href=base_url+"index.php?pg=photocollection&id="+collectionid+"&tab=features&subtab=guestFromExistingList";
		  					}
		  				}
					});
		}else{
			alert('You have not select any user to notify');
			return false;
		}	
	});
	
	
	$('#checkallpending').click(function(){
		
		var status = $(this).html();
		if(status=='Check All'){
		$('input[name="userid[]"]').attr('checked', 'checked');
		$(this).html('Uncheck All');
		}else{
			$('input[name="userid[]"]').removeAttr('checked');
			$(this).html('Check All');
		}
	});
	
	$('#checkallconfirmed').click(function(){
		
		var status = $(this).html();
		if(status=='Check All'){
		$('input[name="useridconfirmed[]"]').attr('checked', 'checked');
		$(this).html('Uncheck All');
		}else{
			$('input[name="useridconfirmed[]"]').removeAttr('checked');
			$(this).html('Check All');
		}
	});
	
	
	$('#imageaddtoprod').click(function(){
		var imageid = $('input[name="addtoalbum"]:checked').val();
		var tempprodid = $('#tempimageid').val();
	
		if(tempprodid==''){
			location.href=base_url+"index.php?pg=checkout";
			}
		if(tempprodid==''){return false;}
		if(imageid!=undefined){	
		 $.post(base_url+"ajax/updatetempimg.php",
	  			{id: imageid,tempproductimgid: tempprodid}, function(data){	
	  				$returnVal = parseInt(data);
	  				if($returnVal==-1){	  					
		  				location.href=base_url+"index.php?pg=checkout";
	  				}else{
	  					location.href=base_url+"index.php?pg=arrangephoto&prodid="+$returnVal;
	  				}
				});
		}else{
			alert('You have not select any image to asscociate');
		}
	});
	
	$('#genCode').click(function(){
		var scode = $('#securecode').val();
		if(scode!=''){
		$.post(base_url+"ajax/checksecurecode.php",
	  			{securecode: scode}, function(data){		
	  				if(parseInt(data)==1){
	  					alert('Secure code already exist.Please choose a different one.');
	  					$('#securecode').val('');
	  				}else{
	  					alert('Your provided secure code is available');
	  				}
				});
		}else{
			alert('Secure code is empty');
		}
	});
	$('#continuetoorder').click(function(){
		var email = $('#orderemail').val();
		if(email==''){
			alert('Please enter an email for the order');
			
			$('#orderemail').focus();
			return false;
			}else{
				 if(checkEmail(email)==false){
					 alert('Please enter a valid email');
					 $('#orderemail').focus();
					 return false;
				 }else{
					 $('#emailformsubmit').submit();
				 }
			}
		//return true;
	});
	$('#addPhotoToAlbum').click(function(){
		$('#uploadStatus').html('<img src="'+base_url+'images/ajax-loader.gif">');
		setTimeout("$('#albumAddImgForm').submit()",2000);
	});
	$('#prodImageSubmitButton').click(function(){
		$('#uploadStatus').html('<img src="'+base_url+'images/ajax-loader.gif">');
		setTimeout("$('#addProductImageForm').submit()",2000);
	});
	$('#photoaddtoCart').click(function(){
		var prodcat = $('#productcat').val();
		var prod = $('#albumproduct').val();
		//var proditem = $('#productitem').val();
		var proditem = $('input[name=itemid]:checked').val();
		var noofCopies = $('#numberofcopy').val();
		var imgid = $('#imageId').val();
		
		if(prodcat==''){alert('Please choose a product category.');return false};
		if(prod==''){alert('Please choose a product.');return false};
		if(proditem==undefined){alert('Please choose a product item.');return false};
		if(noofCopies==''){alert('Please put number of copy.');return false};
		if(IsNumeric(noofCopies)==false){
			 alert('Number of copy must be numeric');
			 return false;
		 }
	    $.post(base_url+"ajax/addproductandphototocart.php",
			  			{imgid: imgid,productid: proditem,noofCopies : noofCopies}, function(data){ 
			  				if(parseInt(data)==1){
			  					// alert('Order placed successfully');
			  					location.href=base_url+"index.php?pg=checkout";
			  				}			  				
						});	
	});
	
	$('#addtoOrder').click(function(){
		
		var prodcat = $('#productcat').val();
		var prod = $('#albumproductlist').val();
		var itemid = $('input[name=itemid]:checked').val();
		var albumid = $('#albumid').val();
		
		if(albumid==''){
			return false;
		}
		alert('wroking ');
		alert(albumid);
		alert(itemid);
		alert(prod);
		alert(prodcat);
		if(itemid==undefined||itemid==''){
			alert('Please choose an product item');
			return false;
		}
		if(prodcat==''){alert('Please choose a product category.');return false};
		if(prod==''){alert('Please choose a product.');return false};
		
		$.post(base_url+"ajax/addalbumtocart.php",
	  			{productitemid: itemid,albumid :albumid}, function(data){
	  				
	  				if(parseInt(data)==1){
	  				  location.href=base_url+"index.php?pg=checkout";
	  				}							 
				});
	//	$('#albumOrderForm').submit();
	});
	
$('#addCollectiontoOrder').click(function(){
		
		var prodcat = $('#productcat').val();
		var prod = $('#albumproductlist').val();
		var itemid = $('input[name=itemid]:checked').val();
		var albumid = $('#albumid').val();
		
		if(albumid==''){
			return false;
		}
		
		if(itemid==undefined||itemid==''){
			alert('Please choose an product item');
			return false;
		}
		if(prodcat==''){alert('Please choose a product category.');return false};
		if(prod==''){alert('Please choose a product.');return false};
		
		$.post(base_url+"ajax/addcollectiontocart.php",
	  			{productitemid: itemid,albumid :albumid}, function(data){
	  				
	  				if(parseInt(data)==1){
	  				  location.href=base_url+"index.php?pg=checkout";
	  				}							 
				});
	//	$('#albumOrderForm').submit();
	});
	
	$('#albumproduct').change(function(){
		
		var productid = $(this).val();
		var imgId = $('#imageId').val();
		
		if(imgId==undefined){
			imgId = '';
		}
		
		$.post(base_url+"ajax/getproductitemoption.php",
	  			{productitemid: productid, imgId: imgId}, function(data){	
	  				
	  						$('#productitem').html(data);  								 
				});
		});
	
	$('#albumproductlist').change(function(){
		var productid = $(this).val();
		var id = $('#albumid').val();
		var type = $('#albumtype').val();
		$.post(base_url+"ajax/getalbumitemproduct.php",
	  			{ productitemid: productid, type: type, id: id }, function(data){		  					
	  						$('#productitemdiv').html(data);  								 
				});			
		});
	$('#productcat').change(function(){
		
		var productname = $(this).val();
		$.post(base_url+"ajax/getproductoption.php",
	  			{productname: productname}, function(data){		  					
	  						$('#albumproduct').html(data);  								 
				});
		});
	 $('#saveUserAlbum').click(function(){
		var albumname = $('input[name="albumname"]').val();
		 if(albumname==''){
			 alert('Album name can not be null');
			 $('input[name="albumname"]').focus();
			 return false;
		 }
		 $('#userAlbumAddForm').submit(); 
	 });
	 
		$('#addCollectionButton').click(function(){
			if($('input[name="albumname"]').val()==''){alert('Please put photo collection name'); return false;}
			var email = 0;
			  $('input[name="owneremail[]"]').each(function(){
				  if($(this).val()!=''){
					  if(checkEmail($(this).val())==false){
							alert('Please put a valid email');
							 $(this).val('');
							 $(this).focus();
							
							return false;
						}else{
							email = 1;
						}					
				  }
			  });
			  if(email==0){alert('You need to put atleast one valid owner email'); return false;}
			  if($('#eventDate').val()==''){alert('Please put a event date'); return false;}
			if($('#securecode').val()==''){alert('Please put a secure code'); return false;}
			var scode = $('#securecode').val();
			var isedit = $('#isedit').val();
			
			if(isedit!=1){		
			$.post(base_url+"ajax/checksecurecode.php",
		  			{securecode: scode}, function(data){		
		  				if(parseInt(data)==1){
		  					alert('Please choose a different secure code');
		  				}else{
		  					$('#photocollectionform').submit();	
		  				}
					});
			}else{
				$('#photocollectionform').submit();	
			}
		
		});
		
		
	  $('#addAlbumBtn').click(function(){
		
		  var albumname = $('input[name="albumname"]').val();
		  var albumWonerEmail = $('input[name="albumWonerEmail"]').val();
		  if(albumname==''){
			  alert('Album name is mandatory');
			  $('input[name="albumname"]').focus();
			  return false;
		  }
		  if(albumWonerEmail==''){
			  alert('Album owner email is mandatory');
			  $('input[name="albumWonerEmail"]').focus();
			  return false;
		  }
		  
		  if(albumWonerEmail!=''){
			  if(checkEmail(albumWonerEmail)==false){
					alert('Please put a valid email');
					 $('input[name="albumWonerEmail"]').val('');
					 $('input[name="albumWonerEmail"]').focus();
					return false;
				}
		  }
		  
		  $('#albumAddForm').submit();	
		  
	  });
	  
		$('#subsButton').click(function(){
			var email = $('#q').val();
			if(checkEmail(email)==false){
				alert('Please put a valid email');
				return false;
			}else{
				$.post(base_url+"ajax/subscription.php",
			  			{email: email}, function(data){	
			  					if(parseInt(data)==1){
			  						alert('Subscription successfull');	
			  						$('#q').val('');
		  						}else{
		  							alert('Subscription failed !! Please try again');
		  							$('#q').val('');
		  						}		  				 
						});
			}
		});
		$('#addCategoryBtn').click(function(){
			if($('input[name="categoryName"]').val()==''){alert('Please put product category name'); return false;}
			$('#addCategoryForm').submit();		
		});
		
		$('#addProductBtn').click(function(){
				if($('input[name="productName"]').val()==''){alert('Please put product name'); return false;}
				var prodname = $('input[name="productName"]').val();
				var catid = $('#catid').val();
				$.post(base_url+"ajax/checkproduct.php",
			  			{prodname: prodname,catid : catid}, function(data){	
			  					if(parseInt(data)==1){
			  						alert('There is another product of the same name for the selected category. Please choose a different name');
			  						return false;			  						
		  						}else{
		  							$('#addProductForm').submit();		  							
		  						}		  				 
						});				
				
		});
		$("#orderStatus").change(function(){
			var answer = confirm("Change status!!! Confirm?");
			if (answer){
      		var status = $(this).val();
      			var id = $(this).attr('title');
	      		//updateTable(array,table,id);
				array = {"status" : status};
				$.post(base_url+"ajax/update.php",
			  			{updatedata: array,tablename : 'order', id : id}, function(data){			  				
			  				if(parseInt(data)==1){
			  					 location.href=base_url+"user/index.php?pg=orderdetails&id="+id;
			  				}
						});			
			}      		
      	});
		
		
		
		$('.cartPhotoImgHolder').mouseover(function(){
			$(this).children('span').show();

		});
		$('.cartPhotoImgHolder').mouseout(function(){
			$(this).children('span').hide();

		});
	  $('#albumWoner').keyup(function(event) {
		  var inputString = $(this).val();
		  suggest(inputString); 
		});
	  
	  $('.emailCheck').click(function(){
		  if($(this).is(':checked')==true){
			  var email = $(this).val();
			  var albumid = $(this).attr('title');
			  addTempGuestByEmail(albumid,email);
		  }else{
			  
		  }
	  });
	  
	  $('#noticeSubmitBtn').click(function(){
		  $('#postNotification').hide();
		  var notice = $('#notice_details').val();
		  if(notice==''){alert('Empty post :('); return false;}
		 
		  $.post(base_url+"ajax/postnotice.php",
		  			{ notice: notice }, function(data){
		  					if(parseInt(data)==1){
		  						$('#postNotification').fadeIn();
		  						$('#postNotification').css("color","green");
			  					$('#postNotification').html('Posted succesfully');
			  					setTimeout('$("#postNotification").fadeOut();',3000);			  					
	  						}else{
	  							$('#postNotification').fadeIn();
	  							 $('#postNotification').css("color","red");
			  					$('#postNotification').html('Can not post now. Please try again');
			  					setTimeout('$("#postNotification").fadeOut();',3000);
	  						}		  				 
					});	
		  
	  });
	  
	  $('input[name="email"]').blur(function(){
		  email = $(this).val();
		  if(checkEmail(email)==false){
				return false;
			}else{
				$.post(base_url+"ajax/checkemail.php",
			  			{email: email}, function(data){	
			  					if(parseInt(data)==0){
			  					alert('Email already exist. Please choose a different email');
			  					$('input[name="email"]').val('');
		  						}			  				 
						});	
			}
	  }); 
	 $('#addMoreImage').click(function(){
		var imgAppend = '<input name="productimage[]" type="file" size="" class="none" />';
		$(this).before(imgAppend);
		// $(imgAppend).insertBefore('#item_final');


	 });
	 
	 $('#addMoreImageToAlbum').click(function(){
			var imgAppend = '<input name="photoFile[]" type="file" size="" class="none" />';
			$('#uploadStatus').before(imgAppend);
			// $(imgAppend).insertBefore('#item_final');


		 });
	 
	 $('#addMoreEmail').click(function(){
			//var imgAppend = '<input name="owneremail[]" type="text" class="none" />';
			 var itemAppend = '<tr>'+
				'<td><input class="" style="width:170px;" type="text" name="ownername[]"></td>'+
				'<td><input class="" style="width:170px;" type="text" name="owneremail[]"></td>'+													
				'</tr>';
			//$(this).before(imgAppend);
			$('#ownerdetails tr:last').after(itemAppend);			
		 });
	 
	 $('#addMoreItem').click(function(){
		 var itemAppend = '<tr>'+
				'<td><input class="" type="text" name="itemname[]"></td>'+
				'<td><input class="" type="text" name="baseprice[]"></td>'+	
				'<td><input class="" type="text" name="imgunitprice"></td>'+	
				'<td><input class="" type="text" name="maxallowedimage"></td>'+										
				'</tr>';
		 $('#itemContainerTable tr:last').after(itemAppend);
	 });
	 
	 $('span.del').click(function(){
		 var id = $(this).attr('rel');
		 var tablename = 'useralbum_img';
		 $.post(base_url+"ajax/delid.php?id="+id,
		  			{tablename: tablename}, function(data){
		  				if(parseInt(data)==1){
		  					$('#userAlbumImgDivContainer'+id).fadeOut('slow');	
		  					window.location.reload();
						 }else{
							 alert('Delete not successfull, Please try again');
						 }			
					});	
		 
	 });
	 /*
	 $('.photoCollectionPhotoDiv').mouseover(function(){
			$(this).children('.addtoproduct').fadeIn();

		});
		$('.photoCollectionPhotoDiv').mouseout(function(){
			$(this).children('.addtoproduct').fadeOut();

		});
	*/
	 $('#addItemButton').click(function(){		
		 var itemname = $('input[name="itemname"]').val();
		 var baseprice = $('input[name="baseprice"]').val();
		
		 if((itemname=='')||(baseprice=='')){alert('You have to put all the fields');return false}
		 if(IsNumeric(baseprice)==false){
			 alert('Base price must be numeric');
			 return false;
		 }
		 formSubmit('addItemForm');		 
	 });
	
});