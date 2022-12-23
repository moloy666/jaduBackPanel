<style>
    .title {
        text-transform: capitalize;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-2">
                <div class="col-md-8">
                    <h3>Customer Book Ride</h3>
                </div>
            </div>

            <div class="card mb-2 d-flex justify-content-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <input class="form-control p-2" type="text" placeholder="Enter Customer Code" id="booking_id">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <button type="submit" class="bgdarkred btn w-100" id="btn_search">Search</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card p-2 mb-2" style="display:none" id="table">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Current Location</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card p-2 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h5>Start Ride From</h5>
                            <div class="form-group">
                                <input class="form-control p-3" type="text" placeholder="Start Ride From" id="destination_from">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <h5>Ride Destination</h5>
                            <div class="form-group">
                                <input class="form-control p-3" type="text" placeholder="Ride Destination" id="destination_to">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-4">
                            <div class="form-group float-right">
                                <button class="btn btn-primary mr-2" id="btn_car_list">Avilable Cars</button>

                                <button class="btn btn-success" id="btn_clear">Clear</button>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-2 col-md-3" style="display:none;">
                            <div class="form-group">
                                <input type="text" id="lat_origin" class="form-control" placeholder="Latitude" disabled style="background:transparent" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3" style="display:none;">
                            <div class="form-group">
                                <input type="text" id="lang_origin" class="form-control" placeholder="Longitude" disabled style="background:transparent" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3" style="display:none;">
                            <div class="form-group">
                                <input type="text" id="lat_destination" class="form-control" placeholder="Latitude" disabled style="background:transparent" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3" style="display:none;">
                            <div class="form-group">
                                <input type="text" id="lang_destination" class="form-control" placeholder="Longitude" disabled style="background:transparent" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="map" id="map">

            </div>
            <div class="card p-3 mb-2" style="display:none" id="cab_list">
                <div class="col-lg-12 col-md-3" id="txt_distance" style="display:none;">
                    <div class="form-group">
                        <strong class="mr-3">Distance : <span id="distance"></span></strong>

                        <strong class="mx-3">Wait Time : <span id="wait_time"></span> Min</strong>
                    </div>
                </div>
                <div class="cab d-flex flex-wrap justify-content-start" id="cab_details">

                </div>
            </div>

            <div class="card" id="confirm_pickup_ride" style="display:none;">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-3 col-md-4">
                            <div class="form-group">
                                <button class="btn btn-primary w-100 p-3" id="confirm_pickup">Confirm Pickup</button>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4">
                            <button class="btn btn-danger w-100 p-3" id="cancle_ride">Cancle Ride</button>
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


    <div class="modal fade custmmodl" id="location_model" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="" id="text_location" cols="50" rows="5" class="form-control" disabled style="background-color:transparent;"></textarea>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_not_confirm">Close</button>
                    <button type="submit" class="btn btn-success" id="btn_confirm_location">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="onCallRideId">
    
    <div class="loaderbg" style="display: none;">

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
            top: 0;
            left: 0;
        }
    </style>