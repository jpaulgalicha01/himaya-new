<?php
session_start();
ob_start();

function secured($data){
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = trim($data);
	$data = str_replace("'", "\'", $data);
	return $data;
}

if(!isset($_COOKIE['user_id'])){
	ob_end_flush(header("Location: ../login.php"));
}

if(isset($_COOKIE['user_id']) && $_COOKIE['user_type'] == "admin"){
	ob_end_flush(header("Location: ../admin/index.php"));
}