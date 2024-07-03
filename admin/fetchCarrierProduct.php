<?php
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['value']) && isset($_POST['status'])&& $_POST['function'] == "fetch_trade"){
        $value = $_POST['value'];
        $status = $_POST['status'];

            $fetch_trade_product = new fetch();
            $res = $fetch_trade_product->fetchCarrierProduct($value,$status);
            if($res->rowCount()>0){
                while($row = $res->fetch()){
                   ?>
                        <tr>
                            <td class="text-center">
                                <a href="../uploads/<?=$row['product_image']?>" target="__blank">
                                    <img src="../uploads/<?=$row['product_image']?>" width="30" height="30" />
                                </a>
                                
                            </td>
                            <td><small><?=$row['product_post_name']?></small></td>
                            <td><small><?=$row['product_name']?></small></td>
                            <td><small><?=$row['product_type']?></small></td>
                            <td><small><?=$row['product_status']?></small></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" id="view_product" value="<?=$row['prod_id']?>">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                            
                        </tr>
                    <?php 
                }
            }else{
                echo"<tr><td colspan='6' class='text-center'>No Data Found</td></tr>";
            }
    }else{
        ob_end_flush(header("Location: index.php"));
    }

}else{
    return false;
}

?>
