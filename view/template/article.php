<?php 	
	$this->query("SELECT * FROM article_featured af LEFT JOIN article a ON af.article_id = a.article_id WHERE a.article_status=1 ORDER BY af.sort_order", $this->ERROR_QUERY);
	if($this->return_rows() == 0) {
		$this->query("SELECT * FROM article WHERE article_status = 1 ORDER BY article_id DESC", $this->ERROR_QUERY); 
	}
?>
<div class="latestArticles">
  <h2><span class="redText">最新</span>文章</h2>
  <div id="mycarousel" class="carouselArticles">
	<div class="carouselTable">
	  <div class="carouselRow">
		 <div class="carouselScrollCol">
			<ul>
			<?php foreach($this->result_to_object() as $obj): ?>
					<li>
					<div class="latestArticleCont"> 
						<?php $link = $this->ModelGetArticleCategoryById($obj->article_id); ?>
						<?php if(strlen($obj->optional_image) > 0): ?>
							<p align="center"><a href="<?=SERVER_URL?><?=$link?>"><img src="<?=SERVER_URL?>admin-panel/articleuploads/<?=@$obj->optional_image?>" width="201" height="126"></a></p>
						<?php else: ?>
							<p align="center"><img src="<?=SERVER_URL?>images/noImage.png" width="201" height="126"></p>
						<?php endif; ?>
						<div class="latestArticleExTitle"><h4><a href="<?=SERVER_URL?><?=$link?>"><?=$obj->article_title?></a></h4></div>
						<div class="latestArtEx"><p><?=$obj->article_textdisplay?></p></div>						
						<p class="readmore" id="<?=$obj->article_id?>"><a href="<?=SERVER_URL?><?=$link?>" class="readmore">Read More</a></p>
					</div>			
				</li>		
			<?php endforeach; ?>		
			</ul>	
		</div>	       
          <div class="carouselArtMenuCol">
          	<div class="latestArticleCont">
              <h4>最新时尚潮流和美肤趋势</h4>
              <?php $this->result = null; ?>
			  <?php $this->query("SELECT * FROM article WHERE article_status=1 ORDER BY article_id DESC", $this->ERROR_QUERY); ?>
                <ul class="latestTrends jcarousel-control">
					<?php foreach($this->result_to_object() as $obj): ?>
							<?php $link = $this->ModelGetArticleCategoryById($obj->article_id); ?>
							<li><a href="<?=SERVER_URL?><?=$link?>"><?=$obj->article_title?></a></li>
					<?php endforeach; ?>                 
                </ul> 
              </div>
          </div><!--carouselArtMenuCol -->
		</div>
      </div>
    </div>
</div><!--latestArticles-->