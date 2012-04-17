<?php 
$photodata = array(
								'id' => $_REQUEST['id'],
								'ispublic' => 1
								);
						$result = $shDB->selectOnMultipleCondition($photodata,'album');
						$result = $result[0];
						$selectUser = array(		
																'id' => $result['album_create_by']
																);									
									$selectUser = $shDB->selectOnMultipleCondition($selectUser,'`logon`');
									$userdetails = $selectUser[0];
									
						$album = $result;
					
							$photodata = array(
								'album_id' => $album['id']
								);
						$photo = $shDB->selectOnMultipleCondition($photodata,'album_image');

						?>

<h1 class="pagetitle">Photographer Profile : <?php echo $album['album_name'];?></h1>
<div class="webcontent">

 <table style="width:100%;" cellpadding="10" cellspacing="0">
					<tr>
						<td style="width:70%" valign="top">
						<?php 
						
						
					//	$photo = $photo1[0];
					
					/*
					 * 
					 * 
					 * 
					 */
					$albumName = str_replace(' ','_',$album['album_name']);
					$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
					$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/';
					
					$dir = str_replace(chr(92),chr(47),getcwd());
					$albumdirectory = str_replace(' ','_',$album['album_name']);
					$useralbumdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory;
					$useralbumthumbdir = $dir.'/profile/'.$album['album_create_by'].'/'.$albumdirectory.'/thumbs/';
					echo '<h3 style="clear:both;">'.$result['album_name'].'<span style="float:right"><a class="smallBack" href="'.$log->baseurl.'index.php?pg=photographerprofile&id='.$userdetails['id'].'"></a></span></h3>';
						if($photo){
							for($i=0;$i<sizeof($photo);$i++)
									{	
										echo '<div style="height:140px;display:block;float:left;margin:5px 1px;">';
										echo '<div style="height:125px;display:block;float:left;margin-left:0px;"><a href="'.$useralbumurl.$photo[$i]['image'].'" class="veryeasylightbox" rel="'.$useralbumurl.$photo[$i]['image'].'" ><div class="thumbimagediv"><img src="'.$useralbumthumburl.$photo[$i]['image'].'" class="photoThumb" /></div></a></div>';
										echo '</div></div>';
									}
						}else{
							echo  '<p class="greenMessage" style="color:red">Empty album.</p>';
						}
								?>
						
							
					<?php 	
									
						?>
											
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
