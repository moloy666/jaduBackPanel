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
                    <h3>Services</h3>
                    <input type="hidden" id="specific_id" class="form-control">
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center px-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 w-50">
                            <div class="form-group">
                                <select name="" id="services" class="form-control title">
                                    <option value="">Select Services</option>
                                    <option value="SERVICE_CAR">Car</option>
                                    <option value="SERVICE_BIKE">Bike</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100 access_insert" data-toggle="modal" data-target="#service_modal" disabled>Add</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-danger w-100 access_delete" id="btn_delete_service" data-toggle="modal" data-target="#delete_modal" disabled>Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center px-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 w-50">
                            <div class="form-group">
                                <select name="" id="ride_type" class="form-control title">
                                    <option value="">Ride Not Found</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100 access_insert" id="btn_add_ride" data-toggle="modal" data-target="#ride_modal" disabled>Add</button>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-danger w-100 access_delete" id="btn_delete_ride" data-toggle="modal" data-target="#delete_modal" disabled>Delete</button>
                        </div>

                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary w-100 access_update" id="btn_update_ride" disabled>Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center px-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 w-50">
                            <div class="form-group">
                                <select name="" id="cab_type" class="form-control title">
                                    <option value="">Cab Not Found</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100 access_insert" id="btn_add_cab" data-toggle="modal" data-target="#cab_modal" disabled>Add</button>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-danger w-100 access_delete" id="btn_delete_cab" data-toggle="modal" data-target="#delete_modal" disabled>Delete</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="card p-2 mb-4" style="display:none" id="table">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">
                        </tbody>
                    </table>
                </div>
            </div> -->



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
                <input type="hidden" class="form-control mb-2" id="table_name">
                <div class="d-flex align-items-center justify-content-center">
                    <button class="btn-secondary btn" data-dismiss="modal" id="close_delete_modal">No</button>
                    <button class="btn-success btn ml-3" id="btn_delete_data">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- add service modal starts -->

    <div class="modal fade custmmodl" id="service_modal" tabindex="-1" role="dialog" aria-labelledby="serviceModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document" width="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Sevice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Service Name" id='service_name' name="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btn_add_service">Add</button>
                </div>
            </div>
        </div>
    </div>


    <!-- add ride modal starts -->

    <div class="modal fade custmmodl" id="ride_modal" tabindex="-1" role="dialog" aria-labelledby="rideModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Ride Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_ride_form">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="" id="modal_services" class="form-control title" name="service">
                                        <option value="">Services Not Found</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="file" name="image_icon">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Ride Name" name="name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" type="text" placeholder="Short Descripion" name="short_desc"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" type="text" rows="5" placeholder="Long Description" name="long_desc"></textarea>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="submit" form="add_ride_form" class="btn btn-success" id="btn_add_ride">Add New Ride</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade custmmodl" id="ride_update_modal" tabindex="-1" role="dialog" aria-labelledby="rideModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Ride Descriptions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form id="add_ride_form"> -->
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <img src="" alt="" id="ride_icon" width="100px">
                                <!-- <input class="form-control" type="file" name="image_icon"> -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control title" type="hidden" placeholder="Ride Name" name="id" id="ride_id" disabled>

                                <input class="form-control title" type="text" placeholder="Ride Name" name="name" id="ride_name" disabled>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" type="text" placeholder="Short Descripion" name="short_desc" id="short_desc"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" type="text" rows="5" placeholder="Long Description" name="long_desc" id="long_desc"></textarea>
                            </div>
                        </div>

                    </div>
                    <!-- </form> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn_save_ride_data">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- add cab modal starts -->

    <div class="modal fade custmmodl" id="cab_modal" tabindex="-1" role="dialog" aria-labelledby="cabModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Cab Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="" id="modal_ride_type" class="form-control title">
                                    <option value="">Rides Not Found</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Cab Name" id="cab_name">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btn_add_cab_name">Add New Cab</button>
                </div>
            </div>
        </div>
    </div>