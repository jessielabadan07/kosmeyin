<?php $uid = intval($_SESSION['id']); ?>
<div class="adTable">
      <div class="adTableRow">
        <div class="adTableCell">  				
		<?php $this->result_to_array(); ?>				
		  <h1 class="category"><?php echo $this->rst['cat_title']; ?></h1>	
		  <?php $this->ModelGetAllArticleByCategory($this->rst['cat_id']) ?>
		  <?php $totRows = $this->return_rows(); ?>
		  <?php if($totRows > 10): ?>		  				
			<?php 
				$numPage = ceil($totRows / 10);				
				$pageArr = explode("-",$this->pagCategory);						
				$endPage = intval($pageArr[1] * 10);						
				$startPage = ($endPage == 10) ? ($endPage/$endPage)-1 : ($endPage-10);							
				$startPage = empty($startPage) ? 0 : $startPage;
				$endPage = empty($endPage) ? 10 : $endPage;
			?>
		  <?php $this->ModelGetAllArticleByCategoryWithPagination($this->rst['cat_id'],$startPage,$endPage); ?>		  								
					<?php foreach($this->result_to_object() as $obj): ?>	 
							  <h1><?=$obj->article_title?></h1>
							  <div class="metaRow">
								<span class="author">author <span class="authorName">Admin</span></span> 
								<span class="createDate"><?=date('Y/m/d', strtotime($obj->date_published))?></span>
								<span class="category"><?=$this->ModelTypeArticleCategory($this->rst['cat_title'],intval($obj->article_id))?></span>
								<span class="comments"><?=getTotalArticleComments(intval($obj->article_id))?> comments</span>
							  </div>
							  <div class="contentListing">
							  <div class="metaFavRow">						
									<?php $lTitle = ($this->GetUserLike($uid,$obj->article_id)==1) ? 'title="Thank you for your vote."' : ""; ?>
									<span class="heartLike" id="lik-<?=$obj->article_id?>" style="cursor:pointer;"  <?=$lTitle?> >
										<?php $val = !empty($this->rst['cat_id']) ? $obj->article_id."-".$this->rst['cat_id'] : $obj->article_id; ?>
										<a href="javascript:;" style="cursor:default;" class="likes_article" id="like-<?=$val?>">0</a>
									</span>	
									<?php $dTitle = ($this->GetUserDisLike($uid,$obj->article_id)==1) ? 'title="Thank you for your vote."' : ""; ?>
									<span class="dislikeThumb" id="dis-<?=$obj->article_id?>" style="cursor:pointer;" <?=$dTitle?> >
										<a href="javascript:;" style="cursor:default" class="dislike_article" id="dislike-<?=$val?>">0</a>										
									</span>
								</div>								
								<?php if(!empty($obj->optional_image)): ?>
										<img src="<?=SERVER_URL?>/admin-panel/articleuploads/<?=$obj->optional_image?>" alt="<?=$obj->article_title?>" width="auto" height="auto" align="left" class="alignleft">
								<?php endif; ?>
								<?=$obj->article_textdisplay?>
								<div class="tagRowList">
								  <p>tags : <?=$this->ModelGetTagsByArticleId($obj->article_id)?></p>
							  </div>
								<p><a href="<?=SERVER_URL?><?=$this->ModelTitleArticleCategory(intval($obj->article_id))?>" class="readmore">查看全文</a></p><!--发表评论 --></div>					
					<?php endforeach; ?>
					<?php $boldNum = $endPage/10; ?>
					<?php $btnFirst = 1; ?>		
					<?php $btnPrev = $numPage - 1; ?>									
							  <div class="menu_rev_nav" style="display:block">
								  <ul>
									<li><a href="<?=SERVER_URL?>?article&category/<?=$this->category?>/page-<?=$btnFirst?>" class="navBtnFst">First</a></li>
									<li><a href="<?=SERVER_URL?>?article&category/<?=$this->category?>/page-<?=$btnPrev?>" class="navBtnPrev">Prev</a></li>
									<?php for($page=1; $page<=$numPage; $page++): ?>
											<?php if($page == $boldNum): ?>
													<li><a href="<?=SERVER_URL?>?article&category/<?=$this->category?>/page-<?=$page?>" style="font-weight:bold; font-size:16px; color:#FC3F4D;"><?=$page?></a></li>
											<?php else: ?>
													<li><a href="<?=SERVER_URL?>?article&category/<?=$this->category?>/page-<?=$page?>"><?=$page?></a></li>
											<?php endif; ?>
									<?php endfor; ?>									
									<?php $btnNext = ($numPage > $pageArr[1]) ? ($pageArr[1]+1) : $numPage;?>	
									<?php $btnLast = $numPage; ?>
									<li><a href="<?=SERVER_URL?>?article&category/<?=$this->category?>/page-<?=$btnNext?>" class="navBtnNxt">Next</a></li>
									<li><a href="<?=SERVER_URL?>?article&category/<?=$this->category?>/page-<?=$btnLast?>" class="navBtnLst">Last</a></li>
								  </ul>
								</div>
				
		  <?php else: ?>
					  <?php if($totRows > 0): ?>
							  <?php foreach($this->result_to_object() as $obj): ?>	 
										  <h1><?=$obj->article_title?></h1>
										  <div class="metaRow">
											<span class="author">author <span class="authorName">Admin</span></span> 
											<span class="createDate"><?=date('Y/m/d', strtotime($obj->date_published))?></span>
											<span class="category"><?=$this->ModelTypeArticleCategory($this->rst['cat_title'],intval($obj->article_id))?></span>
											<span class="comments"><?=getTotalArticleComments(intval($obj->article_id))?> comments</span>
										  </div>
										  <div class="contentListing">
										  <div class="metaFavRow">			
												<?php $lTitle = ($this->GetUserLike($uid,$obj->article_id)==1) ? 'title="Thank you for your vote."' : ""; ?>
												<span class="heartLike" id="lik-<?=$obj->article_id?>" style="cursor:pointer;" <?=$lTitle?> >
													<?php $val = !empty($this->rst['cat_id']) ? $obj->article_id."-".$this->rst['cat_id'] : $obj->article_id; ?>
													<a href="javascript:;" style="cursor:default;" class="likes_article" id="like-<?=$val?>">0</a>
												</span>		
												<?php $dTitle = ($this->GetUserDisLike($uid,$obj->article_id)==1) ? 'title="Thank you for your vote."' : ""; ?>
												<span class="dislikeThumb" id="dis-<?=$obj->article_id?>" style="cursor:pointer;" <?=$dTitle?> >
													<a href="javascript:;" style="cursor:default" class="dislike_article" id="dislike-<?=$val?>">0</a>										
												</span>
											</div>								
											<?php if(!empty($obj->optional_image)): ?>
													<img src="<?=SERVER_URL?>/admin-panel/articleuploads/<?=$obj->optional_image?>" alt="<?=$obj->article_title?>" width="auto" height="auto" align="left" class="alignleft">
											<?php endif; ?>
											<?=$obj->article_textdisplay?>
											<div class="tagRowList">
											  <p>tags : <?=$this->ModelGetTagsByArticleId($obj->article_id)?></p>
										  </div>
											<p><a href="<?=SERVER_URL?><?=$this->ModelTitleArticleCategory(intval($obj->article_id))?>" class="readmore">查看全文</a></p><!--发表评论 --></div>
								
								<?php endforeach; ?>	
					<?php endif; ?>		
		<?php endif; ?>
        </div>
		<?=$this->Category()?>
      </div>
    </div><!--adTable-->	
    <link rel="stylesheet" type="text/css" href="css/tooltip/tipTip.css"><!--10-11-2012 -->
   <script type="text/javascript"> 	
	$("span.heartLike").each(function() {
		var id = $(this).attr('id');				
		$('#'+id).click(function() {			
			var aid = $(this).children('a').attr('id');			
			var str = aid.split("-");
			var aid = str[1];	// article id
			var cid = str[2];	// cat_id							
			if(str[2]!=undefined)
				cid = str[2];
			else
				cid = 0;			
			$.ajax({
				type: "POST",
				url: "lib/article_like.php",
				data: "aid="+aid+"&cid="+cid,
				cache: false,
				success: function(msg){						
					$("a#"+aid).html(msg);
				}
			});
			return false;
		});		
	});	
	
	// return all each dislike
	$(".dislikeThumb").each(function() {
		var id = $(this).attr('id');
		$('#'+id).click(function() {
			var aid = $(this).children('a').attr('id');
			var str = aid.split("-");		
			var aid = str[1];	// article id
			var cid = str[2];	// cat_id					
			if(str[2]!=undefined)
				cid = str[2];
			else
				cid = 0;						
			$.ajax({
				type: "POST",
				url: "lib/article_dislike.php",
				data: "aid="+aid+"&cid="+cid,
				cache: false,
				success: function(msg){						
					$("a#"+aid).html(msg);
				}
			});
			return false;
		});
	});
	
	// get all like, load
	$("a[class=likes_article]").each(function() {
		// get id
		var id = $(this).attr('id');	
		var str = id.split("-");
		var aid = str[1];	// article id
		var cid = str[2];	// category id		
		// retrieve all likes
		$.ajax({
			type: "POST",
			url: "lib/likes.php",
			data: "aid="+aid+"&cid="+cid,
			cache: false,
			success: function(msg){						
				$("#"+id).html(msg);			
			}
		});	
	});	
	
	// get all dislike, load
	// get all like, load
	$("a[class=dislike_article]").each(function() {
		// get id
		var id = $(this).attr('id');	
		var str = id.split("-");
		var aid = str[1];	// article id
		var cid = str[2];	// category id		
		// retrieve all dislikes
		$.ajax({
			type: "POST",
			url: "lib/dislike.php",
			data: "aid="+aid+"&cid="+cid,
			cache: false,
			success: function(msg){						
				$("#"+id).html(msg);			
			}
		});	
	});
	
 </script>
 <script type="text/javascript" src="scripts/tooltip/jquery.tipTip.minified.js"></script>
 <script type="text/javascript">
	$(function(){
		$("span.heartLike").tipTip();
		$("span.dislikeThumb").tipTip();
	});
	$(function(){
		$("span.heartLike").tipTip({maxWidth: "auto", edgeOffset: 10});
		$("span.dislikeThumb").tipTip({maxWidth: "auto", edgeOffset: 10});
	});

</script>
