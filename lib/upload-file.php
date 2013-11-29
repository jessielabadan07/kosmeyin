<?php

require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

session_start();

$id = intval($_SESSION['id']);

$uploaddir = "../user_upload/".$id."/";

$imagefileName = basename($_FILES['uploadfile']['name']);

$file = $uploaddir.$imagefileName;
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {   
  $query = mysql_query("UPDATE user_info SET profile_image='$imagefileName' WHERE id='$id'") or die(mysql_error());
  echo "success";   
} else {
	echo "error";
}

?>