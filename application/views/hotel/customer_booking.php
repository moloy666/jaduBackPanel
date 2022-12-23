<body>
    <div class="content-wrapper">
        <div class="page-content fade-in-up d-flex justify-content-center">

            <!-- <div class="col-md-6 map ml-2" id="map"></div> -->

            <div class="col-md-12" id="">
                <div class="card p-2">
                    <div class="card-header">
                        <strong>Booking System</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input class="form-control p-3" type="text" placeholder="Guest Name" id="name" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input class="form-control p-3" type="number" placeholder="Mobile Number" id="mobile" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input class="form-control p-3" type="email" placeholder="Enter Email" id="email" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input class="form-control p-3" type="text" placeholder="Address" id="address" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input class="form-control p-3" type="text" placeholder="Number of Guest" id="guest_number" autocomplete="off">
                                </div>
                            </div>

                           
                            <div class="col-lg-12 col-md-12" style="display:none">
                                <div class="form-group">
                                    <input class="form-control p-3" type="text" placeholder="Latitute" id="lat">
                                    <input class="form-control p-3" type="text" placeholder="Longitude" id="lng">
                                </div>
                            </div>


                          
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input class="form-control p-3" type="date" placeholder="CheckIn Date" id="checkin" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input class="form-control p-3" type="date" placeholder="CheckOut Date" id="checkout" autocomplete="off">
                                </div>
                            </div>





                            <div class="col-lg-12 col-md-4">
                                <div class="form-group float-right">
                                    <button class="btn btn-primary mr-2" id="btn_car_list">Save</button>
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

    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>



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