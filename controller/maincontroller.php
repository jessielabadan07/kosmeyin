<?php
require_once("lib/captcha/settings.php");
require_once("model/mainmodel.php");

# This is our MainController class

class MainController extends MainModel {

	# Class protected fields
	protected $page_title;
	protected $successMessage;
	protected $widgets_array = array();
	protected $category;
	protected $pagCategory;
	
	# the error code from reCAPTCHA, if any
	public $error = null;
			
	# This is our constructor class, load some url 
	public function __construct() {		
		if(isset($_GET['login'])) {
			$this->LoginPage();
		} elseif(isset($_GET['validatelogin'])) {
			$this->ValidateLogin();
		} elseif(isset($_GET['register'])) {
			$this->RegisterPage();
		} elseif(isset($_GET['registeruser'])) {
			$this->ModelRegisterUser();
		} elseif(isset($_GET['verify'])) {
			$this->ModelVerify($_GET['verify']);
		} elseif(isset($_GET['logout'])) {			
			$this->Logout();
		} elseif(isset($_GET['forgotpassword'])) {
			$this->ForgotPassword();
		} elseif(isset($_GET['requestnewpassword'])) {
			$this->SearchUser();
		} elseif(isset($_GET['postnewpassword'])) {
			$this->NewPassword();
		} elseif(isset($_GET['newpasswordset'])) {
			$this->NewPasswordSetSuccessfully();
		} elseif(isset($_GET['requestsend'])) {
			$this->RequestPassSuccess();
		} elseif(isset($_GET['invite-a-friend'])) {
			$this->InviteFriend();
		} elseif(isset($_GET['submitfriendrequest'])) {
			$this->SubmitFriendRequest();
		} elseif(isset($_GET['requestsendsuccess'])) {
			$this->RequestSendSuccess();
		} elseif(isset($_GET['user-validate-code'])) {
			$this->UserValidateCode();
		} elseif(isset($_GET['editprofile'])) {
		 	$this->EditProfile();
		} elseif(isset($_GET['updateprofile'])) {
			$this->ModelUpdateProfile();
		} elseif(isset($_GET['editphoto'])) {
			$this->EditPhoto();
		} elseif(isset($_GET['crop_image'])) {
			$this->CropPhoto();
		} elseif(isset($_GET['savephoto'])) {
			UploadPhoto(intval($_SESSION['id']));
			$this->redirect_to(SERVER_URL.'?editprofile');
		} elseif(isset($_GET['success'])) {
			$this->Success();
		} elseif(isset($_GET['verificationsuccess'])) {
			$this->VerificationSuccess();
		} elseif(isset($_GET['verifyrequest'])) {
			$this->ControllerVerifyForgotPass($_GET['verifyrequest']);						
		} elseif(isset($_GET['article'])) {
			$this->Article();
		} elseif(isset($_GET['how-it-works'])) {
			$this->HowItWorks();
		} elseif(isset($_GET['pages'])) {			
			if(intval($_GET['view_id'])) {
				$this->ViewPages($_GET['view_id']);
			}
		} elseif(isset($_GET[@$_SESSION['uname']])) {
			$this->Profile();
		} else {
			$url = trim(strtolower($_SERVER['REQUEST_URI']));			
			$pos = strpos($url,"?");			
			if($pos > 0) {
				$this->query("SET character_set_client=utf8", "");
				$this->query("SET character_set_connection=utf8", "");
				$url = substr($url,(strpos($url,"?")),strlen($url));						
				$url = substr($url,(strpos($url,"/")+1),strlen($url));					
				if($this->GetMenuByURL($url)) {				
					$this->GetPageByMenu();
				} 
				else if($this->GetPageByURL($url) > 0) {
					$this->StaticPages();
				}
			} else {
				$this->index();				
			}
		}
	}
	
	protected function header() { include("view/template/header.php"); }
	protected function popupRegister() { if(!isset($_SESSION['id'])) { include("view/template/popreg.php"); } } 
	protected function topContent() { include("view/template/topcontent.php"); }
	protected function banner() { include("view/template/banner.php"); }
	protected function profileTPL() { include("view/profile.php"); }
	protected function editprofileTPL() { include("view/editprofile.php"); }
	protected function editphotoTPL() { include("view/editphoto.php"); }
	protected function cropphotoTPL() { include("view/cropimage.php"); }
	protected function currentActivity() { include("view/template/activity.php"); } 
	protected function latestArticle() { include("view/template/article.php"); } 
	protected function featuredBrand() { include("view/template/featuredbrand.php"); } 
	protected function gameCenter() { include("view/template/gamecenter.php"); } 
	protected function inviteShare() { include("view/template/inviteshare.php"); } 
	protected function loginTPL() { include("view/login.php"); } 
	protected function registerTPL() { include("view/register.php"); } 	
	protected function friendregisterTPL() { include("view/friendregister.php"); }
	protected function inviteFriendTPL() { include("view/invitefriend.php"); } 	
	protected function successPageTPL() { include("view/template/success.php"); } 
	protected function forgotPassTPL() { include("view/forgotpassword.php"); } 	
	protected function NewPasswordTPL($email) { include("view/newpassword.php"); } 	
	protected function TPLArticle() { include("view/articlepage.php"); }
	protected function viewCategoryTPL() { include("view/viewcategory.php"); }
	protected function howitworksTPL() { include("view/howitworks.php"); }
	protected function viewTagTPL() { include("view/viewtag.php"); }
	protected function categoryTPL() { include("view/category.php"); }
	protected function Pages() { include("view/pages.php"); }
	protected function SubPages() { include("view/subpages.php"); }
	protected function ReadPage() { include("view/template/readpage.php"); }
	protected function StaticPageTPL() { include("view/template/staticpage.php"); }
	protected function TPLErrorPage() { include("view/template/errorpage.php"); }
	protected function footer() { include("view/template/footer.php"); }
	
	private function index() {
		$this->page_title = "Kosmeyin";
		$this->header();
		$this->popupRegister();
		$this->topContent();
		$this->banner();
		$this->currentActivity();
		$this->latestArticle();
		$this->featuredBrand();
		$this->footer();
	}
	
	private function Profile() {
		$this->page_title = "Kosmeyin - ".$_SESSION['uname'];
		$this->header();
		$this->topContent();
		$this->profileTPL();
		$this->footer();
	}
	
	private function EditProfile() {
		$this->page_title = "Kosmeyin - Edit Profile";
		$this->header();
		$this->topContent();
		$this->editprofileTPL();
		$this->footer();
	}
	
	private function EditPhoto() {
		$this->page_title = "Kosmeyin - Edit Photo";
		$this->header();
		$this->topContent();
		$this->editphotoTPL();
		$this->footer();
	}	
	
	private function CropPhoto() {
		$this->page_title = "Kosmeyin - Crop Photo";
		$this->header();
		$this->topContent();
		$this->cropphotoTPL();
		$this->footer();
	}
	
	private function GetPageByMenu() { 
		$this->page_title = "Kosmeyin - ".getParsedURL($_SERVER['REQUEST_URI']);
		$this->header();
		$this->topContent();
		$this->Pages();
		$this->footer();
	}
	
	public function GetPageBySubMenu() {
		$this->page_title = "Kosmeyin - ".getParsedURL($_SERVER['REQUEST_URI']);
		$this->header();
		$this->topContent();
		$this->SubPages();
		$this->footer();
	}
	
	private function ViewPages($id) {
		$this->GetPageById($id);		
		if(count($this->errArr) > 0) 
			$this->page_title = "Kosmeyin - Page Not Found";
		else 
			$this->page_title = "Kosmeyin - ".$this->rst['page_title'];
		$this->header();
		$this->topContent();
		$this->ReadPage();
		$this->footer();
	}
	
	private function StaticPages() {
		$this->page_title = "Kosmeyin - ".getParsedURL($_SERVER['REQUEST_URI']);
		$this->header();
		$this->topContent();
		$this->StaticPageTPL();
		$this->footer();
	}
	
	private function LoginPage() {
		$this->page_title = "Kosmeyin - Login";
		$this->header();
		$this->topContent();
		$this->loginTPL();
		$this->latestArticle();
		$this->inviteShare();
		$this->footer();
	}
	
	private function ValidateLogin() {
		$this->ModelLogin();
	}
	
	private function LogOut() { endSession(); }
	
	private function RegisterPage() {
		$this->page_title = "Kosmeyin - Register";
		$this->header();
		$this->topContent();
		$this->registerTPL();
		$this->currentActivity();		
		$this->inviteShare();
		$this->footer();
	}
	
	private function Article() {		
		$url = trim(strtolower($_SERVER['REQUEST_URI']));
		$pos = strpos($url,"&");
		$url = substr($url,$pos+1,strlen($url));
		$pos = strpos($url,'/');
		$cat_url = substr($url,0,$pos);
		$nurl = substr($url,($pos),strlen($url));					
		if($cat_url==trim(strtolower("category"))) {						
			// this is for category list
			$this->category = substr($nurl,1,strlen($nurl));				
			$explodCategory = explode("/", $this->category);
			$this->category = $explodCategory[0];
			$this->pagCategory = !empty($explodCategory[1]) ? $explodCategory[1] : "page-1";		
			//echo $this->pagCategory[0];
			if($this->ModelFindCategoryAlias($this->category) > 0 && ($this->pagCategory[0]=="p")) {		
				$this->page_title = "Kosmeyin - ".$this->category;				
				$this->header();				
				$this->topContent();	
				$this->result = null;
				$this->ModelFindCategoryAlias($this->category);				
				$this->viewCategoryTPL(); // end here category list	
			} else {																	
				$catType = substr($nurl,1,strrpos($nurl,'/')-1);					
				$id = substr($nurl,(strrpos($nurl,'/')+1),strlen($nurl));					
				$this->page_title = "Kosmeyin - ".$catType;
				$this->header();
				$this->topContent();	
				$this->ReadArticleByUserId($id);			
				$this->ModelGetArticleById($id,$catType);		
				if($this->return_rows()>0) {
					$this->TPLArticle();
				} else {
					$this->ErrorPage();
				}
			}			
		} if($cat_url==trim(strtolower("tag"))) {
			$catType = substr($nurl,1,strrpos($nurl,'/')+strlen($nurl));				
			$catType = trim(strtolower($catType));			
			$id = substr($nurl,(strrpos($nurl,'/')+1),strlen($nurl));					
			$this->page_title = "Kosmeyin - ".$catType;
			$this->header();
			$this->topContent();				
			$this->ModelGetAllTagsByArg($catType);									
			if($this->return_rows() > 0) {				
				$this->ViewTagTPL();
			} else {
				$this->ErrorPage();
			}
		} else {			
			if(isset($_GET['read']) && $_GET['read'] > 0) {
				$id = intval($_GET['read']);
				$this->page_title = "Kosmeyin - Article #: ".$id;
				$this->header();
				$this->topContent();					
				$this->ReadArticleByUserId($id);	
				$this->ModelReadArticleById($id);
				if($this->return_rows()==1) {
					$this->TPLArticle();
				} else {
					$this->ErrorPage();
				}
			}
		}
		$this->footer();
	}
	
	protected function HowItWorks() {
		$this->page_title = "Kosmeyin - How It Works";
		$this->header();
		$this->topContent();
		$this->howitworksTPL();
		//$this->inviteShare();
		$this->footer();
	}
	
	protected function Category() {
		$this->categoryTPL();
	}
	
	private function InviteFriend() {
		$this->page_title = "Kosmeyin - Invite Friend";
		$this->header();
		$this->topContent();
		$this->inviteFriendTPL();
		$this->inviteShare();
		$this->footer();
	}
	
	private function UserValidateCode() {			
		if(strlen($this->ModelUserValidateCode()) > 0) {
			$this->page_title = "Kosmeyin - Complete your register form";
			$this->header();
			$this->topContent();
			$this->friendregisterTPL();
			$this->currentActivity();		
			$this->footer();
		} else { $this->redirect_to(SERVER_URL); }		
	}
	
	private function ErrorPage() {
		$this->TPLErrorPage();
	}
	
		
	private function ForgotPassword() {
		$this->page_title = "Kosmeyin - Verification Code Success";
		$this->header();
		$this->topContent();
		$this->forgotPassTPL();
		$this->inviteShare();
		$this->footer();
	}
	
	
	private function Success() {
		$this->page_title = "Kosmeyin - Success";
		$this->header();
		$this->topContent();
		$this->successMessage = "Thank You! Your registration has been successful, Please verify it by clicking the activation link that has been send to your email.";
		$this->successPageTPL();
		$this->footer();
	}
	
	private function RequestPassSuccess() {
		$this->page_title = "Kosmeyin - Send Password Request";
		$this->header();
		$this->topContent();
		$this->successMessage = "Thank You! password request has been successful, Please verify into your email.";
		$this->successPageTPL();		
		$this->footer();
	}
	
	private function ControllerVerifyForgotPass($code) {	
		$this->page_title = "Kosmeyin - Verification Code Success".$this->rst['email'];
		$this->header();
		$this->topContent();
		$email = $this->VerifyForgotPass($code);				
		$this->NewPasswordTPL($email);
		$this->currentActivity();	
		$this->footer();
	}

	private function VerificationSuccess() {
		$this->page_title = "Kosmeyin - Verification Code Success";
		$this->header();
		$this->topContent();
		$this->successMessage = "Thank You! Code verified. You may now login";
		$this->successPageTPL();
		$this->footer();
	}
	
	private function NewPasswordSetSuccessfully() {
		$this->page_title = "Kosmeyin - New password";
		$this->header();
		$this->topContent();
		$this->successMessage = "Thank You! You may now login";
		$this->successPageTPL();
		$this->footer();
	}
	
	private function RequestSendSuccess() {
		$this->page_title = "Kosmeyin - Verification Code Success";
		$this->header();
		$this->topContent();
		$this->successMessage = "Thank You! You request has been sent to your friend successfully.";
		$this->successPageTPL();
		$this->footer();
	}
		
	protected function GetWidget() {
		$this->ModelWidget();
	}
	
	private function checkSession() {
		if(!isset($_SESSION['id']))
			return true;
		return false;
	}
	
}

# initialize object for controller
$controller = new MainController();


?>