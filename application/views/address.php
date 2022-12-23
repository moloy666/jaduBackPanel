<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Search Address</h3>
                </div>
            </div>

            <div class="card mb-4 d-flex justify-content-center">
                <div class="card-body">
                    <div class="row">
                                               
                        <div class="col-lg-3 col-md-4">
                            <div class="form-group">
                                <input class="form-control p-2" type="text" placeholder="Enter Mobile Number " id="mobile" name="mobile">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <button type="submit" class="bgdarkred btn w-100" id="btn_search">Search</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card p-2 mb-4" style="display:none" id="table">
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
            </div>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
    </div>

    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>


    <script>

        $('#btn_search').click(function() {
            var booking_id = $('#mobile').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/display_user_address') ?>",
                data: {
                    "mobile": booking_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                   console.log(response);
                }
            });
        });

    </script>