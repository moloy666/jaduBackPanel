<?php
foreach ($sarathi_data as $data) {
    $sarathi_id = $data->sarathi_id;
}
?>

<input type="hidden" value="<?= $sarathi_id ?>" id="sarathi_id">

<body onload="get_sarathi_details()">
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h4 class="text-primary">Total KM Purchased : <span id="sarathi_km_purchased"> <?=$total_km_purchased?></span> Km</h4>
                </div>
            </div>
            <div align="right">
                <button type="button" class="btn bgred ml-3 btnround mb-3" id="pending_driver_details" data-toggle="collapse" href="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                    Driver Request Pending : <?= $driver_pending; ?>
                </button>
            </div>

            <div class="collapse" id="collapseExample">
                <div class="card p-3  mb-3">
                    <div class="table-responsive">
                        <h5 class="text-warning mb-2">Pending Driver List</h5>
                        <table class="table table-bordered" id="pending_table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="">#</th>
                                    <th class="">Name</th>
                                    <th class="">Email</th>
                                    <th class="">Mobile</th>
                                </tr>
                            </thead>
                            <tbody class="" id="pending_drivers">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card p-3 my-2">
                <div class="table-responsive">
                    <h5 class="text-danger mb-4">Active Driver List</h5>
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="">#</th>
                                <th class="">Name</th>
                                <th class="">Email</th>
                                <th class="">Mobile</th>
                                <th class="">Total KM Purchased</th>
                                <th class="">Status</th>
                                <th class="">Ride History</th>
                                <th class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="" id="table_details">
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

    <!-- Edit driver modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Driver</h5>
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
                                    <input class="form-control" type="text" value="Ramesh janha" placeholder="Your Name" id="edit_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="987-654-3210" placeholder="Your Number" id="edit_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="rameshj123@gmail.com" placeholder="Your Email" id="edit_email">
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

                        <div class="col-md-6">
                            <div class="form-group">
                               
                                <input class="form-control  mb-3" type="text" placeholder="Name" id='recharge_driver_name' style="height:40px;background-color:transparent;" disabled>

                                <input class="form-control  mb-3" type="hidden" placeholder="" id='driver_specific_id' name="driver_specific_id">
                                <input class="form-control  mb-3" type="hidden" placeholder="" id='sarathi_specific_id' name="sarathi_specific_id">
                            </div>
                        </div>
                        <div class="col-md-6">
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

    <div class="loaderbg" style="display: none;">
        <img src="<?=base_url()?>assets/images/succesfull_payment.gif">
    </div>

    <style>
        .loaderbg {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            z-index: 9999;
            background-color: rgba(0,0,0, 0.4);
            top: 0;
            left: 0;
        }
    </style>