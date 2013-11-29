<?php $imageLink = getPhotoToCrop(intval($_SESSION['id']));  ?>
<?php if(strlen($imageLink) > 0): ?>								
<link rel="stylesheet" type="text/css" href="css/upload/upload.css" />
<link rel="stylesheet" href="js/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="js/cropstyle.css" type="text/css" />
<script src="js/jquery.min.js"></script>
<script src="js/jquery.Jcrop.js"></script>
<script language="Javascript">
	$(function(){

		$('#cropbox').Jcrop({
			aspectRatio: 1,
			onSelect: updateCoords
		});

	});

	function updateCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};

	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('Please select a crop region then press submit.');
		return false;
	};
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
					  <h3>Crop Photo</h3>
					  <div class="adModContentInnerText userCurrentActivity pointSumm" style="height:auto;">						 
						<div id="mainbody" style="position:relative; overflow:hidden; width:auto; height:auto; ">																																									
							<img src="<?=SERVER_URL?>/user_upload/<?=intval($_SESSION['id'])?>/<?=$imageLink?>" alt="<?=$imageLink?>" id="cropbox" width="auto" height="auto" />
							<form action="lib/crop.php" method="post" onsubmit="return checkCoords();">
								<input type="hidden" id="x" name="x" />
								<input type="hidden" id="y" name="y" />
								<input type="hidden" id="w" name="w" />
								<input type="hidden" id="h" name="h" />
								<input type="hidden" id="imgname" name="imgname" value="<?=SERVER_URL?>/user_upload/<?=intval($_SESSION['id'])?>/<?=$imageLink?>" />
								<input type="submit" id="continue" name="submit" value="Save" />
							</form>																				
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
<?php else: ?>
<?php $this->redirect_to(SERVER_URL."?edit_photo")?>
<?php endif; ?>
