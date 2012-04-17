<?php 
$referPage = $log->baseurl.'index.php?pg=mycart';
if($_SERVER['HTTP_REFERER']){
	$referPage = explode('?pg=',$referPage);
	if($referPage[1]!='mycart'){
			echo '<script>
			location.href='.$log->baseurl.';
		</script>';
	}
}
?>
<h1 class="pagetitle">Add photo to product</h1>
<div class="webcontent">
<table width="100%"> 
<tr>
<td>
<?php 
   if(isset($_REQUEST['photosecureemail'])){
   	
	   switch ($_REQUEST['loginas']){
	   	case 0:
	   		 $result = $log->login(trim($_REQUEST['photosecureemail']),trim($_REQUEST['scode']));
				  if($result==true){
				  	$result = $shDB->select('album');
				  	if($result){
						$selectAlbum = $result['records'];
						$selectAlbumPaging =  $result['pagination'];
				  	}
				  }
	   		break;
	   	case 2:
	  		 $result = $log->login(trim($_REQUEST['photosecureemail']),trim($_REQUEST['scode']));
				  if($result==true){
				  	$result = $shDB->select('album');
				  	if($result){
						$selectAlbum = $result['records'];
						$selectAlbumPaging =  $result['pagination'];
				  	}
				  }
	   		break;
	   	case 3:
	   		$selectAlbumByEmail = array(		
						'guest_id' => trim($_REQUEST['photosecureemail']),
						'isowner' => 1
						);
	   			$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
	   			
									if($selectAlbumByEmail){
										foreach($selectAlbumByEmail as $selAlbEml ){
											$selectAlbum = array(		
											'id' => $selAlbEml['album_id'],
											'securitycode' => $_REQUEST['scode']
											);									
											$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
										}
									}
										if($selectAlbum){
											$_SESSION['email'] = $_REQUEST['photosecureemail'];
											$_SESSION['scode'] = $_REQUEST['scode'];	
											$_SESSION['userlevel'] = $_REQUEST['loginas'];
										}
					
	   		break;
	   	default:
	   		$selectAlbumByEmail = array(		
						'guest_id' => trim($_REQUEST['photosecureemail']),
						'isowner' => 0
						);
					$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
	   				if($selectAlbumByEmail){
										foreach($selectAlbumByEmail as $selAlbEml ){
											$selectAlbum = array(		
											'id' => $selAlbEml['album_id'],
											'securitycode' => $_REQUEST['scode']
											);									
											$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
										}
									}
										if($selectAlbum){
											$_SESSION['email'] = $_REQUEST['photosecureemail'];
											$_SESSION['scode'] = $_REQUEST['scode'];	
											$_SESSION['userlevel'] = $_REQUEST['loginas'];
										}
	   		break;
	   }
   }elseif(isset($_SESSION['userid'])){
   		if($_SESSION['userlevel']==0){
   		
				  	$result = $shDB->select('album');
				  	if($result){
						$selectAlbum = $result['records'];
						$selectAlbumPaging =  $result['pagination'];
				  	}
				  
   		}else{
   		
				  
				  	$result = $shDB->select('album','album_create_by',$_SESSION['userid']);
				  	if($result){
						$selectAlbum = $result['records'];
						$selectAlbumPaging =  $result['pagination'];
				  	}
				  
   		}
   }else{
   		if($_SESSION['userlevel']==3){
   		$selectAlbumByEmail = array(		
						'guest_id' => trim($_SESSION['email']),
						'isowner' => 1
						);
					$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
	   				if($selectAlbumByEmail){
										foreach($selectAlbumByEmail as $selAlbEml ){
											$selectAlbum = array(		
											'id' => $selAlbEml['album_id'],
											'securitycode' => $_SESSION['scode']
											);									
											$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
										}
									}
   		}else{
   		$selectAlbumByEmail = array(		
						'guest_id' => trim($_SESSION['email']),
						'isowner' => 0
						);
					$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
	   				if($selectAlbumByEmail){
										foreach($selectAlbumByEmail as $selAlbEml ){
											$selectAlbum = array(		
											'id' => $selAlbEml['album_id'],
											'securitycode' => $_SESSION['scode']
											);									
											$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
										}
									}
   		}
   }
   
   	
   
		if($selectAlbum){ 
		$countALbum =  sizeof($selectAlbum);
			if($countALbum==1){
			echo '<script>location.href=base_url+"index.php?pg=photocollectiontoprod&id='.$selectAlbum[0]['id'].'&prodid='.$_REQUEST['prodid'].'";</script>';
			}
			?>
		
			<h1>You have following photo collection:</h1>
							<table cellpadding="5" cellspacing="0" style="table-layout:fixed; width:100%;">
							<tr>
								<td align="left" class="tableHeader" style="width:35%; padding-left:2%;">Collection Name</td>
								<td align="left" class="tableHeader" style="width:25%">Event Place</td>
								<td align="left" class="tableHeader" style="width:25%">Event Date</td>
								<td align="left" class="tableHeader" style="width:15%">Action</td>
							</tr>	
	
							<?php foreach($selectAlbum as $selAlbum){?>		
								<tr>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $selAlbum['album_name'];?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $selAlbum['event_place'];?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $log->timewebformat($selAlbum['event_date']);?></td>
								<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><a href="<?php echo $log->baseurl;?>index.php?pg=photocollectiontoprod&id=<?php echo $selAlbum['id'];?>&prodid=<?php echo $_REQUEST['prodid'];?>">Enter Collection</a></td>
							</tr>	
							<?php 		
							
		}
		?>
		</table>
		<?php 
		}	
		?>
	

				
		<?php if(!$selectAlbum){
			?>
		<div style="background:#E1EAEA; display:block;" class="leftFloat div100" id="addNewPhotoDiv">
		<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="secureaccessform" id="secureaccessform">
					<table cellspacing="0" cellpadding="5" style="padding-left:10px; padding-right:10px;">
							<tbody>
							<tr>
							<td>
							<p style="color:red;margin:0px;font-size:11px;">To ascociate an image to the product, Please login with your email and securecode. Sothat you can ascociate images to the product.</p>
							</td>
							</tr>
							<tr>
							<td>
							<label>Login as</label><br />
								<input type="radio" name="loginas" value="0">Admin &nbsp;
								<input type="radio" name="loginas" value="2">Photographer &nbsp;
								<input type="radio" name="loginas" value="3">Couple &nbsp;
								<input type="radio" name="loginas" value="4">Guest &nbsp;
								<br />
							</td>
							</tr>
						
						<tr>
							<td align="left">
							<strong>Email</strong><br />
							<input type="text" name="photosecureemail" style="width:150px;">
							</td>
							</tr>
							<tr>
							<td align="left">
							<strong>Secure Code</strong><br />
							<input type="password" name="scode" style="width:150px;">
							</td>
							</tr>
							<tr>
							<td align="left" rowspan="2" valign="bottom">
							<input type="submit" name="securelogin" value="Submit">
							</td>							
						</tr>
						<tr><td colspan="3"></td></tr>
					</tbody></table>
			</form>
			</div>
			<?php } ?>	
			</td>
			</tr>
			</table>
			</div>