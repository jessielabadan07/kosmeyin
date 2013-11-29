<?php

require_once('model/database.php');

class User extends Database {
	
	private $numargs = 0;		# set number of arguments to 0
	private $arg_list = 0;		# argument list array to hold the params
	private $errors = array();	# this will hold the array of errors
	private $topUser = array();
	
	protected $members = array();
	protected $returnRows = 0;
		
	# constructor
	public function __construct() {
		parent::__construct();	# call parent constructor	
	}	
	
	public function Login() {		
		if(empty($_POST['username']) && empty($_POST['password'])) {
			$this->redirect_to('?login&error=true');
		} else {						
			$uname = $this->escape_string($_POST['username']);
			$pass = $this->escape_string(sha1($_POST['password']));
			$this->query("SELECT * FROM user_login WHERE username='$uname' AND password='$pass' AND status_link=1", $this->ERROR_QUERY.$this->table_name);									
			if($this->return_rows() == 1) {						# if return 1 then true,
				foreach($this->result_to_object() as $obj) {
					$this->setSession($obj->id,$obj->email,$obj->username,$obj->user_type);		
					savePointsLogIn($obj->id);
				} # end foreach				
				$this->redirect_to(SERVER_URL);
			} else {
				$this->redirect_to(SERVER_URL.'?login&error=true');
			}
		} # end outer else
	} # end function Login
	
	public function Register($user,$pass,$email,$gender,$bdate,$phone,$type) {					
		$pass = sha1($pass);
		$this->table_name = 'user_login';									
		$this->query("INSERT INTO ".$this->table_name." (id,email,username,password,join_date,user_type,status_link) VALUES (NULL,'$email','$user','$pass',now(),1,0)", $this->ERROR_INSERT.$this->table_name);
		//$id = mysql_insert_id();			
		$id = getUserLastId();
		$dir_id = "user_upload/".$id;
		mkdir($dir_id, 0777, true); // create directory for your id						
		$this->table_name = 'user_info';									
		$this->query("INSERT INTO ".$this->table_name." (id,gender,bdate,phone) VALUES('$id','$gender','$bdate','$phone')", $this->ERROR_INSERT.$this->table_name);		
		secretCodeLink($id,$user,$email);
		# If type == linkuser
		if($type=="viafriendemail") {
			$pid = intval($_POST['fid']);
			updateSendCodeLink($pid,$email);
			# create logs						
			$desc = "New user: {$email} successfully registered, referred to User: ".getEmail($pid);
			$dt = date("Y-m-d H:i:s", time());			// new date and time last inserted
			# add points to referrer 50
			$pts = intval(50);
			$this->query("INSERT INTO referrer_points VALUES (NULL,'$pid','$id','$desc','$pts','$dt')", $this->ERROR_INSERT);
			# call the function to save activity
			$stype = "friendreferral";
			$content = '<span class="listRed">'.getFriendById($pid).'</span> 邀请的好友也注册了IN GIRL 获得 50 K币。';			
			$this->query("INSERT INTO user_activity VALUES(NULL,'$id','$content','$type',now())", $this->ERROR_INSERT);
		} 
		# redirect to the login page		
		$this->redirect_to(SERVER_URL."?success");
	}	
	
	protected function GetUserInfo($id) {
		$this->query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id=ui.id WHERE ul.id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function ModelVerify($verify_code) {
		if(empty($verify_code)) {
			// do nothing just redirect 
			$this->redirect_to(SERVER_URL);
		} else {
			getVerificationCode($verify_code);
		}
	}
	
	protected function VerifyForgotPass($code) {
		$code = $this->escape_string($code);
		$email = searchForgotPassCode($code);
		if(strlen($email) > 0 AND !empty($email)) {
			return $email;
		} else {
			$this->redirect_to(SERVER_URL);
		}
	}
	
	protected function NewPassword() {		
		if(empty($_POST['password1'])) {
			unset($_SESSION['password2_error']);
			$this->errArr[]  = 'password1_error';
			$_SESSION['password1_error'] = '<label for="password1" generated="true" class="error" style>请输入登录密码</label>';		
		} if(strlen($_POST['password1']) < 5) {
			unset($_SESSION['password2_error']);
			$this->errArr[] = 'password1_error';
			$_SESSION['password1_error'] = '<label for="password1" generated="true" class="error" style>请输入5到12位半角字母 （字母，数字，符号）不区分大小写</label>';		
		} if(empty($_POST['password2'])) {
			unset($_SESSION['password1_error']);
			$this->errArr[]  = 'password2_error';
			$_SESSION['password1_error'] = '<label for="password2" generated="true" class="error" style>请确认登录密码</label>';		
		} if($_POST['password1'] != $_POST['password2']) {
			unset($_SESSION['password2_error']);
			$this->errArr[] = 'password1_error';
			$_SESSION['password1_error'] = '<label for="password1" generated="true" class="error" style>您输入确认密码和密码不一致</label>';		
		} if(count($this->errArr) > 0) {
			$this->redirect_to(SERVER_URL.'?verifyrequest='.$_POST['hide_code']);
		} else {
			$email = $this->VerifyForgotPass($_POST['hide_code']);			
			$password = $this->escape_string($_POST['password1']);
			$email = $this->escape_string($email);
			$password = sha1($password);			
			$this->query("UPDATE user_login SET password='$password' WHERE email='$email'", $this->ERROR_UPDATE);
			$this->query("DELETE FROM user_forgotpassword WHERE email='$email' AND validation_code='".$this->escape_string($_POST['hide_code'])."' AND current_status=0");
			$this->redirect_to(SERVER_URL.'?newpasswordset=true&success');
		}
	}
	
	
	
	protected function SubmitFriendRequest() {
		$friendEmail = $this->escape_string($_POST['friendemail']);
		$senderEmail = $this->escape_string($_POST['youremail']);
		$name = $this->escape_string($_POST['yourname']);
		$subject = !empty($_POST['subject']) ? $_POST['subject'] : "一起来做 IN GIRL 玩转 因我IN";
		iconv_set_encoding("internal_encoding", "UTF-8");
		$message = htmlspecialchars(stripslashes($_POST['message']), ENT_COMPAT, 'UTF-8'); 
		if(!filter_var($friendEmail, FILTER_VALIDATE_EMAIL)) {
			$this->redirect_to(SERVER_URL."?invite-a-friend&error=invalid-friend-email-address");
		}  elseif(checkEmail($friendEmail) || checkEmailByFriend($friendEmail,0)) {
			$this->redirect_to(SERVER_URL."?invite-a-friend&error=email-already-registered");
		} elseif(!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
			$this->redirect_to(SERVER_URL."?invite-a-friend&error=invalid-email-address");
		} elseif(empty($_POST['yourname']) && strlen($_POST['yourname']) == 0) {
			$this->redirect_to(SERVER_URL."?invite-a-friend&error=invalid-input-username");
		} else {			
			$code = sha1(mt_rand(10000,99999).time().$friendEmail);										
			$datetime = date("Y-m-d H:i:s", time());	
			sendToLink($_SESSION['id'],$friendEmail,$senderEmail,$subject,$message,$code,$datetime);							
			$this->redirect_to(SERVER_URL."?requestsendsuccess");
		}
	}
	
	
	protected function ModelUserValidateCode() {
		$code = $this->escape_string($_GET['user-validate-code']);
		$email = $this->escape_string($_GET['email']);
		$id = intval($_GET['skid']);
		$dt = $this->escape_string($_GET['dt']);
		$action = $this->escape_string($_GET['submitaction']);
		return getRequestedLink($code,$email,$id,$dt,$action);
	}
	
	protected function ReadArticleByUserId($aid) {		
		if(isset($_SESSION['id'])) {
			$uid = intval($_SESSION['id']);	
			if($uid > 1) {
				if(!$this->GetArticleByUserId($uid,$aid)) {			
					if(strlen(getArticleTitleById($aid)) > 0) {
						$ip = getRealIpAddr();						
						$text = '<span class="listRed">'.$_SESSION['uname'].'</span>  阅读了 <span class="listRed">'.getArticleTitleById($aid).'.</span> 文章 获得 <span class="listRed">10 K币</span>';
						$type = "readarticle";
						$pts = intval(10);				
						$this->query("INSERT INTO user_read_articles VALUES(NULL,'$uid','$aid','$pts','$ip',now())", $this->ERROR_INSERT);		
						addActivity($uid,$text,$type);
					}
				}
			}
		}
	}
	
	protected function GetUserNameById($id) {
		$this->query("SELECT id,username FROM user_login WHERE id='$id'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			$this->result_to_array();
			return $this->rst['username'];
		}
	}
	
	protected function GetTotalFriendsInvited() {
		$id = intval($_SESSION['id']);
		$this->query("SELECT uid,status_link FROM send_codelink WHERE uid='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function GetTotalFriendsRegistered() {
		$id = intval($_SESSION['id']);
		$this->query("SELECT uid,status_link FROM send_codelink WHERE uid='$id' AND status_link=1", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
		
	protected function GetPointsByReadingArticle() {
		$id = intval($_SESSION['id']);
		$this->query("SELECT uid, SUM(points) as total_points_read FROM user_read_articles WHERE uid='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['total_points_read'];
	}
	
	protected function GetPointsByCommentingOnArticle() {
		$id = intval($_SESSION['id']);
		$this->query("SELECT DISTINCT article_id FROM article_comment WHERE user_id='$id'", $this->ERROR_QUERY);
		return intval($this->return_rows() * 10);		
	}
	
	protected function GetSignupBonus() {
		$id = intval($_SESSION['id']);
		$this->query("SELECT * FROM user_login ul RIGHT JOIN bonus_points bp ON ul.id=bp.uid WHERE ul.id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['bonus_pts'];
	}
	
	protected function GetPointsLogginInToday() {
		$id = intval($_SESSION['id']);
		$this->query("SELECT uid, SUM(points_log) as total_points_log FROM user_log WHERE uid='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['total_points_log'];
	}
	
	protected function GetPointsSevenDaysInRow() {
	}
	
	protected function GetPointsByMediaSharing() {
	}
	
	protected function GetPointsByContributorsBonus() {
	}
	
	protected function GetPointsThisMonthPurchase() {}
	
	protected function GetTotalPreviousPurchase() {}

	
	protected function GetArticleByUserId($uid,$aid) {
		$this->query("SELECT uid,article_id FROM user_read_articles WHERE uid='$uid' AND article_id='$aid'", $this->ERROR_QUERY);
		if($this->return_rows() > 0)
			return true;
		return false;
	}
	
	protected function GetUserDataByArticleId($id,$arg) {
		$this->result = null;
		$this->query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id=ui.id WHERE ul.id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		echo $this->rst[$arg];
	}
	
		
	protected function setSession($id,$email,$uname,$level) {
		$_SESSION['id'] = $id; 		
		$_SESSION['email'] = $email;
		$_SESSION['uname'] = $uname;
		$_SESSION['level'] = $level;
	}
	
	protected function SetUserTopWeekScorer(&$user) {
		$this->topUser = $user;
		echo print_r($this->topUser);
	}
	
	protected function GetUserTopWeekScorer() {
		echo '<pre>';
		print_r($this->topUser);
	}
	
	protected function UserBonusPoints() {
		$this->result = null;
		$this->query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id = ui.id WHERE ul.user_type<2 AND ul.status_link=1",  $this->ERROR_QUERY); 
		$this->returnRows = $this->return_rows();
		foreach($this->result_to_object() as $obj)  							
			array_push($this->members, array('tPoints' => getTotalPoints($obj->id), 'mUser' => $obj->username, 'uImage' => getImageById($obj->id)));																														
		foreach ($this->members as $key => $row) {
			$points[$key]  = $row['tPoints'];
			$user[$key] = $row['mUser'];
		}				
		array_multisort($points, SORT_DESC, $user, SORT_ASC, $this->members);		
	}
	
	protected function GetUserTopWeeklyScorer($id) {
		$this->result = null;
		$this->query("SELECT * FROM user_login ul RIGHT JOIN user_info ui ON ul.id=ui.id WHERE ul.id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function GetUserIdTopScorer() {
		$this->result = null;
		$startWeek = StartWeekDay();
		$this->query("SELECT * FROM topweek_scorer WHERE first_day_on_week='$startWeek'", $this->ERROR_QUERY);
		$this->result_to_array();		
		return $this->rst['uid'];
	}
	
	protected function GetUserIdByUsername($uname) {
		$this->result = null;
		$this->query("SELECT id, username FROM user_login WHERE username='$uname'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['id'];
	}
	
	protected function GetPointsById($id) {
		$this->result = null;
		$this->query("SELECT id, points FROM topweek_scorer ORDER BY id DESC", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['points'];
	}
	
	protected function SetTopWeeklyScorer($id,$points) {		
		$startWeek = StartWeekDay();		
		$this->query("SELECT first_day_on_week FROM topweek_scorer WHERE first_day_on_week='$startWeek'", $this->ERROR_QUERY);
		if($this->return_rows() != 1) {
			$this->query("INSERT INTO topweek_scorer VALUES(NULL,'$id','$startWeek','$points')", $this->ERROR_QUERY);
		}
	}	
	
	protected function GetUserLoginSevenDaysRow() {
		$this->result = null;
		$sql =  "SELECT uid, COUNT(uid) as totalweekrow FROM user_log ";
		$sql .= "WHERE DATE_FORMAT(datetime_login,'%Y-%m-%d') >= adddate(CURDATE(), INTERVAL 2-DAYOFWEEK(CURDATE()) DAY) ";
		$sql .= "AND DATE_FORMAT(datetime_login,'%Y-%m-%d') <= adddate(CURDATE(), INTERVAL 8-DAYOFWEEK(CURDATE()) DAY) ";
		$sql .= "GROUP BY uid";
		$this->query($sql, $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				if($obj->totalweekrow == 7) {		
					$this->SaveBonusPointsLogInSevenDays($obj->uid);
				}
			}
		}
	}
	
	protected function SaveBonusPointsLogInSevenDays($uid) {
		$this->result = null;
		$username = $this->GetUserNameById($uid);
		$description = "7-days-row";
		$content = "<span class=\"listRed\">{username}</span> 连续登陆7天 获得 30 K币。";		
		$pts = intval(30);
		$this->query("INSERT INTO bonus_points VALUES(NULL,'$uid','$pts','description',NOW())", $this->ERROR_INSERT);
		$this->query("INSERT INTO user_activity VALUES(NULL,'$uid','$content','$description',NOW())", $this->ERROR_INSERT);
	}
	
	protected function endSession() {
		unset($_SESSION);
		session_destroy();
		$this->redirect_to(SERVER_URL);
	}
	
}

$user = new User();



?>
