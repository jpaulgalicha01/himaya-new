<?php
include "config/security.php";
include 'includes/autoload.inc.php';
include 'includes/header.php';
?>

<body class="banner-login">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 mt-5">
                            <a href="index.php">
                                <img src="images/himaya-logo-circle.png" width="80" height="80" class="position-absolute top-0 start-50 translate-middle-x" style="z-index:1">
                            </a>
                            <div class="card shadow-lg border-0 rounded-lg" style="background-color: rgba(255, 255, 255, 0.7);">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted" id="header">Enter your email address and we will send you a link to reset your password.</div>
                                    <form id="reset_pass">
                                        <input type="hidden" name="function" value="reset_pass">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small links" href="login.php">Return to login</a>
                                            <button class="btn btn-dark" type="submit" id="reset_pass_btn">Reset Pasword</button>
                                        </div>
                                    </form>
                                    <form id="submit_otp" class="d-none">
                                        <input type="hidden" name="function" value="submit_otp_reset_pass">
                                        <input type="hidden" name="user_id" id="user_id">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputOTPCODE" name="otp_code" type="text" placeholder="OTP CODE" />
                                            <label for="inputOTPCODE">OTP CODE</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small links" href="login.php">Return to login</a>
                                            <button class="btn btn-dark" type="submit" id="submit_otp_reset_pass_btn">Submit OTP Code</button>
                                        </div>
                                    </form>
                                    <form id="change_pass" class="d-none">
                                        <input type="hidden" name="function" value="change_pass">
                                        <input type="hidden" name="user_id_new_pass" id="user_id_new_pass">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="npass" type="password" name="npass" placeholder="New Password" required />
                                            <label for="npass">New Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="cpass" type="password" placeholder="Confirm Password" required />
                                            <label for="cpass">Confirm Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="showPass" type="checkbox" value="" />
                                            <label class="form-check-label" for="showPass">Show Password</label>
                                        </div>
                                        <small id="message"></small>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small links" href="login.php">Return to login</a>
                                            <button class="btn btn-dark" type="submit" name="change_pass" id="change_pass_btn">Change Pasword</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php" class="links">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">Copyright &copy; Himaya 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" defer></script>
    <script src="js/scripts.js" defer></script>
    <script type="text/javascript">

        function showpass(){
            if(this.checked){
                // alert("check");
                document.getElementById('npass').setAttribute('type','text')
                document.getElementById('cpass').setAttribute('type','text')
            }
            else{
                    // alert("ubcheck");
                    document.getElementById('npass').setAttribute('type','password')
                    document.getElementById('cpass').setAttribute('type','password')
                }
        }
        document.getElementById('showPass').addEventListener('click' , showpass);

        // Confirm Pass
        $("#npass, #cpass").on('keyup', function () {
            if ($("#npass").val() == "" && $("#cpass").val() == "") {
                $("#message").html("").css('color', 'green');
                document.getElementById('change_pass_btn').disabled = true;
            } else if ($("#npass").val() === $("#cpass").val()) {
                $("#message").html("Password Match").css('color', 'green');
                document.getElementById('change_pass_btn').disabled = false;
            } else {
                $("#message").html("Password Not Match").css('color', 'red');
                document.getElementById('change_pass_btn').disabled = true;
            }
        });

        // Sending OTP CODE
        $(document).on("submit","#reset_pass",function(e){
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("reset_pass",true);
            $("#reset_pass_btn").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div></div>");
            document.getElementById("reset_pass_btn").disabled = true;
            $.ajax({
                type: "POST",
                url: "inputConfig.php",
                data: formData,
                processData: false,
                contentType:false,
                success:function(response){
                    var res = jQuery.parseJSON(response);

                    if(res.status == 200){
                        $("#user_id").val(res.data.acc_rand_id);
                        $("#reset_pass").addClass("d-none");
                        $("#submit_otp").removeClass("d-none");
                        const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                        });
                        Toast.fire({
                          icon: res.icon,
                          title: res.message,
                        })
                    }else if(res.status == 302){
                        const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                        });
                        Toast.fire({
                          icon: "error",
                          title: res.message,
                        });
                         $("#reset_pass_btn").text("Reset Password");
                        document.getElementById("reset_pass_btn").disabled = false;
                    }else if(res.status == 404){
                        const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                        });
                        Toast.fire({
                          icon: "error",
                          title: res.message,
                        });
                         $("#reset_pass_btn").text("Reset Password");
                        document.getElementById("reset_pass_btn").disabled = false;
                    }
                }
            });
        });

        // Submit OTP CODE
        $(document).on("submit","#submit_otp",function(e){
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("submit_otp",true);

            $("#submit_otp_reset_pass_btn").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div></div>");
            document.getElementById("submit_otp_reset_pass_btn").disabled = true;

            $.ajax({
                type: "POST",
                url: "inputConfig.php",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    var res = jQuery.parseJSON(response);

                    if(res.status == 200){
                        $("#submit_otp").addClass("d-none");
                        $("#header").text("Enter your new passsword");
                        $("#change_pass").removeClass("d-none");
                        $("#user_id_new_pass").val(res.data.acc_rand_id);
                    }

                    if(res.status == 302){
                         const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                        });
                        Toast.fire({
                          icon: "error",
                          title: res.message,
                        });
                         $("#submit_otp_reset_pass_btn").text("Submit OTP CODE");
                        document.getElementById("submit_otp_reset_pass_btn").disabled = false;
                    }
                }
            })
        })

        // Change Pass
        $(document).on('submit','#change_pass',function(e){
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("change_pass",true);
            $("#change_pass_btn").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div></div>");
            document.getElementById("change_pass_btn").disabled = true;
            $.ajax({
                type: "POST",
                url: "inputConfig.php",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    var res = jQuery.parseJSON(response);

                    if(res.status == 200){
                        const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                        });
                        Toast.fire({
                          icon: "success",
                          title: "Change Password Account Successfully",
                          text: "Redirect to login page..",
                        }).then(()=>{
                            window.location.href=res.redirect;
                        });
                    }
                    if(res.status == 302){
                        const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                        });
                        Toast.fire({
                          icon: "error",
                          title: res.message,
                        });
                        $("#change_pass_btn").text("Changed Password");
                        document.getElementById("change_pass_btn").disabled = false;
                    }
                }
            })
        })
    </script>
    <!-- <script src="js/reset_pass_ajax.js" defer></script> -->
</body>
</html>
