<?php
// include "config/security.php";
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_REQUEST['create_acc']) && $_REQUEST['function'] == "create_acc"){
        $acc_fname = secured($_POST['acc_fname']);
        $acc_mname = secured($_POST['acc_mname']);
        $acc_lname = secured($_POST['acc_lname']);
        $acc_lname = secured($_POST['acc_lname']);
        $street = secured($_POST['street']);
        $brgy = secured($_POST['brgy']);
        $acc_address = $street.", Brgy. ".$brgy.", Himamaylan City";
        $acc_birth = secured($_POST['acc_birth']);
        $acc_phone = secured($_POST['acc_phone']);
        $acc_email = secured($_POST['acc_email']);
        $acc_uname = secured($_POST['acc_uname']);
        $acc_pass = secured($_POST['acc_pass']);

        $create_acc = new insert();
        $create_acc->createAcc($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$acc_pass);

    }elseif(isset($_POST['acc_login']) && $_POST['function'] == "acc_login"){
        $acc_uname = secured($_POST['acc_uname']);
        $acc_pass = secured($_POST['acc_pass']);

        $acc_login = new fetch();
        $acc_login->accLogin($acc_uname,$acc_pass);
    }elseif(isset($_POST['verify_otp']) && $_POST['function'] == "verify_otp"){
        $user_id = secured($_POST['user_id']);
        $otp_code = secured($_POST['otp_code']);

        $verify_otp = new fetch();
        $verify_otp->verifyOtp($user_id,$otp_code);
    }elseif(isset($_POST['prod_id']) && $_POST['function']=="view_products"){
        $prod_id = $_POST['prod_id'];

        $view_product = new fetch();
        $view_product->viewProduct($prod_id);
    }elseif(isset($_POST['reset_pass']) && secured($_POST['function'] == "reset_pass")){
        $email = secured($_POST['email']);

        $reset_pass = new update();
        $reset_pass->resetPass($email);
    }elseif(isset($_POST['submit_otp']) && secured($_POST['function'] == "submit_otp_reset_pass")){
        $user_id = secured($_POST['user_id']);
        $otp_code = secured($_POST['otp_code']);

        $submit_otp = new fetch();
        $submit_otp->submitOtp($user_id,$otp_code);
    }elseif(isset($_POST['change_pass']) && secured($_POST['function'] == "change_pass")){
        $user_id_new_pass = secured($_POST['user_id_new_pass']);
        $new_pass = secured($_POST['npass']);

        $change_pass = new update();
        $change_pass->changePass($user_id_new_pass,$new_pass);
    }else{  
        ob_end_flush(header("Location: login.php"));
    }
}else{
    return false;
}
?>