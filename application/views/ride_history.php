<style>
    td{
        text-align: center;
        text-transform: capitalize;
    }

    h5{
        color: royalblue;
    }

    table, th, td{
        border:1px solid #000;
        border-collapse:collapse;
    }

    th, td{
        width:auto;
        height: 30px;
    }


</style>
<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h5 class="text-primary">Ride History Of <?= ucwords($username) ?></h5>
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
                                <th class="text-center"><?=$companion?></th>
                                <th class="text-center">Payment Mode</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($ride_history as $i => $data) { ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1 ?></td>
                                    <td class="text-center title"><?= $data['companion_name'] ?></td>
                                    <td class="text-center"><?= $data['payment_mode'] ?></td>
                                    <td class="text-center"><?= $data['amount'] ?></td>
                                    <td class="text-center"><?= $data['created_at'] ?></td>
                                </tr>

                            <?php
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