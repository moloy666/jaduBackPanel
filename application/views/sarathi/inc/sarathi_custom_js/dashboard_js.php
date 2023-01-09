<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script type="text/javascript">
    $('#dashboard_page').addClass('active');

    $.ajax({
        url: "<?= base_url('administrator/dashboardData') ?>",
        type: "POST",
        data: {
            "id": $('#sarathi_id').val()
        },
        success: function(response) {
            let data = JSON.parse(response);

            $(".totalDrivers").text(data.drivers.total);
            $(".totalActiveDrivers").text(data.drivers.active);
            $(".totalInactiveDrivers").text(data.drivers.inactive);
            $(".totalCarRunning").text(data.totalCarRunning);
            $(".totalRegisteredCustomers").text(data.totalCustomers);
            $(".totalRevenue").text(data.totalRevenue);
            $("#growth").text(data.revenueStatus);

            // console.log(data.revenueStatus);  
        },
        error: function(response) {
            console.log(response);
        }
    });

    $.ajax({
        type: "POST",
        url: "<?= base_url('administrator/total_km_purchase') ?>",
        data: {
            "id": $('#sarathi_id').val()
        },
        error: function(response) {
            console.log(response);
        },
        success: function(response) {
            if (response.success) {
                var data = response.data;
                $(".totalKmPurchased").text(data);
            } else {
                console.log(response);
            }
        }
    });

    $.ajax({
        type: "POST",
        url: "<?= base_url('administrator/total_km_purchase_today') ?>",
        data: {
            "id": $('#user_id').val()
        },
        error: function(response) {
            console.log(response);
        },
        success: function(response) {
            if (response.success) {
                // console.log(response);
                let data =response.data;
                $('.totalKmPurchaseToday').text(data);
            } else {
                console.log(response);
            }
        }
    });


    var driverName = [];
    var driverKmPurchased = [];

    $.ajax({
        url: "<?= base_url('administrator/driverData') ?>",
        type: "POST",
        data: {
            "id": $('#sarathi_id').val()
        },
        success: function(response) {
            let data = JSON.parse(response);
            let html = '';
            $.each(data, function(i) {

                driverName.push(data[i].name);
                driverKmPurchased.push(data[i].total_km_purchased);

                if(data[i].vehicle_name==null){
                    data[i].vehicle_name='-';
                }

                html += `<tr>
                    <td class="title"> ${data[i].name}</td>
                    <td> ${data[i].total_km_purchased} KM</td>
                    <td class="title text-center"> ${data[i].vehicle_name}</td>
                    <td> ${data[i].vehicle_number}</td>
                    <td> ${data[i].joined}</td>
                    </tr>`;
            });
            $('.driverRelatedDataTable').html(html);
            $('#example-table').dataTable();

            load_driver_chart();
        },
        error: function(response) {
            console.log(JSON.stringify(response));
        }
    });

    function load_driver_chart() {
        var xValues = driverName;
        var yValues = driverKmPurchased;

        new Chart("myChart", {
            type: "line",
            title: {
                text: "Driver Total kM Purchased"
            },
            data: {
                type: 'column',
                labels: xValues,
                datasets: [{
                    backgroundColor: "rgba(255, 255, 255,1.0)",
                    borderColor: "rgba(244, 3, 252,1)",
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
            }
        });
    }


    $.ajax({
        type:"post",
        url:"<?=base_url('admin/get_user_recharge_data')?>",
        data:{
            'id':$('#user_id').val()
        },
        error:function(response){
            console.log(response);
        },
        success:function(response){
            console.log(response);
        }
    });
</script>