<?php
include 'includes/autoload.inc.php';

$prodID ="";

if(isset($_GET['type_product']) && $_GET['function']=="fetching_carrier_product"){
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
	$res = $fetch_trade_product->fetchCarrierPoduct($type_product);
	if($res->rowCount()>0){
		while ($row = $res->fetch()) {
			$prodID = $row['prod_id'];
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
                    <td class="text-center">
						<select class="form-select form-select-sm text-center" id="prod_availability">
							<?php
								if($row['product_availability'] == "Availble" ){
									?>
										<option value="Availble" selected>Availble</option>
										<option value="Not Availble">Not Availble</option>
									<?php
								}else{
									?>
										<option value="Availble">Availble</option>
										<option value="Not Availble" selected>Not Availble</option>
									<?php
								}
							?>
							
						</select>
					</td>
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

<script>
	var prod_id = "<?=$prodID?>";

	$(document).ready(function(){
		$("#prod_availability").change(function(){
			var prod_availability = $(this).val();

			var check = confirm("Do you want to change this ?");

			if(check != true)
				return;

			// alert(prod_id);
			$.post("inputConfig.php",{prod_id:prod_id, prod_availability:prod_availability, function:"change_available"}, function(data,status){
				// console.log("Succes");
				window.location.reload();
			});

		});
	});
</script>