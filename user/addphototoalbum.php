<?php 
$album = $shDB->select('album','id',$_GET['id']);
$album = $album['records'][0];
$user = $shDB->select('logon','id',$album['album_create_by']);
$photo1 = $shDB->select('album_image','album_id',$_GET['id']);
if($photo1){
	$photo = $photo1['records'];
	$photopaging = $photo1['pagination'];
}

$username = $user['records'][0]['fname'].' '.$user['records'][0]['lname'];

$refreshmessage = '';
$uploadMessege = '';
$root = str_replace(chr(92),chr(47),getcwd());
	
	$albumName = str_replace(' ','_',$album['album_name']);
	$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
	$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/';
	
	$dir = str_replace(chr(92),chr(47),getcwd());
	$albumdirectory = str_replace(' ','_',$album['album_name']);
	$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory;
	$useralbumthumbdir = $dir.'/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory.'/thumbs/';
	
	
	
if(isset($_REQUEST['refresh'])){
	$filelist = $imageProcessor->readDirectory($useralbumdir);
	$error = 0;
	foreach($filelist as $file){
			if(($file=='.')||($file=='..')||($file=='thumbs')||($file=='mainphoto')){
								
			}else{
			$filedetails = '';
				$modifiedTime = date ("Y-m-d H:i:s", filemtime($useralbumdir.'/'.$file));
				//$modifiedTime =  $log->timetodb($modifiedTime); 
				$data = array(
					'album_id' => $_GET['id'],
					'image' => $file
					);									
				$imageResult = $shDB->selectOnMultipleCondition($data,'album_image');
				if($imageResult==false){
					$datainsert = array(
					'id' => '',
					'album_id' => $_GET['id'],
					'image' => $file,
					'modified_time' => $modifiedTime
					);
					$imageResult = $shDB->insert($datainsert,'album_image');
					if($imageResult==false){
						$error = 1;
					}else{
						$imageProcessor->createalbumphotothumbs($album['album_create_by'],$albumdirectory,$file,$album['id']);				
					}
				}else{
						$imageProcessor->createalbumphotothumbs($album['album_create_by'],$albumdirectory,$file,$album['id']);	
				}
			}
	}
	if($error!=1){
		$refreshmessage = 'Refresh successfull';
		echo '
		<script>
		location.href="'.$log->base_url.'index.php?pg=addphototoalbum&id='.$_REQUEST[id].'";
		</script>
		';
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
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Collection : <?php echo $album['album_name'];?></td>
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
			<!-- 
				<div class="leftFloat div100">
				<table class="div100" cellpadding="5" cellspacing="0">
					<tr>
						<td style="width:55%; padding-left:2%; padding-right:3%; background:#EAF0F0; line-height:20px;">
							<?php echo $album['description'];?>
						</td>
						<td align="center" style="width:38%; padding-left:1%; padding-right:1%; background:#F5F5F5;line-height:15px;">
							<table style="width:100%" cellpadding="1" cellspacing="0">
								<tr>
									<td style="width:45%">Album Owner</td><td style="width:55%">: <strong><?php echo $username;?></strong></td>
								</tr>
								<tr>
									<td style="width:45%">Event Date</td><td style="width:55%">: <strong><?php echo $log->timewebformat($album['event_date']);?></strong></td>
								</tr>
								<tr>
									<td style="width:45%">Event Place</td><td style="width:55%">: <strong><?php echo $album['event_place'];?></strong></td>
								</tr>
								<tr>
									<td style="width:45%">Total Guest</td><td style="width:55%">: <font class="currencyBold">205</font></strong></td>
								</tr>																								
							</table>
						</td>
					</tr>
				</table>				
				</div>
			 -->
				<script>
				var winOpenClose=1;
				function winOpenCloseFunction()
				{
					if(winOpenClose==1)
					{
						document.getElementById("addNewPhotoDiv").style.display="block";
						document.getElementById("addNewPhotoDivAncor").className="addPhotoDropBgClose";
						document.getElementById("addNewPhotoDivAncor").title="Close";
						winOpenClose=0;
					}
					else
					{
						document.getElementById("addNewPhotoDiv").style.display="none";
						document.getElementById("addNewPhotoDivAncor").className="addPhotoDropBgOpen";
						document.getElementById("addNewPhotoDivAncor").title="Open";
						winOpenClose=1;					
					}
				}
				</script>	
				<div id="addNewPhotoDiv" class="leftFloat div100" style="background:#E1EAEA; display:block;">
					<table cellpadding="5" cellspacing="0" style="width:100%; padding-left:10px; padding-right:10px;">
						<tr>
							<td align="left">
							<div class="content">
								<div>
									<?php
										if(isset($_REQUEST['isphotosubmitted'])){
																					
										$imgArray = reArrayFiles($_FILES["photoFile"]);
										
										$dir = str_replace(chr(92),chr(47),getcwd());	
										$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
											foreach ($imgArray as $img){
											$imgname = $img['name'];														
													$targetpath = $useralbumdir.$img['name'];
													if(@move_uploaded_file($img['tmp_name'], $targetpath)){
														
													$imageProcessor->createalbumphotothumbs($album['album_create_by'],$albumName,$img["name"],$album['id']);
													$datainsert = array(
													'id' => '',
													'album_id' => $album['id'],
													'image' => $img["name"],
													'modified_time' => date("Y-m-d H:i:s")
													);
													$imageResult = $shDB->insert($datainsert,'album_image');							
											}
																		
											}
											/*
										$isUpload = $imageProcessor->uploadPhototoAlbum($album['album_create_by'],$albumdirectory,'photoFile',$album['id']);
												if($isUpload==false){
													$uploadMessege = 'Upload failure. Please try again';
												}else{
													$uploadMessege = 'Upload successfull';
													
												}		
										*/
										echo '<script>
												location.href="'.$log->base_url.'index.php?pg=addphototoalbum&id='.$_REQUEST[id].'";
												</script>';
										
										
										
										}
																	
									?>		
												
									<form action="" method="POST" enctype="multipart/form-data" name="albumAddForm" id="albumAddImgForm">
									 
										<label>Upload Image</label><br />
										<input class="mandatory" type="file" name="photoFile[]">
										<span id="uploadStatus">
										  <img style="margin-top:10px;margin-left:0px;display:none" src="<?php echo $log->baseurl;?>/images/ajax-loader.gif">
										  </span><br />
										   <input type="hidden" name="isphotosubmitted" value="1">
										<input type="button" value="Add More" style="float:left;margin-right:10px;" class="none" id="addMoreImageToAlbum">
										
										<input type="Button" Value="Submit" name="addPhotoBtn" id="addPhotoToAlbum">
										
									</form>
									
								</div>
							</div>
							</td>
							<td style="width:288px;border-left:1px solid #F5F5F5;" align="center">&nbsp;
							<p align="left" style="padding:3px 20px;color:black;">If you uploaded Images by the FTP, click on refresh
button to see them in the photo list.</p>
							<a class="refresh" href="<?php echo $log->base_url;?>index.php?pg=addphototoalbum&id=<?php echo $_REQUEST[id];?>&refresh=refresh"></a>
							</td>
						</tr>
					</table>
				</div>
				
				<div class="leftFloat div100">					
				<table cellpadding="5" cellspacing="0" style="width:100%; padding-left:10px; padding-right:10px;">
					<tr>
						<td align="center" width="100%">	
						<div class="content">
							<table class="div100" cellpadding="4" cellspacing="0">
								<tr>
								<td><h1>Photo List <span style="float:right;"><a class="ordercollection" href="<?php echo $log->baseurl;?>user/index.php?pg=albumdetails&id=<?php echo $_REQUEST['id'];?>"></a></span></h1></td>
								</tr>
								<tr>
								<td>
								<?php
								
								for($i=0;$i<sizeof($photo);$i++)
									{										
										echo '<div class="thumbimagediv"  id="collImageId'.$photo[$i]['id'].'" ><a href="'.$useralbumurl.$photo[$i]['image'].'" class="veryeasylightbox" title="'.$photo[$i]['image'].'" rel="'.$useralbumurl.$photo[$i]['image'].'" >
										<img src="'.$useralbumthumburl.$photo[$i]['image'].'" class="photoThumb" style=" height: 110px; width: 95px;"/>
										</a>
										<span class="delImg" style="position:absolute;" >
										<a class="delCartPhoto" onclick="delImgFromCollection('.$_REQUEST['id'].','.$photo[$i]['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a>
										</span>
										<div class="addtoproduct"><a href="'.$log->baseurl.'user/index.php?pg=phototoproduct&imgid='.$photo[$i]['id'].'" class="addtocart">Add to Product</a></div>
										</div>
										';
									}
								
								?>	
								</td>							
								</tr>
								<tr>
								<td align="center">
								<?php echo $photopaging;?>
								</td>
								</tr>	
							</table>	
						</div>
						</td>
					</tr>														
				</table>			
				</div>
			</div>
		</div>
	</div>
</div>