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
	      <h6>Trade</h6>
	      <a class="p-1 links" href="#vegetables">Vegetables</a>
	      <a class="p-1 links" href="#poultry">Poultry</a>
	      <a class="p-1 links" href="#other_items">Other items</a>
	    </div>
	  </div>
	  <div class="col-xl-10 col-lg-10 col-md-10 col-9">
	    <div data-bs-spy="scroll" data-bs-target="#simple-list-example" data-bs-offset="0" data-bs-smooth-scroll="true" class="scrollspy-example px-4" tabindex="0" style="height: 100%; min-height: 555px; max-height:560px; max-height:auto; width: auto; overflow-y: scroll;">
	      <h5 id="vegetables">*Vegetables*</h5>
	      	<div class="row">
			      	<?php
			      		$fetch_trade_vege = new fetch();
			      		$res_vege = $fetch_trade_vege->fetchTradeVegetables();

			      		if($res_vege->rowCount()>0){
			      				while ($row_vege = $res_vege->fetch()) {
			      				?>
						      		<div class="col-xl-3 col-lg-3 col-md-4 col-12 py-xl-2 py-lg-2 py-md-3 py-3" style="cursor: pointer;">
												<div class="card p-2 d-flex zoom">
													<img data-src="uploads/<?=$row_vege['product_image']?>" width="130" style="height:auto;min-height: 150px;"class="align-self-center lazy-load">
													<hr>	
													<div class="card-body">
														<h5 class="card-title"><?=$row_vege['product_name']?></h5>
														<button type="button" class="btn btn-danger btn-sm" id="prod_id" value="<?=$row_vege['prod_id']?>">See more..</button>
													</div>
												</div>
											</div>
			      				<?php
			      			}
			      		}
			      	?>
	      	</div>
	      <h5 id="poultry">*Poultry*</h5>
	      	<div class="row">
			      	<?php
			      		$fetch_trade_poul = new fetch();
			      		$res_poul = $fetch_trade_poul->fetchTradePoultry();

			      		if($res_poul->rowCount()>0){
			      				while ($row_poul = $res_poul->fetch()) {
			      				?>
						      		<div class="col-xl-3 col-lg-3 col-md-4 col-12 py-xl-2 py-lg-2 py-md-3 py-3" style="cursor: pointer;">
												<div class="card p-2 d-flex zoom">
													<img data-src="uploads/<?=$row_poul['product_image']?>" width="130" style="height:auto;min-height: 150px;"class="align-self-center lazy-load">
													<hr>	
													<div class="card-body">
														<h5 class="card-title"><?=$row_poul['product_name']?></h5>
														<button type="button" class="btn btn-danger btn-sm" id="prod_id" value="<?=$row_poul['prod_id']?>">See more..</button>
													</div>
												</div>
											</div>
			      				<?php
			      			}
			      		}
			      	?>
	      	</div>
	      <h5 id="other_items">*Other Items*</h5>
	      	<div class="row">
			      	<?php
			      		$fetch_trade_other_item = new fetch();
			      		$res_other_item = $fetch_trade_other_item->fetchTradeOtherItems();

			      		if($res_other_item->rowCount()>0){
			      				while ($row_other_items = $res_other_item->fetch()) {
			      				?>
						      		<div class="col-xl-3 col-lg-3 col-md-4 col-12 py-xl-2 py-lg-2 py-md-3 py-3" style="cursor: pointer;">
												<div class="card p-2 d-flex zoom">
													<img data-src="uploads/<?=$row_other_items['product_image']?>" width="130" style="height:auto;min-height: 150px;"class="align-self-center lazy-load">
													<hr>	
													<div class="card-body">
														<h5 class="card-title"><?=$row_other_items['product_name']?></h5>
														<button type="button" class="btn btn-danger btn-sm" id="prod_id" value="<?=$row_other_items['prod_id']?>">See more..</button>
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
  <div class="modal-dialog modal-lg" id="show_modal">
    
  </div>
</div>


<script type="text/javascript">

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
			url: "fetchModalTrade.php",
			data: {prod_id:prod_id, function:"view_products"},
			success:function(response){
				$("#viewProduct").modal("show");
				$("#show_modal").html(response);
			}
		});
	});
</script>
<?php
include 'includes/footer.php';
?>