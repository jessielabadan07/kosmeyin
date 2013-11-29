<div style="position:relative; overflow: hidden; width:auto; height:auto; padding:10px; ">
<div style="position:relative; overflow: hidden; width:900px; height:auto; padding:20px; border:1px solid #DDD; background-color:lemonchiffon;">
<span style="font-size:12px;">Verification Code Success. Type your new Password</span>
</div>
<div style="position:relative; overflow: hidden; height:50px;"></div>
<form name="form2" method="post" action="<?=SERVER_URL?>?postnewpassword" class="registerForm" id="loginForm">
	<p>
	  <label for="password">Password:</label>
	  <input type="password" name="password1" id="password1" />	  
	  <?php echo !empty($_SESSION['password1_error']) ? $_SESSION['password1_error'] : ''; ?>
	</p>	
	<p>&nbsp;</p>
	<p>
	  <label for="password">Re-type Password:</label>
	  <input type="password" name="password2" id="password2" />
	  <?php echo !empty($_SESSION['password2_error']) ? $_SESSION['password2_error'] : ''; ?>
	</p>
	<p>
	  <label for="button2"></label>
	    <input type="hidden" name="hide_code" id="hide_code" value="<?=$_GET['verifyrequest']?>" />
	  <input type="submit" name="submit" id="button2" class="registerBtn" value="Submit" />
	</p>
</form>
<div style="position:relative; overflow: hidden; height:200px;"></div>