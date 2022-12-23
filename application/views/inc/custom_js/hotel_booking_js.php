<style>
    #map {
        margin-top: 5px;
        height: 85vh;
        width: 60%;
    }

    .title {
        text-transform: capitalize;
    }
</style>
<script>
    var apiBaseUrl = 'https://jaduridedev.v-xplore.com/';

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
            types: ['geocode'],
            componentRestrictions: {
                country: "IND"
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
            types: ['geocode'],
            componentRestrictions: {
                country: "IND"
            }
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var near_place = autocomplete.getPlace();
            $('#lat_destination').val(near_place.geometry.location.lat);
            $('#lang_destination').val(near_place.geometry.location.lng);
        });
    });


    initMap();

    function initMap() {

        // var infowindow = new google.maps.InfoWindow();

        var myLatLng = {
            lat: parseFloat(22.5726),
            lng: parseFloat(88.3639)
        };

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: myLatLng,
            draggable: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            draggable: false,
            title: 'Jaduride'
        });

        marker.setMap(map);

        google.maps.event.addListener(map, 'center_changed', function() {
            marker.setPosition(this.getCenter());
           get_address_by_lat_lng(this.getCenter().lat(), this.getCenter().lng());
        });

        // google.maps.event.addListener(map, 'dragend', function() {
        //    marker.setPosition(this.getCenter());
        //    get_address_by_lat_lng(this.getCenter().lat(), this.getCenter().lng());
        // });
    }




    function get_address_by_lat_lng(lat, lng) {
        var lat = lat;
        var lng = lng;

        $('#lat').val(lat);
        $('#lng').val(lng);

        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'latLng': latlng
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    let address = results[1].formatted_address;
                    $('#address').val(address);
                } else {
                    console.log('Not found');
                }
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= const_google_api_key ?>&callback=initMap" async defer></script>