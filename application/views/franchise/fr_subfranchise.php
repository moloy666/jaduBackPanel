<style>
    .title {
        text-transform: uppercase;
    }
</style>

<body onload="get_subfranchise_details()">
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Sub Franchise</h3>
                    <input type="hidden" value="<?= $specific_id ?>" id="specific_id">
                    <input type="hidden" value="<?= $this->session->userdata(session_franchise_table) ?>" id="specific_table">
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
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Status</th>
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

                                <input class="form-control  mb-3" type="text" placeholder="Sub Franchise Id" id='' style="height:40px;background-color:transparent;">

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
                </div>
            </div>
        </div>
    </div>

    <!-- Add new subfranchise modal -->
    <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Sub Franchise</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_data_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Name" id='add_name' autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="number" placeholder="Mobile Number" id='add_mobile' autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Enter Email" id='add_email' autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" id="pincode" placeholder="Enter Pincode"></textarea>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <select name="franchise_id" id="franchise_id" class="form-control title">
                                        <option value="<?= $specific_id ?>" class="title"><?= $this->session->userdata(session_franchise_name) ?></option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="access_list" placeholder="Select Management" multiple>
                                        <option value="0">Select Management </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="panel_access_list" multiple>
                                        <option value="0">Select Management </option>
                                    </select>
                                </div>
                            </div>

                           

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="address" rows="3" placeholder="Enter Address"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="country" class="form-control title">
                                        <option value="">Select Country</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="state" class="form-control title">
                                        <option value="">State Not Found</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="district" class="form-control title">
                                        <option value="">District Not Found</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="city" class="form-control title">
                                        <option value="">City Not Found</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button class="btn btn-success" id="btn_add_data">Add Sub Franchise</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit franchise modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Franchise</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" value="" placeholder="Your Id" id="edit_id">
                                    <input class="form-control title" type="text" value="" placeholder="Your Name" id="edit_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="" placeholder="Your Number" id="edit_number" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="" placeholder="Your Email" id="edit_email" disabled>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <select name="franchise_id" id="franchise_id" class="form-control title">
                                        <option value="<?= $specific_id ?>" class="title"><?= $this->session->userdata(session_franchise_name) ?></option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="edit_access_list" placeholder="Select Management" multiple>
                                        <option value="0">Select Management </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="edit_panel_access_list" multiple>
                                        <option value="0">Select Management </option>
                                    </select>
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