<?php
class controller extends db{
	// Fetch Info of user
	protected function fetch_admin(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);
		return $stmt;
	}

	// Insert Data for Product
	protected function add_product($categories_product, $product_image, $product_type,$carrier_product_name, $carrier_cap ,$trade_date_of_harvest, $trade_description, $trade_product_name, $trade_expected_trade, $trade_duration_date,$carrier_standard){

		$status = "";
		$rand_id = rand();

		foreach ($_FILES['product_images']['name'] as $key => $value) {
			$image_name = $_FILES['product_images']['name'][$key];
			$image_tmp = $_FILES['product_images']['tmp_name'][$key];
			$target_dir = "../uploads/";
	        $imageFileType = pathinfo($image_name, PATHINFO_EXTENSION);

	        // Checking Image File Type
	        if($imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !=="jpg" ){
				$status_message = "Please select jpg, jpeg, png image file type";
				return $status_message;
	        }else{
        		$insert_img = $this->connect()->prepare("INSERT INTO `tbl_products_img`(`img_prod_id`, `img_name`) VALUES (?,?)");
        		$insert_img->execute([$rand_id,$image_name]);
				move_uploaded_file($image_tmp, $target_dir.$image_name);
	        }
		}
		
		// fetch info user 
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);

		if($stmt->rowCount()==1){
			$fetch_info_user = $stmt->fetch();

			$target_dir = "../uploads/";
	        $target_file = $target_dir . basename($product_image);
	        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	        // Checking Image File Type
	        if($imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !=="jpg" ){
				
				$status_message = "Please select jpg, jpeg, png image file type";
				return $status_message;
	        }
	        if($categories_product == "Carrier"){
	        	$insert = $this->connect()->prepare("INSERT INTO `tbl_products`(`prod_rand_id`,`prod_post_user_id`, `product_post_name`, `product_categories`, `product_image`, `product_type`, `product_name`, `product_address`, `product_contact`, `carrier_cap`, `trade_expected_trade`, `trade_duration_date`,`product_availability`, `carrier_standardize`, `product_status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$insert->execute([$rand_id,$fetch_info_user['acc_rand_id'],$fetch_info_user['acc_fname']." ".$fetch_info_user['acc_mname']." ".$fetch_info_user['acc_lname'], $categories_product, $product_image, $product_type, $carrier_product_name, $fetch_info_user['acc_address'], $fetch_info_user['acc_phone'], $carrier_cap, $trade_expected_trade, $trade_duration_date, "Not Available", $carrier_standard, "Pending"]);

				move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

				//Insert Activity Logs 
				$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Adding Product Name: $carrier_product_name','".date('Y-m-d')."')");

				$status = 1;
				return $status;
	        }else{
        		$insert = $this->connect()->prepare("INSERT INTO `tbl_products`(`prod_rand_id`,`prod_post_user_id`, `product_post_name`, `product_categories`, `product_image`, `product_type`, `product_name`, `product_address`, `product_contact`, `carrier_cap`, `trade_date_of_harvest`, `trade_description`, `trade_expected_trade`, `trade_duration_date`,`product_availability`, `product_status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$insert->execute([$rand_id,$fetch_info_user['acc_rand_id'],$fetch_info_user['acc_fname']." ".$fetch_info_user['acc_mname']." ".$fetch_info_user['acc_lname'], $categories_product, $product_image, $product_type, $trade_product_name, $fetch_info_user['acc_address'], $fetch_info_user['acc_phone'], $carrier_cap, $trade_date_of_harvest, $trade_description,$trade_expected_trade, $trade_duration_date, "Not Available", "Pending"]);

				move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);
				
				//Insert Activity Logs 
				$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Adding Product Name: $trade_product_name','".date('Y-m-d')."')");

				$status = 1;
				return $status;
	        }
			
		}
		else{
			return false;
		}

	}

	// Fetching Trade Product List
	protected function fetch_trade_poduct($type_product){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);
		
		if($stmt->rowCount()==1){
			$fetch_info_user = $stmt->fetch();

			switch ($type_product) {
				case 'All':
					$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? ORDER BY `product_status` DESC ");
					$fethc_product->execute([$fetch_info_user['acc_rand_id'],"Trade"]);
					return $fethc_product;
					break;
				
				default:
					$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_type`=? ORDER BY `product_status` DESC ");
					$fethc_product->execute([$fetch_info_user['acc_rand_id'],"Trade",$type_product]);
					return $fethc_product;
					break;
			}
			
		}
	}

	// Fetching Carrier Product
	protected function fetch_carrier_poduct($type_product){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);
		
		if($stmt->rowCount()==1){
			$fetch_info_user = $stmt->fetch();

			switch ($type_product) {
				case 'All':
					$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? ORDER BY `product_status` DESC ");
					$fethc_product->execute([$fetch_info_user['acc_rand_id'],"Carrier"]);
					return $fethc_product;
					break;
				
				default:
					$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_type`=? ORDER BY `product_status` DESC ");
					$fethc_product->execute([$fetch_info_user['acc_rand_id'],"Carrier",$type_product]);
					return $fethc_product;
					break;
			}
			
		}
	}

	protected function fetch_avail_product($fetch_avail_product_id){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_id`=? ");
		$stmt->execute([$fetch_avail_product_id]);
		return $stmt;
	}

	protected function update_avail_status($update_avail_prod_id,$prod_avail_status){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);
		if($stmt->rowCount()==1){
			$fetch_info_user = $stmt->fetch();

			$update_avail_status = $this->connect()->prepare("UPDATE `tbl_products` SET `product_availability`=? WHERE `prod_id`=? AND `prod_post_user_id`=? ");
			$update_avail_status->execute([$prod_avail_status,$update_avail_prod_id,$fetch_info_user['acc_rand_id']]);

			$fetch_product = $this->connect()->query("SELECT * FROM `tbl_products` WHERE `prod_id`='$update_avail_prod_id' AND `prod_post_user_id`='".$fetch_info_user['acc_rand_id']."' ");
			if($fetch_product->rowCount()==1){
				$fetch = $fetch_product->fetch();

				//Insert Activity Logs 
				$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Product Name: ".$fetch['product_name']." Updated Status to: $prod_avail_status','".date('Y-m-d')."')");
			}

			return $update_avail_status;

		}
	}

	protected function delete_prod($delete_prod_id){
		$fetch_product = $this->connect()->query("SELECT * FROM `tbl_products` WHERE `prod_id`='$delete_prod_id' AND `prod_post_user_id`='".$_COOKIE['user_id']."' ");
		if($fetch_product->rowCount()==1){
			$fetch = $fetch_product->fetch();

			//Insert Activity Logs 
			$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Product Name: ".$fetch['product_name']." Deleted Products','".date('Y-m-d')."')");
		
			$stmt = $this->connect()->prepare("DELETE FROM `tbl_products` WHERE  `prod_id`=? ");
			$stmt->execute([$delete_prod_id]);
			return $stmt;
		}

	}

	protected function trade_accept(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);

		if($stmt->rowCount()==1){
			$user_fetch = $stmt->fetch();

			$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_status`=? ");
			$checking_status->execute([$user_fetch['acc_rand_id'],"Trade","Accept"]);
			return $checking_status;
		}
	}

	protected function trade_declined(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);

		if($stmt->rowCount()==1){
			$user_fetch = $stmt->fetch();

			$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_status`=? ");
			$checking_status->execute([$user_fetch['acc_rand_id'],"Trade","Decline"]);
			return $checking_status;
		}
	}

	protected function trade_pending(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);

		if($stmt->rowCount()==1){
			$user_fetch = $stmt->fetch();

			$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_status`=? ");
			$checking_status->execute([$user_fetch['acc_rand_id'],"Trade","Pending"]);
			return $checking_status;
		}
	}

	protected function carrier_accept(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);

		if($stmt->rowCount()==1){
			$user_fetch = $stmt->fetch();

			$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_status`=? ");
			$checking_status->execute([$user_fetch['acc_rand_id'],"Carrier","Accept"]);
			return $checking_status;
		}
	}

	protected function carrier_declined(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);

		if($stmt->rowCount()==1){
			$user_fetch = $stmt->fetch();

			$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_status`=? ");
			$checking_status->execute([$user_fetch['acc_rand_id'],"Carrier","Decline"]);
			return $checking_status;
		}
	}

	protected function carrier_pending(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);

		if($stmt->rowCount()==1){
			$user_fetch = $stmt->fetch();

			$checking_status = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_status`=? ");
			$checking_status->execute([$user_fetch['acc_rand_id'],"Carrier","Pending"]);
			return $checking_status;
		}
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

			$status = 1;
			return $status;
		}else{
			
			$status_message = "There's something wrong to add data. Please try again";
			return $status_message;
		}
	}

	protected function update_info($acc_fname,$acc_mname,$acc_lname,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass){
		$change_info = 0;

		// Checking Username
		$check_uname = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? AND `acc_uname`=? ");
		$check_uname->execute([$_COOKIE['user_id'],$acc_uname]);
		if($check_uname->rowCount()==1){
			$change_info = 1;
		}else{
			$check_uname = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_uname`=? ");
			$check_uname->execute([$acc_uname]);
			if($check_uname->rowCount() == 1){
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

				$update_info = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_fname`=?, `acc_mname`=?, `acc_lname`=?, `acc_birth`=?, `acc_phone`=?, `acc_email`=?, `acc_uname`=?,`acc_password`=? WHERE `acc_rand_id`=? ");
				$update_info->execute([$acc_fname,$acc_mname,$acc_lname,$acc_birth,$acc_phone,$acc_email,$acc_uname,md5($new_pass),$_COOKIE['user_id']]);
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

			$update_info = $this->connect()->prepare("UPDATE `tbl_accounts` SET `acc_fname`=?, `acc_mname`=?, `acc_lname`=?, `acc_birth`=?, `acc_phone`=?, `acc_email`=?, `acc_uname`=? WHERE `acc_rand_id`=? ");
			$update_info->execute([$acc_fname,$acc_mname,$acc_lname,$acc_birth,$acc_phone,$acc_email,$acc_uname,$_COOKIE['user_id']]);
			if($update_info){
				//Insert Activity Logs 
				$this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Update Personal Information','".date('Y-m-d')."')");
				$status = 1;
				return $status;
			}else{
				$status_message = "There's something wrong to add data. Please try again";
				return $status_message;
			}
		}
	}


	protected function checking_id(){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);
		return $stmt;
	}

	protected function fetch_activity($date_start,$date_end){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_logs` WHERE `logs_user_id`=? AND `logs_date` BETWEEN ? AND ? ORDER BY `logs_date` ");
		$stmt->execute([$_COOKIE['user_id'], $date_start, $date_end]);

		return $stmt;
	}

	protected function logout_user(){

		$logout_activity = $this->connect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['user_id']."','Logout','".date('Y-m-d')."')");
		return $logout_activity;
	}

	protected function fetch_img($value){
		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_products_img` WHERE `img_prod_id`=? ");
		$stmt->execute([$value]);
		return $stmt;
	}

	protected function delete_img($delete_img_id){
		$stmt = $this->connect()->prepare("DELETE FROM `tbl_products_img` WHERE `img_id`=? ");
		$stmt->execute([$delete_img_id]);
		return $stmt;
	}

	protected function insert_prod_img($prod_rand_id){
		$status = "";

		// Checking Img Type
		foreach ($_FILES['upload_images']['name'] as $key => $value) {
			
			$img_name = $_FILES['upload_images']['name'][$key];
			$img_tmp = $_FILES['upload_images']['tmp_name'][$key];

			// image type
			$target_dir = "../uploads/";
			$ext = pathinfo($img_name, PATHINFO_EXTENSION);
			// Checking Images Type
			
			if($ext !=="png" && $ext !=="jpeg" && $ext !=="jpg"){
				$status = 0;
			}else{
				// Save to Database
				$insert_img = $this->connect()->prepare("INSERT INTO `tbl_products_img`(`img_prod_id`, `img_name`) VALUES (?,?)");
				$insert_img ->execute([$prod_rand_id,$img_name]);
				move_uploaded_file($img_tmp, $target_dir.$img_name);

				$status = 1;
				return $status;
			}
			
		}


		if($status == 0){
			$status_message = "Please Select PNG, JPG, and JPEG images";
			return $status_message;	
		}
	}


	protected function update_prod_status($prod_id,$prod_availability){
		$checking = $this->connect()->prepare("SELECT prod_id FROM tbl_products WHERE prod_id = ?");
		$checking->execute([$prod_id]);

		if($checking->rowCount() != 0){
			$update = $this->connect()->prepare("UPDATE `tbl_products` SET `product_availability`= ? WHERE prod_id=?");
			$update->execute([$prod_availability,$prod_id]);

			if(!$update){
				return "There's Something Wrong To Update";
			}
			return 1;
		}
		return "Product Not Found";

	}

	protected function fetch_report($type_product,$availability){
		if($availability == "2"){
			$availability = "Not Availble";
		}

		$stmt = $this->connect()->prepare("SELECT * FROM `tbl_accounts` WHERE `acc_rand_id`=? ");
		$stmt->execute([$_COOKIE['user_id']]);
		
		if($stmt->rowCount()==1){
			$fetch_info_user = $stmt->fetch();
			
			if($type_product == "All" && $availability == "All"){
				$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? ORDER BY `product_status` DESC ");
				$fethc_product->execute([$fetch_info_user['acc_rand_id']]);
				return $fethc_product;
			}
			else if($type_product == "All" && $availability != "All"){
				$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_availability`=? ORDER BY `product_status` DESC ");
				$fethc_product->execute([$fetch_info_user['acc_rand_id'],$availability]);
				return $fethc_product;
			}
			else if($type_product != "All" && $availability == "All"){
				$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? ORDER BY `product_status` DESC ");
				$fethc_product->execute([$fetch_info_user['acc_rand_id'],$type_product]);
				return $fethc_product;
			}else{
				$fethc_product = $this->connect()->prepare("SELECT * FROM `tbl_products` WHERE `prod_post_user_id`=? AND `product_categories`=? AND `product_availability`=? ORDER BY `product_status` DESC ");
				$fethc_product->execute([$fetch_info_user['acc_rand_id'],$type_product,$availability]);
				return $fethc_product;
			}
			
		}
	}
}
?>