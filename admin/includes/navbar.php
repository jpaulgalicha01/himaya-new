            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">User List</div>
                            <a class="nav-link" href="user-list.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                                Account User List <span class="badge text-bg-secondary" >
                                    <?php
                                        $count_user_accept = new fetch();
                                        $count_user_accept->countUserPending();
                                    ?>
                                </span>
                            </a>
                            <div class="sb-sidenav-menu-heading">User Management</div>
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="carrier-product-list.php">Carrier Products</a>
                                    <a class="nav-link" href="trade-product-list.php">Trade Products</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="activity-logs.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-desktop"></i></div>
                                Activity Logs
                            </a>
                            <a class="nav-link" href="reports.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-desktop"></i></div>
                                Reports
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        (<?=$user_fname?>)
                    </div>
                </nav>
            </div>