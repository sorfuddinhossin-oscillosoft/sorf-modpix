<?php
$current = 0;
if(isset($_REQUEST['id'])){
	$current = 1;
}

if(isset($_REQUEST['id'])){
	$current = 1;
}

if($current==0){
	 echo '<script>location.href="'.$log->base_url.'index.php?pg=invitation";</script>';
}

									$selectSettings = array(		
																	'id' => 1
																	);									
										$settings = $shDB->selectOnMultipleCondition($selectSettings,'`settings`');
										$settings = $settings[0];
$albumdata = array(
						'id' => $_REQUEST['id']
							);
					$useralbum = $shDB->selectOnMultipleCondition($albumdata,'useralbum');
					$useralbum = $useralbum[0];
					// var_dump($album);
//select album image
$albumImgData = array(
						'useralbum_id' =>$useralbum['id']
							);
					$useralbumImg = $shDB->selectOnMultipleCondition($albumImgData,'useralbum_img');
				
$totalAlbum = array(
	'useralbum_id' =>$useralbum['id']
	);
$totalAlbum = $shDB->totalCount($totalAlbum,'useralbum_img');

						
function albumUrl(){
	include_once 'class/dbclass.php';
	include_once 'class/class.login.php';
	
	$shDB =new sh_DB();
	$log =new logmein();
	$albumdata = array(
						'id' => $_REQUEST['id']
							);
					$useralbum = $shDB->selectOnMultipleCondition($albumdata,'useralbum');
					$useralbum = $useralbum[0];
	
	
	$conditionData = array(
						'id' => $useralbum['album_id']
							);
	$album = $shDB->selectOnMultipleCondition($conditionData,'album');
	$album = $album[0];
	
	$albumName = str_replace(' ','_',$album['album_name']);
										
					$dir = str_replace(chr(92),chr(47),getcwd());
					
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory.'/';
					$useralbumthumbdir = $dir.'/user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumdirectory.'/thumbs/';
					
					//$albumdir['userfolder'] = $useralbumthumburl;
					//$albumdir['original'] = $useralbumurl;
					return $useralbumdir;
}
function albumImageUrl($imgId = ''){
	include_once 'class/dbclass.php';
	include_once 'class/class.login.php';
	
	$shDB =new sh_DB();
	$log =new logmein();
	if($imgId=='') return false;
	$conditionData = array(
						'id' => $imgId
							);
	$albumImage = $shDB->selectOnMultipleCondition($conditionData,'album_image');
	$albumImageDetails = $albumImage[0];
	
	$conditionData = array(
						'id' => $albumImageDetails['album_id']
							);
	$album = $shDB->selectOnMultipleCondition($conditionData,'album');
	$album = $album[0];
	
	$albumName = str_replace(' ','_',$album['album_name']);
					$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/'.$albumImageDetails['image'];
					$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/'.$albumImageDetails['image'];
					
					/*
					$dir = str_replace(chr(92),chr(47),getcwd());
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory.'/'.$albumImageDetails['image'];
					$useralbumthumbdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory.'/thumbs/'.'/'.$albumImageDetails['image'];
					*/
					$img['thumbs'] = $useralbumthumburl;
					$img['original'] = $useralbumurl;
					return $img;
}
?>
<h1 class="pagetitle">Album Order</h1>
<div class="webcontent">

<table width="100%"> 
<tr>
<td>

<?php
 
if(isset($_REQUEST['addPhotoBtn'])){
										$directory = albumUrl();
										echo 'Album Id : '.$useralbum['album_id'];
										$isUpload = $imageProcessor->uploadPhototoDirectory($directory,$useralbum['album_id'],'photoFile');
										var_dump($isUpload);
										if($isUpload==false){
											$uploadMessege = 'Upload failure. Please try again';
										}else{
											$datainsert = array(
											'id' => '',
											'useralbum_id' => $_REQUEST['id'],
											'img_id' => $isUpload,
											'img_ord' => 0
											);
											$imageInsertResult = $shDB->insert($datainsert,'useralbum_img');
											
										}
										
										echo '	<script>
												location.href="'.$log->base_url.'index.php?pg=albumdetails&id='.$_REQUEST[id].'";
												</script>';
											
										} 
?>

<div class="tabContent" style="width:97%;">

<div id="photos" class="tabDiv">
	<?php foreach ($useralbumImg as $albImg){
		$img = albumImageUrl($albImg['img_id']);
		echo '<div style="height:125px;display:block;float:left" id="userAlbumImgDivContainer'.$albImg['id'].'">';
		echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="javascript:void();" class="veryeasylightbox" rel="'.$img['thumbs'].'" ><div class="thumbimagediv"><img  title="'.$albImg['title'].'" src="'.$img['thumbs'].'" class="photoThumb" /></div></a></div>';
		echo '<div style="height:125px;display:block;float:left;margin-left:-16px;margin-top:2px;position:relative"><span class="del" rel="'.$albImg['id'].'">X</span></div>';
		echo '</div>';
	}
	?>
	<div style="clear:both"></div><br />
	<h2>Place an Order</h2>
	<div id="loadOrderDiv" class="loadOrderDiv">
	<?php 
	if(isset($_REQUEST['albumproduct'])){
		$proddetailsdata = array(
								'id' => $_REQUEST['albumproduct']
								);
						$proddetailsdata = $shDB->selectOnMultipleCondition($proddetailsdata,'product'); 
						$proddetailsdata = $proddetailsdata[0];
						var_dump($proddetailsdata);
						$prodimgQty = $proddetailsdata['img_quantity'];
						$albumImgQty = $totalAlbum;
						$allowedImgQty = $prodimgQty + ($proddetailsdata['leaf_hole']+ $_REQUEST['additionalalbumleaf']);
							
						echo 'Image Allowed = '.$allowedImgQty.'<br />';
						echo 'Image Selected = '.$allowedImgQty.'<br />';
						
	}	
	?>
	<form action="<?php echo $log->base_url;?>index.php?pg=albumorder&id=<?php echo $_REQUEST[id];?>" name="" method="POST" id="albumOrderForm">
		<label>Album Name : </label><br /><?php echo $useralbum['name'];?><br />
		<label>No of Photos : </label><br /><?php echo $totalAlbum;?><br />
		<label>Choose album category : </label><br />
		<input type="hidden" name="id" id="albumid" value="<?php echo $_REQUEST['id'];?>">
		<input type="hidden" name="id" id="albumtype" value="album">
		<?php 
						$catdata = array(
								'isalbum' => 1
								);
						$category = $shDB->selectOnMultipleCondition($catdata,'product_cat'); 
		?>
		<select id="productcat" name="productcat">
			<option value="">Select a product category</option>
			<?php foreach($category as $cat){
				if(isset($_REQUEST['productcat'])){
					if($_REQUEST['productcat']==$cat['id']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
				}
				echo '<option value="'.$cat['id'].'" '.$selected.'>'.$cat['name'].'</option>';
		 	} ?>
		</select><br />
		<label>Choose Product : </label><br />
		<?php 
						$catdata = array(
								'isalbum' => 1
								);
						$category = $shDB->selectOnMultipleCondition($catdata,'product_cat'); 
		?>
		<select id="albumproductlist" name="albumproduct">
		<?php 
						$proddata = array(
								'catid' => $category[0]['id']
								);
						$product = $shDB->selectOnMultipleCondition($proddata,'product'); 
		?>
			<option value="">Select a product</option>
			<?php foreach($product as $prod){
			if(isset($_REQUEST['albumproduct'])){
					if($_REQUEST['albumproduct']==$prod['id']){
						$selectedprod = 'selected';
					}else{
						$selectedprod = '';
					}
				}
				echo '<option value="'.$prod['id'].'" '.$selectedprod.'>'.$prod['name'].'</option>';
		 	} ?>
		</select>
		<br />
		<div id="productitemdiv"></div>
		<!-- 
		<label>Additional album leaf</label><br />
		<input type="hidden" name="albumid" id="albumid" value="<?php echo $_REQUEST['id'];?>">
		<input style="font-size: 11px; line-height: 1em; width: 192px;" type="text" name="additionalalbumleaf"><br />
		
		<input type="button" name="addtoOrder" value="Order Album" id="addtoOrder">
		 -->
		 <?php echo '<p class="greenMessage">'.$settings['ordermessage'].'</p>';?>
		 <br />
		<a class="btnLike" href="<?php echo $log->baseurl;?>index.php?pg=photocollection&id=<?php echo $useralbum['album_id'];?>">Back to Collection</a>
	</form>
	</div>
</div>
</td>
</tr>
</table>
</div>
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