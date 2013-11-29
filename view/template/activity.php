<div class="adTable">
<div class="adTableRow">
<div class="adTableCell">
  <div class="adModRed">	
	<a href="<?=SERVER_URL?>?register"><img src="<?=SERVER_URL?>images/girl.png" width="150" height="220" alt="GIRL" /></a>
  </div>
</div>
<div class="adTableCell">
  <div class="adModBlue">
	<div class="adModBlueContent">
	  <h3>最新IN GIRL动态</h3>
	   <div class="adModContentInnerText userCurrentActivity" style="">
	   <table id="user_activity_table" width="100%" border="0" cellspacing="0" cellpadding="0">
		  <?php $this->result = null; ?>
			<?php $this->query("SELECT * FROM user_activity ORDER BY date_added DESC LIMIT 3", $this->ERROR_QUERY); ?>
			<?php if($this->return_rows() > 0): ?>
			<!--<div class="currentactivity-scroller">
				<ul>-->				
				<?php foreach($this->result_to_object() as $obj): ?>
					<tr>
						<td><img src="<?=SERVER_URL?><?=getImageById($obj->uid)?>" width="21" height="21" alt="a">&nbsp;<span style="font-size:11px;"><?=$obj->content?></span>&nbsp;<span class="userTimeText"><?=elapseTime($obj->date_added)?></span></td>
					<!--<li>						
						<div class="info">
							<img src="<?=SERVER_URL?><?=getImageById($obj->uid)?>" width="21" height="21" alt="a">&nbsp;<span style="font-size:11px;"><?=$obj->content?></span>&nbsp;<span class="userTimeText"><?=elapseTime($obj->date_added)?></span>
						</div>						
					</li>-->
					</tr>
					<?php endforeach; $this->result = null; ?>				
				<!--</ul>-->
			<!--</div>-->
			<?php endif; ?>
			</table>
	  </div>
	</div>
  </div>
</div>
<div class="adTableCell">
  <div class="adModBlue">
	<div class="adModBlueContent">
	  <h3>IN GIRL排行榜</h3>
	  <div class="adModContentInnerText userlist">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php 
			$i=1; 			
			if($this->returnRows > 0) {								
				foreach($this->members as $member) {
			?>
					<tr>
						<td><img src="<?=SERVER_URL?><?=$member['uImage']?>" width="21" height="21" alt="a"></td>
						<td class="listRed"><?=$i++?>.</td>
						<td class="listRed"><?=$member['mUser']?></td>
						<td class="pointList"><?=$member['tPoints']?></td>
					</tr>
			<?php
				}				
			}	
		?>
		</table>                
	  </div>
	</div>
  </div>
</div>
<div class="adTableCell">
  <div class="adModRed">
	<div class="adModRed-mid">
	  <div class="adModRed-top">
		<div class="adModRed-bot">
		  <div class="adModRedContent">
			<h2><a href="<?=SERVER_URL?>?how-it-works" style="color:#fff;">玩转因我IN</a></h2>			
		  </div>
		</div>
	  </div>
	</div>
  </div><!--adModRed-->
  <div class="adModBlue someCharacter"><a href="<?=SERVER_URL?>?invite-a-friend"><img src="images/someCharacter.png" width="136" height="143"></a></div>
</div>
</div>
</div><!--adTable-->
