<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['id']))
{
	$id = intval($_POST['id']);
	mysql_query("DELETE FROM site_menu WHERE id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM sitemenu_content WHERE sitemenu_id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM menu_category WHERE menu_id='$id'") or die(mysql_error());
}


?>
