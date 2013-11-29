<?php include('template/content_top.php'); ?>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#C60070; padding:5px; font-size:11px; font-weight:bold; color:#fff;">Display</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">
<?php if(strlen(validation_errors())): ?>
	<?php echo validation_errors();	?>
<?php else: ?>
			<div style="border:1px solid orange; background-color:lemonchiffon; padding:10px; font-size:16px; font-weight:bold; color:#333; width:670px;">
				Successfully Saved!<br/><span style="font-size:11px;"><a href="<?=WEBURL?>admin">Go back home</a></span>
			</div>			
<?php endif; ?>
</div>
<?php include('template/content_bottom.php'); ?>			
		