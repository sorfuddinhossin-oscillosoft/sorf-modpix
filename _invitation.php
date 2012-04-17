<h1 class="pagetitle">Collection View</h1>
<div class="webcontent">
		<?php 
			
		
		if($selectAlbumByEmail){ ?>
		<h1>You have following photo collection:</h1>
							<table cellpadding="5" cellspacing="0" style="table-layout:fixed; width:100%;">
							<tr>
								<td align="left" class="tableHeader" style="width:35%; padding-left:2%;">Collection Name</td>
								<td align="left" class="tableHeader" style="width:25%">Event Place</td>
								<td align="left" class="tableHeader" style="width:25%">Event Date</td>
								<td align="left" class="tableHeader" style="width:15%">Action</td>
							</tr>	
		<?php 			foreach($selectAlbumByEmail as $albByEmail){
									$selectAlbum = array(		
									'id' => $albByEmail['album_id'],
									'securitycode'  => $_SESSION['scode']
									);
																		
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									
									$collection = $selectAlbum[0];
									if($collection){
									?>
								<tr>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $collection['album_name'];?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $collection['event_place'];?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $log->timewebformat($collection['event_date']);?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><a href="<?php echo $log->baseurl;?>index.php?pg=photocollection&id=<?php echo $collection['id'];?>">Enter Collection</a></td>
							</tr>	
							<?php 		
							}
		}
		?>
		</table>
		<?php 
		}

			if(!$selectAlbum){
			?>
		<div style="background:#E1EAEA; display:block;" class="leftFloat div100" id="addNewPhotoDiv">
		<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="secureaccessform" id="secureaccessform">
					<table cellspacing="0" cellpadding="5" style="padding-left:10px; padding-right:10px;">
						<tbody><tr>
							<td align="left"><strong>Login as</strong></td>
							<td align="left">
							<strong>Email</strong>
							</td>
							<td align="left">
							<strong>Secure Code</strong>
							</td>
							<td align="left" rowspan="2" valign="bottom">
							<input type="submit" name="securelogin" value="Submit">
							</td>							
						</tr>
						<tr>
						<td>
						
								<input type="radio" name="loginas" value="3">Couple &nbsp;
								<input type="radio" name="loginas" value="4">Guest &nbsp;
								
							
						</td>
						<td><input type="text" name="secureemail" style="width:150px;"></td>
						<td><input type="text" name="scode" style="width:150px;"></td>
						</tr>
						<tr><td colspan="3"></td></tr>
					</tbody></table>
			</form>
			</div>
			<?php } ?>		
</div>