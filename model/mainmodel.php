<?php
require_once('model/user.php');

class MainModel extends user {
	
	protected $errArr = array();
	
	private $pageId;
	protected $countLike;
	
	public function __construct() {
		parent::__construct();	# call parent constructor	
	}	
	
	public function GetTopMenu() { $this->result = null; return $this->query("SELECT * FROM site_menu WHERE menu_type='top_menu' AND menu_status=1 ORDER BY id ASC", $this->ERROR_QUERY); }
	public function GetBottomMenu() { 
		return $this->query("SELECT * FROM site_menu WHERE menu_type='bottom_menu' ORDER BY id ASC", $this->ERROR_QUERY); 
	}	
	public function GetBottomMenuInSession() { 
		return $this->query("SELECT * FROM site_menu WHERE menu_type='bottom_menu' AND menu_link!='rgister' AND menu_link!='login' ORDER BY id ASC", $this->ERROR_QUERY); 
	}	
	public function GetMenuByURL($menu) { 		
		$menu = strtoupper($menu);			
		$this->query("SELECT UPPER(menu_link) as menu_link FROM site_menu", $this->ERROR_QUERY); 		
		foreach($this->result_to_object() as $obj) {									
			if($menu === urlencode($obj->menu_link)) {
				return true;
			}
		}
		return false;
	}
		

	protected function GetSubMenuByURL($menu) {
		$menu = strtoupper($menu);			
		$counter = 0;
		$this->query("SELECT UPPER(submenu_link) as submenu_link FROM site_submenu", $this->ERROR_QUERY); 		
		foreach($this->result_to_object() as $obj) {									
			if($menu === urlencode($obj->submenu_link)) {
				//return true;
				$counter++;
			} 
		}
		if($counter==1) 
			return true;		
		return false;
	}
	
	public function GetIdByMenuName($menu) { 		
		$this->query("SELECT id, UPPER(menu_link) as menu_link FROM site_menu", $this->ERROR_QUERY);				
		foreach($this->result_to_object() as $obj) {
			if($menu == urlencode($obj->menu_link)) {
				return $obj->id;
			}
		}
		return false;
	}
	
	public function GetIdBySubMenuName($menu) { 		
		$this->query("SELECT submenu_id, UPPER(submenu_link) as submenu_link FROM site_submenu", $this->ERROR_QUERY); 		
		foreach($this->result_to_object() as $obj) {									
			if($menu === urlencode($obj->submenu_link)) {
				return $obj->submenu_id;
			}
		}
		return false;
	}
	
	protected function GetCategoryBySubURL($url) {
		$url = strtoupper(trim($url));		
		$url = urlencode($url);
		$this->query("SELECT cat_id, UPPER(cat_title) as title FROM category", $this->ERROR_QUERY);
		foreach($this->result_to_object() as $obj) {	
			$subURL = str_replace(" ","", trim($obj->title));			
			if($url === urlencode($subURL)) {				
				return $obj->cat_id;				
			}
		}
		return false;
	}
	
	protected function GetPageByURL($url) {
		$this->result = null;
		$url = strtoupper(trim($url));
		$url = urlencode($url);
		$id = 0;
		$this->query("SELECT page_id, UPPER(page_link) as page_link FROM pages", $this->ERROR_QUERY);
		foreach($this->result_to_object() as $obj) {
			$pos = strripos($obj->page_link, '/');
			$link = substr($obj->page_link, $pos+1, strlen($obj->page_link));			
			if($url == urlencode($link)) 
				$id =  $obj->page_id;				
		}
		if($id > 0) {
			return $id;
		} else {
			$this->GetPageBySubMenu();
		}	
	}
	
	protected function GetContentPageByURL($url) {
		$this->result = null;
		$url = strtoupper(trim($url));
		$url = urlencode($url);
		$this->query("SELECT page_id, page_title, page_content, page_tags, page_status, dateupdate, UPPER(page_link) as page_link FROM pages", $this->ERROR_QUERY);
		foreach($this->result_to_object() as $obj) {
			$pos = strripos($obj->page_link, '/');
			$link = substr($obj->page_link, $pos+1, strlen($obj->page_link));			
			if($url == urlencode($link)) {				
				echo $obj->page_content;
				$this->SetPageId($obj->page_id);
			}
		}
	}
	
	protected function SetPageId($id) {
		$this->pageId = $id;
	}
	
	protected function ReturnPageId() {
		return $this->pageId;
	}
	
	protected function GetAllSubMenuByMenuId($menu_id,$link) { 
		$this->result = null;
		$this->query("SELECT * FROM menu_submenu_link msl RIGHT JOIN site_submenu sm ON msl.submenu_id = sm.submenu_id WHERE msl.sitemenu_id='$menu_id'", $this->ERROR_QUERY); 		
		if($this->return_rows() > 0) {
			echo '<div><ul>';
			foreach($this->result_to_object() as $obj) {
				$subLink = str_replace(" ","-", strtolower(trim($obj->submenu_name)));
				echo '<li><a href="'.$link.'/'.$subLink.'">'.$obj->submenu_name.'</li>';
			}
			echo '</ul></div>';
		}
	}
	
	protected function GetSubMenuCategoryById($id,$link) {
		$this->result = null;		
		$subMenus = array();
		$this->query("SELECT * FROM menu_category mc RIGHT JOIN category c ON mc.category_id=c.cat_id WHERE mc.menu_id='$id' AND category_type='article'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {				
				$menuLink = str_replace(" ","", strtolower(trim($obj->cat_alias)));
				$finalLink = '<li><a href="'.SERVER_URL.'?article&category/'.$menuLink.'">'.$obj->cat_title.'</a></li>';
				array_push($subMenus, $finalLink);
			}
		}
		$this->result = null;
		$this->query("SELECT * FROM menu_category mc RIGHT JOIN pages p ON mc.category_id=p.page_id WHERE mc.menu_id='$id' AND category_type='page'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				$link = '<li><a href="'.$obj->page_link.'">'.$obj->page_title.'</a></li>';
				array_push($subMenus, $link);
			}
		}
		echo '<div><ul>';
		foreach($subMenus as $menu) {
			echo $menu;
		}
		echo '</ul></div>';
			
	}
	
	public function GetMenuContent($id) {
		$this->result = null;
		return $this->query("SELECT * FROM sitemenu_content WHERE sitemenu_id='$id'", $this->ERROR_QUERY); 
	}
	
	public function GetSubMenuContent($id) {
		$this->result = null;
		return $this->query("SELECT * FROM site_submenu WHERE submenu_id='$id'", $this->ERROR_QUERY);
	}
	
	public function ModelLogin() { $this->Login(); } # end function Login
	
	public function ModelRegisterUser() {		
		$email = $this->escape_string(trim(strtolower($_POST['email'])));
		$username = $this->escape_string(trim(strtolower($_POST['username'])));
		$password = $this->escape_string($_POST['password']);
		$password2 = $this->escape_string($_POST['password_confirm']);			
		$gender = $_POST['gender'];
		$year = intval($_POST['year']) ? $_POST['year'] : 0000;
		$month = intval($_POST['month']) ? $_POST['month'] : 00;
		$date = intval($_POST['date']) ? $_POST['date'] : 00;
		$phone = !empty($_POST['phone']) ? $this->escape_string($_POST['phone']) : '';
		$userInputCaptcha = $this->escape_string(strtoupper($_POST['userstring']));
		$captchaString = strtoupper($_SESSION['string']);
		$this->unsetUserErrorData();
		if (empty($username)) {	// validate username				
			$this->errArr[] = "Username Error";				
			$_SESSION['username_error'] = '<label for="username" generated="true" class="error" style>请输入用户名</label>';				
		} if(checkUsername($username)) {			// check email if it is alreay exist.
			endDataSession($_SESSION['username_error']);
			$this->errArr[] = "Username Error";	
			$_SESSION['username_error'] = '<label for="username" generated="true" class="error" style>Username already exist in our database.</label>';				
		} if(strlen($username) < 5 OR strlen($username) > 12) {
			$this->errArr[] = "Username Error";	
			$_SESSION['username_error'] = '<label for="username" generated="true" class="error" style>请输入5到12位半角字母 （字母，数字，符号）不区分大小写</label>';				
		} if (empty($password)) {	// validate registered email
			endDataSession($_SESSION['username_error']);
			$this->errArr[] = "Password Error.";
			$_SESSION['password_error'] = '<label for="password" generated="true" class="error" style>请输入登录密码</label>';		
		} if ($password != $password2) {	// validate registered email
			endDataSession($_SESSION['username_error'],$_SESSION['password_error']);				
			$this->errArr[]= "Password Error.";
			$_SESSION['password_error'] = '<label for="password" generated="true" class="error" style>您输入确认密码和密码不一致</label>';		
		} if(checkEmail($email)) {			// check email if it is alreay exist.
			endDataSession($_SESSION['username_error'],$_SESSION['password_error']);				
			$this->errArr[] = "Email Error";	
			$_SESSION['email_error'] = '<label for="email" generated="true" class="error" style>Email address already exist in our database.</label>';				
		} if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {	// validate registered email
			endDataSession($_SESSION['username_error'],$_SESSION['password_error'],$_SESSION['email_error']);				
			$this->errArr[] = "Email Error.";
			$_SESSION['email_error'] = '<label for="email" generated="true" class="error" style>请填写有效邮箱地址</label>';				
		} if(count($this->errArr) > 0) {														
			endDataSession($_SESSION['username_error'],$_SESSION['password_error'],$_SESSION['email_error']);	
			$this->setUserData($username,$email,$phone,$year,$month,$date);
			if($_POST['regtype']=="viafriendemail") {					
				$this->redirect_to(SERVER_URL.$_POST['encrypturl']);
			} else {												
				$this->redirect_to(SERVER_URL."?register");
			}
		} else {        
			include "lib/captcha/settings.php";
			if($captchaString == $userInputCaptcha) {
				$_SESSION['string'] = null;
				unset($_SESSION['string']);				
				$bdate = $year.'-'.$month.'-'.$date;				
				$this->Register($username,$password,$email,$gender,$bdate,$phone,$_POST['regtype']);												
			} else {
				$this->setUserData($username,$email,$phone,$year,$month,$date);
				if($_POST['regtype']=="viafriendemail") {
					$this->redirect_to(SERVER_URL.''.$_POST['encrypturl']);
				} else {
					$this->redirect_to(SERVER_URL."?register");
				}
				$_SESSION['captcha_error'] = '<label for="captcha" generated="true" class="error" style>请输入正确的号码</label>';
			}
		}
	} # end function
	
	protected function ModelUpdateProfile() {		
		$id = intval($_SESSION['id']);
		$email = $this->escape_string(trim(strtolower($_POST['email'])));
		$username = $this->escape_string(trim(strtolower($_POST['username'])));
		$old_pass = $this->escape_string($_POST['old_password']);
		$password = $this->escape_string($_POST['password']);
		$password2 = $this->escape_string($_POST['password_confirm']);			
		$gender = $_POST['gender'];
		$year = intval($_POST['year']) ? $_POST['year'] : 0000;
		$month = intval($_POST['month']) ? $_POST['month'] : 00;
		$date = intval($_POST['date']) ? $_POST['date'] : 00;
		$phone = $this->escape_string($_POST['phone']);
		$city = !empty($_POST['city']) ? $this->escape_string($_POST['city']) : '';
		$aboutme = !empty($_POST['aboutme']) ? $this->escape_string($_POST['aboutme']) : '';
		$this->unsetUserErrorData();
		if (empty($username)) {	// validate registered email				
			$this->errArr[] = "Username Error";				
			$_SESSION['username_error'] = '<label for="username" generated="true" class="error" style>请输入用户名</label>';				
		} if(checkUsernameByUserId($id,$username)) {			// check email if it is alreay exist.
			endDataSession($_SESSION['username_error']);
			$this->errArr[] = "Username Error";	
			$_SESSION['username_error'] = '<label for="username" generated="true" class="error" style>Username already exist in our database.</label>';				
		} if(strlen($username) < 5 OR strlen($username) > 12) {
			$this->errArr[] = "Username Error";	
			$_SESSION['username_error'] = '<label for="username" generated="true" class="error" style>请输入5到12位半角字母 （字母，数字，符号）不区分大小写</label>';				
		} if (empty($password)) {	// validate registered email
			endDataSession($_SESSION['username_error']);
			$this->errArr[] = "Password Error.";
			$_SESSION['password_error'] = '<label for="password" generated="true" class="error" style>请输入登录密码</label>';		
		} if ($password != $password2) {	// validate registered email
			endDataSession($_SESSION['username_error'],$_SESSION['password_error']);				
			$this->errArr[]= "Password Error.";
			$_SESSION['password_error'] = '<label for="password" generated="true" class="error" style>您输入确认密码和密码不一致</label>';		
		} if(checkEmailByUserId($id,$email)) {			// check email if it is alreay exist.
			endDataSession($_SESSION['username_error'],$_SESSION['password_error']);				
			$this->errArr[] = "Email Error";	
			$_SESSION['email_error'] = '<label for="email" generated="true" class="error" style>Email address already exist in our database.</label>';				
		} if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {	// validate registered email
			endDataSession($_SESSION['username_error'],$_SESSION['password_error'],$_SESSION['email_error']);				
			$this->errArr[] = "Email Error.";
			$_SESSION['email_error'] = '<label for="email" generated="true" class="error" style>请填写有效邮箱地址</label>';				
		}
		if(count($this->errArr) > 0) {		# if not empty error, then
			$this->setUserData($username,$email,$phone,$year,$month,$date);
			$this->redirect_to(SERVER_URL."?editprofile#tabs-2");
		} else {				
			endDataSession($_SESSION['email_data'],$_SESSION['username_data'],$_SESSION['year_data'],$_SESSION['month_data'],$_SESSION['date_data'],$_SESSION['phone_data']);	
			$uname = $this->escape_string($_POST['username']);
			$old_pass = $this->escape_string($_POST['old_password']);
			$new_pass = $this->escape_string($_POST['password']);
			$con_pass = $this->escape_string($_POST['password_confirm']);
			$email = $this->escape_string($_POST['email']);			
			$gender = $_POST['gender'];			
			$bdate = $year.'-'.$month.'-'.$date;
			$phone = $this->escape_string($_POST['phone']);		
			$new_pass = sha1($new_pass);
			$this->query("UPDATE user_login SET username='$uname', email='$email', password='$new_pass' WHERE id='$id'", $this->ERROR_UPDATE);
			$this->query("UPDATE user_info SET aboutme='$aboutme', gender='$gender', bdate='$bdate', city='$city', phone='$phone' WHERE id='$id'", $this->ERROR_UPDATE);			
			$_SESSION['uname'] = $uname;
			$this->redirect_to(SERVER_URL."?".$_SESSION['uname']);	
		}
	}
	
	protected function unsetUserErrorData() {
		$strData = array('username_error','password_error','email_error','year_error','month_error','date_error','captcha_error');
		foreach($strData as $data) {
			$_SESSION[$data] = null;
			unset($_SESSION[$data]);
		}
	}
	
	protected function unsetUserEntryData() {
		$strData = array('username_data','email_data','phone_data','year_data','month_data','date_data');
		foreach($strData as $data) {
			$_SESSION[$data] = null;
			unset($_SESSION[$data]);
		}
	}
	
	private function setUserData() {
		$strData = array('username_data','email_data','phone_data','year_data','month_data','date_data');
		$numargs = func_num_args();
		$arg_list = func_get_args();
		for ($i = 0; $i < $numargs; $i++) {        
			$_SESSION[$strData[$i]] = $arg_list[$i];
		}
	}
	
	protected function SearchUser() {
		if(empty($_POST['username']) AND empty($_POST['email'])) {
			$this->redirect_to(SERVER_URL."?forgotpassword&error=true");
		} else {			
			$this->query("SELECT email,username,password,status_code FROM user_login WHERE username='".$this->escape_string($_POST['username'])."'", $this->ERROR_QUERY);						
			if($this->return_rows() == 1) {				
				$this->result_to_array();
				sendRequestPasswordCode('forgot-password',$this->rst['email'],$this->rst['password']);
				$this->redirect_to(SERVER_URL."?requestsend");
			} else {
				$this->result = null;
				$this->query("SELECT email,password,status_code FROM user_login WHERE email='".$this->escape_string($_POST['email'])."'", $this->ERROR_QUERY);
				if($this->return_rows() == 1) {
					$this->result_to_array();				
					sendRequestPasswordCode('forgot-password',$this->rst['email'],$this->rst['password']);				
					$this->redirect_to(SERVER_URL."?requestsend");
				} else {
					$this->redirect_to(SERVER_URL."?forgotpassword&error=true");
				}
			}			
		}
	}	
	
	protected function ModelWidget() {
		$this->query("SELECT * FROM widgets", $this->ERROR_QUERY);
		foreach($this->result_to_object() as $obj) {
			$this->widgets_array[] = $obj->id; 
		}
	}
	
	protected function ModelWidgetByMenuId($id) {
		$sql =  "SELECT * FROM site_menu sm RIGHT JOIN sitemenu_widget smw ON sm.id = smw.sitemenu_id ";
		$sql .= "LEFT JOIN widgets w ON smw.widget_id = w.id WHERE sm.id='$id'";									
		$this->query($sql, $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				array_push($this->widgets_array, $obj->widget_id );
			}
		} 
	}
	
	protected function ModelWidgetByPageId($id) {
		$this->query("SELECT * FROM widgets w RIGHT JOIN page_widget pw ON w.id = pw.widget_id WHERE pw.page_id='$id'", $this->ERROR_QUERY);		
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				array_push($this->widgets_array, $obj->widget_id );
			}
		} 
	}
	
	protected function ModelWidgetBySubMenuId($id) {
		$sql =  "SELECT * FROM site_submenu sm RIGHT JOIN submenu_widget smw ON sm.submenu_id = smw.submenu_id ";
		$sql .= "LEFT JOIN widgets w ON smw.widget_id = w.id WHERE sm.submenu_id='$id'";									
		$this->query($sql, $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				array_push($this->widgets_array, $obj->widget_id );
			}
		} 
	}
	
	protected function GetPageById($id) {
		$this->query("SELECT * FROM pages WHERE page_id='$id'", $this->ERROR_QUERY);
		if($this->return_rows() == 1) {
			$this->result_to_array();
		} else {
			$this->errArr[] = "Page not found";
		}		
	}
	
	protected function ModelGetArticleById($id,$cat) {		
		$cat_id = $this->GetCategoryByValue($cat);
		if($cat_id > 0) {
			$this->query("SELECT * FROM article a RIGHT JOIN article_category ac ON a.article_id=ac.article_id WHERE a.article_id='$id' AND ac.cat_id='$cat_id'", $this->ERROR_QUERY);						
			$this->result_to_array();
		}
	}
	
	protected function ModelReadArticleById($id) {
		$this->query("SELECT * FROM article WHERE article_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}

	
	protected function GetCategoryByValue($value) {
		$value = trim(strtolower($value));
		$this->query("SELECT * FROM category WHERE cat_alias='$value'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['cat_id'];
	}
	
	protected function ModelGetArticleCategoryByIdValue() {
	}
	
	protected function ModelGetArticleCategoryById($id) {
		$this->result = null;
		$strMsg = "";
		$this->query("SELECT * FROM article_category ac RIGHT JOIN category c ON ac.cat_id=c.cat_id WHERE ac.article_id='$id' ORDER BY ac.id ASC", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				$strMsg = "?article&category/".$obj->cat_alias."/".$id;
			}
			return $strMsg;
		} else {
			return "?article&read=".$id;
		}
		$strMsg = null;
	}
	
	protected function ModelTypeArticleCategory($title,$id) {
		$this->result = null;
		$strMsg = "";
		$this->query("SELECT * FROM article_category ac RIGHT JOIN category c ON ac.cat_id=c.cat_id WHERE ac.article_id='$id' ORDER BY ac.id ASC", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				$strMsg .= '<a href="?article&category/'.$obj->cat_alias.'" style="color:#888;">'.$obj->cat_title.'</a>, ';				
			}
			return $strMsg;
		} else {
			return '<a href="?article&read='.$id.'" style="color:#CCC;">'.$title.'</a>';
		}
		$strMsg = null;
	}
	
	protected function ModelTitleArticleCategory($id) {
		$this->result = null;
		$strMsg = "";
		$this->query("SELECT * FROM article_category ac RIGHT JOIN category c ON ac.cat_id=c.cat_id WHERE ac.article_id='$id' ORDER BY ac.id ASC", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				//$strMsg = '<a href="?article&category/'.$obj->cat_alias.'/'.$id.'" style="color:#888;">'.$article_title.'</a>';				
				$strMsg = "?article&category/{$obj->cat_alias}/{$id}";
			}
			return $strMsg;
		} else {
			return "?article&read=".$id;
		}
		$strMsg = null;
	}
	
	protected function GetCategoryTitle($id) {
		$this->query("SELECT cat_id, cat_title FROM category WHERE cat_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['cat_title'];
	}
	
	protected function ModelGetTagsByArticleId($id) {
		$this->result = null;
		$strMsg = "";
		$this->query("SELECT * FROM tag_article ta RIGHT JOIN tags t ON ta.tag_id=t.tag_id WHERE ta.article_id='$id'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				$strMsg .= '<a href="'.SERVER_URL.'?article&tag/'.trim(strtolower($obj->tags)).'">'.$obj->tags.'</a>,';
			}
			return $strMsg;
		}
	}
	
	protected function ModelGetArticleCommentById($id) {
		$this->result = null;
		$this->query("SELECT * FROM article_comment WHERE article_id='$id' ORDER BY id DESC", $this->ERROR_QUERY);
	}
	
	protected function ModelGetAllArticles() {
		$this->result = null;		
		$this->query("SELECT * FROM article", $this->ERROR_QUERY);
	}
			
	protected function ModelGetCategoryById($id) {
		$this->query("SELECT * FROM category c RIGHT JOIN article_category ac ON c.cat_id=ac.cat_id WHERE ac.article_id = '$id'", $this->ERROR_QUERY);
	}
	
	protected function ModelGetAllArticleByCategory($id) {
		$this->result = null;	
		$this->query("SELECT * FROM article_category ac RIGHT JOIN article a ON ac.article_id=a.article_id WHERE ac.cat_id='$id' ORDER BY ac.id DESC", $this->ERROR_QUERY);
	}
	
	
	protected function ModelGetAllArticleByCategoryWithPagination($id,$offset=0,$limit=0) {
		$this->result = null;	
		$this->query("SELECT * FROM article_category ac RIGHT JOIN article a ON ac.article_id=a.article_id WHERE ac.cat_id='$id' ORDER BY ac.id DESC LIMIT ".$offset.",".$limit."", $this->ERROR_QUERY);
	}
	
	protected function ModelFindCategoryAlias($alias=null) {
		$alias = trim(strtolower($alias));
		$this->query("SELECT * FROM category WHERE cat_alias='$alias'", $this->ERROR_QUERY);		
		return $this->return_rows();
	}
	
	protected function ModelGetTagsById($id) {
		$this->query("SELECT * FROM tags WHERE article_id='$id'", $this->ERROR_QUERY);
	}	
	
	protected function ModelGetAllTagsByArg($str=null) {
		$str = trim(strtolower($str));
		$this->query("SELECT * FROM tags t RIGHT JOIN tag_article ta ON t.tag_id = ta.tag_id WHERE t.tags='$str'", $this->ERROR_QUERY);		
		//echo $this->return_rows();
	}
	
	protected function ModelTagArticleByTagID($tag_id) {
		$this->result = null;
		$this->query("SELECT * FROM tag_article ta RIGHT JOIN article a ON ta.article_id=a.article_id WHERE ta.tag_id='$tag_id'", $this->ERROR_QUERY);
	}
	
	protected function ResultTagByArg($str=null) {
		$this->result = null;
		$this->query("SELECT * FROM tags", $this->ERROR_QUERY);
	}
	
	protected function GetImageGallery() {
		$this->result = null;
		$this->query("SELECT * FROM image_gallery WHERE status=1 ORDER BY id", $this->ERROR_QUERY);		
	}
	
	protected function GetUserLike($uid,$aid) {
		$this->result = null;
		$this->query("SELECT * FROM article_likes WHERE article_id='$aid' AND user_id='$uid'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function GetUserDisLike($uid,$aid) {
		$this->result = null;
		$this->query("SELECT * FROM article_dislike WHERE article_id='$aid' AND user_id='$uid'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	/*protected function GetPeopleLikesArticleById($aid) {
		$this->result = null;
		$list = "";
		$counter = 1;
		$this->query("SELECT * FROM article_likes al RIGHT JOIN user_login ul ON al.user_id=ul.id WHERE al.article_id='$aid'", $this->ERROR_QUERY);
		$rows = $this->return_rows();		
		if($rows > 0) {
			foreach($this->result_to_object() as $obj) {
				$list .= $obj->username;
				$list .= ($rows != $counter) ? ',&nbsp;' : '.';				
				$counter++;				
			}
		}
		$list .= '<br/>';
		$this->SetCount(intval($counter-1));
		return $list;		
	}
	
	protected function GetPeopleDisLikesArticleById($aid) {
		$this->result = null;
		$list = "";
		$counter = 1;
		$this->query("SELECT * FROM article_dislike ad RIGHT JOIN user_login ul ON ad.user_id=ul.id WHERE ad.article_id='$aid'", $this->ERROR_QUERY);
		$rows = $this->return_rows();		
		if($rows > 0) {
			foreach($this->result_to_object() as $obj) {
				$list .= $obj->username;
				$list .= ($rows != $counter) ? ',&nbsp;' : '.';				
				$counter++;				
			}
		}
		$list .= '<br/>';
		$this->SetCount(intval($counter-1));
		return $list;
	}*/
	
	private function SetCount($count) {
		$this->countLike = $count;
	}
				
}

$model = new MainModel();

?>