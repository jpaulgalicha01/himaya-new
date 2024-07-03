<?php
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET" ){
	if(isset($_POST['add_product']) && $_POST['function'] == "add_product"){
		$categories_product = secured($_POST['categories_product']);
		$product_image = $_FILES['product_image']['name'];

		$product_type = secured($_POST['product_type']);
		

		//carrier 
		$carrier_product_name = secured($_POST['carrier_product_name']);	
		$carrier_cap = secured($_POST['carrier_cap']);
		$carrier_standard = secured($_POST['carrier_standard']);


		// Trade
		$trade_date_of_harvest = secured($_POST["trade_date_of_harvest"]);
		$trade_description = secured($_POST["trade_description"]);
		$trade_product_name = secured($_POST['trade_product_name']);	
		$trade_expected_trade = secured($_POST['trade_expected_trade']);
		$trade_duration_date = secured($_POST['trade_duration_date']);

		$add_product = new insert();
		$add_product->addProduct($categories_product, $product_image, $product_type,$carrier_product_name, $carrier_cap ,$trade_date_of_harvest, $trade_description, $trade_product_name, $trade_expected_trade, $trade_duration_date,$carrier_standard);
	}elseif(isset($_POST['value']) && $_POST['function']=="fetch_avail_product"){
		$fetch_avail_product_id = secured($_POST['value']);

		$fetch_avail_product = new fetch();
		$fetch_avail_product->fetchAvailProduct($fetch_avail_product_id);
	}elseif(isset($_POST['update_avail_prod']) && $_POST['function'] == "update_avail_prod"){
		$update_avail_prod_id = secured($_POST['update_avail_prod_id']);
		$prod_avail_status = secured($_POST['prod_avail_status']);

		$update_avail_status = new update();
		$update_avail_status->updateAvailStatus($update_avail_prod_id,$prod_avail_status);
	}elseif(isset($_REQUEST['delete_prod'])){
		$delete_prod_id = secured($_REQUEST['delete_prod']);

		$delete_prod = new delete();
		$delete_prod->deleteProd($delete_prod_id);
	}elseif(isset($_POST['change_profile']) && secured($_POST['function'] == "change_profile")){
		$change_img = $_FILES['change_img']['name'];

		$change_prof_img = new update();
		$change_prof_img->changeProfImg($change_img);
	}elseif(isset($_POST['update_info']) && secured($_POST['function'] == "update_info")){
		$acc_fname = secured($_POST['acc_fname']);
        $acc_mname = secured($_POST['acc_mname']);
        $acc_lname = secured($_POST['acc_lname']);
        $acc_lname = secured($_POST['acc_lname']);
        $acc_birth = secured($_POST['acc_birth']);
        $acc_phone = secured($_POST['acc_phone']);
        $acc_email = secured($_POST['acc_email']);
        $acc_uname = secured($_POST['acc_uname']);
        $curr_pass = secured($_POST['curr_pass']);
        $new_pass = secured($_POST['new_pass']);

        $update_info = new update();
        $update_info->updateInfo($acc_fname,$acc_mname,$acc_lname,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass);
	}elseif(isset($_REQUEST['delete_prod_img'])){
		$delete_img_id = $_REQUEST['delete_prod_img'];

		$delete_img = new delete();
		$delete_img->deleteImg($delete_img_id); 
	}elseif(isset($_POST['add_img_prod']) && secured($_POST['function'] == "add_img_prod")){
		$prod_rand_id = secured($_POST['prod_img_id']);

		$insert_prod_img = new insert();
		$insert_prod_img->insertProdImg($prod_rand_id);
	}elseif(isset($_POST['prod_id']) && isset($_POST['prod_availability']) && secured($_POST['function'] == "change_available")){
		$prod_id = secured($_POST['prod_id']);
		$prod_availability = secured($_POST['prod_availability']);

		$update_prod_status = new update();
		$update_prod_status->updateProdStatus($prod_id,$prod_availability);
	}
	else{
		ob_end_flush(header("Location: index.php"));
	}
}else{
	return false;
}
?>