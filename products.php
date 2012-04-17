<?php 
$catdata = array(
							'active_status' => 1
							);
					$category = $shDB->selectOnMultipleCondition($catdata,'product_cat');
					//var_dump($catName);
?>
<h1 class="pagetitle">Products</h1>
<div class="webcontent">
<?php foreach($category as $cat){
	$product = array('catid' => $cat['id'],
					 'status'=>1);
	$product = $shDB->selectOnMultipleCondition($product,'product');
if($product){
?>
<div class="product-gallery">
<h4><?php echo $cat['name'];?></h4>
<ul>
<?php 

					//var_dump($catName);
if($product){
foreach($product as $prod){
	
	$productimg = array(
							'prod_id' => $prod['id']
							);
					$productimg = $shDB->selectOnMultipleCondition($productimg,'prod_image');
					$productimg = $productimg[0];
?>
<li>
<div style="height: 119px;overflow: hidden;">
<a href="<?php echo $log->baseurl;?>index.php?pg=productdetails&id=<?php echo $prod['id'];?>">
<?php 
 $prodNameDir = str_replace(' ','_',$prod['name']);
?>
<img src="<?php echo $log->baseurl;?>user/product/<?php echo $cat['id'];?>_<?php echo $prodNameDir; ?>/thumb_<?php echo $productimg["name"]?>"/> 

</a>
</div>
<?php echo $prod['name'];?> 
 </li>
 <?php }
} ?>
</ul>
</div>
<?php }
}
?>
</div>
