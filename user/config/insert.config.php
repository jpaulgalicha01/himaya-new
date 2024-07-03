<?php
class insert extends controller{
	public function addProduct($categories_product, $product_image, $product_type,$carrier_product_name, $carrier_cap ,$trade_date_of_harvest, $trade_description, $trade_product_name, $trade_expected_trade, $trade_duration_date,$carrier_standard){
		$stmt = $this->add_product($categories_product, $product_image, $product_type,$carrier_product_name, $carrier_cap ,$trade_date_of_harvest, $trade_description, $trade_product_name, $trade_expected_trade, $trade_duration_date,$carrier_standard);

		if($stmt){
			switch ($stmt) {
				case '1':
					if($categories_product == "Carrier"){
						$_SESSION['alert'] = "Show";
						$_SESSION['icon'] = "success";
						$_SESSION['title_alert'] = "Successfully insert Data";
						ob_end_flush(header("Location: carrier-product-list.php"));	
					}else{
						$_SESSION['alert'] = "Show";
						$_SESSION['icon'] = "success";
						$_SESSION['title_alert'] = "Successfully insert Data";
						ob_end_flush(header("Location: trade-product-list.php"));	
					}

					break;
				
				default:
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "info";
					$_SESSION['title_alert'] = $stmt;
					ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
					break;
			}
		}else{
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Something Wrong. Please try Again";
			ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
		}

	}

	public function logoutUser(){
		$stmt = $this->logout_user();
		return $stmt;
	}

	public function insertProdImg($prod_rand_id){
		$stmt = $this->insert_prod_img($prod_rand_id);

		if($stmt){
			if($stmt == 1){
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "success";
				$_SESSION['title_alert'] = "Successfully insert Data";
				ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
			}else{
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "info";
				$_SESSION['title_alert'] = $stmt;
				ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
			}

		}else{
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Something Wrong. Please try Again";
			ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));

		}
	}
		
}
?>