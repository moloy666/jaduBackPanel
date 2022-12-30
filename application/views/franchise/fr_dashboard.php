<div class="content-wrapper">
    <!-- START PAGE CONTENT-->

    <div class="mt-2 row">
        <div class="col-lg-6">
            <?php if ($this->session->userdata(session_franchise_status) != const_active) { ?>
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
                <form action="<?= base_url(WEB_PORTAL_FRANCHISE . '/download_progress_report/') . $specific_level_user_id ?>" method="post" target="_blank">
                    <button type="submit" class="btn bgred ml-3 btnround">
                        Download Progress Report
                    </button>
                </form>
            </div>
        </div>
    </div>


    <div class="page-content fade-in-up">
        <input type="hidden" value="<?= $specific_level_user_id ?>" id="specific_id">
        <input type="hidden" value="<?= $this->session->userdata(session_franchise_table) ?>" id="specific_table">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Drivers</div>
                        <h2 class="m-b-5 font-strong totalDrivers">0</h2>


                        <div><i class="fa fa-level-up m-r-5"></i><small><strong>Active</strong> <span class="totalActiveDrivers">0</span></small></div>
                        <div><i class="fa fa-level-down m-r-5"></i><small><strong>Inctive</strong> <span class="totalInactiveDrivers">0</span></small></div>
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
                        <h2 class="m-b-5 font-strong totalOngoingRide">0</h2>
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
                        <div class="m-b-5">Total Sarathi</div>
                        <h2 class="m-b-5 font-strong totalSarathi">0</h2>
                    </div>
                </div>
            </div>

            <?php if ($this->session->userdata(session_franchise_type_id) != 'user_sub_franchise') { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body dashboard-card">
                            <div class="m-b-5">Total Sub Franchise</div>
                            <h2 class="m-b-5 font-strong totalSubFranchise">0</h2>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>




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

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Sarathi Wise Data</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Refferal Code</th>
                                    <th>KM Purchased</th>
                                    <th>Joined At</th>
                                    <th>Number Of Driver</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Refferal Code</th>
                                    <th>KM Purchased</th>
                                    <th>Joined At</th>
                                    <th>Number Of Driver</th>
                                </tr>
                            </tfoot>
                            <tbody class="sarathiRelatedDataTable">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Sarathi Wise Data</div>
                    </div>
                    <div class="ibox-body">
                        <canvas id="myChart" style="width:100%;height: 44rem;"></canvas>
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