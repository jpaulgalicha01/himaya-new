<?php
require_once '../PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "smtp.gmail.com"; // SMTP server example
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "himaya112401@gmail.com";  // SMTP account username example
$mail->Password   = "omdozhtvlipvpaef";        // SMTP account password example

$user_id = $_SESSION['accept_user_id'];
$fetch_user_info = new fetch();
$res = $fetch_user_info->fetchUserTnfo($user_id);
if($res->rowCount()){
    $fetch_data = $res->fetch();

    $mail->clearAddresses();
    $mail->setFrom('himaya112401@gmail.com','Himaya: Agricultural Product Carrier and Trading System');
    $mail->addAddress($fetch_data['acc_email']);

    //The subject of the message.
    $mail->Subject = 'Himaya: Agricultural Product Carrier and Trading System';
    $message = '
        Your Account accepted by admin. You can log in now. 
    ';
    $mail->Body = $message;
    $mail->isHTML(true);
    $mail->send();
}else{
    echo"<script>console.log('email sent failed')</script>";
}

