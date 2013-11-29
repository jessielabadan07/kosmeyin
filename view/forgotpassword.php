<div style="position:relative; overflow: hidden; width:auto; height:auto; padding:10px; ">
<div style="position:relative; overflow: hidden; width:900px; height:auto; padding:20px; border:1px solid #DDD; background-color:lemonchiffon;">
<span style="font-size:12px;">To request a new password type your username or email address and click submit button.</span>
</div>
<form name="form2" method="post" action="<?=SERVER_URL?>?requestnewpassword" class="registerForm" id="loginForm">
	<p>
	  <label for="username">用户名</label>
	  <input type="text" name="username" id="username" />	  
	</p>
	<p>
		or
	</p>
	<p>
	  <label for="password">邮箱地址</label>
	  <input type="email" name="email" id="email" />
	</p>
	<p>
	  <label for="button2"></label>
	  <input type="submit" name="submit" id="button2" class="registerBtn" value="Submit" />
	</p>
	<?php if(isset($_GET['error'])): ?>
			<p><small class="kosgrey2" style="color:#f00; font-size:12px;">Invalid Username/Email Address.</small></p>
	<?php endif; ?>
</form>