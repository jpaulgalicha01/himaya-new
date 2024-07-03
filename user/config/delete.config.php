<?php
class delete extends controller{
	public function deleteProd($delete_prod_id){
		$stmt = $this->delete_prod($delete_prod_id);

		if(!$stmt){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "Error";
			$_SESSION['title_alert'] = "There's Something Wrong. Please try Again";
			ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
		}

			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "success";
			$_SESSION['title_alert'] = "Successfully Deleted Data";
			ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
	}

	public function deleteImg($delete_img_id){
		$stmt = $this->delete_img($delete_img_id);

		if(!$stmt){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "Error";
			$_SESSION['title_alert'] = "There's Something Wrong. Please try Again";
			ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
		}

			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "success";
			$_SESSION['title_alert'] = "Successfully Deleted Data";
			ob_end_flush(header("Location:".$_SERVER['HTTP_REFERER'].""));
	}
}
?>