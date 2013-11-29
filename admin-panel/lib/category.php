<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

$name = !empty($_POST['name']) ? $_POST['name'] : $_POST['alias'];
$alias = !empty($_POST['alias']) ? $_POST['alias'] : $_POST['name'];


if(!checkIfCatTitleExist($name) > 0) {
	$insert = mysql_query("INSERT INTO category VALUES(NULL,'$name','','$alias','article',1,NOW())") or die(mysql_error());
	echo mysql_insert_id();
}

function checkIfCatTitleExist($name) {
	$query = mysql_query("SELECT cat_title FROM category WHERE cat_title='$name'") or die(mysql_error);
	return mysql_num_rows($query);
}

?>





