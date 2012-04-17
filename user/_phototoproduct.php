<?php
$photodata = array(
								'id' => $_REQUEST['imgid']
								);
						$photo = $shDB->selectOnMultipleCondition($photodata,'album_image');
						$photo = $photo[0];
			$albumdata = array(
								'id' => $photo['album_id']
								);
						$album = $shDB->selectOnMultipleCondition($albumdata,'album');
						$album = $album[0];	
								
						$albumName = str_replace(' ','_',$album['album_name']);
					$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
					$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/';
					
									$selectSettings = array(		
																	'id' => 1
																	);									
										$settings = $shDB->selectOnMultipleCondition($selectSettings,'`settings`');
										$settings = $settings[0];
?>
<h1 class="pagetitle">Photo Order</h1>
<div class="webcontent">

<div class="webTitleandTab">

<div id="boxtab-blue" >
	<ul>
	<li style="float:right;margin-left:620px;"><a href="javascript:void(0)" onclick="javascript:back(-1);">Back</a></li> 
<!--	<li  style="float:left"><a href="#photos">Album Creation</a></li> -->
	
	</ul>
</div>
</div>
<div class="tabContent">
<div id="photos" class="tabDiv">
	<img src="<?php echo $useralbumurl.$photo['image'];?>"/>
	
	<div style="clear:both"></div><br />
	<h2>Confirm Order</h2>
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
	<form action="" name="" method="POST" id="PhotoOrderForm">
		<input type="hidden" value="<?php echo $_REQUEST['imgid'];?>" name="imgid" id="imageId">
		<label>Choose Product category : </label><br />
		<?php 
						$catdata = array(
								'isalbum' => 0
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
								'isalbum' => 0
								);
						$category = $shDB->selectOnMultipleCondition($catdata,'product_cat'); 
		?>
		<select id="albumproduct" name="albumproduct">	
			<option value="">Select a product</option>		 	
		</select>
		<br />
		<label>Select an Item</label><br />
		<select id="productitem" name="productitem">
			<option value="">Select a product</option>			
		</select>
		<br />
		<label>Number of Copies</label><br />
		<input style="font-size: 11px; line-height: 1em; width: 192px;" type="text" id="numberofcopy" name="numberofcopy"><br />
			<?php echo '<p class="greenMessage" style="color:green">'.$settings['productmessage'].'</p>';?>
		<input type="button" name="addtoOrder" value="Place Order" id="photoaddtoCart">
		
	</form>
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