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
                <div class="d-flex">
                    <button type="submit" class="btn bgred ml-3 btnround" id="recharge_btn" data-toggle="modal" data-target='#rechView1'>
                        Self Recharge
                    </button>

                    <form action="<?= base_url(WEB_PORTAL_FRANCHISE . '/download_progress_report/') . $specific_level_user_id . '/' . $this->session->userdata(session_franchise_table) ?>" method="post" target="_blank">
                        <button type="submit" class="btn bgred ml-3 btnround">
                            Download Progress Report
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="page-content fade-in-up">
        <input type="hidden" value="<?= $specific_level_user_id ?>" id="specific_id">
        <input type="hidden" value="<?= $this->session->userdata(session_franchise_table) ?>" id="specific_table">
        <input type="hidden" value="<?= $this->session->userdata(session_franchise_user_id) ?>" id="user_id">
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
                        <div class="m-b-5">Total KM Purchased Today</div>
                        <h2 class="m-b-5 font-strong totalKmPurchaseToday">0</h2>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Sarathi</div>
                        <h2 class="m-b-5 font-strong totalSarathi">0</h2>
                    </div>
                </div>
            </div>

            <?php if ($this->session->userdata(session_franchise_type_id) != 'user_sub_franchise') { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
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
                        <canvas id="myChart" style="width:100%;height: 24rem;"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- END PAGE CONTENT-->

    <!-- recharge details view modal -->
    <div class="modal fade custmmodl" id="rechView1" tabindex="-1" role="dialog" aria-labelledby="rechView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title bank-modal-title" id="exampleModalLongTitle">Rechage Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mx-4">

                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control  mb-3" type="hidden" placeholder="Sub Franchise Id" id=''>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="select_package">
                                    <option value="0" class="form-control">Select Recharge Package</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                    <button type="button" class="btn  btn-success" id="btn_recharge">Recharge</button>
                    <button type="button" class="btn  btn-success" id="btn_confirm" style="display:none;">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="loaderbg" style="display: none;">
        <img src="<?= base_url() ?>assets/images/succesfull_payment.gif">
    </div>



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

    .loaderbg {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 9999;
        background-color: rgba(0, 0, 0, 0.4);
        top: 0;
        left: 0;
    }
</style>