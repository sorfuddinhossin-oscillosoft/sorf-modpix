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
		switch($_REQUEST['pg']){
			case 'albuminvitation':
				$myalbum = 'active'; break;	
			case 'myalbum': 
				$myalbum = 'active'; break;
			case 'albumview': 
				$myalbum = 'active'; break;
			case 'editalbum': 
				$myalbum = 'active'; break;
			case 'addalbum': 
				$myalbum = 'active'; break;
				case 'albumdetails': 
			$myalbum = 'active'; break;
			case 'album': 
				$album = 'active'; break;
			case 'albumview': 
				$album = 'active'; break;			
			case 'profile': 
				$profile = 'active'; break;
			case 'orderdetails': 
					
				$orderlist = 'active'; break;
			case 'orderlist': 
					
				$orderlist = 'active'; break;
			case 'couplelist': 
				$couplelist = 'active'; break;
			case 'productlist': 
				$productlist = 'active'; break;
			case 'guestalbum': 
				$guestalbum = 'active'; break;	
			case 'feedback': 
				$feedback = 'active'; break;	
			default: 
				$dashboard = 'active'; break;																	
		}		
		?>
		<li><a class="<?php echo $dashboard; ?>" title="Dashboard" href="<?php echo $log->baseurl;?>user/index.php?pg=dashboard">Dashboard</a></li>
<!--		<li><a class="<?php echo $profile; ?>" title="Album" href="<?php echo $log->baseurl;?>user/index.php?pg=profile">Personel Profile</a></li>-->
		<li><a class="<?php echo $myalbum; ?>" title="Album" href="<?php echo $log->baseurl;?>user/index.php?pg=myalbum">My Collection</a></li>
		
		<?php if($_SESSION['userlevel']==2){?>
<!--		<li><a class="<?php echo $album; ?>" title="Album" href="<?php echo $log->baseurl;?>user/index.php?pg=album">Customer Album </a></li>-->
		<?php } ?>
		<!-- 
		<li><a class="<?php echo $guestalbum; ?>" title="Couple List" href="<?php echo $log->baseurl;?>user/index.php?pg=guestalbum">Guest Album</a></li>		
		<li><a class="<?php echo $orderlist; ?>" title="Order List" href="<?php echo $log->baseurl;?>user/index.php?pg=orderlist">Order List</a></li>
		 -->	
		 <li><a class="<?php echo $orderlist; ?>" title="Order List" href="<?php echo $log->baseurl;?>user/index.php?pg=orderlist">Order List</a></li>	
		<li><a class="" title="Order List" href="<?php echo $log->baseurl;?>index.php?pg=logout">Logout</a></li>
	</ul>
</div>