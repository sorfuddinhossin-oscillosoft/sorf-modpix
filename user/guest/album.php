<?php 
$result = $shDB->select('album','album_create_by',$_SESSION['userid']);
$myalbum = $result['records'];
?>
asdf
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="leftFloat"><a title="Add New" href="<?php echo $log->baseurl;?>user/index.php?pg=addalbum" class="addNew">Add New</a></div>
		<div class="rightFloat"><a title="Search" href="#" class="searchBtn">Search</a></div>
		<div class="rightFloat"><input type="text" name="search_key" id="search_key" class="searchTextbox" value="Find album............" style="width:205px;" onfocus="if(this.value=='Find album............') this.value='';" onblur="if(this.value=='') this.value='Find album............';" />&nbsp;&nbsp;</div>
	</div>
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="albumListIcon">&nbsp;</div></td><td>Album</td>
						</th>
					</table>
				</div>
				</div>
			<div class="leftFloat div100">
			<?php if($album){?>
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
						<td align="left" style="width:35%; padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><a title="Click to add photo to this album" href="<?php echo $log->baseurl;?>user/index.php?pg=addphototoalbum&id=<?php echo $album['id'];?>" class="albumNameStyle"><?php echo $album['album_name'];?></a></td>
						<td align="left" style="width:33%; border-bottom:dotted #CCCCCC 1px;"><a href="#"><?php echo $username;?></a></td>
						<td align="left" style="width:19%; border-bottom:dotted #CCCCCC 1px;"><?php echo $log->timewebformat($album['event_date']);?></td>
						<td align="left" style="width:12%; border-bottom:dotted #CCCCCC 1px;">
						<a title="Record Details" href="<?php echo $log->baseurl;?>user/index.php?pg=addphototoalbum&id=<?php echo $album['id'];?>" class="detailsRowBtn">&nbsp;</a>&nbsp;
<!--						<a title="Edit Records" href="#" class="editRowBtn">&nbsp;</a>&nbsp;-->
						<a title="Delete Records" href="#" class="deleteRowBtn">&nbsp;</a>
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
