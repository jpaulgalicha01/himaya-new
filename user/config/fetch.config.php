<?php
class fetch extends controller{

	public function fetchAdmin(){
		$stmt = $this->fetch_admin();
		return $stmt;
	}

	public function fetchTradePoduct($type_product){
		$stmt = $this->fetch_trade_poduct($type_product);
		return $stmt;
	}

	public function fetchCarrierPoduct($type_product){
		$stmt = $this->fetch_carrier_poduct($type_product);
		return $stmt;
	}

	public function fetchAvailProduct($fetch_avail_product_id){
		$stmt = $this->fetch_avail_product($fetch_avail_product_id);

		if($stmt->rowCount()==1){
			$fetch_data = $stmt->fetch();

			$data = [
				'status' => 200,
				'data' => $fetch_data
			];
			echo json_encode($data);
			return false;
		}
		return false;
	}

	public function tradeAccept(){
		$stmt = $this->trade_accept();
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

	public function tradeDeclined(){
		$stmt = $this->trade_declined();
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

	public function carrierDeclined(){
		$stmt = $this->carrier_declined();
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

	public function checkingId(){
		$stmt = $this->checking_id();
		return $stmt;
	}

	public function fetchActivity($date_start,$date_end){
		$stmt = $this->fetch_activity($date_start,$date_end);
		return $stmt;
	}

	public function fetchImg($value){
		$stmt = $this->fetch_img($value);
		return $stmt;
	}

	public function fetchReport($type_product,$availability){
		return $this->fetch_report($type_product,$availability);
	}

}
?>