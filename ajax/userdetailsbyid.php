<?php 
session_start();
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$log = new logmein();
if(isset($_REQUEST[id])){
$selectOrderById = array(		
							'id' => $_REQUEST[id]
							);	
}else{
	$selectOrderById = array(		
							'id' => $_SESSION['userid']
							);
}								
$userdetails = $shDB->selectOnMultipleCondition($selectOrderById,'`logon`');
$userdetails = $userdetails[0];
?>
<table style="width:80%" cellpadding="0" cellspacing="0">
										<tr><td>&nbsp;</td></tr>
										<tr>
											<td>
											<?php if($userdetails['photo']==''){ ?>
											<img src="<?php echo $log->baseurl?>images/nophoto.png" class="photoThumb" />
											<?php }else{?>
											<img src="<?php echo $log->baseurl.'user/profile/'.$_SESSION['userid'].'/'.$userdetails['photo'];?>" class="photoThumb" />
											<?php } ?>
											</td>	
										</tr>								
										<tr>
											<td><strong><?php echo $userdetails['fname'].' '.$userdetails['lname'];?></strong></td>
										</tr>
										<tr>
											<td><?php echo $userdetails['address'];?><br />
											<?php
											if($userdetails['addresstwo']){ 
											echo $userdetails['addresstwo'].',';
											}
											
											if($userdetails['zip']){ 
											echo 'Zip -'.$userdetails['zip'].',<br />';
											}
											if($userdetails['city']){ 
											echo $userdetails['city'].' - ';
											}
											echo $userdetails['country']
											?>
											</td>
										</tr>
										<tr>
											<td><strong>Phone : <?php echo $userdetails['phone']?></strong></td>
										</tr>
										<tr>
											<td><strong>Email :</strong> <a href="mailto:<?php echo $userdetails['useremail']?>"><?php echo $userdetails['useremail']?></a></td>
										</tr>																																												
									</table>