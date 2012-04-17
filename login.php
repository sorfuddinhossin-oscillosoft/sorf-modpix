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
			<div class="right righthackLogin">
				
				
				
				<div id="inner">
					
					<div class="home_left_style">
					<div class="left_area">
					<div style="background:url('images/icons.png') no-repeat; background-position: 0px 0px; width:42px;">
						<p href="#" style=" display:block; width:26px; height:49px;"></p>
					</div>	
					</div>
					
					<div class="right_area">
					<h1>Login</h1>
					<p>Welcome, please Login to access your Account or view a Photo Collection.</p>
					 <?php echo $loginerrorrrr;?>
					<form name="frm_login" id="frm_login" action="" method="post">
					<div>
					<label>Login as</label><br />
					<input type="radio" name="loginas" value="0">Admin &nbsp;
					<input type="radio" name="loginas" value="2">Photographer &nbsp;
					<input type="radio" name="loginas" value="3">Couple &nbsp;
					<input type="radio" name="loginas" value="4">Guest &nbsp;
					<br />
					<label>Email</label><br />
					<input type="text" name="uname" id="uname" class="input" />
					</div>
					
					<div>
					<label>Password</label><br />
					<input type="password" name="upass" id="upass" class="input" />
					</div>
					
					<div>
					<input type="hidden" name="loginsubmit" value="1">
					<input type="Submit" value="Submit" name="submit">
					<!-- 
					<img src="images/btn_login.png" class="img_input floatleft" />  -->
					&nbsp;<a href="index.php?pg=forgotpassword">Forgot Password ?</a>&nbsp;<a href="index.php?pg=registration">Register New</a>
					</div>
					</form>
					</div>
					</div>
				</div>
				
			</div>
			
		</div>
		<!--end of : page content-->	
	
	</div>