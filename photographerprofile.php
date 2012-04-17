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
							<div class="leftFloat div100 botBorder1"><strong id="pInfoTitle">Contact to Photographer</strong></div>
							<div align="center" class="leftFloat div100" id="personelInfo">	
								<div id="photographerSubmitSuccess" style="display: none;">
									<p style="color:#FCCB98; font-weight: bold;">Your request have been successfully submitted. We will contact with you.</p>
								</div>
								<div id="photographerContacForm">
									<table style="width:80%" cellpadding="0" cellspacing="0">
										<tr><td><input type="hidden" id="photgrapher_id" value="<?php echo $_REQUEST['id'];?>"></td></tr>
										<tr>
											<th height="25" valign="bottom">Name</th>	
										</tr>
										<tr>
											<th><input class="contactPhographer" type="text" id="c_visitor_name" value="" /></th>	
										</tr>
										<tr>
											<th height="25" valign="bottom">Address </th>	
										</tr>
										<tr>
											<th><textarea id="c_visitor_address" cols="36" rows="2"/></textarea></th>	
										</tr>
										<!--<tr>
											<th height="25" valign="bottom">Address Line Two</th>	
										</tr>
										<tr>
											<th><input class="contactPhographer" type="text" id="c_visitor_address_1" value="" /></th>	
										</tr>-->
										<tr>
											<th height="25" valign="bottom">Phone</th>	
										</tr>
										<tr>
											<th><input class="contactPhographer" type="text" id="c_visitor_phone" value="" /></th>	
										</tr>
										<tr>
											<th height="25" valign="bottom">Email</th>	
										</tr>
										<tr>
											<th><input class="contactPhographer" type="text" id="c_visitor_email" value="" /></th>	
										</tr>
										<!--<tr>
											<th height="25" valign="bottom">Post Code</th>	
										</tr>
										<tr>
											<th><input class="contactPhographer" type="text" id="c_visitor_pcode" value="" /></th>	
										</tr>
										
										<tr>
											<th height="25" valign="bottom">City</th>	
										</tr>
										<tr>
											<th><input class="contactPhographer" type="text" id="c_visitor_city" value="" /></th>	
										</tr>
										<tr>
											<th height="25" valign="bottom">Country</th>	
										</tr>
										<tr>
											<th><input class="contactPhographer" type="text" id="c_visitor_country" value="" /></th>	
										</tr>-->
										
										<tr>
											<th height="25" valign="bottom">Details of your interests </th>	
										</tr>
										<tr>
											<th><textarea id="c_visitor_instruction" cols="36" rows="10"/></textarea></th>	
										</tr>
										<tr>
											<th><input type="button" Value="Submit" id="sendContactInfo"></th>	
										</tr>																																											
									</table>
								</div>
							</div>
							
						
																	
							</div>
							
						
												
						</td>					</tr>
				</table>
</div>