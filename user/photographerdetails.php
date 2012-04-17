<?php
	if(isset($_POST['updateBtn']) && $_POST['updateBtn']){
		$uid=$_REQUEST['userId'];
		$status=$_REQUEST['status'];
		$data = array('status' => $status);
		$result = $shDB->update($data,$uid,'logon');
		if($result == true){
			echo '<script type="text/javascript">window.location.href="'.$log->baseurl.'user/index.php?pg=couplelist";</script>';
			//echo '<div class="messSuccess">You have updated CMS page Successfully.</div>';
		}
		else{
			echo '<div class="messError">Error in update Page addition.</div>';
		}
	}


	$uid=$_REQUEST['id'];
	$dataforProduct = array('id' => $uid);									
	$result= $shDB->selectOnMultipleCondition($dataforProduct,'logon');
	$userDetails=$result[0];
	?>
<div id="rightContent">
<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="coupleListIcon">&nbsp;</div></td><td>Details of <?php echo $userDetails['fname']?> &nbsp; <?php echo $userDetails['lname']?></td>
						</th>
					</table>
				</div>	
			</div>
			<div class="leftFloat div100">
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td width="40%"valign="top">
							<div style="padding: 20px 0px 0px 40px;">
							<?php if($userDetails['photo']){?>
								<img style="height:200px;width:180px;border:1px solid #ececec" src="<?php echo $log->baseurl;?>user/profile/<?php echo $userDetails['id'];?>/<?php echo $userDetails['photo'];?>" alt="<?php echo $userDetails['fname']?> &nbsp; <?php echo $userDetails['lname']?>"/> 
							<?php }else{?>
								<img style="height:200px;width:180px;border:1px solid #ececec" src="<?php echo $log->baseurl;?>images/nophoto.png"  alt="No Photo"/>
							<?php } ?>	
							</div>							
						</td>
						<td width="60%" valign="top" style="padding: 13px 0px 0px 0px;">
							<form action="" method="POST">
								<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
									<tr>
										<th width="30%">Name</th>
										<td width="70%"><?php echo $userDetails['fname']?> &nbsp; <?php echo $userDetails['lname']?></td>
									</tr>
									<tr>
										<th>Email</th>
										<td><?php echo $userDetails['useremail']?></td>
									</tr>
									<?php if($userDetails['company'] !=""){ ?>
									<tr>
										<th>Company Name</th>
										<td><?php echo $userDetails['company']?></td>
									</tr>
									<?php } ?>
									<tr>
										<th valign="top">Address </th>
										<td>
											<?php echo $userDetails['address']?> &nbsp; <?php (($userDetails['addresstwo'] !="") ? ', '.$userDetails['addresstwo'] : '')?><br />
											<?php echo $userDetails['city']?> - <?php echo $userDetails['city']?>, <?php echo $userDetails['country']?>
										</td>
									</tr>
									<tr>
										<th>Phone</th>
										<td><?php echo $userDetails['phone']?></td>
									</tr>
									<tr>
										<th>User Type</th>
										<td>
											<?php 
												if($userDetails['userlevel']==0){
													echo 'Admin';
												}else{
													echo 'Photographer';
												}
											?>
										</td>
									</tr>
									<tr>
										<th>Registration Date</th>
										<td><?php echo $userDetails['registration_date']?></td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									
									<tr>
										<th valign="top"> Status</th>
										<td >
											<input type="hidden" name="userId" value="<?php echo $userDetails['id'];?>">
											<input type="radio" name="status" value="1" <?php if($userDetails['status'] == 1){?> checked="checked" <?php } ?>> Active <br /> <input type="radio" name="status" value="0" <?php if($userDetails['status'] == 0){?> checked="checked" <?php } ?>> Inactive
										</td>
									</tr>
									<tr>
										<th valign="top"> &nbsp;</th>
										<td >
											<input type="submit" Value="Update" name="updateBtn" id="addCMSBtn">&nbsp;<a href="javascript: history.back(1);" style="text-decoration: none;"> <input type="button" Value="Back"> </a>
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
