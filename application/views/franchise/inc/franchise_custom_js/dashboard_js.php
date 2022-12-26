<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script type="text/javascript">
    $('#dashboard_page').addClass('active');

    var table = $('#specific_table').val();
    if (table == 'franchise') {
        dashboard_data_franchise();
    } else {
        dashboard_data_subfranchise();
    }

    function dashboard_data_franchise() {
        $.ajax({
            url: "<?= base_url(WEB_PORTAL_FRANCHISE . '/get_dashboard_data') ?>",
            type: "POST",
            data: {
                "id": $('#specific_id').val()
            },
            success: function(response) {
                // console.log(response);

                let data = JSON.parse(response);

                $(".totalDrivers").text(data.drivers.total);
                $(".totalActiveDrivers").text(data.drivers.active);
                $(".totalInactiveDrivers").text(data.drivers.inactive);
                $(".totalSubFranchise").text(data.totalSubFranchise);
                $(".totalSarathi").text(data.totalSarathi);
                $(".totalOngoingRide").text(data.drivers.active);
                $(".totalRegisteredCustomers").text(data.totalCustomers);
                $(".totalRevenue").text(data.totalRevenue);
                $("#growth").text(data.totalRevenueStatus);


            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function dashboard_data_subfranchise() {
        $.ajax({
            url: "<?= base_url(WEB_PORTAL_FRANCHISE . '/get_subfranchise_dashboard_data') ?>",
            type: "POST",
            data: {
                "id": $('#specific_id').val()
            },
            success: function(response) {
                // console.log(response);

                let data = JSON.parse(response);

                $(".totalDrivers").text(data.drivers.total);
                $(".totalActiveDrivers").text(data.drivers.active);
                $(".totalInactiveDrivers").text(data.drivers.inactive);
                $(".totalSarathi").text(data.totalSarathi);
                $(".totalOngoingRide").text(data.drivers.active);
                $(".totalRegisteredCustomers").text(data.totalCustomers);
                $(".totalRevenue").text(data.totalRevenue);
                $("#growth").text(data.totalRevenueStatus);

            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    var sarathiName = [];
    var driverCount = [];

    $.ajax({
        url: "<?= base_url('franchise/getsarathiData') ?>",
        type: "POST",
        data: {
            "specific_id": $('#specific_id').val(),
            "table": $('#specific_table').val()
        },
        success: function(response) {
            // console.log(response);
            let data = response.data;

            let html = '';
            $.each(data, function(i, data) {
                if (data.name != undefined) {
                    sarathiName.push(data.name);
                    driverCount.push(data.totalDrivers);

                    html += '<tr>' +
                        '<td class="title">' + data.name + '</td>' +
                        '<td class="text-center">' + data.refferal_code + '</td>' +
                        '<td>' + data.total_km_purchased + '</td>' +
                        '<td>' + data.joined + '</td>' +
                        '<td>' + data.totalDrivers + '</td>' +
                        '</tr>';
                }
                else{
                    html+='';
                }
            });
            $('.sarathiRelatedDataTable').html(html);
            $('#example-table').dataTable();

            load_sarathi_chart();
        },
        error: function(response) {
            console.log((response));
        }
    });

    function load_sarathi_chart() {
        var xValues = sarathiName;
        var yValues = driverCount;

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: "rgba(255, 255, 255,1.0)",
                    borderColor: "rgba(244, 3, 252,1)",
                    data: yValues
                }]
            },
        });
    }
</script>