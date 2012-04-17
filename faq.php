<?php 
$cmsdata = array('id' => 3);
$cms_pages = $shDB->selectOnMultipleCondition($cmsdata,'cms_pages');
?>
<h1 class="pagetitle">Frequently Ask Question(FAQ)</h1>
<div class="webcontent">
<?php echo $cms_pages[0]['pg_content'];?>
</div>