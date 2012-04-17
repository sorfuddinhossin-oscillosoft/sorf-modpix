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
						'id' => $_REQUEST['id']
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
							<td><div class="dashboardIcon">&nbsp;</div></td><td>Dashboard</td>
						</th>
					</table>
				</div>		
			</div>
			<div class="leftFloat div100">
			<table style="width:100%;" cellpadding="10" cellspacing="0">
					<tr>
						<td style="width:65%" valign="top">
						<?php 
						
						
						echo $msgInviation; 
						?>
						<form action="<?php echo $log->base_url;?>user/index.php?pg=albuminvitation&id=<?php echo $_REQUEST['id'];?>" method="post" id="guestInvitationForm">
						
						
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
									
											<input style="width:167px;" onfocus="if ( this.value == this.defaultValue ) this.value = ''" onblur="if ( this.value == '' ) this.value = this.defaultValue"  style="width:214px;" type="text"  id="addMulEmailBox" class="guestEmailTextBox" value="Enter a valid email">
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
										
											
										<input type="checkbox" value="<?php echo $gst['id']?>" name="userid[]">
									
										
										</div>
										&nbsp;<?php echo $gst['guest_id']; ?>
										</span>
										
										<span class="rightFloat">
										
										<a class="del" rel="<?php echo $gst['id']?>">x</a>
										<!-- 
										<a id="addGuestIdAnchor<?php echo $gst['id']?>" title="Add to album guest" href="javascript:" onclick="addTempGuestId(<?php echo $gst['id']?>,<?php echo $_REQUEST['id'];?>,<?php echo $gst['id']; ?>);" class="tickRowBtn">&nbsp;</a>
										 -->
										</span>
										
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
		</div>
	</div>
</div>