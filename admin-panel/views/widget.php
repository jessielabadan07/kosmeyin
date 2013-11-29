<?php include('template/content_top.php'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.a_widgetimg').click(function() {
			var id = $(this).attr('id');
			$('#widgetimg'+id).slideToggle("slow");
		});
	});
</script>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">WIDGETS</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">
<?$this->GetAllWidgets()?>
<?php foreach($this->result_to_object() as $obj): ?>
	<div style="position:relative; overflow:hidden; width:900px; border:1px solid orange; background-color: lemonchiffon; height:auto; padding: 10px; margin:0 auto; margin-top:5px;">
		<a href="javascript:;" class="a_widgetimg" id="<?=$obj->id?>" style="font-size:12px; font-weight:bold; color:#666;"><?=$obj->widget_name?></a>	 <br/>
		<div id="widgetimg<?=$obj->id?>" style="display:none;"><img src="<?=SERVER_URL?>images/widgets/<?=$obj->widget_image?>" width="800" height="" alt="" /></div>
	</div>	
<?php endforeach; ?>
<br/>
	<div style="position:relative; overflow:hidden; padding:3px; float:right; border:1px solid orange; background-color:lemonchiffon; margin-right:50px; margin-bottom:5px;">
		Click the title of the widget.
	</div>
</div>
<?php include('template/content_bottom.php'); ?>		
	
		