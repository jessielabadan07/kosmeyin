<?php include('template/content_top.php'); ?>
<?php if(isset($_GET['all'])): ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article">Article</a> : ALL</div>
			<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; margin-bottom:20px;">
				<form method="POST" action="" >
				<div style="position:relative; overflow:hidden; width:650px; border:1px solid #fff; background-color: #fff; height:auto; padding: 10px; margin:0 auto; margin-top:5px; float:left;">				
					<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left;">
						<a href="<?=SERVER_URL?>?article&add" style="color:#666; font-size:11px;">+ Add</a>
					</div>		
					<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">						
						<a href="javascript:;" id="del_article" style="color:#666; font-size:11px;">Delete</a>
					</div>			
					<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">
						<a href="<?=SERVER_URL?>?article&searchcategory" style="color:#666; font-size:11px;">Search</a>
					</div>	
					<?php if(isset($_COOKIE['articleupdate_id'])): ?>						
						<span style="font-weight:bold; float:right; background:lemonchiffon; border:1px solid orange; padding:10px; width:400px;">You have successfully update Article ID: #<?=intval($_COOKIE['articleupdate_id'])?></span>
					<?php elseif(isset($_COOKIE['articledelete_id'])): ?>						
						<span style="font-weight:bold; float:right; background:lemonchiffon; border:1px solid orange; padding:10px; width:400px;">You have successfully deleted Article ID: #<?=intval($_COOKIE['articledelete_id'])?></span>
					<?php endif; ?>						
				</div>
			<table class="article_table" style="width:940px; font-size:12px; color:#666; float:left;">
				<tr style="text-align:justify; padding:5px; color:#3399ff; background-color:#ddd;">				
					<th style="text-align:justify; padding:15px; width:450px; color:#3399ff;">
						<input type="checkbox" id="checkall" name="deleteallart" />&nbsp;Title</th>		
					<th style="text-align:justify; padding:15px; width:125px; color:#3399ff;">Category</th>		
					<th style="text-align:justify; padding:15px; width:125px; color:#3399ff;">Label</th>
					<th style="text-align:justify; padding:15px; width:60px; color:#3399ff;">Date</th>
				</tr>
				<?php
					# my paginatio here begins			
					$count = ceil($this->ReturnAllArticles() / 10);	
					echo "There are total number of <b>" .$this->ReturnAllArticles(). "</b> articles";
					if(isset($_GET['all'])) {				
						$num = intval($_GET['all']);
						$offset = intval($num);			
						$start = $offset-10;
						$start = ($start>=0) ? $start : 0;
						$offset = ($offset>=10) ? $offset : 10;						
						$this->ReadAllArticles($start,$offset);
					} else {
						$this->ReadAllArticles(0,10);		
					}
				?>
					
			</table>
			<div style="position:relative; overflow:hidden; width:500px; margin-left:50px;">
				<a href="<?=SERVER_URL?>?article&all=<?php echo isset($_GET['all']) ? intval($_GET['all'] > 10) ? intval($_GET['all']-10) : 10 : 10;?>"><img src="<?SERVER_URL?>images/arrow_left.png" width="16" height="16" /></a>
				<?php $boldNum = 0; if(isset($_GET['all'])) $boldNum = intval($_GET['all']/10); ?>
				<?php for($i=1; $i<=$count; $i++): ?>				
						<a <?php echo ($i==$boldNum) ? 'style="font-weight:bold; color:#000; font-size:16px;"' : ''; ?> href="<?=SERVER_URL?>?article&all=<?=($i*10)?>"><?=$i?></a>
				<?php endfor; ?>
				<a href="<?=SERVER_URL?>?article&all=<?php echo isset($_GET['all']) ? intval($_GET['all']) < intval($count*10) ? intval($_GET['all']+10) : intval($_GET['all']) : 10;?>"><img src="<?SERVER_URL?>images/arrow_right.png" width="16" height="16" /></a>
			</div>
			<div style="position:relative; overflow:hidden; padding:3px; float:right; border:1px solid orange; background-color:lemonchiffon; margin-right:50px; margin-bottom:5px;">
				Click the title of the article to view and or edit content.
			</div>
		</div>
<?php elseif(isset($_GET['featured'])): ?>
		<?php $featured_article = array(); ?>
		<?php $this->GetArticleFeatured(); ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article">Article</a> : Featured</div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; margin-bottom:20px;">
			<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px; margin-bottom:10px;">						
				<a href="javascript:;" id="delallfeatured" style="color:#666; font-size:11px;">Delete</a>
			</div>
			<form method="POST" action="">
			<fieldset style="width:900px; border:1px solid #ccc;"><legend><span style="color:#666;">Featured Article List</span></legend>				
				<table class="table_selectedarticle" style="font-size:12px; color:#666; float:left;">
					<tr>
						<div id="sortable">
							<?php foreach($this->result_to_object() as $obj): ?>
									<div class="each_data" id="<?=$obj->article_id?>" style="background-color:lemonchiffon; border:1px solid #ddd; padding:5px; margin-bottom:10px;">
										<input type="hidden" id="hide_article" name="hide_article[]" value="<?=$obj->article_id?>" />
										<input type="checkbox" id="delfeatured" name="delfeatured" value="<?=$obj->article_id?>" />&nbsp;-&nbsp;<?=$obj->article_title?>
									</div>
									<?php array_push($featured_article,$obj->article_id);?>
							<?php endforeach; ?>
						</div>
					</tr>
				</table>					
			</fieldset>
			<?php if($this->return_rows() > 0): ?>
				<div style="border:1px solid orange; background:lemonchiffon; padding:3px; width:900px; margin-top:5px;">Sort the article in any order and hit save button below</div><div><input type="submit" id="save_order" name="save_order" value="Save Order" /></div>
			<?php endif; ?>
			</form>
			<a href="#article-list-box" style="font-size:11px; padding:5px;" class="login-window">+Add New</a>
		</div>		
		<script type="text/javascript">				
			$(document).ready(function() {
				$('#sortable').sortable({
					update: function(event, ui) {
						var fruitOrder = $(this).sortable('toArray').toString();		
						$("#checkbox_values").val(fruitOrder);
					}
				});	
			});					
		</script>
		<div id="article-list-box" class="login-popup" style="width:auto; height:550px;">
			<a href="#" class="close"><img src="<?=SERVER_URL?>/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
			  <div><input type="checkbox" id="checkallarticle" name="checkallarticle" >&nbsp;<span style="color:#fff;">Select All</span></div>
			  <hr/>
			  <?php $this->GetListArticles(); ?>
			  <form method="post" class="signin" action="#" style="background:#fff; width:900px; overflow:scroll; height:500px; padding:10px;">
					<table id="article_table" style="background:#fff; width:auto; height:auto">
					<?php foreach($this->result_to_object() as $obj): ?>
							<?php if(!in_array($obj->article_id, $featured_article)): ?>
									<tr class="trart" id="poptr<?=$obj->article_id?>" style="padding:5px;">
										<td style="padding:5px;"><input type="checkbox" id="<?=$obj->article_id?>" name="list_article" value="<?=$obj->article_title?>">
										&nbsp;<?=$obj->article_title?></td>
									</tr>
							<?php endif; ?>
					<?php endforeach; ?>
					<tr>
						<td><button class="submit button" id="ad" type="button" style="width:50px;">Add</button></td>
					</tr>
					</table>					
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
				
				// if remove article in featured
				
				var checkFeatured = $("[type='checkbox']:checked").length;
				$("#delallfeatured").click(function() {
					$("input[type='checkbox']:checked").each(function(o,event) {
						var id = event.value;
						$("div#"+id).slideUp(100, this.remove);		
						$.ajax({
							type: "POST",
							url: "lib/remove_articlefeatured.php",
							data: "id="+id,
							cache: false,
							success: function(results){					
							}
						});
					});
				});
				
				
				// When clicking on the button close or the mask layer the popup closed
				$('a.close, #mask').live('click', function() { 
					  $('#mask , .login-popup').fadeOut(300 , function() {
						$('#mask').remove();  
					}); 
					return false;
				});			
				
				$('#ad').click(function() {
					var count = 0;
					var len = $(".each_data").length;
					var foundId = false;
					$("[type='checkbox']").each(function(evt,o) {						
						if(this.checked) {	
							$("#poptr"+o.id).slideUp(100, this.remove);
							$.ajax({
								type: "POST",
								url: "lib/save_articlefeatured.php",
								data: "id="+o.id+"&len="+len,								
								cache: false,
								success: function(results){					
								}
							});
							$("#sortable .each_data").each(function(i,j) {								
								if(this.id == o.id)
									foundId = true;								
							});
							if(!foundId)
								$("#sortable").append('<div style="position:relative; overflow:hidden; padding:3px; background-color:lemonchiffon; border:1px solid #ddd; padding:5px; margin-bottom:10px; cursor:pointer; color:#666;" class="each_data" id="'+o.id+'"><input type="checkbox" id="delfeatured" name="delfeatured" value="'+o.id+'" />&nbsp;-&nbsp;'+ o.value +'</div>');				
						}
					});			
					$('#mask , .login-popup').fadeOut(300 , function() {
						$('#mask').remove();  
					}); 
					return false;
				});
					
			});
		</script>
		<?php
			if(isset($_POST['save_order'])) {
				foreach($_POST['hide_article'] as $key => $value) {					
					$this->DeleteArticleFeaturedById($value);
					$this->InsertArticleFeaturedById($value,$key+1);
				}
				$this->redirect_to(SERVER_URL."?article&featured");
			}
		?>
<?php elseif(isset($_GET['category'])): ?>				
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article">Article</a> : Category List</div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; margin-bottom:20px;">
			<form method="POST" action="" >
			<div style="position:relative; overflow:hidden; width:650px; border:1px solid #fff; background-color: #fff; height:auto; padding: 10px; margin:0 auto; margin-top:5px; float:left;">				
				<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left;">
					<a href="<?=SERVER_URL?>?article&add_category" style="color:#666; font-size:11px;">+ Add</a>
				</div>		
				<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">
					<a href="javascript:;" id="del_category" style="color:#666; font-size:11px;">Delete</a>
				</div>			
				<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">
					<a href="<?=SERVER_URL?>?article&searchcategory" style="color:#666; font-size:11px;">Search</a>
				</div>			
			</div>
			<?php $this->GetAllCategory(); ?>
			<table style="font-size:12px; color:#666; float:left;">
				<tr style="text-align:justify; padding:5px; color:#3399ff; background-color:#ddd;">	
					<th style="text-align:justify; padding:15px; width:5px;">
						<input type="checkbox" id="deleteallcat" name="deleteallcat" />
					</th>
					<th style="text-align:justify; padding:15px; width:250px;">Name</th>
					<th style="text-align:justify; padding:15px; width:60px;">Alias</th>
					<th style="text-align:justify; padding:15px; width:300px;">Description</th>					
					<th style="text-align:justify; padding:15px; width:5px;">Article</th>
					<th style="text-align:justify; padding:15px;">Date Created</th>
				</tr>
				<?php foreach($this->result_to_object() as $obj): ?>
					<tr style="text-align:justify; padding:5px; background-color:#efefef; color:#888; ">
						<td style="text-align:justify; padding:15px; width:5px;">
							<input type="checkbox" id="<?=$obj->cat_id?>" name="deletecategories" />
						</td>
						<td style="text-align:justify; padding:15px; width:250px;"><a href="<?=SERVER_URL?>?article&viewcategory=<?=$obj->cat_id?>" style="font-weight:bold;"><?=$obj->cat_title?></td>
						<td style="text-align:justify; padding:15px; width:60px;"><?=$obj->cat_alias?></td>
						<td style="text-align:justify; padding:15px; width:300px;"><?=$obj->cat_description?></td>
						<td style="text-align:justify; padding:15px; width:5px;"><?=$this->GetTotalCategoryArticle(intval($obj->cat_id))?></td>
						<td style="text-align:justify; padding:15px;"><?=date('Y-m-d', strtotime($obj->cat_dateupdate))?></td>
					</tr>
				<?php endforeach;?>
			</table>					
		</div>
<?php elseif(isset($_GET['tag'])): ?>	
			<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article">Article</a> : Tag List</div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; margin-bottom:20px;">
			<form method="POST" action="" >
			<div style="position:relative; overflow:hidden; width:650px; border:1px solid #fff; background-color: #fff; height:auto; padding: 10px; margin:0 auto; margin-top:5px; float:left;">				
				<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left;">
					<a href="<?=SERVER_URL?>?article&add_tag" style="color:#666; font-size:11px;">+ Add</a>
				</div>		
				<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">
					<a href="javascript:;" id="delalltag" style="color:#666; font-size:11px;">Delete</a>
				</div>			
				<!--<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:left; margin-left:2px;">
					<a href="javascript:;" style="color:#666; font-size:11px;">Search</a>
				</div>-->			
			</div>
			<div style="float:left; border:1px solid orange; padding:10px; background:lemonchiffon;">Click the Tag name to edit or see the content</div>
			<?php $this->GetAllTagList(); ?>
			<table style="font-size:12px; color:#666; float:left;">
				<tr style="text-align:justify; padding:5px; color:#3399ff; background-color:#ddd;">	
					<th style="text-align:justify; padding:15px; width:5px;">
						<input type="checkbox" id="deletealltag" name="deletealltag" />
					</th>
					<th style="text-align:justify; padding:15px; width:100px;">Tag name</th>				
					<th style="text-align:justify; padding:15px; width:500px;">Article in this tag
					<br/><span style="color:green; font-weight:normal;">(Note: <b>'x'</b> is to remove the article in the tag)</span></th>
					<th style="text-align:justify; padding:15px;">Status</th>
					<th style="text-align:justify; padding:15px;">Date Created</th>
				</tr>
				<?php foreach($this->result_to_object() as $obj): ?>
					<tr style="text-align:justify; padding:5px; background-color:#efefef; color:#888; ">
						<td style="text-align:justify; padding:15px; width:5px;">
							<input type="checkbox" id="<?=$obj->tag_id?>" name="deletetags" />
						</td>
						<td style="text-align:justify; padding:15px; width:100px;"><a href="<?=SERVER_URL?>?article&viewtag=<?=$obj->tag_id?>" style="font-weight:bold;"><?=$obj->tags?></td>												
						<td style="text-align:justify; padding:15px; width:500px;"><?=$this->GetArticlesByTagId(intval($obj->tag_id))?></td>
						<td></td>
						<td style="text-align:justify; padding:15px;"><?=date('Y-m-d', strtotime($obj->dateadded))?></td>
					</tr>
				<?php endforeach;?>
			</table>					
		</div>
		
		<script type="text/javascript">		
		$(".removearticle").each(function() {
			var id = $(this).attr("id");						
			$("a#"+id).click(function() {	
				var divId = $(this).parents().attr("id");//.get(0).tagName;
				if(confirm("Are you sure you want to remove the article in this tag?"))
				{
					var str = id.split("-");
					aid = str[0];	// article id
					tid = str[1];	// tag id										
					$.ajax({
						type: "POST",
						url: "lib/delete_articletag.php",
						data: "aid="+aid+"&tid="+tid,
						cache: false,
						success: function(results){	
							$("div#"+divId).slideUp(100, this.remove);					
						}
					});
				}
			});
		});		
		</script>
		
<?php else: ?>
		<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">ARTICLE</div>
		<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; margin-bottom:20px;">
			
			<div class="box" style="width:auto; height:auto;">
				<img src="<?=SERVER_URL?>images/article_menu/all_article.png" width="32" height="32" alt="Menu" /><br/>
				<div id="info_box"><center><a href="<?=SERVER_URL?>?article&all">All</a></center></div>
			</div>
			
			<div class="box" style="width:auto; height:auto;">
				<img src="<?=SERVER_URL?>images/article_menu/featured.png" width="32" height="32" alt="Menu" /><br/>
				<div id="info_box"><center><a href="<?=SERVER_URL?>?article&featured">Featured</a></center></div>
			</div>
			
			<div class="box" style="width:auto; height:auto;">
				<img src="<?=SERVER_URL?>images/article_menu/write_article.png" width="32" height="32" alt="Menu" /><br/>
				<div id="info_box"><center><a href="<?=SERVER_URL?>?article&add">Write</a></center></div>
			</div>
			
			<div class="box" style="width:auto; height:auto;">
				<img src="<?=SERVER_URL?>images/article_menu/category.png" width="32" height="32" alt="Menu" /><br/>
				<div id="info_box"><center><a href="<?=SERVER_URL?>?article&category">Category</a></center></div>
			</div>
			
			<div class="box" style="width:auto; height:auto;">
				<img src="<?=SERVER_URL?>images/article_menu/tag.png" width="32" height="32" alt="Menu" /><br/>
				<div id="info_box"><center><a href="<?=SERVER_URL?>?article&tag">Tags</a></center></div>
			</div>
			
		</div>
<?php endif; ?>
<?php include('template/content_bottom.php'); ?>		
	
		