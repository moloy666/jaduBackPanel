<script src="<?=nodeUrl?>socket.io/socket.io.js"></script>
<script>
    var socket = io("<?=nodeUrl?>", {
        transports: ["websocket"]
    });

    socket.on('connect', () => {
        console.log('--connected');
    });
</script>
<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script>
    var apiBaseUrl = '<?=apiBaseUrl?>';

    $.ajax({
        type: "GET",
        url: "<?= base_url('admin/get_current_datetime') ?>",
        error: function(response) {
            console.log(response);
        },
        success: function(response) {
            let date = response.date;
            $('#date').val(date);
        }
    });

    // display customer by code

    $('#btn_search').click(function() {
        var booking_id = $('#booking_id').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_customer_by_booking_id') ?>",
            data: {
                "booking_id": booking_id
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    var details = '';
                    $.each(data, function(i, data) {
                        details += `
                            <tr>
                                <td><image src="${apiBaseUrl}${data.profile_image}" width="50px"></td>
                                <td class="title">${data.name}<input type="hidden" value="${data.customer_id}" id="customer_id"></td>
                                <td>${data.email}</td>
                                <td>${data.mobile}</td>
                                <td>
                                <label class="switch">
                                    <input type="checkbox" id="check_status" onclick="default_location(this, '${data.lat}', '${data.lng}')">
                                    <span class="slider round"></span>
                                </label>
                            </tr>
                            `;
                        $('#table').show();
                        $('#table_details').html(details);
                    });


                } else {
                    toast(response.message, "center");
                    $('#table').hide();
                }
            }
        });
    });

    // display customer current location

    function default_location(element, lat, lng) {
        if (element.checked == true) {
            $('#lat_origin').val(lat);
            $('#lang_origin').val(lng);
            element.removeAttribute("checked");
            get_address_by_lat_lng(lat, lng);

        } else {
            $('#lat_origin').val('');
            $('#lang_origin').val('');
            $('#destination_from').val('');
        }
    }

    function get_address_by_lat_lng(lat, lng) {
        var lat = lat;
        var lng = lng;
        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'latLng': latlng
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    // console.log(results[1]);
                    let address = results[1].formatted_address;
                    $('#location_model').modal('show');
                    $('#text_location').val(address);

                } else {
                    $('#location_model').modal('show');
                    $('#text_location').val("Address Not Found...");
                }
            }
        });
    }

    $('#btn_confirm_location').click(function() {
        let location = $('#text_location').val();
        $('#destination_from').val(location);
        $('#location_model').modal('hide');
    });
    $('#btn_not_confirm').click(function() {
        $('#check_status').prop("checked", false);
    });

    /////////////// display location  and co-ordinate

    var searchInput = '';

    $('#destination_from').click(function() {
        searchInput = 'destination_from';
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['establishment'],
            componentRestrictions: {
                country: "in"
            }
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var near_place = autocomplete.getPlace();
            $('#lat_origin').val(near_place.geometry.location.lat);
            $('#lang_origin').val(near_place.geometry.location.lng);
        });
    });

    $('#destination_to').click(function() {
        searchInput = 'destination_to';
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['establishment'],
            componentRestrictions: {
                country: "in"
            }
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var near_place = autocomplete.getPlace();
            $('#lat_destination').val(near_place.geometry.location.lat);
            $('#lang_destination').val(near_place.geometry.location.lng);
        });
    });

 
    /////// display car list

    $('#btn_car_list').click(function() {

        let flag = 0;

        let lat_origin = $('#lat_origin').val();
        let lang_origin = $('#lang_origin').val();
        let lat_destination = $('#lat_destination').val();
        let lang_destination = $('#lang_destination').val();

        var location_distance = 0;
        var location_duration = 0;

        if (lat_origin.length == 0 || lang_origin.length == 0) {
            flag = 1;
            toast("Enter Origin Location", "center");
        }

        if (lat_destination.length == 0 || lang_destination.length == 0) {
            flag = 1;
            toast("Enter Destination Location", "center");
        }

        let origin = {
            'lat': parseFloat(lat_origin),
            'lng': parseFloat(lang_origin)
        };

        let destination = {
            'lat': parseFloat(lat_destination),
            'lng': parseFloat(lang_destination)
        };

        if (flag == 0) {
            let directionsService = new google.maps.DirectionsService();
            let directionsRenderer = new google.maps.DirectionsRenderer();

            // directionsRenderer.setMap(map); // Existing map object displays directions
            // Create route from existing points used for markers

            let route = {
                origin: origin,
                destination: destination,
                travelMode: 'DRIVING'
            }

            directionsService.route(route,
                function(response, status) { // anonymous function to capture directions
                    if (status !== 'OK') {
                        console.log('Directions request failed due to ' + status);
                        console.log(response);
                        return;
                    } else {
                        // directionsRenderer.setDirections(response); // Add route to the map
                        var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
                        // console.log(directionsData);
                        if (!directionsData) {
                            console.log('Directions request failed');
                            return;
                        } else {
                            location_distance = directionsData.distance.value;
                            location_duration = directionsData.duration.value;

                            ride_list(lat_origin, lang_origin, lat_destination, lang_destination, location_distance, location_duration);
                        }
                    }
                }
            );
        }
    });


    function ride_list(lat_origin, lang_origin, lat_destination, lang_destination, location_distance, location_duration) {

        let data = {
            "distance": location_distance,
            "duration": location_duration,
            "locations": {
                "origin": {
                    "lat": lat_origin,
                    "lng": lang_origin
                },
                "destination": {
                    "lat": lat_destination,
                    "lng": lang_destination
                },
                "waypoints": []
            }
        }


       // https://jaduridedev.v-xplore.com/customers/CUSTOMER_99741e712854bc707851396c634c4997_1666944749/ride/list?service=SERVICE_CAR

        var customer_id=$('#customer_id').val();

        $.ajax({
           
            url: `<?=apiBaseUrl?>customers/${customer_id}/ride/list?service=SERVICE_CAR`,
            type: "POST",
            headers: {
                "x-api-key": '<?= const_x_api_key ?>',
                "platform": "web",
                "deviceid": "",
            },
            contentType: "application/json",
            data: JSON.stringify(data),
            processData: false,
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.status) {
                    let data = response.cabType;
                    let distance = response.distance;
                    let details = '';

                    $('#distance').text(distance);

                    $.each(data, function(i, data) {
                        details += `
                        <div class="card m-2 col-lg-2 col-md-2">
                            <img class="card-img-top" src="${data.imageUrl}" alt="vehicle image cap">
                            <div class="card-body d-flex justify-content-around">

                                <small class="title mr-3"><strong>${data.type}</strong></small>

                                <small><strong>₹${data.price}</strong></small>
                            </div>
                            <button class="btn btn-primary w-100 mb-2" style="display:block" onclick="book_customer(this, '${data.id}', '${data.price}')">Book</button>
                            </div>
                            `;
                        $('#wait_time').text(data.waitTime);
                    });

                   
                    $('#cab_details').html(details);
                    $('#cab_list').show();
                    $('#txt_distance').show();
                    $('#txt_wait_time').show();

                    $('#confirm_pickup_ride').hide();


                } else {
                    $('#cab_list').hide();
                    toast("No cab found near by this location", "center");
                }
            }
        });

    }

    ////////////// booking customer

    function book_customer(element, service_type_id, fare) {

        let customer_id = $('#customer_id').val();
        let lat_origin = $('#lat_origin').val();
        let lang_origin = $('#lang_origin').val();
        let lat_destination = $('#lat_destination').val();
        let lang_destination = $('#lang_destination').val();

        let distance = $('#distance').text();
        let duration = $('#wait_time').text();

        let destination_from = $('#destination_from').val();
        let destination_to = $('#destination_to').val();

        let data = {
            "serviceId": "SERVICE_CAR",
            "fareServiceTypeId": service_type_id,
            "fare": fare,
            "paymentMethod": "cash",
            "locations": {
                "origin": {
                    "lat": lat_origin,
                    "lng": lang_origin
                },
                "destination": {
                    "lat": lat_destination,
                    "lng": lang_destination
                },
                "waypoints": []
            },
            "locationsText": [{
                "startAddress": destination_from,
                "endAddress": destination_to
            }, ],
            "distance": distance,
            "duration": duration
        }


        $.ajax({
            type: "POST",
            url: `<?=apiBaseUrl?>customers/users/${customer_id}/initiateBooking`,
            headers: {
                "x-api-key": '<?= const_x_api_key ?>',
                "platform": "web",
                "deviceid": "",
            },
            data: JSON.stringify(data),
            contentType: "application/json",
            processData: false,
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                if (response.status) {
                    $('#cab_list').hide();
                    $('#confirm_pickup_ride').show();

                    let ride_id = response.rideId;
                    $("#onCallRideId").val(ride_id);
                } else {}
            }
        });
    }

    $('#confirm_pickup').click(function() {
        socket.emit('initialiseRide', $("#onCallRideId").val());
    });

    ///////// Erase previous record

    $('#btn_clear').click(function() {
        $('#destination_from').val('');
        $('#lat_origin').val('');
        $('#lang_origin').val('');

        $('#destination_to').val('');
        $('#lat_destination').val('');
        $('#lang_destination').val('');

        $('#txt_distance').hide();
        $('#txt_wait_time').hide();
        $('#cab_list').hide();

        $('#check_status').prop("checked", false);
    });


    $('#cancle_ride').click(function(){
        $('#confirm_pickup_ride').hide();
        // $('#btn_clear').click();
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?= const_google_api_key ?>"></script>