<?php


$url = trim(strtolower($_SERVER['REQUEST_URI']));								
$url = substr($url,(strpos($url,"?")),strlen($url));						
$url = strtoupper(substr($url,(strpos($url,"/")+1),strlen($url)));	

$id = $this->GetIdByMenuName($url);
$this->GetMenuContent($id);
if($this->return_rows() >0 ) {
	foreach($this->result_to_object() as $obj) {
		echo $obj->sitemenu_content;
	}
}
$this->ModelWidgetByMenuId($id);

foreach($this->widgets_array as $widget) {	
	if($widget==1)
		$this->latestArticle();	
	if($widget==2)
		$this->featuredBrand();
	if($widget==3)
		$this->currentActivity();
	if($widget==4)
		$this->gameCenter();
	if($widget==5)
		$this->inviteShare() ;
}

?>
