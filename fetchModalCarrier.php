<?php
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['prod_id']) && $_POST['function'] == "view_products"){
		$prod_id = $_POST['prod_id'];
		?>

		<div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Carrier Details</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <div class="container">
	        		<?php
    					$view_product = new fetch();
        				$res_view_product = $view_product->viewProduct($prod_id);

        				if($res_view_product->rowCount()==1){
        					$fetch_info = $res_view_product->fetch();
        					?>
        					<div class="row">
					        		<div class="col-xl-4 col-lg-4 col-md-12 col-12 text-center">
					        			<img src='uploads/<?=$fetch_info['product_image']?>' width='220px' height='250px'>
					        		</div>
					        		<div class="col-xl-8 col-lg-8 col-md-12 col-12 shadow-sm rounded">
					        			<div class="py-2">
					        				<h4>Owner of Product</h4>
					        				<h6 class="mb-0">Name: </h6><?=$fetch_info['product_post_name']?>
					        				<h6 class="mb-0">Carrier Capacity: </h6><?=$fetch_info['carrier_cap']?>
					        				<h6 class="mb-0">Contact:</h6><?=$fetch_info['product_contact']?>
					        				<h6 class="mb-0">Address:</h6><?=$fetch_info['product_address']?>
					        				<h6 class="mb-0">Standardize:</h6><?=$fetch_info['carrier_standardize']?>
					        				<h6 class="mb-0">Status: 
												<?php
													if($fetch_info['product_availability'] == "Not Availble"){
														?>
															<span class="bg-danger px-1 text-white rounded"><?=$fetch_info['product_availability']?></span></h6>
														<?php
													}

													else{

													?>
														<span class="bg-success px-1 text-white rounded"><?=$fetch_info['product_availability']?></span></h6>
													<?php 
													}
												?>
												
					        			</div>
					        		</div>
					        		<div class="col-12 mt-3">
					        			<p>Pictures:</p>
					        			<div class="row mt-2">
					        				<?php
					        					$img_rand_id = $fetch_info['prod_rand_id'];
					        					$fetch_img_id = new fetch();
					        					$res_fetch_img_id = $fetch_img_id->fetchImg($img_rand_id);

					        					if($res_fetch_img_id->rowCount()>0){
					        						while($fetch_img = $res_fetch_img_id->fetch()){
													?>
					        							<div class="col-xl-3 col-lg-3 col-md-6 col-12 py-xl-2 py-lg-2 py-md-3 py-3 text-xl-start text-lg-start text-md-start text-center">
								        					<img src="uploads/<?=$fetch_img['img_name']?>" width="170px" height="150px">
								        				</div>
					        						<?php
													}
					        					}
					        				?>
					        				
					        			</div>
					        		</div>
					        </div>

        					<?php
        				}
	        		?>
		        	
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>

		<?php
	}else{
		ob_end_flush(header("Location: index.php"));
	}
}else{
	return false;
}
?>