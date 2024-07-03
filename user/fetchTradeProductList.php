<?php
include 'includes/autoload.inc.php';

if(isset($_GET['type_product']) && $_GET['function']=="fetching_trade_product"){
	$type_product = secured($_GET['type_product']);
	?>
	    <thead class="table-dark">
	        <tr>
	            <th class="text-center">Image</th>
	            <th>User</th>
	            <th>Product Name</th>
	            <th>Product Type</th>
	            <th>Status</th>
	            <th>Availability</th>
	            <th>Action</th>
	        </tr>
	    </thead>
	    <tbody>
	<?php
	$fetch_trade_product = new fetch();
	$res = $fetch_trade_product->fetchTradePoduct($type_product);
	if($res->rowCount()>0){
		while ($row = $res->fetch()) {
			?>

				<tr>
					<td class="text-center">
                        <a href="../uploads/<?=$row['product_image']?>" target="__blank">
                            <img src="../uploads/<?=$row['product_image']?>" width="30" height="30" />
                        </a>
                        
                    </td>
					<td><small><?=$row['product_post_name']?></small></td>
                    <td><small><?=$row['product_name']?></small></td>
                    <td><small><?=$row['product_type']?></small></td>
                    <td><small><?=$row['product_status']?></small></td>
                    <td><small><?=$row['product_availability']?></small></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" id="edit_img" value="<?=$row['prod_rand_id']?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <a href="inputConfig.php?delete_prod=<?=$row['prod_id']?>" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger btn-sm" id="view_product" value="<?=$row['prod_id']?>">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
				</tr>
			<?php
		}
	}else{
		echo"<tr><td colspan='7' class='text-center'>No Data Found</td></tr>";
	}
	?>
		</tbody>
	<?php

}else{
	ob_end_flush(header("Location: index.php"));
}
?>