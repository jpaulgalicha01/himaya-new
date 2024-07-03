<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
$_SESSION['title'] = "Profile";

include 'includes/header.php';

?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-3">User Information</h1>
        <div class="row">
        	<div class="col-xl-4 col-lg-4 col-12 pb-xl-0 pb-lg-0 pb-4">
        		<div class="text-center py-2">
        			<img src="../uploads/<?=$user_profile?>" width="250" height="250">
        		</div>
        		<div id="change_prof" class="d-none">
        			<form action="inputConfig.php" method="POST" enctype="multipart/form-data">
        				<input type="hidden" name="function" value="change_profile">
        				<div class="mb-3">
						  <input class="form-control" type="file" name="change_img" accept=".png, .jpg, .jpeg, .svg">
						</div>
						<button type="submit" class="btn btn-primary form-control" name="change_profile">Save Changes</button>
        			</form>
        		</div>
        		<button class="btn btn-primary form-control" id="change_prof_btn">Change Profile</button>
        	</div>
        	<div class="col-xl-8 col-lg-8 col-12">
        		<div class="shadow p-3 mb-5 bg-body-tertiary rounded">
        			<p class="fs-4">Personal Information</p>
        			<form action="inputConfig.php" method="POST">
        				<input type="hidden" name="function" value="update_info">
        				<div class="row d-flex py-2">
                            <div class="col-xl-4 col-lg4 col-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="fnmae" name="acc_fname" type="text" placeholder="First Name" value="<?=$user_fname?>" />
                                    <label for="fnmae">First Name</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg4 col-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="mname" name="acc_mname" type="text" placeholder="Middle Name" value="<?=$user_mname?>" />
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg4 col-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="lname" name="acc_lname" type="text" placeholder="Last Name" value="<?=$user_lname?>" />
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="address" name="acc_address" type="text" placeholder="Address" value="<?=$user_address?>" required/>
                            <label for="address">Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="birth" type="date" name="acc_birth" placeholder="Birthdate"  value="<?=$user_birth?>"required />
                            <label for="birth">Birthdate</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phonenum" type="tel" name="acc_phone" placeholder="Phone Number"  pattern="{0-9}[11]" value="<?=$user_phone?>" required/>
                            <label for="phonenum">Phone Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" name="acc_email" type="email" placeholder="Email Address" value="<?=$user_email?>" required/>
                            <label for="email">Email Address</label>
                        </div>
                        <h5>Account Information</h5>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="unmae" name="acc_uname" type="text" placeholder="Username" value="<?=$user_uname?>"required/>
                            <label for="unmae">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="pass" name="curr_pass" type="password" placeholder="Password"/>
                            <label for="pass">Current Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="pass" name="new_pass" type="password" placeholder="Password"/>
                            <label for="pass">New Password</label>
                        </div>
                        <button class="btn btn-primary" type="submit" name="update_info">Save</button>
        			</form>
        		</div>
        	</div>
        </div>
    </div>
</main>
<script type="text/javascript">
	$(document).on('click','#change_prof_btn',function(){
		$("#change_prof_btn").addClass("d-none");
		$("#change_prof").removeClass("d-none");
	})
</script>
<?php
include 'includes/footer.php';
?>
