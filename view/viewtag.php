<?php $uid = intval($_SESSION['id']); ?>
<div class="adTable">
  <div class="adTableRow">
	<div class="adTableCell">
	<!--<h1 class="category">Contributions</h1>-->
	 <h1>Tag Archives: <?=$this->page_title?></h1>	
	 <?php $this->result_to_array(); ?>	 
	 <?php $this->ModelTagArticleByTagID(intval($this->rst['tag_id'])) ?>
	 <?php if($this->return_rows() > 0): ?>
			  <?php foreach($this->result_to_object() as $obj): ?>	  
					  <h1><a href="<?=SERVER_URL?><?=$this->ModelTitleArticleCategory(intval($obj->article_id))?>" style="color:#333;"><?=$obj->article_title?></a></h1>
					  <div class="metaRow">
						<span class="author">author <span class="authorName">Admin</span></span> <span class="createDate"><?=date('Y/m/d', strtotime($obj->date_published))?></span><span class="category"><?=$this->ModelTypeArticleCategory($obj->article_title,intval($obj->article_id))?></span><span class="comments">0 comments</span>
					  </div>
					  <div class="contentListing">
					  <div class="metaFavRow">
							<?php $lTitle = ($this->GetUserLike($uid,$obj->article_id)==1) ? 'title="Thank you for your vote."' : ""; ?>
							<span class="heartLike" id="lik-<?=$obj->article_id?>" style="cursor:pointer;" <?=$lTitle?>>
								<a href="javascript:;" style="cursor:pointer;" class="likes_article" id="like-<?=$obj->article_id?>">0</a>
							</span>
							<?php $dTitle = ($this->GetUserDisLike($uid,$obj->article_id)==1) ? 'title="Thank you for your vote."' : ""; ?>
							<span class="dislikeThumb" id="dis-<?=$obj->article_id?>" style="cursor:pointer;" <?=$dTitle?>>
								<a href="javascript:;" style="cursor:pointer;" class="dislike_article" id="dislike-<?=$obj->article_id?>">0</a>
							</span>
						</div>
						<img src="<?=SERVER_URL?>/admin-panel/articleuploads/<?=$obj->optional_image?>" alt="<?=$obj->article_title?>" width="auto" height="auto" align="left" class="alignleft">						
						<?=$obj->article_textdisplay?>
						<div class="tagRowList">
						  <p>tags : <?=$this->ModelGetTagsByArticleId($obj->article_id)?></p>
						</div>
						<p><a href="<?=SERVER_URL?><?=$this->ModelTitleArticleCategory(intval($obj->article_id))?>" class="readmore">查看全文</a></p><!--发表评论 --></div>		
			  <?php endforeach;?>	
	<?php endif; ?>
	  <!--<div class="menu_rev_nav" style="display:block">
		  <ul>
			<li><a href="#" class="navBtnFst">First</a></li>
			<li><a href="#" class="navBtnPrev">Prev</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#" class="navBtnNxt">Next</a></li>
			<li><a href="#" class="navBtnLst">Last</a></li>
		  </ul>
		</div>-->
	</div>
	<?=$this->Category()?>
  </div>
</div><!--adTable-->
<link rel="stylesheet" type="text/css" href="css/tooltip/tipTip.css"><!--10-11-2012 -->   
   <script type="text/javascript"> 			
	$("span.heartLike").each(function() {		
		var pid = $(this).attr('id');				
		// if each click like
		$('#'+pid).click(function() {					
			var str = $(this).children('a').attr('id');			
			var id = str.split("-");
			$.ajax({
				type: "POST",
				url: "lib/article_like.php",
				data: "aid="+id[1],
				cache: false,
				success: function(msg){											
					$("a#"+id).html(msg);
					$("a#"+str).html(msg);
				}
			});
			return false;
		});
		
	});	
	
	// return all each dislike						
	$("span.dislikeThumb").each(function() {
		var pid = $(this).attr('id');			
		// if click dislike
		$('#'+pid).click(function() {		
			var str = $(this).children('a').attr('id');	
			var id = str.split("-");
			$.ajax({
				type: "POST",
				url: "lib/article_dislike.php",
				data: "aid="+id[1],
				cache: false,
				success: function(msg){																
					$("a#"+str).html(msg);
				}
			});
			return false;
		});
	});
	
	// get all likes
	$("span.heartLike").each(function() {
		var str = $(this).children('a').attr('id');	
		var id = str.split("-");
		$.ajax({
			type: "POST",
			url: "lib/likes.php",
			data: "aid="+id[1],
			cache: false,
			success: function(msg){								
				$("a#"+str).html(msg);	
			}
		});	
	});	
	// get all dislikes
	$("span.dislikeThumb").each(function() {				
		var str = $(this).children('a').attr('id');	
		var id = str.split("-");
		$.ajax({
			type: "POST",
			url: "lib/dislike.php",
			data: "aid="+id[1],
			cache: false,
			success: function(msg){						
				$("a#"+str).html(msg);			
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