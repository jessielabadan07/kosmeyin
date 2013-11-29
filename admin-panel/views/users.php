<?php include('template/content_top.php'); ?>
<style type="text/css">
	table#table_user td {				
		padding:5px;
		text-align: justify;
	}	
	table#table_user th {	
		color: #f1f1f1;
	}
	table#table_user_points tr {
		background-color: #6699cc;
		color: #fff;
		text-align: justify;
		font-weight: normal;
	}
	table#table_user_points td {
		font-weight: normal;
	}
	#button_options div	a {
		padding:5px;
		border: 1px solid #ccc;
		font-weight:normal;
		background: #6699cc;
		cursor: pointer;
		width: auto;
		color: #fff;
		float: left;
	}
</style>
<?php if(isset($_GET['uid'])): ?>
	<?php $id = intval($_GET['uid']); ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?users">User ID</a> : # <?=$id?></div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:10px; margin-bottom:20px; clear:both;">						
			<div style="position:relative; overflow:hidden; float:left; border:1px solid #ddd; width:auto; height: auto; padding:5px; background:#fff;">
				<?php $this->GetUserById($id); ?>
				<center><img src="<?=USER_DIR?>user_upload/<?=$id?>/<?=$this->rst['profile_image']?>" /></center>
				<table>
					<tr>
						<th style="text-align:right;">Username:</th>
						<td><?=$this->rst['username']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Email:</th>
						<td><?=$this->rst['email']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Gender:</th>
						<td><?=$this->rst['gender']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Birthdate:</th>
						<td><?=$this->rst['bdate']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">City:</th>
						<td><?=$this->rst['city']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Gender:</th>
						<td><?=$this->rst['phone']?></td>
					</tr>
				</table>
				<hr/>
				<div id="button_options">
					<div><a href="<?=SERVER_URL?>?users&delete_user_byid=<?=$id?>">Delete User</a></div>
					<div><a href="<?=SERVER_URL?>?users&givepoints_by_userid=<?=$id?>">Give Points</a></div>
				</div>
			</div>
			<div style="position:relative; overflow:hidden; float:left; margin-left:10px; border:1px solid #ddd; width:auto; height: auto; padding:3px;">
				<table style="width:700px;" id="table_user">
					<tr style="background-color:#CCC;">
						<th style="padding:5px;">Points</th>
						<th style="padding:5px;">Summary</th>
						<th style="padding:5px;">Details</th>
					</tr>
					<tr>
						<td style="text-align:center;"><?=$this->GetBonusPointsByRegisterId($id)?></td>
						<td>Points for successfully sign-up.</td>
						<td><a href="<?=SERVER_URL?>?users&action=detail01">View</a></td>
					</tr>
					<tr>
						<td style="text-align:center;"><?=$this->GetBonusPointsByUserLogId($id)?></td>
						<td>Total Points for logging in everday and seven days on a row.</td>
						<td><a href="<?=SERVER_URL?>?users&action=detail02">View</a></td>
					</tr>
					<tr>
						<td style="text-align:center;"><?=$this->GetPointsOnArticle($id)?></td>
						<td>Total Points for reading and commenting on articles.</td>
						<td><a href="<?=SERVER_URL?>?users&action=detail03">View</a></td>
					</tr>			
					<tr>
						<td style="text-align:center;"><?=$this->GetPointsByFriendRefferal	($id)?></td>
						<td>Total Points for through friend referrals by successfully registering a friend.</td>
						<td><a href="<?=SERVER_URL?>?users&action=detail04">View</a></td>
					</tr>				
				</table>
				<div style="float:right; padding:5px; font-size:14px;">
					<span>Total Points:</span><span style="color:#6699cc; "><?=$this->GetUserTotalPoints($id)?></span>
				</div>
			</div>
		</div>
<?php elseif(isset($_GET['givepoints_by_userid'])): ?>		
	<?php $id = intval($_GET['givepoints_by_userid']); ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?users">User ID</a> : # <?=$id?></div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:10px; margin-bottom:20px; clear:both;">						
			<div style="position:relative; overflow:hidden; float:left; border:1px solid #ddd; width:auto; height: auto; padding:5px; background:#fff;">
				<?php $this->GetUserById($id); ?>
				<center><img src="<?=USER_DIR?>user_upload/<?=$id?>/<?=$this->rst['profile_image']?>" /></center>
				<table>
					<tr>
						<th style="text-align:right;">Username:</th>
						<td><?=$this->rst['username']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Email:</th>
						<td><?=$this->rst['email']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Gender:</th>
						<td><?=$this->rst['gender']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Birthdate:</th>
						<td><?=$this->rst['bdate']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">City:</th>
						<td><?=$this->rst['city']?></td>
					</tr>
					<tr>
						<th style="text-align:right;">Gender:</th>
						<td><?=$this->rst['phone']?></td>
					</tr>
				</table>
				<hr/>
				<div id="button_options">
					<div><a href="<?=SERVER_URL?>?users&givepoints_by_userid=<?=$id?>">Delete User</a></div>
					<div><a href="<?=SERVER_URL?>?users&givepoints_by_userid=<?=$id?>">Give Points</a></div>
				</div>
			</div>
			<div style="position:relative; overflow:hidden; float:left; margin-left:10px; border:1px solid #ddd; width:auto; height: auto; padding:3px;">
				<form method="POST" action="<?=SERVER_URL?>?givepoints">
				<table style="width:auto;" id="table_user_points">
					<tr>
						<th style="padding:5px;">How much points do you want to give?</th>
						<td><input type="text" id="points" name="points" /></td>
					</tr>
					<tr>
						<th style="padding:5px;">Do you want to display this in the Current Activity?</th>
						<td>
							<input type="radio" id="status" name="status" value="1" checked="checked" />Yes
							<input type="radio" id="status" name="status" value="0" />No
						</td>
					</tr>
					<tr>
						<th style="padding:5px;">Optional Points Type: (<i>gift, giveaways, article contributors,...</i>)</th>
						<td><input type="text" id="points_type" name="points_type" /></td>
					</tr>	
					<tr style="background:none;">
						<input type="hidden" id="hide_id" name="hide_id" value="<?=$id?>" />
						<td><input type="submit" id="save" name="save" value="Give Points" /></td>
						<td></td>						
					</tr>
				</table>
				</form>
			</div>
		</div>		
<?php elseif(isset($_GET['delete_user_byid'])) :?>
		
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?users">Delete user by id</a> : # <?=intval($_GET['delete_user_byid'])?></div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:10px; margin-bottom:20px; clear:both;">						
			<div style="position:relative; overflow:hidden; background:lemonchiffon; border:1px solid orange; padding:5px; width:900px; font-weight:bold;">
				Are you sure you want to delete this user "<a href="<?=SERVER_URL?>?users&uid=<?=$_GET['delete_user_byid']?>"><?=$this->GetUserNameById($_GET['delete_user_byid'])?></a>"
				&nbsp;<a href="<?=SERVER_URL?>?confirm_userdelete_by_id=<?=$_GET['delete_user_byid']?>">Yes</a> &nbsp; or &nbsp; <a href="<?=SERVER_URL?>?users&uid=<?=$_GET['delete_user_byid']?>">No</a>.?
				<br/> <span style="font-weight:normal;">The following will be deleted under this user:</span> <br/>
				<div style="font-weight:normal; size:11px; padding:5px;">
					Gained Points<br/>
					User Information<br/>
					User Images<br/>
					User commented on articles<br/>
					User like/dislike on articles<br/>
					User survey<br/>
					and Etc..
				</div>
			</div>
		</div>
		
		
<?php else: ?>		
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?users">User</a> : ALL</div>
			<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; margin-bottom:20px;">
				<form method="POST" action="" >
				<div style="position:relative; overflow:hidden; width:650px; border:1px solid #fff; background-color: #fff; height:auto; padding: 10px; margin:0 auto; margin-top:5px; float:left;">					
					<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">						
						<a href="javascript:;" id="btndel_user" style="color:#666; font-size:11px;">Delete</a>
					</div>			
					<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">
						<a href="<?=SERVER_URL?>?article&searchcategory" style="color:#666; font-size:11px;">Search</a>
					</div>			
					<div style="float:right;">There are total Number of <b><?=$this->GetTotalRegisterdByStatus(1)?></b> registered users and <b><?=$this->GetTotalRegisterdByStatus(0)?></b> pending users.</div>
				</div>			
			<table class="article_table" style="width:940px; font-size:12px; color:#666; float:left;">
				<tr style="text-align:justify; padding:5px; color:#3399ff; background-color:#ddd;">				
					<th style="text-align:justify; padding:15px; width:60px; color:#3399ff;">
						<input type="checkbox" id="del_user" name="del_user" />&nbsp;Name</th>		
					<th style="text-align:justify; padding:15px; width:125px; color:#3399ff;">Email</th>		
					<th style="text-align:justify; padding:15px; width:50px; color:#3399ff;">Status</th>					
					<th style="text-align:justify; padding:15px; width:60px; color:#3399ff;">Date Joined</th>
				</tr>
				<?php 
					$this->result = null;
					$this->query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id = ui.id WHERE ul.user_type=1", $this->ERROR_QUERY);
					$i=0;
					foreach($this->result_to_object() as $r) {
						echo ($i%2==0) ? '<tr style="background-color:#f1f1f1;">' : '<tr style="background-color:#ddd;">';
						echo '<td style="text-align:justify; padding:15px; width:60px;"><input type="checkbox" id="'.$r->id.'" name="delusers" />&nbsp;<a href="'.SERVER_URL.'?users&uid='.$r->id.'">'.$r->username.'</a></td>';
						echo '<td style="text-align:justify; padding:15px; width:60px;">'.$r->email.'</td>';	
						$str = ($r->status_link == 1) ? '<span style="color:green;">Registered</span>' : '<span style="color:#f00;">Not yet confirm to his/her email</span>';
						echo '<td style="text-align:justify; padding:15px; width:60px;">'.$str.'</td>';						
						echo '<td style="text-align:left; padding:15px; width:60px;">'.date('Y-m-d',strtotime($r->join_date)).'</td>';
						echo '</tr>';
						$i++;
						$str = null;
					}										
				?>
					
			</table>
			<div style="position:relative; overflow:hidden; padding:3px; float:right; border:1px solid orange; background-color:lemonchiffon; margin-right:50px; margin-bottom:5px;">
				Click the username to view the user.
			</div>
		</div>

<?php endif; ?>
<script type="text/javascript">
$(document).ready(function() {				
	$("table#table_user tr:even").css({'background':'#ddd'});
	$("table#table_user tr:odd").css({'background':'#f1f1f1'});			
	$("table#table_user tr:eq(0)").css({'background':'#6699cc'});			
});
</script>
<?php include('template/content_bottom.php'); ?>			
		