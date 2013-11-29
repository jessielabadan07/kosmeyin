<?php

$url = getParsedURL($_SERVER['REQUEST_URI']);
$this->result = null;
$this->GetContentPageByURL($url);

$id = $this->ReturnPageId();

$this->result = null;

$this->ModelWidgetByPageId($id);

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