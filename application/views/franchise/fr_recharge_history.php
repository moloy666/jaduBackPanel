
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <input type="hidden" value="<?=$this->session->userdata(session_franchise_user_id)?>" id="user_id">
        <div class="row">
            <div class="col">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Recharge History</div>

                        <form action="<?=base_url('franchise/download_recharge_history/').$this->session->userdata(session_franchise_user_id)?>" method="POST">
                            <button type="submit" class="btn btnround btn-success my-1" id="btn_pdf">PDF</button>
                        </form>

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
                                    <th>Recharge Note</th>
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
                                    <th>Recharge Note</th>
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

<script>
    // $('#recharge_history_page').addClass('active');
    // $('#rental_page').removeClass('active');

    $.ajax({
            type: "post",
            url: "<?= base_url('admin/recharge_history_sf') ?>",
            data: {
                "id": $('#user_id').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                let recharge_details = response.data;
                let details = ''
                $.each(recharge_details, function(i) {

                    recharge_history += `<tr>
                    <td>${i+1}</td>
                    <td>${recharge_details[i].rechargeType}</td>
                    <td>${recharge_details[i].price}</td>                      
                    <td>${recharge_details[i].purchesedKm}</td>                      
                    <td>${recharge_details[i].description}</td>    
                    <td>${recharge_details[i].rechargeNote}</td>                      
                    <td>${recharge_details[i].date}</td>                                        
                    </tr>`;
                });
                $('#recharge_history').html(recharge_history);

                $("#table_recharge_history").dataTable();
            }
        });
</script>

