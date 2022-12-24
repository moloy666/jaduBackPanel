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
                console.log(response);

                let data = JSON.parse(response);

                $(".totalDrivers").text(data.drivers.total);
                $(".totalActiveDrivers").text(data.drivers.active);
                $(".totalInactiveDrivers").text(data.drivers.inactive);
                $(".totalSubFranchise").text(data.totalSubFranchise);
                $(".totalSarathi").text(data.totalSarathi);
                $(".totalOngoingRide").text(data.drivers.active);

                $(".totalRegisteredCustomers").text(data.totalCustomers);
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
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    var sarathiName = [];
    var driverCount = [];

    $.ajax({
        url: "<?= base_url('sarathiData') ?>",
        type: "GET",
        success: function(response) {
            let data = JSON.parse(response);
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
                datasets: [{
                    backgroundColor: "rgba(255, 255, 255,1.0)",
                    borderColor: "rgba(244, 3, 252,1)",
                    data: yValues
                }]
            },
        });
    }
</script>