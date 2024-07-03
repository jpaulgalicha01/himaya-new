<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container-fluid">
	<div class="row">
	  <div class="col-xl-2 col-lg-2 col-md-2 col-3">
	    <div id="simple-list-example" class="d-flex flex-column gap-2 simple-list-example-scrollspy ">
		<div class="d-lg-block d-none">
			<a href="index.php"><img src="images/himaya-logo.png" width="90%" style="height:100%; max-height:150px;"></a>	
		</div>
	      <h3>Categories</h3>
	      <h6>Carrier</h6>
	      <a class="p-1 links" href="#trucks">Trucks</a>
	      <a class="p-1 links" href="#vans">Vans</a>
	      <a class="p-1 links" href="#tricyles">Tricyles</a>
	    </div>
	  </div>
	  <div class="col-xl-10 col-lg-10 col-md-10 col-9">
	    <div data-bs-spy="scroll" data-bs-target="#simple-list-example" data-bs-offset="0" data-bs-smooth-scroll="true" class="scrollspy-example px-4" tabindex="0" style="height: auto; max-height:555px; min-height:560px; width: auto; overflow-y: scroll;">
	      <h5 id="trucks">*Trucks*</h5>
	      	<div class="row">
		      	<?php
			      		$fetch_carrier_trucks = new fetch();
			      		$res_truckss = $fetch_carrier_trucks->fetchCarrierTrucks();

			      		if($res_truckss->rowCount()>0){
			      				while ($row_trucks = $res_truckss->fetch()) {
			      				?>
						      		<div class="col-xl-3 col-lg-3 col-md-4 col-12 py-xl-2 py-lg-2 py-md-3 py-3" style="cursor: pointer;">
												<div class="card p-2 d-flex zoom">
													<img data-src="uploads/<?=$row_trucks['product_image']?>" width="130" style="height:auto;min-height: 150px;"class="align-self-center lazy-load">
													<hr>	
													<div class="card-body">
														<h5 class="card-title"><?=$row_trucks['product_name']?></h5>
														<button type="button" class="btn btn-danger btn-sm" id="prod_id" value="<?=$row_trucks['prod_id']?>">See more..</button>
													</div>
												</div>
											</div>
			      				<?php
			      			}
			      		}
			      	?>
					</div>

	      <h5 id="vans">*Vans*</h5>
	      	<div class="row">
		      	<?php
			      		$fetch_carrier_vans = new fetch();
			      		$res_vans = $fetch_carrier_vans->fetchCarrierVans();

			      		if($res_vans->rowCount()>0){
			      				while ($row_vans = $res_vans->fetch()) {
			      				?>
						      		<div class="col-xl-3 col-lg-3 col-md-4 col-12 py-xl-2 py-lg-2 py-md-3 py-3" style="cursor: pointer;">
												<div class="card p-2 d-flex zoom">
													<img data-src="uploads/<?=$row_vans['product_image']?>" width="130" style="height:auto;min-height: 150px;"class="align-self-center lazy-load">
													<hr>	
													<div class="card-body">
														<h5 class="card-title"><?=$row_vans['product_name']?></h5>
														<button type="button" class="btn btn-danger btn-sm" id="prod_id" value="<?=$row_vans['prod_id']?>">See more..</button>
													</div>
												</div>
											</div>
			      				<?php
			      			}
			      		}
			      	?>
					</div>	      
	      	
	      <h5 id="tricyles">*Tricyles*</h5>
	      	<div class="row">
		      	<?php
			      		$fetch_carrier = new fetch();
			      		$res = $fetch_carrier->fetchCarrierTricycle();

			      		if($res->rowCount()>0){
			      				while ($row = $res->fetch()) {
			      				?>
						      		<div class="col-xl-3 col-lg-3 col-md-4 col-12 py-xl-2 py-lg-2 py-md-3 py-3" style="cursor: pointer;">
												<div class="card p-2 d-flex zoom">
													<img data-src="uploads/<?=$row['product_image']?>" width="130" style="height:auto;min-height: 150px;"class="align-self-center lazy-load">
													<hr>	
													<div class="card-body">
														<h5 class="card-title"><?=$row['product_name']?></h5>
														<button type="button" class="btn btn-danger btn-sm" id="prod_id" value="<?=$row['prod_id']?>">See more..</button>
													</div>
												</div>
											</div>
			      				<?php
			      			}
			      		}
			      	?>
					</div>
	      	
	    </div>
	  </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="view_modal">

  </div>
</div>

<script>
	$(function() {
          $('.lazy-load').lazy({
		        beforeLoad: function(element) {
		            var imageSrc = element.data('src');
		            console.log('image "' + imageSrc + '" is about to be loaded');
		        },
		        scrollDirection: 'vertical',
		        effect: "fadeIn",
		        effectTime: 1000,
		        threshold: 0
			    });
    });

	$(document).on("click","#prod_id",function(){
		var prod_id = $(this).val();
		// alert(prod_id);
		$.ajax({
			type:"POST",
			url: "fetchModalCarrier.php",
			data: {prod_id:prod_id, function:"view_products"},
			success:function(response){
				$("#viewProduct").modal("show");
				$("#view_modal").html(response);
			}
		});
	});
</script>

<?php
include 'includes/footer.php';
?>