<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['aid']) AND isset($_POST['tid']))
{
	$aid = intval($_POST['aid']);
	$tid = intval($_POST['tid']);
	mysql_query("DELETE FROM tag_article WHERE tag_id='$tid' AND article_id='$aid'") or die(mysql_error());
}


?>
