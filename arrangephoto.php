<?php
/*
$selectProductDatainTemp = array(		
							'logonid' => $_SESSION['userid']
							);	
						*/	
$selectProductDatainTemp = array(		
							'sessionid' => $_SESSION['sessionid'],
							'productid' => $_REQUEST['prodid']
							);		
												
$dataInTempProduct = $shDB->selectOnMultipleCondition($selectProductDatainTemp,'temp_product');
$tempProduct = $dataInTempProduct[0];
$totalSides = $tempProduct['defaultsides']+$tempProduct['additionalleaf'];
// $dataInTempProduct;
$selectSettings = array(		
																	'id' => 1
																	);									
										$settings = $shDB->selectOnMultipleCondition($selectSettings,'`settings`');
										$settings = $settings[0];
?>
<script type="text/javascript">
		
		$().ready(function() {
		//	$("#collectionImageHolderDrug").jScroll();
		});
		
	</script>
<h1 class="pagetitle">Photo Arrange</h1>
<div class="webcontent">
<table width="100%">
<tr>
<td valign="top">
		
			
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="" style="width:96%; padding-left:2%;">
							<h2 class="subTitleh2" style="width:100%">Photo Arrange - <?php echo $tempProduct['name'];?></h2>
							</td>
					</tr>
					
					<tr>
						<td align="left" class="" style="width:96%; padding-left:2%;">
							<h2 class="" style="width:100%;color:#536B6C;font-size:14px;line-height:1.6em;">
								To add photo's to the Album Page Layout, click and drag photo's from your photo collection to the selected page# node.
								<br />
								Page 1 will be a single page, Pages 2-3, 4-5, 6-7 and so on can have a panoramic layout, simply add the same photo to two pages, for image overlays add extra images to a panoramic page.

							</h2>
							</td>
					</tr>
					
					<tr>
						<td align="center" colspan="2" style="padding-left:2%; padding-right:2%; width:96%;">
						
						<table>
						<tr>
						<td valign="top">
							<div align="left" class="headerCartProduct" style="width:450px;cursor:move;background:#536B6C;color:white;">
								<span class="leftFloat"><strong>Album Pages</strong></span>
								<div class="clearb"></div>
							</div>
							<div class="cartPhotoHolderDiv" style="float:left; width: 456px;height: 450px; overflow: scroll; overflow-x:hidden; padding: 0px 0px 0px 8px;">	
									<?php for($ids=1;$ids<=$totalSides;$ids++){?>
										<div class="leftFloat div100">
											<div align="left" class="headerCartProduct" style="width:410px">
												<span class="leftFloat"><strong>Page # <?php echo $ids;?></strong></span>
												
												<div class="clearb"></div>
											</div>
											<div class="cartPhotoHolderDiv"  style="width:424px" title="<?php echo $tempProduct['id']?>">
																<?php 
																$selectTempProdImg = array(		
																							'temp_product_id' => $tempProduct['id'],
																							'sideid' => $ids
																							);		
																												
																$selectTempProdImg = $shDB->selectOnMultipleCondition($selectTempProdImg,'temp_product_img');
																// var_dump($selectTempProdImg);
																if($selectTempProdImg){
																	foreach($selectTempProdImg as $prodimg){
																		
																			// select image details
																			
																			$datainsert = array(
																								'id' => $prodimg['img_id']
																								);
																			$imageId = $shDB->selectOnMultipleCondition($datainsert,'album_image');
																			
																			$dataSelect = array(
																								'id' => $imageId[0]['album_id']
																								);
																			$imageDetails = $shDB->selectOnMultipleCondition($dataSelect,'album');
																			
																			$albumName = str_replace(' ','_',$imageDetails[0]['album_name']);
																				$useralbumurl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/';
																				$useralbumthumburl = $log->baseurl.'user/profile/'.$imageDetails[0]['album_create_by'].'/'.$imageDetails[0]['id'].'_'.$albumName.'/thumbs/';
																
																			// select image details ends her
																		//	echo '<img title="'.$imageId[0]['image'].'" src="'.$useralbumthumburl.$imageId[0]['image'].'" />';
																			if($imageId[0]['image']){
																			echo '<div class="cartImgHolder" title="'.$prodimg['id'].'">	
																				 <span class="delSpan" style="position:absolute;z-index:5000;margin:2px 0px 0px 14px;" ><a class="delCartPhoto" onclick="emptyPhotoFromProd('.$prodimg['id'].','.$tempProduct['id'].')" href="javascript:void(0)" title="Delete from delete list">&nbsp;</a></span>																	
																			 <img title="'.$imageId[0]['image'].'" src="'.$useralbumthumburl.$imageId[0]['image'].'" />
																				</div>';																
																			}else{
																				echo '<div class="cartImgHolder" title="'.$prodimg['id'].'">
																				<img title="'.$imageId[0]['image'].'" src="'.$log->baseurl.'/images/nophoto.png" />
																				</div>';
																			}
																	
																}
																}
																?>
																
																<div class="clearb"></div>	
																</div>									
											</div>	
									<?php } ?>	
									<div class="clearb" style="float: left; width:100%; height: 10px;"></div>
							</div>
						</td>
					<td style="width:350px;" id="containMentDiv" valign="top">
					<div id="collectionImageHolderDrug" style="margin-left:10px" class="leftFloat div100">
					
														<div align="left" class="headerCartProduct" style="width:343px;cursor:move;background:#536B6C;color:white;">
														<span class="leftFloat"><strong>Collection Image</strong></span>
													
														
														<div class="clearb"></div>
														</div>
															
														<div class="cartPhotoHolderDiv"  style="max-height:450px;width:357px;overflow:auto;position:relative;" title="asdfas">
														<?php 
														if(isset($_REQUEST['photosecureemail'])){
															switch ($_REQUEST['loginas']){
																case 0:
																	$result = $log->login(trim($_REQUEST['photosecureemail']),trim($_REQUEST['scode']));
																	if($result==true){
																		//$result = $shDB->select('album');
																		$result = $shDB->select('`album`','album_status',1);
																		if($result){
																			$selectAlbum = $result['records'];
																			$selectAlbumPaging =  $result['pagination'];
																		}
																	}
																	break;
																case 2:
																	$result = $log->login(trim($_REQUEST['photosecureemail']),trim($_REQUEST['scode']));
																	if($result==true){
																		//$result = $shDB->select('album');
																		$result = $shDB->select('`album`','album_status',$status);
																		if($result){
																			$selectAlbum = $result['records'];
																			$selectAlbumPaging =  $result['pagination'];
																		}
																	}
																	break;
																case 3:
																	$selectAlbumByEmail = array(
																	'guest_id' => trim($_REQUEST['photosecureemail']),
																	'isowner' => 1
																	);
																	$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
															   
																	if($selectAlbumByEmail){
																		foreach($selectAlbumByEmail as $selAlbEml ){
																			$selectAlbum = array(
																					'id' => $selAlbEml['album_id'],
																					'securitycode' => $_REQUEST['scode'],
																					'album_status' => 1
																			);
																			$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
																		}
																	}
																	if($selectAlbum){
																		$_SESSION['email'] = $_REQUEST['photosecureemail'];
																		$_SESSION['scode'] = $_REQUEST['scode'];
																		$_SESSION['userlevel'] = $_REQUEST['loginas'];
																	}
																		
																	break;
																default:
																	$selectAlbumByEmail = array(
																	'guest_id' => trim($_REQUEST['photosecureemail']),
																	'isowner' => 0
																	);
																	$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
																	if($selectAlbumByEmail){
																		foreach($selectAlbumByEmail as $selAlbEml ){
																			$selectAlbum = array(
																					'id' => $selAlbEml['album_id'],
																					'securitycode' => $_REQUEST['scode'],
																					'album_status' => 1
																			);
																			$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
																		}
																	}
																	if($selectAlbum){
																		$_SESSION['email'] = $_REQUEST['photosecureemail'];
																		$_SESSION['scode'] = $_REQUEST['scode'];
																		$_SESSION['userlevel'] = $_REQUEST['loginas'];
																	}
																	break;
															}
														}elseif(isset($_SESSION['userid'])){
															if($_SESSION['userlevel']==0){
																 
																//$result = $shDB->select('album');
																$result = $shDB->select('`album`','album_status',1);
																if($result){
																	$selectAlbum = $result['records'];
																	$selectAlbumPaging =  $result['pagination'];
																}
														
															}else{
																/* $result = $shDB->select('album','album_create_by',$_SESSION['userid']);
																if($result){
																	$selectAlbum = $result['records'];
																	$selectAlbumPaging =  $result['pagination'];
																} */
																
																$selectAlbum = array('album_create_by' => $_SESSION['userid'],
																					 'album_status' => 1);
																$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
														
															}
														}else{
															if($_SESSION['userlevel']==3){
																$selectAlbumByEmail = array(
																		'guest_id' => trim($_SESSION['email']),
																		'isowner' => 1
																);
																$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
																if($selectAlbumByEmail){
																	foreach($selectAlbumByEmail as $selAlbEml ){
																		$selectAlbum = array(
																				'id' => $selAlbEml['album_id'],
																				'securitycode' => $_SESSION['scode'],
																				'album_status' => 1
																		);
																		$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
																	}
																}
															}else{
																$selectAlbumByEmail = array(
																		'guest_id' => trim($_SESSION['email']),
																		'isowner' => 0
																);
																$selectAlbumByEmail = $shDB->selectOnMultipleCondition($selectAlbumByEmail,'`album_guest`');
																if($selectAlbumByEmail){
																	foreach($selectAlbumByEmail as $selAlbEml ){
																		$selectAlbum = array(
																				'id' => $selAlbEml['album_id'],
																				'securitycode' => $_SESSION['scode'],
																				'album_status' => 1
																		);
																		$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');
																	}
																}
															}
														}
														 
														
														 
														if($selectAlbum){
															echo '<ul class="cartAlbum" style="margin:2px;padding:0px;">';
															foreach($selectAlbum as $album){
															echo '<li style="clear:both;width:330px;">';
															echo '<h1>'.$album['album_name'].'</h1>';
															echo '<span style="display:block;position:relative;">';
															$albumName = str_replace(' ','_',$album['album_name']);
															$useralbumurl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/';
															$useralbumthumburl = $log->baseurl.'user/profile/'.$album['album_create_by'].'/'.$album['id'].'_'.$albumName.'/thumbs/';
															
															$data = array(
																	'album_id' => $album['id']
															);
																
															$photo = $shDB->selectOnMultipleCondition($data,'album_image');
															 if($photo){?>
																							
																							<?php
																							for($i=0;$i<sizeof($photo);$i++)
																								{	
																									echo '<div class="photoCollectionPhotoDiv" style="display:block;float:left;margin:5px 1px;" title="'.$photo[$i]['image'].'">';
																																
																									echo '<div style="display:block;float:left;margin-left:0px;"><a href="'.$useralbumurl.$photo[$i]['image'].'" class="veryeasylightbox" rel="'.$useralbumurl.$photo[$i]['image'].'" ><div style="height:52px" class="thumbimagediv" id="'.$photo[$i]['id'].'"><img src="'.$useralbumthumburl.$photo[$i]['image'].'" style="height:52px" class="photoThumb" /></div></a></div>';
																									
																									echo '</div>';
																								}
																							
																							?>	
																							<br />
																							
																							
																							<?php }else{?>
																							There is no photo ascociated in this album.
																							<?php } ?>
														<?php 	}
														echo '</span>';
														echo '</li>';
														echo '</ul>';
														}else{ ?>
															<span>You haven't loged in yet. Please login to select image.</span>
														<?php }
														
														?>
														<div class="clearb"></div>	
																						
														</div>	
														</div>
					<script>
					$( "#collectionImageHolderDrug" ).draggable({ axis: 'x' });
					$( "#collectionImageHolderDrug" ).draggable( "option", "axis", 'y' );
					$( "#collectionImageHolderDrug" ).draggable({ handle: '.headerCartProduct' });
					$( "#collectionImageHolderDrug" ).draggable({ containment: '#containMentDiv' });
					$( "#collectionImageHolderDrug" ).draggable( "option", "containment", '#containMentDiv' );

					$( "#collectionImageHolderDrug" ).draggable( "option", "cursor", 'crosshair' );

					// addImageToProduct();
					$( addImageToProduct );
					
					$('.cartAlbum li span').hide('slow');
					$('.cartAlbum li:first span').show('slow');
					
					
					</script>									
					</td>
					</tr>
					</table>		
					</td>
					</tr>					
					<tr><td align="left" colspan="2" style="padding-left:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  class="continue" href="<?php echo $log->baseurl;?>index.php?pg=checkout"></a></td></tr>					
				</table>
				
</td>				
</tr>
</table>
</div>