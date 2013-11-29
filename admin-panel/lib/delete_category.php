<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['id']))
{
	$id = intval($_POST['id']);
	mysql_query("DELETE FROM category WHERE cat_id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM article_category WHERE cat_id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM menu_category WHERE category_id='$id'") or die(mysql_error());
}


?>
