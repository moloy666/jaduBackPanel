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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color:transparent;">
                            <li class="breadcrumb-item"><a href="<?= base_url('franchise/subfranchise') ?>">Sub Franchise</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sarathi</li>
                        </ol>
                    </nav>
                    <h5 class="text-primary ml-3">Name : <?= $data['name'] ?></h5>
                    <input type="hidden" value="<?= $data['sub_franchise_id'] ?>" id="subfranchise_id">
                    
                    <input type="hidden" value="<?= $specific_id ?>" id="specific_id">
                    <input type="hidden" value=" <?=end($this->uri->segments)?>" id="user_id">
                    <input type="hidden" value="<?= $this->session->userdata(session_franchise_table) ?>" id="specific_table">
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">
                       
                    </div>
                </div>
            </div>
            <div class="card p-3">
                <h5 class="text-danger mb-2">Sarathi List</h5>
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

            <div class="card my-2 p-3">
                <div class="table-responsive">
                    <h5 class="text-danger mb-4">Recharge History</h5>
                    <table class="table table-bordered" id="table_recharge_history">
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

    <!-- Add new sarathi modal -->
    <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Sarathi</h5>
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
                                    <select name="" id="" class="form-control title">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button class="btn btn-success" id="btn_add_data">Add Sarathi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Sarathi modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Sarathi</h5>
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
                                    <input class="form-control" type="text" value="" placeholder="Your Number" id="edit_number">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="" placeholder="Your Email" id="edit_email">
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <select name="" id="" class="form-control title">
                                        <option value="<?= $data['sub_franchise_id'] ?>" class="title"><?= $data['name'] ?></option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="edit_access_list" multiple>
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