 <?php $uid = intval($_SESSION['id']); ?>
 <div class="adTable">
      <div class="adTableRow">
        <div class="adTableCell">
          <h1><?=$this->rst['article_title']?></h1>
          <div class="metaRow">
            <span class="author">作者 <span class="authorName">馬密道</span></span> 
			<span class="createDate"><?=date('Y/m/d', strtotime($this->rst['date_published']))?></span>
			<span class="category"><?=$this->ModelTypeArticleCategory($this->rst['article_title'],intval($this->rst['article_id']))?></span>
			<span class="comments"><?=getTotalArticleComments(intval($this->rst['article_id']))?>  评论</span>
          </div>
          <div class="contentListing">
			<div class="metaFavRow">				
				<?php $lTitle = ($this->GetUserLike($uid,$this->rst['article_id'])==1) ? 'title="Thank you for your vote."' : ""; ?>
				<span class="heartLike" id="lik-<?=$this->rst['article_id']?>" style="cursor:pointer;" <?=$lTitle?>>
					<?php $val = !empty($this->rst['cat_id']) ? $this->rst['article_id']."-".$this->rst['cat_id'] : $this->rst['article_id']; ?>
					<a href="javascript:;" style="cursor:none;" class="like_article" id="like-<?=$val?>">0</a>
				</span>
				<?php $dTitle = ($this->GetUserDisLike($uid,$this->rst['article_id'])==1) ? 'title="Thank you for your vote."' : ""; ?>
				<span class="dislikeThumb" id="dis-<?=$this->rst['article_id']?>" style="cursor:pointer;" <?=$dTitle?>>
					<a href="javascript:;" style="cursor:none" class="dislike_article" id="dislike-<?=$val?>">0</a>
				</span>
			</div>			
            <p id="article_content"><?=$this->rst['article_content']?></p>
            <div class="socialRowList">
				<?php if(isset($_SESSION['id'])): ?>
						<!-- JiaThis Button BEGIN -->
						<div class="jiathis_style_32x32">
							<a class="jiathis_button_qzone"></a>
							<a class="jiathis_button_tsina"></a>
							<a class="jiathis_button_tqq"></a>
							<a class="jiathis_button_renren"></a>
							<a class="jiathis_button_kaixin001"></a>
							<!--<a href="http://www.jiathis.com/share?uid=1697362" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
							<a class="jiathis_counter_style"></a>-->
						</div>
						<!--<script type="text/javascript">var jiathis_config = {data_track_clickback:true};</script>-->						
						<!-- JiaThis Button END -->
				<?php endif; ?>
            </div>
            <div class="tagRowList">				 			
            <p>标签 : <?=$this->ModelGetTagsByArticleId(intval($this->rst['article_id']))?></p>
			</div>
			<h2><span class="redText">留言和评论</span></h2> <!--发表评论 -->
			<div id="flash" align="left"  ></div>
			
			<div  id="update" class="timeline">
			</div>
			<?php $this->ModelGetArticleCommentById($this->rst['article_id']); ?>
			<?php if($this->return_rows() > 0): ?>
				<?php foreach($this->result_to_object() as $obj): ?>
						<div id="<?=$obj->id?>" style="position:relative; overflow:hidden; padding:10px; border:1px solid #ccc; width: 550px; height:auto; margin-bottom:10px;">
							<div style="float:left; height:auto; width:70px; position:relative; overflow:hidden; font-normal:bold; text-alig:justify;"><?=getProfileImageById($obj->user_id)?><br/><?=$this->GetUserDataByArticleId($obj->user_id,'username')?>:</div>
							<div style="float:left; height:auto; width:400px; position:relative; overflow:hidden; text-align:justify;"><?=$obj->comments?><br/><span style="font-size:8px; color:#ccc;"><?=$obj->dateadded?></span></div>
						</div>
				<?php endforeach; ?>
			<?php endif; ?>
			
			<h2><span class="redText">发表评论</span></h2> <!--发表评论 -->
			<!--<form class="commentForm">-->
			<form  method="post" name="form" action="">
				<?php if(!isset($_SESSION['id'])): ?>
							<p>To comment, you must first <a href="<?=SERVER_URL?>?login">login</a></p>
				<?php else: ?>				
							<p>以 <a href="<?=SERVER_URL?>?logout">Kosmeyin</a> 的身份登录. <a href="<?=SERVER_URL?>?<?=$_SESSION['uname']?>"><?=$_SESSION['uname']?>?</a></p>				
							<p><span id="result_box10" lang="zh-CN">评论<!--comment --></span></p>
							<!--<p>
							  <label for="rememberme">
							  记住我的信息</label>
							</p> -->
							<textarea cols="30" rows="10" style="width:480px;font-size:14px; font-weight:bold" name="content" id="content" maxlength="145" ></textarea>
							<p><span id="result_box7" lang="zh-CN">您可以使用这些HTML标签和属性：</span>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym   title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt;   &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q   cite=""&gt; &lt;strike&gt; &lt;strong&gt; </p>
							<!--<input type="submit" value="Submit" />-->
							<input type="submit"  value="Update"  id="v" name="submit" class="comment_button"/>
				<?php endif; ?>
			</form>
          </div>
        </div>
       <?=$this->Category()?>
      </div>
    </div><!--adTable-->
	<input type="hidden" id="aurl" value="<?=SERVER2_URL?>" />
<?=$this->currentActivity()?>	
<link rel="stylesheet" type="text/css" href="css/tooltip/tipTip.css"><!--10-11-2012 -->
<script type="text/javascript">
	// if like
	$("span.heartLike").click(function() {
		var id = $(this).children('a').attr('id');	
		var str = id.split("-");		
		var dummy = str[0];	// dummy like
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
				$("a#"+id).html(msg);
			}
		});
		return false;
	});
		
	// if dislike
	//$(".dislike_article").click(function() {		
	$("span.dislikeThumb").click(function() {			
		var id = $(this).children('a').attr('id');			
		var str = id.split("-");		
		var aid = str[1];
		var cid = 0;				
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
				$("a#"+id).html(msg);
			}
		});
		return false;
	});
	
	// return total likes
	var id = $('.like_article').attr('id');
	var str = id.split("-");
	var aid = str[1];	// article id
	var cid = str[2];	// category id
	$.ajax({
		type: "POST",
		url: "lib/likes.php",
		data: "aid="+aid+"&cid="+cid,
		cache: false,
		success: function(msg){						
			$(".like_article").html(msg);			
		}
	});	
	
	// return total dislikes
	var id = $('.dislike_article').attr('id');
	var str = id.split("-");
	var aid = str[1];	// article id
	var cid = str[2];	// category id
	$.ajax({
		type: "POST",
		url: "lib/dislike.php",
		data: "aid="+aid+"&cid="+cid,
		cache: false,
		success: function(msg){						
			$(".dislike_article").html(msg);			
		}
	});	
	
	
	$(".comment_button").click(function() {	   
		var boxval = $("#content").val();		
		var dataString = 'content='+ boxval+'&aid='+aid;		
		if(boxval=='')
		{
			alert("Please Enter Some Text");		
		}
		else
		{
			$("#flash").show();
			$("#flash").fadeIn(400).html('<img src="images/ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');
			$.ajax({
				type: "POST",
				url: "lib/article_comment.php",
				data: dataString,
				cache: false,
				success: function(html){		 
					$("div#update").prepend(html);
					$("div#update div:first").slideDown("slow");
					document.getElementById('content').value='';
					$("#flash").hide();			
				}
			});
		}
		return false;
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
<script type="text/javascript">												
	var article_image = $("p img").eq(0).attr("src");	// get the first image	
	var article_title = $(".adTableCell h1").text();
	var current_url = window.location;		
	var image_location = $("#aurl").val()+encodeURI(article_image);
	//alert(image_location);
	
	//var myStr = "image/Article Images/20120912_ProductHighlight_Concealers_Pic1.jpg";
	
	//alert(encodeURI(image_location));
	
	var jiathis_config = { 
		url: current_url,
		pic: image_location,
		title: article_title
	}

	/*function getAbsolutePath() {
		var loc = window.location;
		var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
		return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
	}*/

</script>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1350522446787528" charset="utf-8"></script>