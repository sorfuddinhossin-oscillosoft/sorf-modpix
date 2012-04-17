<div id="leftMenu">
	<ul class="left_menu">
	<?php 
		$dashboard = '';
		$album = '';
		$orderlist = '';
		$couplelist = '';
		$productlist = '';
		$payment = '';
		$feedback = '';
		$siteconfig = '';
		switch($_REQUEST['pg']){		
		case 'album': 
			$album = 'active'; break;
		case 'albuminvitation': 
			$album = 'active'; break;
			case 'phototoproduct': 
			$album = 'active'; break;
			case 'editalbum': 
			$album = 'active'; break;		
			
			case 'siteconfig': 
			$siteconfig = 'active'; break;
		case 'addalbum': 
			$album = 'active'; break;
			
		case 'albumdetails': 
			$album = 'active'; break;
			case 'itemlist': 
			$itemlist = 'active'; break;
		case 'addphototoalbum': 
			$album = 'active'; break;					
		case 'orderlist': 
			$orderlist = 'active'; break;
		case 'orderdetails': 
			$orderlist = 'active'; break;			
		case 'couplelist': 
			$couplelist = 'active'; break;
		case 'addcouple': 
			$couplelist = 'active'; break;			
		case 'productlist': 
		case 'productdetails': 
			$productlist = 'active'; break;
		case 'addproduct': 
			$productlist = 'active'; break;			
		case 'productdetails': 
			$productdetails = 'active'; break;	
		case 'feedback': 
			$feedback = 'active'; break;
		case 'catedit': 
			$categorylist = 'active'; break;
		case 'categorylist': 
			$categorylist = 'active'; break;	
		case 'itemoption': 
			$itemoption = 'active'; break;	
			case 'additem': 
			$additem = 'active'; break;	
		default: 
			$dashboard = 'active'; break;																	
		}
		
		?>
		<li><a class="<?php echo $dashboard; ?>" title="Dashboard" href="<?php echo $log->baseurl;?>user/index.php?pg=dashboard">Dashboard</a></li>
		<li><a class="<?php echo $siteconfig; ?>" title="siteconfig" href="<?php echo $log->baseurl;?>user/index.php?pg=siteconfig">Site Configuration</a></li>
		<li><a class="<?php echo $album; ?>" title="Album" href="<?php echo $log->baseurl;?>user/index.php?pg=album">Photo Collection</a></li>
		<li><a class="<?php echo $orderlist; ?>" title="Order List" href="<?php echo $log->baseurl;?>user/index.php?pg=orderlist">Order List</a></li>
		<li><a class="<?php echo $couplelist; ?>" title="User List" href="<?php echo $log->baseurl;?>user/index.php?pg=couplelist">Photographer</a></li>
		<li><a class="<?php echo $categorylist; ?>" title="Product List &amp; Pricing" href="<?php echo $log->baseurl;?>user/index.php?pg=categorylist">Product Category</a></li>
		<li><a class="<?php echo $productlist; ?>" title="Product List &amp; Pricing" href="<?php echo $log->baseurl;?>user/index.php?pg=productlist">Product Listing</a></li>
		<li><a class="<?php echo $itemoption; ?>" title="Product Item Listing" href="<?php echo $log->baseurl;?>user/index.php?pg=itemoption">Item Option</a></li>
		<li><a class="<?php echo $additem; ?>" title="Product List &amp; Pricing" href="<?php echo $log->baseurl;?>user/index.php?pg=additem">Add Item</a></li>
		<li><a class="<?php echo $itemlist; ?>" title="Product List &amp; Pricing" href="<?php echo $log->baseurl;?>user/index.php?pg=itemlist">Item Listing</a></li>
		
		
		<!--
		<li><a class="<?php echo $payment; ?>" title="Payment" href="<?php echo $log->baseurl;?>user/index.php?pg=payment">Payment</a></li>
		-->
		<li><a class="" title="Order List" href="<?php echo $log->baseurl;?>index.php?pg=logout">Logout</a></li>
	</ul>
</div>