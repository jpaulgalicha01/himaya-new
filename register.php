<?php
include "config/security.php";
include 'includes/autoload.inc.php';
include 'includes/header.php';
?>
    <body class="banner-login" >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 my-5">
                                <a href="index.php">
                                    <img src="images/himaya-logo-circle.png" width="80" height="80" class="position-absolute top-0 start-50 translate-middle-x" style="z-index:9999">
                                </a>
                                <div class="card shadow-lg border-0 rounded-lg" style="background-color: rgba(255, 255, 255, 0.7);">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registration Form</h3></div>
                                    <div class="card-body">
                                        <form id="create_acc" enctype="multipart/form-data">
                                            <input type="hidden" name="function" value="create_acc">
                                            <h5>Personal Information</h5>
                                            <div class="mb-3">
                                              <label for="formFile" class="form-label">Profile Image: </label>
                                              <input class="form-control" type="file" id="formFile" name="acc_img" accept=".png, .jpg" required/>
                                            </div>
                                            <div class="mb-3">
                                              <label for="formFile1" class="form-label">Valid ID: </label>
                                              <input class="form-control" type="file" id="formFile1" name="valid_id_img" accept=".png, .jpg" required/>
                                            </div>
                                            <div class="row d-flex py-2">
                                                <div class="col-xl-4 col-lg-4 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="fnmae" name="acc_fname" type="text" placeholder="First Name" required/>
                                                        <label for="fnmae">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="mname" name="acc_mname" type="text" placeholder="Middle Name" required/>
                                                        <label for="mname">Middle Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="lname" name="acc_lname" type="text" placeholder="Last Name" />
                                                        <label for="lname">Last Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row d-flex py-2">
                                                <div class="col-xl-4 col-lg-4 col-12">
                                                    <div class="form-floating mb-3">
                                                       <input class="form-control" id="lname" name="street" type="text" placeholder="Street Address" />
                                                        <label for="lname">Street Address</label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 col-12">
                                                    <div class="form-floating mb-3">
                                                       <select class="form-select" id="address" name="brgy" required>
                                                           <option selected disabled value="">---Please Select---</option>
                                                            <option>Aguisan</option>
                                                            <option>Buenavista</option>
                                                            <option>Cabadiangan</option>
                                                            <option>Cabanbanan</option>
                                                            <option>Carabalan</option>
                                                            <option>Caradio-an</option>
                                                            <option>Libacao</option>
                                                            <option>Mambagaton</option>
                                                            <option>Nabali-an</option>
                                                            <option>Mahalang</option>
                                                            <option>San Antonio</option>
                                                            <option>Sara-et</option>
                                                            <option>Su-ay</option>
                                                            <option>Talaban</option>
                                                            <option>To-oy</option>
                                                            <option value="I (Poblacion)">Barangay I (Poblacion)</option>
                                                            <option value="II (Poblacion)">Barangay II (Poblacion)</option>
                                                            <option value="III (Poblacion)">Barangay III (Poblacion)</option>
                                                            <option value="IV (Poblacion)">Barangay IV (Poblacion)</option>
                                                       </select>
                                                       <label for="address">Barangay</label>
                                                    </div>
                                                </div>
                                                
                                                 
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="birth" type="date" name="acc_birth" placeholder="Birthdate" required/>
                                                <label for="birth">Birthdate</label>
                                            </div>
                                            <div class="input-group mb-3">
                                              <span class="input-group-text bg-light">09</span>
                                              <input type="tel" class="form-control" name="acc_phone" placeholder="Phone Number" pattern="[0-9]{9}">
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" name="acc_email" type="email" placeholder="Email Address" required/>
                                                <label for="email">Email Address</label>
                                            </div>
                                            <h5>Account Information</h5>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="unmae" name="acc_uname" type="text" placeholder="Username" required/>
                                                <label for="unmae">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="pass" name="acc_pass" type="password" placeholder="Password" required/>
                                                <label for="pass">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-dark form-control" id="create_acc_btn">Create Account</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php" class="links">Have an account? Go to login</a></div>
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
        <script type="text/javascript" src="js/create_ajax.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
