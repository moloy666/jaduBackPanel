<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body dashboard-card">
                        <div class="m-b-5">Total Guest</div>
                        <h2 class="m-b-5 font-strong totalCustomers">0</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Guest Wise Data</div>
                    </div>
                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Guest</th>
                                        <th>Mobile</th>
                                        <th>Fare</th>
                                        <th>Commission</th>
                                        <th>Driver</th>
                                        <th>Mobile</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Guest</th>
                                        <th>Mobile</th>
                                        <th>Fare</th>
                                        <th>Commission</th>
                                        <th>Driver</th>
                                        <th>Mobile</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </tfoot>
                                <tbody id="guest_details">


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <!-- <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title"> Data</div>
                    </div>
                    <div class="ibox-body">
                        <canvas id="myChart" style="width:100%;height: 44rem;"></canvas>
                    </div>
                </div>
            </div> -->

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

    .title {
        text-transform: capitalize;
    }
</style>

<script>
    $.ajax({
        type: "POST",
        url: "<?= base_url('hotel/get_booking_details') ?>",
        error: function(response) {
            console.log(response);
        },
        success: function(response) {
            console.log(response);
            let data = response.data;
            let details = '';
            $.each(data, function(i, data) {
                let location = data.locationText.length - 1;
                let driver_index = data.driver.length - 1;

                details += `
                <tr>
                    <td>${i+1}</td>
                    <td>${data.extra_data.hotel.customerName}</td>
                    <td>${data.extra_data.hotel.mobile}</td>
                    <td>₹ ${data.fare}</td>
                    <td>₹ ${data.extra_data.hotel.hotelExtraCharges} (₹${parseInt(data.extra_data.hotel.hotelExtraCharges) - parseInt(data.fare)})</td>
                    <td>${data.driver[driver_index].name}</td>
                    <td>${data.driver[driver_index].mobile}</td>
                    <td>${data.locationText[location].startAddress}</td>
                    <td>${data.locationText[location].endAddress}</td>
                    <td>${data.rideStartDateTime}</td>
                    <td>${data.rideEndDateTime}</td>
                </tr>
                `;

                $('.totalCustomers').html(i + 1);
            });
            $('#guest_details').html(details);
            $('#table').dataTable();

        }
    });
</script>