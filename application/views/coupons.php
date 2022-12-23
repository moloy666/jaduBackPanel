<style>
    .uppercase {
        text-transform: uppercase;
    }

    .title {
        text-transform: capitalize;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Coupons</h3>
                    <input type="hidden" value="<?= $this->session->userdata(session_admin_specific_id) ?>" id="specific_id">
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">

                        <button type="button" class="btn bgred ml-3 btnround access_insert" data-toggle="modal" data-target="#addNewUsr1 " disabled>
                            Add New <i class="fa fa-plus ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card p-2">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Code</th>
                                <th class="text-center">For</th>
                                <th class="text-center">Amount Type</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Validity</th>
                                <th class="text-center">Expiry Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <div class="modal fade delemodel" id="deltmodl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content p-4 text-center">
                <h5 class="mb-4">Are you sure want to
                    delete this user permanently ?</h5>
                <div class="d-flex align-items-center justify-content-center">
                    <button class="btn-secondary btn" data-dismiss="modal" id="close_delete_modal">No</button>
                    <button class="btn-success btn ml-3" id="btn_delete_data">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add new franchise modal -->
    <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_data_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="coupon_type">
                                        <option value="0">Select Coupon Type </option>
                                        <option value="percentage">Percentage (%)</option>
                                        <option value="rupees">Rupees</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="for_user">
                                        <option value="0">Select User Type </option>
                                        <option value="new_user">New User</option>
                                        <option value="regular_user">Regular User</option>
                                        <option value="regular_user">All User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Coupon Value" id='value' autocomplete="off">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="date" placeholder="Expiry Date" id='expired_at' min="<?= date('Y-m-d') ?>" autocomplete="off">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button class="btn btn-success" id="btn_add_data">Add Coupon</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit franchise modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Coupons Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_form">
                        <div class="row">
                            <input type="hidden" id="edit_id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="edit_coupon_type">
                                        <option value="0">Select Coupon Type </option>
                                        <option value="percentage">Percentage (%)</option>
                                        <option value="rupees">Rupees</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="edit_for_user">
                                        <option value="0">Select User Type </option>
                                        <option value="new_user">New User</option>
                                        <option value="regular_user">Regular User</option>
                                        <option value="all_user">All User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Coupon Value" id='edit_value' autocomplete="off">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="date" placeholder="Expiry Date" id='edit_expired_at' min="<?= date('Y-m-d') ?>" autocomplete="off">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn_update_data">Save Changes</button>
                </div>
            </div>
        </div>
    </div>