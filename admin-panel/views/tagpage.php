<?php include('template/content_top.php'); ?>
<?php if(isset($_GET['viewtag'])): ?>
	<?php $tid = intval($_GET['viewtag']); $this->GetTagById($tid); ?>	
	<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article&tag" style="color:#C60070;">Tag</a> : Edit Tag</div>
	<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
		<form id="add_article" method="POST" action="<?=SERVER_URL?>?article&update_tag">	
			<table id="product_table">
				<tr>
					<td>Tag Name:</td>
					<td><input type="text" id="tag_name" name="tag_name" style="width:200px; padding:5px;" value="<?=$this->rst['tags']?>" >&nbsp;*</td>
				</tr>		
			</table>
			<fieldset style="width:900px; margin-left:20px;"><legend><strong>Select an Article you wish to include this tag.</strong></legend>
			<?php $this->GetListArticles(); ?>
			<?php foreach($this->result_to_object() as $obj): ?>
				<?php if($this->GetTagArticleById($tid,$obj->article_id) > 0): ?>
						<div style="position:relative; overflow:hidden; padding:5px;">
							<input type="checkbox" id="articles" name="articles[]" checked="checked" value="<?=$obj->article_id?>">&nbsp;
							<span style="color:#666;"><?=$obj->article_title?></span>
							<input type="hidden" id="hidetag" name="hidetag[]" value="<?=$obj->article_id?>" />
						</div>	
				<?php else: ?>
						<div style="position:relative; overflow:hidden; padding:5px;">
							<input type="checkbox" id="articles" name="articles[]" value="<?=$obj->article_id?>">&nbsp;
							<span style="color:#666;"><?=$obj->article_title?></span>
							<input type="hidden" id="hidetag" name="hidetag[]" value="<?=$obj->article_id?>" />
						</div>
				<?php endif; ?>
			<?php endforeach; ?>
			</fieldset>
			<table id="product_table">
				<tr>
					<td>Status</td>
					<td>
						<select id="status" name="status">
							<option value="1">Visible</option>&nbsp; 
							<option value="0">Hidden</option>&nbsp; 
						</select> <br/>
						<b>Note:</b>
						(<i>If option "Visible" is selected then this tag will be visible in the homepage.</i>) <br/>
						(<i>If option "Hidden" is selected then this tag will not be visible in the homepage.</i>)
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<input type="hidden" id="post_tagid" name="post_tagid" value="<?=$tid?>" />
					<input type="submit" id="save" name="save" value="Update Tag" /></td>
				</tr>
			</table>
		</form>
		<div style="margin: 10px; 0 10px; 5px; border:1px solid orange; background-color:lemonchiffon; padding:20px;">
			<?php if(isset($_GET['error'])): ?>
				<span style="font-weight:bold; color:#666;">Error:</span> <span style="color:#f00;"><?=$_GET['error']?></span>
			<?php endif; ?>
		</div>
	</div>

<?php elseif(isset($_GET['update_tag'])): ?>
	
<?php $this->UpdateTag(); ?>
	
<?php else: ?>

<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article&tag" style="color:#C60070;">Tag</a> : Add New+</div>
	<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
		<form id="add_article" method="POST" action="<?=SERVER_URL?>?article&save_tag">	
			<table id="product_table">
				<tr>
					<td>Tag Name:</td>
					<td><input type="text" id="tag_name" name="tag_name" style="width:200px; padding:5px;" >&nbsp;*</td>
				</tr>		
			</table>
			<fieldset style="width:900px; margin-left:20px;"><legend><strong>Select an Article you wish to include this tag.</strong></legend>
			<?php $this->GetListArticles(); ?>
			<?php foreach($this->result_to_object() as $obj): ?>
					<div style="position:relative; overflow:hidden; padding:5px;">
						<input type="checkbox" id="articles" name="articles[]" value="<?=$obj->article_id?>">&nbsp;<span style="color:#666;"><?=$obj->article_title?></span></div>	
			<?php endforeach; ?>
			</fieldset>
			<table id="product_table">
				<tr>
					<td>Status</td>
					<td>
						<select id="status" name="status">
							<option value="1">Visible</option>&nbsp; 
							<option value="0">Hidden</option>&nbsp; 
						</select> <br/>
						<b>Note:</b>
						(<i>If option "Visible" is selected then this tag will be visible in the homepage.</i>) <br/>
						(<i>If option "Hidden" is selected then this tag will not be visible in the homepage.</i>)
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" id="save" name="save" value="Save Tag" /></td>
				</tr>
			</table>
		</form>
		<?php if(isset($_GET['error'])): ?>
		<div style="margin: 10px; 0 10px; 5px; border:1px solid orange; background-color:lemonchiffon; padding:20px;">
				<span style="font-weight:bold; color:#666;">Error:</span> <span style="color:#f00;"><?=$_GET['error']?></span>			
		</div>
		<?php endif; ?>
	</div>
	
<?php endif; ?>

<?php include('template/content_bottom.php'); ?>	
