<?php
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

$q=$_GET['q'];

//$my_data=mysql_real_escape_string($q);

$sql="SELECT tags FROM tags WHERE tags LIKE '%$q%' ORDER BY tags";
$result = mysql_query($sql) or die(mysql_error());

if($result)
{
	while($row=mysql_fetch_array($result))
	{
		echo $row['tags']."\n";
	}
}

?>





