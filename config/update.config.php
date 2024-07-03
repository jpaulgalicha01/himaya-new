<?php

class update extends controller{

	public function resetPass($email){
		$stmt = $this->reset_pass($email);

		if($stmt){
			$fetch_info = $stmt->fetch();

			$status = "";

			require 'reset_pass_otp_code.php';

			if($status == 1){
				$data = [
					'status' => 200,
					'icon' => "success",
					'message' => "Successfully Sent OTP Code to ".$fetch_info['acc_email']."",
					'data' => $fetch_info
				];
				echo json_encode($data);
				return false;
			}else{
				$data = [
					'status' => 404,
					'icon' => "error",
					'message' => "Failed to send email. Please check the internet connection",
				];
				echo json_encode($data);
				return false;
			}

		}else{
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "Email Not Found",
			];
			echo json_encode($data);
			return false;
		}
	}

	public function changePass($user_id_new_pass,$new_pass){
		$stmt = $this->change_pass($user_id_new_pass,$new_pass);

		if($stmt){
			$data = [
				'status' => 200,
				'icon' => "success",
				'redirect' => "login.php"
			];
			echo json_encode($data);
			return false;
		}else{
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "There's something wrong. Please try again.",
			];
			echo json_encode($data);
			return false;
		}
	}
}

?>