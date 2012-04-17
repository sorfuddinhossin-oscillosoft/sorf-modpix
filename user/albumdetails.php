<?php

									$selectSettings = array(		
																	'id' => 1
																	);									
										$settings = $shDB->selectOnMultipleCondition($selectSettings,'`settings`');
										$settings = $settings[0];
$albumdata = array(
						'id' => $_REQUEST['id']
							);
					$useralbum = $shDB->selectOnMultipleCondition($albumdata,'album');
					$useralbum = $useralbum[0];
					// var_dump($album);
//select album image
$albumImgData = array(
						'album_id' =>$useralbum['id']
							);
					$useralbumImg = $shDB->selectOnMultipleCondition($albumImgData,'album_image');
				
$totalAlbum = array(
	'album_id' =>$useralbum['id']
	);
$totalAlbum = $shDB->totalCount($totalAlbum,'album_image');

						
function albumUrl(){
	include_once '../class/dbclass.php';
	include_once '../class/class.login.php';
	
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
	include_once '../class/dbclass.php';
	include_once '../class/class.login.php';
	
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
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Album Order : <?php echo $useralbum['album_name']?> </td>
						</th>
					</table>
				</div>
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="javascript: history.back(1);" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>		
			</div>
			<div class="leftFloat div100">

<div class="webcontent" style="width:95%;overflow:hidden;">


<div id="photos" class="tabDiv">
<h2>Place an Order</h2>
	<div id="loadOrderDiv" class="loadOrderDiv" style="width:94%">
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
		<label>Collection Name : </label><br /><?php echo $useralbum['album_name'];?><br />
		<label>No of Photos : </label><br /><?php echo $totalAlbum;?><br />
		<input type="hidden" name="id" id="albumid" value="<?php echo $_REQUEST['id'];?>">
		<input type="hidden" name="id" id="albumtype" value="collection"> 
		<label>Choose album category : </label><br />
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
		
		<input type="button" name="addtoOrder" value="Order Album" id="addCollectiontoOrder">
		 -->
		 <?php echo '<p class="greenMessage" >'.$settings['ordermessage'].'</p>';?>
		<a href="<?php echo $log->baseurl;?>index.php?pg=photocollection&id=<?php echo $useralbum['album_id'];?>">Back to Collection</a>
	</form>
	</div>
	<div style="clear:both"></div><br />
	<?php foreach ($useralbumImg as $albImg){
		$img = albumImageUrl($albImg['id']);
		echo '<div style="height:125px;display:block;float:left" id="userAlbumImgDivContainer'.$albImg['id'].'">';
		echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="javascript:void();" class="veryeasylightbox" rel="'.$img['thumbs'].'" ><div class="thumbimagediv"><img src="'.$img['thumbs'].'" class="photoThumb" /></div></a></div>';
		echo '</div>';
	}
	?>
	<div style="clear:both"></div><br />
	
</div>

</div>
</div>
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