<?php
if(isset($_SESSION['userid'])){
	if($_SESSION['userlevel']==0){
	$selectAlbum = array(		
									'id' => $_REQUEST['id']
									);
	}else{
		$selectAlbum = array(		
									'id' => $_REQUEST['id'],
									'album_create_by'  => $_SESSION['userid']
									);
	}
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									$selectAlbum = $selectAlbum[0];
}elseif(isset($_SESSION['scode'])){

	$selectAlbum = array(		
									'id' => $_REQUEST['id'],
									'securitycode'  => $_SESSION['scode']
									);
																			
									$selectAlbum= $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
									$selectAlbum = $selectAlbum[0];
									}

									
									
					
					$album = $selectAlbum;
					if($album){
					
					
						$photodata = array(
								'album_id' => $album['id']
								);
						$photo = $shDB->selectOnMultipleCondition($photodata,'album_image'); 
						
						$albumName = str_replace(' ','_',$album['album_name']);
					$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
					$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/';
					
					$dir = str_replace(chr(92),chr(47),getcwd());
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory;
					$useralbumthumbdir = $dir.'/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory.'/thumbs/';
					
?>

<h1 class="pagetitle">Add Album</h1>
<div class="webcontent">
<div class="webTitleandTab">
<div id="boxtab-blue" >
	<ul>
	<li style="float:right;margin-left:620px;"><a href="<?php echo $log->baseurl;?>index.php?pg=photocollection&id=<?php echo $_REQUEST['id'];?>">Back</a></li> 
	<li  style="float:left"><a href="#photos">Album Creation</a></li> 
	
	</ul>
</div>
</div>
<div class="tabContent">
<div id="photos" class="tabDiv">
	<?php
	if(isset($_REQUEST['addtoalbum'])){
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Create Album'){
			if($_REQUEST['albumname']){
				$dataforuseralbum = array('id' => '',
										  'name' => trim($_REQUEST['albumname']),
										  'album_id' => $_REQUEST['id'],
										  'create_by' => $_SESSION['email'],
										  'createtime' => $log->timetodb());
													
				$result = $shDB->insert($dataforuseralbum,'useralbum');
				if($result){
					foreach($_REQUEST['addtoalbum'] as $imgid){
						$dataforuseralbumimg = array('id' => '',
													 'useralbum_id' => $result,
													 'img_id' => $imgid,
													 'img_ord' =>0	);
						$resultImgTable = $shDB->insert($dataforuseralbumimg,'useralbum_img');
					}
					if($resultImgTable){				
					?>
						<div class="messSuccess">
						Album saved successfully.
						</div>
						<br />
						<a class="addtocart" href="<?php echo $log->baseurl;?>index.php?pg=photocollection&id=<?php echo $_REQUEST['id'];?>&tab=myalbum">My Albums</a>&nbsp;
						<a  class="addtocart" href="<?php echo $log->baseurl;?>index.php?pg=albumdetails&id=<?php echo $result;?>">Place order</a>&nbsp;
					<?php 
					}
				}
			}else{?>
				<form action="" method="post" id="userAlbumAddForm">
				<label>Album Name</label><br/>
				<input name="albumname" type="text"><br />
				<?php foreach($_REQUEST['addtoalbum'] as $imgid){?>
				<input type="hidden" name="addtoalbum[]" value="<?php echo $imgid;?>">
				<?php } ?>
				<label>Photo List</label><br/>
				<div style="display:block;clear:both">
				<?php 
				for($i=0;$i<sizeof($photo);$i++)
												{	
													if(in_array($photo[$i]['id'], $_REQUEST['addtoalbum'])){
														echo '<div style="height:125px;display:block;float:left">';
														echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="javascript:void();" class="veryeasylightbox" rel="'.$useralbumurl.$photo[$i]['image'].'" ><div class="thumbimagediv"><img src="'.$useralbumthumburl.$photo[$i]['image'].'" class="photoThumb" /></div></a></div>';
														echo '</div>';
												}
												}
									
					?>	
				</div>
				<div style="clear:both;margin:8px;"></div>
				<input type="button" value="Save Album" id="saveUserAlbum">
				<input type="button" value="Cancel" onclick="history.back(1);">
				</form>
			<?php 
			}
		}else if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Add to Favourites'){
			$aId=$_REQUEST['pcId'];
			$exists=0;
			$insert=0;
			foreach($_REQUEST['addtoalbum'] as $imgid){
				$dataforuseralbumimg = array('id' => '',
											 'user_email' => $_SESSION['email'],
											 'album_id' => $aId,
											 'img_id' => $imgid,
											 'scode'=>$_SESSION['scode']);
				$checkCond = array('user_email' => $_SESSION['email'],
								   'album_id' => $aId,
								   'img_id' => $imgid,
								   'scode'=>$_SESSION['scode']);
																		
				$checkAlbumData= $shDB->selectOnMultipleCondition($checkCond,'`favourites`');
				if($checkAlbumData){
					$exists=$exists+1;
				}else{
					$resultImgTable = $shDB->insert($dataforuseralbumimg,'favourites');
					$insert=$insert+1;
				}
			}
			if($exists > 0 && $insert > 0){
				$msg=$insert.(($insert == 1 )? ' photo':' photos').' successfully added and other '.$exists.(($exists == 1 )? ' photo':' photos').' already exists in your favorite lists.';
			}elseif($exists > 0 && $insert == 0){
				$msg='<span style="color: red">'.$exists.(($exists == 1 )? ' photo':' photos').'  which you have selected already exists in your favorite lists.</span>';
			}elseif($exists == 0 && $insert >0){
				$msg=$insert.(($insert == 1 )? ' photo':' photos').' have been successfully added to the favoritelist.';
			}
			
			echo '<script>alert('.$msg.');</script>';
			echo '<script>location.href="'.$log->base_url.'index.php?pg=photocollection&id='.$aId.'&tab=favoritelist";</script>';
			
		}
	}else{
		echo '<span style="color:red">You have not attached any image.</span>';
	} ?>
	<div style="clear:both"></div><br />
	
</div>

</div>
</div>
<?php } ?>
<?php 
							 
							  switch($_REQUEST['tab']){
							  	case 'items':
							  		 $tab = 'items';
							  		 break;
							  		case 'image':
							  		 $tab = 'image';
							  		 break;
							  		
							  		 case 'features':
							  		 $tab = 'features';
							  		 break;
							  		 case 'specs':
							  		 $tab = 'specs';
							  		 break;
							  		 default:
							  		 	 $tab = 'photos';
							  	
							  }						

							 ?>
							<script type="text/javascript"> 
							  $("#boxtab-blue ul").idTabs("<?php echo $tab;?>"); 
							</script>