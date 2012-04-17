<?php 
$cmsdata = array('id' => 1);
$cms_pages = $shDB->selectOnMultipleCondition($cmsdata,'cms_pages');
?>
<h1 class="pagetitle">Who we are?</h1>
<div class="webcontent">
<table width="100%">
<tr>
<td>
<?php echo $cms_pages[0]['pg_content'];?>
</td>	
</tr>
</table>
</div>