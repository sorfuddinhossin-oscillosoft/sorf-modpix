<?php 
	$selectSettings = array(		
																	'id' => 1
																	);									
										$settings = $shDB->selectOnMultipleCondition($selectSettings,'`settings`');
										$settings = $settings[0];
?>
<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $log->baseurl;?>user/jscalendar/calendar.js"></script>

<!-- language for the calendar -->

<script type="text/javascript" src="<?php echo $log->baseurl;?>user/jscalendar/lang/calendar-en.js"></script>
<!-- Main Calendar CSS file -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $log->baseurl;?>user/jscalendar/calendar-blue.css" title="win2k-cold-1" />
<!-- the following script defines the Calendar.setup helper function, which makes
   adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $log->baseurl;?>user/jscalendar/calendar-setup.js"></script>

<script type="text/javascript">
function call_calendar(text_field,trigger_b)
{
    Calendar.setup({
        inputField     :    text_field,      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    trigger_b,   // trigger for the calendar (button ID)
        doubleClick    :    false,           // double-click mode
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
}
</script>
<!-- js calender ink script close -->
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Site Configuration</td>
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
									if(isset($_REQUEST['editSettings'])){
										
											$updateSettings = array(		
																	'admin_email' => $_REQUEST['adminemail'],
																	'currency' => $_REQUEST['currency'],
																	'ordermessage' => $_REQUEST['albummessage'],
																	'productmessage' => $_REQUEST['productmessage'],											
																	'cartordermessage' => $_REQUEST['cartordermessage']											
																	);
										$res = $shDB->update($updateSettings,1,'settings');
										if($res){
											echo '<p class="greenMessage">Edit successful. <a href="'.$log->baseurl.'user/index.php?pg=siteconfig">Refresh page</a></p>';
										}							
									}else{?>		
																					
								<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="albumAddForm" id="photocollectionform">
									<label>Admin Email</label>
									<input class="mandatory" type="text" name="adminemail" value="<?php echo $settings['admin_email'];?>"><br />
									<label>Currency</label>
									<input class="mandatory" type="text" name="currency" value="<?php echo $settings['currency'];?>"><br />
									<label>Album Order Message</label>
									<textarea name="albummessage" id="albummessage" style="height:110px; width:97%;"><?php echo $settings['ordermessage'];?></textarea>
									<label>Product Order Message</label>
									<textarea name="productmessage" id="productmessage" style="height:110px; width:97%;"><?php echo $settings['productmessage'];?></textarea>
									<label>Cart Order Message</label>
									<textarea name="cartordermessage" id="cartordermessage" style="height:110px; width:97%;"><?php echo $settings['cartordermessage'];?></textarea>
									
									<input type="Submit" Value="Update" name="editSettings" id="editSettingsButton">
									
								</form>
								<?php } ?>
							</div>
						</div>
						</td>
					</tr>										
				</table>			
			
			</div>
		</div>
	</div>
</div>