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
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Add a New Collection</td>
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
						<h1>Add a New Collection</h1>
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
											'id' => '',
											'album_name' => $_REQUEST['albumname'],
											'event_date' => $_REQUEST['Event_date'],
											'event_place' => $_REQUEST['Event_place'],
											'album_create_by' => $_SESSION['userid'],
											'securitycode' => $_REQUEST['securecode'],
											'ispublic' => $ispublic,									
											'create_time' => $log->timetodb()									
											);
											
										$result = $shDB->insert($dataforalbum,'album');
										if($result){
												
										
												for($i=0;$i<sizeof($email);$i++){
													$dataforinsert = array(
													'id' => '',
													'album_id' => $result,									
													'guest_id' => $email[$i],
													'name' => $name[$i],
													'isowner' => 1						
													);
													$resulttoguest = $shDB->insert($dataforinsert,'album_guest');										
											}
											/*
											foreach($email as $eml){
													$dataforinsert = array(
													'id' => '',
													'album_id' => $result,									
													'guest_id' => $eml,
													'isowner' => 1						
													);
													$resulttoguest = $shDB->insert($dataforinsert,'album_guest');										
											}
											*/
										if($result!=false){
											$dir = str_replace(chr(92),chr(47),getcwd());
											$albumName = $_REQUEST['albumname'];
											$albumName = str_replace(' ','_',$albumName);
											//$imageProcessor->readDirectory($dir);
											$mkdir = $dir.'/profile/'.$_SESSION['userid'].'/'.$result.'_'.$albumName;	
											$dircreated = $imageProcessor->makeDirectory($mkdir);
											if($dircreated==true){
												$mkdirThumbs = $dir.'/profile/'.$_SESSION['userid'].'/'.$result.'_'.$albumName.'/thumbs';
												$dircreatedthumbs = $imageProcessor->makeDirectory($mkdirThumbs);	
												if($dircreatedthumbs==true){
													$mkdirmainPhoto = $dir.'/profile/'.$_SESSION['userid'].'/'.$result.'_'.$albumName.'/mainphoto';
													$dircreatedmain = $imageProcessor->makeDirectory($mkdirmainPhoto);	
													if($dircreatedmain==true){
													if(isset($_FILES)){	
																						
														$isUpload = $imageProcessor->uploadMainPhototoAlbum($_SESSION['userid'],$albumName,'collectionmainphoto',$result);
														
														if($isUpload){
															echo '<div class="messSuccess">Album created successfully.</div>';
														}else{
															echo '<div class="messError">Error in album creation process.</div>';
														}														
														}else{
															echo 'No iamge provided';
														}														
													}
												}else{
													echo '<div class="messError">Error in album creation process.</div>';
												}
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
								<form action="" method="POST" enctype="multipart/form-data"  name="albumAddForm" id="photocollectionform">
									<label>Collection Name</label><br />
									<input class="mandatory" type="text" name="albumname"><br />
									<label>Owner Details</label>&nbsp;<br />
									<table id="ownerdetails">
									<tr><td>Name</td><td>Email</td><td rowspan="2" valign="bottom"><input type="button" id="addMoreEmail" value="Add More" style="margin-left:10px;"></td></tr>
									<tr><td><input class="mandatory" style="width:170px;" type="text" name="ownername[]"></td><td><input style="width:170px;" class="mandatory" type="text" name="owneremail[]"></td><td></td></tr>
									</table>
									
																		
									<label>Event Date</label>&nbsp;<small>(yyyy-mm-dd)</small><br />
									<input class="mandatory" type="text" name="Event_date" id="eventDate" value="" readonly="readonly" onfocus="javascript:call_calendar('eventDate','eventDate'); if(this.value=='yyyy-mm-dd') this.value='';" onblur="if(this.value=='') this.value='yyyy-mm-dd';">&nbsp;&nbsp;<a id="f_trigger_b1" title="Calendar" href="javascript:call_calendar('eventDate','f_trigger_b1');" class="calIcon">&nbsp;</a><br />
									<label>Event Place</label><br />
									<input class="" type="text" name="Event_place" id="eventplace" value="" ><br />
									<input type="checkbox" name="ispublic">Is Public?<br />
									<br /><label>Upload an Image</label><br />
									<input class="mandatory" type="file" name="collectionmainphoto"><br />
									<label>Secure Code</label><br />
									<input class="mandatory"  type="text" name="securecode" id="securecode" value="" >&nbsp;<a href="javascript:void(0)" id="genCode">Check availibility</a><br />
									<input type="button" Value="Submit" name="addAlbumBtn" id="addCollectionButton">
									<input type="reset" Value="Reset">
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