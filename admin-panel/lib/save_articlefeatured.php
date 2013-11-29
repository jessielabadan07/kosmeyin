<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['id']))
{
	$id = intval($_POST['id']);
	$len = intval($_POST['len']) + 1;
	mysql_query("INSERT INTO article_featured VALUES(NULL,'$id',NOW(),'$len')") or die(mysql_error());
}


?>
