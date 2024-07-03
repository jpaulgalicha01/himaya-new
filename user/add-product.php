<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
$_SESSION['title'] = "Add Product";

include 'includes/header.php';

?>

<main>
	<div class="container-fluid px-4">
		<div class="row">
			        <h1 class="mt-4" id="title">Add Product</h1>
        <br>
	        <div class="card mb-4">
	            <div class="card-header">
	                Information Of Product / Vehicle
	            </div>
	            <div class="card-body">
	            	<form action="inputConfig.php" method="POST" enctype="multipart/form-data">
	            		<input type="hidden" name="function" value="add_product">
	            		<label for="categories">Categories :</label>
	            		<select id="categories" class="form-select" name="categories_product">
	            			<option selected>Carrier</option>
	            			<option>Trade</option>
	            		</select>
	            		<div class="py-2">
						  <label for="formFile" class="form-label">Product Banner:</label>
						  <input class="form-control" type="file" name="product_image" id="formFile" accept=".jpg, .jpeg, .png" required>
	            		</div>
	            		<div class="py-2">
						  <label for="formFile" class="form-label">Product Images <small class="fst-italic">(select 2 or more pic.)</small>:</label>
						  <input class="form-control" type="file" name="product_images[]" multiple id="formFile" accept=".jpg, .jpeg, .png" required>
	            		</div>
	            		<div id="carrier">
	            			<div class="py-2">
	            				<label for="carrier_prod_type">Product Type:</label>
	            				<select class="form-select" name="product_type" id="carrier_prod_type">
	            					<option selected disabled value="">---Please Select---</option>
	            					<option>Trucks</option>
	            					<option>Vans</option>
	            					<option>Tricycles</option>
	            				</select>
	            			</div>
	            			<div class="py-2">
	            				<label>Brand Name:</label>
	            				<input type="text" name="carrier_product_name" id="carrier_name_prod" class="form-control" placeholder="ex. toyota, Bajaj, Samsung, Nokia, ect.." required />
	            			</div>
	            			<div class="py-2">
	            				<label>Capacity:</label>
	            				<input type="text" name="carrier_cap" id="carrier_cap" class="form-control" placeholder="lbs/Kgs." required />
	            			</div>
							<div class="py-2">
	            				<label>Standardize:</label>
	            				<select class="form-select" name="carrier_standard" id="carrier_prod_type">
	            					<option selected disabled value="">---Please Select---</option>
	            					<option>For Vegetables & Fruits Only</option>
	            					<option>For Farm Animals</option>
	            					<option>For All</option>
	            				</select>
	            			</div>
	            		</div>
	            		<div id="trade">
	        				<div class="py-2">
	        					<label for="carrier_prod_type">Product Type:</label>
		        				<select class="form-select" name="product_type" id="trade_prod_type">
		        					<option selected disabled value="">---Please Select---</option>
		        					<option>Vegetables</option>
		        					<option>Poultry</option>
		        					<option>Other Items</option>
		        				</select>
	        				</div>
	            			<div class="py-2">
	            				<label>Name of Product:</label>
	            				<input type="text" name="trade_product_name" id="trade_name" class="form-control" placeholder="ex. Clothes, Shoes, ect..">
	            			</div>
							<div class="py-2">
							<label>Date of Harvest:</label>
	            				<input type="date" name="trade_date_of_harvest" id="trade_date_of_harvest" class="form-control">
	            			</div>
							<div class="py-2">
							<label>Product Description:</label>
	            				<input type="text" name="trade_description" id="trade_description" class="form-control" placeholder="Product Information">
	            			</div>
	            			<div class="py-2">
	            				<label>Expected Product:</label>
	            				<input type="text" name="trade_expected_trade" id="trade_expected_trade" class="form-control" placeholder="ex. Prefer item want to trade.">
	            			</div>
	            			<div class="py-2">
	            				<label>Duration of Product:</label>
	            				<input type="date" name="trade_duration_date" id="trade_duration_date" class="form-control">
	            			</div>
	            		</div>
	            		 <button class="btn btn-success btn-sm" type="submit" name="add_product">Submit</button>
	            	</form>
	    		</div>
	    	</div>
		</div>
    </div>
</main>

<script>
	$(document).ready(function(){
		$("#categories").change(function(){
			var value = $(this).val();

			if(value == "Trade"){
				$("#title").text("Trade Product");
				$("#carrier").css("display","none");
				$("#trade").css("display","block");

				$("#trade_prod_type").attr("required", true);
				$("#trade_name").attr("required", true);
				$("#trade_expected_trade").attr("required", true);
				$("#trade_duration_date").attr("required", true);
				$("#trade_address").attr("required", true);
				$("#trade_phone").attr("required", true);
				$("#trade_date_of_harvest").attr("required", true);
				$("#trade_description").attr("required", true);

				$("#carrier_prod_type").attr("required", false);
				$("#carrier_name_prod").attr("required", false);
				$("#carrier_cap").attr("required", false);
				$("#carrier_address").attr("required", false);
				$("#carrier_phone").attr("required", false);
			}else{
				$("#title").text("Carrier Vehicle");

				$("#trade").css("display","none");
				$("#carrier").css("display","block");

				$("#trade_prod_type").attr("required", false);
				$("#trade_name").attr("required", false);
				$("#trade_expected_trade").attr("required", false);
				$("#trade_duration_date").attr("required", false);
				$("#trade_address").attr("required", false);
				$("#trade_phone").attr("required", false);
				$("#trade_date_of_harvest").attr("required", false);
				$("#trade_description").attr("required", false);

				$("#carrier_prod_type").attr("required", true);
				$("#carrier_name_prod").attr("required", true);
				$("#carrier_cap").attr("required", true);
				$("#carrier_address").attr("required", true);
				$("#carrier_phone").attr("required", true);
			}
		});
		$("#categories").trigger("change");
	});
</script>

<?php
include 'includes/footer.php';
?>
