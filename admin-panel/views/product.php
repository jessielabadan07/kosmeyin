<?php include('template/content_top.php'); ?>
<div style="width:100%; height:auto; position:relative; overflow:hidden; background-color:#f1f1f1; padding:5px; font-size:11px; font-weight:bold; color:#888;">Product List</div>
<div style="position:relative; overflow:hidden; width:100%; height:auto; padding:3px;">
	
	<div style="position:relative; overflow:hidden; width:650px; border:1px solid orange; background-color: lemonchiffon; height:auto; padding: 10px; margin:0 auto; margin-top:5px;">
		<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:right;">
			<a href="<?=SERVER_URL?>admin/products/delete" style="color:#666; font-size:11px;">Delete</a>
		</div>
		<div style="position:relative; overflow:hidden; width:30px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:right;">
			<a href="<?=SERVER_URL?>admin/products/add" style="color:#666; font-size:11px;">+ Add</a>
		</div>		
		<div style="position:relative; overflow:hidden; width:32px; padding:5px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; background-color:#FFF; float:right;">
			<a href="<?=SERVER_URL?>admin/products/search" style="color:#666; font-size:11px;">Search</a>
		</div>
		
		<div style="position:relative; overflow:hidden; width:auto; height:auto; float:right; margin-right:10px;">
			<input type="text" id="search_user" name="search_user" style="padding:3px; width:490px; -moz-border-radius: 2px; border-radius: 2px; box-shadow: 0px 1px 1px #666; border: 1px solid #ddd; font-size:11px; color:#666;" />
		</div>
	</div>
	
	<table id="userlist">
		<tr>	
			<th>Product ID</th>
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>
			<th style="text-align:justify;">&nbsp;<input type="checkbox" class="delete_productlist" id="delete_productlist" name="delete_all" ></th>
		</tr>
		<?php
		$this->query("SELECT * FROM product", $this->ERROR_QUERY);
		foreach($this->result_to_object() as $r) {						
			$i=0;
			echo ($i%2==0) ? '<tr style="background-color:#f1f1f1;">' : '<tr style="background-color:#ddd;">';
			echo '<td>'.$r->p_id.'</td>';
			if(strlen($r->p_name) > 20) {
				$name = substr($r->p_name,0,25);
				echo '<td><a href="'.SERVER_URL.'?product&id='.$r->p_id.'">'.$name.'...</a></td>';
			} else {
				echo '<td><a href="'.SERVER_URL.'?product&id='.$r->p_id.'">'.$r->p_name.'</a></td>';
			}				
			if(strlen($r->p_desc) > 25) {
				$desc = substr($r->p_desc,0,25);
				echo '<td>'.$desc.'...</td>';
			} else {
				echo '<td>'.$r->p_desc.'</td>';
			}
			echo '<td style="text-align:justify;">$.'.$r->p_price.'.00</td>';
			echo '<td><input type="checkbox" class="delete_product" id="delete_product" name="delete_list" ></td>';
			echo '</tr>';
			$i++;									
		}
	
		?>
	</table>
</div>
<?php include('template/content_bottom.php'); ?>			
		