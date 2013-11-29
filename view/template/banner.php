<?php $arrImages = array(); getImages($arrImages); ?>
<div class="adTable">
  <div class="adTableRow">
	<div class="adTableCell"><!--<img src="images/slideShowAd.jpg" width="708" height="222" alt="dd"> --><!--09212012 -->
		<div class="slideCont">
		  <div id="defense">		   
			<div id="slideshow" class="pics" style="margin:auto;clear:left;">
				<?php $this->GetImageGallery(); ?>
				<?php if($this->return_rows() > 0): ?>
					<?php foreach($this->result_to_object() as $obj): ?>
							<img src="<?=SERVER_URL?>scripts/slideshow/<?=$obj->gallery_image?>" alt= "<?=$obj->id?>" width="708" height="222">
					<?php endforeach; ?>
				<?php else: ?>
						<?php foreach($arrImages as $image) : ?>
								<img src="<?=SERVER_URL?>scripts/slideshow/<?=$image?>" width="708" height="222">
						<?php endforeach; ?>				
				<?php endif; ?>
			</div><!--slideshow -->
			<div id="theListNav"><ul id="nav"></ul></div>				
		  </div>
		</div><!--slideCont -->
	</div>
	<div class="adTableCell" id="videoSmall">
	  <h2>最新视频<!--<span class="redText">Latest</span> Video--></h2>
	  <p><a href="http://v.youku.com/v_show/id_XNDY1NzcyMjA4.html"><img src="<?=SERVER_URL?>images/placeholder_video.png" width="229" height="169"></a></p>
	</div>
  </div>
</div><!--adTable-->