<style>
    #map {
        margin-top: 5px;
        height: 80vh;
        width: 100%;
    }
    #legend {
        height: 10vh;
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
        <div id="legend_1"></div>
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
                var image = "<?= base_url(marker_path.marker_waiting_car) ?>";
                var working_status = "Waiting";
                waiting++;

            }
            if (location_details.driver_status == "DRIVER_INACTIVE") {
                var image = "<?= base_url(marker_path.marker_inactive_car) ?>";
                var working_status = "Inactive";
                inactive++;


            }
            if (location_details.driver_status == "DRIVER_GO_TO") {
                var image = "<?= base_url(marker_path.marker_running_car) ?>";
                var working_status = "Running";
                running++;
            }

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(location_details.lat, location_details.lng),
                map: map,
                draggable: false,
                icon: image,
                title: 'Working Status : ' + working_status
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
        let legend = document.getElementById("legend_1");

        legend.innerHTML = `
        <h6>Working Status</h6>
            <img src="<?= base_url(marker_path.marker_waiting_car) ?>" alt=""> <strong class="ml-3">Waiting (${waiting})</strong>
            <img src="<?= base_url(marker_path.marker_inactive_car) ?>" alt="">   <strong class="ml-3">Inactive (${inactive})</strong>
            <img src="<?= base_url(marker_path.marker_running_car) ?>" alt=""><strong class="ml-3">Running (${running})</strong>
        `;
        
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


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= const_google_api_key ?>&callback=initMap" async defer></script>