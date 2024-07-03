<?php
class fetch extends controller{
	public function accLogin($acc_uname,$acc_pass){
		$stmt = $this->acc_login($acc_uname,$acc_pass);
		if($stmt){
			// Valid Credentials
			$fetch = $stmt->fetch();
			switch ($fetch['acc_type']) {
				case 'admin':
					$status = 0;
					require 'otp_sent_code.php';

					if($status == 1){
						$data = [
							'status' => 200,
							'icon' => "success",
							'message' => "Successfully Sent OTP Code to ".$fetch['acc_email']."",
							'data' => $fetch
						];
						echo json_encode($data);
						return false;
					}else{
						$data = [
							'status' => 404,
							'icon' => "error",
							'message' => "Failed to send email. Please check the internet connection",
							'data' => $fetch
						];
						echo json_encode($data);
						return false;
					}

					break;
				
				default:
					if($fetch['acc_status'] == "Accept"){
						$status = 0;
						require 'otp_sent_code.php';

						if($status == 1){
							$data = [
								'status' => 200,
								'icon' => "success",
								'message' => "Successfully Sent OTP Code to ".$fetch['acc_email']."",
								'data' => $fetch
							];
							echo json_encode($data);
							return false;
						}else{
							$data = [
								'status' => 404,
								'icon' => "error",
								'message' => "Failed to send email. Please try again",
								'data' => $fetch
							];
							echo json_encode($data);
							return false;
						}
					}
					if($fetch['acc_status'] == "Pending"){
						$data = [
							'status' => 302,
							'icon' => 'info',
							'message' => "Please wait to accept your account. Thank you.",
						];
						echo json_encode($data);
						return false;
						break;
					}
					$data = [
						'status' => 302,
						'icon' => 'error',
						'message' => "Sorry to inform to you that your account has declined by admin.",
					];
					echo json_encode($data);
					return false;
			}
		}
		// Not Valid Credentials
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "Invalid Username/Password",
			];
			echo json_encode($data);
			return false;
	}

	public function verifyOtp($user_id,$otp_code){
		$stmt = $this->verify_otp($user_id,$otp_code);

		if($stmt->rowCount()==1){
			$fetch = $stmt->fetch();
			switch ($fetch['acc_type']) {
				case 'admin':
					setcookie("user_id",$fetch['acc_rand_id'],2147483647);
					setcookie("user_type",$fetch['acc_type'],2147483647);
					$data = [
							'status' => 200,
							'icon' => "success",
							'redirect' => "admin/index.php"
						];
					echo json_encode($data);
					return false;

					break;
				
				default:
					if($fetch['acc_status'] == "Accept"){
						setcookie("user_id",$fetch['acc_rand_id'],2147483647);
						setcookie("user_type",$fetch['acc_type'],2147483647);
						$data = [
								'status' => 200,
								'icon' => "success",
								'redirect' => "user/index.php"
							];
						echo json_encode($data);
						return false;
					}					
					if($fetch['acc_status'] == "Pending"){
						$data = [
							'status' => 302,
							'icon' => 'info',
							'message' => "Please wait to accept your account. Thank you.",
						];
						echo json_encode($data);
						return false;
					}
					$data = [
						'status' => 302,
						'icon' => 'error',
						'message' => "Sorry to inform to you that your account has declined by admin.",
					];
					echo json_encode($data);
					return false;
					
					break;
			}
			
		}else{
			// Not Valid Credentials
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "Invalid OTP Code",
			];
			echo json_encode($data);
			return false;
		}
	}

	public function fetchCarrierTrucks(){
		$stmt = $this->fetch_carrier_trucks();
		return $stmt;
	}

	public function fetchCarrierVans(){
		$stmt = $this->fetch_carrier_vans();
		return $stmt;
	}
	public function fetchCarrierTricycle(){
		$stmt = $this->fetch_carrier_tricycle();
		return $stmt;
	}

	public function fetchTradeVegetables(){
		$stmt = $this->fetch_trade_vegetables();
		return $stmt;
	}

	public function fetchTradePoultry(){
		$stmt = $this->fetch_trade_poultry();
		return $stmt;
	}

	public function fetchTradeOtherItems(){
		$stmt = $this->fetch_trade_other_items();
		return $stmt;
	}

	public function viewProduct($prod_id){
		$stmt = $this->view_product($prod_id);
		return $stmt;
	}

	public function checkingProdDura($date){
		$stmt = $this->checking_prod_dura($date);
		return $stmt;
	}

	public function fetchProd($value){
		$stmt = $this->fetch_prod($value);
		return $stmt;
	}

	public function fetchImg($img_rand_id){
		$stmt = $this->fetch_img($img_rand_id);
		return $stmt;
	}

	public function submitOtp($user_id,$otp_code){
		$stmt = $this->submit_otp($user_id,$otp_code);

		if($stmt->rowCount()==1){
			$fetch = $stmt->fetch();
			
			$data = [
				'status' => 200,
				'data' => $fetch
			];
			echo json_encode($data);
			return false;
		}else{
			// Not Valid OTP CODE
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "Invalid OTP Code",
			];
			echo json_encode($data);
			return false;
		}
	}

}
?>