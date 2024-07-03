<?php

if(isset($_POST['value']) && $_POST['function'] == "fetch_status"){
    ?>
        <option selected>All</option>
        <option>Accept</option>
        <option>Decline</option>
        <option>Pending</option>
    <?php
}else{
    ob_end_flush(header("Location: index.php"));
}
?>

<script>
    $(document).ready(function(){
        $("#product_status").change(function(){
            var type_product = document.getElementById("type_product").value;
            var product_status = document.getElementById("product_status").value;
            $.ajax({
                type: "POST",
                url:"fetchTradeProduct.php",
                data: {value: type_product, status:product_status,function:"fetch_trade"},
                success:function(response){
                    $("#result").html(response);
                }
            })
        });
        $("#product_status").trigger("change");
    });
</script>