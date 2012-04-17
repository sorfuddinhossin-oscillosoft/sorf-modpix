<?php 
$msgInviation = '';
						if(isset($_REQUEST['securityCode'])){
							$isSuccessInvitation = invitation();
								if($isSuccessInvitation==true){
											$msgInviation = '<div class="messSuccess">Collection description saved successfully.</div>';
										}
										else{
											$msgInviation = '<div class="messError">Error in save the description.</div>';
										}
						}
function albumUrl(){

	include_once 'class/dbclass.php';
	include_once 'class/class.login.php';
	
	$shDB =new sh_DB();
	$log =new logmein();
	
	$conditionData = array(
						'id' => $_REQUEST['id']
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
$formerror = '';
if(isset($_REQUEST['photosecureemail'])){
   		$formerror = '<p class="greenMessage" style="color:red">Wrong email or password.</p>';
	   switch ($_REQUEST['loginas']){
	   	case 0:
	   		 $result = $log->login(trim($_REQUEST['photosecureemail']),trim($_REQUEST['scode']));
				  if($result==true){				  
						$selectAlbum = array(		
														'id' => $_REQUEST['id']
														);
						
						
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									$selectAlbum = $selectAlbum[0];
				  }
	   		break;
	   	case 2:
	  		 $result = $log->login(trim($_REQUEST['photosecureemail']),trim($_REQUEST['scode']));
				  if($result==true){
				  	$selectAlbum = array(		
														'id' => $_REQUEST['id'],
				  										'album_create_by'  => $_SESSION['userid']
														);
						
						
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									$selectAlbum = $selectAlbum[0];
				  }
	   		break;
	   	case 3:
	   		$selectAlbumByEmail = array(		
						'guest_id' => trim($_REQUEST['photosecureemail']),
						'isowner' => 1
						);
	   			$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
	   			
									if($selectAlbumByEmail){
										
											$selectAlbum = array(		
											'id' => $_REQUEST['id'],
											'securitycode' => $_REQUEST['scode']
											);									
											$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
											$selectAlbum = $selectAlbum[0];
										
									}
										if($selectAlbum){
											$_SESSION['email'] = $_REQUEST['photosecureemail'];
											$_SESSION['scode'] = $_REQUEST['scode'];	
											$_SESSION['userlevel'] = $_REQUEST['loginas'];
											echo '<script>location.href='.$log->base_url.'"index.php?pg=photocollection&id='.$_REQUEST['id'].'";</script>';
										}
					
	   		break;
	   	default:
	   		$selectAlbumByEmail = array(		
						'guest_id' => trim($_REQUEST['photosecureemail']),
						'isowner' => 0
						);
					$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
	   				if($selectAlbumByEmail){
										
											$selectAlbum = array(		
											'id' => $_REQUEST['id'],
											'securitycode' => $_REQUEST['scode']
											);									
											$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
											$selectAlbum = $selectAlbum[0];
									}
										if($selectAlbum){
											$_SESSION['email'] = $_REQUEST['photosecureemail'];
											$_SESSION['scode'] = $_REQUEST['scode'];	
											$_SESSION['userlevel'] = $_REQUEST['loginas'];
											echo '<script>location.href='.$log->base_url.'"index.php?pg=photocollection&id='.$_REQUEST['id'].'";</script>';
										}
	   		break;
	   }
   }elseif(isset($_SESSION['userid'])){
	if($_SESSION['userlevel']==0){
	$selectAlbum = array(		
									'id' => $_REQUEST['id']
									);
	}else{
		$selectAlbum = array(		
									'id' => $_REQUEST['id'],
									'album_create_by'  => $_SESSION['userid']
									);
	}
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									$selectAlbum = $selectAlbum[0];
}elseif(isset($_SESSION['scode'])){
	$selectAlbum = array(		
									'id' => $_REQUEST['id'],
									'securitycode'  => $_SESSION['scode']
									);
																		
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									$selectAlbum = $selectAlbum[0];
									}
?>
<h1 class="pagetitle">Photo Collection</h1>
<div class="webcontent">

<table width="100%"> 
<tr>
<td>

<?php 
if($selectAlbum){
$album = $selectAlbum;
	
						$albumName = str_replace(' ','_',$album['album_name']);
						$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
						$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/';
						
						$data = array(		
									'album_id' => $album['id']
									);
									
						$photo = $shDB->selectOnMultipleCondition($data,'album_image');
	?>
<div class="webTitleandTab">
<h1 class="cartAlbumHeader"><?php echo $album['album_name'];?><small style="float:right"><?php echo $album['event_place'];?></small></h1>

<div id="boxtab-blue" >
	<ul>
	<li style="float:right;margin-left:250px;"><a href="<?php echo $log->baseurl;?>index.php?pg=invitation">Back to List</a></li> 
	<li  style="float:left"><a href="#photos">Photos</a></li> 
		<?php if(($_SESSION['userlevel']==3)||($album['album_create_by']==$_SESSION['userid'])||($_SESSION['userlevel']==0)){ ?>
	<li style="float:left"><a href="#features">Guest Invitation</a></li> 
	<?php } ?>
	<li style="float:left"><a href="#myalbum">My Album</a></li> 
	<li style="float:left"><a href="#profile">My Profile & Order Details</a></li> 
	
	</ul>
</div>
</div>
<div class="tabContent" style="clear:both">
<div id="photos" class="tabDiv">

						<div class="content">
							<table class="div100" cellpadding="4" cellspacing="0">
							<?php if(($_SESSION['userlevel']==3)||($selectAlbum['album_create_by']==$_SESSION['userid'])||($_SESSION['userlevel']==0)){ 
									if(isset($_REQUEST['addPhotoBtn'])){
											$directory = albumUrl();
												$isUpload = $imageProcessor->uploadPhototoDirectory($directory,$album['id'],'photoFile');
												if($isUpload==false){
													$uploadMessege = 'Upload failure. Please try again';
												}else{
													$datainsert = array(
													'id' => '',
													'useralbum_id' => $_REQUEST['id'],
													'img_id' => $isUpload,
													'img_ord' => 0
													);
													$imageInsertResult = $shDB->insert($datainsert,'useralbum_img');
																										
												}
												echo '	<script>
														location.href="'.$log->base_url.'index.php?pg=photocollection&id='.$_REQUEST[id].'";
														</script>';
													
												}
								
								?>
							<tr>	
							<td>
							
							<form action="" method="POST" enctype="multipart/form-data" name="albumAddForm" style="clear:both">
										<label>Upload an Image</label><br />
										<input class="mandatory" type="file" name="photoFile"><br />
										<input type="Submit" Value="Submit" name="addPhotoBtn">
										<input type="reset" Value="Cancel">
									</form>
							</td>
							</tr>
							<?php } ?>
								<tr>
								<td>
								<?php if($photo){?>
								<form action="<?php echo $log->base_url;?>index.php?pg=addtoalbum&id=<?php echo $_REQUEST[id];?>" method="POST">
								<?php
								for($i=0;$i<sizeof($photo);$i++)
									{	
										echo '<div class="photoCollectionPhotoDiv" style="height:155px;display:block;float:left;margin:5px 1px;" onMouseOver="showChild()" onMouseOut="hideChild()" title="'.$photo[$i]['image'].'">';
										echo '<div style="height:125px;display:block;float:left;"><input type="checkbox" name="addtoalbum[]" value="'.$photo[$i]['id'].'" /></div>';								
										echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="'.$useralbumurl.$photo[$i]['image'].'" class="veryeasylightbox" rel="'.$useralbumurl.$photo[$i]['image'].'" ><div class="thumbimagediv"><img src="'.$useralbumthumburl.$photo[$i]['image'].'" class="photoThumb" /></div></a></div>';
										echo '<div class="addtoproduct"><a href="'.$log->baseurl.'index.php?pg=phototoproduct&imgid='.$photo[$i]['id'].'" class="addtocart">Add to Cart</a></div>';
										echo '</div></div>';
									}
								
								?>	
								<br />
								<div style="clear:both">
								<input type="submit" value="Add to Album" style="clear:both;margin-top:20px;">
								</div>
								</form>
								<?php }else{?>
								There is no photo ascociated in this album.
								<?php } ?>
								</td>							
								</tr>							
							</table>	
						</div>
							  <div class="caption"><div class="content"></div></div>
					
					 <script>
							  $(document).ready(function(){	
								   slideShow();
								});
							  </script>
<br />
 <div class="clear" style="clear:both"></div>
 <div style="clear:both;display:block">
 
	
</div>
</div>	
	<?php if(($_SESSION['userlevel']==3)||($selectAlbum['album_create_by']==$_SESSION['userid'])||($_SESSION['userlevel']==0)){ ?>
<div id="features" class="tabDiv">
					 
						<table style="width:100%;" cellpadding="10" cellspacing="0">
					<tr>
						<td style="width:65%" valign="top">
						<?php 
						
						
						echo $msgInviation; 
						?>
						<form action="<?php echo $log->base_url;?>index.php?pg=photocollection&id=<?php echo $_REQUEST['id'];?>&tab=features" method="post" id="guestInvitationForm">
						
						
							<div class="leftFloat div100" style="margin-bottom:10px;"><strong>Album Description</strong></div>
							<div class="formDiv">
							<textarea class="width95 height120" name="albumDescription" id="albumDescription"><?php echo html_entity_decode($album['description']);?></textarea><br />
							<div class="leftFloat div100" style="margin-bottom:10px;"><strong>Security Code</strong></div>
							<input style="width:410px;" type="text" value="<?php echo $album['securitycode'];?>" name="securityCode" id="securityCode" readonly>
							<div style="clear:both">
							<input type="button" Value="Save" style="clear:left" name="inviteguest" id="inviteguest">
							<input type="button" onclick="javascript: history.back(1);" Value="Cancel" name="inviteguestcancel" id="inviteguestcancel">
							</div>
							</div>
												
						</td>
						<td style="width:35%; background:#EAF0F0" valign="top">						
							<div id="personalInformationEditDiv" class="leftFloat div100">
							<!-- Pending Request -->
							<strong style="clear:both">Pending Request</strong>
								<?php 
								$albumRequest = $shDB->selectWithoutPaging('album_request','collectionid',$_REQUEST['id']);
								?>
								<?php
								if($albumRequest){
								 foreach($albumRequest as $albRqst){?>
								<div class="leftFloat div100 rounded5box" id="requestEmailId<?php echo $albRqst['id']?>" style="background:#D1DDDE">
										<div align="left" class="leftFloat div94Padless">
										<span class="leftFloat">
										&nbsp;<?php echo $albRqst['email'];?>
										</span>
										<span class="rightFloat">
										<a class="tickRowBtn" title="Accept" style="float:left;margin-right:-5px;" rel="<?php echo $albRqst['id']?>" onclick="guestRequestAdd('<?php echo $albRqst['id']?>','<?php echo $_REQUEST['id']?>')"></a>
										<a class="delGuest"  title="Reject" style="float:right" rel="<?php echo $albRqst['id']?>"  onclick="guestRequestReject('<?php echo $albRqst['id']?>')">x</a>								
										</span>
										
										</div>
										</div>
										
								<?php } }else{
									echo '<p class="greenMessage">No request.</p>';
								}?>	
							<!-- end of pending request -->
								<div class="leftFloat div100"><strong>Album Guest</strong></div>
								<div align="center" class="leftFloat div100">
									
											<input onfocus="if ( this.value == this.defaultValue ) this.value = ''" onblur="if ( this.value == '' ) this.value = this.defaultValue"  style="width:214px;" type="text"  id="addMulEmailBox" class="guestEmailTextBox" value="Enter a valid email">
											<div class="guestEmailTextBoxButton"  id="btnAddMultipleEmail" onclick="addTempGuest(<?php echo $_REQUEST['id'];?>);">Add</div>
											
								</div>
							</div>
								<ul class="gueststatus">
								<li class="selected"><a href="#owner">Owner</a></li>
								<li><a href="#pending">Not confirmed</a></li>
								<li><a href="#guestFromExistingList">Confirmed</a></li>
								</ul>
								<input type="hidden" id="collectionid" value="<?php echo $_REQUEST['id']?>">
							<div id="owner">
							<strong>Owner's Profile</strong>
							<p style="background:#FBFCFC;border:1px solid #D1DDDE;margin:0px;padding:5px;line-height:0.8em">
							<?php 
							$dataSelectGuestEmail = array(		
									'isowner' => 1,
									'album_id' => $_REQUEST['id']
								);		
								$guest = $shDB->selectOnMultipleCondition($dataSelectGuestEmail,'album_guest');
								foreach($guest as $gst){
									
								?>
							<label>Name:</label><br />
							<?php echo $gst['name'];?><br />
							<label>Email</label><br />
							<?php echo $gst['guest_id'];?><br />
							<label>Phone</label><br />
							<?php echo $gst['phone'];?><br />
							<label>Fax</label><br />
							<?php echo $gst['fax'];?><br />
							<label>Address</label><br />
							<?php echo $gst['address'];?><br />
							<label>City</label><br />
							<?php echo $gst['zip'];?>
							<?php echo '-'.$gst['city'];?><br />
							<label>Country</label><br />
							<?php echo $gst['country'];?><br />
							<?php 	}
								?>
							
							
							</p>
							</div>
							<div id="pending">
							<a class="checkall" id="checkallpending">Check All</a><a class="checkall" rel="guest" id="sendnotifyemail">Send Notification Email</a>
								<?php
								$dataSelectGuestEmail = array(		
									'notified' => 0,
									'album_id' => $_REQUEST['id']
								);		
								$guest = $shDB->selectOnMultipleCondition($dataSelectGuestEmail,'album_guest');
								
								//$guest = $shDB->selectWithoutPaging('album_guest','album_id',$_REQUEST['id']);
								if($guest){
								foreach($guest as $gst){
									$bgcolor = '#FFF';
									if($gst['isowner']==1){
										$bgcolor = '#CCCC99';
									}else{
										if($gst['notified']==1){
											$bgcolor = '#DAC0C0';
										}else{
											$bgcolor = '#FFF';
										}
									}
									
									?>
									<?php if($gst['isowner']!=1){ ?>
									<div class="leftFloat div100 rounded5box" id="tempGuestEmailId<?php echo $gst['id']?>" style="background:<?php echo $bgcolor;?>">
										<div align="left" class="leftFloat div94Padless">
										<span class="leftFloat">
										<div style="width:20px;display:block;height:12px;float:left;">
										
											
										<input type="checkbox" value="<?php echo $gst['id']?>" name="userid[]">
									
										
										</div>
										&nbsp;<?php echo $gst['guest_id']; ?>
										<?php if($gst['isowner']==1){?>
											<span style="color:green;font-size:10px;">&nbsp;(Owner)</span>
										<?php } ?>
										</span>
										<?php if($gst['isowner']==0){?>
										<span class="rightFloat">
										
										<a class="del" title="Delete from Guest List" rel="<?php echo $gst['id']?>">x</a>
										<!-- 
										<a id="addGuestIdAnchor<?php echo $gst['id']?>" title="Add to album guest" href="javascript:" onclick="addTempGuestId(<?php echo $gst['id']?>,<?php echo $_REQUEST['id'];?>,<?php echo $gst['id']; ?>);" class="tickRowBtn">&nbsp;</a>
										 -->
										</span>
										<?php } ?>
										</div>
										</div>
										<?php } ?>	
										<?php  
									}
								
								}
								?>
							</div>
							
									
									
							<div style="margin-top:5px;" id="guestFromExistingList" class="leftFloat div100">
							<a class="checkall" id="checkallconfirmed">Check All</a><a class="checkall" id="notifyagain" rel="guest">Notify Again</a>
								<?php
								$dataSelectGuestEmail = array(		
									'notified' => 1,
									'album_id' => $_REQUEST['id']
								);		
								$guest = $shDB->selectOnMultipleCondition($dataSelectGuestEmail,'album_guest');
								if($guest){
								foreach($guest as $gst){
									$bgcolor = '#FFF';
									if($gst['isowner']==1){
										$bgcolor = '#CCCC99';
									}else{
										if($gst['notified']==1){
											$bgcolor = '#DAC0C0';
										}else{
											$bgcolor = '#FFF';
										}
									}
									
									?>
									<?php if($gst['isowner']!=1){ ?>
									<div class="leftFloat div100 rounded5box" id="tempGuestEmailId<?php echo $gst['id']?>" style="background:<?php echo $bgcolor;?>">
										<div align="left" class="leftFloat div94Padless">
										<span class="leftFloat">
										<div style="width:20px;display:block;height:12px;float:left;">
										
											
										<input type="checkbox" value="<?php echo $gst['id']?>" name="useridconfirmed[]">
									
										
										</div>
										&nbsp;<?php echo $gst['guest_id']; ?>
										<?php if($gst['isowner']==1){?>
											<span style="color:green;font-size:10px;">&nbsp;(Owner)</span>
										<?php } ?>
										</span>
										<?php if($gst['isowner']==0){?>
										<span class="rightFloat">
										
										<a class="del" title="Delete from Guest List" rel="<?php echo $gst['id']?>">x</a>
										<!-- 
										<a id="addGuestIdAnchor<?php echo $gst['id']?>" title="Add to album guest" href="javascript:" onclick="addTempGuestId(<?php echo $gst['id']?>,<?php echo $_REQUEST['id'];?>,<?php echo $gst['id']; ?>);" class="tickRowBtn">&nbsp;</a>
										 -->
										</span>
										<?php } ?>
										</div>
										</div>	
										<?php  }
									}
								
								}
								?>
								</div>	
								
								
								<br />
								
																		
							</div>
					
						
							</form>					
						</td>					</tr>
				</table>
								  
								</div> 
								<?php } ?>	
							   <div id="myalbum" class="tabDiv">
							  	  <?php 
							  	 
							  	  	$myAlbum = array(
											'album_id' => $_REQUEST['id'],
							  	  			'create_by' => $_SESSION['email']
											);
									$myAlbum = $shDB->selectOnMultipleCondition($myAlbum,'useralbum');
									if($myAlbum){
									?>
									<h3>My albums related to this collection</h3>
									<table cellpadding="5" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:35%; padding-left:2%;">Album Name</td>
						
						<td align="left" class="tableHeader" style="width:19%">No of Photos</td>
						<td align="left" class="tableHeader" style="width:12%">Action</td>
					</tr>
					<?php foreach($myAlbum as $mAlbum){?>	
					<tr>
						<td align="left" style="width:35%; padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><?php echo $mAlbum['name'];?></td>
						<td align="left" style="width:19%; border-bottom:dotted #CCCCCC 1px;">
						<?php
							$totalAlbum = array(
											'useralbum_id' => $mAlbum['id']
											);
									$totalAlbum = $shDB->totalCount($totalAlbum,'useralbum_img');
									echo $totalAlbum;
						?>
						
</td>
						<td align="left" style="width:12%; border-bottom:dotted #CCCCCC 1px;">
							<a title="Record Details" href="<?php echo $log->baseurl;?>index.php?pg=albumdetails&id=<?php echo $mAlbum['id'];?>" class="detailsRowBtn">&nbsp;</a>
						</td>
					</tr>
				<?php } ?>
				</table>
				<?php } else {?>
					You don't have any album for this collection.
				<?php } ?>
							   </div>
	<div id="profile">
	<?php 
	?>
	<table style="width:100%;" cellpadding="10" cellspacing="0">
					<tr>
						<td style="width:65%" valign="top">
						<h2>Order List</h2>
						<?php
						$selectOrder = array(	
						'useremail'  => $_SESSION['email']
				);									
$order = $shDB->selectOnMultipleCondition($selectOrder,'`order`');
						 if($order){?>
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:25%">Order Date</td>
						<td align="left" class="tableHeader" style="width:25%">Order Type</td>
						<td align="left" class="tableHeader" style="width:25%">Total Payment</td>
						<td align="left" class="tableHeader" style="width:25%">Status</td>
						
					</tr>					
					<?php
					foreach($order as $ord)
					{
						$user = $shDB->select('logon','id',$ord['userid']);
						// $username = $user['records'][0]['fname'].' '.$user['records'][0]['lname'];
					?>
					<tr>
						
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $log->timewebformat($ord['ordertime']);?></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php if($ord['isalbum']==1)echo 'Album';?></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $settings['currency'];?>&nbsp;<font class="currency"><?php echo $ord['totalamount'];?></font></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><span class="ordStatusOpen"><?php echo $ord['status'];?></span></td>
						<!-- 
						<td align="center" style="border-bottom:dotted #CCCCCC 1px;">
						<a title="Record Details" href="<?php echo $log->baseurl;?>index.php?pg=orderdetails&id=<?php echo $ord['id'];?>" class="detailsRowBtn">&nbsp;</a>
						</td>
						 -->
					</tr>					
					<?php } ?>	
					<tr>
						<td align="center" colspan="6">
						<?php echo $result['pagination'];?>
						</td>
					</tr>											
				</table>
				<?php }else{?>
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:90%; padding-left:2%;">
					<p class="greenMessage" style="color:red">No orders available.</p>
					</td>
					</tr>
					</table>
				<?php }?>
						
						
							
												
						</td>
						<td style="width:35%; background:#EAF0F0" valign="top">						
							
								<ul class="gueststatus">
								
								<li class="selected"><a href="#selfprofile">My Profile</a></li>	
								<li><a href="#ownersprofile">Owner's Profile</a></li>								
								</ul>
							<div id="selfprofile">
							<div class="leftFloat div100" style="margin-bottom:10px;"><span style="float:right">
							<a class="edit" id="profileedit">Edit</a>
							</span></div>
							<div class="formDiv" id="viewprofile" style="display:block;padding:20px;line-height:0.8em;margin-top:0px;padding-top:4px;">
							
							<?php 
							$dataSelectGuestEmail = array(		
									'guest_id' => $_SESSION['email'],
									'album_id' => $_REQUEST['id']
								);		
								$guest = $shDB->selectOnMultipleCondition($dataSelectGuestEmail,'album_guest');
								$gst = $guest[0];
								
									
								?>
									<label>Name:</label><br />							
							<?php echo $gst['name'];?><br />
							<label>Phone</label><br />
						<?php echo $gst['phone'];?><br />
							<label>Fax</label><br />
							<?php echo $gst['fax'];?><br />
							
							<label>Address</label><br />
							<?php echo $gst['address'];?><br />
							
							<label>Zip</label><br />
							<?php echo $gst['zip'];?><br />
							<label>City</label><br />
							<?php echo $gst['city'];?><br />
							<label>Country</label><br />
							<?php echo $gst['country'];?><br />
													
							
							</div>
							<div class="formDiv" id="editprofile"  style="display:none">
							<label>Name:</label><br />							
							<input type="text" id="profilename" name="profilename" value="<?php echo $gst['name'];?>" style="width:242px;"><br />
							<label>Phone</label><br />
							<input type="text" id="profilephone" name="profilephone" value="<?php echo $gst['phone'];?>" style="width:242px;"><br />
							
							<label>Fax</label><br />
							<input type="text" id="profilefax" name="profilefax" value="<?php echo $gst['fax'];?>" style="width:242px;"><br />
							
							<label>Address</label><br />
							<input type="text" id="profileaddress" name="profileaddress" value="<?php echo $gst['address'];?>" style="width:242px;"><br />
							
							<label>Zip</label><br />
							<input type="text" id="profilezip" name="profilezip" value="<?php echo $gst['zip'];?>" style="width:242px;"><br />
							<label>City</label><br />
							<input type="text" id="profilecity" name="profilecity" value="<?php echo $gst['city'];?>" style="width:242px;"><br />
							<label>Country</label><br />
							<input type="text" id="profilecity" name="profilecountry" value="<?php echo $gst['country'];?>" style="width:242px;"><br />
							<input type="hidden" id="profileid" value="<?php echo $gst['id'];?>				
							<div style="clear:both">
							<input type="button" Value="Update" style="clear:left" name="guestprofileupdate" id="guestprofileupdate" onclick="saveProfile()">
							<input type="button" Value="Cancel" name="inviteguestcancel" onclick="cancelEditProfile()" id="inviteguestcancel">
							</div>
							</div>
							
								</div>
							<div id="ownersprofile">							
							<p style="padding:20px;line-height:0.8em;margin-top:0px;padding-top:4px;">
							<?php 
							$dataSelectGuestEmail = array(		
									'isowner' => 1,
									'album_id' => $_REQUEST['id']
								);		
								$guest = $shDB->selectOnMultipleCondition($dataSelectGuestEmail,'album_guest');
								foreach($guest as $gst){
									
								?>
							<label>Name:</label><br />
							<?php echo $gst['name'];?><br />
							<label>Email</label><br />
							<?php echo $gst['guest_id'];?><br />
							<label>Phone</label><br />
							<?php echo $gst['phone'];?><br />
							<label>Fax</label><br />
							<?php echo $gst['fax'];?><br />
							<label>Address</label><br />
							<?php echo $gst['address'];?><br />
							<label>City</label><br />
							<?php echo $gst['zip'];?>
							<?php echo '-'.$gst['city'];?><br />
							<label>Country</label><br />
							<?php echo $gst['country'];?><br />
							<?php 	}								?>
	
							</p>
							</div>								
							<br />
	</div>
</form>					
						</td>					</tr>
				</table>
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
							  		 case 'myalbum':
							  		 	$tab = 'myalbum';
							  		 	break;
							  		 case 'specs':
							  		 $tab = 'specs';
							  		 break;
							  		 default:
							  		 	 $tab = 'photos';
							  	
							  }

	switch($_REQUEST['subtab']){
							  
							  		case 'pending':
							  		 $subtab = 'pending';
							  		 break;
							  		
							  		 case 'guestFromExistingList':
							  		 $subtab = 'guestFromExistingList';
							  		 break;
							  		
							  		 default:
							  		 	 $subtab = 'owner';
							  		 	 break;
							  	
							  }

							 ?>
							<script type="text/javascript"> 
							  $("#boxtab-blue ul").idTabs("<?php echo $tab;?>"); 
							  $(".gueststatus").idTabs("<?php echo $subtab;?>"); 
							</script>
</div>
					
<?php 
}else{
	 
			?>
		<div style="display:block;" class="leftFloat div100" id="addNewPhotoDiv">
		<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="secureaccessform" id="secureaccessform">
					<table cellspacing="0" cellpadding="5" style="padding-left:10px; padding-right:10px;">
							<tbody>
							<tr>
							<td>
							<p style="margin:0px;font-size:11px;color:black;">
							<strong>Welcome to Modpix, your online photo sharing and printing solution.</strong><br />
							The Photo Collection that you are trying to view requires a security code for access, please enter the security code
							</p>
							</td>
							</tr>
							<tr><td>
							<?php echo $formerror;?>
							</td></tr>
							<tr>
							<td>
							<label>Login as</label><br />
								<input type="radio" name="loginas" value="0">Admin &nbsp;
								<input type="radio" name="loginas" value="2">Photographer &nbsp;
								<input type="radio" name="loginas" value="3">Couple &nbsp;
								<input type="radio" name="loginas" value="4" checked>Guest &nbsp;
								<br />
							</td>
							</tr>
						
						<tr>
							<td align="left">
							<strong>Email</strong><br />
							<input type="text" name="photosecureemail">
							</td>
							</tr>
							<tr>
							<td align="left">
							<strong>Secure Code</strong><br />
							<input type="password" name="scode">
							</td>
							</tr>
							<tr><td colspan="3">
							<p style="margin:0px;font-size:11px;color:black;">
							<i>This will be your login so you can access your favourites and account the next time you visit this album</i>
							</p>
							</td></tr>
							<tr>
							<td align="left" rowspan="2" valign="bottom">
							<input type="submit" name="securelogin" value="Submit">
							</td>							
						</tr>
						<tr><td colspan="3"></td></tr>
					</tbody></table>
			</form>
			<div style="display:none;clear:both" id="collectionRequestDiv">
			</div>
			
			<form style="clear:both" action="" method="POST" enctype="application/x-www-form-urlencoded" name="requestcodeform" id="requestcodeform">
					
					<table cellspacing="0" cellpadding="5" style="padding-left:10px; padding-right:10px;">
							<tbody>
							<tr>
							<td>
							<p style="margin:0px;font-size:14px;color:#5A7578;">
							<br /><br /><br />
							If you have misplaced the security code, permission will be required from the album owner. Please complete the following - 
							</p>
							</td>
							</tr>
							<tr>
							<td align="left">
							<strong>Name</strong><br />
							<input type="text" name="requestname" class="mandatory">
							</td>
							</tr>
						<tr>
							<td align="left">
							<strong>Email</strong><br />
							<input type="text" name="requestemail" class="mandatory">
							</td>
							</tr>
							<tr>
							<td align="left">
							<strong>Message</strong><br />
							<textarea style="width:367px;" name="message" id="requestmessage"></textarea>
							</td>
							</tr>
							
							<tr>
							<td align="left" rowspan="2" valign="bottom">
							<input type="hidden" id="collectionid" value="<?php echo $_REQUEST['id'];?>">
							<input type="button" name="secureloginReuest" id="secureloginReuest"  value="Request Submit">
							</td>							
						</tr>
						<tr><td colspan="3"></td></tr>
					</tbody></table>
			</form>
			</div>
			<?php 
}
?>		
			</td>
			</tr>
			</table>
			</div>