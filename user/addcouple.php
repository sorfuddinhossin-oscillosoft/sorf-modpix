<div id="rightContent">
	<div class="rightContentDiv">
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="addCoupleIcon">&nbsp;</div></td><td>Add a New Couple</td>
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
						We don't take photos just so later they will be forgotten on a disc or in a folder. These memories need to be shared and enjoyed, displayed, on a holiday card, under a gallery light or in a wedding album.
						</td>
					</tr>
					<tr>
						<td align="left">
						<h1>Couple Registration</h1>
						<div class="content">
							<div>
								<?php
									if(isset($_REQUEST['registration'])){
										$result = $log->registration();
										if($result==true){
											echo '<div class="messSuccess">Registration Successfull.</div>';
										}
										else{
											echo '<div class="messError">Error in registration process.</div>';
										}
									} 
								
								if(!isset($_REQUEST['registration'])){								
								?>		
								<div class="formGuide">
									<ul>
										<li class="optional">Optional</li>
										<li class="mandatory">Mandatory</li>
										<li class="duplicate">Duplicate</li>
									</ul>
								</div>														
								<form action="" method="POST" enctype="application/x-www-form-urlencoded" name="refForm">
									<label>First Name</label><br />
									<input class="mandatory" type="text" name="fname"><br />
									<label>Last Name</label><br />
									<input type="text" name="lname"><br />
									<label>Address</label><br />
									<input class="mandatory" type="text" name="address"><br />
									<label>Address Line Two</label><br />
									<input type="text" name="addresstwo"><br />
									<label>Phone</label><br />
									<input type="text" name="phone"><br />
									<label>Email</label><br />
									<input class="mandatory" type="text" name="email"><br />
									<label>Zip Code</label><br />
									<input type="text" name="zip"><br />
									<label>City</label><br />
									<input type="text" name="city"><br />
									<label>Country</label><br />
									<input type="text" name="country"><br />
									<label class="blue">Password</label><br />
									<input class="duplicate" type="password" name="password"><br />
									<label class="blue">Retype Password</label><br />
									<input class="duplicate" type="password" name="confirmpass"><br />
									<input type="Submit" Value="Submit" name="registration">
									<input type="reset" Value="Reset">
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
