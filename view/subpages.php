 <?php
$url = trim(strtolower($_SERVER['REQUEST_URI']));			
$url = substr($url,(strpos($url,"?")+1),strlen($url));		
$subURL = strtoupper(substr($url,(strpos($url,"/")+1),strlen($url)));
$id = $this->GetCategoryBySubURL($subURL);
?> 
  <div class="adTable">
      <div class="adTableRow">
        <div class="adTableCell">  						
		  <h1 class="category"><?=$this->GetCategoryTitle($id)?></h1>		  
		  <?php $this->result = null; ?>
		  <?php $this->ModelGetAllArticleByCategory($id) ?>
		  <?php if($this->return_rows() > 0): ?>
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
									<span class="heartLike" id="<?=$obj->article_id?>">
										<?php $val = !empty($id) ? $obj->article_id."-".$id : $obj->article_id; ?>
										<a href="javascript:;" style="cursor:pointer;" class="likes_article" id="like-<?=$val?>">0</a>
									</span>									
									<span class="dislikeThumb" id="<?=$obj->article_id?>">
										<a href="javascript:;" style="cursor:pointer" class="dislike_article" id="dislike-<?=$val?>">0</a>										
									</span>
								</div>								
								<?php if(!empty($obj->optional_image)): ?>
										<img src="<?=SERVER_URL?>/admin-panel/articleuploads/<?=$obj->optional_image?>" alt="<?=$obj->article_title?>" width="auto" height="auto" align="left" class="alignleft">
								<?php endif; ?>
								<?=$obj->article_content?>
								<div class="tagRowList">
								  <p>tags : <?=$this->ModelGetTagsByArticleId($obj->article_id)?></p>
							  </div>
								<p><a href="<?=SERVER_URL?><?=$this->ModelTitleArticleCategory(intval($obj->article_id))?>" class="readmore">查看全文</a></p><!--发表评论 --></div>
					
					<?php endforeach; ?>	
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
    
   <script type="text/javascript">
 	
	// return all like
	$("a[class=likes_article]").each(function() {
		// get id
		var id = $(this).attr('id');				
		// if each click like
		$('#'+id).click(function() {
			var str = id.split("-");					
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
					$("#"+id).html(msg);
				}
			});
			return false;
		});
		
	});	
	
	// return all each dislike
	$("a[class=dislike_article]").each(function() {							
		var id = $(this).attr('id');	
		// if click dislike
		$('#'+id).click(function() {
			var str = id.split("-");		
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
					$("#"+id).html(msg);
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