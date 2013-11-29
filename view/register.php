<?php if(!isset($_SESSION['id'])): ?>
	<!--<h2 class="regular">Be the first to know when our  <span class="kosmeyin"><span class="kosred">K</span><span class="kosgrey">o</span><span class="kosblue">s</span>meyin</span> <br>
		  shop is launched!  Register now!</h2>-->
	<h2 class="regular">快来注册做个IN GIRL，马上开始赚取K币积分！</h2
	<div class="adTable">
	  <div class="adTableRow">
		<div class="adTableCell">
		<small>请填下你的资料注册会员开始积K币！</small>		
		  <form method="post" action="<?=SERVER_URL."?registeruser"?>" class="registerForm" id="registerForm">
			<p>
			  <label for="username">用户名</label>
			  <?php
					$username = null;
					if(!empty($_POST['popusername'])) {
						$username = $_POST['popusername'];
					} else {
						 $username = !empty($_SESSION['username_data']) ? $_SESSION['username_data'] : '';
					}
			  ?>
			  <input type="text" name="username" id="username" value="<?=$username?>" />&nbsp;*
			  <?php echo !empty($_SESSION['username_error']) ? $_SESSION['username_error'] : ''; ?>
			</p>
			<p>
			  <label for="password">请输入密码</label>
			  <input type="password" name="password" id="password">&nbsp;*
			  <?php echo !empty($_SESSION['password_error']) ? $_SESSION['password_error'] : ''; ?>
			</p>
			<p>
			  <label for="password_confirm">请确认密码</label>
			  <input type="password" name="password_confirm" id="password_confirm">&nbsp;*
			</p>
			<p>
			  <label for="email">邮箱地址</label>
			  
			  <?php
				/*$email = !empty($_POST['popemail']) ? $_POST['popemail'] : 
						 !empty($_SESSION['email_data'])  ? $_SESSION['email_data'] : '';*/
				  $email = null;
				  if(!empty($_POST['popemail'])) {
					$email = $_POST['popemail'];
				  } else {
					$email = !empty($_SESSION['email_data'])  ? $_SESSION['email_data'] : '';
				  }
			  ?>
			  <input type="text" name="email" id="email" value="<?=$email?>" />&nbsp;*
			  <?php echo !empty($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>
			</p>
			<p class="radioBtn"><label>性别</label>
			  <input type="radio" name="gender" id="male" value="male" checked="check">
			  <label for="male">Male</label> 
			  <input type="radio" name="gender" id="female" value="female">
			  <label for="female">Female</label>
			</p>
			<p>			
			  <label for="select">出生日期</label>
			  <select name="year" id="year">
				<?php if(empty($_SESSION['year_data'])) { ?><option value="">Year:</option> <?php } ?>				
				<?php for($counter=2012; $counter>=1905; $counter--): ?>					
						<?php if(!empty($_SESSION['year_data']) && (intval($_SESSION['year_data']==$counter))): ?>
								<option selected="selected"><?=$counter?></option>					
						<?php else: ?>
								<option><?=$counter?></option>	
						<?php endif; ?>
				<?php endfor; ?>
			  </select>			  
			  <select name="month" id="month">	
			  <?php 
				$months = array( "Jan"=>"01", "Feb"=>"02", "Mar"=>"03", "Apr"=>"04", "May"=>"05", "Jun"=>"06", "Jul"=>"07", 
									"Aug"=>"08", "Sep"=>"09", "Oct"=>"10", "Nov"=>"11", "Dec"=>"12" );
			  ?>				
				<?php if(empty($_SESSION['month_data'])) { ?><option value="">Month:</option> <?php } ?>	
				<?php foreach($months as $key => $month): ?>
						<?php if(!empty($_SESSION['month_data']) && (intval($_SESSION['month_data']==$month))): ?>
								<option value="<?=$month?>" selected="selected"><?=$month?></option>					
						<?php else: ?>
								<option value="<?=$month?>"><?=$key?></option>
						<?php endif; ?>				
				<?php endforeach; ?>
			  </select>
			  <select name="date" id="date">										
				<?php if(empty($_SESSION['date_data'])) { ?><option value="">Date:</option> <?php } ?>	
				<?php for($counter=1; $counter<=31; $counter++): ?>
						<?php if(!empty($_SESSION['date_data']) && (intval($_SESSION['date_data']==$counter))): ?>
								<option selected="selected"><?=$counter?></option>					
						<?php else: ?>
								<option><?=$counter?></option>	
						<?php endif; ?>
				<?php endfor; ?>
			  </select>			
			</p>
			<p>
			  <label for="phone">电话号码</label>
			  <?php $phone = !(empty($_SESSION['phone_data'])) ? $_SESSION['phone_data'] : ''; ?>
			  <input type="text" name="phone" id="phone" value="<?=$phone?>" />
			</p>
			<div style="float:right; width:320px; position:relative; overflow:hidden; margin-right:30px;">				
				<div style="float:left;"><img src="lib/captcha/imagebuilder.php" style="border:none;" /></div>
				<div style="float:left; margin-left:5px;"><input type="text" name="userstring" style="width:100px; padding:6px;" /></div>		
				<?php if(isset($_SESSION['captcha_error'])): ?><p style="color:#f00;">请输入正确的号码</p><?php endif; ?>
			</div>
			</p>
			<p>
			  <label for="button2"></label>
			  <input type="submit" name="register" id="button2" class="registerBtn" value="立即注册" />
			</p>
			<p>
			  <!--<small class="kosgrey2">By clicking on 'Register', you agree to the 
			Kosmeyin <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</small>-->
			<small class="kosgrey2">您点击“提交”按钮后，代表同意因我IN的社区守则, 法律声明&其他条款, 和评分手册 里的相关内容。</small>
			</p>
		  </form>
		 
		</div>
		<div class="adTableCell smallWords">
		  
		  <h3 class="sideBar">OR</h3>
		</div>
		<div class="adTableCell sideBar250">
		  <h3 class="sideBar" style="text-align:center">已经注册了？</h3>
		  <p style="text-align:center"><a href="<?=SERVER_URL?>?login" class="login">登录</a></p>
		  
		</div>
	  </div>
	</div><!--adTable--><!--adTable-->
<?php else: ?>
	<div style="position:relative; overflow: hidden; width:auto; height:auto; padding:10px; ">
		<div style="position:relative; overflow: hidden; width:900px; height:auto; padding:20px; border:1px solid #DDD; background-color:lemonchiffon;">
			<span style="font-size:12px;">You are already a member. Click <a href="<?SERVER_URL?>?invite-a-friend">here</a> to invite your friend and get up to 50 points per referrals.</span>
		</div>
	</div>
<?php endif; ?>
   