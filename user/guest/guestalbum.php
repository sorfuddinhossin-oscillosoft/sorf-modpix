<?php 

//$guestAlbum = $shDB->select('album_guest','guest_id',$_SESSION['userid']);
$qry = "SELECT * FROM album WHERE  id in (SELECT album_id FROM album_guest WHERE guest_id = '".$_SESSION['userid']."')";

//$qry = "SELECT (SELECT album_id FROM album_guest WHERE guest_id = '".$_SESSION['userid']."') UNION (SELECT id FROM album WHERE album_create_by = '".$_SESSION['userid']."')";
/*
$qry ="(SELECT album_id FROM album_guest WHERE guest_id = '".$_SESSION['userid']."')
UNION
(SELECT id FROM album WHERE album_create_by = '".$_SESSION['userid']."')";

 
 */


$allResult = $shDB->qry($qry);
while($row = mysql_fetch_array($allResult)) {
			$result[] = $row;
		}
if($result){
		$allResult = $shDB->withPagination($qry);
}
$myalbum = $allResult['records'];
?>
<div id="rightContent">
	
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="albumListIcon">&nbsp;</div></td><td>Guest Album</td>
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
						<td align="left" class="tableHeader" style="width:19%">Event Date</td>
						<td align="left" class="tableHeader" style="width:12%">Action</td>
					</tr>					
					<?php
					foreach($myalbum as $album)
					{
						$user = $shDB->select('logon','id',$album['album_owner_id']);
						$username = $user['records'][0]['fname'].' '.$user['records'][0]['lname'];
					?>
					<tr>
						<td align="left" style="width:35%; padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><a title="Click to add photo to this album" href="<?php echo $log->baseurl;?>user/index.php?pg=albumview&id=<?php echo $album['id'];?>" class="albumNameStyle"><?php echo $album['album_name'];?></a></td>
						<td align="left" style="width:33%; border-bottom:dotted #CCCCCC 1px;"><a href="#"><?php echo $username;?></a></td>
						<td align="left" style="width:19%; border-bottom:dotted #CCCCCC 1px;"><?php echo $log->timewebformat($album['event_date']);?></td>
						<td align="left" style="width:12%; border-bottom:dotted #CCCCCC 1px;">
						<a title="Click to view album details." class="detailsRowBtn" href="<?php echo $log->baseurl.'user/index.php?pg=albumview&id='.$album['id'];?>" title="Record Details">&nbsp;</a>&nbsp;
						</td>
					</tr>
					<?php
					}
					?>	
					<tr>
						<td align="center" colspan="4">
							<?php echo $myalbum['pagination'];?>
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
