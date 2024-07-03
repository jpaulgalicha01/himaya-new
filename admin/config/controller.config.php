<?php
class controller extends db{
	// Fetch User Information
	protected function fetch_admin($user_rand_id){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$user_rand_id]);
		return $stmt;
	}

	protected function fetch_user_acc(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_type`=? ");
		$stmt->execute(["user"]);
		return $stmt;
	}

	protected function decline_user($user_id){
		$fetch_user = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$fetch_user->execute([$user_id]);

		if($fetch_user->rowCount()){
			$fetch = $fetch_user->fetch();

			//Insert Activity Logs 
			$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Decline User : ".$fetch['acc_fname']." ".$fetch['acc_mname']." ".$fetch['acc_lname']."','".date('Y-m-d')."')");

			$stmt = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_status`=? WHERE `acc_rand_id`=? ");
			$stmt->execute(["Declined",$user_id]);
			return $stmt;

		}
		
	}
	protected function accept_user($user_id){
		$fetch_user = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$fetch_user->execute([$user_id]);

		if($fetch_user->rowCount()){
			$fetch = $fetch_user->fetch();

			//Insert Activity Logs 
			$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Accept User : ".$fetch['acc_fname']." ".$fetch['acc_mname']." ".$fetch['acc_lname']."','".date('Y-m-d')."')");

			$stmt = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_status`=? WHERE `acc_rand_id`=? ");
			$stmt->execute(["Accept",$user_id]);
			return $stmt;

		}
	}

	protected function delete_user($user_id){
		$fetch_user = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$fetch_user->execute([$user_id]);

		if($fetch_user->rowCount()){
			$fetch = $fetch_user->fetch();

			//Insert Activity Logs 
			$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Delete User : ".$fetch['acc_fname']." ".$fetch['acc_mname']." ".$fetch['acc_lname']."','".date('Y-m-d')."')");

			$stmt = $this->connect()->prepare("DELETE FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
			$stmt->execute([$user_id]);
			return $stmt;
		}
		
	}

	protected function view_user($user_id){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$user_id]);
		return $stmt;
	}

	protected function fetch_user_info($user_id){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$user_id]);
		return $stmt;
	}

	protected function fetch_trade_product($value,$status){
		if($value == "All"){
			if($status== "All"){
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? ");
				$stmt->execute(["Trade"]);
				return $stmt;
			}else{
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=?");
				$stmt->execute(["Trade",$status]);
				return $stmt;
			}
	
		}else{
			if($status== "All"){
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=?");
				$stmt->execute(["Trade",$value]);
				return $stmt;
			}else{
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=?");
				$stmt->execute(["Trade",$value,$status]);
				return $stmt;

			}
			
		}
	}

	protected function fetch_carrier_product($value,$status){
		if($value == "All"){
			if($status== "All"){
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? ");
				$stmt->execute(["Carrier"]);
				return $stmt;
			}else{
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=?");
				$stmt->execute(["Carrier",$status]);
				return $stmt;
			}
	
		}else{
			if($status== "All"){
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=?");
				$stmt->execute(["Carrier",$value]);
				return $stmt;
			}else{
				$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_type`=? AND `product_status`=?");
				$stmt->execute(["Carrier",$value,$status]);
				return $stmt;

			}
			
		}
	}

	protected function view_product_id($product_id){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_id`=? ");
		$stmt->execute([$product_id]);
		return $stmt;
	}

	protected function update_prod_status($prod_id,$status_prod){
		$fetch_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_id`=? ");
		$fetch_product->execute([$prod_id]);
		if($fetch_product->rowCount()==1){
			$fetch = $fetch_product->fetch();
			//Insert Activity Logs 
			$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Product Name: ".$fetch['product_name']." Status: $status_prod Owner: ".$fetch['product_post_name']." ','".date('Y-m-d')."')");

			$stmt = $this->connect()->prepare("UPDATE `tbl_products` SET `product_status`=?, `product_availability`=? WHERE `prod_id`=? ");
			$stmt->execute([$status_prod,"Available",$prod_id]);
			return $stmt;
		}
		
	}

	protected function count_user_accept(){
		$stmt = $this->connect()->query("SELECT * FROM `tbl_accounts` WHERE `acc_status`='Accept' ");
		return $stmt;
	}

	protected function count_user_decline(){
		$stmt = $this->connect()->query("SELECT * FROM `tbl_accounts` WHERE `acc_status`='Decline' ");
		return $stmt;
	}

	protected function count_user_pending(){
		$stmt = $this->connect()->query("SELECT * FROM `tbl_accounts` WHERE `acc_status`='Pending' ");
		return $stmt;
	}

	protected function trade_accept(){
		$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=? ");
		$checking_status->execute(["Trade","Accept"]);
		return $checking_status;
	}

	protected function trade_decline(){
		$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=? ");
		$checking_status->execute(["Trade","Decline"]);
		return $checking_status;
	}

	protected function trade_pending(){
		$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=? ");
		$checking_status->execute(["Trade","Pending"]);
		return $checking_status;
	}

	protected function carrier_accept(){
		$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=? ");
		$checking_status->execute(["Carrier","Accept"]);
		return $checking_status;
	}

	protected function carrier_decline(){
		$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=? ");
		$checking_status->execute(["Carrier","Decline"]);
		return $checking_status;
	}

	protected function carrier_pending(){
		$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_status`=? ");
		$checking_status->execute(["Carrier","Pending"]);
		return $checking_status;
	}

	protected function change_prof_img($change_img){
		// Checking Img file Type
		$target_dir = "../uploads/";
        $target_file = $target_dir . basename($change_img);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Checking Image File Type
        if($imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !=="jpg" && $imageFileType!=="svg" ){
			
			$status_message = "Please select jpg, jpeg, png, svg image file type";
			return $status_message;
        }

		$stmt = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_profile`=? WHERE `acc_rand_id`=? ");
		$stmt->execute([$change_img,$_COOKIE['user_id']]);
		if($stmt){
			move_uploaded_file($_FILES["change_img"]["tmp_name"], $target_file);
			
			//Insert Activity Logs 
			$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Update Profile Image','".date('Y-m-d')."')");
			return 1;
		}
			
		$status_message = "There's something wrong to add data. Please try again";
		return $status_message;
	}

	protected function update_info($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass){
		$change_info = 0;

		// Checking Username
		$check_uname = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? AND `acc_uname`=? ");
		$check_uname->execute([$_COOKIE['user_id'],$acc_uname]);
		if($check_uname->rowCount()==1){
			$change_info = 1;
		}else{
			$check_uname = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_uname`=? ");
			$check_uname->execute([$acc_uname]);
			if($check_uname->rowCount()==1){
				$status_message = "Username is already added.";
				return $status_message;
			}
			$change_info = 1;
		}

		// Checking Email
		$check_email = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? AND `acc_email`=? ");
		$check_email->execute([$_COOKIE['user_id'],$acc_email]);
		if($check_email->rowCount()==1){
			$change_info = 1;
		}else{
			$check_email = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_email`=? ");
			$check_email->execute([$acc_email]);

			if($check_email->rowCount()==1){
				$status_message = "Email Address is already added.";
				return $status_message;
			}
			$change_info = 1;
		}

		// Insert Data
		if($change_info == 1){
			if($curr_pass!==""){
				// Checking Current Password
				$checking_curr_pass = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? AND `acc_password`=? ");
				$checking_curr_pass->execute([$_COOKIE['user_id'],md5($curr_pass)]);

				if($checking_curr_pass->rowCount()!==1){
					$status_message = "Current Password is not matched on data. Please try again.";
					return $status_message;
				}

				$update_info = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_fname`=?, `acc_mname`=?, `acc_lname`=?, `acc_address`=?, `acc_birth`=?, `acc_phone`=?, `acc_email`=?, `acc_uname`=?,`acc_password`=? WHERE `acc_rand_id`=? ");
				$update_info->execute([$acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,md5($new_pass),$_COOKIE['user_id']]);
				if($update_info){
					//Insert Activity Logs 
					$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Changed Password','".date('Y-m-d')."')");

					$status = 1;
					return $status;
				}else{
					$status_message = "There's something wrong to add data. Please try again";
					return $status_message;
				}
			}

			$update_info = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_fname`=?, `acc_mname`=?, `acc_lname`=?, `acc_address`=?, `acc_birth`=?, `acc_phone`=?, `acc_email`=?, `acc_uname`=? WHERE `acc_rand_id`=? ");
			$update_info->execute([$acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$_COOKIE['user_id']]);
			if($update_info){
				//Insert Activity Logs 
				$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Update Information','".date('Y-m-d')."')");
				$status = 1;
				return $status;
			}else{
				$status_message = "There's something wrong to add data. Please try again";
				return $status_message;
			}
		}
	}

	protected function fetch_activity($date_start,$date_end){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_logs` WHERE `logs_user_id`=? AND `logs_date` BETWEEN ? AND ? ORDER BY `logs_date` ");
		$stmt->execute([$_COOKIE['user_id'], $date_start, $date_end]);

		return $stmt;
	}

	protected function fetch_report($user_id,$type_product,$availability){
		if($availability == "2"){
			$availability = "Not Availble";
		}
		if($user_id =="All" && $availability == "All"){
			$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? ORDER BY `product_status` DESC ");
			$fethc_product->execute([$type_product]);
			return $fethc_product;
		}
		else if($user_id == "All" && $availability != "All"){
			$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `product_categories`=? AND `product_availability`=?  ORDER BY `product_status` DESC ");
			$fethc_product->execute([$type_product,$availability]);
			return $fethc_product;
		}
		else if($user_id != "All" && $availability == "All"){
			$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? ORDER BY `product_status` DESC ");
			$fethc_product->execute([$user_id,$type_product]);
			return $fethc_product;
		}
		else{
			$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_availability`=? ORDER BY `product_status` DESC ");
			$fethc_product->execute([$user_id,$type_product,$availability]);
			return $fethc_product;
		}
			
	}

	protected function fetch_user($user_id){

		$stmt = $this->connect()->prepare("SELECT acc_fname, acc_mname, acc_lname FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$user_id]);
		$res = $stmt->fetch();
		return	$res['acc_fname']." ".$res['acc_mname']." ".$res['acc_lname'];
		
	}

}
?>