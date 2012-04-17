<?php
$current = 0;
if(isset($_REQUEST['albumproduct'])){
	$current = 1;
}

if(isset($_REQUEST['productname'])){
	$current = 1;
}

if($current==0){
	 echo '<script>location.href="'.$log->base_url.'index.php?pg=albumdetails&id='.$_REQUEST[id].'";</script>';
}

$selectSettings = array(		
						'id' => 1
						);									
						$settings = $shDB->selectOnMultipleCondition($selectSettings,'`settings`');
						$settings = $settings[0];
										
$albumdata = array(
						'id' => $_REQUEST['id']
							);
					$useralbum = $shDB->selectOnMultipleCondition($albumdata,'album');
					$useralbum = $useralbum[0];
					// var_dump($album);
//select album image
$albumImgData = array(
						'album_id' =>$useralbum['id']
							);
					$useralbumImg = $shDB->selectOnMultipleCondition($albumImgData,'album_image');
				
$totalAlbum = array(
	'album_id' =>$useralbum['id']
	);
$totalAlbum = $shDB->totalCount($totalAlbum,'album_image');

						
function albumUrl(){
	include_once '../class/dbclass.php';
	include_once '../class/class.login.php';
	
	$shDB =new sh_DB();
	$log =new logmein();
	$albumdata = array(
						'id' => $_REQUEST['id']
							);
					$useralbum = $shDB->selectOnMultipleCondition($albumdata,'album');
					$useralbum = $useralbum[0];
	
	
	$conditionData = array(
						'id' => $useralbum['album_id']
							);
	$album = $shDB->selectOnMultipleCondition($conditionData,'album');
	$album = $album[0];
	
	$albumName = str_replace(' ','_',$album['album_name']);
										
					$dir = str_replace(chr(92),chr(47),getcwd());
					
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory.'/';
					$useralbumthumbdir = $dir.'/user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory.'/thumbs/';
					
					//$albumdir['userfolder'] = $useralbumthumburl;
					//$albumdir['original'] = $useralbumurl;
					return $useralbumdir;
}
function albumImageUrl($imgId = ''){
	include_once '../class/dbclass.php';
	include_once '../class/class.login.php';
	
	$shDB =new sh_DB();
	$log =new logmein();
	if($imgId=='') return false;
	$conditionData = array(
						'id' => $imgId
							);
	$albumImage = $shDB->selectOnMultipleCondition($conditionData,'album_image');
	$albumImageDetails = $albumImage[0];
	
	$conditionData = array(
						'id' => $albumImageDetails['album_id']
							);
	$album = $shDB->selectOnMultipleCondition($conditionData,'album');
	$album = $album[0];
	
	$albumName = str_replace(' ','_',$album['album_name']);
					$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/'.$albumImageDetails['image'];
					$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/'.$albumImageDetails['image'];
					
					/*
					$dir = str_replace(chr(92),chr(47),getcwd());
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory.'/'.$albumImageDetails['image'];
					$useralbumthumbdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory.'/thumbs/'.'/'.$albumImageDetails['image'];
					*/
					$img['thumbs'] = $useralbumthumburl;
					$img['original'] = $useralbumurl;
					return $img;
}
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Album Order : <?php echo $useralbum['album_name']?> </td>
						</th>
					</table>
				</div>
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="javascript: history.back(1);" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>		
			</div>
			<div class="leftFloat div100">

<div class="webcontent" style="width:95%;overflow:hidden;">
<div id="photos" class="tabDiv">
<!-- 
	<?php foreach ($useralbumImg as $albImg){
		$img = albumImageUrl($albImg['id']);
		echo '<div style="height:125px;display:block;float:left" id="userAlbumImgDivContainer'.$albImg['id'].'">';
		echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="javascript:void();" class="veryeasylightbox" rel="'.$img['thumbs'].'" ><div class="thumbimagediv"><img src="'.$img['thumbs'].'" class="photoThumb" /></div></a></div>';
		echo '</div>';
	}
	?>
	 -->
	<div style="clear:both"></div><br />
	<h2>Confirm Order</h2>
	<div id="loadOrderDiv" class="loadOrderDiv">
	<?php 
	
	if(isset($_REQUEST['albumproduct'])){
		
		
		$catdetailsdata = array(
								'id' => $_REQUEST['productcat']
								);
						$catdetailsdata = $shDB->selectOnMultipleCondition($catdetailsdata,'product_cat');
						$catdetailsdata = $catdetailsdata[0];
						
		$proddetailsdata = array(
								'id' => $_REQUEST['albumproduct']
								);
						$proddetailsdata = $shDB->selectOnMultipleCondition($proddetailsdata,'product');
						
						$proddetailsdata = $proddetailsdata[0];
						
						$prodimgQty = $proddetailsdata['img_quantity'];
						$albumImgQty = $totalAlbum;
						$allowedImgQty = $prodimgQty + ($proddetailsdata['leaf_hole'] * $_REQUEST['additionalalbumleaf']);
							
						$totalCost = $proddetailsdata['basic_price'] + ($proddetailsdata['addition_leaf_price'] * $_REQUEST['additionalalbumleaf']);
?>
<!-- 
<table width="100%">
						<tr>
						<td width="50%" valign="top">
						<div class="leftFloat div100" id=""  style="width:380px;overflow:hidden">
														<div align="left" class="headerCartProduct" style="width:364px">
														<span class="leftFloat"><strong>Billing Address</strong></span>	
														<span class="rightFloat"><a class="edit" id="billEdit" href="javascript:void(0)" onclick="editaddress('bill','edit','<?php echo $_SESSION['email'];?>')" title="Edit">Edit</a><a class="edit" id="billSave" href="javascript:void(0)" style="display:none" onclick="editaddress('bill','save','<?php echo $_SESSION['email'];?>');" title="Save">Save</a></span>														
														<div class="clearb"></div>
														</div>
														<div class=cartddress id="cartbilladdress" title="" style="width:358px;padding:10px;" >
														<?php 
															$data = array(		
																'email' => $_SESSION['email']
															);									
															$billAddress = $shDB->selectOnMultipleCondition($data,'bill_address');
															$billAddress = $billAddress[0];
															?>
														<div id="billForm" style="display:none">
																<label>Company</label><br />
																<input type="text" id="bill_company" value="<?php echo $billAddress['company']?>"><br />
																<label>Full Name</label><br />
																<input type="text" id="bill_name" value="<?php echo $billAddress['name']?>"><br />
																<label>Address</label><br />
																<textarea style="width:250px;" id="bill_address" ><?php echo $billAddress['address']?></textarea><br />
																<label>Phone</label><br />
																<input type="text" id="bill_phone" value="<?php echo $billAddress['phone']?>"><br />
																<label>Fax</label><br />
																<input type="text" id="bill_fax" value="<?php echo $billAddress['fax']?>"><br />
																<label>Email</label><br />
																<input type="text" id="bill_email" value="<?php echo $billAddress['email']?>"><br />
																<label>Zip</label><br />
																<input type="text" id="bill_zip" value="<?php echo $billAddress['zip']?>"><br />
																<label>City</label><br />
																<input type="text" id="bill_city" value="<?php echo $billAddress['city']?>"><br />
																<label>Country</label><br />
																<input type="text" id="bill_country" value="<?php echo $billAddress['country']?>"><br />
														</div>	
														<div id="billDetails">
														<strong>Company</strong><br />
																<?php echo $billAddress['company']?><br />
																<strong>Full Name</strong><br />
																<?php echo $billAddress['name']?><br />
															<strong>Address</strong><br />
																<?php echo $billAddress['address']?><br /><?php echo $billAddress['city']?> - <?php echo $billAddress['zip']?><br /><?php echo $billAddress['city']?>, <?php echo $billAddress['country']?><br />
																<strong>Phone</strong><br />
																<?php echo $billAddress['phone']?><br />
															<strong>Fax</strong><br />
																<?php echo $billAddress['fax']?><br />
																<strong>Email</strong><br />
																<?php echo $billAddress['email']?><br />
													</div>	
													<div class="clearb"></div>	
														</div>									
														</div>	
						</td>
						
						<td width="50%" valign="top">
						<div class="leftFloat div100" id=""  style="width:380px;overflow:hidden">
														<div align="left" class="headerCartProduct" style="width:364px">
														<span class="leftFloat"><strong>Shipping Address</strong></span>
														<span class="rightFloat"><a class="edit" id="shipEdit" href="javascript:void(0)" onclick="editaddress('ship','edit','<?php echo $_SESSION['userid'];?>')" title="Edit">Edit</a><a class="edit" id="shipSave" href="javascript:void(0)" style="display:none" onclick="editaddress('ship','save','<?php echo $_SESSION['userid'];?>');" title="Save">Save</a></span>														
														<div class="clearb"></div>
														</div>
														<div class="cartddress" id="cartshipaddress" style="width:358px;padding:10px;" >
														<?php 
															$data = array(		
																'email' => $_SESSION['email']
															);									
															$shipAddress = $shDB->selectOnMultipleCondition($data,'ship_address');
															
															$shipAddress = $shipAddress[0];
															
															
														?>
														<div id="shipForm" style="display:none">
														<label>Company</label><br />
																<input type="text" id="ship_company" value="<?php echo $shipAddress['company']?>"><br />
																<label>Full Name</label><br />
																<input type="text" id="ship_name" value="<?php echo $shipAddress['name']?>"><br />
																<label>Address</label><br />
																<textarea style="width:250px;" id="ship_address"><?php echo $shipAddress['address']?></textarea><br />
																<label>Phone</label><br />
																<input type="text" id="ship_phone" value="<?php echo $shipAddress['phone']?>"><br />
																<label>Fax</label><br />
																<input type="text" id="ship_fax" value="<?php echo $shipAddress['fax']?>"><br />
																<label>Email</label><br />
																<input type="text" id="ship_email" value="<?php echo $shipAddress['email']?>"><br />
																<label>Zip</label><br />
																<input type="text" id="ship_zip" value="<?php echo $shipAddress['zip']?>"><br />
																<label>City</label><br />
																<input type="text" id="ship_city" value="<?php echo $shipAddress['city']?>"><br />
																<label>Country</label><br />
																<input type="text" id="ship_country" value="<?php echo $shipAddress['country']?>"><br />
													</div>	
													<div id="shipDetails">
														<strong>Company</strong><br />
																<?php echo $shipAddress['company']?><br />
																<strong>Full Name</strong><br />
																<?php echo $shipAddress['name']?><br />
															<strong>Address</strong><br />
																<?php echo $shipAddress['address']?><br /><?php echo $shipAddress['city']?> - <?php echo $shipAddress['zip']?><br /><?php echo $shipAddress['city']?>, <?php echo $shipAddress['country']?><br />
																<strong>Phone</strong><br />
																<?php echo $shipAddress['phone']?><br />
															<strong>Fax</strong><br />
																<?php echo $shipAddress['fax']?><br />
																<strong>Email</strong><br />
																<?php echo $shipAddress['email']?><br />
													</div>	
													<div class="clearb"></div>	
														</div>	
														<div class="clearb"></div>	
														</div>
														</div>									
														</div>	
						</td>
						</tr>
						</table>
						-->	
	<form action="" name="" method="POST" id="albumOrderForm">
	<label>Album name :</label> <?php echo $useralbum['album_name'];?><br />
	<input type="hidden" name="albumid" value="<?php echo $useralbum['id'];?>">
	<label>No of Photos :</label> <?php echo $albumImgQty;?><br />
		<input type="hidden" name="noofphotos" value="<?php echo $albumImgQty;?>">
	<label>Album Category :</label> <?php echo $catdetailsdata['name'];?><br />
	<input type="hidden" name="prodcatid" value="<?php echo $catdetailsdata['id'];?>">
	<label>Album Product :</label> <?php echo $proddetailsdata['name'];?><br />
	<input type="hidden" name="productid" value="<?php echo $proddetailsdata['id'];?>">
	<input type="hidden" name="productname" value="<?php echo $proddetailsdata['name'];?>">
	<input type="hidden" name="basicprice" value="<?php echo $proddetailsdata['basic_price'];?>">
	<input type="hidden" name="leafprice" value="<?php echo $proddetailsdata['addition_leaf_price'];?>">
	<label>Additional Album Leaf :</label> <?php echo $_REQUEST['additionalalbumleaf'];?><br />
		<input type="hidden" name="additionalleafqty" value="<?php echo $_REQUEST['additionalalbumleaf'];?>">
	<label>Total Price :</label> <?php echo $settings['currency'].' $'.$totalCost;?><br />
	<input type="hidden" name="totalprice" value="<?php echo $totalCost;?>">
	<?php echo '<p class="greenMessage" style="color:green">'.$settings['ordermessage'].'</p>';?>
	<input type="submit" name="placeOrder" value="Place Order" id="addtoOrder">
	</form>
	
	<?php 
	}
	if(isset($_REQUEST['productname'])){
		$success = true;
		$datainsert = array(
							'id' => '',
							'useremail' => $_SESSION['email'],
							'isalbum' => 1,
							'albumtype' =>'collection',
							'totalamount' => $_REQUEST['totalprice'],
							'sub_total' => $_REQUEST['totalprice'],						
							'ordertime' => timetodb(),
							'status' => 'Enlisted'
					);
					
					// insert an order				
					$insertOrderId = $shDB->insert($datainsert,'`order`');	
					if(insertOrderId){
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
					
					
					
					$datainsert = array(
							'id' => '',
							'orderid' => $insertOrderId,
							'productid' => $_REQUEST['productid'],
							'album_id' => $_REQUEST['albumid'],
							'name' => $_REQUEST['productname'],
							'basicprice' => $_REQUEST['basicprice'],
							'leafprice' => $_REQUEST['leafprice'],
							'imgquantity' => $_REQUEST['noofphotos'],
							'leafquantity' => $_REQUEST['additionalleafqty'],
							'noofcopy' => 1
						);
						//insert order product			
						$insertOrderProduct = $shDB->insert($datainsert,'`order_product`');
						if($insertOrderProduct){
						$selectOrderImgDatainAlbum = array(		
							'album_id' => $_REQUEST['albumid']
							);									
						$dataInUserAlbumImg = $shDB->selectOnMultipleCondition($selectOrderImgDatainAlbum,'album_image');
						
						if($dataInUserAlbumImg){
							
							foreach ($dataInUserAlbumImg as $dataTPImg){
								
									// insert img id against an order product
									$datainserttoorderimg = array(
										'id' => '',
										'order_product_id' => $insertOrderProduct,
										'album_id' => $_REQUEST['albumid'],
										'img_id' => $dataTPImg['id'],
										'img_ord' => $dataTPImg['img_ord']
									);				
									$insertOrderProductImg = $shDB->insert($datainserttoorderimg,'`order_product_img`');
									if(!$insertOrderProductImg){
										$success = false;
									}
							}
						}
						}else{$success = false;}
					}else{$success = false;}
					
			if($success===true){
				echo 'Thanks for ordering album. Our legal people will contact with you soon.<br /><br />
					  <a class="addtocart" href="'.$log->base_url.'index.php?pg=myalbum">Back to Collection</a>';
			}else{echo 'Order not successful. Please try later.<br /><br />
					  <a class="addtocart" href="'.$log->base_url.'index.php?pg=myalbum">Go to Collection</a>';}		
	 }
	 
	 /*
	 else{
	 	
			
	}
	
	
	*/
	 ?>
	 	
</div>

</div>
</div>
</div>

<?php 
		  switch($_REQUEST['tab']){
							  	case 'items':
							  		 $tab = 'items';
							  		 break;
							  		case 'image':
							  		 $tab = 'image';
							  		 break;
							  		
							  		 case 'features':
							  		 $tab = 'features';
							  		 break;
							  		 case 'specs':
							  		 $tab = 'specs';
							  		 break;
							  		 default:
							  		 	 $tab = 'photos';
							  	
							  }						

							 ?>
							<script type="text/javascript"> 
							  $("#boxtab-blue ul").idTabs("<?php echo $tab;?>"); 
							</script>