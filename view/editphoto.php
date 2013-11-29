<script type="text/javascript" src="scripts/uploadjs/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="css/upload/upload.css" />
<script type="text/javascript" >
	$(function(){
		$("#moreOptions").hide();
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'lib/upload-file.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response==="success"){
					$('<li></li>').appendTo('#files').html('<img src="user_upload/<?=$_SESSION['id']?>/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}				
				$("#upload").remove();
				$("#moreOptions").show();
			}
		});		
	});
</script>
<div class="containers" style="height:auto;">
  <div class="profileTable" style="height:auto;">
	<div class="profileTableRow" style="height:auto;">
	<div class="profileTableCell" style="height:auto;">		
		<div class="containers" style="height:auto;">		
			  <div class="profileTable" style="height:auto;">
				<div class="profileTableRow" style="height:auto;">
				  <div class="profileTableCell" style="height:auto;">
				  <div class="adModBlue" style="width:900px; height:auto;">
					<div class="adModBlueContent">
					  <h3>Photo Upload</h3>
					  <div class="adModContentInnerText userCurrentActivity pointSumm" style="height:auto;">	
					  
						<div id="mainbody" style="position:relative; overflow:hidden; width:auto; height:auto; ">																
							<ul id="files" ></ul>
							
							<div id="upload" style="float:left; position:relative; overflow:hidden; margin-left:10px;"><span>Select Photo<span></div>
							<span id="status" ></span>		
							
							<div id="moreOptions" style="position:realative; overflow:hidden; width:auto; height:auto; clear:both; float:left;">
								<div id="continue" style="float:left; position:relative; overflow:hidden; margin-left:10px;"><span><a href="<?=SERVER_URL?>?crop_image">Continue to crop</a><span></div>
								<div id="save" style="float:left; position:relative; overflow:hidden; margin-left:-180px;"><span><a href="<?=SERVER_URL?>?savephoto">Save</a><span></div>
							</div>
							
						</div>	
						
					  </div>
					</div>
				  </div>
					
				  </div><!--profileTableCell -->
				  <div class="profileTableCell"> <!--review ends --><!--review ends --></div><!--profileTableCell -->
				</div>
			  </div>
		  
		</div><!-- END CONTAINERS -->
				
	 </div>
	  
	</div>
  </div>
</div>

<div class="containers">
  <div class="profileTable">
	<div class="profileTableRow">
	  <div class="profileTableCell">
	 <?php include_once("view/points_summary.php"); ?>
	  </div><!--profileTableCell -->
	  <div class="profileTableCell"> <!--review ends --><!--review ends --></div><!--profileTableCell -->
	</div>
  </div>
</div>