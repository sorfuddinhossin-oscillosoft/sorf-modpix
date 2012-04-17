<?php 
//$result = $shDB->select('album','album_create_by',$_SESSION['userid']);
$aclass='';
$dclass='';
if(isset($_REQUEST['status'])){
	if($_REQUEST['status'] === 'active'){
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
$result = $shDB->select('`album`','album_status',$status);
$myalbum = $result['records'];
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="leftFloat"><a title="Add New" href="<?php echo $log->baseurl;?>user/index.php?pg=addalbum" class="addNew">Add New</a></div>
	</div>
	<div class="rightContentDiv">
		<div class="leftFloat div100">
			<li class="orderMenu">&nbsp;&nbsp;</li>
			<li class="orderMenu"><a title="On Process Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=album&status=archived" <?php echo $dclass;?>>Archived</a></li>
			<li class="orderMenu"><a title="Delivered Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=album&status=active" <?php echo $aclass;?>>Active</a></li>
		</div>
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="albumListIcon">&nbsp;</div></td><td>Album</td>
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
			<?php if($myalbum){?>
				<table cellpadding="5" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:35%; padding-left:2%;">Album Name</td>
						<td align="left" class="tableHeader" style="width:31%">Album Owner</td>
						<td align="left" class="tableHeader" style="width:19%">&nbsp;</td>
						<td align="left" class="tableHeader" style="width:12%">Action</td>
					</tr>					
					<?php
					foreach($myalbum as $album)
					{
							
							$albumOwner = array(		
							'album_id' => $album['id'],
							'isowner' => 1
							);
							
							$albumOwner = $shDB->selectOnMultipleCondition($albumOwner,'`album_guest`');
						
					?>
					<tr>
						<td align="left" style="width:35%; padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><a title="Click to add photo to this album" href="<?php echo $log->baseurl;?>user/index.php?pg=addphototoalbum&id=<?php echo $album['id'];?>" class="albumNameStyle"><?php echo $album['album_name'];?></a></td>
						<td align="left" style="width:33%; border-bottom:dotted #CCCCCC 1px;">
						<?php
						if($albumOwner){ 
							for($i=0;$i<sizeof($albumOwner);$i++){
								echo $albumOwner[$i]['guest_id'];
								if($i<(sizeof($albumOwner)-1)){echo ', ';}
							}
						} 
						 ?>
						
						</td>
						<td align="left" style="width:19%; border-bottom:dotted #CCCCCC 1px;">
						<?php 
						//echo $log->timewebformat($album['event_date']);
						 if($album['ispublic']==1)echo '<a class="public">Public</a>';
						?></td>
						<td align="left" style="width:12%; border-bottom:dotted #CCCCCC 1px;">
						<a title="Record Details" href="<?php echo $log->baseurl;?>user/index.php?pg=addphototoalbum&id=<?php echo $album['id'];?>" class="detailsRowBtn">&nbsp;</a>&nbsp;
						<a class="albumInvitationBtn" href="<?php echo $log->baseurl.'user/index.php?pg=albuminvitation&id='.$album['id'];?>" title="Album Invitation">&nbsp;</a>&nbsp;
					<a title="Edit Records" href="<?php echo $log->baseurl;?>user/index.php?pg=editalbum&id=<?php echo $album['id'];?>" class="editRowBtn">&nbsp;</a>&nbsp;
						</td>
					</tr>
					<?php
					}
					?>	
					<tr>
						<td align="center" colspan="4">
							<?php echo $result['pagination'];?>
						</td>
					</tr>											
				</table>
			</div>
			<?php }else{?>
			<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:90%; padding-left:2%;">
					<p class="greenMessage" style="color:red">No album available.</p>
					</td>
					</tr>
					</table>
			<?php }?>
		</div>
	</div>
</div>
