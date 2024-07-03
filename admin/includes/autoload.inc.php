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

$user_rand_id = $_COOKIE['user_id'];
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
$res_fetch_admin = $fetch_admin->fetchAdmin($user_rand_id);
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

// Sending email if Account is declined or accept 
if(isset($_SESSION['accept_user_id'])){

	require 'mailAccept.php';
	
	unset($_SESSION['accept_user_id']);
}
if(isset($_SESSION['declined_user_id'])){

	require 'mailDeclined.php';
	
	unset($_SESSION['declined_user_id']);
}