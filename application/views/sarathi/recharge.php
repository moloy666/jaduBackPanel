<?php
foreach ($sarathi_data as $data) {
    $sarathi_id = $data->sarathi_id;
}
?>
<input type="hidden" value="<?= $sarathi_id ?>" id="sarathi_id">

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        
        <div class="row">
            <div class="col">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Sarathi Recharge History</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="table_recharge_history" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Recharge Type</th>
                                    <th>Price</th>
                                    <th>Purchased KM</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>

                                    <th>#</th>
                                    <th>Recharge Type</th>
                                    <th>Price</th>
                                    <th>Purchased KM</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                            <tbody id="recharge_history">

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

