<?php include('template/content_top.php'); ?>
<script type="text/javascript" src="<?=SERVER_URL?>js/ckeditor/ckeditor.js"></script>
<script src="<?=SERVER_URL?>js/ck-script.js" type="text/javascript"></script>
<link href="<?=SERVER_URL?>css/style.css" rel="stylesheet" type="text/css" />
<?php if(isset($_GET['contentmenu_id'])): ?>			
		<?=$this->GetTitleMenuById($_GET['contentmenu_id'])?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?menus" style="color:#C60070;">Menu</a> : <?=$this->rst['menu_text']?></div>		
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
			<form id="add_article" method="POST" action="<?=SERVER_URL?>?menus&updatemenu_id=<?=intval($_GET['contentmenu_id'])?>" enctype="multipart/form-data">					
				<p><span style="font-weight:normal; font-size:14px; ">Menu Name:</span>&nbsp;<input type="text" name="menu_name" id="menu_name" value="<?=$this->rst['menu_text']?>" style="padding:5px; width:500px;" /></p>
				<p><span style="font-weight:normal; font-size:14px; ">Menu Link:</span>&nbsp;<input type="text" name="menu_link" id="menu_link" value="<?=$this->rst['menu_link']?>" style="padding:5px; width:500px;" />
				(<i>Leave this empty if you don't want this page to be static.</i>)</p>
				<?$this->GetContentMenuById($_GET['contentmenu_id'])?>
				<textarea cols="80" id="editor1" name="description" rows="40"><?=$this->rst['sitemenu_content']?></textarea>					
				<script type="text/javascript">
					//<![CDATA[								
						CKEDITOR.replace( 'editor1',
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
				<div style="margin:5px;">Add a Article Category for this Menu.</div>
				<table id="product_table" class="submenu_child" style="border: 1px solid #ddd; width:940px; margin-bottom:10px; margin-top:20px;">
						<?$this->GetAllCategory()?>	
						<?php foreach($this->result_to_object() as $obj): ?>
							<?php if($this->GetMenuCategoryById(intval($_GET['contentmenu_id']),$obj->cat_id,'article') > 0): ?>
									<tr>
										<td>&nbsp;</td>
										<td><input type="checkbox" id="menucat_id" name="menucat_id[]" checked="checked" value="<?=$obj->cat_id?>" />&nbsp;<?=$obj->cat_title?>
										<input type="hidden" id="menuhide_id" name="menuhide_id[]" value="<?=$obj->cat_id?>" />
										&nbsp;(<i><?=$obj->cat_alias?></i>)</td>
									</tr>
							<?php else: ?>
									<tr>
										<td>&nbsp;</td>
										<td><input type="checkbox" id="menucat_id" name="menucat_id[]" value="<?=$obj->cat_id?>" />&nbsp;<?=$obj->cat_title?>
										<input type="hidden" id="menuhide_id" name="menuhide_id[]" value="<?=$obj->cat_id?>" />
										&nbsp;(<i><?=$obj->cat_alias?></i>)</td>
									</tr>
							<?php endif; ?>
						<?php endforeach; ?>				
				</table>
				<table id="product_table">
					<tr>
						<th style="text-align:left;"><a href="#login-box" class="login-window">+ New Article Category</a></th>
						<td>&nbsp;</td>
					</tr>				
				</table>
				<div style="margin:5px;">Add a Static Page for this Menu.</div>
				<table id="product_table" style="border: 1px solid #ddd; width:940px; margin-bottom:10px; margin-top:20px;">
					<?$this->GetAllPages()?>	
					<?php foreach($this->result_to_object() as $obj): ?>
					<?php if($this->GetMenuCategoryById(intval($_GET['contentmenu_id']),$obj->page_id,'page') > 0): ?>
						<tr>
							<td>&nbsp;</td>
							<td><input type="checkbox" id="page_id" name="page_id[]" checked="checked" value="<?=$obj->page_id?>" />&nbsp;<?=$obj->page_title?>
							<input type="hidden" id="pagehide_id" name="pagehide_id[]" value="<?=$obj->page_id?>" />
							&nbsp;(<i><?=$obj->page_link?></i>)</td>
						</tr>
					<?php else: ?>
						<tr>
							<td>&nbsp;</td>
							<td><input type="checkbox" id="page_idd" name="page_id[]" value="<?=$obj->page_id?>" />&nbsp;<?=$obj->page_title?>
							<input type="hidden" id="pagehide_id" name="pagehide_id[]" value="<?=$obj->page_id?>" />
							&nbsp;(<i><?=$obj->page_link?></i>)</td>
						</tr>
					<?php endif; ?>
					<?php endforeach; ?>							
				</table>
				<table id="product_table">
					<tr>
						<td valign="top">Widgets:</td>	
						<td>
						<div id="sortable">						
						<?php $this->GetAllWidgets(); ?>
						<?php foreach($this->result_to_object() as $obj): ?>	
								<div class="each_data" id="<?=$obj->id?>">
								<?php $this->GetWidgetById(intval($_GET['contentmenu_id']),intval($obj->id));?>
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
					</tr>
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
					<tr>
						<td>Status:</td>
						<td>
							<input type="radio" id="status" name="status" checked="check" value="1" />Publish
							&nbsp;<input type="radio" id="status" name="status"  value="0" />Hidden
						</td>
					</tr>
					<tr>
						<td><input type="hidden" id="post_id" name="post_id" value="<?=intval($_GET['contentmenu_id'])?>" /><input type="hidden" id="checkbox_values" name="checkbox_values" /></td>
						<td><input type="submit" id="save" name="save" value="Update" /></td>
					</tr>
				</table>
			</form>
		</div>				
		<div id="login-box" class="login-popup">
		<a href="#" class="close"><img src="<?=SERVER_URL?>/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
		  <form method="post" class="signin" action="#">
			<fieldset class="textbox">
				<label class="username">
					<span>Category Name</span>
					<input id="cat_name" name="cat_name" type="text" autocomplete="on" />
				</label>			
				<label class="Alias">
					<span>Alias</span>
					<input id="cat_alias" name="cat_alias" type="text" autocomplete="on" />
				</label>				
				<button class="submit button" id="ad" type="button">Add Category</button>				
			</fieldset>
		  </form>
		</div>	
		<link type="text/css" rel="stylesheet" href="<?=SERVER_URL?>css/form_style.css"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {		
				var cat_name = 0;
				var cat_alias = 0;
			
				$('a.login-window').click(function() {
					
					// Getting the variable's value from a link 
					var loginBox = $(this).attr('href');

					//Fade in the Popup and add close button
					$(loginBox).fadeIn(300);
					
					//Set the center alignment padding + border
					var popMargTop = ($(loginBox).height() + 24) / 2; 
					var popMargLeft = ($(loginBox).width() + 24) / 2; 
					
					$(loginBox).css({ 
						'margin-top' : -popMargTop,
						'margin-left' : -popMargLeft
					});
					
					// Add the mask to body
					$('body').append('<div id="mask"></div>');
					$('#mask').fadeIn(300);
													
					return false;
				});
				
				// When clicking on the button close or the mask layer the popup closed
				$('a.close, #mask').live('click', function() { 
					  $('#mask , .login-popup').fadeOut(300 , function() {
						$('#mask').remove();  
					}); 
					return false;
				});
				
				$('#ad').click(function() {
					cat_name = $('#cat_name').val();
					cat_alias = $('#cat_alias').val();
					$.ajax({
						type: "POST",
							url: "lib/category.php",
							data: "name="+cat_name+"&alias="+cat_alias,
							cache: false,
							success: function(msg){			
								if(msg > 0) {
									$("table.submenu_child tr:last").after('<tr><td>&nbsp;</td><td><input type="checkbox" id="menucat_id" checked="checked" name="menucat_id[]" value="'+msg+'" />'+ cat_name +'&nbsp;&nbsp;<i>('+ cat_alias +')</i></td></tr>');				
								} else {
									alert("Category Title already exist. Please select another Category Name.");
								}						
							}
					});
					$('#mask , .login-popup').fadeOut(300 , function() {
						$('#mask').remove();  
					}); 
					return false;
					
				});
							
			});
		</script>
<?php elseif(isset($_GET['updatemenu_id'])) :?>

	<?php $this->UpdateMenuContent(); ?>		
	
<?php elseif(isset($_GET['new_menu'])): ?>	
			<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?menus" style="color:#C60070;">Menu</a> : New Parent Menu</div>		
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">			
			<form id="add_article" method="POST" action="<?=SERVER_URL?>?saveparentmenuitem">					
				<p><span style="font-weight:normal; font-size:14px; ">Menu name: <br/><span style="font-size:10px; font-style:italic; ">Please input the name of your parent menu to be display in the homepage.</span>:</span>&nbsp;<input type="text" name="menu_name" id="menu_name" style="padding:5px; width:500px;" /></p>							
				<p><span style="font-weight:normal; font-size:14px; ">Menu link: <br/><span style="font-size:10px; font-style:italic; ">Leave this empty if you don't want this page to be static.</span>:</span>&nbsp;<input type="text" name="menu_link" id="menu_link" style="padding:5px; width:500px;" /></p>							
				<p><span style="font-weight:normal; font-size:14px; ">Menu Content<br/><span style="font-size:10px; font-style:italic; ">Write the content of your parent menu to be display in the homepage.</span>:</span></p>
				<textarea cols="80" id="editor1" name="menu_desc" rows="40"></textarea>					
				<script type="text/javascript">
					//<![CDATA[								
						CKEDITOR.replace( 'editor1',
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
				<div style="margin:5px;">Add a Article Category for this Menu.</div>
				<table id="product_table" class="submenu_child" style="border: 1px solid #ddd; width:940px; margin-bottom:10px; margin-top:20px;">
					<?$this->GetAllCategory()?>	
					<?php foreach($this->result_to_object() as $obj): ?>
					<tr>
						<td>&nbsp;</td>
						<td><input type="checkbox" id="menucat_id" name="menucat_id[]" value="<?=$obj->cat_id?>" />&nbsp;<?=$obj->cat_title?>
						&nbsp;(<i><?=$obj->cat_alias?></i>)</td>
					</tr>
					<?php endforeach; ?>							
				</table>
				<table id="product_table">
					<tr>
						<th style="text-align:left;"><a href="#login-box" class="login-window">+ New Article Category</a></th>
						<td>&nbsp;</td>
					</tr>				
				</table>
				<!--<table id="product_table" style="border: 1px solid #ddd; margin-bottom:10px; margin-top:20px;">
					<tr>											
						<td valign="top">Optional Widgets:</td>	
						<td>
						<div id="sortable">
						<?php $this->result = null; ?>
						<?php $this->GetAllWidgets(); ?>
						<?php foreach($this->result_to_object() as $obj): ?>	
								<div class="each_data" id="<?=$obj->id?>">
									<input type="checkbox" id="widget_type" name="widget_type[]" value="<?=$obj->id?>" /><?=$obj->widget_name?>		
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
				</table>-->
				<div style="margin:5px;">Add a Static Page for this Menu.</div>
				<table id="product_table" class="submenu_child" style="border: 1px solid #ddd; width:940px; margin-bottom:10px; margin-top:20px;">
					<?$this->GetAllPages()?>	
					<?php foreach($this->result_to_object() as $obj): ?>
					<tr>
						<td>&nbsp;</td>
						<td><input type="checkbox" id="page_id" name="page_id[]" value="<?=$obj->page_id?>" />&nbsp;<?=$obj->page_title?></td>
					</tr>
					<?php endforeach; ?>							
				</table>
				<table id="product_table" style="margin-bottom:10px; margin-top:20px;">
					<tr>
						<td>Menu Type</td>
						<td>
							<input type="radio" id="menu_type" name="menu_type" checked="check" value="top_menu" />Header
							&nbsp;<input type="radio" id="menu_type" name="menu_type"  value="bottom_menu" />Footer
						</td>
					</tr>
					<tr>
						<td>Status:</td>
						<td>
							<input type="radio" id="status" name="status" checked="check" value="1" />Publish
							&nbsp;<input type="radio" id="status" name="status"  value="0" />Unpublish
						</td>
					</tr>
					<tr>
						<td><input type="hidden" id="checkbox_values" name="checkbox_values" /></td>
						<td><input type="submit" id="save" name="save" value="Save" /></td>
					</tr>
				</table>
			</form>
		</div>		
		<div id="login-box" class="login-popup">
		<a href="#" class="close"><img src="<?=SERVER_URL?>/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
		  <form method="post" class="signin" action="#">
			<fieldset class="textbox">
				<label class="username">
					<span>Category Name</span>
					<input id="cat_name" name="cat_name" type="text" autocomplete="on" />
				</label>			
				<label class="Alias">
					<span>Alias</span>
					<input id="cat_alias" name="cat_alias" type="text" autocomplete="on" />
				</label>				
				<button class="submit button" id="ad" type="button">Add Category</button>				
			</fieldset>
		  </form>
		</div>	
		<link type="text/css" rel="stylesheet" href="<?=SERVER_URL?>css/form_style.css"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {		
				var cat_name = 0;
				var cat_alias = 0;
			
				$('a.login-window').click(function() {
					
					// Getting the variable's value from a link 
					var loginBox = $(this).attr('href');

					//Fade in the Popup and add close button
					$(loginBox).fadeIn(300);
					
					//Set the center alignment padding + border
					var popMargTop = ($(loginBox).height() + 24) / 2; 
					var popMargLeft = ($(loginBox).width() + 24) / 2; 
					
					$(loginBox).css({ 
						'margin-top' : -popMargTop,
						'margin-left' : -popMargLeft
					});
					
					// Add the mask to body
					$('body').append('<div id="mask"></div>');
					$('#mask').fadeIn(300);
													
					return false;
				});
				
				// When clicking on the button close or the mask layer the popup closed
				$('a.close, #mask').live('click', function() { 
					  $('#mask , .login-popup').fadeOut(300 , function() {
						$('#mask').remove();  
					}); 
					return false;
				});
				
				$('#ad').click(function() {
					cat_name = $('#cat_name').val();
					cat_alias = $('#cat_alias').val();
					$.ajax({
						type: "POST",
							url: "lib/category.php",
							data: "name="+cat_name+"&alias="+cat_alias,
							cache: false,
							success: function(msg){			
								if(msg > 0) {
									$("table.submenu_child tr:last").after('<tr><td>&nbsp;</td><td><input type="checkbox" id="menucat_id" checked="checked" name="menucat_id[]" value="'+msg+'" />'+ cat_name +'&nbsp;&nbsp;<i>('+ cat_alias +')</i></td></tr>');				
								} else {
									alert("Category Title already exist. Please select another Category Name.");
								}						
							}
					});
					$('#mask , .login-popup').fadeOut(300 , function() {
						$('#mask').remove();  
					}); 
					return false;
					
				});
							
			});
		</script>
<?php elseif(isset($_GET['new_submenu'])): ?>		
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?menus" style="color:#C60070;">Menu</a> : New Submenu</div>		
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
			<form id="add_article" method="POST" action="<?=SERVER_URL?>?savemenuitem">					
				<p><span style="font-weight:normal; font-size:14px; ">Submenu Name<br/><span style="font-size:10px; font-style:italic; ">Please input the name of your submenu item to be display in the homepage..</span>:</span>&nbsp;<input type="text" name="submenu_name" id="submenu_name" style="padding:5px; width:500px;" /></p>							
				<p><span style="font-weight:normal; font-size:14px; ">SubMenu Content<br/><span style="font-size:10px; font-style:italic; ">Write the content of your sub-menu to be display in the homepage.</span>:</span></p>
				<textarea cols="80" id="editor1" name="submenu_desc" rows="40"><?=$this->rst['sitemenu_content']?></textarea>					
				<script type="text/javascript">
					//<![CDATA[								
						CKEDITOR.replace( 'editor1',
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
				<fieldset style="width:800px; margin:10px;"><legend>Add a parent menu of this submenu if you wish to see it on the homepage dropdown menu.</legend>
					<table id="product_table">
						<tr>
							<td><span style="font-weight:normal; font-size:14px; ">Site Menu:</span></td>
						</tr>	
						<?$this->GetAllMenus()?>	
						<?php foreach($this->result_to_object() as $obj): ?>
						<tr>
							<td>&nbsp;</td>
							<td><input type="checkbox" id="sitemenu_id" name="sitemenu_id[]" value="<?=$obj->id?>" />&nbsp;<?=$obj->menu_text?>
							&nbsp;(<i><?=$obj->menu_type?></i>)</td>
						</tr>
						<?php endforeach; ?>				
					</table>
				</fieldset>
				<table id="product_table">
					<tr>											
						<td valign="top">Optional Widgets:</td>	
						<td>
						<div id="sortable">
						<?php $this->result = null; ?>
						<?php $this->GetAllWidgets(); ?>
						<?php foreach($this->result_to_object() as $obj): ?>	
								<div class="each_data" id="<?=$obj->id?>">
									<input type="checkbox" id="widget_type" name="widget_type[]" value="<?=$obj->id?>" /><?=$obj->widget_name?>		
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
						<td>Status:</td>
						<td>
							<input type="radio" id="status" name="status" checked="check" value="1" />Publish
							&nbsp;<input type="radio" id="status" name="status"  value="0" />Unpublish
						</td>
					</tr>
					<tr>
						<td><input type="hidden" id="checkbox_values" name="checkbox_values" /></td>
						<td><input type="submit" id="save" name="save" value="Save" /></td>
					</tr>
				</table>
			</form>
		</div>				
<?php elseif(isset($_GET['contentsubmenu_id'])): ?>				
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?menus" style="color:#C60070;">Menu</a> : Edit Submenu item # <?=$id=intval($_GET['contentsubmenu_id'])?></div>		
		<?$this->GetSubMenuById($id)?>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
			<form id="add_article" method="POST" action="<?=SERVER_URL?>?menus&updatemenuitem">					
				<p><span style="font-weight:normal; font-size:14px; ">Submenu Name<br/><span style="font-size:10px; font-style:italic; ">Please input the name of your submenu item to be display in the homepage..</span>:</span>&nbsp;<input type="text" name="submenu_name" id="submenu_name" style="padding:5px; width:500px;" value="<?=$this->rst['submenu_name']?>" /></p>							
				<p><span style="font-weight:normal; font-size:14px; ">SubMenu Content<br/><span style="font-size:10px; font-style:italic; ">Write the content of your sub-menu to be display in the homepage.</span>:</span></p>
				<textarea cols="80" id="editor1" name="submenu_desc" rows="40"><?=$this->rst['submenu_content']?></textarea>					
				<script type="text/javascript">
					//<![CDATA[								
						CKEDITOR.replace( 'editor1',
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
				<fieldset style="width:800px; margin:10px;"><legend>Current parent menu of this submenu.</legend>
					<table id="product_table">
						<tr>
							<td><span style="font-weight:normal; font-size:14px; ">Parent Menu:</span></td>
						</tr>	
						<?$this->GetAllMenus()?>	
						<?php foreach($this->result_to_object() as $obj): ?>
						<tr>
							<td>&nbsp;</td>
							<td>
							<?php if($this->SelectParentMenuById($id)==intval($obj->id)): ?>
									<input type="checkbox" id="sitemenu_id" name="sitemenu_id[]" checked="check" value="<?=$obj->id?>" />&nbsp;<?=$obj->menu_text?>
									&nbsp;(<i><?=$obj->menu_type?></i>)
							<?php else: ?>
									<input type="checkbox" id="sitemenu_id" name="sitemenu_id[]" value="<?=$obj->id?>" />&nbsp;<?=$obj->menu_text?>
									&nbsp;(<i><?=$obj->menu_type?></i>)
							<?php endif; ?>
							</td>
						</tr>
						<?php endforeach; ?>				
					</table>
				</fieldset>
				<table id="product_table">
					<tr>
						<td valign="top">Widgets:</td>	
						<td>
						<div id="sortable">
						<?php $this->GetAllWidgets(); ?>
						<?php foreach($this->result_to_object() as $obj): ?>	
								<div class="each_data" id="<?=$obj->id?>">
								<?php $this->GetWidgetBySubMenuId(intval($id),intval($obj->id));?>
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
						<td>Status:</td>
						<td>
							<input type="radio" id="status" name="status" checked="check" value="1" />Publish
							&nbsp;<input type="radio" id="status" name="status"  value="0" />Unpublish
						</td>
					</tr>
					<tr>
						<td><input type="hidden" id="checkbox_values" name="checkbox_values" /></td>						
						<td><input type="hidden" id="submenu_id" name="submenu_id" value="<?=$id?>" /><input type="submit" id="update_submenu" name="update_submenu" value="Update" /></td>
					</tr>
				</table>
			</form>
		</div>				
<?php elseif(isset($_GET['updatemenuitem'])): ?>
<?php 		$this->UpdateSubMenuItem(); ?>			
<?php else: ?>
			<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article&menus" style="color:#C60070;">Menu</a></div>
			<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
				<div style="position:relative; overflow:hidden; width:650px; border:1px solid #fff; background-color: #fff; height:auto; padding: 10px; margin:0 auto; margin-top:5px; float:left;">				
					<div style="position:relative; overflow:hidden; width:65px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left;">
						<a href="<?=SERVER_URL?>?menus&new_menu" style="color:#666; font-size:11px;">+ New Menu</a>
					</div>	
					<div style="margin-left:5px;position:relative; overflow:hidden; width:80px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left;">
						<a href="javascript:;" id="del_menu" style="color:#666; font-size:11px;">x Delete Menu</a>
					</div>
					<!--<div style="margin-left:5px;position:relative; overflow:hidden; width:80px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left;">
						<a href="<?=SERVER_URL?>?menus&new_submenu" style="color:#666; font-size:11px;">+ New SubMenu</a>
					</div>-->					
				</div>
				<table style="font-size:12px; color:#666;">
					<tr style="text-align:justify; padding:5px; color:#3399ff; background-color:#ddd;">	
						<th style="text-align:justify; padding:15px; width:5px;">
							<input type="checkbox" id="deleteallmenu" name="deleteallmenu" />
						</th>
						<th style="text-align:justify; padding:15px; width:200px;">Name</th>
						<th style="text-align:justify; padding:15px; width:300px;">SubMenu</th>					
						<th style="text-align:justify; padding:15px; width:50px;">Type</th>
						<th style="text-align:justify; padding:15px; width:50px;">Status</th>
						<th style="text-align:justify; padding:15px;">Date Created</th>
					</tr>
					<?$this->GetAllMenus()?>
					<?php $i=0; foreach($this->result_to_object() as $obj): ?>
						<?php 
								echo ($i%2==0) ? '<tr style="background-color:#f1f1f1;">' : '<tr style="background-color:#ddd;">';						
						?>
							<td style="text-align:justify; padding:15px; width:5px;" valign="top">
								<input type="checkbox" id="<?=$obj->id?>" name="delete_menus" />
							</td>
							<td valign="top" style="padding-left:5px;"><a href="<?=SERVER_URL?>?menus&contentmenu_id=<?=intval($obj->id)?>"><?=$obj->menu_text?></a></td>
							<td>
								<?$this->GetAllSubMenuByMenuId($obj->id);?>
								<?$this->GetAllSubPageMenuById($obj->id);?>
							</td>
							<td style="padding-left:5px;"><?=$obj->menu_type?></td>
							<td style="padding-left:5px;"><?=($obj->menu_status==1) ? '<span style="color:green;">published</span>':'<span style="color:#f00;">hidden</span>'?></td>
							<td style="padding-left:5px;"><?=date("Y-m-d", strtotime($obj->date_added))?></td>
									
					<?php $i++; endforeach; ?>
					
				</table>
				<div style="position:relative; overflow:hidden; padding:3px; float:left; border:1px solid orange; background-color:lemonchiffon; margin-right:50px; margin-bottom:5px;">
					Click the name of the menu to view/edit content.
				</div>
			</div>
<?php endif; ?>
<?php include('template/content_bottom.php'); ?>		
	
		