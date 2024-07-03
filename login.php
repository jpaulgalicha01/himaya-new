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
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Welcome Himamaylanon!</h3></div>
                                    <div class="card-body">
                                        <form id="login" >
                                            <input type="hidden" name="function" value="acc_login">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="acc_uname" type="text" placeholder="Username" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="acc_pass" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="showPass" type="checkbox" value="" />
                                                <label class="form-check-label" for="showPass">Show Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small links" href="forgot-password.php">Forgot Password?</a>
                                                <button class="btn btn-dark" type="submit" id="login_btn">Login</button>
                                            </div>
                                        </form>
                                        <form id="verify_otp" class="d-none">
                                            <input type="hidden" name="function" value="verify_otp">
                                            <input type="hidden" name="user_id" id="user_id">
                                            <p class="small">Successfully Sent OTP CODE (<span id="email"></span>)</p>
                                            <div class="form-floating mb-2">
                                                <input class="form-control" id="inputOTPCODE" name="otp_code" type="text" placeholder="OTP CODE" />
                                                <label for="inputOTPCODE">OTP CODE</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                                
                                                <button class="btn btn-dark" type="submit" id="otp_btn">Submit OTP Code</button>
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
        <script type="text/javascript" src="js/login_ajax.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" defer></script>
        <script src="js/scripts.js" defer></script>
    </body>
</html>
