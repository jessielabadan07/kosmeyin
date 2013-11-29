<?php include('template/content_top.php'); ?>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;"><a href="<?=SERVER_URL?>?article" style="color:#C60070;">Article</a> : Delete ID: <?=intval($_GET['delete_id'])?></div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;"><br/>	
<div style="border:1px solid orange; padding:10px; background-color:lemonchiffon; width:650px;">
Are you sure you want to delete this article?
<a href="<?=SERVER_URL?>?article&confirmdeleteid=<?=intval($_GET['delete_id'])?>">Yes</a>&nbsp;/&nbsp;<a href="<?=SERVER_URL?>?article">No</a>
</div>	
</div>
<?php include('template/content_bottom.php'); ?>			
		