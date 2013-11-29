<?php include('template/content_top.php'); ?>
<?php if(isset($_GET['viewcategory'])): ?>
		<?php $id = intval($_GET['viewcategory']); $this->GetCategoryById($id); ?>
		<?php $this->result_to_array(); ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article&category" style="color:#C60070;">Category</a> : Add New+</div>
			<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
				<form id="add_article" method="POST" action="<?=SERVER_URL?>?article&update_category">	
					<table id="product_table">
						<tr>
							<td>Category Name:</td>
							<td><input type="text" id="cat_name" name="cat_name" style="width:200px; padding:5px;" value="<?=$this->rst['cat_title']?>" >&nbsp;*</td>
						</tr>		
						<tr>
							<td>Alias:</td>
							<td><input type="text" id="cat_alias" name="cat_alias" style="width:200px; padding:5px;"  value="<?=$this->rst['cat_alias']?>" >&nbsp;*</td>
						</tr>
						<tr>
							<td>Description:</td>
							<td><textarea cols="50" rows="5" name="description" id="description" ><?=$this->rst['cat_description']?></textarea></td>
						</tr>
					</table>
					<!--<fieldset style="width:900px; margin-left:20px;"><legend><strong>Select Article you wish to include this category</strong></legend>
					<?php $this->GetListArticles(); ?>
					<?php foreach($this->result_to_object() as $obj): ?>
							<?php if($this->GetArticleByCategoryId($obj->article_id, $id) > 0): ?>
								<div style="position:relative; overflow:hidden; padding:5px;">
									<input type="checkbox" id="articles" name="articles[]" checked="checked" value="<?=$obj->article_id?>">&nbsp;<span style="color:#666;"><?=$obj->article_title?></span>
									<input type="hidden" id="hidecat" name="hidecat[]" value="<?=$obj->article_id?>" />
								</div>	
							<?php else: ?>
								<div style="position:relative; overflow:hidden; padding:5px;">
									<input type="checkbox" id="articles" name="articles[]" value="<?=$obj->article_id?>">&nbsp;<span style="color:#666;"><?=$obj->article_title?></span>
									<input type="hidden" id="hidecat" name="hidecat[]" value="<?=$obj->article_id?>" />
								</div>	
							<?php endif; ?>
					<?php endforeach; ?>
					</fieldset>-->
					<table id="product_table">
						<tr>
							<td><input type="hidden" id="post_id" name="post_id" value="<?=$id?>" /></td>
							<td><input type="submit" id="save" name="save" value="Update Category" /></td>
						</tr>
					</table>
				</form>
				<?php if(isset($_GET['error'])): ?>
				<div style="margin: 10px; 0 10px; 5px; border:1px solid orange; background-color:lemonchiffon; padding:20px;">
						<span style="font-weight:bold; color:#666;">Error:</span> <span style="color:#f00;"><?=$_GET['error']?></span>					
				</div>
				<?php endif; ?>
			</div>
<?php else: ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article&category" style="color:#C60070;">Category</a> : Add New+</div>
			<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
				<form id="add_article" method="POST" action="<?=SERVER_URL?>?article&save_category" enctype="multipart/form-data">	
					<table id="product_table">
						<tr>
							<td>Category Name:</td>
							<td><input type="text" id="cat_name" name="cat_name" style="width:200px; padding:5px;" >&nbsp;*</td>
						</tr>		
						<tr>
							<td>Alias:</td>
							<td><input type="text" id="cat_alias" name="cat_alias" style="width:200px; padding:5px;"  >&nbsp;*</td>
						</tr>
						<tr>
							<td>Description:</td>
							<td><textarea cols="50" rows="5" name="description" id="description" ></textarea> (optional)</td>
						</tr>
					</table>
					<fieldset style="width:900px; margin-left:20px;"><legend><strong>Select an Article you wish to add in this New Category</strong></legend>
					<?php $this->GetListArticles(); ?>
					<?php foreach($this->result_to_object() as $obj): ?>
							<div style="position:relative; overflow:hidden; padding:5px;">
								<input type="checkbox" id="articles" name="articles[]" value="<?=$obj->article_id?>">&nbsp;<span style="color:#666;"><?=$obj->article_title?></span></div>	
					<?php endforeach; ?>
					</fieldset>
					<table id="product_table">
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" id="save" name="save" value="Save Category" /></td>
						</tr>
					</table>
				</form>
				<div style="margin: 10px; 0 10px; 5px; border:1px solid orange; background-color:lemonchiffon; padding:20px;">
					<?php if(isset($_GET['error'])): ?>
						<span style="font-weight:bold; color:#666;">Error:</span> <span style="color:#f00;"><?=$_GET['error']?></span>
					<?php endif; ?>
				</div>
			</div>
<?php endif; ?>
<?php include('template/content_bottom.php'); ?>		
	
		