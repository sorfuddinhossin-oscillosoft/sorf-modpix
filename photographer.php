<h1 class="pagetitle">Photographer</h1>
<div class="webcontent">
<?php 
	$logon = array('userlevel'=> 2,
				   'status'=> 1);
	$logon = $shDB->selectOnMultipleCondition($logon,'logon');
if($logon){
	foreach($logon as $user){
?>
<div class="product-gallery" style="width:170px;height:200px;border:1px solid #E4F1EB;padding:8px;">
<h4 style="font-size:11px;font-weight:bold;"><?php echo $user['company'];?></h4>
<ul>
<li>
<a href="<?php echo $log->baseurl;?>index.php?pg=profile&id=<?php echo $user['id'];?>">
<?php if($user['photo']){?>
<img style="height:75px;width:75px;border:1px solid #ececec" src="<?php echo $log->baseurl;?>user/profile/<?php echo $user['id'];?>/<?php echo $user['photo'];?>" alt="No Photo"/> 
<?php }else{?>
<img style="height:75px;width:75px;border:1px solid #ececec" src="<?php echo $log->baseurl;?>images/nophoto.png"  alt="No Photo"/>
<?php } ?>
</a>
<p style="color:black;font-size:11px;">
<?php echo $user['fname'].' '.$user['lname'].'<br />';?> 
<?php //echo $user['address'].'<br />';?> 
<?php //echo $user['city'].', '.$user['country'].'<br />';?> 
</p>
<a style="margin-left:0px;" class="viewProfile" href="<?php echo $log->baseurl;?>index.php?pg=photographerprofile&id=<?php echo $user['id'];?>">
</a>
 </li>
</ul>
</div>
<?php }
 } ?>
</div>