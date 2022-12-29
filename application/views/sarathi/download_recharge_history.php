<style>
    td {
        text-align: center;
        text-transform: capitalize;
    }

    table,
    th,
    td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    th,
    td {
        width: max-content;
        height: 40px;
    }
    .ibox-title{
        color:royalblue;
    }
</style>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">

        <div class="row">
            <div class="col">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Recharge History Of <?=ucwords($sarathi)?></div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Recharge Type</th>
                                    <th>Price (₹)</th>
                                    <th>Purchased KM</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>

                                    <th>#</th>
                                    <th>Recharge Type</th>
                                    <th>Price (₹)</th>
                                    <th>Purchased KM</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                            <tbody id="recharge_history">
                                <?php
                                if (!empty($sarathi_data)) {
                                    foreach ($sarathi_data as $i => $val) { ?>

                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $val['rechargeType'] ?></td>
                                            <td><?= $val['price'] ?></td>
                                            <td><?= $val['purchesedKm'] ?></td>
                                            <td><?= $val['description'] ?></td>
                                            <td><?= $val['date'] ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr>
                                    <td colspan='6'>Recharge History Not Available</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

</div>
</div>

<style type="text/css">
    .totalDrivers {
        float: right
    }

    .ibox .dashboard-card {
        height: 8rem;
    }
</style>