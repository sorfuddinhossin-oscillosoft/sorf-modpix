<div id="content">
		<!--page content-->	
		<div id="content_inner_container">
		<img style="margin-left: 63px;   margin-top: 92px; position: absolute;" src = "images/service.png" alt="Online Photo Album > Framing
Hosting > Printing Service
Photographer > Gifts">
		<div id="content_inner">
			<div id="left" style="display:block">
				
			</div>
			
		</div>
			<div class="right">
				
				
				
				<div id="inner">
					
					<div class="home_left_style">
					<div class="left_area">
					<div style="background:url('images/icons.png') no-repeat; background-position: 0px 0px; width:42px;">
						<p href="#" style=" display:block; width:26px; height:49px;"></p>
					</div>	
					</div>
					
					<div class="right_area">
					<h1>Retrieve Password</h1>
					<p>Please enter your id(Email) to retrieve the password. Password will send to your email address.</p>
					<?php
					if(isset($_REQUEST['postUserEmail'])){
												
					$result = $log->passwordreset($_REQUEST['postUserEmail'], '', '','');
					if($result==true){
						echo "Your password is reset. Please check your email for the new password.";
					}else{
						echo "Can't reset your password now. Please try later";
					}
					
					
					}else{
			  ?>
			  	<form name="forgotPassword" method="post"  action="">
			  	<div><label for="username">Put your email address that you use for login.</label><br />
				<input name="postUserEmail" id="postUserEmail" type="text">
				<div>
				<input value="Retrieve Password" type="submit">
				</div>
				</div>
				</form>
				<?php } ?>	
				
					</div>
					</div>
				</div>
				
			</div>
			
		</div>
		<!--end of : page content-->		
	</div>