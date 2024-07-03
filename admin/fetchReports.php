<?php
include 'includes/autoload.inc.php';
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["userList"]) && isset($_GET["type_product"]) && isset($_GET["availability"]) && $_GET["function"] == "fetching_reports"){

        
                if($_GET["type_product"] == "Trade"){
                    ?>
                        <thead class='table-dark'>
                            <tr>
                                <th>Name</th>
                                <th>Product Name</th>
                                <th>Date of Harvest</th>
                                <th>Product Description</th>
                                <th>Expected Trade</th>
                                <th>Expected Date</th>
                                <th>Contact No.</th>
                                <th>Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $check =new fetch();
                                $res = $check->fetchReport($_GET["userList"],$_GET["type_product"],$_GET["availability"]);
                                if($res->rowCount()>0){
                                    while($row = $res->fetch()){
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                        $user = new fetch();
                                                       echo $user->fetchUser($row['prod_post_user_id']);
                                                    ?>
                                                </td>
                                                <td><small><?=$row['product_name']?></small></td>
                                                <td><small><?=$row['trade_date_of_harvest']?></small></td>
                                                <td><small><?=$row['trade_description']?></small></td>
                                                <td><small><?=$row['trade_expected_trade']?></small></td>
                                                <td><small><?=$row['trade_duration_date']?></small></td>
                                                <td><small><?=$row['product_contact']?></small></td>
                                                <td><small><?=$row['product_address']?></small></td>
                                                <td><small><?=$row['product_status']?></small></td>

                                            </tr>
                                        <?php
                                    }
                                }
                                else{
                                    echo "<td colspan='9' class='text-center'>No Data Found</td>";
                                                   
                                }
                            ?>
                           
                        </tbody>
                    <?php
                }
            
        
        else{
            ?>
                <thead class='table-dark'>
                    <tr>
                        <th>Name</th>
                        <th>Carrier Capacity</th>
                        <th>Contact No.</th>
                        <th>Address</th>
                        <th>Standardize</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $check =new fetch();
                    $res = $check->fetchReport($_GET["userList"],$_GET["type_product"],$_GET["availability"]);
                    if($res->rowCount()>0){
                        while($row = $res->fetch()){
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                            $user = new fetch();
                                            echo $user->fetchUser($row['prod_post_user_id']);
                                        ?>
                                    </td>
                                    <td><small><?=$row['carrier_cap']?></small></td>
                                    <td><small><?=$row['product_contact']?></small></td>
                                    <td><small><?=$row['product_address']?></small></td>
                                    <td><small><?=$row['carrier_standardize']?></small></td>
                                    <td><small><?=$row['product_status']?></small></td>
                                </tr>
                            <?php
                        }
                    }
                    else{
                        echo "<tr><td colspan='6' class='text-center'>No Data Found</td></tr>";
                                        
                    }
                ?>
                
            </tbody>
            <?php
        }
    }  
}
else{
	ob_end_flush(header("Location: index.php"));
}
?>