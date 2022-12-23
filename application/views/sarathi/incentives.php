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
                    <h3>Incentives Schemes</h3>
                    <input type="hidden" value="<?=$specific_id?>" id="specific_id">
                    <input type="hidden" value="sarathi" id="specific_table">

                </div>

                <div class="col-md-4">
                    <button class="btn bgred btnround float-right mx-2 access_insert" data-toggle="modal" data-target="#addModal" disabled>Add New 
                        <i class="fa fa-plus ml-2"></i></button>
                </div>
            </div>

            <div id="incentives">
                <div class="card p-1 mb-2">
                    <div class="card-body">
                        <div class="column">
                            <div class="row mb-2">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <h5>Scheme Name : </h5>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-1 ">
                                    <div class="form-group float-right">
                                        <label class="switch">
                                            <input type="checkbox" name="">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <strong class="mx-2">KM</strong>
                                        <input type="text" class="form-control" placeholder="KM" style="height:40px">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <strong class="mx-2">Time</strong>
                                        <select name="" class="form-control">
                                            <option value="per_day">Per Day</option>
                                            <option value="per_week">Per Week</option>
                                            <option value="per_month">Per Month</option>
                                            <option value="per_year">Per Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <strong class="mx-2">Amount</strong>
                                        <input type="text" class="form-control" placeholder="Amount" style="height:40px" >
                                    </div>
                                </div>
                                <div class="col-lg-2 pl-0">
                                    <div class="form-group float-right">
                                        <button class="btn btn-primary mt-4 mr-3">Save</button>
                                        <button class="btn btn-danger mt-4 mr-3">Delete</button>
                                    </div>
                                </div>
                            </div>
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
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->

    <!-- confirm modal -->

    <div class="modal fade delemodel" id="update" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content p-4 text-center">
                <h5 class="mb-4">Are you sure want to update this data ?</h5>
                <input type="hidden" id="update_id">
                <input type="hidden" id="update_value">
                <input type="hidden" id="update_time">
                <input type="hidden" id="update_amount">
                <div class="d-flex align-items-center justify-content-center">
                    <button class="btn-secondary btn" data-dismiss="modal" id="">No</button>
                    <button class="btn-success btn ml-3" id="btn_update_scheme">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete confirm model -->

    <div class="modal fade delemodel" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content p-4 text-center">
                <h5 class="mb-4">Are you sure want to Delete this data ?</h5>
                <input type="hidden" id="delete_id">

                <div class="d-flex align-items-center justify-content-center">
                    <button class="btn-secondary btn" data-dismiss="modal" id="">No</button>
                    <button class="btn-success btn ml-3" id="btn_delete_scheme">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal -->

    <div class="modal fade custmmodl" id="addModal" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Scheme Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" value="" placeholder="Enter Scheme Name" id="add_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" value="" placeholder="Enter KM Value" id="add_value">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" value="" placeholder="Enter Amount" id="add_amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control title" id="add_time_list">

                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn_add_scheme">Add Scheme</button>
                </div>
            </div>
        </div>
    </div>