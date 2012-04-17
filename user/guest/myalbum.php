<div id="rightContent">
<?php 	
/*
	 $selectOrderDatainTemp = array(		
							'`album_owner_id`' => $_SESSION['userid'],
							 '`album_create_by`' => $_SESSION['userid']	 			
							);									
			$result = $shDB->selectOnMultipleOrCondition($selectOrderDatainTemp,'album');
	
	//$result = $shDB->select('album','album_owner_id',$_SESSION['userid']);
	//$myalbum = $result['records'];
	$myalbum = $result;
	*/
	$result = $shDB->selectalbum('album','album_create_by',$_SESSION['userid']);
//$result = $shDB->selectalbum('album');
	$myalbum = $result['records'];
	?>
	<div class="rightContentDiv">
		<div class="leftFloat"><a title="Add New" href="<?php echo $log->baseurl;?>user/index.php?pg=addalbum" class="addNew">Add New</a></div>
		
	</div>
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellspacing="0" cellpadding="3">
						<tbody><tr><th>
							</th><td><div class="albumListIcon">&nbsp;</div></td><td>My Collection</td>
						
					</tr></tbody></table>
				</div>	
			</div>
			<div class="leftFloat div100">
				<?php if($myalbum){?>
				<table cellspacing="0" cellpadding="5" style="table-layout:fixed; width:100%;">
					<tbody><tr>
						<td align="left" style="width:40%; padding-left:2%;" class="tableHeader">Album Name</td>
						<td align="left" style="width:15%; padding-left:2%;" class="tableHeader">&nbsp;</td>
						
						<td align="left" style="width:25%" class="tableHeader">Event Date</td>
						<td align="left" style="width:20%" class="tableHeader">Action</td>
					</tr>					
				<?php foreach($myalbum as $album) {?>	
				
				<tr>
						<td align="left" style="padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><a title="Click to add photo to this album" href="<?php echo $log->baseurl;?>user/index.php?pg=albumview&id=<?php echo $album['id'];?>" class="albumNameStyle"><?php echo $album['album_name'];?></a></td>
						<td align="left" style="padding-left:2%; border-bottom:dotted #CCCCCC 1px;">
							<?php if($album['ispublic']==1)echo '<a class="public">Public</a>';?>
					</td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $log->timewebformat($album['event_date']);?></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;">
						<a title="Click to view album details." class="detailsRowBtn" href="<?php echo $log->baseurl.'user/index.php?pg=albumview&id='.$album['id'];?>" title="Record Details">&nbsp;</a>&nbsp;
						<a title="Edit Records" href="<?php echo $log->baseurl;?>user/index.php?pg=editalbum&id=<?php echo $album['id'];?>" class="editRowBtn">&nbsp;</a>&nbsp;
						<a class="albumInvitationBtn" href="<?php echo $log->baseurl.'user/index.php?pg=albuminvitation&id='.$album['id'];?>" title="Album Invitation">&nbsp;</a>&nbsp;
						</td>
					</tr>
					<?php } ?>
					<tr> <td colspan="3" align="center">
					<?php 
					echo $result['pagination'];
					?>
					</td></tr>	
															
				</tbody></table>
				<?php }else{ ?>
					<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:90%; padding-left:2%;">
					<p class="greenMessage" style="color:red">No album available.</p>
					</td>
					</tr>
					</table>
				<?php } ?>
			</div>
		
		</div>
	</div>
	
	
	
	
	
</div>
	