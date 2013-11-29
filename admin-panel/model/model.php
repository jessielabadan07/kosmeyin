<?php
require_once('model/database.php');

class Model extends Database {
	
	protected $articles = array();
	
	public function __construct() {
		parent::__construct();
	}
			
	protected function LoginUser($email,$password) {
		$pass = sha1($password);
		$this->query("SELECT id, email, username, password, user_type FROM user_login WHERE email='$email' AND password='$pass' AND user_type>1", $this->ERROR_QUERY);
		if($this->return_rows() == 1)	# if found return true
			return true;
		return false;			# otherwise return false
	}
	
	public function GetAllMenus() { return $this->query("SELECT * FROM site_menu", $this->ERROR_QUERY); }	
	protected function GetAllWidgets() { return $this->query("SELECT * FROM widgets", $this->ERROR_QUERY); }	
	protected function GetAllSubMenuByMenuId($menu_id) { 
		$this->result = null;
		$this->query("SELECT * FROM menu_category mc RIGHT JOIN category c ON mc.category_id=c.cat_id WHERE mc.menu_id='$menu_id'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				echo '<div style="padding:5px;"><input type="checkbox" id="submenu_name" name="submenu_name[]" value="'.$obj->menucat_id.'"><a href="'.SERVER_URL.'?article&viewcategory='.$obj->cat_id.'">'.$obj->cat_title.'&nbsp;(<i>Article Category :'.$obj->cat_alias.'</i>)</div>';
			}
		}
	}
	
	protected function GetAllSubPageMenuById($menu_id) {
		$this->result = null;
		$this->query("SELECT * FROM menu_category mc RIGHT JOIN pages p ON mc.category_id=p.page_id WHERE mc.menu_id='$menu_id'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				echo '<div style="padding:5px;"><input type="checkbox" id="submenu_page" name="submenu_page[]" value="'.$obj->menucat_id.'"><a href="'.SERVER_URL.'?pages&view_id='.$obj->page_id.'">'.$obj->page_title.'&nbsp;(<i>Static Page</i>)</div>';
			}
		}
	}
	
	protected function SaveMenuContent() {
		//$this->query("INSERT INTO sitemenu_content VALUES(NULL,'$id','$content','$status',now())", $this->ERROR_QUERY);	
	}
	
	protected function SaveParentMenu() {
		$menuName = $this->escape_string($_POST['menu_name']);
		$menuContent = $_POST['menu_desc'];
		$menuType = $_POST['menu_type'];	
		$menu_link = trim(strtolower($_POST['menu_link']));		
		$menu_link = str_replace(' ','-',$menu_link);
		$id = intval($_SESSION['id']);
		$status = $_POST['status'];
		$this->query("INSERT INTO site_menu VALUES (NULL,'$id','$menuName','$menuType','$menuName',NOW(),'$status')", $this->ERROR_INSERT);
		$mid = getLastIdMenu();
		$this->query("INSERT INTO sitemenu_content VALUES (NULL,'$mid','$menuContent','$status',NOW())", $this->ERROR_INSERT);
		if(!empty($_POST['menucat_id'])) {
			foreach($_POST['menucat_id'] as $cid) {				
				$this->query("INSERT INTO menu_category VALUES(NULL,'$cid','$mid','article',NOW())", $this->ERROR_INSERT);
			}
		}
		if(!empty($_POST['page_id'])) {
			foreach($_POST['page_id'] as $pid) {
				$this->query("INSERT INTO menu_category VALUES(NULL,'$pid','$mid','page',NOW())", $this->ERROR_QUERY);
			}
		}
		$this->redirect_to(SERVER_URL."?menus");
	}
	
	protected function SaveNewTag() {		
		if(empty($_POST['tag_name'])) {
			$this->redirect_to(SERVER_URL."?article&add_tag&error=Empty-Tag-Name");
		} 
		$tagName = $this->escape_string($_POST['tag_name']);		
		$status = $_POST['status'];
		echo $status;
		$this->query("INSERT INTO tags VALUES(NULL,'$tagName','$status',NOW())", $this->ERROR_INSERT);
		$tid = intval(getLastTagId());
		if(!empty($_POST['articles'])) {
			foreach($_POST['articles'] as $aid) {
				$this->InsertTagArticleId($tid,$aid);
			}
		}
		$this->redirect_to(SERVER_URL."?article&tag");
	}
	
	protected function CountTagArticle($id) {
		$this->query("SELECT * FROM tag_article WHERE tag_id='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function UpdateTag() {
		$tid = $_POST['post_tagid'];		
		if(empty($_POST['tag_name'])) {
			$this->redirect_to(SERVER_URL."?article&add_tag&error=Empty-Tag-Name");
		}
		$tagName = $this->escape_string($_POST['tag_name']);		
		$status = $_POST['status'];
		$this->query("UPDATE tags SET tags='$tagName', status='$status' WHERE tag_id='$tid'", $this->ERROR_UPDATE);
		if($this->CountTagArticle($tid) > 0) {				
			if(!empty($_POST['articles'])) {				
				$result = array_merge($_POST['articles'], $_POST['hidetag']);
				$result = array_count_values($result);			
				foreach($result as $key => $val) {					
					if($val == 1) {																										
						$this->DeleteArticleTagById($tid,$key);
					} else {						
						$this->DeleteArticleTagById($tid,$key);
						$this->InsertTagArticleId($tid,$key);						
					}
				}				
			} else {				
				foreach($_POST['hidetag'] as $aid) {										
					$this->DeleteArticleTagById($tid, $aid);					
				}
			}
		} else {
			if(!empty($_POST['articles'])) {
				foreach($_POST['articles'] as $aid) {
					$this->InsertTagArticleId($tid,$aid);
				}
			}
		}
		$this->redirect_to(SERVER_URL."?article&tag");
	}
	
	private function DeleteArticleTagById($tid,$aid) {
		$this->query("DELETE FROM tag_article WHERE tag_id='$tid' AND article_id='$aid'", $this->ERROR_DELETE);
	}
	
	
	
	protected function GetTagById($id) {
		$this->query("SELECT * FROM tags WHERE tag_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function GetTagArticleById($tid,$aid) {
		$this->result = null;
		$this->query("SELECT * FROM tag_article WHERE tag_id='$tid' AND article_id='$aid'", $this->ERROR_INSERT);
		return $this->return_rows();
	}
	
	protected function InsertTagArticleId($tid,$aid) {
		$this->query("INSERT INTO tag_article VALUES(NULL,'$tid','$aid',1)", $this->ERROR_INSERT);
	}
	
	protected function SaveMenuItem() {
		$name = $this->escape_string($_POST['submenu_name']);
		$link = trim(strtolower($name));
		$desc = $_POST['submenu_desc'];
		$status = intval($_POST['status']);
		$this->query("INSERT INTO site_submenu VALUES (NULL,'$name','$desc','$link','$status',NOW())", $this->ERROR_INSERT);
		//$id = mysql_insert_id();		
		$id = getLastSubMenuItemId();
		if(!empty($_POST['sitemenu_id'])) {
			foreach($_POST['sitemenu_id'] as $val) {				
				$this->SaveParentMenuBySubMenuId($val,$id);
			}
		}		
		if(!empty($_POST['widget_type'])) {					
			if(strlen($_POST['checkbox_values']) > 0) {
				$split_chk = explode(",",$_POST['checkbox_values']);					
				$result = array_merge($split_chk, $_POST['widget_type']);
				$result = array_count_values($result);	
				foreach($result as $key => $val) {	
					$this->InsertWidgetInSubMenuById($id,$key);
				}
			} else {					
				foreach($_POST['widget_type'] as $key => $val) {										
					$this->InsertWidgetInSubMenuById($id,$val);
				}			
			}	
		}
		$this->redirect_to(SERVER_URL."?menus");
	}
	
	protected function GetSubMenuById($id) {
		$this->query("SELECT * FROM site_submenu WHERE submenu_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function SelectParentMenuById($id) {
		$this->result = null;
		$this->query("SELECT sitemenu_id,submenu_id FROM menu_submenu_link msl RIGHT JOIN site_menu sm ON msl.sitemenu_id=sm.id WHERE msl.submenu_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['sitemenu_id'];
	}
	
	protected function UpdateMenuContent() {							
		$id = intval($_POST['post_id']);//intval($_GET['updatemenu_id']);		
		$menu_name = $this->escape_string($_POST['menu_name']);		
		$menu_link = trim(strtolower($_POST['menu_link']));		
		$menu_link = str_replace(' ','-',$menu_link);
		$content = $_POST['description'];
		$status = $_POST['status'];		
		# set utf-8
		$this->query("SET character_set_client=utf8", "");
		$this->query("SET character_set_connection=utf8", "");
		# update menu name		
		$this->query("UPDATE site_menu SET menu_text='$menu_name', menu_link='$menu_link', menu_status='$status' WHERE id='$id'", $this->ERROR_UPDATE);
		# just update
		if(getContentMenuFromId($id) == 1) {
			$this->query("UPDATE sitemenu_content SET sitemenu_content='$content', sitemenu_status='$status' WHERE sitemenu_id='$id'", $this->ERROR_UPDATE);
			setFlagCookie('menulinks_update',$id);
		} else {	# insert new
			$this->query("INSERT INTO sitemenu_content VALUES (NULL,'$id','$content','$status',NOW())", $this->ERROR_UPDATE);
			setFlagCookie('menulinks_insert',$id);
		}
		# at least one checkbox had been checked
		if($this->CountWidget($id) > 0) {	
			if(!empty($_POST['widget_type'])) {					
				if(strlen($_POST['checkbox_values']) > 0) {
					$split_chk = explode(",",$_POST['checkbox_values']);					
					$result = array_merge($split_chk, $_POST['widget_type']);
					$result = array_count_values($result);	
					foreach($result as $key => $val) {	
						if($val == 1) {							
							$this->DeleteWidgetInContentById($id,$key);
						} else {							
							$this->UpdateWidgetInContentById($id,$key);
						}
					}
				} else {
					if(!empty($_POST['hide_widget'])) {				
						$result = array_merge($_POST['widget_type'], $_POST['hide_widget']);
						$result = array_count_values($result);			
						foreach($result as $key => $val) {					
							if($val == 1) {								
								$this->DeleteWidgetInContentById($id,$key);								
							} else {						
								$this->UpdateWidgetInContentById($id,$key);
							}
						}			
					}
				}		
			} else {				
				foreach($_POST['hide_widget'] as $val) {					
					$this->DeleteWidgetInContentById($id,$val);
				}
			}
		} else {
			if(!empty($_POST['widget_type'])) {	
				if(strlen($_POST['checkbox_values']) > 0) {
					$split_chk = explode(",",$_POST['checkbox_values']);
					$result = array_merge($split_chk, $_POST['widget_type']);
					$result = array_count_values($result);	
					foreach($result as $key => $val) {	
						if($val > 1) {							
							$this->InsertWidgetInContentById($id,$key);
						}
					}
				} else {
					foreach($_POST['widget_type'] as $value) {												
						$this->InsertWidgetInContentById($id,$value);
						//$this->DeleteWidgetInContentById($id,$value);
					}
				}
			} else {				
				foreach($_POST['hide_widget'] as $val) {					
					$this->DeleteWidgetInContentById($id,$val);
				}
			}
		}	
		# redirect to main menu		
		
		if(!empty($_POST['menucat_id'])) {
			if($this->GetMenuCategoryId($id) > 0) {	# update
				foreach($_POST['menucat_id'] as $cid) {					
					$this->DeleteMenuCategory($id,$cid,'article');
					$this->InsertMenuCategory($id,$cid,'article');
				}
			} else {	# insert new
				foreach($_POST['menucat_id'] as $cid) {
					$this->InsertMenuCategory($id,$cid,'article');
				}
			}
		} else {
			foreach($_POST['menuhide_id'] as $cid) {
				$this->DeleteMenuCategory($id,$cid,'article');
				//echo $cid.'&nbsp;'.$id.'<br/>';
				//$this->InsertMenuCategory($id,$cid,'article');
			}
		}

		
		if(!empty($_POST['page_id'])) {
			if($this->GetMenuCategoryId($id) > 0) {	# update
				foreach($_POST['page_id'] as $pid) {					
					$this->DeleteMenuCategory($id,$pid,'page');
					$this->InsertMenuCategory($id,$pid,'page');
				}
			} else { # insert new one
				foreach($_POST['page_id'] as $pid) {
					$this->InsertMenuCategory($id,$pid,'page');
				}
			}
		} else {
			foreach($_POST['pagehide_id'] as $pid) {
				$this->DeleteMenuCategory($id,$pid,'page');
			}
		}
		
		$this->redirect_to(SERVER_URL."?menus");
	}
	
	/*private function GetPageByMenuId($mid,$pid,) {
		$this->result = null;
		$this->query("SELECT * FROM menu_category WHERE category_id='$cid' AND menu_id='$mid' AND category_type='$type'", $this->ERROR_QUERY);
		return $this->return_rows();
	}*/
	
	private function InsertMenuCategory($mid,$cid,$type) {
		$this->query("INSERT INTO menu_category VALUES (NULL,'$cid','$mid','$type',NOW())", $this->ERROR_INSERT);
	}
	
	private function DeleteMenuCategory($mid,$cid,$type) {
		//if($this->GetMenuCategory($mid,$cid,$type) > 0) {
			$this->query("DELETE FROM menu_category WHERE category_id='$cid' AND menu_id='$mid' AND category_type='$type'", $this->ERROR_DELETE);
		//}
	}
	
	private function GetMenuCategory($mid,$cid,$type) {
		$this->query("SELECT * FROM menu_category WHERE category_id='$cid' AND menu_id='$mid' AND category_type='$type'", $this->ERROR_QUERY);
	}
	
	private function GetMenuCategoryId($id) {
		$this->query("SELECT * FROM menu_category WHERE menu_id='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function UpdateSubMenuItem() {
		$id = intval($_POST['submenu_id']);
		$name = $this->escape_string($_POST['submenu_name']);
		$link = str_replace(' ','',trim(strtolower($name)));
		$desc = $_POST['submenu_desc'];
		$status = intval($_POST['status']);
		$this->query("UPDATE site_submenu SET submenu_name='$name', submenu_content='$desc', submenu_link='$link', status='$status' WHERE submenu_id='$id'", $this->ERROR_UPDATE);
		if(!empty($_POST['sitemenu_id'])) {
			foreach($_POST['sitemenu_id'] as $val) {
				$this->DeleteParentMenuById($val,$id);
				$this->SaveParentMenuBySubMenuId($val,$id);
			}
		}
		if($this->CountSubMenuWidget($id) > 0) {	
			if(!empty($_POST['widget_type'])) {					
				if(strlen($_POST['checkbox_values']) > 0) {
					$split_chk = explode(",",$_POST['checkbox_values']);					
					$result = array_merge($split_chk, $_POST['widget_type']);
					$result = array_count_values($result);	
					foreach($result as $key => $val) {	
						if($val == 1) {							
							$this->DeleteWidgetBySubMenuId($id,$val);
						} else {							
							$this->UpdateWidgetInBySubMenuId($id,$key);
						}
						
					}
				} else {
					if(!empty($_POST['hide_widget'])) {				
						$result = array_merge($_POST['widget_type'], $_POST['hide_widget']);
						$result = array_count_values($result);			
						foreach($result as $key => $val) {					
							if($val == 1) {								
								$this->DeleteWidgetBySubMenuId($id,$val);								
							} else {						
								$this->UpdateWidgetInBySubMenuId($id,$key);
							}
						}			
					}
				}		
			} else {				
				foreach($_POST['hide_widget'] as $val) {										
					$this->DeleteWidgetBySubMenuId($id,$val);
				}
			}
		} else {
			if(!empty($_POST['widget_type'])) {	
				if(strlen($_POST['checkbox_values']) > 0) {
					$split_chk = explode(",",$_POST['checkbox_values']);
					$result = array_merge($split_chk, $_POST['widget_type']);
					$result = array_count_values($result);	
					foreach($result as $key => $val) {	
						if($val > 1) {							
							$this->InsertSubMenuWidgetById($id,$key);
						}
					}
				} else {
					foreach($_POST['widget_type'] as $widget_id) {														
						$this->InsertSubMenuWidgetById($id,$widget_id);
					}
				} # end else
			} # end outer if 
		} # end outer else
		$this->redirect_to(SERVER_URL."?menus");
	}
	
	protected function GetMenuCategoryById($mid,$cid,$type) {
		$this->result = null;
		$this->query("SELECT * FROM menu_category WHERE category_id='$cid' AND menu_id='$mid' AND category_type='$type'", $this->ERROR_QUERY);
		//$this->result_to_array();
		return $this->return_rows();
	}
	
	protected function GetWidgetById($mid,$wid) {		
		$this->query("SELECT * FROM sitemenu_widget WHERE sitemenu_id='$mid' AND widget_id='$wid' ORDER BY id", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function GetParentMenuById($pid,$id) {
		$this->query("SELECT * FROM menu_submenu_link WHERE sitemenu_id='$pid' AND submenu_id='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function DeleteParentMenuById($pid,$id) {
		if($this->GetParentMenuById($pid,$id) > 0) {
			$this->query("DELETE FROM menu_submenu_link WHERE sitemenu_id='$pid' AND submenu_id='$id'", $this->ERROR_DELETE);
		}
	}
	
	protected function InsertSubMenuWidgetById($id,$widget_id) {
		$this->query("INSERT INTO submenu_widget VALUES(NULL,'$id','$widget_id',NOW())", $this->ERROR_INSERT);	
	}
	
	protected function UpdateWidgetInBySubMenuId($mid,$wid) {
		$this->DeleteWidgetBySubMenuId($mid,$wid);
		$this->InsertSubMenuWidgetById($mid,$wid);
	}
	
	protected function GetWdigetBySubMenuId($id,$wid) {
		$this->query("SELECT * FROM submenu_widget WHERE submenu_id='$id' AND widget_id='$wid'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function DeleteWidgetBySubMenuId($id,$wid) {
		if($this->GetWdigetBySubMenuId($id,$wid) > 0) {
			$this->query("DELETE FROM submenu_widget WHERE submenu_id='$id' AND widget_id='$wid'", $this->ERROR_DELETE);
		}
	}
	
	protected function SaveParentMenuBySubMenuId($pid,$id) {
		$this->query("INSERT INTO menu_submenu_link VALUES(NULL,'$pid','$id',NOW())", $this->ERROR_QUERY);
	}
	
	protected function GetTitleMenuById($id) {
		$this->query("SELECT * FROM site_menu WHERE id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function GetAllSlideShowImage() {
		$this->query("SELECT * FROM image_gallery", $this->ERROR_QUERY);
	}
	
	protected function GetContentMenuById($id) {
		$this->query("SELECT * FROM sitemenu_content WHERE sitemenu_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}	
	
	protected function GetWidgetBySubMenuId($id,$wid) {		
		$this->query("SELECT * FROM submenu_widget WHERE submenu_id='$id' AND widget_id='$wid' ORDER BY id", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function GetWidgetByPageId($pid,$wid) {
		$this->query("SELECT * FROM page_widget WHERE page_id='$pid' AND widget_id='$wid' ORDER BY id", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function CountWidget($id) {
		$this->query("SELECT * FROM sitemenu_widget WHERE sitemenu_id='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function CountSubMenuWidget($id) {
		$this->query("SELECT * FROM submenu_widget WHERE submenu_id='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function InsertWidgetInContentById($mid,$wid) {		
		$this->query("INSERT INTO sitemenu_widget VALUES (NULL, '$mid', '$wid', now())", $this->ERROR_INSERT);		
	}
	
	protected function InsertWidgetInSubMenuById($id,$wid) {		
		$this->query("INSERT INTO submenu_widget VALUES (NULL, '$id', '$wid', now())", $this->ERROR_INSERT);		
	}
	
	protected function UpdateWidgetInContentById($mid,$wid) {
		$this->DeleteWidgetInContentById($mid,$wid);
		$this->InsertWidgetInContentById($mid,$wid);
	}
	
	
	protected function DeleteWidgetInContentById($mid,$wid) {		
		$this->GetWidgetById($mid,$wid);
		if($this->return_rows() > 0) {
			$this->query("DELETE FROM sitemenu_widget WHERE sitemenu_id='$mid' AND widget_id='$wid'", $this->ERROR_DELETE);			
		}
	}
	
	protected function GetAllPages() {
		$this->result = null;
		$this->query("SELECT * FROM pages ORDER BY page_id DESC", $this->ERROR_QUERY);
	}
	
	
	protected function GetPageById($id) {
		$this->query("SELECT * FROM pages WHERE page_id='$id'", $this->ERROR_QUERY);
		if($this->return_rows() == 1) {
			$this->result_to_array();
			return true;
		}
		return $this->redirect_to(SERVER_URL."?pages");
	}
	
	private function CountPageWidget($id) {
		$this->query("SELECT * FROM page_widget WHERE page_id='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	private function DeleteWidgetByPageId($id,$wid) {
		$this->query("DELETE FROM page_widget WHERE page_id='$id' AND widget_id='$wid'", $this->ERROR_QUERY);
	}
	
	private function InsertWidgetByPageId($id,$wid) {
		$this->query("INSERT INTO page_widget VALUES(NULL,'$id','$wid',NOW())", $this->ERROR_QUERY);
	}
	
	protected function SaveNewPage() {
		$title = $this->escape_string($_POST['title']);
		$content = addslashes($_POST['content']);
		$tags = 'page';
		$status = $_POST['status'];				
		$page_link = "";
		$this->query("INSERT INTO pages VALUES (NULL,'$title','$content','$tags','','$status',NOW())", $this->ERROR_INSERT);
		$id = getLastPageId();
		if(!empty($_POST['deflink'])) {
			$default_link = strtolower(trim($_POST['deflink']));
			$page_link = USER_DIR."?pages/{$default_link}";
		} else {
			$page_link = USER_DIR."?pages&view_id=".$id;
		}
		$this->query("UPDATE pages SET page_link='$page_link' WHERE page_id='$id'", $this->ERROR_UPDATE);
		if(!empty($_POST['widget_type'])) {	
			if(strlen($_POST['checkbox_values']) > 0) {
				$split_chk = explode(",",$_POST['checkbox_values']);
				$result = array_merge($split_chk, $_POST['widget_type']);
				$result = array_count_values($result);	
				foreach($result as $key => $val) {	
					if($val > 1) {							
						$this->InsertWidgetByPageId($id,$key);
					}
				}
			} else {
				foreach($_POST['widget_type'] as $widget_id) {														
					$this->InsertWidgetByPageId($id,$widget_id);
				}
			} # end else
		} # end outer if 
		$this->redirect_to(SERVER_URL."?pages");
	}
	
	
	
	protected function UpdatePage() {
		$id = intval($_POST['id']);
		$title = $this->escape_string($_POST['title']);
		$content = $_POST['content'];	
		$status = $_POST['status'];			
		if(!empty($_POST['deflink'])) {
			$default_link = strtolower(trim($_POST['deflink']));
			$page_link = USER_DIR."?pages/{$default_link}";
		} else {
			$page_link = USER_DIR."?pages&view_id=".$id;
		}				
		$tags = 'page';
		$sql =  "UPDATE pages SET page_title='$title', page_content='$content', page_tags='$tags', ";
		$sql .= "page_link='$page_link', page_status='$status', dateupdate=NOW() WHERE page_id='$id'";
		$this->query($sql, $this->ERROR_UPDATE);
		if($this->CountPageWidget($id) > 0) {	
			if(!empty($_POST['widget_type'])) {					
				if(strlen($_POST['checkbox_values']) > 0) {
					$split_chk = explode(",",$_POST['checkbox_values']);					
					$result = array_merge($split_chk, $_POST['widget_type']);
					$result = array_count_values($result);	
					foreach($result as $key => $val) {	
						if($val == 1) {							
						} else {																				
							$this->DeleteWidgetByPageId($id,$key);
							$this->InsertWidgetByPageId($id,$key);
						}
						
					}
				} else {
					if(!empty($_POST['hide_widget'])) {				
						$result = array_merge($_POST['widget_type'], $_POST['hide_widget']);
						$result = array_count_values($result);			
						foreach($result as $key => $val) {					
							if($val == 1) {								
							} else {														
								$this->DeleteWidgetByPageId($id,$key);
								$this->InsertWidgetByPageId($id,$key);
							}
						}			
					}
				}		
			} else {				
				foreach($_POST['hide_widget'] as $val) {										
					$this->DeleteWidgetBySubMenuId($id,$val);
				}
			}
		} else {
			if(!empty($_POST['widget_type'])) {	
				if(strlen($_POST['checkbox_values']) > 0) {
					$split_chk = explode(",",$_POST['checkbox_values']);
					$result = array_merge($split_chk, $_POST['widget_type']);
					$result = array_count_values($result);	
					foreach($result as $key => $val) {	
						if($val > 1) {							
							$this->InsertWidgetByPageId($id,$key);
						}
					}
				} else {
					foreach($_POST['widget_type'] as $widget_id) {														
						$this->InsertWidgetByPageId($id,$widget_id);
					}
				} # end else
			} # end outer if 
		} # end outer else
		$this->redirect_to(SERVER_URL."?pages");
	}
	
	protected function DeletePageById($id) {
		$this->query("DELETE FROM pages WHERE page_id='$id'", $this->ERROR_DELETE);
		$this->query("DELETE FROM menu_category WHERE category_id='$id' AND category_type='page'", $this->ERROR_DELETE);
		$this->redirect_to(SERVER_URL."?pages");
	}
	
	protected function GetAllCategory() {
		$this->query("SELECT * FROM category WHERE cat_type='article' ORDER BY cat_id", $this->ERROR_QUERY);
	}
	
	protected function GetAllTagList() {
		$this->query("SELECT * FROM tags", $this->ERROR_QUERY);
	}
	
	protected function GetArticlesByTagId($id) {
		$this->result = null;
		$this->query("SELECT * FROM tag_article ta RIGHT JOIN article a ON ta.article_id=a.article_id WHERE ta.tag_id='$id'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				echo '<div id="re-'.$obj->article_id.'-'.$id.'"><a href="javascript:;" style="padding:5px; font-size:12px; font-weight:bold;" class="removearticle" id="'.$obj->article_id.'-'.$id.'">x</a>'.$obj->article_title.'</div>';
			}
		}
	}
	
	protected function SaveNewCategory() {
		if(empty($_POST['cat_name']) AND empty($_POST['cat_alais'])) {
			$this->redirect_to(SERVER_URL.'?article&add_category&error=empty-required-field');
		} if($this->GetCategoryAlias($_POST['cat_alias']) > 0) {
			$this->redirect_to(SERVER_URL.'?article&add_category&error=alias-already-exist');
		} if($this->GetCategoryName($_POST['cat_name']) > 0) {
			$this->redirect_to(SERVER_URL.'?article&add_category&error=Category-Name-already-exist');
		} else {
			$name = $this->escape_string($_POST['cat_name']);
			$alias = $this->escape_string(trim(strtolower($_POST['cat_alias'])));
			$description = $this->escape_string($_POST['description']);			
			$this->query("INSERT INTO category VALUES(NULL,'$name','$description','$alias','article',1,NOW())", $this->ERROR_INSERT);
			//$id = mysql_insert_id();
			$id = getLastCategoryById();
			if(!empty($_POST['articles'])) {
				foreach($_POST['articles'] as $value) {
					$this->query("INSERT INTO article_category VALUES(NULL,'$value','$id',1,NOW())");
				}
			}
			$this->redirect_to(SERVER_URL.'?article&category');
		}
	}
	
	private function GetCategoryAliasById($alias,$id) {
		$alias = trim(strtolower($alias));
		$this->query("SELECT * FROM category WHERE cat_alias='$alias' AND cat_id!='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	private function GetCategoryNameById($name,$id) {		
		$this->query("SELECT * FROM category WHERE cat_title='$name' AND cat_id!='$id'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function UpdateCategory() {
		$id = intval($_POST['post_id']);
		if(empty($_POST['cat_name']) AND empty($_POST['cat_alais'])) {
			$this->redirect_to(SERVER_URL.'?article&viewcategory&error=empty-required-field');
		} if($this->GetCategoryAliasById($_POST['cat_alias'],$id) > 0) {
			$this->redirect_to(SERVER_URL.'?article&viewcategory&error=alias-already-exist');
		} if($this->GetCategoryNameById($_POST['cat_name'],$id) > 0) {
			$this->redirect_to(SERVER_URL.'?article&viewcategory&error=Category-Name-already-exist');
		} else {
			$name = $this->escape_string($_POST['cat_name']);
			$alias = $this->escape_string(trim(strtolower($_POST['cat_alias'])));
			$description = $this->escape_string($_POST['description']);		
			$this->query("UPDATE category SET cat_title='$name', cat_alias='$alias', cat_description='$description' WHERE cat_id='$id'",
							$this->ERROR_QUERY);
		}
		/*if(!empty($_POST['articles'])) {
			$result = array_merge($_POST['articles'], $_POST['hidecat']);
			$result = array_count_values($result);		
			foreach($result as $key => $val) {	
				if($val == 1) {							
					$this->DeleteCategoryById($key,$id);
				} else {							
					$this->InsertCategoryById($key,$id);
				}
			}
		} else {
			if(!empty($_POST['hidecat'])) {
				foreach($_POST['hidecat'] as $aid) {
					$this->DeleteCategoryById($aid,$id);
				}
			}
		}*/
		$this->redirect_to(SERVER_URL."?article&category");
	}
	
	protected function DeleteCategoryById($aid,$cid) {
		$this->query("DELETE FROM article_category WHERE article_id='$aid' AND cat_id='$cid'", $this->ERROR_QUERY);
	}
	
	protected function InsertCategoryById($aid,$cid) {
		$this->query("INSERT INTO article_category VALUES(NULL,'$aid','$id',1,NOW())");
	}
	
	protected function GetArticleByCategoryId($aid,$cid) {
		$this->query("SELECT * FROM article_category WHERE article_id='$aid' AND cat_id='$cid'", $this->ERROR_QUERY);
		return $this->return_rows();
	}

	protected function GetCategoryById($id) {
		$this->query("SELECT * FROM category WHERE cat_id='$id'", $this->ERROR_QUERY);
	}
	
	private function GetCategoryAlias($alias) {
		$alias = trim(strtolower($alias));
		$this->query("SELECT * FROM category WHERE cat_alias='$alias'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	private function GetCategoryName($name) {		
		$this->query("SELECT * FROM category WHERE cat_title='$name'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	protected function AddNewArticle(){						
		$title = $this->escape_string($_POST['title']);
		$aText = addslashes($_POST['fronttext']);
		$desc = addslashes($_POST['description']);//stripslashes($_POST['description']);
		$status = $_POST['status'];
		$uid = $_SESSION['id'];		
		$sql =  "INSERT INTO article (article_id, id, article_title, article_content, article_textdisplay, date_published, article_status) ";
		$sql .= "VALUES(NULL,'$uid','$title','$desc','$aText',now(),$status)";
		$this->query($sql, $this->ERROR_QUERY);
		$newid = intval(getLastArticleId());
		UploadArticleImageCaption($newid);	# call function UploadImage
		if(!empty($_POST['categorylist'])) {
			foreach($_POST['categorylist'] as $cat_id) {				
				$this->query("INSERT INTO article_category VALUES (id,'$newid','$cat_id',1,now())", $this->ERROR_INSERT);
			}
		}
		if(!empty($_POST['tags'])) {			
			foreach(explode(",",$_POST['tags']) as $value) {	
				$value = str_replace(" ", "", $value);
				if(strlen($value) > 0) {					
					if($this->GetTagByValue($value) > 0) {						
						$this->InsertTagArticleById($newid,$value);												
					} else {
						$this->InsertNewTag($newid,$value);												
					}
				}
			} 
		}
		$this->redirect_to(SERVER_URL."?article&all");
	}
	
	protected function GetAllArticles($start,$offset) {
		$this->query("SELECT * FROM article ORDER BY article_id DESC LIMIT ".$start.",".$offset."", $this->ERROR_QUERY);
		foreach($this->result_to_object() as $r) {	
			$this->articles[] = array( 
									'article_id'=>$r->article_id, 
									'title'=>$r->article_title, 
									'date'=>$r->date_published,		
									'category'=>$this->GetCategoryByArticleId($r->article_id),
									'tags'=>$this->GetTagsByArticleId($r->article_id),
									'datepublish' => $r->date_published,
									'status' => $r->article_status
								);
		}		
	}
	
	protected function GetListArticles() {
		$this->query("SELECT * FROM article WHERE article_status=1", $this->ERROR_QUERY);
	}
	
	protected function GetArticleFeatured() {
		$this->query("SELECT * FROM article_featured af LEFT JOIN article a ON af.article_id=a.article_id", $this->ERROR_QUERY);
	}
	
	protected function DeleteArticleFeaturedById($id) {
		$this->query("DELETE FROM article_featured WHERE article_id='$id'", $this->ERROR_QUERY);
	}
	
	protected function InsertArticleFeaturedById($id,$order) {
		$this->query("INSERT INTO article_featured VALUES(NULL,'$id',NOW(),'$order')", $this->ERROR_INSERT);
	}
	
	private function GetCategoryByArticleId($id) {		
		$this->query("SELECT * FROM category c RIGHT JOIN article_category ac ON c.cat_id = ac.cat_id WHERE ac.article_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		if($this->return_rows() > 0)
			return $this->rst['cat_title'];
		else
			return null;
	}	
	
	protected function GetAllCategoryByArticleId($id) {
		$this->result = null;
		$strOut = null;
		$this->query("SELECT * FROM category c RIGHT JOIN article_category ac ON c.cat_id=ac.cat_id WHERE ac.article_id='$id'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				$strOut .= $obj->cat_title.'&nbsp;,';
			}
		}
		return $strOut;
	}
		
	protected function GetArticleCategoryById($aid,$cid) {
		$this->query("SELECT * FROM article_category WHERE article_id='$aid' AND cat_id='$cid' ORDER BY id DESC", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function GetTagsArticleById($id) {
		$this->query("SELECT * FROM tag_article WHERE article_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function getTagJoinArticleById($id) {
		$this->result = null;
		$strOutput = null;
		$this->query("SELECT * FROM tag_article ta RIGHT JOIN tags t ON ta.tag_id=t.tag_id WHERE ta.article_id='$id'", $this->ERROR_QUERY);
		if($this->return_rows() > 0) {
			foreach($this->result_to_object() as $obj) {
				$strOutput.= $obj->tags.', ';
			}
			return $strOutput;
		}
	}
	
	private function GetTagsByArticleId($id) {
		return 0;
		/*$this->query("SELECT * FROM tags WHERE article_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		if($this->return_rows() > 0)
			return $this->rst['tags'];
		else
			return null;*/
	}
	
	protected function SaveUpdateArticle($id) {						
		$title = $this->escape_string($_POST['title']);
		$aText = addslashes($_POST['fronttext']);
		$desc = stripslashes($_POST['description']); //addslashes($_POST['description']);
		$status = $_POST['status'];
		//$tags = $_POST['tags'];
		$uid = $_SESSION['id'];		
		$sql =  "UPDATE article SET article_title='$title', article_content='$desc', article_textdisplay='$aText', ";
		$sql .= "article_status='$status', date_published=now() WHERE article_id='$id'";
		$this->query($sql, $this->ERROR_QUERY);
		# tags
		if(!empty($_POST['tags'])) {			
			foreach(explode(",",$_POST['tags']) as $value) {	
				$value = str_replace(" ", "", $value);
				if(strlen($value) > 0) {					
					if($this->GetTagByValue($value) > 0) {
						$this->DeleteTagArticleById($id,$value);
						$this->InsertTagArticleById($id,$value);						
					} else {
						$this->InsertNewTag($id,$value);						
					}
				}
			} 
		} else {
			$this->query("DELETE FROM tag_article WHERE article_id='$id'", $this->ERROR_DELETE);
		}
		# category list
		if(!empty($_POST['categorylist'])) {
			foreach($_POST['hide_cat'] as $key => $value) {				
				$this->DeleteArticleCategoryById($id,$value);				
			}
			foreach($_POST['categorylist'] as $key => $value) {
				//echo "Insert ".$value.'<br/>';
				$this->InsertArticleCategoryById($id,$value);
			}
		} else {
			foreach($_POST['hide_cat'] as $value) {
				$this->DeleteArticleCategoryById($id,$value);
			}
		}
		UploadArticleImageCaption(intval($id));	# call function UploadImage
		setFlagCookie('articleupdate_id',$id);
		$this->redirect_to(SERVER_URL."?article&all");
	}
	
		
	private function GetTagByValue($value) {
		$value = trim(strtolower($value));
		$this->query("SELECT * FROM tags WHERE tags='$value'", $this->ERROR_QUERY);
		return $this->return_rows();
	}
		
	private function InsertNewTag($id,$value) {
		$value = trim(strtolower($value));		
		$this->query("INSERT INTO tags VALUES (NULL, '$value', 1, NOW())", $this->ERROR_INSERT);
		$tag_id = intval(getLastTagId());
		$this->query("INSERT INTO tag_article VALUES(NULL,'$tag_id','$id',1)", $this->ERROR_INSERT);
	}
	
	private function InsertTagArticleById($id,$value)  {
		$this->GetTagByValue($value);
		$this->result_to_array();
		$tag_id = $this->rst['tag_id'];		
		$this->query("INSERT INTO tag_article VALUES(NULL, '$tag_id','$id',1)", $this->ERROR_INSERT);				
	}
	
	private function DeleteTagArticleById($id,$value) {
		$this->GetTagByValue($value);
		$this->result_to_array();
		$tag_id = $this->rst['tag_id'];		
		$this->query("DELETE FROM tag_article WHERE article_id='$id' AND tag_id='$tag_id'", $this->ERROR_DELETE);				
	}
	
	private function DeleteArticleCategoryById($aid,$cid) {
		$this->GetArticleCategoryById($aid,$cid);
		if($this->return_rows() > 0) {
			$this->query("DELETE FROM article_category WHERE article_id='$aid' AND cat_id='$cid'", $this->ERROR_DELETE);
		}
	}
	
	private function InsertArticleCategoryById($aid,$cid) {
		$this->query("INSERT INTO article_category VALUES(NULL,'$aid','$cid',1,now())", $this->ERROR_QUERY);		
	}	
	
	protected function GetTotalCategoryArticle($id) {
		$this->query("SELECT COUNT(cat_id) as total_count FROM article_category WHERE cat_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['total_count'];
	}
	
	public function ReturnAllArticles() {
		$this->query("SELECT * FROM article", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	
	protected function GetAllSurvey() {
		$this->query("SELECT * FROM survey", $this->ERROR_QUERY);
		return $this->return_rows();
	}
	
	
	protected function GetTotalRegisterdByStatus($status) {
		$this->result = null;
		$this->query("SELECT user_type, COUNT(status_link) as total FROM user_login WHERE user_type=1 AND status_link='$status'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['total'];
	}
	
	// user
	protected function GetUserById($id) {
		$this->result = null;
		$this->query("SELECT * FROM user_login ul JOIN user_info ui ON ul.id = ui.id WHERE ul.id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
	}
	
	protected function GetBonusPointsByRegisterId($id) {
		$this->query("SELECT uid,bonus_pts,description FROM bonus_points WHERE uid='$id' AND description='user-register'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['bonus_pts'];
	}
	
	protected function GetBonusPointsByUserLogId($id) {
		$this->query("SELECT uid,SUM(points_log) as points FROM user_log WHERE uid='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['points'];
	}
	
	protected function GetPointsOnArticle($id) {
		return $this->GetPointsByReadingArticle($id) + $this->GetPointsByCommentingArticle($id);
	}
	
	protected function GetPointsByReadingArticle($id) {
		$this->query("SELECT uid,SUM(points) as points FROM user_read_articles WHERE uid='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['points'];
	}
	
	protected function GetPointsByCommentingArticle($id) {
		$this->query("SELECT user_id,COUNT(user_id) as count_id FROM article_comment WHERE user_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['count_id'] * intval(10);
	}
	
	protected function GetPointsByFriendRefferal($id) {
		$this->query("SELECT friend_id,SUM(r_points) as points FROM referrer_points WHERE friend_id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['points'];
	}
	
	protected function GetUserTotalPoints($id) {
		return $this->GetBonusPointsByRegisterId($id) + 
			   $this->GetBonusPointsByUserLogId($id) +
			   $this->GetPointsOnArticle($id) + 
			   $this->GetPointsByFriendRefferal($id);
	}
	
	protected function GetUserNameById($id) {
		$this->query("SELECT id,username FROM user_login WHERE id='$id'", $this->ERROR_QUERY);
		$this->result_to_array();
		return $this->rst['username'];
	}
	
	protected function SaveGiftPoints() {
		if(empty($_POST['points'])) {
			$this->redirect_to(SERVER_URL."?users&givepoints_by_userid=".$_POST['hide_id']);
		} if(!intval($_POST['points'])) {
			$this->redirect_to(SERVER_URL."?users&givepoints_by_userid=".$_POST['hide_id']);
		} else {
			$id = $_POST['hide_id'];
			$points = intval($_POST['points']);			
			$status = $_POST['status'];
			$desc = $_POST['points_type'];
			$this->query("INSERT INTO gift_points VALUES(NULL,'$id','$points','$desc',NOW())", $this->ERROR_QUERY);
			if($status == 1) {
				$text = "<span class=\"listRed\">".$this->GetUserNameById($id)."</span> gets {$points} gold coins gift from Admin.";
				$this->query("INSERT INTO user_activity VALUES(NULL,'$id','$text','gift-points',NOW())", $this->ERROR_QUERY);
			}
		}
	}
	
	protected function DeleteUserInfo($id) {
		deleteUserInfo($id);
		$dir = "../user_upload/{$id}";	
		delete_directory($dir);		
		$this->redirect_to(SERVER_URL."?users");
	}
	
}

$model = new Model();

?>