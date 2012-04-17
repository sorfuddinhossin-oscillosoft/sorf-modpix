<?php 
$cmsdata = array('id' => $_REQUEST['id']);
$cms_pages = $shDB->selectOnMultipleCondition($cmsdata,'cms_pages');
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Edit CMS Page</td>
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
						<div class="content">
							<div>
								<?php
								
								
									if(isset($_REQUEST['page_name'])){											
										$data = array('pg_name' => trim($_REQUEST['page_name']),
													  'pg_content' => trim($_REQUEST['pg_content']));
									
										$result = $shDB->update($data,$_REQUEST['cms_id'],'cms_pages');
										if($result==true){
											echo '<div class="messSuccess">You have updated CMS page Successfully.</div>';
										}
										else{
											echo '<div class="messError">Error in update Page addition.</div>';
										}
								}
								if(!isset($_REQUEST['submit'])){									
								?>		
								<form action="" method="POST" enctype="multipart/form-data" name="addCMSPage" id="addCMSPage">
									<input type="hidden" name="cms_id" value="<?php echo $cms_pages[0]['id'];?>">
									<label>Page Name</label>
									<input class="mandatory" type="text" name="page_name" value="<?php echo $cms_pages[0]['pg_name'];?>"><br />
									<br />	
									<label>Page Content</label>
									<textarea class="ckeditor" type="text" name="pg_content" style="width:366px; height:70px;"><?php echo $cms_pages[0]['pg_content'];?></textarea><br />
									<input type="submit" Value="Update" name="submit" id="submit">
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