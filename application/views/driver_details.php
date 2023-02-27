<style>
    .title {
        text-transform: uppercase;
    }

    .nowrap {
        white-space: nowrap;
    }

    .address{
        width: 400px;
        text-align: left;
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

                            <h5><?= strtoupper($driver['name']) ?></h5>
                            <h6><?= $driver['email'] ?></h6>
                            <h6><?= $driver['mobile'] ?></h6>
                            <!-- <h6>Vehicle : <?=ucwords($driver['vehicle_type']) ?> <?= $driver['car_name'] ?></h6> -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="card p-2 mb-2">
                <h5 class='ml-3 p-2'>Ride History</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" align='center' width="100%" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center"><?= $companion ?></th>
                                <th class="text-center">Service</th>
                                <th class="text-center">Ride</th>
                                <th class="text-center">Fare (INR)</th>
                                <th class="text-center">Origin</th>
                                <th class="text-center">Destination</th>
                                <th class="text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            if (!empty($ride_history)) {
                                foreach ($ride_history as $i => $data) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?></td>

                                        <td class="text-center title">
                                            <div>
                                                <?= ucwords($data['customer']['name']) ?>
                                                <?= $data['customer']['mobile'] ?>
                                            </div>

                                        </td>
                                        <td class="text-center"><?= ucwords($data['service']['name']) ?></td>
                                        <td class="text-center"><?= ucwords($data['ride']['type']) ?></td>
                                        <td class="text-center"><?= '₹ ' . $data['ride']['fare'] ?></td>
                                        <td class="text-center">
                                            <div class="address">
                                                <?= $data['origin']['address'] ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="address">
                                                <?= $data['destinations'][0]['address'] ?>
                                            </div>
                                        </td>

                                        <td class="text-center nowrap"><?= $data['ride_date'] ?></td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card p-2">
                <h5 class='ml-3 p-2'>Recharge History</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" align='center' width="100%" id="recharge_table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Recharge Type</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody id="recharge_history">
                            <?php

                            if (!empty($recharge_history)) {
                                foreach ($recharge_history as $i => $val) {
                            ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= $val['rechargeType'] ?></td>
                                        <td><?= $val['price'] ?></td>
                                        <td><?= $val['description'] ?></td>
                                        <td><?= $val['transactionDate'] ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
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

    <script>
        $('#driver_page').addClass('active');
        $('#table').dataTable();
        $('#recharge_table').dataTable();
    </script>