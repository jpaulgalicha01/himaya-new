<body class="menu">
	<!-- Navbar -->
	<div class="container-fluid py-3 px-4">
		<div class="row d-flex align-items-center py-3">
			<div class="col-xl-4 col-lg-4 col-md-4 col-0 d-xl-block d-lg-block d-md-block d-none px-0">
					<div class="form-goup d-flex">
						<div class="col-10">
								<input type="text" name="user_name_get_ser" id="search_prod" class="form-control rounded" placeholder="Search the name ex.(Trucks, Vans, and etc..)">
                        <div class="card rounded " id="search-bar">
                            <div style="overflow-y: auto;" id="search_prod_list">
                              
                            </div>
                        </div>
						</div>
                		
					</div>
					
			</div>
				

			<div class="col-xl-4 col-lg-4 col-md-4 col-6 text-xl-center text-lg-center text-md-center text-start">
				<a href="index.php"><img src="images/himaya-logo.png" width="35%" style="height:100%; max-height:150px;"></a>	
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-6 d-flex justify-content-end  align-items-center">
				<a href="login.php" class="btn btn-outline-none btn-lg"><i class="fa-regular fa-user"></i></a>
				<div class="d-xl-none d-lg-none d-md-none d-block">
					<div class="menu-custom">
	                    <div class="menu-custom-burger">
	                            
	                    </div>
	                </div>
				</div>
			</div>
		</div>
		<div class="dropDownContent">
			<div class="px-5">
				<div class="link-1">
                    <div style="cursor:pointer">
                            <div class="pt-2" onclick="categories();">
                                <span>Categories</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                            </div>
                    </div>

                        <a href="recipe_guides.php" class="links">
                            <div class="pt-2">
                                <span>About Us</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                            </div>
                        </a>

                        <a href="faq.php" class="links">
                            <div class="pt-2">
                                <span>Privacy Policy</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                            </div>
                        </a>
                </div>
                <div class="link-2">
                	<div style="cursor:pointer">
                            <div class="pt-2" onclick="categoriesBack();">
                                <span><b><<u>Categories</u></b></span>
                            </div>
                            <br>
                        	<a href="carrier.php" class="links"><span class="fs-6"><b>Carrier</b></span></a>
                            <a href="carrier.php#trucks" class="links">
                                <div class="pt-2">
                                    <span>Trucks</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                                </div>
                            </a>
                            <a href="carrier.php#vans" class="links">
                                <div class="pt-2">
                                    <span>Van</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                                </div>
                            </a>
                            <a href="carrier.php#tricyles" class="links">
                                <div class="pt-2">
                                    <span>Tricyle</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                                </div>
                            </a>
                            <br>
                        	<a href="trade.php" class="links"><span class="fs-6"><b>Trade</b></span></a>
                            <a href="trade.php#vegetables" class="links">
                                <div class="pt-2">
                                    <span>Vegetables</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                                </div>
                            </a>
                            <a href="trade.php#poultry" class="links">
                                <div class="pt-2">
                                    <span>Poultry</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                                </div>
                            </a>
                            <a href="trade.php#other_items" class="links">
                                <div class="pt-2">
                                    <span>Other Items</span><span class="float-end"><i class="fa-solid fa-greater-than"></i></span>
                                </div>
                            </a>
                    </div>
                </div>

			</div>
        </div>

		<hr>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-0 d-xl-block d-lg-block d-md-block d-none">
				<div class="d-flex justify-content-center">
					<div class="px-4 showdropDownMenuHover">
		                <a href="index.php#categories" class="links">Categories</a>

		                <div class="navbarMenuHover">
		                	<div class="dropNavbarMenuHover">
		                		<div class="px-5 py-3" >
                        			<div class="d-flex row">
			                            <div class="col-3">
				                            <span class="fw-bold links">Carrier</span><br>
				                            <a href="carrier.php#trucks" class="m-1 links">Trucks</a><br>
				                            <a href="carrier.php#vans" class="m-1 links">Vans</a><br>
				                            <a href="carrier.php#tricyles" class="m-1 links">Tricycles</a><br>
			                            </div>
			                            <div class="col-3">
				                            <span class="fw-bold links">Trade</span><br>
				                            <a href="trade.php#vegetables" class="m-1 links">Vegetables</a><br>
				                            <a href="trade.php#poultry" class="m-1 links">Poultry</a><br>
				                            <a href="trade.php#other_items" class="m-1 links">Other items</a><br>
			                            </div>
                        			</div>
                        		</div>
		                	</div>
		                </div>
		            </div>
		            <div class="px-4">
		                <a href="faq.php" class="links">About Us</a>
		            </div>
		            <div class="px-4">
		                <a href="faq.php" class="links">Privacy Policy</a>
		            </div>

				</div>
			</div>
		</div>
	</div>
	<!-- End Navbar -->	