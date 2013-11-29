<?php
require_once('../include/db.config.php'); 
require_once('function.php');

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['id']))
{
	$id = intval($_POST['id']);
	deleteUserInfo($id);	
	$dir = "../../user_upload/{$id}";	
	delete_directory($dir);
}
?>
