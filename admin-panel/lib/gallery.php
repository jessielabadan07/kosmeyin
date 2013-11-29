<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

if(isset($_POST['id']))
{
	$id = intval($_POST['id']);
	$status = (checkStatus($id) == 1) ? 0 : 1;		
	mysql_query("UPDATE image_gallery SET status='$status' WHERE id='$id'") or die(mysql_error());
	echo $status;
}

function checkStatus($id) {
	$query = mysql_query("SELECT * FROM image_gallery WHERE id='$id'") or die(mysql_error());
	if(mysql_num_rows($query) == 1)
	{
		$rst = mysql_fetch_array($query);
		return $rst['status'];
	}
}


?>
