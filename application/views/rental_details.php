<style>
    .title {
        text-transform: capitalize;
    }

    .box {
        width: auto;
        height: 40px;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Rental Details</h3>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">
                        <!-- <button type="button" class="btn bgred ml-3 btnround" data-toggle="modal" data-target="#addNewUsr1" id="add_new">
                            Add New <i class="fa fa-plus ml-2"></i>
                        </button> -->
                    </div>
                </div>
            </div>

            <div class="row m-2">
                <div class="card  py-2 col">
                    <h5 class="ml-2 my-1">Choose cab Types</h5>
                    <div class="card-body d-flex align-items-center">
                        <div class="form-group col-lg-8 mr-3">
                            <select name="" id="cab_types" class="form-control title">
                                <option value="">Choose cab Types</option>
                                <option value="">Sedan</option>
                            </select>
                        </div>

                        <div class="form-group float-right">
                            <button class="btn btn-success access_insert" id="btn_features" disabled>Add Features</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row m-2" id="slab_details" style="display:none">
                <div class="card py-2 col">
                    <h5 class="ml-2 my-1">Slab Details</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Slabs</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Extra Km Fare</th>
                                        <th class="text-center">Extra Ride Time Fare</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="table_details">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!-- <div class="card py-3 col-md-6">
                    <h5 class="ml-2 my-2">Rental Details</h5>
                    <h6 id="message"></h6>
                    <div class="card-body">
                        <div class="d-flex justified-content-between align-items-center">
                            <div class="form-group mx-1">
                                <small class="ml-2">Amount</small>
                                <input type="text" class="form-control p-2" id="amount" placeholder="Amount">
                            </div>
                            <div class="form-group mx-1">
                                <small class="ml-2">Extra Km Fare</small>
                                <input type="text" class="form-control p-2" id="extra_km_fare" placeholder="Extra Km Fare">
                            </div>
                            <div class="form-group mx-1">
                                <small class="ml-2">Extra Ride Time Fare</small>
                                <input type="text" class="form-control p-2" id="extra_ride_time_fare" placeholder="Extra Ride Time Fare">
                            </div>
                        </div>
                        <div class="float-right mt-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div> -->

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
        <div class="modal-dialog modal-sm modal-dialog-centered" style="width:500px">
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

    <!-- Add new user modal -->

    <div class="modal fade custmmodl" id="features" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Features</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="features_details">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="checkbox" id="check" placeholder="Enter Name" id='add_name' name="name" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- <input class="form-control" type="text" placeholder="Mobile Number" id='add_mobile' name="mobile" required="required"> -->
                                <h5>Comfy Hatch</h5>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" style="display:none">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btn_add_data">Add Features</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit user modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Slab</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" value="" placeholder="Your Name" id="edit_id">
                                    <input class="form-control" type="text" value="Ramesh janha" placeholder="Enter Hour" id="edit_hour">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="number" value="" placeholder="Enter KM" id="edit_km">
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


    <!-- Banking details view modal -->
    <div class="modal fade custmmodl" id="bnkView1" tabindex="-1" role="dialog" aria-labelledby="bnkView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title bank-modal-title" id="exampleModalLongTitle">Banking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">Account Holder Name</strong>
                                <input class="form-control" type="text" value="" placeholder="Account Holder Name" id="acc_name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">Account Number</strong>
                                <input class="form-control" type="text" value="" placeholder="Account Number" id="acc_number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">IFSC</strong>
                                <input class="form-control" type="text" value="" placeholder="IFSC" id="ifsc">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">Bank Name</strong>
                                <input class="form-control" type="text" value="" placeholder="Bank Name" id="bank_name">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                </div>
            </div>
        </div>
    </div>