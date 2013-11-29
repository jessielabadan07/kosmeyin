<div class="adTableCell kosSideBar" style="width:258px; padding-left:72px; padding-right:0;">
	<h2>分类目录</h2>
	<?php $this->result = null; ?>
	<?php $this->query("SELECT * FROM category", $this->ERROR_QUERY); ?>
  <ul>			
	<?php foreach($this->result_to_object() as $obj): ?>
			<li><a href="<?=SERVER_URL?>?article&category/<?=$obj->cat_alias?>" title="<?=$obj->cat_alias?>"><?=$obj->cat_title?></a></li>
	<?php endforeach; ?>
  </ul>
  <?=$this->ModelGetAllArticles();?>
  <div>
	<h2>最近被喜欢的</h2>
	<ul>
	  <?php
		$articles = array();
		foreach($this->result_to_object() as $obj) { array_push($articles, array('tLikes' => countArticleLikes($obj->article_id), 'article_id' => $obj->article_id, 'title' => $obj->article_title)); }																														
		foreach ($articles as $key => $row) {
			$likes[$key]  = $row['tLikes'];
			$id[$key] = $row['article_id'];
			$title[$key] = $row['title'];
		}						
		array_multisort($likes, SORT_DESC, $id, SORT_DESC, $articles); ?>						
		<?php foreach($articles as $article): ?>
			<?php if($article['tLikes'] > 0): ?>
					<?php $link = $this->ModelGetArticleCategoryById($article['article_id']); ?>
					<li><a href="<?=SERVER_URL?><?=$link?>" title="<?=$article['title']?>" rel="nofollow"><?=$article['title']?></a> (<?=$article['tLikes']?>)</li>
			<?php endif; ?>
		<?php endforeach; ?>	
	</ul>
  </div>
  <div>
	<h2>最受欢迎的文章</h2>	
	<ul>
	  <?php		
		$this->result = null;
		$this->ModelGetAllArticles();
		$articles = array();
		foreach($this->result_to_object() as $obj) { array_push($articles, array('tComments' => getTotalArticleComments($obj->article_id), 'article_id' => $obj->article_id, 'title' => $obj->article_title)); }																														
		foreach ($articles as $key => $row) {
			$likes[$key]  = $row['tComments'];
			$id[$key] = $row['article_id'];
			$title[$key] = $row['title'];
		}						
		array_multisort($likes, SORT_DESC, $id, SORT_DESC, $articles); ?>				
		<?php foreach($articles as $article): ?>
				<?php if($article['tComments'] > 0):?>
					<?php $link = $this->ModelGetArticleCategoryById($article['article_id']); ?>
					<li><a href="<?=SERVER_URL?><?=$link?>" title="<?=$article['title']?>" rel="nofollow"><?=$article['title']?></a> (<?=$article['tComments']?>)</li>
				<?php endif; ?>
		<?php endforeach; ?>	  
	</ul>
  </div>
  
  <h2>&nbsp;</h2>
</div>

