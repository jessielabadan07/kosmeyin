<div class="adModBlue">
<div class="adModBlueContent">
  <h3>K币总计算</h3>
  <div class="adModContentInnerText userCurrentActivity pointSumm">
	<table width="100%">
		<tr>
		<td>
			<table cellspacing="0" cellpadding="0">
			  <col width="70%">
				<col width="*">
			  <tr>
				<td >邀请好友</td>
				<td align="right"><?=$this->GetTotalFriendsInvited()?></td>
			  </tr>
			  <tr>
				<td>Logging in Today</td>
				<td align="right"><?=$this->GetPointsLogginInToday()?></td>
			  </tr>
			  <tr>
				<td>7 days in a row bonus</td>
				<td align="right"></td>
			  </tr>
			  <tr>
				<td>Social Media Sharing</td>
				<td align="right"></td>
			  </tr>
			  <tr>
				<td>Contributors bonus</td>
				<td align="right"></td>
			  </tr>
			  <tr>
				<td>This Month's Purchases</td>
				<td align="right"></td>
			  </tr>
			  <tr>
				<td>Previous Purchases</td>
				<td align="right"></td>
			  </tr>
			</table>
		</td>
		<td>
		<table cellspacing="0" cellpadding="0">
			  <col width="70%">
			  <col width="*">
			  <tr>
				<td >好友注册</td>
				<td align="right"><?=$this->GetTotalFriendsRegistered()?></td>
			  </tr>
			  <tr>
				<td>Articles Read</td>
				<td align="right"><?=$this->GetPointsByReadingArticle()?></td>
			  </tr>
			  <tr>
				<td>Commented on Articles</td>
				<td align="right"><?=$this->GetPointsByCommentingOnArticle()?></td>
			  </tr>
			  <tr>
				<td>Filled Out Beauty Profile</td>
				<td align="right"></td>
			  </tr>
			  <tr>
				<td>Filled Out Survey</td>
				<td align="right"></td>
			  </tr>
			  <tr>
				<td>Signed up	</td>
				<td align="right"><?=$this->GetSignupBonus()?></td>
			  </tr>
			  
			</table>
		</td>
		</tr>
	</table>
	
  </div>
</div>
</div>