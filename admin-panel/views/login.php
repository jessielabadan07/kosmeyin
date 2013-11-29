<div style="clear:both; width:auto; height:100px;"></div>
<div id="form_div">
	<div style="font-size:16px; color:#888; border-bottom:1px solid #DDD; padding:5px; margin-bottom:15px;">Admin Kosmeyin</div>		 	
	<form id="verifylogin" method="POST" action="<?=SERVER_URL?>?submit=true" >
	<table>
		<tr>
			<th>Email:</th><td><input type="text" id="email" name="email" /></td>
		</tr>
		<tr>
			<th>Password:</th><td><input type="password" id="pass" name="pass" /></td>
		</tr>
		<tr>
			<th>&nbsp;</th><td><input type="submit" id="login" name="login" value="Login" /></td>
		</tr>
	</table>
	</form>
	<div style="float:right;"><a href="<?=SERVER_URL?>forgotpassword" id="reg" >Forgot Password?</a></div>	
	<?php if(isset($_GET['invalid_login'])): ?>
	<div style="width:auto;height:auto;clear:both; float:left; margin-top:10px; margin-left:-35px;">
		<div style="font-size:11px; font-weight:bold; margin-left:30px; color:#666; height:auto; border:1px solid yellowgreen; background-color:lemonchiffon; padding:2px; width:auto; font-color:#fff; position:relative; overflow:hidden; clear:both;">
			<div style="float:left"><img src="<?=SERVER_URL?>images/error.png" width="32" height="32" /></div>
			<div style="float:left; margin-top:10px; ">Invalid email address/password</div>
		</div>	
	</div>		
	<?php endif;?>
</div>
