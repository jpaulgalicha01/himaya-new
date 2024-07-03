<?php
function validateImageType($file_type) {
    $allowed_types = array('image/jpg','image/jpeg', 'image/png', 'image/gif');
    return in_array($file_type, $allowed_types);
}

function validateAndUploadImage($file_name, $file_tmp_name, $file_dest) {
    $file_type = $_FILES[$file_name]['type'];
    if (validateImageType($file_type)) {
        move_uploaded_file($file_tmp_name, $file_dest);
        return true; // File uploaded successfully
    } else {
        return false; // Invalid file type
    }
}
class controller extends db{

	protected function create_acc($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$acc_pass){

		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_uname`=?  OR `acc_email`=? ");
		$stmt->execute([$acc_uname,$acc_email]);

		if($stmt->rowCount()!==1){
			$file1_name = $_FILES['acc_img']['name'];
			$file1_tmp_name = $_FILES['acc_img']['tmp_name'];
			$file1_dest = "uploads/" . $file1_name;
			
			// File 2
			$file2_name = $_FILES['valid_id_img']['name'];
			$file2_tmp_name = $_FILES['valid_id_img']['tmp_name'];
			$file2_dest = "uploads/" . $file2_name;
			
			// Validate and upload files
			$file1_uploaded = validateAndUploadImage('acc_img', $file1_tmp_name, $file1_dest);
			$file2_uploaded = validateAndUploadImage('valid_id_img', $file2_tmp_name, $file2_dest);
			
			if (!$file1_uploaded && !$file2_uploaded) {
				return "Invalid file type! Only JPG, JPEG, PNG, and GIF images are allowed.";
			}

			// // Insert Data
			// $target_dir = "uploads/";
	        // $target_file = $target_dir . basename($acc_img);
	        // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	        // // Checking Image File Type
	        // if($imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !=="jpg" && $imageFileType!=="svg" ){
				
			// 	$status_message = "Please select jpg, jpeg, png, svg image file type";
			// 	return $status_message;
	        // }

	        $insert_data = $this->connect()->prepare("INSERT INTO `tbl_accounts`(`acc_rand_id`, `acc_fname`, `acc_mname`, `acc_lname`,`acc_address`, `acc_birth`,`acc_phone`, `acc_email`, `acc_uname`, `acc_password`,`acc_profile`,`acc_valid_id`, `acc_type`,`acc_status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$insert_data->execute([rand(),$acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,"09".$acc_phone,$acc_email,$acc_uname,md5($acc_pass),$file1_name,$file2_name,"user","Pending"]);

			if($insert_data){
				// move_uploaded_file($_FILES["acc_img"]["tmp_name"], $target_file);
				$status = 1;
				return $status;
			}else{
				
				$status_message = "There's something wrong to add data. Please try again";
				return $status_message;
			}	

		}
		return false;
		
	}

	protected function acc_login($acc_uname,$acc_pass){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_uname`=? AND `acc_password`=? ");
		$stmt->execute([$acc_uname,md5($acc_pass)]);

		if($stmt->rowCount()==1){
			$fetch_info = $stmt->fetch();
			$sent_otp = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_otp`=? WHERE `acc_uname`=? AND `acc_password`=? ");
			$sent_otp->execute([rand(000000,999999),$acc_uname,md5($acc_pass)]);

			if($sent_otp){
			//Insert Activity Logs 
				$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$fetch_info['acc_rand_id']."','Requesting OTP Code','".date('Y-m-d')."')");

				$fetch = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_uname`=? AND `acc_password`=? ");
				$fetch->execute([$acc_uname,md5($acc_pass)]);
				return $fetch;
			}

		}
	}

	protected function verify_otp($user_id,$otp_code){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? AND `acc_otp`=? ");
		$stmt->execute([$user_id,$otp_code]);

		//Insert Activity Logs 
		$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('$user_id','Submit OTP Code','".date('Y-m-d')."')");
		return $stmt;
	}

	protected function fetch_carrier_trucks(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=? ");
		$stmt->execute(["Carrier","Trucks","Accept"]);
		return $stmt;
	}

	protected function fetch_carrier_vans(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=? ");
		$stmt->execute(["Carrier","Vans","Accept"]);
		return $stmt;
	}

	protected function fetch_carrier_tricycle(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=? ");
		$stmt->execute(["Carrier","Tricycles","Accept"]);
		return $stmt;
	}

	protected function fetch_trade_vegetables(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=? ");
		$stmt->execute(["Trade","Vegetables","Accept"]);
		return $stmt;
	}

	protected function fetch_trade_poultry(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=? ");
		$stmt->execute(["Trade","Poultry","Accept"]);
		return $stmt;
	}

	protected function fetch_trade_other_items(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=? ");
		$stmt->execute(["Trade","Other Items","Accept"]);
		return $stmt;
	}
	protected function view_product($prod_id){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_id`=? ");
		$stmt->execute([$prod_id]);
		return $stmt;
	}

	protected function checking_prod_dura($date){
		$stmt = $this->connect()->prepare("DELETE FROM `tbl_products` WHERE `product_categories`=? AND `trade_duration_date`=? AND `product_status`=? ");
		$stmt->execute(["Trade",$date,"Accept"]);
		return $stmt;
	}

	protected function fetch_prod($value){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE  `product_categories` LIKE ? AND `product_status`=? OR  `product_type` LIKE ? AND `product_status`=? OR  `product_name` LIKE ? AND `product_status`=?");
		$stmt->execute(["%".$value."%","Accept","%".$value."%","Accept","%".$value."%","Accept"]);
		return $stmt;
	}

	protected function fetch_img($img_rand_id){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products_img` WHERE `img_prod_id`=? ");
		$stmt->execute([$img_rand_id]);
		return $stmt;
	}

	protected function reset_pass($email){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_email`=? ");
		$stmt->execute([$email]);
		if($stmt->rowCount()){
			$fetch_info = $stmt->fetch();

			$sent_otp = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_otp`=? WHERE `acc_rand_id`=?");
			$sent_otp->execute([rand(000000,999999),$fetch_info['acc_rand_id']]);
			if($sent_otp){

				//Insert Activity Logs 
				$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$fetch_info['acc_rand_id']."','Requesting OTP Code','".date('Y-m-d')."')");

				$fetch = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
				$fetch->execute([$fetch_info['acc_rand_id']]);
				return $fetch;
			}
		}
	}

	protected function submit_otp($user_id,$otp_code){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? AND `acc_otp`=? ");
		$stmt->execute([$user_id,$otp_code]);
		return $stmt;
	}

	protected function change_pass($user_id_new_pass,$new_pass){
		$stmt = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_password`=? WHERE `acc_rand_id`=? ");
		$stmt->execute([md5($new_pass), $user_id_new_pass]);

		//Insert Activity Logs 
		$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('user_id_new_pass','Requesting OTP Code','".date('Y-m-d')."')");
		return $stmt;
	}
}
?>