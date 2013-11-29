<?php if(!isset($_SESSION['id'])): ?>
		<div class="backdrop">	
		</div>
		<div class="liteBoxSteps">
		  <div class="liteBoxInner">
			<div class="closeButton"><img src="images/icons/close.png" width="16" height="16" alt="close"> </div>
			<div class="stepsContOne">
			  <img src="images/lite_signup/steps.jpg" width="649" height="311">
			  <p>        一起来玩转<span class="kosred">因我IN</span><span class="kosgrey">！<br>
				IN Girls在阅读文章，观看视频，发表评论，贡献资源，和发起分享时就可以获取积分。快来注册做个IN Girl吧！</span><br>
			  </p>
			</div>
			<div class="stepsContTwo">
			  <div class="stepsContTwo_inner">
				<p><img src="images/lite_signup/n1.png" width="43" height="44" align="left" class="alignLeft">想做<span class="kosred">因我IN</span>的 IN GIRL<br>
				就立即注册吧！一起玩转 <span class="kosred">因我IN</span>！</p>
			   
				<div class="signUpForm">
				  <p>阅读文章，观看视频，发表评论，贡献资源，和发起分享时就可以获取积分！<br>
					<span class="kosWhite">每个新注册的IN GIRL都获取50K币！</span></p>
				  <form id="signUpForm" method="post" action="<?=SERVER_URL?>?register">
					<p><input type="text" name="popusername" id="popusername" class="required" />
					<label for="textfield2">用户名<span class="kosred">*</span></label></p> 
					<p><input type="text" name="popemail" id="popemail" class="required" />
					<label for="textfield3"> 邮箱地址<span class="kosred">*</span></label></p>
					<p class="registerBtnRow"><input name="" type="submit" value="立即注册"></p>
				  </form>

				</div>
				<div class="stepsContTwo_forgotRow">
				  <p><strong>已经是 IN GIRL? </strong><br>
				  <span class="kosgrey">继续累积 K币	点击这里</span> <a href="<?=SERVER_URL?>?login">登录</a> |  <a href="<?=SERVER_URL?>?forgotpassword">忘记密码了？</a></p>
				</div>
			  </div>
			</div>
		  </div>
		</div>
<?php endif; ?>