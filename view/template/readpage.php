<?php

$id = intval($_GET['view_id']);
if($id > 0) {
	$this->GetPageById($id);
	echo $this->rst['page_content'];
	
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

	
}
else {
	$this->redirect_to(SERVER_URL);
}



?>