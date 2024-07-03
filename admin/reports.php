<?php
include 'includes/autoload.inc.php';
unset($_SESSION['title']);
$_SESSION['title'] = "Reports Log";

include 'includes/header.php';
?>
<main>
    <div class="container-fluid px-4 ">
        <h1 class="mt-4 title">Reports Log</h1>
        <br>
        <div class="card mb-4 ">
             <div class="card-header ">
                <i class="fas fa-table me-1"></i>
                List of Reports
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-start gap-3" id="selection">
                    <div class="col-3 pb-3">
            			<label for="type_product">User :</label>
	            		<select class="form-select" id="userList">
		            		<option selected>All</option>
                            <?php
                            $fetch_user_acc = new fetch();
                            $res = $fetch_user_acc->fetchUserAcc();
                            if($res->rowCount()){
                                while ($row = $res->fetch()) {
                                    ?>
                                    <option value="<?=$row['acc_rand_id']?>"><?=$row['acc_fname']." ".$row['acc_mname']." ".$row['acc_lname']?></option>
                                    <?php
                                }
                            }
                            ?>
		            	</select>
	            	</div>
            		<div class="col-3 pb-3">
            			<label for="type_product">Catergories :</label>
	            		<select class="form-select" id="type_product">
                            <option selected>Trade</option>
		            		<option>Carrier</option>
		            	</select>
	            	</div>
                    <div class="col-3 pb-3">
            			<label for="type_product">Availability :</label>
	            		<select class="form-select" id="availability">
		            		<option selected>All</option>
                            <option>Available</option>
		            		<option value="2">Not Available</option>
		            	</select>
	            	</div>
            	</div>
                <div class="printableTable" style="width: 100%;">
                     <h4 class="print-title">List of Reports</h4>
                    <table class="table table-light table-striped " id="result">
                        
                    </table>  
                </div>
                
                <div class="text-end">
                    <button class="btn btn-success btn-sm" onclick="window.print()"><i class="fa-solid fa-print"></i></button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
 $(document).ready(function(){
    $("#selection").change(function(){

    $("#selection option:selected").each(async function(){
        const userList = document.getElementById("userList").value;
        const type_product = document.getElementById("type_product").value;
        const availability = document.getElementById("availability").value;
        // console.log(type_product + " "+ availability);

       await $.get('fetchReports.php',{userList:userList, type_product:type_product, availability:availability,function:"fetching_reports"},function(data){
            $("#result").html(data);
        })
        
    })    

    });
    $("#selection").trigger("change");
  });
</script>

<?php
    include 'includes/footer.php';
?>