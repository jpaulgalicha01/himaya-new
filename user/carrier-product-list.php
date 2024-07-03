<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
$_SESSION['title'] = "Carrier Vehicle";

include 'includes/header.php';

?>
<main>
	<div class="container-fluid px-4">
        <h1 class="mt-4">Carrier Vehicle List</h1>
        <br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of Carrier Vehicle
            </div>
            <div class="card-body">
            	<div class="d-flex justify-content-start">
            		<div class="col-3 pb-3">
            			<label for="type_product">Type of Carrier Vehicle :</label>
	            		<select class="form-select" id="type_product">
		            		<option selected>All</option>
                            <option>Trucks</option>
		            		<option>Vans</option>
		            		<option>Tricycles</option>
		            	</select>
	            	</div>
            	</div>
            	<div class="table-responsive">
                    <table class="table table-light table-striped"  id="result">

                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="update_avail_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal-show">

  </div>
</div>

<script>
    $(document).ready(function(){
        $("#type_product").change(function(){
            var type_product = $(this).val();
            // alert(value);    

            $.ajax({
                type:"GET",
                url:"fetchCarrierProductList.php",
                data:{type_product:type_product, function:"fetching_carrier_product"},
                success:function(response){
                    $("#result").html(response);
                }
            })
        });
        $("#type_product").trigger("change");
    });

    $(document).on('click','#edit_img',function(){
        var value = $(this).val();
        // alert(value);
        $.ajax({
            type:"GET",
            url:"fetchingImg.php",
            data:{value:value, function:"fetching_img"},
            success:function(response){
                $("#update_avail_product").modal("show");
                $("#modal-show").html(response);
            }
        });
    });
</script>
<?php
include 'includes/footer.php';
?>
