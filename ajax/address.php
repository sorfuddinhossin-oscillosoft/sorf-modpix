<?php 
include_once '../class/dbclass.php';
include_once '../class/class.login.php';
$shDB =new sh_DB();
$item = $_REQUEST['item'];
$table = $_REQUEST['item'].'_address';
															$data = array(		
																'email' => $_SESSION['email']
															);									
															$Address = $shDB->selectOnMultipleCondition($data,$table);
															
															$Address = $Address[0];
															?>
														<div id="<?php echo $item;?>Form" style="display:none">
																<label>Company</label><br />
																<input type="text" id="<?php echo $item;?>_company" value="<?php echo $Address['company']?>"><br />
																<label>Full Name</label><br />
																<input type="text" id="<?php echo $item;?>_name" value="<?php echo $Address['name']?>"><br />
																<label>Address</label><br />
																<textarea style="width:298px;" id="<?php echo $item;?>_address" ><?php echo $Address['address']?></textarea><br />
																<label>Phone</label><br />
																<input type="text" id="<?php echo $item;?>_phone" value="<?php echo $Address['phone']?>"><br />
																<label>Fax</label><br />
																<input type="text" id="<?php echo $item;?>_fax" value="<?php echo $Address['fax']?>"><br />
																<label>Email</label><br />
																<input type="text" id="<?php echo $item;?>_email" value="<?php echo $Address['email']?>"><br />
																<label>Zip</label><br />
																<input type="text" id="<?php echo $item;?>_zip" value="<?php echo $Address['zip']?>"><br />
																<label>City</label><br />
																<input type="text" id="<?php echo $item;?>_city" value="<?php echo $Address['city']?>"><br />
																<label>Country</label><br />
																<input type="text" id="<?php echo $item;?>_country" value="<?php echo $Address['country']?>"><br />
														</div>	
														<div id="<?php echo $item;?>Details">
														<strong>Company</strong><br />
																<?php echo $Address['company']?><br />
																<strong>Full Name</strong><br />
																<?php echo $Address['name']?><br />
															<strong>Address</strong><br />
																<?php echo $Address['address']?><br /><?php echo $Address['city']?> - <?php echo $Address['zip']?><br /><?php echo $Address['city']?>, <?php echo $Address['country']?><br />
																<strong>Phone</strong><br />
																<?php echo $Address['phone']?><br />
															<strong>Fax</strong><br />
																<?php echo $Address['fax']?><br />
																<strong>Email</strong><br />
																<?php echo $Address['email']?><br />
													</div>	
													<div class="clearb"></div>