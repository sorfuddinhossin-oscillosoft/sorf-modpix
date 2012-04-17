<?php
	$aclass='';
	$dclass='';
	if(isset($_REQUEST['status'])){
		if($_REQUEST['status'] === 'activate'){
			$status = 1;
			$dclass='class="active"';
		}else{
			$status = '0';
			$aclass='class="active"';
		}
	}else{
		$status = 1;
		$dclass='class="active"';
	}
	$result = $shDB->select('`logon`','status',$status);
	$user = $result['records'];
	
	
	?>
<div id="rightContent">
<div class="rightContentDiv">
		<div class="leftFloat div100">
			<li class="orderMenu">&nbsp;&nbsp;</li>
			<li class="orderMenu"><a title="On Process Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=couplelist&status=disactivate" <?php echo $dclass;?>>Inactive</a></li>
			<li class="orderMenu"><a title="Delivered Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=couplelist&status=activate" <?php echo $aclass;?>>Active</a></li>
		</div>
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="coupleListIcon">&nbsp;</div></td><td>User List</td>
						</th>
					</table>
				</div>
				<!--
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="#" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>	
				-->			
			</div>
			<div class="leftFloat div100">
		
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<?php if($user){ ?>
						<tr>
							<td align="left" class="tableHeader" style="width:22%; padding-left:2%;">Name</td>
							<td align="left" class="tableHeader" style="width:25%">Email</td>
							<td align="left" class="tableHeader" style="width:35%">Address</td>
							<td align="left" class="tableHeader" style="width:15%">User Type</td>
							
						</tr>					
						<?php
						foreach($user as $usr)
						{
						?>
						<tr style="height:40px;">
							<td align="left" style="width:19%; padding-left:2%; border-bottom:dotted #CCCCCC 1px;">
								<!--<span class="hint" rel="<?php echo $usr['id']?>,left,userdetailsbyid.php"><a href="javascript:void(0)"><?php echo $usr['fname'].' '.$usr['lname'];?></a></span>-->
								<a href="<?php echo $log->baseurl;?>user/index.php?pg=photographerdetails&id=<?php echo $usr['id'];?>"><?php echo $usr['fname'].' '.$usr['lname'];?></a>
							</td>
							<td align="left" style="width:33%; border-bottom:dotted #CCCCCC 1px;"><?php echo $usr['useremail'];?></td>
							<td align="left" style="width:35%; border-bottom:dotted #CCCCCC 1px;"><?php echo $usr['address'];?><br /><?php echo $usr['city'];?> - <?php echo $usr['zip'];?>, <?php echo $usr['country'];?></td>
							<td style="width:35%; border-bottom:dotted #CCCCCC 1px;" align="left">
							<?php 
								if($usr['userlevel']==0){
									echo 'Admin';
								}else{
									echo 'Photographer';
								}
							?>
							</td>
							
						</tr>
						<?php
						}
						?>	
						<tr>
							<td align="center" colspan="4">
								<?php echo $userList['pagitation'];?>
							</td>
						</tr>	
					<?php }else{?>
						<tr>
							<th align="center" colspan="4" style="text-align: center;padding: 20px 0px;">
								No records match with your search criteria!
							</th>
						</tr>
					<?php }?>
				</table>
			</div>
		</div>
	</div>
</div>
