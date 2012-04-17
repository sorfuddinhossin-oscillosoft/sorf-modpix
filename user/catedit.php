<?php 
$selectCatById = array(		
							'id' => $_REQUEST['id']
							);									
$category = $shDB->selectOnMultipleCondition($selectCatById,'`product_cat`');
$category = $category[0];
$no = '';
$yes = '';
if($category['isalbum']==0){
	$no = 'checked';
}else {
	$yes = 'checked';
}
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="coupleListIcon">&nbsp;</div></td><td>Edit - <?php echo $category['name'];?></td>
						</th>
					</table>
				</div>
				<!--
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="#" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>	
				-->			
			</div>
			<div class="leftFloat div100">
				<div style="padding:20px;">
				<?php 
				if(isset($_REQUEST['catid'])){
																				
										$data = array(
										'name' => trim($_REQUEST['categoryName']),
										'isalbum' => trim($_REQUEST['isalbum'])
									);
									
									$catresult = $shDB->update($data,$_REQUEST['catid'],'product_cat');	
						
										
										if($catresult==true){
											
											
											echo '<div class="messSuccess">Product Category Edited Successfully.</div>';
											echo '<script>history:back(-1);</script>';
										}
										else{
											echo '<div class="messError">Error in product category edit.</div>';
										}
									}
				?>
				<form action="" method="POST" enctype="multipart/form-data" name="addCategoryForm" id="addCategoryForm">
									<label>Category Name</label><br />
									<input class="mandatory" type="text" name="categoryName" value="<?php echo $category['name'];?>"><br />
									<label>Is album type?</label><br />
									<input type="radio" name="isalbum" value="0" <?php echo $no;?>> No &nbsp;<input type="radio" name="isalbum" value="1" <?php echo $yes;?>> Yes &nbsp;<br />
									<input type="hidden" value="<?php echo $category['id'];?>"	 name="catid">						
									<input type="button" Value="Continue" name="addCategoryBtn" id="addCategoryBtn">
									<input type="button" Value="Cancel" onclick="history:back(-1);">
								</form>
				</div>
			</div>
		</div>
	</div>
</div>
