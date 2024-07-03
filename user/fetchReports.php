<?php
include 'includes/autoload.inc.php';
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["type_product"]) && isset($_GET["availability"]) && $_GET["function"] == "fetching_reports"){

        $check =new fetch();
        $res = $check->fetchReport($_GET["type_product"],$_GET["availability"]);
        if($res->rowCount()>0){
            while($row = $res->fetch()){
                ?>
                    <tr>
                    <td><small><?=$row['product_name']?></small></td>
                    <td><small><?=$row['product_type']?></small></td>
                    <td><small><?=$row['product_status']?></small></td>
                    <td><small><?=$row['product_availability']?></small></td>
                    </tr>
                
                <?php
            }
        }else{
		    echo"<tr><td colspan='4' class='text-center'>No Data Found</td></tr>";
        }
    }  
}
else{
	ob_end_flush(header("Location: index.php"));
}
?>