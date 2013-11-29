<?php include('template/content_top.php'); ?>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">Survey List</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">
<?=$this->GetSurvey();?>
<table id="userlist">
	<tr>	
		<th>ID</th>
		<th>Title</th>
		<!--<th>Content</th>-->
		<th>Published</th>
		<!--<th>Status</th>-->
		<th style="text-align:justify;">&nbsp;Delete</th>
	</tr>
	<?php foreach($this->result_to_object() as $obj): ?>
		<tr>
			<td><?=$obj->survey_id?></td>
			<td><?=$obj->survey_title?></td>
			<td><?=date('F m, y',strtotime($obj->survey_dateupdated));?></td>
			<td>Delete</td>
		</tr>
	<?php endforeach; ?>			
</table>
</div>
<?php include('template/content_bottom.php'); ?>			
		