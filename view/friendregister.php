<?php if(!isset($_SESSION['id'])): ?>
	<h2 class="regular">Be the first to know when our  <span class="kosmeyin"><span class="kosred">K</span><span class="kosgrey">o</span><span class="kosblue">s</span>meyin</span> <br>
		  shop is launched!  Register now!</h2>
	<div class="adTable">
	  <div class="adTableRow">
		<div class="adTableCell">
		<small>Please complete the form to continue your registration.</small>		
		<?php if(!empty($_SESSION['regform_errors'])): ?>
		<br/>
		<div style="margin-left:60px; border:1px solid #ccc; padding:10px; font-size:11px; position:relative; overflow:hidden; height:auto; width:auto;">
		<?php					
			foreach($_SESSION['regform_errors'] as $key => $value) {
				echo $value.'<br/>';
			}			
		?>
		</div>
		<?php endif; ?>
		  <form method="post" action="<?=SERVER_URL."?registeruser"?>" class="registerForm" id="registerForm">
			<p>
			  <label for="username">Username</label>
			  <input type="text" name="username" id="username" value="<?=!empty($_POST['popusername']) ? $_POST['popusername'] : ""?>" />
			  
			</p>
			<p>
			  <label for="password">Password</label>
			  <input type="password" name="password" id="password">
			</p>
			<p>
			  <label for="password_confirm">Re-type Password</label>
			  <input type="password" name="password_confirm" id="password_confirm">
			</p>
			<p>
			  <label for="email">Email</label>
			  <input type="text" name="email" id="email" value="<?=$this->ModelUserValidateCode()?>" />
			</p>
			<p class="radioBtn"><label>Gender </label>
			  <input type="radio" name="gender" id="male" value="male" checked="check">
			  <label for="male">Male</label> 
			  <input type="radio" name="gender" id="female" value="female">
			  <label for="female">Female</label>
			</p>
			<p>
			  <label for="select">Birth Date </label>
			  <select name="year" id="year">
				<option value="">Year:</option>
				<?php for($counter=2012; $counter>=1905; $counter--): ?>
				<option><?=$counter?></option>
				<?php endfor; ?>
			  </select>
			  <select name="month" id="month">	
			  <?php 
				$months = array( "Jan"=>"01", "Feb"=>"02", "Mar"=>"03", "Apr"=>"04", "May"=>"05", "Jun"=>"06", "Jul"=>"07", 
									"Aug"=>"08", "Sep"=>"09", "Oct"=>"10", "Nov"=>"11", "Dec"=>"12" );
			  ?>
				<option value="">Month:</option>
				<?php foreach($months as $key => $month): ?>
				<option value="<?=$month?>"><?=$key?></option>
				<?php endforeach; ?>
			  </select>
			  <select name="date" id="date">						
				<option value="">Date:</option>
				<?php for($counter=1; $counter<=31; $counter++): ?>
				<option><?=$counter?></option>
				<?php endfor; ?>
			  </select> 
			</p>
			<p>
			  <label for="phone">Phone</label>
			  <input type="text" name="phone" id="phone">
			</p>
			<div style="float:right; width:320px; position:relative; overflow:hidden; margin-right:40px;">
				<?php $this->errArr = !empty($_SESSION['capthcha_errors']) ? $_SESSION['capthcha_errors'] : null; ?>
				<?=recaptcha_get_html($this->publickey, $this->errArr);?>
			</div>
			<p>
			  <label for="button2"></label>
			  <input type="hidden" name="regtype" id="regtype" value="viafriendemail" />
			  <input type="hidden" name="fid" id="fid" value="<?=intval($_GET['skid'])?>" />
			  <input type="hidden" name="encrypturl" id="encrypturl" value="<?="?user-validate-code=".$_GET['user-validate-code'].'&email='.$_GET['email'].'&skid='.$_GET['skid'].'&dt='.urlencode($_GET['dt']).'&submitaction=true';?>" />
			  <input type="submit" name="register" id="button2" class="registerBtn" value="Register" />
			</p>
			<p>
			  <small class="kosgrey2">By clicking on 'Register', you agree to the 
			Kosmeyin <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</small></p>
		  </form>
		 
		</div>
		<div class="adTableCell smallWords">
		  
		  <h3 class="sideBar">OR</h3>
		</div>
		<div class="adTableCell sideBar250">
		  <h3 class="sideBar">Sign up using
			another account</h3>
		  <p style="text-align:center"><img src="images/qqBtn.png" width="172" height="46"></p>
		  <p style="text-align:center"><img src="images/btnWiebo.png" width="172" height="63"></p>
		  <p style="text-align:center">Use your QQ or Weibo account to sign up
		  at Kosmeyin.  It's quick and easy!</p>
		  <h3 class="sideBar" style="text-align:center">Already a member?</h3>
		  <p style="text-align:center"><a href="#" class="login">Login</a></p>
		  
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
   