<?php
include 'config/security.php';

spl_autoload_register("Autoload");

function Autoload($classname){
	$path = "config/";
	$extenstion = ".config.php";
	$full_path = $path . $classname . $extenstion;

	if(!file_exists($full_path)){
		return false;
	}
	include_once $full_path;
}

// Fetch Information Admin

$user_profile = "";
$user_fname = "";
$user_mname = "";
$user_lname = "";
$user_address = "";
$user_birth = "";
$user_phone = "";
$user_email = "";
$user_uname = "";

$fetch_admin = new fetch();
$res_fetch_admin = $fetch_admin->fetchAdmin();
if($res_fetch_admin->rowCount()){
	$fetch_info_admin = $res_fetch_admin->fetch();

	$user_profile = $fetch_info_admin['acc_profile'];
	$user_fname = $fetch_info_admin['acc_fname'];
	$user_mname = $fetch_info_admin['acc_mname'];
	$user_lname = $fetch_info_admin['acc_lname'];
	$user_address = $fetch_info_admin['acc_address'];
	$user_birth = $fetch_info_admin['acc_birth'];
	$user_phone = $fetch_info_admin['acc_phone'];
	$user_email = $fetch_info_admin['acc_email'];
	$user_uname = $fetch_info_admin['acc_uname'];
}

// Checking user if have random id
$checking_id = new fetch();
$res_checking_id = $checking_id->checkingId();
if($res_checking_id->rowCount()!==1){
	setcookie("user_id",NULL, time()-3600, '/himaya');
	setcookie("user_type",NULL, time()-3600, '/himaya');
	ob_end_flush(header("Location: ../login.php"));
}