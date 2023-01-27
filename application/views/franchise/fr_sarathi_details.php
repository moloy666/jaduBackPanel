<style>
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
                    <?php $user_type = $this->uri->segment(1); ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color:transparent;">
                            <li class="breadcrumb-item"><a href="<?= base_url($user_type . '/saathi') ?>">Saathi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Drivers</li>
                        </ol>
                    </nav>
                    <h5 class="text-primary ml-3" id="sarathi_name">
                        <?php
                        foreach ($sarathi_data as $data) {
                            echo ucwords($data->name);
                            $sarathi_id = $data->sarathi_id;
                        }
                        ?>
                    </h5>

                    <strong class="text-primary ml-3">
                        <?php
                        foreach ($sarathi_data as $data) {
                            echo ($data->mobile);
                        }
                        ?>
                    </strong>
                    <br>
                    <strong class="text-primary ml-3">
                        <?php
                        foreach ($sarathi_data as $data) {
                            echo ($data->email);
                        }
                        ?>
                    </strong>

                    <input type="hidden" value="<?= $sarathi_id ?>" id="sarathi_id">

                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">

                    </div>
                </div>
            </div>

            <div class="card py-2 mb-2">
                <h5 class="ml-2 mb-2">Driver Details</h5>
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


            <div class="card py-2 mt-2">
                <h5 class="ml-2 mb-2">Recharge History</h5>

                <div class="table-responsive">
                    <table class="table table-bordered" id="recharge_table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Recharge Type</th>
                                <th>Price</th>
                                <th>Purchased KM</th>
                                <th>Description</th>
                                <th>Recharge Note</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody id="recharge_history">

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

    <!-- Add new user modal -->

    <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Saathi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_data_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Name" id='add_name' name="name" required="required">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Mobile Number" id='add_mobile' name="mobile" required="required">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Email" id='add_email' name="email" required="required">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="select_subfranchise">
                                        <option value="0">Select Management </option>
                                        <option value="0">Role Management </option>
                                        <option value="0">Sub Admin Management</option>
                                        <option value="0">Franchise Management</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btn_add_data">Add New Saathi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit user modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Saathi</h5>
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
                                    <input class="form-control" type="text" value="Ramesh janha" placeholder="Your Name" id="edit_name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="number" value="" placeholder="Your Number" id="edit_number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="email" value="rameshj123@gmail.com" placeholder="Your Email" id="edit_email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option value="0">Select Management </option>
                                        <option value="Role Management ">Role Management </option>
                                        <option value="0">Sub Admin Management</option>
                                        <option value="0">Franchise Management</option>
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