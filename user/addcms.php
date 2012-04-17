<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Add a New Page</td>
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
						<h1>Add a New Page</h1>
						
						<div class="content">
							<div>
								<?php
									if(isset($_REQUEST['page_name'])){
										$data = array('pg_name' => trim($_REQUEST['page_name']));									
										$isExist = $shDB->selectOnMultipleCondition($data,'cms_pages');
										if($isExist==false){
											
											$data = array('pg_name' => trim($_REQUEST['page_name']),
														  'pg_content' => trim($_REQUEST['pg_content']));
									
										$csmresult = $shDB->insert($data,'cms_pages');	
						
										
										if($csmresult==true){
											echo '<div class="messSuccess">New Page Added Successfully.</div>';
										}
										else{
											echo '<div class="messError">Error in New Page addition.</div>';
										}
									}
								}

								if(!isset($_REQUEST['addCMSBtn'])){									
								?>		
								<form action="" method="POST" enctype="multipart/form-data" name="addCMSPage" id="addCMSPage">
									<label>Page Name</label>
									<input class="mandatory" type="text" name="page_name"><br />
									<br />	
									<label>Page Content</label>
									<textarea class="ckeditor" type="text" name="pg_content" style="width:366px; height:70px;"></textarea><br />
									<input type="button" Value="Submit" name="addCMSBtn" id="addCMSBtn">
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