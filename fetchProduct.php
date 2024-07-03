<?php
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['search_prod']) && $_POST['function']=="search_prod"){
        $value = secured($_POST['search_prod']);

        $fetch_prod = new fetch();
        $res_fetch_prod = $fetch_prod->fetchProd($value);
        if($res_fetch_prod->rowCount()>0){
            while($row = $res_fetch_prod->fetch()){
                if($row['product_categories'] == "Carrier"){
                ?>
                    <div class="px-2 py-2 ">
                        <div class="form-list-group">
                            <ul class="nav-item text-start">

                                <?php
                                    switch ($row["product_type"])
                                    {
                                        case "Trucks":
                                            ?>
                                                <a href="carrier.php#trucks" class="nav-link text-dark" value="asdd" id="btn_user_name">
                                            <?php
                                        break;

                                        case "Vans":
                                            ?>
                                                <a href="carrier.php#vans" class="nav-link text-dark" value="asdd" id="btn_user_name">
                                            <?php
                                            break;
                                        default:
                                            ?>
                                                <a href="carrier.php#tricycles" class="nav-link text-dark" value="asdd" id="btn_user_name">
                                            <?php
                                            break;
                                    }
                                ?>
                                                    <div class="col-12">
                                                        <img src="uploads/<?=$row['product_image']?>" width="50px" height="50px">
                                                        <span class="px-2"><?=$row['product_name']?></span>
                                                    </div>
                                                </a>
                            </ul>
                        </div>
                    </div>
                <?php
                }else{
                    ?>
                        <div class="px-2 py-2">
                            <div class="form-list-group">
                                <ul class="nav-item text-start">


                                    <?php
                                    switch ($row["product_type"])
                                    {
                                        case "Vegetables":
                                            ?>
                                                <a href="trade.php#vegetables" class="nav-link text-dark" value="asdd" id="btn_user_name">
                                            <?php
                                        break;

                                        case "Poultry":
                                            ?>
                                                <a href="trade.php#poultry" class="nav-link text-dark" value="asdd" id="btn_user_name">
                                            <?php
                                            break;
                                        default:
                                            ?>
                                                <a href="trade.php#other_items" class="nav-link text-dark" value="asdd" id="btn_user_name">
                                            <?php
                                            break;
                                    }
                                ?>
                                                    <div class="col-12">
                                                        <img src="uploads/<?=$row['product_image']?>" width="50px" height="50px">
                                                        <span class="px-2"><?=$row['product_name']?></span>
                                                    </div>
                                                </a>









                                </ul>
                            </div>
                        </div>
                    <?php
                }
            }
        }else{
            ?>
                <div class="px-2 py-2">
                    <div class="form-list-group">
                        <ul class="nav-item text-center">
                            <p>No Data Found</p>
                        </ul>
                    </div>
                </div>
            <?php
        }
        
    }else{
        ob_end_flush(header("Location: index.php"));
    }
}else{
    return false;
}
?>


