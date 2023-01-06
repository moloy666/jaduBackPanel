<style>
    .name {
        font-weight: bold;
        font-size: small;
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

    .address{
        width: 400px;
        text-align: left !important;
    }

 
</style>
<script>
    $('#btn_search').click(() => {
        ride_details();
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

                let data = response.data;
                let details = '';
                let customer_gender = '';
                let driver_gender = '';

                $.each(data, function(i, data) {

                    if (data.customer.gender == 'male') {
                        customer_gender = '(M)';
                    } else {
                        customer_gender = '(F)';
                    }

                    if (data.driver.gender == 'male') {
                        driver_gender = '(M)';
                    } else {
                        driver_gender = '(F)';
                    }

                    details += `
                    <tr>
                        <td class="text-center">${i+1}</td>

                        <td class="text-left name_column details">                            
                            <div class="p-0">
                                <span class="name img_name">${data.customer.name}  ${customer_gender} </span>
                            </div>
                            <div class="background">
                                ${data.customer.mobile}
                            </div>
                        </td>

                        <td class="text-left name_column details">    
                            <div class="p-0">                                
                                <span class="name">${data.driver.name} ${driver_gender}</span>
                            </div>
                            <div class="background">
                                ${data.driver.mobile}
                            </div>
                        </td>

                        <td class=""><div class="address">${data.origin.address}</div></td>
                        <td class=""><div class="address">${data.destinations[0].address}</div></td>

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
                $('#ride_details').show()
                $('#table').dataTable();
            }
        });
    }
</script>