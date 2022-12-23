<style>
    #map {
        margin-top: 5px;
        height: 90vh;
        width: 100%;
    }
</style>
<div class="content-wrapper">
    <div class='d-flex justify-content-center'>
        <div id="map" class="d-flex justify-content-center align-items-center"></div>
    </div>
</div>

<script type="text/javascript">
   
    $('#driver_location_page ').addClass('active');
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('sarathi/display_driver_location') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    var locations = response.data;
                    initMap(locations);
                } else {
                    $('#map').text('Driver Not Found').addClass('font-weight-bold');
                }


            }
        });
    });

    var BaseUrl ='<?=base_url?>';


    function initMap(locations) {

        var map;
        var infowindow = new google.maps.InfoWindow();

        var myLatLng = {
            lat: parseFloat(locations[0].lat),
            lng: parseFloat(locations[0].lng)
        };

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        $.each(locations, function(i, location_details) {

            var color = '';
            if (location_details.driver_status == "DRIVER_WAITING") {
                var image = "<?= base_url('assets/images/green_car.png') ?>";
                var working_status="Waiting";
                color = "#138f21";
            }
            if (location_details.driver_status == "DRIVER_INACTIVE") {
                var image = "<?= base_url('assets/images/red_car.png') ?>";
                var working_status="Inactive";
                color = "#a80303";
            }
            if (location_details.driver_status == "DRIVER_GO_TO") {
                var image = "<?= base_url('assets/images/yellow_car.png') ?>";
                var working_status="Running";
                color = "#cfb404";
            }

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(location_details.lat, location_details.lng),
                map: map,
                draggable:false,
                icon: image,
                title: working_status
                // title: "Latitude : " + location_details.lat + "\nLongitude : " + location_details.lng
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i].driver_name);
                    infowindow.open(map, marker);
                }
            })(marker, i));

            google.maps.event.addListener(marker, 'dragend', (function(marker, i) {
                return function() {
                    var newLat = map.getCenter().lat();
                    var newLng = map.getCenter().lng();
                    get_address_by_lat_lng(newLat, newLng);
                }
            })(marker, i));
        });
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
                    console.log(address);                    
                } else {
                    console.log('address not found');
                }
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= const_google_api_key ?>&callback=initMap" async defer></script>