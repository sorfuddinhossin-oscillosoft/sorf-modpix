<?php 
	$selectAlbumById = array(		
							'id' => $_REQUEST['id']
							);
							
$selectAlbumById = $shDB->selectOnMultipleCondition($selectAlbumById,'`album`');
$album = $selectAlbumById[0];

$selecOwnerEmailById = array(		
							'album_id' => $_REQUEST['id'],
							'isowner' => 1							
							);
							
$owneremail = $shDB->selectOnMultipleCondition($selecOwnerEmailById,'`album_guest`');


//$username = $userdetails['fname'].' '.$userdetails['lname'];
?>
<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $log->baseurl;?>user/jscalendar/calendar.js"></script>

<!-- language for the calendar -->

<script type="text/javascript" src="<?php echo $log->baseurl;?>user/jscalendar/lang/calendar-en.js"></script>
<!-- Main Calendar CSS file -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $log->baseurl;?>user/jscalendar/calendar-blue.css" title="win2k-cold-1" />
<!-- the following script defines the Calendar.setup helper function, which makes
   adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $log->baseurl;?>user/jscalendar/calendar-setup.js"></script>

<script type="text/javascript">
function call_calendar(text_field,trigger_b)
{
    Calendar.setup({
        inputField     :    text_field,      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    trigger_b,   // trigger for the calendar (button ID)
        doubleClick    :    false,           // double-click mode
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
}
</script>
<!-- js calender ink script close -->
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Edit Collection</td>
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
				<table cellpadding="5" cellspacing="0" style="width:100%; padding-left:10px; padding-right:10px;">
					<tr>
						<td align="left">
						We don't take photos just so later they will be forgotten on a disc or in a folder. These memories need to be shared and enjoyed, displayed, on a holiday card, under a gallery light or in a wedding album.
						</td>
					</tr>
					<tr>
						<td align="left">
						<h1>Edit Collection</h1>
						<div class="content">
							<div>
							
								<?php
									if(isset($_REQUEST['albumname'])){
										$email = $_REQUEST['owneremail'];
										$name = $_REQUEST['ownername'];
										if($_REQUEST['ispublic']=='on'){
											$ispublic = 1;
										}else{
											$ispublic = 0;
										}
									
										$dataforalbum = array(											
											'album_name' => $_REQUEST['albumname'],
											'event_date' => $_REQUEST['Event_date'],
											'event_place' => $_REQUEST['Event_place'],											
											'ispublic' => $ispublic																
											);
												
										$result = $shDB->update($dataforalbum,$_REQUEST['collectionid'],'album');
										if($result){
											
										for($i=0;$i<sizeof($_REQUEST['owneremailid']);$i++){
												$dataforupdate = array(																					
													'guest_id' => trim($_REQUEST['owneremail'][$i]),
													'name' =>trim($name[$i])																	
													);
												$resulttoguest = $shDB->update($dataforupdate,$_REQUEST['owneremailid'][$i],'album_guest');
										}
										$dir = str_replace(chr(92),chr(47),getcwd());
											$albumNewName = $_REQUEST['albumname'];
											$albumNewName = str_replace(' ','_',$albumNewName);
											$albumOldName = $album['album_name'];
											$albumOldName = str_replace(' ','_',$albumOldName);
											//$imageProcessor->readDirectory($dir);
											$newdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumNewName;
											$olddir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumOldName;
											
										if($result!=false){
												if(isset($_FILES)){											
												$isUpload = $imageProcessor->uploadMainPhototoAlbum($album['album_create_by'],$albumNewName,'collectionmainphoto',$_REQUEST['id']);												
												}										
												if($newdir!=$olddir){													
													if(rename($olddir, $newdir)){
														echo 'Edit successful. <a href="'.$log->baseurl.'user/index.php?pg=album">Go to album</a>';
													}else{
														echo 'Edit is not successful. Try later.<a href="'.$log->baseurl.'user/index.php?pg=album">Go to album</a>';
													}
												}else{
													echo 'Edit successful. <a href="'.$log->baseurl.'user/index.php?pg=album">Go to album</a>';
												}										
										}	
											
										}
																		
									}else{?>		
								<div class="formGuide">
									<ul>
										<li class="optional">Optional</li>
										<li class="mandatory">Mandatory</li>
										<li class="duplicate">Duplicate</li>
									</ul>
								</div>												
								<form action="" method="POST" name="albumAddForm" enctype="multipart/form-data" id="photocollectionform">
									<label>Collection Name</label><br />
									<input class="mandatory" type="text" name="albumname" value="<?php echo $album['album_name'];?>"><br />
									<label>Owner Email</label>&nbsp;<br />
									<table>
									<tr><td>Name</td><td>Email</td></tr>
									
									<?php foreach($owneremail as $email){?>
									<tr>
									<td>
									<input class="mandatory" type="text" style="width:170px;" name="ownername[]"  value="<?php echo $email['name'];?>">
									</td>
									<td>
									<input class="mandatory" type="text"  style="width:170px;" name="owneremail[]"  value="<?php echo $email['guest_id'];?>">
									<input type="hidden" name="owneremailid[]" value="<?php echo $email['id'];?>"><br />
									</td>
									</tr>
									<?php } ?>
									</table>
									<input type="hidden" name="isedit" value="1" id="isedit">							
									<label>Event Date</label>&nbsp;<small>(yyyy-mm-dd)</small><br />
									<input class="mandatory" type="text" name="Event_date" id="eventDate" value="<?php echo $album['event_date'];?>" readonly="readonly" onfocus="javascript:call_calendar('eventDate','eventDate'); if(this.value=='yyyy-mm-dd') this.value='';" onblur="if(this.value=='') this.value='yyyy-mm-dd';">&nbsp;&nbsp;<a id="f_trigger_b1" title="Calendar" href="javascript:call_calendar('eventDate','f_trigger_b1');" class="calIcon">&nbsp;</a><br />
									<label>Event Place</label><br />
									<input class="" type="text" name="Event_place" id="eventplace"  value="<?php echo $album['event_place'];?>"><br />
									<?php if($album['ispublic']==1){?>
									<input type="checkbox" name="ispublic" checked>Is Public?<br />
									<?php }else{?>
									<input type="checkbox" name="ispublic">Is Public?<br />
									<?php } ?>
									<?php 
											$albumNewName = $album['album_name'];
											$albumNewName = str_replace(' ','_',$albumNewName);
									?>
									<img style="max-width:676px;" src="<?php echo $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumNewName.'/mainphoto/'.$album['mainphoto'];?>">
									
									<br /><label>Change the image</label><br />
									<input class="mandatory" type="file" name="collectionmainphoto"><br />
									<label>Secure Code</label><br />
									<input type="hidden" name="collectionid" value="<?php echo $album['id'];?>">
									<input class="mandatory"  type="text" name="securecodee" id="securecodee" readonly value="<?php echo $album['securitycode'];?>"><br />
									<input type="button" Value="Submit" name="addAlbumBtn" id="addCollectionButton">
									<input type="button" Value="Cancel" onclick="javascript:back(-1);">
								</form>
								<?php } ?>
							</div>
						</div>
						</td>
					</tr>										
				</table>			
			
			</div>
		</div>
	</div>
</div>