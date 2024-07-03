<?php
class update extends controller{
	public function updateAvailStatus($update_avail_prod_id,$prod_avail_status){
		$stmt = $this->update_avail_status($update_avail_prod_id,$prod_avail_status);

		if($stmt){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "success";
			$_SESSION['title_alert'] = "Successfully insert Data";
			ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
	
		}
		$_SESSION['alert'] = "Show";
		$_SESSION['icon'] = "Error";
		$_SESSION['title_alert'] = "There's Something Wrong. Please try Again";
		ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
	}

	public function changeProfImg($change_img){
		$stmt = $this->change_prof_img($change_img);

		if($stmt){
			if($stmt !==1){
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "error";
				$_SESSION['title_alert'] = $stmt;
				ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
			}
			else{
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "success";
				$_SESSION['title_alert'] = "Successfully Updated";
				ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
			}
		}
		else{
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}
	}

	public function updateInfo($acc_fname,$acc_mname,$acc_lname,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass){
		$stmt = $this->update_info($acc_fname,$acc_mname,$acc_lname,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass);

		if(!$stmt){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}else{
			switch ($stmt) {
				case '1':
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "success";
					$_SESSION['title_alert'] = "Successfully Updated";
					ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
					break;
				
				default:
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "error";
					$_SESSION['title_alert'] = $stmt;
					ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
					break;
			}
		}
	}

	public function updateProdStatus($prod_id,$prod_availability){
		$stmt = $this->update_prod_status($prod_id,$prod_availability);
		if(!$stmt){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			// ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}else{
			switch ($stmt) {
				case '1':
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "success";
					$_SESSION['title_alert'] = "Successfully Updated";
					// ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
					break;
				
				default:
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "error";
					$_SESSION['title_alert'] = $stmt;
					// ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
					break;
			}
		}
	}
}
?>