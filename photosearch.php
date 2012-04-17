<h1 class="pagetitle">Photo Search</h1>
<div class="webcontent">
<div style="background:#E1EAEA; display:block;" class="leftFloat div100" id="addNewPhotoDiv">
		<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="secureaccessform" id="secureaccessform">
					<table cellspacing="0" cellpadding="5" style="padding-left:10px; padding-right:10px;">
						<tbody><tr>
							<td align="left">
							<strong>Search Photo Collection</strong>
							</td>
							
							<td align="left" rowspan="2" valign="bottom">
							<input type="submit" name="securelogin" value="Submit">
							</td>							
						</tr>
						<tr>
						<td><input type="text" name="q"></td>
						
						</tr>
						<tr><td colspan="2"></td></tr>
					</tbody></table>
			</form>
			</div>
		<?php 
		if($_REQUEST['q']!=''){
		$searchString = $_REQUEST['q'];
		$data = array(		
							'album_name' => $searchString,
							'event_place' => $searchString
							);
							
						//	searchOnMultipleCondition($data = '','album');
						$selectAlbumByEmail = $shDB->searchOnMultipleCondition($data,'album');
					//	var_dump($selectAlbumByEmail);
			//$selectAlbumByEmail = false;
		
		if($selectAlbumByEmail){ ?>
		<h1>Search result for: <?php echo $searchString;?></h1>
							<table cellpadding="5" cellspacing="0" style="table-layout:fixed; width:100%;">
							<tr>
								<td align="left" class="tableHeader" style="width:35%; padding-left:2%;">Collection Name</td>
								<td align="left" class="tableHeader" style="width:25%">Event Place</td>
								<td align="left" class="tableHeader" style="width:25%">Event Date</td>
								<td align="left" class="tableHeader" style="width:15%">Action</td>
							</tr>	
		<?php 			foreach($selectAlbumByEmail as $albByEmail){
									$selectAlbum = array(		
									'id' => $albByEmail['album_id']
									);
																		
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									?>
								<tr>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $albByEmail['album_name'];?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $albByEmail['event_place'];?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $albByEmail['event_date'];?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><a href="<?php echo $log->baseurl;?>index.php?pg=photocollection&id=<?php echo $albByEmail['id'];?>">Enter Collection</a></td>
							</tr>	
							<?php 	
							}
		?>
		</table>
		<?php 
		}
		}
		?>
	
</div>