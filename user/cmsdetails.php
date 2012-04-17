<?php 
$cmsdata = array('id' => $_REQUEST['id']);
$cms_pages = $shDB->selectOnMultipleCondition($cmsdata,'cms_pages');
$cmsDetails = $cms_pages[0];
?>
<div id="rightContent">
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
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="javascript: history.back(1);" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>	
			</div>
			<div class="leftFloat div100" style="overflow: auto;">
				<table cellpadding="3" cellspacing="0" style="width:98%;">
					<tr>
						<td align="left" class="tableHeader" >Page Name: <?php echo $cms_pages[0]['pg_name'];?></td>
					</tr>
					<tr>
						<td align="left" style="padding-left:2%; border-bottom:dotted #CCCCCC 1px;"><?php echo $cms_pages[0]['pg_content'];?></td>
					</tr>											
				</table>
			</div>
		</div>
	</div>
</div>
