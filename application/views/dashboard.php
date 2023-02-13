<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="d-flex justify-content-end">
        <?php 
        $table=$this->session->userdata(session_table);
        if ($this->session->userdata(session_table) == value_administrator) { ?>
            <div class="form-group  mt-3">
                <form action="<?= base_url('administrator/download_progress_report/'). $table ?>" method="post" target="_blank">
                    <button type="submit" class="btn bgred ml-3 btnround">
                        Download Progress Report
                    </button>
                </form>
            </div>
        <?php
        } ?>
    </div>


    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Saathi</div>
                        <h2 class="m-b-5 font-strong totalSarathi">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Drivers</div>
                        <h2 class="m-b-5 font-strong totalDrivers">0</h2>

                        <div><i class="fa fa-level-up m-r-5"></i><small><strong>Active</strong> <span class="totalActiveDrivers"></span></small></div>
                        <div><i class="fa fa-level-down m-r-5"></i><small><strong>Inctive</strong> <span class="totalInactiveDrivers"></span></small></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Registered Customer</div>
                        <h2 class="m-b-5 font-strong totalRegisteredCustomers">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Ongoing Ride</div>
                        <h2 class="m-b-5 font-strong totalCarRunning">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total KM Purchased</div>
                        <h2 class="m-b-5 font-strong">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total KM Purchased Today</div>
                        <h2 class="m-b-5 font-strong">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Fanchise</div>
                        <h2 class="m-b-5 font-strong totalFranchise">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Sub-Fanchise</div>
                        <h2 class="m-b-5 font-strong totalSubFranchise">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total revenue generated</div>
                        <h2 class="m-b-5 font-strong totalRevenue">0</h2>
                        <i class="widget-stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="27.636" viewBox="0 0 19 27.636">
                                <path id="rupee-svgrepo-com" d="M25,7.454V4H6V7.454h6.045a5.17,5.17,0,0,1,4.862,3.454H6v3.454H16.907a5.171,5.171,0,0,1-4.862,3.454H6v4.17l9.648,9.648h4.885L10.17,21.272h1.876a8.648,8.648,0,0,0,8.46-6.909H25V10.909H20.505a8.52,8.52,0,0,0-1.6-3.454Z" transform="translate(-6 -4)" fill="#fff" />
                            </svg>
                        </i>
                        <div><i class="fa fa-level-up m-r-5"></i><small><strong class="revenueStatus">0</strong> % Improvement</small></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Saathi Wise Data</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Refferal Code</th>
                                    <th>KM Purchased</th>
                                    <th>Joined At</th>
                                    <th>Number Of Driver</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Refferal Code</th>
                                    <th>KM Purchased</th>
                                    <th>Joined At</th>
                                    <th>Number Of Driver</th>
                                </tr>
                            </tfoot>
                            <tbody class="sarathiRelatedDataTable">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Saathi Wise Data</div>
                    </div>
                    <div class="ibox-body">
                        <canvas id="myChart" style="width:100%;height: 24rem;"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- END PAGE CONTENT-->

</div>
</div>
<!-- BEGIN THEME CONFIG PANEL-->

<!-- END THEME CONFIG PANEL-->

<style type="text/css">
    .totalDrivers {
        float: right
    }

    .ibox .dashboard-card {
        height: 8rem;
    }
</style>

<script type="text/javascript">
    $.ajax({
        url: "<?= base_url('administrator/dashboardData') ?>",
        type: "GET",
        success: function(response) {
            let data = JSON.parse(response);
            $(".totalSarathi").text(data.totalSarathi);

            $(".totalDrivers").text(data.drivers.total);
            $(".totalActiveDrivers").text(data.drivers.active);
            $(".totalInactiveDrivers").text(data.drivers.inactive);

            $(".totalCarRunning").text(data.totalCarRunning);

            $(".totalRegisteredCustomers").text(data.totalCustomers);
            $(".totalFranchise").text(data.totalFranchise);
            $(".totalSubFranchise").text(data.totalSubFranchise);
            $(".totalRevenue").text(data.totalRevenue);
            $(".revenueStatus").text(data.revenueStatus);

            // console.log(data.revenueStatus);

        },
        error: function(response) {
            console.log(response);
        }
    });

    var sarathiName = [];
    var driverCount = [];

    $.ajax({
        url: "<?= base_url('sarathiData') ?>",
        type: "GET",
        success: function(response) {
            let data = JSON.parse(response);
            // console.log(data);
            let html = '';
            $.each(data, function(i) {

                sarathiName.push(data[i].name);
                driverCount.push(data[i].totalDrivers);

                html += '<tr>' +
                    '<td class="title">' + data[i].name + '</td>' +
                    '<td class="text-center">' + data[i].refferal_code + '</td>' +
                    '<td>' + data[i].total_km_purchased + '</td>' +
                    '<td>' + data[i].joined + '</td>' +
                    '<td>' + data[i].totalDrivers + '</td>' +
                    '</tr>';
            });
            $('.sarathiRelatedDataTable').html(html);
            $('#example-table').dataTable();

            load_sarathi_chart();
        },
        error: function(response) {
            console.log(JSON.stringify(response));
        }
    });

    function load_sarathi_chart() {
        var xValues = sarathiName;
        var yValues = driverCount;

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                culture: 'es',
                datasets: [{
                    backgroundColor: "rgba(255, 255, 255, 1.0)",
                    borderColor: "rgba(244, 3, 252,1)",
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Driver Number Of Saathi"
                }
            }
        });
    }
</script>

<style>
    .title {
        text-transform: capitalize;
    }
</style>