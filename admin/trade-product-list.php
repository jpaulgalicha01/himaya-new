<?php
include 'includes/autoload.inc.php';
unset($_SESSION['title']);
$_SESSION['title'] = "Trade Products";

include 'includes/header.php';
?>
<main>
	<div class="container-fluid px-4">
        <h1 class="mt-4">Trade Products</h1>
        <br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of Product
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-start">
                    <div class="col-xl-3 col-lg-3 col-12 pb-3 m-2">
                        <label for="type_product">Type of Product :</label>
                        <select class="form-select" id="type_product">
                            <option selected>All</option>
                            <option>Vegetables</option>
                            <option>Poultry</option>
                            <option>Other Items</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-12 pb-3 m-2">
                        <label for="product_status">Status of Product :</label>
                        <select class="form-select" id="product_status">
                            
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-light table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Image</th>
                                <th>User</th>
                                <th>Product Name</th>
                                <th>Product Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal View Product Information -->
<div class="modal fade" id="view_product_modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="inputConfig.php" method="POST">
            <input type="hidden" name="function" value="update_prod_status">
            <input type="hidden" name="prod_id" id="prod_id_num">
            <div class="py-2">
                <label>Owner Product:</label>
                <input type="text" id="owner" class="form-control" disabled>
            </div>
            <div class="py-2">
                <label>Product Type:</label>
                <input type="text" id="prod_type" class="form-control" disabled>
            </div>
            <div class="py-2">
                <label>Product Name:</label>
                <input type="text" id="prod_name" class="form-control" disabled>
            </div>
            <div class="py-2">
                <label>Address:</label>
                <input type="text" id="prod_address" class="form-control" disabled>
            </div>
            <div class="py-2">
                <label>Contact Number:</label>
                <input type="text" id="prod_contact" class="form-control" disabled>
            </div>
            <div class="py-2">
                <label>Expected Trade:</label>
                <input type="text" id="prod_expected_trade" class="form-control" disabled>
            </div>
            <div class="py-2">
                <label>Product Expected Date:</label>
                <input type="text" id="prod_duration_date" class="form-control" disabled>
            </div>
            <div class="py-2">
                <label>Status:</label>
                <select class="form-select" name="status_prod" id="status_prod">
                    <option>Accept</option>
                    <option>Decline</option>
                    <option>Pending</option>
                </select>
            </div>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            <button type="submit" class="btn btn-success" name="update_prod_status">Update</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
    $("#type_product").change(function(){
      const value = document.getElementById("type_product").value;
      // alert(value);

      $.ajax({
        type:"POST",
        url: "fetchStatusTradeProd.php",
        data:{value:value, function:"fetch_status"},
        success:function(response){
          $("#product_status").html(response);
        }
      })

    });
    $("#type_product").trigger("change");
  });

    $(document).on("click","#view_product",function(){
        var prod_id = $(this).val();
        // alert(prod_id);
        $.ajax({
            type:"GET",
            url: "inputConfig.php?prod_id=" + prod_id,
            success:function(fetch){
                var res = jQuery.parseJSON(fetch);
                if(res.status == 200){
                    $("#view_product_modal").modal("show");
                    $("#prod_id_num").val(res.data.prod_id);
                    $("#owner").val(res.data.product_post_name);
                    $("#prod_type").val(res.data.product_type);
                    $("#prod_name").val(res.data.product_name);
                    $("#prod_address").val(res.data.product_address);
                    $("#prod_contact").val(res.data.product_contact);
                    $("#prod_expected_trade").val(res.data.trade_expected_trade);
                    $("#prod_duration_date").val(res.data.trade_duration_date);
                    $("#status_prod").val(res.data.product_status);
                }else{
                    console.log("There's Something Wrong");
                }
            }
        })
    });

</script>
<?php
    include 'includes/footer.php';
?>