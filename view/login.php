<?php if(!isset($_SESSION['id'])): ?>
		<h2 class="regular">Be the first to know when our  <span class="kosmeyin"><span class="kosred">K</span><span class="kosgrey">o</span><span class="kosblue">s</span>meyin</span> <br>
			  shop is launched!  Register now!</h2>
		<div class="adTable">
		  <div class="adTableRow">
			<div class="adTableCell">        
			  <form name="form2" method="post" action="<?=SERVER_URL?>?validatelogin" class="registerForm" id="loginForm">
				<p>
				  <label for="username">用户名</label>
				  <input type="text" name="username" id="username" value="<?=!empty($_POST['popusername']) ? $_POST['popusername'] : ""?>" />
				  
				</p>
				<p>
				  <label for="password">请输入密码</label>
				  <input type="password" name="password" id="password">
				</p>
				<p>
				  <label for="button2"></label>
				  <input type="submit" name="button2" id="button2" class="registerBtn" value="登录">
				</p>
				<?php if(isset($_GET['error'])): ?>
					<p><small class="kosgrey2" style="color:#f00; font-size:12px;">Invalid username/password.
					<a href="<?=SERVER_URL?>?forgotpassword">Forgot password?</a></small></p>
				<?php endif; ?>
			  </form>
			 
			</div>
			<!--<div class="adTableCell smallWords">
			  
			  <h3 class="sideBar">OR</h3>
			</div>
			<div class="adTableCell sideBar250">
			  <h3 class="sideBar">Sign in using
				another account</h3>
			  <p style="text-align:center"><img src="images/qqBtn.png" width="172" height="46"></p>
			  <p style="text-align:center"><img src="images/btnWiebo.png" width="172" height="63"></p>
			  <p style="text-align:center">Use your QQ or Weibo account to sign up
			  at Kosmeyin.  It's quick and easy!</p>          
			</div>-->
		  </div>
		</div><!--adTable--><!--adTable-->
<?php else: ?>
		<div style="position:relative; overflow: hidden; width:auto; height:auto; padding:10px; ">
			<div style="position:relative; overflow: hidden; width:900px; height:auto; padding:20px; border:1px solid #DDD; background-color:lemonchiffon;">
				<span style="font-size:12px;">You are already login. Click <a href="<?SERVER_URL?>?invite-a-friend">here</a> to invite your friend.</span>
			</div>
		</div>
<?php endif; ?>

