<?php 
$selectCondition = array(		
							'userid' => $_SESSION['userid'],
						    'friendid' => $_SESSION['userid']
							);									
$totalGuest = $shDB->totalCountOrCondition($selectCondition,'`guest`');

$selectCondition = array(		
							'album_create_by' => $_SESSION['userid']						    
							);									
$totalAlbum = $shDB->totalCount($selectCondition,'`album`');

$selectCondition = array(		
							'useremail' => $_SESSION['email']						    
							);									
$totalOrder = $shDB->totalCount($selectCondition,'`order`');



$selectNotice = array(		
							'id' => 1
							);									
$notice = $shDB->selectOnMultipleCondition($selectNotice,'`notice`');
$notice = $notice[0];
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
						<!-- 
							<div class="leftFloat div100" style="padding-bottom:10px;">
								<div class="leftFloat dashboardStatisticsLeft" style="width:65%">Total Guest -</div>
								<div align="center" class="leftFloat dashboardStatisticsRight" style="width:28%"><?php echo $totalGuest;?></div>
							</div>
							
							<div class="leftFloat div100" style="padding-bottom:10px;">
								<div class="leftFloat dashboardStatisticsLeft" style="width:65%">My Order -</div>
								<div align="center" class="leftFloat dashboardStatisticsRight" style="width:28%"><?php echo $totalOrder;?></div>
							</div>	
							-->
							<div class="leftFloat div100" style="padding-bottom:10px;">
								<div class="leftFloat dashboardStatisticsLeft" style="width:65%">Total Collection -</div>
								<div align="center" class="leftFloat dashboardStatisticsRight" style="width:28%"><?php echo $totalAlbum;?></div>
							</div>						
							<div class="leftFloat div100"><strong>Notice Board</strong> (<?php echo $notice['date'];?>)</div>
							<span style="display:none;color:green" id="postNotification"></span>
							<div class="leftFloat div100">
								<div style="padding:10px;padding-top:0px"><?php echo $notice['details'];?></div>
							</div>
							
							
						</td>
						<td style="width:200px;overflow:hidden; background:#EAF0F0" valign="top">						
							
							<div id="personalInformationViewDiv" class="leftFloat div100">
								<div class="leftFloat div100 botBorder1"><strong id="pInfoTitle">Personal Information</strong>
								<span class="rightFloat">
									<a class="edit" id="addressEdit" href="javascript:void(0)" onclick="editPersonelInfo('edit');" title="Edit">Edit</a>
									<a class="edit" id="addressSave" style="display:none" href="javascript:void(0)" onclick="editPersonelInfo('save');" title="Save">Save</a>
									<a class="cancel" id="addressEditCancel" style="display:none" href="javascript:void(0)" onclick="editPersonelInfo('cancel');" title="Cancel">&#967;</a>
									
								</span>
								</div>
								<div align="center" class="leftFloat div100" id="personelInfo">
									<table style="width:80%" cellpadding="0" cellspacing="0">
										<tr><td>&nbsp;</td></tr>
										<tr>
										<td>
											<?php if($userdetails['photo']==''){ ?>
											<img src="<?php echo $log->baseurl?>images/nophoto.png" class="photoThumb" />
											<?php }else{?>
											<img src="<?php echo $log->baseurl.'user/profile/'.$_SESSION['userid'].'/'.$userdetails['photo'];?>" class="photoThumb" />
											<?php } ?>
											</td>	
										</tr>						
										<tr>
											<td><strong><?php echo $userdetails['fname'].' '.$userdetails['lname'];?></strong></td>
										</tr>
										<tr>
											<td><?php echo $userdetails['address'];?><br />
											<?php
											if($userdetails['addresstwo']){ 
											echo $userdetails['addresstwo'].',';
											}
											
											if($userdetails['zip']){ 
											echo 'Zip -'.$userdetails['zip'].',<br />';
											}
											if($userdetails['city']){ 
											echo $userdetails['city'].' - ';
											}
											echo $userdetails['country']
											?>
											</td>
										</tr>
										<tr>
											<td><strong>Phone : <?php echo $userdetails['phone']?></strong></td>
										</tr>
										<tr>
											<td><strong>Email :</strong> <a href="mailto:<?php echo $userdetails['useremail']?>"><?php echo $userdetails['useremail']?></a></td>
										</tr>																																													
									</table>
								</div>
								<div align="center" class="leftFloat div100" id="personalInformationEditDiv" style="display:none">
									<table style="width:80%" cellpadding="0" cellspacing="0">
										<tr><td>&nbsp;</td></tr>
										<tr>
											<td>
											<?php if($userdetails['photo']==''){ ?>
											<img src="<?php echo $log->baseurl?>images/nophoto.png" class="photoThumb" />
											<?php }else{?>
											<img src="<?php echo $log->baseurl.'user/profile/'.$_SESSION['userid'].'/'.$userdetails['photo'];?>" class="photoThumb" />
											<?php } ?>
											</td>
										</tr>								
										<tr>
											<td>
												<!-- ####################################### -->
											<form id="editPersonelInfoForm" action="<?php echo $log->baseurl; ?>user/editpersonelinfo.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
						                    <p id="f1_upload_form" align="left"><br/>
						                   		<span>Change Photo</span><br>
						                        <input name="mypic" type="file" size="14" style="width:120px" /><br />
												<span>First Name</span><br>
												<input type="text" name="fname" class="mandatory" value="<?php echo $userdetails['fname'];?>"><br>
												<span>Last Name</span><br>
												<input type="text" name="lname" value="<?php echo $userdetails['lname'];?>"><br>
												<span>Address</span><br>
												<input type="text" name="address" class="mandatory"  value="<?php echo $userdetails['address'];?>"><br>
												<span>Address Line Two</span><br>
												<input type="text" name="addresstwo"  value="<?php echo $userdetails['addresstwo'];?>"><br>
												<span>Phone</span><br>
												<input type="text" name="phone" value="<?php echo $userdetails['phone'];?>"><br>
												<span>Zip Code</span><br>
												<input type="text" name="zip" value="<?php echo $userdetails['zip'];?>"><br>
												<span>City</span><br>
												<input type="text" name="city" value="<?php echo $userdetails['city'];?>"><br>
												<span>Country</span><br>
												<input type="text" name="country" value="<?php echo $userdetails['country'];?>"><br>
						                     </p>
						                     
						                     <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
						                 </form>																				
											</td>
										</tr>																																													
									</table>
								</div>

							</div>
							
											
														
							<div class="leftFloat div100">&nbsp;</div>
							<div class="leftFloat div100 botBorder1"><strong id="passTitle">Change Password</strong>
								<span class="rightFloat">
									<a class="edit" id="passEdit" href="javascript:void(0)" onclick="editPassword('change');" title="Change">Change</a>
									<a class="edit" id="passSave" style="display:none" href="javascript:void(0)" onclick="editPassword('save');" title="Save">Save</a>
									<a class="cancel" id="passEditCancel" style="display:none" href="javascript:void(0)" onclick="editPassword('cancel');" title="Cancel">&#967;</a>
								</span>
								</div>
							<div id="changePasswordFrmDiv" class="leftFloat div100 changePassBox" style="display:none;">
								<form id="editPasswordForm" action="<?php echo $log->baseurl; ?>user/changepassword.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="changePass();" >
								<p id = "ChangeSuccess"></p>
								<p id="f1_changepassword_form" align="left">
									<span>Old Password</span><br />
									<input type="password" name="old_password" id="old_password" style="width:190px;" /><br />
									<span>New  Password</span><br />
									<input type="password" name="new_password" id="old_password" style="width:190px;" /><br />
									<span>Confirm Password</span><br />
									<input type="password" name="confirm_password" id="old_password" style="width:190px;" /><br />
								</p>
								 <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
								</form>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
