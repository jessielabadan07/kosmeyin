<?php
# include database
require_once("controller/control.php");

class Survey extends Control {
	
	public function __construct() {
		if(isset($_GET['survey'])) {		
			$this->GetSurveyList();
		}
	}
	
	public function GetSurveyList() {
		$this->title_caption = "Kosmeyin - Survey List";
		$this->GetHeader($this->title_caption); 		
		include("views/survey.php"); 
		$this->GetFooter(); 
	}
	
	public function GetSurvey() {
		$this->GetAllSurvey(); 
	}
	
}

$survey = new Survey();

?>