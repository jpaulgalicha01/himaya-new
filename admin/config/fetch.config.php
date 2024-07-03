<?php
class fetch extends controller{
	public function fetchAdmin($user_rand_id){
		$stmt = $this->fetch_admin($user_rand_id);
		return $stmt;
	}

	public function fetchUserAcc(){
		$stmt = $this->fetch_user_acc();
		return $stmt;
	}

	public function viewUser($user_id){
		$stmt = $this->view_user($user_id);

		if($stmt->rowCount()){
			$fetch_info = $stmt->fetch();

			$data = [
				'status' => 200,
				'data' => $fetch_info,
			];
			echo json_encode($data);
			return false;
		}else{
			return false;
		}
	}

	public function fetchUserTnfo($user_id){
		$stmt = $this->fetch_user_info($user_id);
		return $stmt;
	}

	public function fetchTradeProduct($value,$status){
		$stmt = $this->fetch_trade_product($value,$status);
		return $stmt;
	}

	public function fetchCarrierProduct($value,$status){
		$stmt = $this->fetch_carrier_product($value,$status);
		return $stmt;
	}

	public function viewProductId($product_id){
		$stmt = $this->view_product_id($product_id);

		if($stmt->rowCount()){
			$fetch = $stmt->fetch();

			$data = [
				'status'=> 200,
				'data' => $fetch
			];

			echo json_encode($data);
			return false;
		}
	}

	public function countUserAccept(){
		$stmt = $this->count_user_accept();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function countUserDecline(){
		$stmt = $this->count_user_decline();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function countUserPending(){
		$stmt = $this->count_user_pending();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function tradeAccept(){
		$stmt = $this->trade_accept();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function tradeDecline(){
		$stmt = $this->trade_decline();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}
	public function tradePending(){
		$stmt = $this->trade_pending();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function carrierAccept(){
		$stmt = $this->carrier_accept();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function carrierDecline(){
		$stmt = $this->carrier_decline();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}
	public function carrierPending(){
		$stmt = $this->carrier_pending();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function fetchActivity($date_start,$date_end){
		$stmt = $this->fetch_activity($date_start,$date_end);
		return $stmt;
	}

	public function fetchReport($user_id,$type_product,$availability){
		return $this->fetch_report($user_id,$type_product,$availability);
	}

	public function fetchUser($user_id){
		return $this->fetch_user($user_id);
	}

}
?>