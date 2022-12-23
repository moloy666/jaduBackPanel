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
                    <h3>Add Places</h3>
                    <input type="hidden" id="specific_id" class="form-control">
                    <input type="hidden" id="user_id" class="form-control" value=<?=$this->session->userdata(session_franchise_user_id)?>>
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center px-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 w-50">
                            <div class="form-group">
                                <select name="" id="country" class="form-control title">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100" data-toggle="modal" data-target="#service_modal">Add</button>
                        </div> -->
                        <!-- <div class="col-lg-2">
                            <button type="submit" class="btn btn-danger w-100" id="btn_delete_service" data-toggle="modal" data-target="#delete_modal">Delete</button>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center px-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 w-50">
                            <div class="form-group">
                                <select name="" id="state" class="form-control title">
                                    <option value="">State Not Found</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100 access_insert" id="btn_add_state" disabled>Add</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-danger w-100 access_delete" id="btn_delete_state" disabled>Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center px-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 w-50">
                            <div class="form-group">
                                <select name="" id="district" class="form-control title">
                                    <option value="">District Not Found</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100 access_insert" id="btn_add_district" disabled>Add</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-danger w-100 access_delete" id="btn_delete_district" disabled>Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center px-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 w-50">
                            <div class="form-group">
                                <select name="" id="city" class="form-control title">
                                    <option value="">City Not Found</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100 access_insert" id="btn_add_city" disabled>Add</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-danger w-100 access_delete" id="btn_delete_city" disabled>Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    </div>

    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <!-- delete modal starts -->

    <div class="modal fade delemodel" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content p-4 text-center">
                <h5 class="mb-4">Are you sure want to delete this permanently ?</h5>

                <input type="hidden" class="form-control mb-2" id="deleted_id">

                <div class="d-flex align-items-center justify-content-center">
                    <button class="btn-secondary btn" data-dismiss="modal" id="close_delete_modal">No</button>
                    <button class="btn-success btn ml-3" id="btn_delete_data">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- add place modal starts -->

    <div class="modal fade custmmodl" id="common_modal" tabindex="-1" role="dialog" aria-labelledby="rideModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cmnTitle">Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" placeholder="" id="parent_id" >
                                    <input class="form-control" type="text" placeholder="Enter Name" id="parent_name" disabled>
                                </div>
                            </div>
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Name" id="name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="button" form="add_ride_form" class="btn btn-success" id="btn_add_data">Add</button>
                </div>
            </div>
        </div>
    </div>

