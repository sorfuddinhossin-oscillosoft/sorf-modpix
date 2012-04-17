<?php 
include_once '../class/dbclass.php';
$shDB =new sh_DB();
							$dataSelectGuestEmail = array(		
									'id' => $_REQUEST['id']									
								);		
								$guest = $shDB->selectOnMultipleCondition($dataSelectGuestEmail,'album_guest');
								$gst = $guest[0];
?>
									<label>Name:</label><br />							
							<?php echo $gst['name'];?><br />
							<label>Phone</label><br />
						<?php echo $gst['phone'];?><br />
							<label>Fax</label><br />
							<?php echo $gst['fax'];?><br />
							
							<label>Address</label><br />
							<?php echo $gst['address'];?><br />
							
							<label>Zip</label><br />
							<?php echo $gst['zip'];?><br />
							<label>City</label><br />
							<?php echo $gst['city'];?><br />
							<label>Country</label><br />
							<?php echo $gst['country'];?><br />	