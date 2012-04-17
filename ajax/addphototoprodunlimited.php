<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log =new logmein();


$selectData = array(
						'id' => $_REQUEST['productid']
						);
	$tempproduct = $shDB->selectOnMultipleCondition($selectData,'temp_product');



if($tempproduct[0]["maxallowedimg"]==''){
$insertData = array(
					'id' =>'',
					'img_id' => $_REQUEST['id'],
					'temp_product_id' => $_REQUEST['productid'],
					'img_ord' => 1000
					);
					
$imageInsert = $shDB->insert($insertData,'temp_product_img');

if($imageInsert){
	$selectinsert = array(
						'id' => $_REQUEST['id']
						);
	$imageId = $shDB->selectOnMultipleCondition($selectinsert,'album_image');
	
	$dataSelect = array(
						'id' => $imageId[0]['album_id']
						);
	$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'album');
	
	$albumName = str_replace(' ','_',$imageDetails[0]['album_name']);
		$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_owner_id'].'/'.$albumName.'/';
		$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_owner_id'].'/'.$albumName.'/thumbs/';
	
		echo '<li class="cartPhotoImgHolder" id="cartPhotoImgHolder_'.$tempProductImg['id'].'"><img src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
																echo '<span class="delSpan" style="position:absolute;z-index:5000" ><a class="delCartPhoto" onclick="delPhotoFromMyCart('.$tempProductImg['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a></span>';
																echo '</li>';
//	echo '<img src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
//	echo '<span class="delSpan" style="position:absolute;z-index:5000" ><a class="delCartPhoto" onclick="emptyPhotoFromProd('.$_REQUEST['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a></span>';	
}
?>
<script>
$(document).ready(function() {	
	$(emptyPhotoFromProd(<?php echo $photo[$i]['id'];?>));
	$('.cartPhotoImgHolder').hover(function(){
		$(this).children('span').fadeToggle("fast");

	});
});
</script>
<?php } ?>