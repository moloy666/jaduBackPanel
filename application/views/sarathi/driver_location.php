<style>
    #map {
        margin-top: 5px;
        height: 90vh;
        width: 100%;
    }
    #legend {
        width: 160px;
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 2px solid #000;
    }

    #legend h6 {
        margin-top: 0;
    }

    strong {
        font-size: 12px;
    }

    #legend img {
        vertical-align: middle;
    }
</style>
<div class="content-wrapper">
    <div class='d-flex flex-column justify-content-center'>
        <div id="map" class="d-flex justify-content-center align-items-center"></div>
        <div id="legend">
            <h6>Working Status</h6>
        </div>
        <div id="refresh"></div>
    </div>
</div>

<script type="text/javascript">
    $('#driver_location_page ').addClass('active');
    var BaseUrl = '<?= base_url ?>';

    display_driver_location();
    function display_driver_location(){
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
    }
       

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

        var waiting = 0;
        var inactive = 0;
        var running = 0;

        $.each(locations, function(i, location_details) {

            var color = '';
            if (location_details.driver_status == "DRIVER_WAITING") {
                var image = "<?= base_url('assets/images/green_car.png') ?>";
                var working_status = "Waiting";
                color = "#138f21";
                waiting++;

            }
            if (location_details.driver_status == "DRIVER_INACTIVE") {
                var image = "<?= base_url('assets/images/red_car.png') ?>";
                var working_status = "Inactive";
                color = "#a80303";
                inactive++;


            }
            if (location_details.driver_status == "DRIVER_GO_TO") {
                var image = "<?= base_url('assets/images/yellow_car.png') ?>";
                var working_status = "Running";
                color = "#cfb404";
                running++;
            }

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(location_details.lat, location_details.lng),
                map: map,
                draggable: false,
                icon: image,
                title: working_status
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(
                        "<b>" + locations[i].driver_name +
                        "<br>Total Travelled : " + locations[i].totalTravelled /1000 + " KM" +
                        "<br>Vehicle Number : " + locations[i].vehicle_number + ""

                        +
                        "</b>"
                    );
                    infowindow.open(map, marker);
                }
            })(marker, i));


        });
        add_refresh_button(map);
        add_legend(map, waiting, inactive, running);
    }

    function add_legend(map, waiting, inactive, running) {
        let legend = document.getElementById("legend");
        let div = document.createElement("div");

        div.innerHTML = `
        <img src="<?= base_url('assets/images/green_car.png') ?>" alt=""> <strong class="ml-3">Waiting (${waiting})</strong><br>
        <img src="<?= base_url('assets/images/red_car.png') ?>" alt="">   <strong class="ml-3">Inactive (${inactive})</strong><br>
        <img src="<?= base_url('assets/images/yellow_car.png') ?>" alt=""><strong class="ml-3">Running (${running})</strong>
        `;
        legend.appendChild(div);
        map.controls[google.maps.ControlPosition.CENTER_BOTTOM].push(legend);
    }

    function add_refresh_button(map) {
        var centerControlDiv = document.createElement("div2");
        var centerControl = createCenterControl(map);
        centerControlDiv.appendChild(centerControl);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
    }

    function createCenterControl(map) {
        var controlButton = document.createElement("button");
        controlButton.style.backgroundColor = "#fff";
        controlButton.style.border = "2px solid #fff";
        controlButton.style.borderRadius = "3px";
        controlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlButton.style.color = "rgb(25,25,25)";
        controlButton.style.cursor = "pointer";
        controlButton.style.fontFamily = "Roboto,Arial,sans-serif";
        controlButton.style.fontSize = "16px";
        controlButton.style.lineHeight = "38px";
        controlButton.style.margin = "8px 0 22px";
        controlButton.style.padding = "0 5px";
        controlButton.style.textAlign = "center";
        controlButton.textContent = "Refresh Map";
        controlButton.title = "Click to refresh the map";
        controlButton.type = "button";
        controlButton.addEventListener("click", () => {
            display_driver_location();
        });
        return controlButton;
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
                    // console.log('address not found');
                }
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= const_google_api_key ?>&callback=initMap" async defer></script>