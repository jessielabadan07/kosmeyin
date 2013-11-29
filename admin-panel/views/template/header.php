<!DOCTYPE HTML>
<Html>
<head>
	<title><?=$this->title_caption?></title>		
	<link type="text/css" rel="stylesheet" href="<?=SERVER_URL?>css/style.css"/>
	<link rel="shortcut icon" href="<?=USER_DIR?>images/favicon/favicon.ico" />
	<?php if(isset($_GET['view_id']) || isset($_GET['add']) || isset($_GET['contentsubmenu_id']) ||
		isset($_GET['featured'])): ?>
			<script type="text/javascript" src="<?=SERVER_URL?>js/jquery-1.3.2.min.js"></script>
			<script type="text/javascript" src="<?=SERVER_URL?>js/jquery-ui-1.7.1.custom.min.js"></script>
	<?php else: ?>
			<script type="text/javascript" src="<?=SERVER_URL?>js/jquery.js"></script>	
	<?php endif; ?>
	<script type="text/javascript">
		$(document).ready(function(){							
			 $('#checkall').click(function () {
				var checked_status = this.checked;
				$("input[@name=deletetype]").each(function()
				{
					this.checked = checked_status;
				});
			});
			
			$('#deleteallmenu').click(function () {
				var checked_status = this.checked;
				$("input[@name=delete_menus]").each(function()
				{
					this.checked = checked_status;
				});
			});
			
			$('#deleteallcat').click(function() {
				var checked_status = this.checked;
				$("input[@name=deletecategories]").each(function()
				{
					this.checked = checked_status;
				});
			});
			
			// delete all tags
			$("#deletealltag").click(function() {
				var checked_status = this.checked;
				$("input[@name=deletetags]").each(function()
				{
					this.checked = checked_status;
				});
			});
			
			$('#delphoto').click(function () {
				var checked_status = this.checked;
				$("input[@name=delphotos]").each(function()
				{
					this.checked = checked_status;
				});
			});
			
			
			$('#del_user').click(function () {
				var checked_status = this.checked;
				$("input[@name=delusers]").each(function()
				{
					this.checked = checked_status;
				});
			});
			
			$("#btndel_user").click(function() {
				var count = 0;
				var message = "";
				$("input[@name=delusers]").each(function() {
					if(this.checked) {
						count++;
					}
				});
				if(count>1)
					message = "Are you sure you want to delete these Users and their points/images/content?";
				else
					message = "Are you sure you want to delete this user and his/her points/images/content?"
				if(count>=1) {
					if(confirm(message))
					{
						$("input[@name=delusers]").each(function()
						{
							if(this.checked) {
								var id = $(this).attr("id");										
								$(this).parents("tr").slideUp(100, this.remove);		
								$.ajax({
									type: "POST",
									url: "lib/delete_users.php",
									data: {'id':id},
									success: function(results){		 										
									}
								});
							}				
						});
					}
				}
			});
			
			$("#delalltag").click(function() {
				var count = 0;
				var message = "";
				$("input[@name=deletetags]").each(function() {
					if(this.checked) {
						count++;
					}
				});
				if(count>1)
					message = "Are you sure you want to delete these Tags?";
				else
					message = "Are you sure you want to delete this tag?"
				if(count>=1) {
					if(confirm(message))
					{
						$("input[@name=deletetags]").each(function()
						{
							if(this.checked) {
								var id = $(this).attr("id");										
								$(this).parents("tr").slideUp(100, this.remove);		
								$.ajax({
									type: "POST",
									url: "lib/delete_tags.php",
									data: {'id':id},
									success: function(results){		 										
									}
								});
							}				
						});
					}
				}
			});
			
			$("#del_category").click(function() {
				var count = 0;
				var message = "";
				$("input[@name=deletecategories]").each(function() {
					if(this.checked) {
						count++;
					}
				});
				if(count>1)
					message = "Are you sure you want to delete these Categories?";
				else
					message = "Are you sure you want to delete this Category?"
				if(count>=1) {
					if(confirm(message))
					{
						$("input[@name=deletecategories]").each(function()
						{
							if(this.checked) {
								var id = $(this).attr("id");		
								$(this).parents("tr").slideUp(100, this.remove);		
								$.ajax({
									type: "POST",
									url: "lib/delete_category.php",
									data: {'id':id},
									success: function(results){		 										
									}
								});
							}				
						});
					}
				}
			});
			
	
			$("#del_menu").click(function() {
				var count = 0;
				var message = "";
				$("input[@name=delete_menus]").each(function() {
					if(this.checked) {
						count++;
					}
				});
				if(count>1)
					message = "Are you sure you want to delete these menus?";
				else
					message = "Are you sure you want to delete this menu?"
				if(count>=1) {
					if(confirm(message))
					{
						$("input[@name=delete_menus]").each(function()
						{
							if(this.checked) {
								var id = $(this).attr("id");		
								$(this).parents("tr").slideUp(100, this.remove);		
								$.ajax({
									type: "POST",
									url: "lib/delete_menus.php",
									data: {'id':id},
									success: function(results){		 										
									}
								});
							}				
						});
					}
				}
			});
	
			$("#del_article").click(function() {
				var count = 0;
				var message = "";
				$("input[@name=deletetype]").each(function() {
					if(this.checked) {
						count++;
					}
				});
				if(count>1)
					message = "Are you sure you want to delete these articles?";
				else
					message = "Are you sure you want to delete this article?"
				if(count>=1) {
					if(confirm(message))
					{
						$("input[@name=deletetype]").each(function()
						{
							if(this.checked) {
								var id = $(this).attr("id");		
								$(this).parents("tr").slideUp(100, this.remove);		
								$.ajax({
									type: "POST",
									url: "lib/delete_article.php",
									data: {'id':id},
									success: function(results){		 										
									}
								});
							}				
						});
					}
				}
			});	
			
								
					
			$("#delete_photos").click(function() {
				var count = 0;
				var message = "";
				$("input[@name=delphotos]").each(function() {
					if(this.checked) {
						count++;
					}
				});
				if(count>1)
					message = "Are you sure you want to delete these images?";
				else
					message = "Are you sure you want to delete this image?"
				if(count>=1) {
					if(confirm(message))
					{
						$("input[@name=delphotos]").each(function()
						{
							if(this.checked) {
								var id = $(this).attr("id");		
								$(this).parents("tr").slideUp(100, this.remove);		
								$.ajax({
									type: "POST",
									url: "lib/delete_images.php",
									data: {'id':id},
									success: function(results){		 										
									}
								});
							}				
						});
					}
				}
			});	
			
			$('.vis_img').click(function() {
				var message = "Are you sure you want to hide this image in the photo gallery at the homepage?";
				if(confirm(message)) {
					var id = $(this).attr("id");							
					$.ajax({
						type: "POST",
						url: "lib/gallery.php",
						data: {'id':id},
						success: function(result){		 
							$('a #'+id).text('<a href="javascript:;" class="hid_img" id="'+result+'" style="text-decoration:underline;">hidden</a>');
						}
					});
				}
			});
			
			$('.hid_img').click(function() {
				var message = "Are you sure you want to display this image in the photo gallery at the homepage?";
				if(confirm(message)) {
					var id = $(this).attr("id");							
					$.ajax({
						type: "POST",
						url: "lib/gallery.php",
						data: {'id':id},
						success: function(result){		 
							$('a #'+id).text('<a href="javascript:;" class="vis_img" id="'+result+'" style="text-decoration:underline;">hidden</a>');
						}
					});
				}
			});
				

			
			
		});
	</script>	
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
