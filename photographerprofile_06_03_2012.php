<?php 
									$selectUser = array(		
																'id' => $_REQUEST['id']
																);									
									$selectUser = $shDB->selectOnMultipleCondition($selectUser,'`logon`');
									$userdetails = $selectUser[0];
									
							?>
<h1 class="pagetitle">Photographer Profile : <?php echo $userdetails['fname'].' '.$userdetails['lname'];?></h1>
<div class="webcontent">

 <table style="width:100%;" cellpadding="10" cellspacing="0">
					<tr>
						<td style="width:70%" valign="top">&nbsp;
						<?php 
						// $qry = "SELECT * from `album` WHERE album_create_by = '".$_REQUEST['id']."' AND ispublic = '1'";
						//  $result = $shDB->select('album','album_create_by',$_REQUEST['id']);
							$photodata = array(
								'album_create_by' => $_REQUEST['id'],
								'ispublic' => 1
								);
						$result = $shDB->selectOnMultipleCondition($photodata,'album');
						
						
						if($result){
						//$myalbum = $result['records'];
						$myalbum = $result;
						
						foreach($myalbum as $album){?>
							
							<!--<h3><?php echo $album['album_name'];?></h3>
							--><?php 
							$photodata = array(
								'album_id' => $album['id']
								);
						$photo = $shDB->selectOnMultipleCondition($photodata,'album_image');
						
					//	$photo = $photo1[0];
					
					/*
					 * 
					 * 
					 * 
					 */
					$albumName = str_replace(' ','_',$album['album_name']);
				//	$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
					$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/mainphoto/';
					
					$dir = str_replace(chr(92),chr(47),getcwd());
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory;
					$useralbumthumbdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory.'/thumbs/';
					?>
					<div class="product-gallery" style="height:200px;border:1px solid #E4F1EB;padding:8px;overflow:hidden">
<h4 style="font-size:11px;font-weight:bold;"><?php echo $user['company'];?></h4>
<ul>
<li>
<a href="<?php echo $log->baseurl;?>index.php?pg=profile&id=<?php echo $album['id'];?>">
<?php if($album['mainphoto']){?>
<img style="height:150px;border:1px solid #ececec" src="<?php echo $useralbumthumburl;?>/<?php echo $album['mainphoto'];?>" alt="No Photo"/> 
<?php }else{?>
<img style="height:150px;width:130px;border:1px solid #ececec" src="<?php echo $log->baseurl;?>images/nophoto.png"  alt="No Photo"/>
<?php } ?>
</a>
<p style="color:black;font-size:11px;">
 <?php echo '<a href="'.$log->baseurl.'index.php?pg=profile&id='.$album['id'].'"><h5>'.$album['album_name'].'</h5></a>';?>
</p>
 </li>
</ul>
</div>
					<?php 
					/*		
					if($photo){
							for($i=0;$i<sizeof($photo);$i++)
									{	
								
										echo '<div style="height:140px;display:block;float:left;margin:5px 1px;">';
										echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="'.$useralbumurl.$photo[$i]['image'].'" class="veryeasylightbox" rel="'.$useralbumurl.$photo[$i]['image'].'" ><div class="thumbimagediv"><img src="'.$useralbumthumburl.$photo[$i]['mainphoto'].'" class="photoThumb" /></div></a></div>';
										echo '</div></div>';
								}
							}
							*/
								?>
						
							
					<?php }	}else{
						echo  '<p class="greenMessage" style="color:red">No album uploaded by photographer.</p>';
					}	
									
						?>
						<?php echo '<div style="clear:both">'.$result['pagination'].'</div>';?>						
						</td>
						<td style="width:30%; background:#EAF0F0" valign="top">		
								<div class="leftFloat div100 botBorder1"><strong id="pInfoTitle">Photographer Details</strong>
								</div>
							<div align="center" class="leftFloat div100" id="personelInfo">
							
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
								</div>
							
						
																	
							</div>
							
						
												
						</td>					</tr>
				</table>
</div>