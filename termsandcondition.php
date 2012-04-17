<?php 
$cmsdata = array('id' => 2);
$cms_pages = $shDB->selectOnMultipleCondition($cmsdata,'cms_pages');
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<h1 class="pagetitle">Competition Terms & Conditions</h1>
<div class="webcontent">
<?php echo $cms_pages[0]['pg_content'];?>
</div>