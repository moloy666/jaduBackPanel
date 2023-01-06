<style>
    .title {
        text-transform: capitalize;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="column align-items-center mb-4">
                <div class="col-md-8 mb-3">
                    <ol class="breadcrumb" style="background-color:transparent;">
                        <li class="breadcrumb-item"><a href=<?= base_url("administrator/driver") ?>>Driver</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column justify-content-end ml-3">
                        <?php
                        foreach ($data as $i => $driver) { ?>

                            <h5><?= ucwords($driver['name']) ?></h5>
                            <h6><?= $driver['email'] ?></h6>
                            <h6><?= $driver['mobile'] ?></h6>

                        <?php
                        }
                        ?>
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

    <script>
        $('#driver_page').addClass('active');
    </script>