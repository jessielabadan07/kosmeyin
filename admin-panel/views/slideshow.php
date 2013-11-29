<?php include('template/content_top.php'); ?>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">PHOTO SLIDESHOW</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; margin-bottom:20px;">
	<?php if(isset($_GET['upload_new'])): ?>
			<script type="text/javascript">
				$(document).ready(function(){
				
					$('.add_field').click(function(){
				
						var input = $('#input_clone');
						var clone = input.clone(true);
						clone.removeAttr ('id');
						clone.val('');
						clone.appendTo('.input_holder'); 
						
					});

					$('.remove_field').click(function(){
					
						if($('.input_holder input:last-child').attr('id') != 'input_clone'){
							$('.input_holder input:last-child').remove();
						}
					
					});
					
					
					
				});
			
			</script>
			<?php
				//Check if there are any files ready for upload
				if(isset($_FILES['uploaded_files']))
				{
					//For each file get the $key so you can check them by their key value
					foreach($_FILES['uploaded_files']['name'] as $key => $value)
					{
					
						//If the file was uploaded successful and there is no error
						if(is_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key]) &&	$_FILES['uploaded_files']['error'][$key] == 0)
						{
							
							//Create an unique name for the file using the current timestamp, an random number and the filename			
							$filename = $_FILES['uploaded_files']['name'][$key];
							$filename = time().rand(0,999).$filename;
							$directory = '../scripts/slideshow/';
							
							$this->query("INSERT INTO image_gallery VALUES(NULL,'$filename','',1,NOW())", $this->ERROR_INSERT);
							
							//Check if the file was moved
							if(move_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key], $directory.$filename))
							{
								echo 'The file ' . $_FILES['uploaded_files']['name'][$key].' was uploaded successful <br/>';
								$this->redirect_to(SERVER_URL.'?slideshow');
							}
							else
							{
							echo move_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key], 'uploads/'. $filename);
								echo 'The file was not moved.';
							}
								
						}
						else
						{
							echo 'The file was not uploaded.';
						}
					}
				}
			
			?>
			<form method="POST" action="" enctype="multipart/form-data">	
				<span class="add_field" style="position:relative; overflow:hidden; width:10px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; font-size:14px; font-weight:bold; cursor:pointer; margin-left:5px;">+</span>		
				<span class="remove_field" style="margin-right: 5px;position:relative; overflow:hidden; width:10px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; font-size:14px; font-weight:bold; cursor:pointer;">-</span>		
				<div style="clear:both; position:relative; overflow:hidden; padding-top:10px;">
					<div class="input_holder">
						<input type="file" name="uploaded_files[]" id="input_clone" />
					</div>
					<input type="submit" value="Upload Files" />
				</div>
			</form>
	<?php else: ?>
			<div style="position:relative; overflow:hidden; width:120px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; cursor:pointer; margin:20px; float:left; "><a href="<?=SERVER_URL?>?slideshow&upload_new" >Upload New Photo</a></div>		
			<div style="position:relative; overflow:hidden; width:150px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; cursor:pointer; margin:20px; float:left; "><a href="javascript:;" id="delete_photos" >Delete Selected Photo</a></div>		
			<table style="font-size:12px; color:#666; clear:both;">
				<tr style="text-align:justify; padding:5px; color:#3399ff; background-color:#ddd;">	
					<th style="text-align:justify; padding:15px; width:5px;">
						<input type="checkbox" id="delphoto" name="delphoto" />
					</th>
					<th style="text-align:justify; padding:15px; width:auto;">Name</th>			
					<th style="text-align:justify; padding:15px; width:5px;">Status</th>
					<th style="text-align:justify; padding:15px;">Date Uploaded</th>
				</tr>
				<?php foreach($this->result_to_object() as $obj): ?>
					<tr style="text-align:justify; padding:5px; background-color:#efefef; color:#888; ">
						<td style="text-align:justify; padding:15px; width:5px;">
							<input type="checkbox" id="<?=$obj->id?>" name="delphotos" />
						</td>
						<td>
							<img src="<?=USER_DIR?>scripts/slideshow/<?=$obj->gallery_image?>" width="300" height="100" /> <br/>
							<?=$obj->gallery_image?>
						</td>
						<td><center>
							<?php if($obj->status==1): ?>
									<a href="javascript:;" class="vis_img" id="<?=$obj->id?>" style="text-decoration:underline;">visible</a>
							<?php else: ?>
									<a href="javascript:;" class="hid_img" id="<?=$obj->id?>" style="text-decoration:underline;">hidden</a>
							<?php endif; ?>		</center>					
						</td>
						<td style="text-align:justify; padding:15px;"><?=date('Y-m-d', strtotime($obj->dateadded))?></td>
					</tr>
				<?php endforeach;?>
			</table>	
	<?php endif; ?>
</div>
<?php include('template/content_bottom.php'); ?>