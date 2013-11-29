<script type="text/javascript" src="<?=SERVER_URL?>js/ckeditor/ckeditor.js"></script>
<script src="<?=SERVER_URL?>js/ck-script.js" type="text/javascript"></script>
<link href="<?=SERVER_URL?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function imageURL(input) {	
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview_img').attr('src', e.target.result)
				.width('201px')
				.height('126px');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
<?php include('template/content_top.php'); ?>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article" style="color:#C60070;">Article</a> : Add New+</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">	
	<form id="add_article" method="POST" action="<?=SERVER_URL?>?article&add_article" enctype="multipart/form-data">	
		<table id="product_table">
			<tr>
				<td>Title:</td>
				<td><input type="text" id="title" name="title" style="width:400px;" ></td>
			</tr>
			<tr>
				<td><h3>Optional Image Caption:</h3></td>
				<td><input type="file" name="photoimg" id="photoimg" class="file" onchange="imageURL(this)" /></td>
			</tr>			
		</table>
		<img id="preview_img" style="width:201px; height:126px;" />
		<h3>Front Text Display</h3>
		<textarea cols="80" id="fronttext" name="fronttext" rows="40"></textarea>			
		<script type="text/javascript">
			//<![CDATA[								
				CKEDITOR.replace( 'fronttext',
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
		<h3>Article Content: </h3>
		<textarea cols="80" id="editor1" name="description" rows="40"></textarea>					
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
			<table class="check_table" id="product_table" style="border: 1px solid #ddd; width:940px; margin-bottom:10px; margin-top:-80px;">
				<tr>
					<th style="text-align:left;">Add Category</th>
					<td>&nbsp;</td>
				</tr>
				<?$this->GetAllCategory()?>
				<?php foreach($this->result_to_object() as $obj): ?>
						<tr>
							<td><input type="checkbox" id="categorylist" name="categorylist[]" value="<?=$obj->cat_id?>" /><?=$obj->cat_title?></td>
							<br/><br/>
						</tr>
				<?php endforeach; ?>
			</table>
			<span style="font-weight:bold; color:#333; text-decoration:underline;"><a href="#login-box" class="login-window">Add New Category+</a></span>
			<table id="product_table" style="border: 1px solid #ddd; width:940px; margin: 5px 0 10px 0;">
				<tr>
					<td style="text-align:left;"><b>Add Tags:</b>&nbsp;&nbsp;(separated by comma: beauty, health, product...)</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><input type="text" id="tags" name="tags" style="width:350px;" /></td>
				</tr>
			</table>
			<div style="border:1px solid #ddd; width:940px;"></div>
			<table id="product_table">
				<tr>
					<td>Status:</td>
					<td>
						<input type="radio" id="status" name="status" checked="check" value="1" />Publish
						&nbsp;<input type="radio" id="status" name="status"  value="0" />Unpublish
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" id="save" name="save" value="Save" /></td>
				</tr>
			</table>
	</form>
	<!--<input type="button" id="ad" name="ad" value="Add" />-->
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
								$("table.check_table tr:last").after('<tr><td><input type="checkbox" id="newcategorylist" checked="checked" name="categorylist[]" value="'+msg+'" />'+ cat_name +'&nbsp;&nbsp;<i>('+ cat_alias +')</i></td></tr>');				
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
</div>
<?php include('template/content_bottom.php'); ?>			
		