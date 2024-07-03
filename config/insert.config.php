<?php
class insert extends controller {

	public function createAcc($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$acc_pass){
		$status = 0;
		$stmt = $this->create_acc($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$acc_pass,$status);

		if($stmt){
			if($stmt !== 1){
				$data = [
					'status' => "302",
					'icon' => 'error',
					'message' => $stmt,
				];

				echo json_encode($data);
				return false;

			}else{
				$data = [
					'status' => 200,
					'redirect' => "login.php",
				];
				echo json_encode($data);
				return false;
			}
			
			
		}else{
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "Email / Username is already added.",
			];
			echo json_encode($data);
			return false;
		}
		
	}

}
?>