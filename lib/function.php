<?php
//-- start my functions here --//

function getParsedURL($url) {
	$parsed_url = parse_url($url);
	$query = $parsed_url['query'];
	return substr($query, strripos($query, '/')+1, strlen($query));	
}

function getPageParsedURL($url) {
	
}

function redirect_to($url) {
	header("location: $url");
}

function setSession($id,$uname,$level) {
	$_SESSION['id'] = $id; 		
	$_SESSION['uname'] = $uname;
	$_SESSION['level'] = $level;
}
	
function endSession() {
	unset($_SESSION);
	session_destroy();
	redirect_to(SERVER_URL);
}

function endDataSession() {
	$numargs = func_num_args();
    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {        
		unset($_SESSION[$arg_list[$i]]);
		$_SESSION[$arg_list[$i]] = null;
    }
}

# get extension
function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}	
# For uploading article image caption
function UploadPhoto($id) {	
	error_reporting(0);
	$change="";
	$abc="";
	define ("MAX_SIZE","2000");
	$errors=0; 
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$image =$_FILES["photoimg"]["name"];
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
				$size=filesize($_FILES['file']['tmp_name']);
				if ($size > MAX_SIZE*1024) {
					$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
					$errors=1;
				} if($extension=="jpg" || $extension=="jpeg" ) {
					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);

				} else if($extension=="png") {
					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				} else  {
					$src = imagecreatefromgif($uploadedfile);
				}	
				echo $scr;
				list($width,$height)=getimagesize($uploadedfile);
				$newwidth=60;
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);


				$newwidth1=25;
				$newheight1=($height/$width)*$newwidth1;
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);


				/*$filename = "images/". $_FILES['file']['name'];

				$filename1 = "images/small". $_FILES['file']['name'];*/
				
				list($txt, $ext) = explode(".", $image);
				$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				$thumb_name = 'thumb-nail'.$actual_image_name;
				
				$filename = "user_upload/".$id."/". $actual_image_name;
				$filename1 = "user_upload/".$id."/". $thumb_name;
				
				$query = mysql_query("UPDATE user_info SET profile_image='$actual_image_name' WHERE id='$id'") or die(mysql_error());
				

				imagejpeg($tmp,$filename,100);

				imagejpeg($tmp1,$filename1,100);

				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);
			} # end else
		} # end inner if
	} # end outer if
}

# get images in the local directory
function getImages(&$arrImages) {
	/*$dir = "scripts/slideshow/";	
	$pic_types = array("jpg", "jpeg", "gif", "png");
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types)) {
					array_push($arrImages,$file);
				}
			}
			closedir($dh);
		}
	}*/
}

function getProfileImageById($uid) {
	$query = mysql_query("SELECT id,profile_image FROM user_info WHERE id='$uid'") or die(mysql_error);
	$str = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1)
		return !(empty($str['profile_image'])) ? '<img src="'.SERVER_URL.'/user_upload/'.$uid.'/thumb-nail'.$str['profile_image'].'" width="33" height="44" />' : '<img src="'.SERVER_URL.'/user_upload/default_user.png" width="33" height="44" />';	
}

function getPhotoToCrop($uid) {
	$query = mysql_query("SELECT id,profile_image FROM user_info WHERE id='$uid'") or die(mysql_error);
	$str = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1)
		return !(empty($str['profile_image'])) ? $str['profile_image'] : null;
}

//-- function to check the email if it exist in the database
function checkEmail($email) {
	$query = mysql_query("SELECT email FROM user_login WHERE email='$email'") or die(mysql_error());
	if(mysql_num_rows($query) == 1) 
		return true;
	else 
		return false;	
}//-- end function checkEmail

//-- function to check if username already registered
function checkUsername($uname) {
	$query = mysql_query("SELECT username FROM user_login WHERE username='$uname'") or die(mysql_error());
	if(mysql_num_rows($query) == 1) 
		return true;
	else 
		return false;	
}

function checkUsernameByUserId($id,$uname) {
	$query = mysql_query("SELECT id,username FROM user_login WHERE username='$uname' AND id != '$id'") or die(mysql_error());
	if(mysql_num_rows($query) == 1) 
		return true;
	else 
		return false;	
}

function checkEmailByUserId($id,$email) {
	$query = mysql_query("SELECT id,email FROM user_login WHERE email='$email' AND id != '$id'") or die(mysql_error());
	if(mysql_num_rows($query) == 1) 
		return true;
	else 
		return false;	
}//-- end function checkEmail

//-- function to check the email if it exist in the database
function checkEmailByFriend($email,$id) {
	$query = mysql_query("SELECT uid,friend_email FROM send_codelink WHERE friend_email='$email'") or die(mysql_error());
	if(mysql_num_rows($query) == 1) 
		return true;
	else 
		return false;	
}//-- end function checkEmail


//-- function to send a link to the friend
function sendToLink($uid,$friendEmail,$senderEmail,$subject,$message,$secret_link,$datetime) {	
	//$ip = getLocalIpAddr();
	$ip = getRealIpAddr();
	$insert = mysql_query("INSERT INTO send_codelink VALUES (NULL,'$uid','$friendEmail','$subject','$secret_link',0,'$ip','$datetime','$datetime')");	
	//subject 
	$link = SERVER_URL."?user-validate-code=$secret_link&email=".$friendEmail."&skid=$uid&dt=".urlencode($datetime)."&submitaction=true";
	//$msg = "Please click the link to join our page <a href='$link'>$link</a> or copy the code and paste it into your url.";
	sendmail($senderEmail,$senderEmail,$friendEmail,$friendEmail,$subject,$subject,$message,null);
}//-- end function to send a link

//-- function
function secretCodeLink($id,$user,$email) {
	//$from_email = "webmaster@kosmeyin.com";
	$from_email = "kos@kosmeyin.com";
	$subject = "因我IN 注册成功！请确认您的邮箱地址激活IN GIRL账号。";		
	$secret_code = getEncryptedLink($id,$user,$email);
	insertSecretCodeLink($id,$secret_code);
	$link = SERVER_URL."?verify=$secret_code";	
	$msg = "恭喜！您的因我IN IN GIRL账号注册成功！请点击以下链接确认您的邮箱地址并激活您的IN GIRL账号: <a href='$link'>$link</a><br/> ~ 小K老师 和 因我IN 团队";
	sendmail($from_email,$from_email,$email,$email,$subject,$subject,$msg,null);
}

//-- insert secret code
function insertSecretCodeLink($id,$code) {
	$insert = mysql_query("UPDATE user_login SET status_code='$code' WHERE id='$id'") or die(mysql_error());
}


function getVerificationCode($code) {
	$query = mysql_query("SELECT status_code FROM user_login WHERE status_code='$code' AND status_link=0") or die(mysql_error());	
	if(mysql_num_rows($query) == 1) {		
		$update = mysql_query("UPDATE user_login SET status_link=1 WHERE status_code='$code'") or die(mysql_error());
		userRegisterActivity($code);
		redirect_to(SERVER_URL."?verificationsuccess");
	} 
	else { 
		redirect_to(SERVER_URL);
	}
}

function getUserLastId() {
	$query = mysql_query("SELECT id FROM user_login ORDER BY id DESC") or die(mysql_error());	
	$rst = mysql_fetch_array($query);
	return intval($rst['id']);
}

function userRegisterActivity($code) {
	$query = mysql_query("SELECT id,username,status_code FROM user_login WHERE status_code='$code'") or die(mysql_error());		
	$rst = mysql_fetch_array($query);
	$id = intval($rst['id']);
	$type = "user-register";
	if(!checkBonusPoints($id)) {
		mysql_query("INSERT INTO bonus_points VALUES (NULL,'$id',50,'$type',NOW())") or die(mysql_error());		
		$text = "新注册用户 <span class=\"listRed\">".$rst['username']."</span> 获取了 50 K币！.";
		mysql_query("INSERT INTO user_activity (id, uid, content, stored_type, date_added) VALUES (NULL,'$id','$text','newuser',now())") or die(mysql_error());
	}
}

function checkBonusPoints($id) {
	$query = mysql_query("SELECT * FROM bonus_points WHERE uid='$id'") or die(mysql_error());
	if(mysql_num_rows($query) == 1)
		return true;
	return false;
}

//-- get encrypted words
function getEncryptedLink($id,$user,$email) {
	return sha1(mt_rand(10000,99999).time().$email).'-'.sha1(mt_rand(10000,99999).time().$id).'-'.sha1(mt_rand(10000,99999).time().$id);	
}

function getRequestedLink($code,$email,$id,$dt,$action) {		
	if(empty($code) && empty($email) && empty($id) && empty($dt) && ($action != "true")) {		
		header("location: ".SERVER_URL);
	} else {
		$sql =  "SELECT * FROM send_codelink WHERE uid='$id' ";
		$sql .= "AND secret_link='$code' AND datetime_send='$dt' AND status_link=0";
		$query = mysql_query($sql) or die(mysql_error());
		$rst = mysql_fetch_array($query);
		if(mysql_num_rows($query) == 1) {
			return $rst['friend_email'];			
		} else {			
			header("location: ".SERVER_URL);
		} 
	}	
}

//-- update code link, if status = 1
function updateSendCodeLink($id,$email) {
	$dt = date("Y-m-d H:i:s", time());
	$update = mysql_query("UPDATE send_codelink SET status_link=1, lastdatetime_update='$dt' WHERE uid='$id' AND friend_email='$email'"); //or die(mysql_error());
	if(!$update) {
		header("location: ".SERVER_URL);
	}
}

function sendRequestPasswordCode($type,$email,$code) {
	if(checkEmail($email)) {
		$enrypted_code = sha1(urlencode($type).'-'.urlencode($email).'-'.urlencode($code));
		$query = mysql_query("INSERT INTO user_forgotpassword VALUES(NULL,'$email','$type','$enrypted_code',0,'$code',now())") or die(mysql_error());
		//$from_email = "webmaster@kosmeyin.com";
		$from_email = "kos@kosmeyin.com";
		$subject = "您在因我IN申请重设密码";		
		$link = SERVER_URL."?verifyrequest=$enrypted_code";	
		$msg = "请点击以下链接打开网址重设密码。 <br/><a href='$link'>$link</a><br/>";
		$msg .= "如果点击打不开，可以复制黏贴到浏览器里面。<br/><br/>";
		$msg .= "如果您没有申请或没有 “忘记密码”可以不理会此邮件。<Br/>";
		$msg .= "谢谢！<br/><br/>";
		$msg .= "- Kosmeyin Team 因我IN";
		sendmail($from_email,$from_email,$email,$email,$subject,$subject,$msg,null);
	} else {
		redirect_to(SERVER_URL."?forgotpassword&error=emailaddress");
	}
}

function searchForgotPassCode($code) {
	$query = mysql_query("SELECT * FROM user_forgotpassword WHERE validation_code='$code' AND user_field='forgot-password' AND current_status=0") or die(mysql_error());	
	if(mysql_num_rows($query) == 1) {
		$rst = mysql_fetch_array($query);
		return $rst['email'];
	} else {
		
	}
}

function getEmail($id) {
	$query = mysql_query("SELECT id,email FROM user_login WHERE id='$id'") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1) 
		return $rst['email'];	
	else 
		return 0;
}

//-- function to return the id 
function getIdInEmail($email) {
	$query = mysql_query("SELECT id,email FROM user_login WHERE email='$email'") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1) 
		return $rst['id'];	
	else 
		return 0;	
}//-- end function getIdInEmail

function getArticleTitleById($aid) {
	$query = mysql_query("SELECT article_id,article_title FROM article WHERE article_id='$aid' AND article_status=1");
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0)
		return $rst['article_title'];
	return null;
}

function getFriendById($id) {
	$query = mysql_query("SELECT id,username FROM user_login WHERE id='$id'") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0) 
		return $rst['username'];	
	else 
		return 0;
}

//-- function to get a point(s)
function getReferredPoints($uid) {	
	$query = mysql_query("SELECT friend_id FROM referred_friend WHERE friend_id='$uid'") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0) 
		return mysql_num_rows($query);
	else 
		return 0;
}//-- end function getReferredPoints

//-- function to get friends' points
function getFriendsPoints($uid) {
	$query = mysql_query("SELECT uid,mypoints FROM points WHERE uid='$uid'") or die(mysql_error());			
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1) 
		return $rst['mypoints'];
	else 
		return 0;
}//-- end function getFriendsPoints

function savePointsLogIn($uid) {
	if(!getUserLogIn($uid) AND $uid > 1) {
		$pts = intval(10);
		$ip = getRealIpAddr();
		$query = mysql_query("INSERT INTO user_log VALUES(NULL,'$uid',NOW(),'$ip','$pts')") or die(mysql_error());
	}
}

function getUserLogIn($uid) {
	$sql =  "SELECT uid, datetime_login FROM user_log ";
	$sql .= "WHERE DATE_FORMAT(datetime_login,'%Y-%m-%d') = CURDATE() AND uid='$uid'";
	$query = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($query) == 1)
		return true;
	return false;
}

//-- function to get a points from product purchased
function getPointsFromProductPurchased($uid) {
	$query = mysql_query("SELECT uid FROM purchased_products WHERE uid='$uid'") or die(mysql_error());			
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0) 
		return mysql_num_rows($query);
	else 
		return 0;
}//-- end getPointsFromProduct

//-- function to get points from survey
function getPointsFromSurvey($uid) {
	$query = mysql_query("SELECT uid FROM user_survey WHERE uid='$uid'") or die(mysql_error());			
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0) 
		return mysql_num_rows($query);
	else 
		return 0;
}//-- end function getPointsFromSurvey

//-- function to get a point(s) in asc or desc order
function getReferredPointsOrder($uid,$order) {
	$query = mysql_query("SELECT * FROM points rp JOIN user_login u ON rp.uid = u.id WHERE rp.uid='$uid' ORDER BY rp.mypoints ".$order) or die(mysql_error());
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1) 
		return $rst['mypoints'];
	else 
		return 0;
}//-- end function getReferredPointsOrder

function getProfileImage() {
	$query = mysql_query("SELECT profile_image FROM user_info WHERE id=".intval($_SESSION['id'])) or die(mysql_error);
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) > 0)
		return $rst['profile_image'];
	else
		return false;
}

function getImageById($id) {
	$query = mysql_query("SELECT id,profile_image FROM user_info WHERE id=".intval($id)." AND profile_image IS NOT NULL") or die(mysql_error);
	$rst = mysql_fetch_array($query);
	if(mysql_num_rows($query) == 1) {
		if(strlen($rst['profile_image']) > 0) {			
			return "user_upload/".$rst['id']."/".$rst['profile_image'];				
		} else {
			return "user_upload/default_user.png";
		}
	}		
	else
		return null;
}

//-- function to get all your points
function getTotalPoints($id) {	
	$points = 0;
	$query = mysql_query("SELECT uid, bonus_pts FROM bonus_points WHERE uid='$id' ORDER BY bid") or die(mysql_error());
	$points = countPoints($query,'bonus_pts');	
	$query = mysql_query("SELECT uid, s_points,s_dateanswered FROM user_survey WHERE uid='$id' ORDER BY s_dateanswered") or die(mysql_error());	
	$points += countPoints($query,'s_points');
	$query = mysql_query("SELECT friend_id, r_points,datetime_added FROM referrer_points WHERE friend_id='$id' ORDER BY datetime_added") or die(mysql_error());
	$points += countPoints($query,'r_points');		
	$query = mysql_query("SELECT id,points,date_read FROM user_read_articles user_read_articles WHERE uid='$id' ORDER BY date_read") or die(mysql_error());
	$points += countPoints($query,'points');	
	$query = mysql_query("SELECT uid,datetime_login,points_log FROM user_log WHERE uid='$id' ORDER BY uid DESC") or die(mysql_error());
	$points += countPoints($query,'points_log');	
	$points += pointsCommentArticle($id);
	return $points;
}

function pointsCommentArticle($id) {
	$query = mysql_query("SELECT COUNT(user_id) as total_comment_points FROM article_comment WHERE user_id='$id'") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return $rst['total_comment_points'] * intval(10);
}

function StartWeekDay() {
	$query = mysql_query("SELECT adddate(curdate(), INTERVAL 2-DAYOFWEEK(curdate()) DAY) WeekStart") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return $rst["WeekStart"];
}

function countPoints($query,$arg_str) {
	$pts = 0;
	if(mysql_num_rows($query) > 1) {
		while($r = mysql_fetch_array($query)) {
			$pts += $r[$arg_str];
		}
	} else {
		$r = mysql_fetch_array($query);		
		$pts = $r[$arg_str];
	}
	return $pts;
}

function queryArray($str, $id=0, $pts=0, &$user_data) {
	$q = mysql_query($str) or die(mysql_error);
	$rst = mysql_fetch_array($q);	
	array_push($user_data, array( $rst[$id] => $rst[$pts]) );
}


//-- insert/update points
function savePoints($friend_id) {
	if(getReferredPoints($friend_id) > 0) {	// if found friend in points, accumulate points
		$point = getReferredPoints($friend_id) + 50;	# if the referrals successfully sign up then add 50 points to referrer		
		$sql = "UPDATE points SET mypoints='$point' WHERE uid='$friend_id'";
	} else {	// if not found, insert a new point value of 50 point!
		$sql = "INSERT INTO points (uid,mypoints) VALUES ('$friend_id',50)";
	}
	mysql_query($sql) or die(mysql_error());
}//-- end function savePoints

function saveSurveyPoints($sid,$uid,$answer) {
	$pts = intval(20);
	mysql_query("INSERT INTO user_survey (id,sid,uid,s_answer,s_points,s_dateanswered) VALUES (NULL,'$sid','$uid','$answer','$pts',NOW())") or die(mysql_error());	
}

//--get last id and increment it by one
function getLastId() {
	$query = mysql_query("SELECT MAX(id) as 'max' FROM users") or die(mysql_error());
	$rst = mysql_fetch_array($query);
	return $rst['max'] + 1;
}//-- end function getLastId()

function addActivity($id,$text,$type) {		
	$query = mysql_query("INSERT INTO user_activity (id, uid, content, stored_type, date_added) VALUES (NULL,'$id','$text','$type',now())") or die(mysql_error());
}

function getLastDayOfWeek() {
	$last_day_of_week = date('m-d-Y', strtotime('Monday', time()));
	$todays_date = date('m-d-Y');
	if($last_day_of_week == $todays_date) {
		return true;
	}
	return false;
}

//-- time lapse
function elapseTime($date) {
	if(empty($date)) {
		return "Please provide date.";
	}	 
	$periods = array("second", "分钟", "小时", "天", "week", "month", "year", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");
	 
	$now = time();
	$unix_date = strtotime($date);
	 
	// check validity of date
	if(empty($unix_date)) {
		return "Invalid date";
	}
	 
	//Check to see if it is past date or future date
	if($now > $unix_date) {
		$difference = $now - $unix_date;
		$tense = "前";	 
	} else {
		$difference = $unix_date - $now;
		$tense = "from now";
	}	 
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}	
	$difference = round($difference);	 
	if($difference != 1) {
		//$periods[$j].= "s";
		$periods[$j].= "";
	}	 
	return "$difference $periods[$j] {$tense}";
}

/*$date = "2012-09-07 16:17:43";
$result = nicetime($date); // 2 days ago
echo $result;*/

//-- function to get the real ip address or domain
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}//-- end function real ip address

//-- get the local ip address function
function getLocalIpAddr() {
	return GetHostByName(@$REMOTE_ADDR);
} //-- end local ip address function

//-- sendi email function
function sendmail ($from_name, $from_email, $to_name, $to_email, $subject, $text_message="", $html_message, $attachment="") 
{ 
	$from = "$from_name <$from_email>"; 
	$to   = "$to_name <$to_email>"; 
	$main_boundary = "----=_NextPart_".md5(rand()); 
	$text_boundary = "----=_NextPart_".md5(rand()); 
	$html_boundary = "----=_NextPart_".md5(rand()); 
	$headers  = "From: $from\n"; 
	$headers .= "Reply-To: $from\n"; 
	$headers .= "X-Mailer: Yellow\n"; 
	$headers .= "MIME-Version: 1.0\n"; 
	$headers .= "Content-Type: multipart/mixed;\n\tboundary=\"$main_boundary\"\n"; 	
	$message = '';
	$message .= "\n--$main_boundary\n"; 
	$message .= "Content-Type: multipart/alternative;\n\tboundary=\"$text_boundary\"\n"; 
	$message .= "\n--$text_boundary\n"; 
	$message .= "Content-Type: text/plain; charset=\"utf-8\"\n"; 
	$message .= "Content-Transfer-Encoding: 7bit\n\n"; 
	$message .= ($text_message!="")?"$text_message":"Text portion of HTML Email"; 
	$message .= "\n--$text_boundary\n"; 
	$message .= "Content-Type: multipart/related;\n\tboundary=\"$html_boundary\"\n"; 
	$message .= "\n--$html_boundary\n"; 
	$message .= "Content-Type: text/html; charset=\"utf-8\"\n"; 
	$message .= "Content-Transfer-Encoding: quoted-printable\n\n"; 
	$message .= str_replace ("=", "=3D", $html_message)."\n"; 
	if (isset ($attachment) && $attachment != "" && count ($attachment) >= 1) 
	{ 
		for ($i=0; $i<count ($attachment); $i++) 
		{ 
			$attfile = $attachment[$i]; 
			$file_name = basename ($attfile); 
			$fp = fopen ($attfile, "r"); 
			$fcontent = ""; 
			while (!feof ($fp)) 
			{ 
				$fcontent .= fgets ($fp, 1024); 
			} 
			$fcontent = chunk_split (base64_encode($fcontent)); 
			@fclose ($fp); 
			$message .= "\n--$html_boundary\n"; 
			$message .= "Content-Type: application/octetstream\n"; 
			$message .= "Content-Transfer-Encoding: base64\n"; 
			$message .= "Content-Disposition: inline; filename=\"$file_name\"\n"; 
			$message .= "Content-ID: <$file_name>\n\n"; 
			$message .= $fcontent; 
		} 
	} 
	$message .= "\n--$html_boundary--\n"; 
	$message .= "\n--$text_boundary--\n"; 
	$message .= "\n--$main_boundary--\n"; 
	@mail ($to, $subject, $message, $headers); 
} // send link to an email function    

//-- function to validate email
function validateEmailAddress($email) {
	// First, we check that there's one @ symbol, 
	// and that the lengths are right.
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
		return false;
	}
	// Split it into sections 
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])) {
		  return false;
		}
	}
	// Check if domain is IP. If not, 
	// it should be valid domain name
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|?([A-Za-z0-9]+))$",$domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
} //-- end email validation

//-- function to remove email duplicate entries, case-sensitive
function array_unique_case($array=null) {
    sort($array);
    $tmp = array();
    $callback = function ($a) use (&$tmp) {
        if (in_array(strtolower($a), $tmp))
            return false;
        $tmp[] = strtolower($a);
        return true;
    };
    return array_filter($array, $callback);
} //-- end function array_unique_case

//-- function to avoid sql injection
function escape_string($string) {
	return mysql_real_escape_string($string);
} // end escape_string function

function countArticleLikes($id) {
	$query = mysql_query("SELECT COUNT(*) as total_likes FROM article_likes WHERE article_id='$id'") or mysql_error();
	$rst = mysql_fetch_array($query);	
	return ($rst['total_likes'] > 0) ? $rst['total_likes'] : 0;
}
	
function getTotalArticleComments($id) {		
	$query = mysql_query("SELECT COUNT(*) as total_comments FROM article_comment WHERE article_id='$id'") or die(mysql_error());
	$rst = mysql_fetch_array($query);	
	return ($rst['total_comments'] > 0) ? $rst['total_comments'] : 0;
}

function inviteFriendError($error=null,$msg=null) {
	if(isset($_GET['error'])) {
		if($_GET['error'] == $error)
			echo '<p><small class="kosgrey2" style="color:#f00; font-size:12px;">'.$msg.'</small></p>';
	}
}


/** 
 *  Multibyte equivalent for htmlentities() [lite version :)] 
 * 
 * @param string $str 
 * @param string $encoding 
 * @return string 
 **/ 
function mb_htmlentities($str, $encoding = 'utf-8') { 
    mb_regex_encoding($encoding); 
    $pattern = array('<', '>', '"', '\''); 
    $replacement = array('&lt;', '&gt;', '&quot;', '&#39;'); 
    for ($i=0; $i<sizeof($pattern); $i++) { 
        $str = mb_ereg_replace($pattern[$i], $replacement[$i], $str); 
    } 
    return $str; 
} 

//---- end functions data here --
?> 