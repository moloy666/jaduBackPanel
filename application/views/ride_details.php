

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">

            <div class="row align-items-center mb-2">
                <div class="col-md-8">
                    <h3>Ride Details</h3>
                </div>
            </div>

            <div class="card mb-2 d-flex justify-content-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <strong class="ml-1 mb-3">Ride Stage</strong>

                                <select class="form-control" id="ride_stage">
                                    <option value="">Select Ride Stage</option>
                                    <option value="completed">Completed</option>
                                    <option value="started">Started</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="form-group d-flex">
                                <input type="checkbox" class="mr-3 ml-2" id="schedule_ride" style="height:auto; width:20px; cursor:pointer">
                                <strong>
                                    <label for="schedule_ride" class="mt-2" style="cursor:pointer">Show Schedule Ride</label>
                                </strong>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <strong class="ml-1 mb-3">From</strong>

                                <input type="date" class="form-control" id="ride_from" placeholder="Ride From" style="height:40px;"  max="<?= date('Y-m-d') ?>" >
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <strong class="ml-1 mb-3">To</strong>
                                <input type="date" class="form-control" id="ride_to" placeholder="Ride To" style="height:40px;" max="<?= date('Y-m-d') ?>" >
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group mt-4">
                                <button class="btn btn-primary w-100" id="btn_search">Search</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="card p-2" style="display:none" id="ride_details">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" >
                        <thead class="thead-light">
                            <tr>
                                <th class="">#</th>
                                <th class="">Customer</th>
                                <th class="">Driver</th>
                                <th class="">Origin</th>
                                <th class="">Destination</th>
                                <th class="">Service Type</th>
                                <th class="">Fare</th>
                                <th class="">Ride Type</th>
                                <th class="">Start Time</th>
                                <th class="">End Time</th>
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

    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>


 