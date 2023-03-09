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
        font-size: 12px;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8" align="left" style="margin-bottom:20px">
                    <img src="./assets/images/logos/logo-l.png" alt="" width="60px">
                    <div align="center">
                        <strong style="margin-bottom:10px">JaduRide</strong><br>
                        <strong>Ride History Of <?= ucwords($username) ?></strong>
                    </div>
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
                                <th>#</th>
                                <th><?= $companion ?></th>
                                <!-- <th>Service</th> -->
                                <th>Vehicle</th>
                                <th>Cab</th>
                                <th>Fare(₹)</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($ride_history)) {

                                foreach ($ride_history as $i => $data) {
                                    if (empty($data['customer']['name'])) $data['customer']['name'] = '-';
                                    if (empty($data['customer']['mobile'])) $data['customer']['mobile'] = '-';
                            ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>

                                        <td class="title">
                                            <div>
                                                <?= ucwords($data['customer']['name']) ?><br>
                                                <?= $data['customer']['mobile'] ?>
                                            </div>

                                        </td>
                                        <!-- <td><?= ucwords($data['service']['name']) ?></td> -->
                                        <td><?= ucwords($data['ride']['type']) ?></td>
                                        <td><?= ucwords($data['ride']['cab']) ?></td>
                                        <td><?= $data['ride']['fare'] ?></td>
                                        <td class="nowrap">
                                            <div>
                                                <?= $data['origin']['address'] ?>
                                            </div>
                                        </td>
                                        <td class="nowrap">
                                            <div>
                                                <?= $data['destinations'][0]['address'] ?>
                                            </div>
                                        </td>

                                        <td class="nowrap"><?= $data['ride_date'] ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No Record Avaiable</tr>";
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