<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script>
    // display_service_type();
    get_panel_access_list();
    // display service names
    function display_service_type() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_service_name') ?>",
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var data = response.data;
                    var details = '<option value="">Select Service</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#services').html(details);
                    $('#modal_services').html(details);
                } else {
                    var details = '<option value="">Services Not Found</option>';
                    $('#services').html(details);
                }

            }
        });
    }

    // display ride names

    $('#services').change(function() {
        display_ride_type();
    });

    function display_ride_type() {
        let service_id = $('#services').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_ride_names') ?>",
            data: {
                "id": service_id
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var data = response.data;
                    var details = '<option value="">Select Ride Types</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#ride_type').html(details);
                    $('#modal_ride_type').html(details);

                    display_cab_names();
                } else {
                    var details = '<option value="">Ride Not Found</option>';
                    $('#ride_type').html(details);
                    $('#modal_ride_type').html(details);
                    display_cab_names();

                }
            }
        });
    }

    $('#ride_type').change(function() {
        display_cab_names();
    });


    function display_cab_names() {
        let ride_id = $('#ride_type').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_cab_names') ?>",
            data: {
                "id": ride_id
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    var data = response.data;
                    var details = '<option value="">Select Cab Types</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#cab_type').html(details);
                } else {
                    var details = '<option value="">Cab Not Found</option>';
                    $('#cab_type').html(details);
                }
            }
        });
    }



    ////////////////////// Add sevice name ///////////////////////////////////////////

    $('#btn_add_service').click(function() {
        let name = $('#service_name').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/add_service_type') ?>",
            data: {
                "name": name
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    toast(response.message, "center");

                    $('#service_modal').modal('hide');
                    $('#service_name').val('');
                    // display_service_type();

                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    $('#btn_add_ride').click(function() {
        let service_id = $('#services').val();
        $('#modal_services').val(service_id);

    });

    $('#btn_add_cab').click(function() {
        let ride_id = $('#ride_type').val();
        $('#modal_ride_type').val(ride_id);

    });


    $('#add_ride_form').submit(function(e) {
        e.preventDefault();
        let form = document.getElementById('add_ride_form');
        let formData = new FormData(form);
        let service_id = $('#modal_services').val();
        let specific_id = $('#specific_id').val();

        // console.log(service_id);

        formData.append('service', service_id);
        formData.append('specific_id', specific_id);

        // url: "https://jaduridedev.v-xplore.com/service/addRide",

        $.ajax({
            type: "POST",
            url: "<?= apiBaseUrl ?>service/addRide",
            headers: {
                'x-api-key': '<?= const_x_api_key ?>',
                'platform': 'web',
                'deviceid': ''
            },
            data: formData,
            contentType: false,
            processData: false,
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                console.log(response);
                if (response.status) {
                    $('#ride_modal').modal('hide');
                    display_ride_type();
                    $('#add_ride_form')[0].reset();
                    toast(response.message, "center");

                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    $('#btn_add_cab_name').click(function() {
        let cab_name = $('#cab_name').val();
        let ride_id = $('#modal_ride_type').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/add_cab_name') ?>",
            data: {
                "ride_id": ride_id,
                "cab_name": cab_name
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    display_cab_names();
                    $('#cab_modal').modal('hide');
                    $('#cab_name').val('');
                    $('#modal_rides').val('');
                    toast(response.message, "center");

                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    //////////////////// Delete ////////////////////////////////////

    $('#btn_delete_cab').click(function() {
        $('#deleted_id').val($('#cab_type').val());
        $('#table_name').val('cabs_under_service_type');
    });

    $('#btn_delete_ride').click(function() {
        $('#deleted_id').val($('#ride_type').val());
        $('#table_name').val('ride_service_type');
    });

    $('#btn_delete_service').click(function() {
        $('#deleted_id').val($('#services').val());
        $('#table_name').val('services');
    });

    $('#btn_delete_data').click(function() {
        let id = $('#deleted_id').val();
        let table = $('#table_name').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/delete_service_type') ?>",
            data: {
                "id": id,
                "table": table
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    if ($('#table_name').val() == 'services') {
                        // display_service_type();
                        display_ride_type();
                        display_cab_names();
                        toast(response.message, "center");

                    }
                    if ($('#table_name').val() == 'ride_service_type') {
                        display_ride_type();
                        display_cab_names();
                        toast(response.message, "center");


                    }
                    if ($('#table_name').val() == 'cabs_under_service_type') {
                        display_cab_names();
                        toast(response.message, "center");

                    }

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
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_panel_access_list') ?>",
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

    $('#btn_update_ride').click(function() {
        let ride_id = $('#ride_type').val();
        if (ride_id != '') {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/get_ride_type_details') ?>",
                data: {
                    "id": ride_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    let data = response.data;

                    $('#ride_id').val(data.uid);
                    $('#ride_name').val(data.name);
                    $('#short_desc').val(data.short_description);
                    $('#long_desc').val(data.long_description);
                    $('#ride_icon').attr('src', '<?=apiBaseUrl?>'+ data.image);

                    $('#ride_update_modal').modal('show');
                }
            });
        }
        else{
            toast("Select Ride Type to Update", 'center');
        }
    });

    $('#btn_save_ride_data').click(function(){
        $.ajax({
            type:"POST",
            url:"<?=base_url('administrator/update_ride_details')?>",
            data:{
                "id":$('#ride_id').val(),
                "short":$('#short_desc').val(),
                "long":$('#long_desc').val(),
                "specific_id":$('#specific_id').val()
            },
            error:function(response){
                console.log(response);
            },
            success:function(response){
                // console.log(response);
                if(response.success){
                    toast(response.message, 'center');
                    $('#ride_update_modal').modal('hide');

                }
                else{
                    toast(response.message, 'center');
                }
            }
        });
    });
</script>