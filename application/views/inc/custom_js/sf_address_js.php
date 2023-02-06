<script>
    display_country_name();

    function display_country_name() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_country_name') ?>",
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var data = response.data;
                    var details = '<option value="">Select Country</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#country').html(details);
                    $("#country").prop("selectedIndex", 1);
                    display_state_names();

                } else {
                    var details = '<option value="">Country Not Available</option>';
                    $('#country').html(details);
                }
            }
        });
    }

    $('#country').change(function() {
        display_state_names();
    });

    function display_state_names() {
        let country_id = $('#country').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_state_names') ?>",
            data: {
                "id": country_id
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var data = response.data;
                    var details = '<option value="">Select State</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#state').html(details);
                    display_district_names();
                } else {
                    var details = '<option value="">States Not Found</option>';
                    $('#state').html(details);
                    display_district_names();

                }
            }
        });
    }

    $('#state').change(function() {
        display_district_names();
    });


    function display_district_names() {
        let state_id = $('#state').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_district_names') ?>",
            data: {
                "id": state_id
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var data = response.data;
                    var details = '<option value="">Select District Names</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#district').html(details);
                    display_city_names();

                } else {
                    var details = '<option value="">District Not Found</option>';
                    $('#district').html(details);
                    display_city_names();

                }
            }
        });
    }

    $('#district').change(function() {
        display_city_names();
    });

    function display_city_names() {
        let district_id = $('#district').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_city_names') ?>",
            data: {
                "id": district_id
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var data = response.data;
                    var details = '<option value="">Select City Names</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#city').html(details);
                } else {
                    var details = '<option value="">City Not Found</option>';
                    $('#city').html(details);
                }
            }
        });
    }
</script>