<?php
include 'includes/autoload.inc.php';
unset($_SESSION['title']);
$_SESSION['title'] = "User List Account";

include 'includes/header.php';
?>
<main>
	<div class="container-fluid px-4">
        <h1 class="mt-4">User List</h1>
        <br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of user account
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Birthdate</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    <tbody>
                            <?php
                            $fetch_user_acc = new fetch();
                            $res = $fetch_user_acc->fetchUserAcc();
                            if($res->rowCount()){
                                while ($row = $res->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?=$row['acc_fname']." ".$row['acc_mname']." ".$row['acc_lname']?></td>
                                            <td><?=$row['acc_email']?></td>
                                            <td><?=$row['acc_address']?></td>
                                            <td><?=date("M-d-Y",strtotime($row['acc_birth']))?></td>
                                            <td><?=$row['acc_phone']?></td>
                                            <td><?=$row['acc_status']?></td>
                                            <?php
                                                switch ($row['acc_status']) {
                                                    case 'Declined':
                                                        ?>
                                                            <td class="text-center">
                                                                <a href="inputConfig.php?delete_user=<?=$row['acc_rand_id']?>" onclick=" return alert('Are you sure want delete this?')" class="btn btn-danger btn-sm" title="Delete"><i class="fa-solid fa-trash fa-xs" style="color: #ffffff;"></i></a>
                                                            </td>
                                                        <?php
                                                        break;

                                                    case 'Accept':
                                                        ?>
                                                            <td class="text-center">
                                                                <button class="btn btn-success btn-sm" title="View" id="view_user" value="<?=$row['acc_rand_id']?>"><i class="fa-regular fa-eye fa-xs" style="color: #ffffff;"></i></button>
                                                            </td>
                                                        <?php
                                                        break;
                                                    
                                                    default:
                                                        ?>
                                                            <td class="text-center">
                                                                <div class="d-flex py-1">
                                                                     <a href="inputConfig.php?declined_user=<?=$row['acc_rand_id']?>" class="btn btn-danger btn-sm mx-1" title="Declined"><i class="fa-solid fa-xmark fa-xs" style="color: #ffffff;"></i></a>
                                                                <a href="inputConfig.php?accept_user=<?=$row['acc_rand_id']?>" class="btn btn-success btn-sm mx-1" title="Accept"><i class="fa-solid fa-check fa-xs" style="color: #ffffff;"></i></a>
                                                                <button class="btn btn-success btn-sm mx-1" title="View" id="view_user" value="<?=$row['acc_rand_id']?>"><i class="fa-regular fa-eye fa-xs" style="color: #ffffff;"></i></button>
                                                                </div>
                                                            </td>
                                                        <?php
                                                        break;
                                                }
                                            ?>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo "<tr><td colspan='7' class='text-center'>No Data Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="view_user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">View User Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="inputConfig.php" method="POST">
        <input type="hidden" name="function" value="delete_user_acc">
        <input type="hidden" name="user_id" id="user_id">
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-12 text-center py-xl-0 py-lg-0 py-md-0 py-3">
                    <div id="user_profile"></div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                    <h5>Personal Information</h5>
                    <label for="full_name">Name: </label>
                    <p class="mb-1 view-user-modal" id="full_name"></p>
                    <label for="address">Barangay: </label>
                    <p class="mb-1 view-user-modal" id="address"></p>
                    <label for="birthdate">Birth of Date: </label>
                    <p class="mb-1 view-user-modal" id="birthdate"></p>
                    <label for="phone_number">Contact Number: </label>
                    <p class="mb-1 view-user-modal" id="phone_number"></p>
                    <label for="email_address">Email Address: </label>
                    <p class="mb-1 view-user-modal" id="email_address"></p>
                    <label for="email_address">ID Photo: </label>
                    <div id="idPhoto"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" name="delete_user_acc">Delete User Account</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).on("click","#view_user",function(){
        var value = $(this).val();
        // alert(value);
        $.ajax({
            type:"POST",
            url:"inputConfig.php",
            data:{value:value, function:"view_user"},
            success:function(response){
                var res = jQuery.parseJSON(response);
                if(res.status == 200){
                    $("#view_user_modal").modal("show");
                    $("#user_id").val(res.data['acc_rand_id']);
                    $("#user_profile").html("<img src='../uploads/"+res.data['acc_profile']+"' width='130px' height='150px' />");
                    $("#full_name").text(res.data['acc_fname']+" "+res.data['acc_mname']+" "+res.data['acc_lname']);
                    $("#address").text(res.data['acc_address']);
                    $("#birthdate").text(res.data['acc_birth']);
                    $("#phone_number").text(res.data['acc_phone']);
                    $("#email_address").text(res.data['acc_email']);
                    $("#idPhoto").html("<a href='../uploads/"+res.data['acc_valid_id']+ "' target='__blank'><u>View Here!</u></a>");
                }
            }
        })
    });
</script>


<?php
include 'includes/footer.php';
?>