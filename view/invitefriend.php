<div style="position:relative; overflow: hidden; width:auto; height:auto; padding:10px; ">
<div style="position:relative; overflow: hidden; width:900px; height:auto; padding:20px; border:1px solid #DDD; background-color:lemonchiffon;">
<span style="font-size:16px; font-weight:bold; color:#ED1C29;">邀请好友一起来玩转 因我IN！ <?php if(!isset($_SESSION['id'])):?> 已经注册了？ <a href="<?=SERVER_URL?>?login">登录</a> or <a href="<?=SERVER_URL?>?register">立即注册</a><?php endif;?></span>
</div>
<?php if(isset($_SESSION['id'])): ?>
<?php 	if($_SESSION['level'] == 1): ?>
			<form name="form2" method="post" action="<?=SERVER_URL?>?submitfriendrequest" class="registerForm" id="loginForm">
				<p>
				  <label for="friendemail">好友的邮箱地址：</label>
				  <input type="text" name="friendemail" id="friendemail" />	  
				  <?=inviteFriendError('invalid-friend-email-address','请填写有效邮箱地址')?>
				  <?=inviteFriendError('email-already-registered','请填写有效邮箱地址')?>
				</p>
				<p>
				  <label for="yourname">好友的邮箱地址：</label>
				  <input type="text" name="yourname" id="yourname" value="<?=$_SESSION['uname']?>"/>	  
				  <?=inviteFriendError('invalid-input-username','请输入用户名')?>
				</p>
				<p>
				  <label for="youremail">您的邮箱地址：</label>
				  <input type="text" name="youremail" id="youremail" value="<?=getEmail(intval($_SESSION['id']))?>"/>	 
				  <?=inviteFriendError('invalid-email-address','请填写有效邮箱地址')?>
				</p>
				<p></p>
				<p>
				  <label for="subject">标题：</label>
				  <input type="text" name="subject" id="subject" value="一起来做 IN GIRL 玩转 因我IN" />	  
				</p>
				<p>
				  <label for="message" valign="top">您的好友</label>
				  <textarea id="message" name="message" cols="80" rows="20" style="border:1px solid #ccc; height:auto; padding:10px; line-height:2em; text-align:justify; font-family:verdana;" >您的好友 <?=$_SESSION['uname']?>（<?=getEmail(intval($_SESSION['id']))?>） &nbsp;
			邀请了您一起来玩转因我IN。 &nbsp; 
			因我IN是一个带给姑娘们美容小贴士，美容趋势，时 &nbsp;
			尚潮流，产品介绍 &nbsp;
			和美容教程的网上平台。你也来做个IN GIRL吧！ &nbsp;	 

			因我IN 的IN Girls 在阅读文章， 观看视频， &nbsp;
			发表评论， 贡献资源， &nbsp;
			和发起分享时就可以获取积分。 &nbsp;

			周积分最多的IN Girl 会赢取周冠军奖。 &nbsp;
			月积分最多的IN Girl奖品更丰厚！ &nbsp;

			还有更多精彩的活动等你参加！获奖和积分从你注册 &nbsp;
			和登陆因我IN开始！ 希望您快点来一起分享哦！ &nbsp;


			  ~  小K老师 和 因我IN 团队 &nbsp; 
				</textarea>
				</p>
				<p>
				  <label for="button2"></label>
				  <input type="submit" name="submit" id="button2" class="registerBtn" value="发送邀请" />
				</p>
			</form>
	<?php endif; ?>
<?php else: ?>
<div style="position:relative; overflow:hidden; height:200px;"></div>
<?php endif; ?>