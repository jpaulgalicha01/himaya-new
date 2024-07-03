<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
$_SESSION['title'] = "Dashboard";

include 'includes/header.php';

?>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <br>

        <h5 class="mt-1">Trading Products</h5>
        <div class="row">
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
                                $trade_declined = new fetch();
                                $trade_declined->tradeDeclined();
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
                                $trade_pending = new fetch();
                                $trade_pending->tradePending();
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="trade-product-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="mt-1">Carrier Products</h5>
        <div class="row">
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
                                $carrier_declined = new fetch();
                                $carrier_declined->carrierDeclined();
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
                                $carrier_pending = new fetch();
                                $carrier_pending->carrierPending();
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
<?php
include 'includes/footer.php';
?>
