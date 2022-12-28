<script>
    // ride_details();

    function get_current_date() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('admin/get_current_datetime') ?>",
            async:false,
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                let date = response.date;
                // $('#date').val(date);

                $('#ride_from').val(date);
                $('#ride_to').val(date);
            }
        });
    }


    $('#ride_stage').change(() => {
        if ($('#ride_from').val() != '' && $('#ride_to').val() != '') {
            if ($('#ride_stage').val() == '0') {
                $('#btn_search').hide();
            } else {
                $('#btn_search').show();
            }
        }
    });


    $('#ride_to').change(() => {
        if ($('#ride_stage').val() != '0' && $('#ride_from').val() != '') {
            if ($('#ride_to').val() == '') {
                $('#btn_search').hide();
            } else {
                $('#btn_search').show();
            }
        }
    });

    $('#ride_from').change(() => {
        if ($('#ride_stage').val() != '0' && $('#ride_to').val() != '') {
            if ($('#ride_from').val() == '') {
                $('#btn_search').hide();
            } else {
                $('#btn_search').show();
            }
        }
    });

    $('#btn_search').click(() => {
        ride_details();
    });

    ride_details();

    function ride_details() {

        get_current_date();

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
            url: `<?= apiBaseUrl ?>ride/history/all?ride_stage=${ride_stage}&from=${ride_from}&to=${ride_to}&schedule=${schedule}`,
            // url: `<?= apiBaseUrl ?>ride/history/all`,
            headers: {
                "x-api-key": '<?= const_x_api_key ?>',
                "platform": "web",
                "deviceid": ""
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                $('#table_details').html('');
                console.log(response);
                let data = response.data;
                let details = '';
                let customer_gender = '';
                let driver_gender = '';
                $.each(data, function(i, data) {
                    let last_des = data.destinations.length - 1;
                    
                    if (data.customer.gender.toLowerCase() == 'male') {
                        customer_gender = '(M)';
                    } else {
                        customer_gender = '(F)';
                    }

                    if (data.driver.gender.toLowerCase() == 'male') {
                        driver_gender = '(M)';
                    } else {
                        driver_gender = '(F)';
                    }
                    details += `
                    <tr>
                        <td class="text-center">${i+1}</td>

                        <td class="text-left name_column">                            
                            <div class="p-0">
                                <span class="name img_name">${data.customer.name} ${customer_gender}</span>
                            </div>
                            <div class="background">
                                ${data.customer.mobile}
                            </div>
                        </td>

                        <td class="text-left name_column">    
                            <div class="p-0">                                
                                <span class="name">${data.driver.name} ${driver_gender}</span>
                            </div>
                            <div class="background">
                                ${data.driver.mobile}
                            </div>
                        </td>

                        <td class="text-center">${data.origin.address}</td>
                        <td class="text-center">${data.destinations[last_des].address}</td>

                        <td class="text-center">
                            <image src="${data.service.image}" style="width:50px"><br>
                            <span class="title">${data.service.name}</span>
                        </td>

                        <td class="text-center">
                           ₹ ${data.ride.fare} 
                        </td>

                        <td class="text-center">
                            <image src="${data.ride.typeImage}" style="width:40px"><br>
                            <span class="title">${data.ride.type}</span>
                        </td>

                        <td class="text-center">
                            <span class="title">${data.tripStartTime}</span>
                        </td>

                        <td class="text-center">
                            <span class="title">${data.tripEndTime}</span>
                        </td>

                    </tr>`;

                });
                $('#table_details').html(details);
                $('#ride_details').show();
                $('#table').dataTable();
            }
        });
    }
</script>

<style>
    .img-profile {
        width: 50px;
        height: 50px;
        border-radius: 2rem;
    }

    .name {
        font-weight: bold;
        font-size: small;
    }

    .name_column {
        width: 200px;
    }

    .background {
        /* background-color: wheat; */
        font-size: 11px;
    }

    .title {
        text-transform: capitalize;
    }
</style>