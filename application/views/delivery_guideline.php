<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Add Delivery Guideline</h3>
                </div>

            </div>

            <div class="card p-2">
                <div class="form-group">
                    <textarea name="" id="delivery_guide" cols="30" rows="20" class="form-control"><?=$delivery_guide?></textarea>
                </div>
                <div class="d-flex justify-content-end mr-3">
                    <div class="form-group">
                        <button class="btn btn-success" id="btn_save_delivery_guide">Save</button>
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

    <script>
        CKEDITOR.replace("delivery_guide");
    </script>