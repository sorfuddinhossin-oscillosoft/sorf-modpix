<?php
	if(isset($_REQUEST['isphotosubmitted'])){	
		$imgArray = reArrayFiles($_FILES["photoFile"]);
		$sort_orders=$_POST['sort_order'];
		$destination_path = $_SERVER['DOCUMENT_ROOT'].'/images/home_page_slider_images/';
		
		foreach ($imgArray as $k=>$img){
			//$randomNum=
			$randomNum=rand(0000, 9999);
			$image_name=$randomNum."_".str_replace(' ','_',$img['name']);
			if($sort_orders[$k] !=""){
				$sort_order=$sort_orders[$k];
			}else{
				$qry = 'select MAX(sort_order) as sort_order from home_page_slider_images';
				$query = $shDB->qry($qry); 
				$results=mysql_fetch_array($query);
				$sort_order=$results['sort_order']+1;
			}
			$targetpath = $destination_path.$image_name;
			if(@move_uploaded_file($img['tmp_name'], $targetpath)){
					$datainsert = array('image_name' => $image_name,
										'sort_order' => $sort_order);
					$imageResult = $shDB->insert($datainsert,'home_page_slider_images');							
			}					
		}
	}
	$msg='';
	if(isset($_REQUEST['updateOrder']) && ($_REQUEST['updateOrder'] == 'Update Order')){
		$image_ids=$_POST['image_id'];
		$update_orders=$_POST['update_order'];
		foreach($image_ids as $k=>$image_id){
			$dataUpdate=array('sort_order'=>$update_orders[$k]);
			$result = $shDB->update($dataUpdate,$image_id,'home_page_slider_images');
		}
		if($result==true){
			$msg='<div class="messSuccess">You have been Successfully updated images order.</div>';
		}
		else{
			$msg='<div class="messError">Error in update Image order.</div>';
		}
	}
	
	$qry = 'select * from home_page_slider_images order by sort_order ASC';
	$query = $shDB->qry($qry); 
	$imageDatas=array();
	while($results=mysql_fetch_array($query)){
		$imageDatas[]=$results;
	}
	
?>		

<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Home Page Slider Show</td>
						</th>
					</table>
				</div>
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="javascript: history.back(1);" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>		
			</div>
			<div class="leftFloat div100">
				<table cellpadding="5" cellspacing="0" style="width:60%; padding-left:10px; padding-right:10px;">
					<tr>
						<td align="left" valign="top">
							<div class="content">
								<div>	
									<form action="" method="POST" enctype="multipart/form-data" name="sliderAddForm" id="sliderAddImgForm">
										<label>Upload New Image(s)</label><br />
										Image: &nbsp;<input class="mandatory" type="file" name="photoFile[]" style="width: 190px; border: 1px solid #999999;" />&nbsp;Sort Order: &nbsp;<input type="text" name="sort_order[]" value="" style="width: 20px;height: 8px;"/>
										<span id="uploadStatus">
										  <img style="margin-top:10px;margin-left:0px;display:none" src="<?php echo $log->baseurl;?>/images/ajax-loader.gif">
										</span><br />
										<input type="hidden" name="isphotosubmitted" value="1">
										<div style="float: left;margin-left: 30px;">
											<input type="button" value="Add More" style="float:left;margin:10px 10px; 20px 140px;" class="none" id="addMoreImageToSlider">
											<input type="button" Value="Submit" name="addPhotoBtn" id="addPhotoTohSlider">
										</div>
										<div style="float: left; clear: both; font-weight: bold;">
											N.B: Please Upload images with 486 x 423.
										</div>
									</form>					
								</div>
							</div>
						</td>
					</tr>										
				</table>
				<form action="" method="POST" enctype="multipart/form-data">
					<table cellpadding="5" cellspacing="0" style="width:70%; padding-left:10px; padding-right:10px;">
						<?php if($msg !=""){ ?>
						<tr>
							<td colspan="3" align="center" style="padding-bottom: 6px;"><?php echo $msg;?></td>
						</tr>
						<?php } ?>
						
						<?php if(isset($_REQUEST['msg']) && $_REQUEST['msg'] =="success"){ ?>
						<tr>
							<td colspan="3" align="center" style="padding-bottom: 6px;"><div class="messSuccess">You have been Successfully deleted the selected image.</div></td>
						</tr>
						<?php } ?>
						
						
						<tr>
							<td colspan="3" align="right" style="padding-bottom: 6px;"><input type="submit" Value="Update Order" name="updateOrder"></td>
						</tr>
						
						
						<tr>
							<td class="tableHeader">Images</td>
							<td class="tableHeader">Sort Order</td>
							<td class="tableHeader">Action</td>
						</tr>
						<?php foreach($imageDatas as $imageData){?>
						
							<tr>
								<td style="border-bottom:dotted #CCCCCC 1px;">
									<input type="hidden" name="image_id[]" value="<?php echo $imageData['id']?>">
									<img src="<?php echo $log->baseurl;?>/images/home_page_slider_images/<?php echo $imageData['image_name']?>" width="150">
								</td>
								<td style="width:33%; border-bottom:dotted #CCCCCC 1px;">
									<input type="text" name="update_order[]" value="<?php echo $imageData['sort_order']?>"  style="width: 40px;"/>
								</td>
								<td style="border-bottom:dotted #CCCCCC 1px;">
									<a title="Delete Image" href="#" rel="<?php echo $imageData['id']?>" class="deleteRowBtn">&nbsp;</a>
								</td>
							</tr>
						<?php }?>
							<tr>
								<td colspan="3" align="right" style="padding-bottom: 30px;"><input type="submit" Value="Update Order" name="updateOrder"></td>
							</tr>
					</table>				
				</form>
			</div>
		</div>
	</div>
</div>