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
                "id": $('#specific_id').val(),
                "table": $('#specific_table').val()
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
                $(".totalKmPurchased").text(data.totalKmPurchased);
                $(".totalRevenue").text(data.totalRevenue);
                $("#growth").text(data.totalRevenueStatus);
                if (data.totalKmPurchaseToday) {
                    $(".totalKmPurchaseToday").text(data.totalKmPurchaseToday);
                } else {
                    $(".totalKmPurchaseToday").text(0);
                }

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
                "id": $('#specific_id').val(),
                "table": $('#specific_table').val()
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
                $(".totalKmPurchased").text(data.totalKmPurchased);
                $(".totalRevenue").text(data.totalRevenue);
                $("#growth").text(data.totalRevenueStatus);
                if (data.totalKmPurchaseToday) {
                    $(".totalKmPurchaseToday").text(data.totalKmPurchaseToday);
                } else {
                    $(".totalKmPurchaseToday").text(0);
                }


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
                } else {
                    html += '';
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
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Driver Number Of Sarathi"
                }
            }
        });
    }

    $('#recharge_btn').click(function() {
        fetch_recharge_package();
    });

    function fetch_recharge_package(user_id) {
        let user_type = '';
        if ($('#specific_table').val() == 'franchise') {
            user_type = 'franchise';
        } else {
            user_type = 'sub_franchise';
        }

        $.ajax({
            type: "post",
            url: "<?= base_url('administrator/get_packages') ?>",
            data: {
                "user_type": user_type
            },
            error: function(response) {},
            success: function(response) {
                // console.log(response);
                var data = response.data;
                var details = ' <option value="">Select Recharge Package</option>';
                $.each(data, function(i, data) {
                    details += `<option class="title" value="${data.id}">${data.name}</option>`;
                });
                $('#select_package').html(details);

            }
        });
    }

    $('#btn_recharge').click(function() {
        let package_id = $('#select_package').val();
        let spcific_id = $('#specific_id').val();

        let user_level_type = '';

        if ($('#specific_table').val() == 'franchise') {
            user_level_type = 'franchise';
        } else {
            user_level_type = 'sub-franchise';
        }


        // console.log(spcific_id);

        if (package_id == '') {
            toast('Select a package', 'center');
        } else {
            $.ajax({
                type: "GET",
                url: `<?= apiBaseUrl ?>${user_level_type}/users/${spcific_id}/recharge/own?selectedPackageId=${package_id}`,
                headers: {
                    'x-api-key': '<?= const_x_api_key ?>',
                    'platform': 'web',
                    'deviceid': ''
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {

                    if (response.isRechargePossible) {
                        let data = response.data;
                        let handler_key = function(response) {

                            if ($('#specific_table').val() == 'franchise') {
                                dashboard_data_franchise();
                            } else {
                                dashboard_data_subfranchise();
                            }
                            $('.loaderbg').show();
                            setTimeout(() => {
                                $('.loaderbg').hide();
                            }, 3000);
                        }

                        data.handler = handler_key;

                        var rzp1 = new Razorpay(data);
                        rzp1.open();

                        $('#rechView1').modal('hide');



                    } else {

                        console.log(response);
                        toast(response.data, 'center');
                    }
                }
            });
        }

    });
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>