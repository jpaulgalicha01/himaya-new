<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
$_SESSION['title'] = "Dashboard";

include 'includes/header.php';

?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <br>
        <div class="row">
            <h5 class="fs-5">User Account Status</h5>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Accept Accounts</p>
                        <span class="text-bold">
                            <?php
                                $count_user_accept = new fetch();
                                $count_user_accept->countUserAccept();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="user-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Declined Accounts</p>
                        <span class="text-bold">
                            <?php
                                $count_user_accept = new fetch();
                                $count_user_accept->countUserDecline();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="user-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Pending Account</p>
                        <span class="text-bold">
                            <?php
                                $count_user_accept = new fetch();
                                $count_user_accept->countUserPending();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="user-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <h5 class="fs-5">Trading Products</h5>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Accept Products</p>
                        <span class="text-bold">
                            <?php
                                $trade_accept = new fetch();
                                $trade_accept->tradeAccept();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="trade-product-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Decline Products</p>
                        <span class="text-bold">
                            <?php
                                $trade_accept = new fetch();
                                $trade_accept->tradeDecline();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="trade-product-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>            
            <div class="col-xl-4 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Pending Products</p>
                        <span class="text-bold">
                            <?php
                                $trade_accept = new fetch();
                                $trade_accept->tradePending();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="trade-product-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <h5 class="fs-5">Carrier Products</h5>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Accept Products</p>
                        <span class="text-bold">
                            <?php
                                $carrier_accept = new fetch();
                                $carrier_accept->carrierAccept();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="carrier-product-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Decline Products</p>
                        <span class="text-bold">
                            <?php
                                $carrier_accept = new fetch();
                                $carrier_accept->carrierDecline();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="carrier-product-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>            
            <div class="col-xl-4 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        <p class="fs-5">Pending Products</p>
                        <span class="text-bold">
                            <?php
                                $carrier_accept = new fetch();
                                $carrier_accept->carrierPending();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="carrier-product-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include 'includes/footer.php';
?>
