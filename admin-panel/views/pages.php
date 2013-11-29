<?php include('template/content_top.php'); ?>
<script type="text/javascript" src="<?=SERVER_URL?>js/ckeditor/ckeditor.js"></script>
<script src="<?=SERVER_URL?>js/ck-script.js" type="text/javascript"></script>
<link href="<?=SERVER_URL?>css/style.css" rel="stylesheet" type="text/css" />
<?php if(isset($_GET['add'])): ?>		
	<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?pages" style="color:#C60070;">Pages</a> : Add New+</div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
			<form id="add_page" method="POST" action="<?=SERVER_URL?>?pages&savepage">	
				<table id="product_table">
					<tr>
						<th>Title:</th>
						<td><input type="text" id="title" name="title" style="width:200px;" >
						<span style="font-style:italic;">(<i>Title of your page that can be seen on the drop-down menu</i>)</span></td>
					</tr>	
					<tr>
						<th>Alias:</th>
						<td><input type="text" id="deflink" name="deflink" style="width:200px;" >
						<span style="font-style:italic;">(<i>The link of your page like: videos, shoppin-cart or leave
						this blank to let the system use the page id.</i>)</span></td>
					</tr>
					<tr>
						<th>Content:</th>
						<td>&nbsp;</td>
					</tr>
				</table>
				<textarea cols="80" id="content" name="content" rows="40"></textarea>			
				<script type="text/javascript">
					//<![CDATA[								
						CKEDITOR.replace( 'content',
						{
							filebrowserBrowseUrl :'<?=SERVER_URL?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
							filebrowserImageBrowseUrl : '<?=SERVER_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
							filebrowserFlashBrowseUrl :'<?=SERVER_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
							filebrowserUploadUrl  :'<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
							filebrowserImageUploadUrl : '<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
							filebrowserFlashUploadUrl : '<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
						});

					//]]>
				</script>
				<table id="product_table"> 
					<tr>					
						<td valign="top">Widgets:</td>	
						<td>
							<hr/>
							<div id="sortable">
							<?php $this->GetAllWidgets(); ?>
							<?php foreach($this->result_to_object() as $obj): ?>	
									<div class="each_data" id="<?=$obj->id?>">
										<input type="checkbox" id="widget_type" name="widget_type[]" value="<?=$obj->id?>" /><?=$obj->widget_name?>		
									</div>
							<?php endforeach; ?>
							</div>
						</div>
						<i>Can be re-arrange to order just drag and drop the box of the widget.</i>
						<hr/>
						</td>
						<script type="text/javascript">				
							$(document).ready(function() {
								$('#sortable').sortable({
									update: function(event, ui) {
										var fruitOrder = $(this).sortable('toArray').toString();		
										$("#checkbox_values").val(fruitOrder);
									}
								});								
							});		
						</script>
					</tr>
					<tr>
						<th>Status:</th>
						<td>
							<input type="radio" id="status" name="status" checked="check" value="1" />Visible
							&nbsp;<input type="radio" id="status" name="status"  value="0" />Hidden
						</td>
					</tr>
					<tr>
						<td><input type="hidden" id="checkbox_values" name="checkbox_values" /></td>
						<td><input type="submit" id="save" name="save" value="Save" /></td>
					</tr>
				</table>
			</form>
		</div>
<?php elseif(isset($_GET['view_id'])): ?>	
		<?php $this->GetPageById(intval($_GET['view_id'])); ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?pages" style="color:#C60070;">Pages</a> : ID #<?=intval($_GET['view_id'])?></div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
			<form id="update_page" method="POST" action="<?=SERVER_URL?>?pages&updatepage">	
				<?php $status = (intval($this->rst['page_status'])); ?>
				<table id="product_table">
					<tr>
						<th>Title:</th>
						<td><input type="text" id="title" name="title" style="width:400px;" value="<?=$this->rst['page_title']?>" /></td>
					</tr>	
					<tr>
						<th>Link:</th>
						<td>
							<input type="text" id="deflink" name="deflink" style="width:200px;" /> Current Link: ( <i><?=$this->rst['page_link']?></i> )<br/>
							Input your own link of this menu (<i>e.g, video, games,..</i>) or Leave empty for the current link above.
						</td>
					</tr>
					<tr>
						<th>Content:</th>						
					</tr>
				</table>
				<textarea cols="80" id="content" name="content" rows="40"><?=$this->rst['page_content']?></textarea>			
				<script type="text/javascript">
					//<![CDATA[								
						CKEDITOR.replace( 'content',
						{
							filebrowserBrowseUrl :'<?=SERVER_URL?>js/ckeditor/filemanager/browser/default/browser.html?Connector=<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
							filebrowserImageBrowseUrl : '<?=SERVER_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
							filebrowserFlashBrowseUrl :'<?=SERVER_URL?>js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/connector.php',
							filebrowserUploadUrl  :'<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
							filebrowserImageUploadUrl : '<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
							filebrowserFlashUploadUrl : '<?=SERVER_URL?>js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
						});

					//]]>
				</script>
				<table id="product_table">
						<tr>
						<td valign="top">Widgets:</td>	
						<td>
							<div id="sortable">
							<?php $this->GetAllWidgets(); ?>
							<?php foreach($this->result_to_object() as $obj): ?>	
									<div class="each_data" id="<?=$obj->id?>">
									<?php $this->GetWidgetByPageId(intval($_GET['view_id']),intval($obj->id));?>
									<?php if($this->return_rows() > 0): ?>										
												<input type="checkbox" id="widget_type" name="widget_type[]" checked="checked" value="<?=$obj->id?>" /><?=$obj->widget_name?>
												<input type="hidden" id="hide_widget" name="hide_widget[]" value="<?=$obj->id?>" />										
									<?php else: ?>
												<input type="checkbox" id="widget_type" name="widget_type[]" value="<?=$obj->id?>" /><?=$obj->widget_name?>		
												<input type="hidden" id="hide_widget" name="hide_widget[]" value="<?=$obj->id?>" />
									<?php endif; ?>
									</div>
							<?php endforeach; ?>
							</div>
						</td>
						<script type="text/javascript">				
							$(document).ready(function() {
								$('#sortable').sortable({
									update: function(event, ui) {
										var fruitOrder = $(this).sortable('toArray').toString();		
										$("#checkbox_values").val(fruitOrder);
									}
								});								
							});		
						</script>
					</tr>
					<tr>
						<th>Status:</th>
						<td>
							<input type="radio" id="status" name="status" <?php echo $status == 1 ? 'checked="check"' : null; ?> value="1" />Visible
							&nbsp;<input type="radio" id="status" name="status" <?php echo $status == 0 ? 'checked="check"' : null; ?> value="0" />Hidden
						</td>
					</tr>
					<tr>
						<td><input type="hidden" id="checkbox_values" name="checkbox_values" /><input type="hidden" id="id" name="id" value="<?=intval($_GET['view_id'])?>" /></td>
						<td><input type="submit" id="save" name="update" value="Update" /></td>
					</tr>
				</table>
			</form>
		</div>
<?php elseif(isset($_GET['delete-by-id'])): ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?pages" style="color:#C60070;">Pages</a> : ID #: <?=intval($_GET['delete-by-id'])?></div>
			<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;"><br/>	
			<div style="border:1px solid orange; padding:10px; background-color:lemonchiffon; width:650px;">
				Are you sure you want to delete this <b>Page ID #: <?=intval($_GET['delete-by-id'])?></b>.?
				<a href="<?=SERVER_URL?>?pages&confirmdeletepageid=<?=intval($_GET['delete-by-id'])?>">Yes</a>&nbsp;/&nbsp;<a href="<?=SERVER_URL?>?pages">No</a>
			</div>	
		</div>
<?php else: ?>

<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">PAGES</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">
	<form method="POST" action="" >
	<div style="position:relative; overflow:hidden; width:650px; border:1px solid orange; background-color: lemonchiffon; height:auto; padding: 10px; margin:0 auto; margin-top:5px;">
		<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:right;">
			<a href="<?=SERVER_URL?>?pages&add" style="color:#666; font-size:11px;">+ Add</a>
		</div>		
	</div>	
	<table id="userlist">
		<tr>	
			<th style="text-align:left;">Page ID</th>
			<th style="text-align:left;">Title</th>
			<th style="text-align:left;">Status</th>			
			<th style="text-align:justify;">&nbsp;Delete</th>
		</tr>
		<?php $count = $this->GetAllPages(); ?>
		<?php foreach($this->result_to_object() as $obj): ?>
			<tr>
				<td><?=$obj->page_id?></td>
				<td><a href="<?SERVER_URL?>?pages&view_id=<?=$obj->page_id?>"><?=$obj->page_title?></a></td>
				<td><?=$obj->page_status?></td>
				<td><a href="<?=SERVER_URL?>?pages&delete-by-id=<?=$obj->page_id?>">Delete</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
		<div style="position:relative; overflow:hidden; width:500px; margin-left:50px;">
		<a href="<?=SERVER_URL?>?pages&page=<?php echo isset($_GET['page']) ? intval($_GET['page'] > 10) ? intval($_GET['page']-10) : 10 : 10;?>"><img src="<?SERVER_URL?>images/arrow_left.png" width="16" height="16" /></a>
		<?php $boldNum = 0; if(isset($_GET['page'])) $boldNum = intval($_GET['page']/10); ?>
		<?php for($i=1; $i<=$count; $i++): ?>				
				<a <?php echo ($i==$boldNum) ? 'style="font-weight:bold; color:#000; font-size:16px;"' : ''; ?> href="<?=SERVER_URL?>?page&page=<?=($i*10)?>"><?=$i?></a>
		<?php endfor; ?>
		<a href="<?=SERVER_URL?>?page&page=<?php echo isset($_GET['page']) ? intval($_GET['page']) < intval($count*10) ? intval($_GET['page']+10) : intval($_GET['page']) : 10;?>"><img src="<?SERVER_URL?>images/arrow_right.png" width="16" height="16" /></a>
	</div>
	<div style="position:relative; overflow:hidden; padding:3px; float:right; border:1px solid orange; background-color:lemonchiffon; margin-right:50px; margin-bottom:5px;">
		Click the title of the page to view and or edit content.
	</div>
</div>
	
<?php endif; ?>
<?php include('template/content_bottom.php'); ?>		
	
		