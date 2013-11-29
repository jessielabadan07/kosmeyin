<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['aid']))
{	
	$aid = intval($_POST['aid']);
	$cid = isset($_POST['cid']) ? intval($_POST['cid']) : 0;				
	echo '<a href="javascript:;" style="cursor:pointer;" class="dislike_article" id="'.$aid.','.$cid.'">'.returnTotalArticleDisLikes($aid,$cid).'</a>';	
} 
function returnTotalArticleDisLikes($aid,$cid) {
	$query = mysql_query("SELECT * FROM article_dislike WHERE article_id='$aid'") or die(mysql_error());
	return mysql_num_rows($query);
}

?>
