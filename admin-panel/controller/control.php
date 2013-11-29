<?php
# include database
require_once("model/model.php");

class Control extends Model {
	
	public $title_caption;
	public $errors = array();
	
	public function __construct() {
		if(!$this->CheckSession()) {			
			if(isset($_GET['submit'])) {
				$this->Login();
			} else {
				$this->LogInPage("Kosmeyin - LogIn");				
			}
		} else {
			if(intval($_SESSION['level']) > 1) {
				if(isset($_GET['logout'])) {
					$this->LogOut();
				} else if(isset($_GET['menus']) || isset($_GET['contentmenu_id'])) {
					$this->Menus();
				} elseif(isset($_GET['saveparentmenuitem'])) {
					$this->SaveParentMenu();
				} else if(isset($_GET['savemenuitem'])) {
					$this->SaveMenuItem();
				} else if(isset($_GET['slideshow'])) {
					$this->SlideShow();
				} else if(isset($_GET['pages'])) {
					if(isset($_GET['savepage'])) {
						$this->SaveNewPage();
					} elseif(isset($_GET['updatepage'])) {
						$this->UpdatePage();
					} elseif(isset($_GET['confirmdeletepageid'])) {
						$this->DeletePageById($_GET['confirmdeletepageid']);
					} else {
						$this->Pages();
					}
				} else if(isset($_GET['editors-top-picks'])) {
					$this->EditorsPick();
				} else if(isset($_GET['widget'])) {
					$this->Widgets();
				} else if(isset($_GET['products'])) {
					$this->Products();
				} else if(isset($_GET['article'])) {
					if(isset($_GET['view_id']) && !empty($_GET['view_id'])) { $this->ReadArticle(); }
					elseif(isset($_GET['update_id']) && !empty($_GET['update_id'])) { $this->UpdateArticle($_GET['update_id']); }
					elseif(isset($_GET['delete_id']) && !empty($_GET['delete_id'])) { $this->DeleteArticle(); }				
					elseif(isset($_GET['confirmdeleteid']) && !empty($_GET['confirmdeleteid'])) { $this->ConfirmDeleteArticle(); }
					elseif(isset($_GET['add'])) { $this->AddArticle(); }
					elseif(isset($_GET['add_article'])) { $this->SubmitAddedArticle(); }	
					elseif(isset($_GET['add_category']) || isset($_GET['viewcategory'])) { $this->AddNewCategory(); }
					elseif(isset($_GET['add_tag']) || isset($_GET['viewtag']) || isset($_GET['update_tag'])) { $this->TagPage(); }
					elseif(isset($_GET['save_tag'])) { $this->SaveNewTag(); }
					elseif(isset($_GET['update_category'])) { $this->UpdateCategory(); }
					elseif(isset($_GET['save_category'])) { $this->SaveNewCategory(); }					
					else { $this->Articles(); }
				} else if(isset($_GET['survey'])) { require_once('survey.php'); 
				} else if(isset($_GET['users'])) { require_once('user_control.php');
				} elseif(isset($_GET['givepoints'])) { $this->SaveGiftPoints();
				} elseif(isset($_GET['confirm_userdelete_by_id'])) { $this->DeleteUserInfo($_GET['confirm_userdelete_by_id']);
				} else { $this->Main(); }
			} else { $this->EndSession(); $this->redirect_to(USER_DIR);}
		}
	}
	
	protected function GetHeader() { include("views/template/header.php"); }
	
	protected function GetFooter() { include("views/template/footer.php"); }
		
	private function Main() {
		$this->title_caption = "Kosmeyin - Main";
		$this->GetHeader($this->title_caption); 
		include('views/home.php');
		$this->GetFooter(); 
	}	
	
	private function Menus() {
		$this->title_caption = "Kosmeyin - Menus";
		$this->GetHeader($this->title_caption); 
		include('views/menu.php');
		$this->GetFooter();
	}
	
	private function SlideShow() {
		$this->title_caption = "Kosmeyin - Slideshow";
		$this->GetHeader($this->title_caption); 
		$this->GetAllSlideShowImage();
		include('views/slideshow.php');
		$this->GetFooter();
	}
	
	private function Pages() {
		$this->title_caption = "Kosmeyin - Pages";
		$this->GetHeader($this->title_caption); 
		include('views/pages.php');
		$this->GetFooter();
	}
	
	private function TagPage() {
		$this->title_caption = "Kosmeyin - Tag";
		$this->GetHeader($this->title_caption); 
		include('views/tagpage.php');
		$this->GetFooter();
	}
	
	private function EditorsPick() {
		$this->title_caption = "Kosmeyin - Editor's Pick";
		$this->GetHeader($this->title_caption); 
		include('views/toppicks.php');
		$this->GetFooter();
	}
	
	private function Widgets() {
		$this->title_caption = "Kosmeyin - Widgets";
		$this->GetHeader($this->title_caption); 
		include('views/widget.php');
		$this->GetFooter();
	}
		
	private function LoginPage($title) { 
		$this->title_caption = $title;
		$this->GetHeader($this->title_caption); 
		include("views/login.php"); 
		$this->GetFooter(); 
	}
	
	private function Login() { 		
		if($this->LoginUser($_POST['email'], $_POST['pass'])) {			
			$this->SetSession(1,$_POST['email'],2);
			$this->redirect_to(SERVER_URL);
		} else {			
			$this->redirect_to(SERVER_URL."?invalid_login=true");
		}
	}
	
	private function Products() {
		$this->title_caption = "Kosmeyin - Products";
		$this->GetHeader($this->title_caption); 
		include("views/product.php"); 
		$this->GetFooter(); 
	}
	
### ALL ABOUT ARTICLE THIS AREA  ###
###
	private function Articles() {
		$this->title_caption = "Kosmeyin - Articles";
		$this->GetHeader($this->title_caption); 
		include("views/article.php"); 
		$this->GetFooter(); 
	}
	
	private function AddArticle() {
		$this->title_caption = "Kosmeyin - Add New Article";
		$this->GetHeader($this->title_caption); 
		include("views/addarticle.php"); 
		$this->GetFooter(); 
	}
	
	# call model to save new article created
	private function SubmitAddedArticle() {
		$this->AddNewArticle();		
	}
	
	# call model to update the article
	private function UpdateArticle($id) {
		# call model update article
		$this->SaveUpdateArticle($id);
	}
	
	
	private function ReadArticle() {
		$this->title_caption = "Kosmeyin - Read Article " .intval($_GET['view_id']);
		$this->GetHeader($this->title_caption); 
		include("views/viewarticle.php"); 
		$this->GetFooter(); 
	}
	
	public function ReadAllArticles($start,$offset) {
		$this->GetAllArticles($start,$offset);
		$i = 0;
		foreach($this->articles as $article) {		
			$id = intval($article['article_id']);
			if(isset($_COOKIE['articleupdate_id'])) {
				if(intval($_COOKIE['articleupdate_id']) == $id)
					echo '<tr style="background-color:lemonchiffon;" id="tr'.$id.'">';
				else
					echo ($i%2==0) ? '<tr style="background-color:#f1f1f1;" id="tr'.$id.'">' : '<tr style="background-color:#ddd;" id="tr'.$id.'">';			
			} else {
				echo ($i%2==0) ? '<tr style="background-color:#f1f1f1;" id="tr'.$id.'">' : '<tr style="background-color:#ddd;" id="tr'.$id.'">';
			}
			if(strlen($article['title']) > 40) {
				$name = substr($article['title'],0,45);
				echo '<td style="text-align:justify; padding:15px; width:450px;"><input type="checkbox" id="'.$id.'" name="deletetype" />&nbsp;<a href="'.SERVER_URL.'?article&view_id='.$id.'">'.$this->escape_string($name).'...</a></td>';
			} else {
				echo '<td style="text-align:justify; padding:15px; width:450px;"><input type="checkbox" id="'.$id.'" name="deletetype" />&nbsp;<a href="'.SERVER_URL.'?article&view_id='.$id.'">'.$this->escape_string($article['title']).'</a></td>';
			}
			echo '<td style="text-align:justify; padding:15px; width:125px;">'.$this->GetAllCategoryByArticleId($id).'</td>';
			echo '<td style="text-align:justify; padding:15px; width:125px;">'.$this->getTagJoinArticleById($id).'</td>';
			$dFormat = strtotime($article['datepublish']);
			$status = ($article['status'] == 1) ? '<span style="color:green">published</span>' : '<span style="color:#f00;">unpublish</span>';
			echo '<td style="text-align:justify; width:60px;">'.date('Y-m-d',$dFormat).'<br/>'.$status.'</td>';				
			echo '</tr>';
			$i++;
		}
	}
		
	
	private function DeleteArticle() {
		$this->title_caption = "Kosmeyin - Delete Article " .intval($_GET['delete_id']);
		$this->GetHeader($this->title_caption); 
		include("views/deletearticle.php"); 
		$this->GetFooter();
	}
	
	private function ConfirmDeleteArticle() {
		$this->DeleteArticleById($_GET['confirmdeleteid']);
	}
	
	private function AddNewCategory() {
		$this->title_caption = "Kosmeyin - Add New Article";
		$this->GetHeader($this->title_caption); 
		include("views/category.php"); 
		$this->GetFooter(); 
	}
	
###
### END ABOUT ARTICLE THIS AREA ###
	
# display all errors	
	public function validation_errors() {
		if($this->errors > 0) {
			echo "<ul>";
			foreach($this->errors as $error) {
				echo "<li>{$error}</li>";
			}
			echo "</ul>";
		}
	}
# end validation errors
	

# checked the session 	
	protected function CheckSession() {
		if(!isset($_SESSION['id']))
			return false;
		return true;
	}
	
# Logout method
	private function LogOut() {
		$this->EndSession();
	}
	
# Set session method
	protected function SetSession($id,$uname,$level) {
		$_SESSION['id'] = $id; 				
		$_SESSION['uname'] = $uname;
		$_SESSION['level'] = $level;
	}

# To end a session
	protected function EndSession() {
		unset($_SESSION);
		session_destroy();
		$this->redirect_to(SERVER_URL);
	}	
	
}

# create new object
$control = new Control();

?>