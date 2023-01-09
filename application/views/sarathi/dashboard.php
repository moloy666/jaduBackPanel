<?php
foreach ($sarathi_data as $data) {
    $sarathi_id = $data->sarathi_id;
}
?>
<input type="hidden" value="<?= $sarathi_id ?>" id="sarathi_id">
<input type="text" value="<?=$this->session->userdata(session_sarathi_user_id)?>" id="user_id">

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->

    <div class="mt-2 row">
        <div class="col-lg-6">
            <?php if ($this->session->userdata(session_sarathi_status) != const_active) { ?>
                <div class="div mt-2">
                    <div class="form-group">
                        <strong class="text-danger">Your Account Is Currently Not Active !</strong>
                    </div>
                </div>
            <?php
            } ?>
        </div>

        <div class="col-lg-6">
            <div class="form-group float-right">
                <form action="<?= base_url('administrator/download_progress_report/') . $sarathi_id ?>" method="post" target="_blank">
                    <button type="submit" class="btn bgred ml-3 btnround">
                        Download Progress Report
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Drivers</div>
                        <h2 class="m-b-5 font-strong totalDrivers"></h2>

                        <div><i class="fa fa-level-up m-r-5"></i><small><strong>Active</strong> <span class="totalActiveDrivers"></span></small></div>
                        <div><i class="fa fa-level-down m-r-5"></i><small><strong>Inctive</strong> <span class="totalInactiveDrivers"></span></small></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Registered Customer</div>
                        <h2 class="m-b-5 font-strong totalRegisteredCustomers">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Ongoing Ride</div>
                        <h2 class="m-b-5 font-strong totalCarRunning">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total KM Purchased</div>
                        <h2 class="m-b-5 font-strong totalKmPurchased">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total KM Purchased Today</div>
                        <h2 class="m-b-5 font-strong totalKmPurchaseToday">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total revenue generated</div>
                        <h2 class="m-b-5 font-strong totalRevenue">0</h2>
                        <i class="widget-stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="27.636" viewBox="0 0 19 27.636">
                                <path id="rupee-svgrepo-com" d="M25,7.454V4H6V7.454h6.045a5.17,5.17,0,0,1,4.862,3.454H6v3.454H16.907a5.171,5.171,0,0,1-4.862,3.454H6v4.17l9.648,9.648h4.885L10.17,21.272h1.876a8.648,8.648,0,0,0,8.46-6.909H25V10.909H20.505a8.52,8.52,0,0,0-1.6-3.454Z" transform="translate(-6 -4)" fill="#fff" />
                            </svg>
                        </i>
                        <div><i class="fa fa-level-up m-r-5"></i><small><strong id="growth">0</strong> % Improvement</small></div>
                    </div>
                </div>
            </div>



        </div>

        <div class="row">

            <div class="col-md-7">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Driver Wise Data</div>
                    </div>
                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                                <thead class="">
                                    <tr>
                                        <th>Name</th>
                                        <th>KM Purchased</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Number</th>
                                        <th>Joined At</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>KM Purchased</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Number</th>
                                        <th>Joined At</th>

                                    </tr>
                                </tfoot>
                                <tbody class="driverRelatedDataTable">


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-5">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Driver Total KM Purchased</div>
                    </div>
                    <div class="ibox-body">
                        <canvas id="myChart" style="width:100%;height: 24rem;"></canvas>
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

<style type="text/css">
    .totalDrivers {
        float: right
    }

    .ibox .dashboard-card {
        height: 8rem;
    }
</style>