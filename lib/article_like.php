<?php
session_start();
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['aid']))
{	
	$aid = intval($_POST['aid']);
	$cid = isset($_POST['cid']) ? $_POST['cid'] : 0;			
	if(isset($_SESSION['id'])) {
		$uid = intval($_SESSION['id']);
		if(!getLike($uid,$aid,$cid) > 0) {	# if not found like then, insert
			if($cid > 0 OR $aid > 0 OR $uid > 0) {
				$insert = mysql_query("INSERT INTO article_likes VALUES(NULL,'$aid','$cid','$uid',NOW())") or die(mysql_error());
			}
		}
	}
	echo '<a href="javascript:;" style="cursor:pointer;" class="like_article" id="like-'.$aid.','.$cid.'">'.returnTotalArticleLikes($aid,$cid).'</a>';	
} 

function getLike($uid,$aid,$cid) {
	//$query = mysql_query("SELECT * FROM article_likes WHERE article_id='$aid' AND cat_id='$cid' AND user_id='$uid'") or die(mysql_error());
	$query = mysql_query("SELECT * FROM article_likes WHERE article_id='$aid' AND user_id='$uid'") or die(mysql_error());
	return mysql_num_rows($query);
}

function returnTotalArticleLikes($aid,$cid) {
	$query = mysql_query("SELECT * FROM article_likes WHERE article_id='$aid'") or die(mysql_error());
	return mysql_num_rows($query);
}


?>
