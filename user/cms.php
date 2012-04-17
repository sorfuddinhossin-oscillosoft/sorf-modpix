<?php 
 $cms_pages = $shDB->select('cms_pages');
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="rightFloat"><a title="Add New" href="<?php echo $log->baseurl;?>user/index.php?pg=addcms" class="addNew">Add New</a></div>
		
	</div>
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="coupleListIcon">&nbsp;</div></td><td>CMS Pages</td>
						</th>
					</table>
				</div>	
			</div>
			<div class="leftFloat div100">
				<table cellpadding="3" cellspacing="0" style="width:100%;">
					<tr>
						<td align="left" class="tableHeader" >Page Name</td>
						<td align="left" class="tableHeader" >Action</td>
					</tr>					
					<?php
					foreach ($cms_pages['records'] as $cms_page){
					?>
					<tr>
						<td align="left" style="padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><?php echo $cms_page['pg_name'];?></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;">
						<a title="Page Details" href="<?php echo $log->baseurl;?>user/index.php?pg=cmsdetails&id=<?php echo $cms_page['id'];?>" class="detailsRowBtn">&nbsp;</a>&nbsp;
						<a title="Edit Records" href="<?php echo $log->baseurl;?>user/index.php?pg=editcms&id=<?php echo $cms_page['id'];?>" class="editRowBtn">&nbsp;</a>&nbsp;
						</td>
					</tr>
					<?php
					}
					?>	
					<tr>
						<td align="center" colspan="4">
							<?php echo $product['pagination']?>
						</td>
					</tr>											
				</table>
			</div>
		</div>
	</div>
</div>
