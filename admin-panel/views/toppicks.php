<script type="text/javascript" src="<?=SERVER_URL?>js/editor/jquery.1.7.2.min.js"></script>
<script type="text/javascript" src="<?=SERVER_URL?>js/editor/jquery-ui.1.8.20.min.js"></script>
<script type="text/javascript" src="<?=SERVER_URL?>js/editor/tagit.js"></script>
<link type="text/css" rel="stylesheet" href="<?=SERVER_URL?>css/editorpick/demo.css"/>
<link type="text/css" rel="stylesheet" href="<?=SERVER_URL?>css/editorpick/tagit-stylish-yellow.css"/>
<?php include('template/content_top.php'); ?>
<script>
$(function () {	
	var availableTags = [];
	var tagsId = [];
	$("input[type=hidden]").each(function() {
		 availableTags.push($(this).val());
		 tagsId.push($(this).attr("id"));
	});


	$('#showArticle').tagit({tagSource:availableTags, sortable:true});
	$("#saveTags").click(function () { 
			showTags($("#showArticle").tagit("tags")) 
    });
   	 
	function showTags(tags) {
		//console.log(tags);
		var string = "";		
		for (var i in tags)
			string += tags[i].label + " : " + tags[i].value + "\r\n";
		alert(string);
		
	}		
});
</script>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">Editor's Picks Top Article</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px; padding-bottom:50px;">	
		<h3>Search Article Title</h3>
		<div class="box">
			<div class="note">
				You can allow the title to be sortable by dragging the entire title!
			</div>			
				<?php $query = mysql_query("SELECT * FROM article") or die(mysql_error()); ?>	
			<?php while($row = mysql_fetch_array($query)): ?>
				<?php		
					$whatYouWant = str_replace(' ','-',$row['article_title']);
				?>
				<input type="hidden" id="<?=$row['article_id']?>" name="myhidden" label="<?=$row['article_id']?>" value="<?=$whatYouWant?>" />
			<?php endwhile; ?>
			<ul id="showArticle" name="showArticle">
				<!--<li id="1">here</li>
				<li id="2">are</li>
				<li id="3">some</li>
				<li id="4">initial</li>
				<li id="5">tags</li>-->				
			</ul>			
			<div class="buttons">
				<button id="saveTags" value="Save" name="save">Save</button>
			</div>
		</div>
</div>
<?php include('template/content_bottom.php'); ?>		
	
		