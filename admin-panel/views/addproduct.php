<?php include('template/content_top.php'); ?>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">Add New Product</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">
	<?php echo form_open('admin/products/submit'); ?>
		<table id="product_table">
			<tr>
				<td>Product Name:</td>
				<td><input type="text" id="product_name" name="product_name" ></td>
			</tr>
			<tr>
				<td>Product Description:</td>
				<td><textarea id="description" name="description" cols="50" rows="10" ></textarea></td>
			</tr>
		</table>
	<?php echo form_close(); ?>
</div>
<?php include('template/content_bottom.php'); ?>			
		