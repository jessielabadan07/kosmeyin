<?php
session_start();
require_once('../include/db.config.php'); 

$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

$uid = intval($_SESSION['id']);

$str = getUser($uid);

$username = $str['username'];
$image = (strlen($str['profile_image']) > 0) ? '<img src="'.SERVER_URL.'/user_upload/'.$uid.'/thumb-nail'.$str['profile_image'].'" width="33" height="44" />' : '<img src="'.SERVER_URL.'/user_upload/default_user.png" width="33" height="44" />';

// insert data
$article_id = $_POST['aid'];
$content = mysql_real_escape_string(addslashes($_POST['content']));
$insert = mysql_query("INSERT INTO article_comment VALUES(NULL,'$article_id','$uid','$content',1,NOW()) ") or die(mysql_error());

// get last data
$sql_in= mysql_query("SELECT * FROM article_comment ORDER BY id DESC") or die(mysql_error());
$r=mysql_fetch_array($sql_in);

$comment=$r['comments'];
$comment_id=$r['id'];
$dateadded = $r['dateadded'];


function getUser($uid) {	
	$query = mysql_query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id=ui.id WHERE ul.id='$uid'") or die(mysql_error());	
	return mysql_fetch_array($query);
}

?>


			
<div id="<?=$comment_id?>" style="position:relative; overflow:hidden; padding:10px; border:1px solid #ccc; width: 550px; height:auto; margin-bottom:10px;">
	<div style="float:left; height:auto; width:70px; position:relative; overflow:hidden; font-normal:bold; text-alig:justify;"><?=$image?><br/><?=$username?>:</div>
	<div style="float:left; height:auto; width:400px; position:relative; overflow:hidden; text-align:justify;"><?=$comment?><br/><span style="font-size:8px; color:#ccc;"><?=$dateadded?></span></div>
</div>



