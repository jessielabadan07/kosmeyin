<div id="main_cont">
  <div id="main_cont_inner">
    <div id="top_quick_link">
		<?php if(isset($_SESSION['id'])): ?>
			<ul>
				<li><a href="<?=SERVER_URL?>?<?=$_SESSION['uname']?>">欢迎 <?=$_SESSION['uname']?>!</a></li>
				<li><a href="<?=SERVER_URL?>?logout">登出</a></li>
			  </ul>
		<?php else: ?>
			  <ul>
				<li><a href="<?=SERVER_URL?>?register">免费注册</a></li>
				<li><a href="<?=SERVER_URL?>?login">登录</a></li>
			  </ul>
		<?php endif; ?>
    </div><!--top_quick_link-->
    <div id="logo_row_table">
      <div id="logo_row_table_row">      
        <div id="logo_row_table_cell1"><a href="<?=SERVER_URL?>"><img src="images/kosmeyin_logo.png" width="284" height="86" alt="logo"></a></div>        
        <div id="logo_row_table_cell2">
			<?=$this->UserBonusPoints()?>
			<?php 
				$uname = trim(strtolower($this->members[0]['mUser']));			
				$id = $this->GetUserIdByUsername($uname);				
				$this->SetTopWeeklyScorer($id,$this->members[0]['tPoints']);
				$this->GetUserTopWeeklyScorer($this->GetUserIdTopScorer());		
				if(getLastDayOfWeek()) {
					$this->GetUserLoginSevenDaysRow();
				}
			?>
          <div class="modules">
            <div class="usrTopPtTitle">本周最高积分获奖者：</div>
            <div class="usrTopPtAv" style="height:auto; border:none; width:auto;">
				<?php if(strlen($this->rst['profile_image']) > 0): ?>
						<img src="<?=SERVER_URL?>user_upload/<?=intval($this->rst['id'])?>/big-thumb-nail<?=$this->rst['profile_image']?>" width="auto" height="auto" alt="<?=$this->rst['username']?>" >
				<?php else: ?>
						<img src="<?=SERVER_URL?>user_upload/default_user.png" width="34" height="44" alt="<?=$this->rst['username']?>" >
				<?php endif; ?>
			</div>
            <div class="usrTopPtName" style="float:right;"><?=$this->rst['username']?></div>
            <div class="usrScore"><?=getTotalPoints($this->GetUserIdTopScorer())?> pts</div>
          </div>
          
          <div class="modules">
			<div class="jiathis_style">
            <ul>
			  <li>
				<a href="http://e.weibo.com/kosmeyin" target="_blank"><img src="images/icon_weibo.png" width="25" height="25" alt="weibo" /></a>
			  </li>              
			  <li><a class="jiathis_button_tqq"></a></li>
			  <li><a class="jiathis_button_qzone"></a></li>
            </ul>
			</div>
			<script type="text/javascript" >
			var jiathis_config={
				summary:"",
				hideMore:true
			}
			</script>
			<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
          </div>
          
          <div class="modules">
            <form name="form1" method="post" action="" id="searchFormTop">
              <label for="textfield"></label>
              <input name="textfield" type="text" id="textfield" value="search">
              <input type="submit" name="button" id="button" value="Submit">
            </form>
          </div>
          
        </div>
      </div>
    </div><!--logo row-->
    
    <div id="menu_main">
      <div id="menu_main_table">
		<?$this->GetTopMenu()?>
        <ul id="navMain">		
		<?php foreach($this->result_to_object() as $obj): ?>
		<?php 
			$link = (strlen($obj->menu_link) > 0) ? "?".$obj->menu_link : '';
		?>
				<li><a href="<?=SERVER_URL?><?=$link;?>"><?=$obj->menu_text?></a>
				<?$this->GetSubMenuCategoryById($obj->id,$link)?>
			</li>
		<?php endforeach; ?>
				<li><a href="<?=SERVER_URL?>?how-it-works">玩转因我IN</a></li>
        </ul>
      </div>
    </div><!--menu_main -->
    
   
    

        