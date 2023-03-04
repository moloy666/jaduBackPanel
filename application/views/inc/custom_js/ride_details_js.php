<style>
    .name {
        font-weight: bold;
        font-size: small;
        text-transform: uppercase;
    }

    .background {
        font-size: 11px;
    }

    .title {
        text-transform: capitalize;
    }

    .details {
        white-space: nowrap;
        text-align: left !important;
        text-overflow: clip;
    }

    .address {
        width: 400px;
        text-align: left !important;
    }
</style>
<script>
    var table = $('#table').DataTable({
        language: {
            emptyTable: "No Data Available"
        },
        order: [
            [0, "asc"]
        ],
        scrollX: true
    });
    
    $('#btn_search').click(() => {

        table.clear().draw(false);

        let ride_stage = $('#ride_stage').val();
        let ride_from = $('#ride_from').val();
        let ride_to = $('#ride_to').val();

        if (ride_stage == '') {
            table.clear().draw(false);
            toast('Select Ride Stage', 'center');
        } else if (ride_from != '' && ride_to == '') {
            table.clear().draw(false);
            toast('Select Both Date', 'center');
        } else if (ride_from == '' && ride_to != '') {
            table.clear().draw(false);
            toast('Select Both Date', 'center');
        } else {
            ride_details();
        }
    });


    // ride_details();

    function ride_details() {

        let ride_stage = $('#ride_stage').val();
        let ride_from = $('#ride_from').val();
        let ride_to = $('#ride_to').val();

        let schedule = false;
        if ($("#schedule_ride").prop('checked') == true) {
            schedule = true;
        } else {
            $("#schedule_ride").prop('checked', false);
            schedule = false;
        }

        $.ajax({
            type: "GET",
            url: `<?= apiBaseUrl ?>ride/history/all?rideStage=${ride_stage}&from=${ride_from}&to=${ride_to}&scheduleRide=${schedule}`,
            headers: {
                "x-api-key": '<?= const_x_api_key ?>',
                "platform": "web",
                "deviceid": ""
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);

                var data = response.data;
                $.each(data, function(i, data) {
                    var index_no = i + 1;
                    if (data.customer.name) {
                        var customer_name = `
                                    <div class="p-0">
                                        <span class="name details">${data.customer.name}</span>
                                    </div>
                                    <div class="background">
                                        ${data.customer.mobile}
                                    </div>
                                `;
                    } else {
                        var customer_name = `
                                    <div class="p-0">
                                        <span class="name">N/A</span>
                                    </div>
                                `;
                    }

                    if (data.driver.name) {
                        var driver_name = `
                                    <div class="p-0">                                
                                        <span class="name details">${data.driver.name} </span>
                                    </div>
                                        <div class="background">
                                            ${data.driver.mobile}
                                        </div>
                            `;
                    } else {
                        var driver_name = `
                                    <div class="p-0">                                
                                        <span class="name">N/A</span>
                                    </div>
                            `;
                    }
                    var origin_address = `<div class="address">${data.origin.address}</div>`;
                    var destination_address = `<div class="address">${data.destinations[0].address}</div>`;
                    var service = `
                                    <span class="title">${data.service.name}</span>
                                        `;

                    var fare = `  ₹ ${data.ride.fare} `;

                    var ride = `
                            <span class="title">${data.ride.type}</span>
                        `;

                    var start_time = `
                            <span class="title">${data.tripStartTime}</span>
                        `;

                    var end_time = `
                            <span class="title">${data.tripEndTime}</span>
                        `;
                    
                    if(response.totalRide > 0){

                        table.row.add([index_no, customer_name, driver_name, origin_address, destination_address, service, fare, ride, start_time, end_time]).draw(false);
                    }
                    else{
                        $(`#table tbody .dataTables_empty`).text('Data not found');
                    }

                });

                $('#ride_details').show();
            }
        });
    }

    // <image src="${data.service.image}" style="width:50px"><br>
    // <image src="${data.ride.typeImage}" style="width:40px"><br>

</script>