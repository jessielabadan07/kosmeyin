<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require_once('../include/db.config.php'); 

	$db = mysql_connect(SERVER_HOST, SERVER_USER, SERVER_PASS) or die ("Unable to connect to Database Server.");
	mysql_select_db (DB_NAME, $db) or die ("Could not select database.");

	session_start();
	$id = intval($_SESSION['id']);


	$targ_w = $targ_h = 150;
	$bthumb_w = $bthumb_h = 50;
	$thumb_w = $thumb_h = 33;
	$jpeg_quality = 90;

	//$src = "../../user_upload/{$id}/{$imageLink}"; //'pool.jpg';
	$src = $_POST["imgname"];//'pool.jpg';	
	$newName = getEncryptedLink($src);
	$ext = getExtension($src);		
	//echo $src;
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	
	$img_bth = imagecreatefromjpeg($src);
	$dst_bth = ImageCreateTrueColor( $bthumb_w, $bthumb_w );
	
	$img_th = imagecreatefromjpeg($src);
	$dst_th = ImageCreateTrueColor( $thumb_w, $thumb_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	
	imagecopyresampled($dst_bth,$img_bth,0,0,$_POST['x'],$_POST['y'],
	$bthumb_w,$bthumb_h,$_POST['w'],$_POST['h']);
	
	imagecopyresampled($dst_th,$img_th,0,0,$_POST['x'],$_POST['y'],
	$thumb_w,$thumb_h,$_POST['w'],$_POST['h']);
	
	$actual_image_name = $newName.".".$ext;	
	$thumbName = "thumb-nail".$newName.".".$ext;	
	$bigthumbName = "big-thumb-nail".$newName.".".$ext;
	
	$filename = "../user_upload/".$id."/". $actual_image_name;
	$filename1 = "../user_upload/".$id."/". $thumbName;
	$filename2 = "../user_upload/".$id."/". $bigthumbName;
	//$filename = "../user_upload/".$id."/". $actual_image_name;
	
	$query = mysql_query("UPDATE user_info SET profile_image='$actual_image_name' WHERE id='$id'") or die(mysql_error());
	
	imagejpeg($dst_r,$filename,$jpeg_quality);
	imagejpeg($dst_th,$filename1,$jpeg_quality);
	imagejpeg($dst_bth,$filename2,$jpeg_quality);

	
	redirect_to(SERVER_URL."?editprofile");
}

function redirect_to($url) {
	header("location: $url");
}

// If not a POST request, display page below:

function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

function getEncryptedLink($img) {
	return sha1(mt_rand(10000,99999).time().$img);	
}

?>