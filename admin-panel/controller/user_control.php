<?php
# include database
require_once("model/model.php");

class UserControl extends Control {
	
	public function __construct() {
		if(isset($_GET['users'])) {
			$this->GetSurveyList();
		}
	}
	
	public function GetSurveyList() {
		$this->title_caption = "Kosmeyin - User List";
		$this->GetHeader($this->title_caption); 
		include("views/users.php"); 
		$this->GetFooter(); 
	}
	
}

$usercontrol = new UserControl();

?>