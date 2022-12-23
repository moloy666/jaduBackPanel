<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script>
    display_country_name();
    get_panel_access_list();
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


    ////////////////////// Add State name ///////////////////////////////////////////
    var parent_id = '';
    var name = '';
    var place = '';

    $('#btn_add_state').click(function() {
        if ($('#country').val() == '') {
            toast('Select a Country! ', "center")
        } else {
            parent_id = $('#country').val();
            get_place_name_by_id(parent_id);
            $('#parent_id').val(parent_id);
            $('#cmnTitle').text('Add State Name');
            place = '<?= value_state ?>';
            $('#common_modal').modal('show');
        }

    });

    $('#btn_add_district').click(function() {
        if ($('#state').val() == '') {
            toast('Select a State ! ', "center")
        } else {
            parent_id = $('#state').val();
            get_place_name_by_id(parent_id);
            $('#parent_id').val(parent_id);
            $('#cmnTitle').text('Add District Name');
            place = 'district';
            $('#common_modal').modal('show');

        }
    });

    $('#btn_add_city').click(function() {
        if ($('#district').val() == '') {
            toast('Select a District ! ', "center")
        } else {
            parent_id = $('#district').val();
            get_place_name_by_id(parent_id);
            $('#parent_id').val(parent_id);
            $('#cmnTitle').text('Add City Name');
            place = 'city';
            $('#common_modal').modal('show');
        }
    });

    function get_place_name_by_id(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_place_name_by_id') ?>",
            data: {
                "id": id,
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                let data = response.data;
                console.log(data);
                $('#parent_name').val(data);
            }
        })
    }


    $('#btn_add_data').click(function() {
        name = $('#name').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/add_place_name') ?>",
            data: {
                "name": name,
                "id": parent_id,
                "place": place
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    toast(response.message, "center");
                    display_country_name();
                    $('#common_modal').modal('hide');
                } else {
                    toast(response.message, "center");
                }
            }
        });
    });


    //////////////////// Delete ////////////////////////////////////

    $('#btn_delete_city').click(function() {
        if ($('#city').val() == '') {
            toast('Select a city  to delete', "center");
        } else {
            $('#deleted_id').val($('#city').val());
            $('#delete_modal').modal('show');
        }
    });

    $('#btn_delete_state').click(function() {
        if ($('#state').val() == '') {
            toast('Select a state to delete', "center");
        } else {
            $('#deleted_id').val($('#state').val());
            $('#delete_modal').modal('show');
        }

    });

    $('#btn_delete_district').click(function() {
        if ($('#district').val() == '') {
            toast('Select a district to delete', "center");
        } else {
            $('#deleted_id').val($('#district').val());
            $('#delete_modal').modal('show');
        }
    });



    $('#btn_delete_data').click(function() {
        let id = $('#deleted_id').val();
        let table = $('#table_name').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/delete_place_names') ?>",
            data: {
                "id": id,
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    display_country_name();
                    $('#delete_modal').modal('hide');
                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    $.ajax({
        type: "GET",
        url: "<?= base_url('admin/get_specific_id') ?>",
        error: function(response) {
            console.log(response);
        },
        success: function(response) {
            // console.log(response);
            var data = response.data;
            $('#specific_id').val(data);
        }
    });

    function get_panel_access_list() {
        let user_id=$('#user_id').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_FRANCHISE.'/get_panel_access_list') ?>",
            
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                let permission = response.data.permission;
                let data = permission.split(",");
                $.each(data, function(i) {

                    $('.' + data[i]).removeAttr('disabled', 'disabled');
                    // console.log(data[i]);
                });
            }
        });
    }
</script>