<?php
include 'includes/autoload.inc.php';
unset($_SESSION['title']);
$_SESSION['title'] = "Activity Logs";

include 'includes/header.php';
?>
<main>
    <div class="container-fluid px-4 ">
        <h1 class="mt-4">Activity Logs</h1>
        <br>
        <div class="card mb-4 ">
             <div class="card-header ">
                <i class="fas fa-table me-1"></i>
                List of Activity
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-start">
                    <div class="col-xl-4 col-lg-4 col-12 pb-3 m-2">
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
                <div class="printableTable" style="width: 100%;">
                     <h4 class="print-title">List of Activity</h4>
                    <table class="table table-light table-striped ">
                        <thead class="table-dark">
                            <tr>
                                <th>Activtys</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                    </table>  
                </div>
                
                <div class="text-end">
                    <button class="btn btn-success btn-sm" onclick="window.print()"><i class="fa-solid fa-print"></i></button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $("#result").html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>Loading...");
        $.post("fetchActivity.php",{date_start: start.format('YYYY-MM-DD'), date_end: end.format('YYYY-MM-DD'), function:"fetch_activity" }, function(data, status){
            $("#result").html(data);
        });
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>

<?php
    include 'includes/footer.php';
?>