<?php
ob_start();
session_start();


if(isset($_COOKIE['user_id']) && $_COOKIE['user_type'] =="admin"){
	ob_end_flush(header("Location: admin/index.php"));
}

if(isset($_COOKIE['user_id']) && $_COOKIE['user_type'] =="user"){
	ob_end_flush(header("Location: user/index.php"));
}