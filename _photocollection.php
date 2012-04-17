<?php
$msgInviation = '';
						if(isset($_REQUEST['securityCode'])){
							$isSuccessInvitation = invitation();
								if($isSuccessInvitation==true){
											$msgInviation = '<div class="messSuccess">Your invitation sent successfully.</div>';
										}
										else{
											$msgInviation = '<div class="messError">Error in invitation process.</div>';
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
if(isset($_REQUEST['secureemail'])){
$selectAlbumByEmail = array(		
							'guest_id' => trim($_REQUEST['secureemail'])
							);
							
						$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
						
						if(!$selectAlbumByEmail){
							echo 'No collection found';
						}else{
							//var_dump($selectAlbumByEmail);
							foreach($selectAlbumByEmail as $albByEmail){
									$selectAlbum = array(		
									'id' => $albByEmail['album_id'],
									'securitycode'  => $_REQUEST['scode']
									);									
									$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');	
							}							
						}
						if($selectAlbum){
										$_SESSION['email'] = $_REQUEST['secureemail'];
										$_SESSION['scode'] = $_REQUEST['scode'];	
						}
}
if(isset($_REQUEST['search'])){
	session_destroy();
if(($_SESSION['scode']=='')||($_SESSION['email']=='')){?>
<div style="background:#E1EAEA; display:block;" class="leftFloat div100" id="addNewPhotoDiv">
		<form action="<?php echo $log->baseurl?>index.php?pg=photocollection&id="<?php echo $_REQUEST['id'];?>" method="POST" enctype="application/x-www-form-urlencoded" name="secureaccessform" id="secureaccessform">
					<table cellspacing="0" cellpadding="5" style="padding-left:10px; padding-right:10px;">
						<tbody><tr>
							<td align="left">
							<strong>Email</strong>
							</td>
							<td align="left">
							<strong>Secure Code</strong>
							</td>
							<td align="left" rowspan="2" valign="bottom">
							<input type="submit" name="securelogin" value="Submit">
							</td>							
						</tr>
						<tr>
						<td><input type="text" name="secureemail" style="width:150px;"></td>
						<td><input type="text" name="scode" style="width:150px;"></td>
						</tr>
						<tr><td colspan="3"></td></tr>
					</tbody></table>
			</form>
			</div>
<?}
}
if(($_SESSION['scode']!='')||($_SESSION['email']!='')){
	$albumdata = array(
						'id' => $_REQUEST['id'],
							'securitycode' => $_SESSION['scode']
							);
					$album = $shDB->selectOnMultipleCondition($albumdata,'album');
					
					$album = $album[0];
					if($album){
						$photodata = array(
								'album_id' => $album['id']
								);
						$photo = $shDB->selectOnMultipleCondition($photodata,'album_image');
						
					//	$photo = $photo1[0];
					
					/*
					 * 
					 * 
					 * 
					 */
					$albumName = str_replace(' ','_',$album['album_name']);
					$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
					$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/';
					
					$dir = str_replace(chr(92),chr(47),getcwd());
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory;
					$useralbumthumbdir = $dir.'/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory.'/thumbs/';
					
					/*
					 * 
					 * 
					 * 
					 */
					

?>
<h1 class="pagetitle"><?php echo $album['album_name'];?></h1>
<div class="webcontent">
<div class="webTitleandTab">
<div id="boxtab-blue" >
	<ul>
	<li style="float:right;margin-left:440px;"><a href="<?php echo $log->baseurl;?>index.php?pg=invitation">Back to List</a></li> 
	<li  style="float:left"><a href="#photos">Photos</a></li> 
		<?php if($_SESSION['userlevel']==3){ ?>
	<li style="float:left"><a href="#features">Guest Invitation</a></li> 
	<?php } ?>
	<li style="float:left"><a href="#myalbum">My Album</a></li> 
	</ul>
</div>
</div>
<div class="tabContent">
<div id="photos" class="tabDiv">

						<div class="content">
							<table class="div100" cellpadding="4" cellspacing="0">
							<?php if($_SESSION['userlevel']==3){
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
										echo '<div class="photoCollectionPhotoDiv" style="height:155px;display:block;float:left;margin:5px 1px;" onMouseOver="showChild()" onMouseOut="hideChild()">';
										echo '<div style="height:125px;display:block;float:left;"><input type="checkbox" name="addtoalbum[]" value="'.$photo[$i]['id'].'" /></div>';								
										echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="'.$useralbumurl.$photo[$i]['image'].'" class="veryeasylightbox" rel="'.$useralbumurl.$photo[$i]['image'].'" ><div class="thumbimagediv"><img src="'.$useralbumthumburl.$photo[$i]['image'].'" class="photoThumb" /></div></a></div>';
										echo '<div class="addtoproduct"><a href="'.$log->baseurl.'index.php?pg=phototoproduct&imgid='.$photo[$i]['id'].'" class="addtocart">Add to Product</a></div>';
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
	<?php if($_SESSION['userlevel']==3){ ?>
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
						
							<input type="button" Value="Invite Now" name="inviteguest" id="inviteguest">
							<input type="button" onclick="javascript: history.back(1);" Value="Cancel" name="inviteguestcancel" id="inviteguestcancel">
							</div>
												
						</td>
						<td style="width:35%; background:#EAF0F0" valign="top">						
							<div id="personalInformationEditDiv" class="leftFloat div100">
								<div class="leftFloat div100"><strong>Album Guest</strong></div>
								<div align="center" class="leftFloat div100">
									
											<input onfocus="if ( this.value == this.defaultValue ) this.value = ''" onblur="if ( this.value == '' ) this.value = this.defaultValue"  style="width:214px;" type="text"  id="addMulEmailBox" class="guestEmailTextBox" value="Enter a valid email">
											<div class="guestEmailTextBoxButton"  id="btnAddMultipleEmail" onclick="addTempGuest(<?php echo $_REQUEST['id'];?>);">Add</div>
											
								</div>
							</div>
							
							<div style="margin-top:10px;" id="allTempEmailGuestDiv" class="leftFloat div100">
								
								<div class="leftFloat div100 rounded5box">
									<div align="left" class="leftFloat div94Padless">
										
									</div>
									
								</div>														
							</div>
							
									<a class="checkall" id="checkall">Check All</a>
									
							<div style="margin-top:5px;" id="guestFromExistingList" class="leftFloat div100">
								<?php
								$guest = $shDB->selectWithoutPaging('album_guest','album_id',$_REQUEST['id']);
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
									
									<div class="leftFloat div100 rounded5box" id="tempGuestEmailId<?php echo $gst['id']?>" style="background:<?php echo $bgcolor;?>">
										<div align="left" class="leftFloat div94Padless">
										<span class="leftFloat">
										<div style="width:20px;display:block;height:12px;float:left;">
										<?php if($gst['isowner']==0){ ?>
											
										<input type="checkbox" value="<?php echo $gst['id']?>" name="userid[]">
									
										<?php } ?>
										</div>
										&nbsp;<?php echo $gst['guest_id']; ?>
										<?php if($gst['isowner']==1){?>
											<span style="color:green;font-size:10px;">&nbsp;(Owner)</span>
										<?php } ?>
										</span>
										<?php if($gst['isowner']==0){?>
										<span class="rightFloat">
										
										<a class="del" rel="<?php echo $gst['id']?>">x</a>
										<!-- 
										<a id="addGuestIdAnchor<?php echo $gst['id']?>" title="Add to album guest" href="javascript:" onclick="addTempGuestId(<?php echo $gst['id']?>,<?php echo $_REQUEST['id'];?>,<?php echo $gst['id']; ?>);" class="tickRowBtn">&nbsp;</a>
										 -->
										</span>
										<?php } ?>
										</div>
										</div>	
										<?php  
									}
								
								}
								?>
								</div>	
								
								<div style="clear:both;border-left:15px solid #DAC0C0;font-size:10px;padding:0px;margin:2px;padding-left:8px;">Guest added and notified</div>
								<div style="clear:both;border-left:15px solid #FFF;font-size:10px;padding:0px;margin:2px;padding-left:8px;">Guest added but not notified</div>
								<div style="clear:both;border-left:15px solid #CCCC99;font-size:10px;padding:0px;margin:2px;padding-left:8px;">Album Owner</div>										
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
</div>
</div><?php  
					}else{?>
						<h1 class="pagetitle">Permission denied</h1>
<div class="webcontent">
<div class="errmessage">You don't have permission to access the album.</div>
</div>
					<?php }
					}?>