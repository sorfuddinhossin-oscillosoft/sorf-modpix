<?php
include_once '../class/dbclass.php';
$shDB =new sh_DB();
/*
	$data = array(		
					'album_id' => $_REQUEST['id']
					);									
		$guest = $shDB->selectOnMultipleCondition($data,'album_guest');
		*/
		$guest = $shDB->selectWithoutPaging('album_guest','album_id',$_REQUEST['id']);
		
								if($guest){
								foreach($guest as $gst){
									$bgcolor = '#FFF';
									if($gst['isowner']==1){
										$bgcolor = '#CCCC99';
									}else{
										if($gst['notified']==1){
											$bgcolor = '#DAC0C0';
										}else{
											$bgcolor = '#FFF';
										}
									}
									
									?>
									
									<div class="leftFloat div100 rounded5box" id="tempGuestEmailId<?php echo $gst['id']?>" style="background:<?php echo $bgcolor;?>">
										<div align="left" class="leftFloat div94Padless">
										<span class="leftFloat">
										<div style="width:20px;display:block;height:12px;float:left;">
										<?php if($gst['isowner']==0){ ?>
											
										<input type="checkbox" value="<?php echo $gst['id']?>" name="userid[]">
									
										<?php } ?>
										</div>
										&nbsp;<?php echo $gst['guest_id']; ?>
										<?php if($gst['isowner']==1){?>
											<span style="color:green;font-size:10px;">&nbsp;(Owner)</span>
										<?php } ?>
										</span>
										<?php if($gst['isowner']==0){?>
										<span class="rightFloat">
										
										<a class="del" rel="<?php echo $gst['id']?>">x</a>
										<!-- 
										<a id="addGuestIdAnchor<?php echo $gst['id']?>" title="Add to album guest" href="javascript:" onclick="addTempGuestId(<?php echo $gst['id']?>,<?php echo $_REQUEST['id'];?>,<?php echo $gst['id']; ?>);" class="tickRowBtn">&nbsp;</a>
										 -->
										</span>
										<?php } ?>
										</div>
										</div>	
										<?php  
									}
								
								}
?>
<script>
$(document).ready(function() {
	/*
	 $(document).bind("contextmenu",function(e){
	        return false;
	    });
	   */
	
	$('.del').click(function(){
	var id = $(this).attr('rel');
	if(id!=''){
		delByIdTempGuest(id,'album_guest');		
	}
	});
})
</script>