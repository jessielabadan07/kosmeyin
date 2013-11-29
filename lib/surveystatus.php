<?php
session_start();
require_once('../include/db.config.php');

$conn = mysql_connect(SERVER_HOST,SERVER_USER,SERVER_PASS);
if($conn) {
	mysql_select_db(DB_NAME) or die('ERROR: '.mysql_error);
}

$uid = intval($_SESSION['id']);

if(isset($_POST['survey_status'])) {
	$sid = intval($_POST['survey_status']);
	$query = mysql_query("SELECT * FROM survey_status WHERE sid='$sid' AND uid='$uid'");
	if(mysql_num_rows($query) == 0) {
		$status = 1;
		$insert = mysql_query("INSERT INTO survey_status (id,sid,uid,s_status,s_update) VALUES(NULL,'$sid','$uid','$status',NOW()) ") or die(mysql_error());
	} else {
		$delete = mysql_query("DELETE FROM survey_status WHERE sid='$sid' AND uid='$uid' AND s_status=0") or die(mysql_error());
	}
} else {
	$query = mysql_query("SELECT * FROM survey_status WHERE uid='$uid'") or die(mysql_error());
	$status = mysql_num_rows($query);	
	echo $status;

}

?>