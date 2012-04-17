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
$conditionData = array(
						'id' => $_REQUEST['id'],
						'album_create_by' => $_SESSION['userid']
							);
	$album = $shDB->selectOnMultipleCondition($conditionData,'album');
	$album = $album[0];
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="dashboardIcon">&nbsp;</div></td><td>Album Invitaion</td>
						</th>
					</table>
				</div>		
			</div>
			<div class="leftFloat div100">
					
<div id="features" class="tabDiv">
					 
						<table style="width:100%;" cellpadding="10" cellspacing="0">
					<tr>
						<td style="width:65%" valign="top">
						<?php 
						
						
						echo $msgInviation; 
						?>
						<form action="<?php echo $log->base_url;?>index.php?pg=albuminvitation&id=<?php echo $_REQUEST['id'];?>" method="post" id="guestInvitationForm">
						
						
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
									
											<input onfocus="if ( this.value == this.defaultValue ) this.value = ''" onblur="if ( this.value == '' ) this.value = this.defaultValue"  style="width:167px;" type="text"  rel="photographer" id="addMulEmailBox" class="guestEmailTextBox" value="Enter a valid email">
											<div class="guestEmailTextBoxButton"  id="btnAddMultipleEmail" onclick="addTempGuest(<?php echo $_REQUEST['id'];?>);">Add</div>
											
								</div>
							</div>
								<ul class="gueststatus" style="height:29px;padding-top:20px;">
								<li class="selected"><a href="#owner">Owner</a></li>
								<li><a href="#pending">Not confirmed</a></li>
								<li><a href="#guestFromExistingList">Confirmed</a></li>
								</ul>
								<input type="hidden" id="collectionid" value="<?php echo $_REQUEST['id']?>">
							<div id="owner" style="width:220px;">
							<strong>Owner's Profile</strong>
							<p style="background:#FBFCFC;border:1px solid #D1DDDE;margin:0px;padding:5px;line-height:0.8em;color:black">
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
							<a class="checkall" id="checkallpending">Check All</a><a class="checkall" id="sendnotifyemail" rel="photographer">Send Notification Email</a>
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
							<a class="checkall" id="checkallconfirmed">Check All</a><a class="checkall" rel="photographer" id="notifyagain">Notify Again</a>
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
								<script type="text/javascript"> 
							 
							  $(".gueststatus").idTabs("<?php echo $subtab;?>"); 
							</script>
								
								<br />
								
																		
							</div>
					
						
							</form>					
						</td>					</tr>
				</table>
								  
								</div> 
								
			</div>
		</div>
	</div>
</div>