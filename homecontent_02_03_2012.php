<div id="content">
		<!--page content-->	
		<div id="homecontent_inner_container">
		<img style="margin-left: 63px;   margin-top: 392px; position: absolute;" src = "images/service.png" alt="Online Photo Album > Framing
Hosting > Printing Service
Photographer > Gifts">
		<div id="content_inner">
			<div id="left" style="display:none">
				<div id="inner">
					
					<div class="home_left_style">
					<div class="left_area">
					<div style="background:url('images/icons.png') no-repeat; background-position: 0px 0px; width:42px;">
						<p href="#" style=" display:block; width:26px; height:49px;"></p>
					</div>	
					</div>
					
					<div class="right_area">
					<h1>Couple Login / Guest Login</h1>
					<p>Login, sothat you can access your album uploaded by your photographer or your friends.</p>
					<form name="frm_login" id="frm_login" action="" method="post">
					<div>
					<label>Email</label><br />
					<input type="text" name="uname" id="uname" class="input" />
					</div>
					
					<div>
					<label>Password</label><br />
					<input type="text" name="upass" id="upass" class="input" />
					</div>
					
					<div>
					<img src="images/btn_login.png" class="img_input floatleft" /> &nbsp;<a href="index.php?pg=forgotpassword">Forgot Password ?</a>&nbsp;<a href="index.php?pg=registration">Register New</a>
					</div>
					</form>
					</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="right">
		<div id="gallery1" style="display: block; height: 52px;margin-left: -46px;overflow: hidden;width: 486px;border:2px solid white;border-bottom:0px;">
		 <a href="<?php echo $log->baseurl?>/index.php?pg=inquiry&tab=photographyweddingpackage" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>images/wedding_packaging.jpg"/>
										</a>
		</div>
			<div id="gallery" style="display: block; height: 423px;margin-left: -46px;overflow: hidden;width: 486px;border:2px solid white;">
							 <a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/2_Preview_Booklets/02.jpg"/>
										</a>
							<a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/19_Modpix_Wedding_Package/coverAndSpread.jpg"/>
										</a
<a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/19_Modpix_Wedding_Package/Photobook%20Group.jpg"/>
										</a>
										<a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/3_Framing/01.jpg" />
										</a>
										<a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/6_Tuscany/01.jpg"/>
										</a>
										<a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/4_Gallery_Cluster_Wraps/01.jpg"/>
										</a>
										<a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/6_Nexus/01.jpg"/>
										</a>
										<a href="#" style="clear:both">
									<img title="" alt="" rel="" src="<?php echo $log->baseurl?>user/product/5_Metal_Prints/01.jpg"/>
										</a>
							  
							  <div class="caption"><div class="content"></div></div>
					 </div>
					 <script>
							  $(document).ready(function(){	
								  slideShow();
								});
							  </script>
			</div>
			<div class="right" style="clear:right;margin-right:56px">
			
					<div class="home_right_style">
					<div class="left_area">
					<div style="background:url('images/icons.png') no-repeat; background-position: -45px 0px; width:52px;">
						<p href="#" style=" display:block; width:42px; height:49px;"></p>
					</div>	
					</div>
					
					<div class="right_area">
					
					<h1>Photo Search</h1>
					<p>Locate your photos by entering in any part of your event information below - </p>
					<form name="frm_search" id="frm_search" method="post" action="<?php echo $log->baseurl?>index.php?pg=photosearch">
					<div>
					<input type="text" name="q" id="" class="input" />
					</div>
					
					<div>
					<img src="images/btn_search.png" onclick=" formSubmit('frm_search');" class="img_input" />
					</div>
					</form>
					</div>
			</div>
		</div>
		</div>
		<!--end of : page content-->	
	
	</div>