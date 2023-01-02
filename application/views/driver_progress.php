<style type="text/css">
    .totalDrivers {
        float: right
    }

    .ibox .dashboard-card {
        height: 8rem;
    }

    td {
        text-align: center;
        text-transform: capitalize;
    }

    table,
    th,
    td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    th,
    td {
        width: max-content;
        height: 40px;
    }

    .report {
        margin-bottom: 20px;
    }

    .report_details tr td {
        height: 120px;
        width: 200px;
    }

    #txt_report {
        margin-bottom: 10px;
    }
</style>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->

    <div class="page-content fade-in-up">

        <div class="report">
            <!-- <div>
                <div class="form-group">
                    <img src="<?=base_url()?>assets/images/logos/logo.png" alt="" width="100px">
                </div>
            </div> -->

       
            <div>
                <strong id="txt_report">Progress Report of <?= $data['name'] ?></strong>
            </div>

          
            <div class="table-responsive ">
                <table class="table table-striped table-bordered table-hover report_details" id="table" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <div>
                                <div class="m-b-5">Vehicle Number</div>
                                <h2 class="m-b-5 font-strong totalRegisteredCustomers"><?= $data['vehicle_number'] ?></h2>
                            </div>
                        </td>

                        <td>
                            <div>
                                <div class="m-b-5">Total Ride Time</div>
                                <h2 class="m-b-5 font-strong totalCarRunning"><?= number_format($data['totalRideTime'] / 60, 1) ?> Hr</h2>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <div class="m-b-5">Total Travelled</div>
                                <h2 class="m-b-5 font-strong totalRegisteredCustomers"><?= $data['totalTravelled'] ?> Km</h2>
                            </div>
                        </td>

                        <td>
                            <div>
                                <div class="m-b-5">Total KM Purchased</div>
                                <h2 class="m-b-5 font-strong totalKmPurchased"><?= $data['total_km_purchased'] ?> KM</h2>
                            </div>
                        </td>

                    </tr>

                </table>
            </div>
        </div>

    </div>
    <!-- END PAGE CONTENT-->

</div>
</div>
<!-- BEGIN THEME CONFIG PANEL-->

<!-- END THEME CONFIG PANEL-->