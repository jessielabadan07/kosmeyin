<?php if($this->checkSession()) { $this->redirect_to(SERVER_URL); }?>
<?php $this->query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id = ui.id WHERE ul.id=".intval($_SESSION['id']), $this->ERROR_QUERY); ?>
<?php $this->result_to_array(); ?>
<div class="containers">
  <div class="profileTable">
	<div class="profileTableRow">
	<!--<div class="profileTableCell">Content for  class "profileTableCell" Goes Here</div>-->
	
	<div class="profileTableCell">
		<div class="userCol">
		  <div class="userImg">
			<?php if(strlen($this->rst['profile_image']) == 0): ?>
					<img src="<?=SERVER_URL?>/user_upload/default_user.png" width="113" height="139">
			<?php else: ?>
				<img src="<?=SERVER_URL?>/user_upload/<?=intval($_SESSION['id'])?>/<?=$this->rst['profile_image']?>" width="150" height="150">
			<?php endif; ?>
		</div>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td><a href="<?=SERVER_URL?>?editphoto">更改圖片</a></td>
				<!--<td><a href="#">Remove</a></td>-->
			  </tr>
			</table>

		</div>
		<div class="tabContainer">
		 <div class="userRow">歡欢迎 <?=$this->rst['username']?>!</div>
		  <div id="tabs">
			<ul>
			  <li><a href="#tabs-1">View</a></li>
			  <li><a href="#tabs-2">Edit</a></li>
			  
			  </ul>
			<div id="tabs-1">
			  <p>用户名 : <?=$this->rst['username']?></p>
			  <p>邮箱地址 : <?=$this->rst['email']?></p>
			  <p>性别 : <?=$this->rst['gender']?></p>
			  <p>出生日期 : <?=date("F m, Y", strtotime($this->rst['bdate']))?></p>
			  <p>电话号码 : <?=$this->rst['phone']?></p>			  
              <p>城市: <?=$this->rst['city']?></p>
			  </div>
			<div id="tabs-2">		   
			  <form method="post" action="<?SERVER_URL?>?updateprofile" class="registerForm" id="registerForm">
					<p>
						<label for="aboutmenu">關於我</label>
						<textarea id="aboutme" name="aboutme" cols="50" rows="15" style="padding:3px; border:1px solid #ccc;"><?=$this->rst['aboutme']?></textarea>
					</p>
					<p>					  
					  <label for="username">用户名</label>
					<?php $username = !empty($_SESSION['username_data']) ? $_SESSION['username_data'] : $this->rst['username']; ?>
					  <input type="text" name="username" id="username" value="<?=$username?>">
					  <?php echo !empty($_SESSION['username_error']) ? $_SESSION['username_error'] : ''; ?>
					</p>
					<!--<p>
					  <label for="old_password">Old Password</label>
					  <input type="password" name="old_password" id="old_password">
					</p>-->
					<p>
					  <label for="password">请输入密码</label>
					  <input type="password" name="password" id="password">
					</p>
					<p>
					  <label for="password_confirm">请确认密码</label>
					  <input type="password" name="password_confirm" id="password_confirm">
					</p>
					<p>					  
					  <label for="email">邮箱地址</label>
					  <?php $email = !empty($_SESSION['email_data']) ? $_SESSION['email_data'] : $this->rst['email']; ?>
					  <input type="text" name="email" id="email" value="<?=$email?>">
					  <?php echo !empty($_SESSION['email_error']) ? $_SESSION['email_error'] : ''; ?>
					</p>
					<p>
						<label for="city">城市</label>					  
					  <input type="text" name="city" id="city" value="<?=$this->rst['city']?>">					  
					</p>
					<p class="radioBtn"><label>性别 </label>
					  <input type="radio" name="gender" id="male" value="male" checked="check">
					  <label for="male">男</label> 
					  <input type="radio" name="gender" id="female" value="female">
					  <label for="female">女</label>
					</p>
					<p>
					  <label for="select">出生日期</label>
					  <?php $strBDate = explode("-",$this->rst['bdate']); ?>					  
					  <select name="year" id="year">
						<?php if(empty($_SESSION['year_data'])) { ?><option value="">Year:</option> <?php } ?>				
						<?php for($counter=2012; $counter>=1905; $counter--): ?>					
								<?php if(!empty($_SESSION['year_data']) && (intval($_SESSION['year_data']==$counter))): ?>
										<option selected="selected"><?=$counter?></option>									
								<?php elseif(intval($strBDate[0]) == $counter): ?>
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
										<option value="<?=$month?>" selected="selected"><?=$key?></option>		
								<?php elseif(intval($strBDate[1]) == $month): ?>
										<option value="<?=$month?>" selected="selected"><?=$key?></option>		
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
								<?php elseif(intval($strBDate[2]) == $counter): ?>
										<option selected="selected"><?=$counter?></option>	
								<?php else: ?>
										<option><?=$counter?></option>	
								<?php endif; ?>
						<?php endfor; ?>
					  </select>	
					</p>
					<p>
					  <label for="phone">电话号码</label>
					  <input type="text" name="phone" id="phone" value="<?=$this->rst['phone']?>">
					</p>
					
					<p>
					  <label for="button2"></label>
					  <input type="submit" name="button2" id="button2" class="registerBtn" value="Update" />
					</p>
					
			  </form>
			  </div>
			
		  </div>
		</div>
	  <!--end tabs --></div>
	  
	</div>
  </div>
</div>

<div class="containers">
  <div class="profileTable">
	<div class="profileTableRow">
	  <div class="profileTableCell">
	  <?php include_once("view/points_summary.php"); ?>
		
	  </div><!--profileTableCell -->
	  <div class="profileTableCell"> <!--review ends --><!--review ends --></div><!--profileTableCell -->
	</div>
  </div>
</div>