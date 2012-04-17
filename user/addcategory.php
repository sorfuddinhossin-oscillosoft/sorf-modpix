<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Add a New Category</td>
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
				<table cellpadding="5" cellspacing="0" style="width:100%; padding-left:10px; padding-right:10px;">
					<tr>
						<td align="left">
						We don't take photos just so later they will be forgotten on a disc or in a folder. These memories need to be shared and enjoyed, displayed, on a holiday card, under a gallery light or in a wedding album.
						</td>
					</tr>
					<tr>
						<td align="left">
						<h1>Add a New Product Category</h1>
						
						<div class="content">
							<div>
								<?php
									if(isset($_REQUEST['categoryName'])){
										$data = array(
											'name' => trim($_REQUEST['categoryName'])																				
											);									
										$isExist = $shDB->selectOnMultipleCondition($data,'product_cat');
																		

										if(!$isExist){
										$data = array(
											'id' => '',										
											'name' => trim($_REQUEST['categoryName']),
											'isalbum' => trim($_REQUEST['isalbum'])
											);
									
											$catresult = $shDB->insert($data,'product_cat');	
								
												
												if($catresult==true){
													
													
													echo '<div class="messSuccess">Product Category Added Successfully.</div>';
												}
												else{
													echo '<div class="messError">Error in product category addition.</div>';
												}
											}
								
									}
								if(!isset($_REQUEST['addCategoryBtn'])){	
									
																		
								?>		


								<form action="" method="POST" enctype="multipart/form-data" name="addCategoryForm" id="addCategoryForm">
									<label>Category Name</label><br />
									<input class="mandatory" type="text" name="categoryName"><br />
									<label>Is album type?</label><br />
									<input type="radio" name="isalbum" value="0" checked> No &nbsp;<input type="radio" name="isalbum" value="1"> Yes &nbsp;<br />
																	
									<input type="button" Value="Continue" name="addCategoryBtn" id="addCategoryBtn">
									<input type="reset" Value="Cancel">
								</form>
								<?php } ?>
								<script>
							
									CKEDITOR.replace( 'summery',
											{
												toolbar : 'Full'
											});
								</script>
							</div>
						</div>
						</td>
					</tr>										
				</table>			
			
			</div>
		</div>
	</div>
</div>