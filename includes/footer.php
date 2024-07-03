<div class="container-fluid">
	<div class="row bg-danger py-2 d-flex align-self-center">
		<p class="text-center text-white">Himaya ©️ <?=date("Y")?></p>
	</div>
</div>

</body>
<script type="text/javascript">
	$(document).ready(function(){
        $("#search_prod").keyup(function(){
            var search_prod = $(this).val();
            // alert(search_prod);
            $.ajax({
                method:"POST",
                url:"fetchProduct.php",
                data:{search_prod:search_prod, function:"search_prod"},
                success:function(response){
                    if(search_prod !==""){
                        $("#search-bar").css("visibility","visible");
                        $("#search_prod_list").html(response);

                    }else{
                        $("#search-bar").css("visibility","hidden");
                    }
                }
            })
            
        });
        $("#search_prod").trigger("keyup");

        $(document).on('click','.row',function(){
          $("#search-bar").css("visibility","hidden");
        })
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js" defer></script>
<script src="js/main.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="http://www.datejs.com/build/date.js" type="text/javascript" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>