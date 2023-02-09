<style>
    td {
        text-align: center;
        text-transform: capitalize;
    }

    h5 {
        color: royalblue;
    }

    table,
    th,
    td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    th,
    td {
        width: auto;
        height: 30px;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <p style="text-align:center;"><img src="./assets/images/logos/logo-l.png" alt=""></p>
                    <p style="text-align:center;"><strong>JaduRide Driver</strong></p>
                    <p style="text-align:center;"><strong>Ride History Of <?= ucwords($username) ?></strong></p>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">
                    </div>
                </div>
            </div>

            <div class="card p-2">
                <div class="table-responsive">
                    <table class="table table-bordered" align='center' width="100%" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center"><?= $companion ?></th>
                                <th class="text-center">Driver Mobile</th>
                                <th class="text-center">Payment Mode</th>
                                <th class="text-center">Fare (INR)</th>
                                <!-- <th class="text-center">Origin</th>
                                <th class="text-center">Destination</th> -->
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
                                        <?= ucwords($data['companion_name']['name']) ?>
                                        </td>
                                        <td class="text-center"><?= ucwords($data['companion_name']['mobile']) ?></td>
                                        <td class="text-center"><?= ucwords($data['payment_mode']) ?></td>
                                        <td class="text-center"><?= '₹ '. ($data['amount']) ?></td>
                                        <td class="text-center"><?=  $data['created_at'] ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            else{
                                echo"<tr><td colspan='5'>No Record Avaiable</tr>";
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


    <script>
        $('#table').dataTable();
    </script>