<?php 
$proddata = array(
							'id' => $_REQUEST['id']
							);
					$product = $shDB->selectOnMultipleCondition($proddata,'product');
					
					$productDetails = $product[0];
					
					
						$catdata = array(
							'id' => $productDetails['catid']
							);
					$catName = $shDB->selectOnMultipleCondition($catdata,'product_cat');
					$catName = $catName[0]['name'];
					
					$imagedata = array(
							'prod_id' => $productDetails['id']
							);
					$prodImage = $shDB->selectOnMultipleCondition($imagedata,'prod_image');
?>
<h1 class="pagetitle"><?php echo $productDetails['name'];?></h1>
<div class="webcontent">
<div class="webTitleandTab">
<div class="catNameandProductTitle">
<strong><?php echo $catName;?></strong> &raquo; <?php echo $productDetails['name'];?>
</div>
<div id="boxtab-blue">
	<ul>
	<li><a href="#summery">Product Summary</a></li> 
	<li><a href="#features">Features & Pricing</a></li> 
	<li><a href="#specs">Specs</a></li> 
	</ul>
</div>
</div>
<div class="tabContent">
<div id="summery" class="tabDiv">
<div id="gallery">
							   <?php 
							  $prodNameDir = str_replace(' ','_',$productDetails['name']);
							  foreach($prodImage as $prodimg){	?>	
							  												
									<a href="#" style="clear:both">
									<img title="" alt="" rel="<h3>Flowing Rock</h3>" src="<?php echo $log->baseurl;?>user/product/<?php echo $productDetails['catid'];?>_<?php echo $prodNameDir; ?>/<?php echo $prodimg["name"]?>" style="width:830px;"/>
										</a>
										<?php 	}							 
							  ?>
							  
							  <div class="caption"><div class="content"></div></div>
					 </div>
					 <script>
							  $(document).ready(function(){	
								  slideShow();
								});
							  </script>
<br />
 <div class="clear" style="clear:both"></div>
 <div style="clear:both;display:block">
	<?php echo $productDetails['summery'];?>	
</div>
</div>	
<div id="features" class="tabDiv">
<?php echo $productDetails['features'];?>

							   <?php 
								  
								   // select all items
								   
								    $itemData = array(
											'prod_id' => $productDetails['id']
											);
									$itemData = $shDB->selectOnMultipleCondition($itemData,'prod_item');
								 if($itemData){?>
								 <table width="100%" id="itemDetailsTable" cellpadding="0" cellspacing="0">
									<tr>
								
								<th style="width:75%">Item Name</th>
								<th>Price</th>
								<th style="width:15%">&nbsp;</th>
								</tr>
								
								<?php foreach($itemData as $idata){?>
								
								<tr>
			
		<td>
		<b> <?php echo $idata['name'];?></b>				
		</td>
		
		<td>&nbsp;<?php echo $settings['currency'];?>&nbsp;<?php echo $idata['basicprice'];?></td>
		<!--<td><?php echo '<a href="Javascript:void(0)" onclick="productToCart('.$idata['id'].')" class="addtocart">Add to cart</a>';?></td>
		-->
		<td><?php echo '<a href="'.$log->base_url.'index.php?pg=productorder&id='.$idata['id'].'" class="addtocart">Order Product</a>';?></td>
		</tr>
								<?php } ?>
								
						</table>		
									<?php } ?>
							  
								</div> 
							   <div id="specs" class="tabDiv">
							   
							  <?php echo $productDetails['specs'];?>
							  						  
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
							  		 	 $tab = 'summery';							  	
							  }						

							 ?>
							 
							 <script type="text/javascript"> 
							 CKEDITOR.replace( '.ckeditor',
			{
				sharedSpaces :
				{
					top : 'topSpace',
					bottom : 'bottomSpace'
				},

				// Removes the maximize plugin as it's not usable
				// in a shared toolbar.
				// Removes the resizer as it's not usable in a
				// shared elements path.
				removePlugins : 'maximize,resize'
			} );
								</script>
							<script type="text/javascript"> 

							
							  $("#boxtab-blue ul").idTabs("<?php echo $tab;?>"); 
							</script>
</div>
</div>



