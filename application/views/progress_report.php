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
</style>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->

    <div class="page-content fade-in-up">

        <div class="report">
            <p style="text-align:center;"><img src="./assets/images/logos/logo-l.png" alt=""></p>
            <p style="text-align:center;"><strong>JaduRide Progress Report</strong></p>
            <div class="table-responsive ">
                <table class="table table-striped table-bordered table-hover report_details" id="table" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <div>
                                <div class="m-b-5">Registered Franchise</div>
                                <h2 class="m-b-5 font-strong totalsf"><?= $totalFranchise ?></h2>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="m-b-5">Registered Subfranchise</div>
                                <h2 class="m-b-5 font-strong totalsf"><?= $totalSubFranchise ?></h2>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="m-b-5">Registered Saathi</div>
                                <h2 class="m-b-5 font-strong totalsf"><?= $totalSarathi ?></h2>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <div class="m-b-5">Total Drivers</div>
                                <h2 class="m-b-5 font-strong totalDrivers"><?= $drivers['total'] ?></h2>

                                <div><i class="fa fa-level-up m-r-5"></i><small><strong>Active</strong> <span class="totalActiveDrivers"><?= $drivers['active'] ?></span></small></div>
                                <div><i class="fa fa-level-down m-r-5"></i><small><strong>Inctive</strong> <span class="totalInactiveDrivers"><?= $drivers['inactive'] ?></span></small></div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="m-b-5">Registered Customer</div>
                                <h2 class="m-b-5 font-strong totalRegisteredCustomers"><?= $totalCustomers ?></h2>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="m-b-5">Total Ongoing Ride</div>
                                <h2 class="m-b-5 font-strong totalCarRunning"><?= $totalCarRunning ?></h2>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <div class="m-b-5">Total KM Purchased</div>
                                <h2 class="m-b-5 font-strong totalKmPurchased"><?= $totalKmPurchase ?> KM</h2>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="m-b-5">Total KM Purchased Today</div>
                                <h2 class="m-b-5 font-strong">0</h2>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="m-b-5">Total revenue generated</div>
                                <h2 class="m-b-5 font-strong totalRevenue">₹ <?= $totalRevenue ?></h2>
                                <i class="widget-stat-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="27.636" viewBox="0 0 19 27.636">
                                        <path id="rupee-svgrepo-com" d="M25,7.454V4H6V7.454h6.045a5.17,5.17,0,0,1,4.862,3.454H6v3.454H16.907a5.171,5.171,0,0,1-4.862,3.454H6v4.17l9.648,9.648h4.885L10.17,21.272h1.876a8.648,8.648,0,0,0,8.46-6.909H25V10.909H20.505a8.52,8.52,0,0,0-1.6-3.454Z" transform="translate(-6 -4)" fill="#fff" />
                                    </svg>
                                </i>
                                <div><i class="fa fa-level-up m-r-5"></i><small><strong id="growth"><?= $revenueStatus ?></strong> % Improvement</small></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row table_details">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Saathi Wise Data</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Refferal Code</th>
                                    <th>KM Purchased</th>
                                    <th>Joined At</th>
                                    <th>Number Of Driver</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Refferal Code</th>
                                    <th>KM Purchased</th>
                                    <th>Joined At</th>
                                    <th>Number Of Driver</th>
                                </tr>
                            </tfoot>
                            <tbody class="sarathiRelatedDataTable">
                                <?php
                                if (!empty($sarathi_data)) {
                                    foreach ($sarathi_data as $i => $val) {
                                        if (!empty($val)) { ?>
                                            <tr>
                                                <td class="title"><?= $i + 1 ?></td>
                                                <td class="title"><?= $val['name'] ?> </td>
                                                <td class="text-center"><?= $val['refferal_code'] ?> </td>
                                                <td><?= $val['total_km_purchased'] ?> </td>
                                                <td><?= $val['joined'] ?> </td>
                                                <td><?= $val['totalDrivers'] ?> </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>Record Not Available</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

</div>
</div>
<!-- BEGIN THEME CONFIG PANEL-->

<!-- END THEME CONFIG PANEL-->