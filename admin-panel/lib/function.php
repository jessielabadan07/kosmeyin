<?php

# get the id by email
function getIdByEmail($email) {
	$query = mysql_query("SELECT id,email,user_type FROM user_login WHERE email='$email' AND user_type=2") or die(mysql_error());	
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1)
		return $rst['id'];
	else
		return 0;
}

# get extension
function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}	

function getContentMenuFromId($id) {
	$query = mysql_query("SELECT sitemenu_id FROM sitemenu_content WHERE sitemenu_id='$id'") or die(mysql_error());	
	if(mysql_num_rows($query) == 1)
		return 1;
	else 
		return 0;
}

# For uploading article image caption
function UploadArticleImageCaption($id) {		
	error_reporting(0);
	$change="";
	$abc="";
	define ("MAX_SIZE","2000");
	$errors=0; 
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$image =$_FILES["photoimg"]["name"];
		echo $_FILES["photoimg"]["name"];
		$uploadedfile = $_FILES['photoimg']['tmp_name'];     
		if($image) 
		{ 	
			$filename = stripslashes($_FILES['photoimg']['name']); 	
			$extension = getExtension($filename);
			$extension = strtolower($extension);				
			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
			{
			
				$change='<div class="msgdiv">Unknown Image extension </div> ';
				$errors=1;
			} else {				
				$size=filesize($_FILES['photoimg']['tmp_name']);
				if($extension=="jpg" || $extension=="jpeg" ) {
					$uploadedfile = $_FILES['photoimg']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);

				} else if($extension=="png") {
					$uploadedfile = $_FILES['photoimg']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				} else  {
					$src = imagecreatefromgif($uploadedfile);
				}						
				list($width,$height)=getimagesize($uploadedfile);
				$newwidth=201;
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

				list($txt, $ext) = explode(".", $image);
				$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				$filename = "articleuploads/". $actual_image_name;
				$query = mysql_query("UPDATE article SET optional_image='$actual_image_name' WHERE article_id='$id'") or die(mysql_error());																			
				imagejpeg($tmp,$filename,100);
				imagedestroy($src);
				imagedestroy($tmp);
			} # end else
		} # end inner if
	} # end outer if
}

function getLastArticleId() {
	$query = mysql_query("SELECT article_id FROM article ORDER BY article_id DESC") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return $rst['article_id'];
}

function getLastPageId() {
	$query = mysql_query("SELECT * FROM pages ORDER BY page_id DESC") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return $rst['page_id'];
}

function getLastSubMenuItemId() {
	$query = mysql_query("SELECT submenu_id FROM site_submenu ORDER BY submenu_id DESC") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return intval($rst['submenu_id']);
}

function getLastTagId() {
	$query = mysql_query("SELECT tag_id FROM tags ORDER BY tag_id DESC") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return intval($rst['tag_id']);
}

function getLastIdMenu() {
	$query = mysql_query("SELECT id FROM site_menu ORDER BY id DESC") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return intval($rst['id']);
}

function getLastCategoryById() {
	$query = mysql_query("SELECT cat_id FROM category ORDER BY cat_id DESC") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return intval($rst['cat_id']);
}

# check widget
function getTotalWidgetById($id) {
	$query = mysql_query("SELECT sitemenu_id FROM sitemenu_widget WHERE sitemenu_id='$id'") or die(mysql_error());	
	return mysql_num_rows($query);
}



# set cookie article update
function setFlagCookie($msg,$id) {
	# set a flag cookie whatever updates in the database, expire in 20 seconds
	setcookie($msg, $id, time()+20); 
}

# unset cookie
function unsetFlagCookie($msg) {
	# unset a cookie with id
	setcookie($msg, "", time() - 20); 
}

function deleteUserInfo($id) {
	mysql_query("DELETE FROM user_log WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM user_login WHERE id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM user_info WHERE id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM user_activity WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM topweek_scorer WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM article_likes WHERE user_id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM article_comment WHERE user_id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM article_dislike WHERE user_id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM user_survey WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM survey_status WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM user_read_articles WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM send_codelink WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM referrer_points WHERE friend_id='$id'") or die(mysql_error());
	mysql_query("DELETE FROM bonus_points WHERE uid='$id'") or die(mysql_error());
	mysql_query("DELETE FROM gift_points WHERE uid='$id'") or die(mysql_error());
}

function delete_directory($dirname) {
	$dir_handle = null;
   if (is_dir($dirname))
      $dir_handle = opendir($dirname);
   if (!$dir_handle)
      return false;
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if (!is_dir($dirname."/".$file))
            unlink($dirname."/".$file);
         else
            delete_directory($dirname.'/'.$file);    
      }
   }
   closedir($dir_handle);
   rmdir($dirname);
   return true;
}

?>