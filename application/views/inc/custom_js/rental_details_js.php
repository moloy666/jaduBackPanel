<script>
    $('#rental_page').addClass('active');

    get_cab_types();
    display_rental_features();

    function get_cab_types() {
        $.ajax({
            type: "get",
            url: "<?= base_url('administrator/get_cab_types_for_retail_details') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                let details = '<option value="">Choose Cab Type</option>';
                $.each(data, function(i, data) {
                    details += `
                    <option value="${data.uid}" class="title">${data.name}</option>
                    `;
                });
                $('#cab_types').html(details);
                get_panel_access_list();
            }
        });
    }

    $('#btn_features').click(function() {
        if ($('#cab_types').val() == '') {
            toast('Choose a Cab Type', "center");
        } else {
            $('#features').modal('show');
        }
    });

    function display_rental_features() {
        $.ajax({
            type: 'get',
            url: "<?= base_url('admin/display_rental_features') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    let data = response.data;
                    let details = '';
                    $.each(data, function(i, data) {
                        details += `
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control check_features" type="checkbox" id="check_${data.uid}" onclick="save_features(this, '${data.uid}')" style="cursor:pointer">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>${data.title}</h5>
                            </div>
                        </div>
                        <hr>
                            `;
                    });
                    $('#features_details').html(details);
                }
            }
        });
    }

    function save_features(state, feature_id) {

        if (state.checked == true) {
            $.ajax({
                url: "<?= base_url('admin/save_ride_features') ?>",
                type: "post",
                data: {
                    "id": feature_id,
                    "ride_id": $('#cab_types').val(),
                },
                success: function(response) {
                    if (response.success) {
                        state.removeAttribute("checked");
                        toast(response.message, "center");

                        let data = response.data;

                    } else {
                        toast(response.message, "center");
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        } else {
            $.ajax({
                url: "<?= base_url('admin/delete_ride_features') ?>",
                type: "post",
                data: {
                    "id": feature_id,
                    "ride_id": $('#cab_types').val(),
                },
                success: function(response) {
                    if (response.success) {
                        toast(response.message, "center");
                        let data = response.data;

                    } else {
                        toast(response.message, "center");

                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    }


    $('#cab_types').change(function() {
        display_rental_details();
        display_ride_feature_data();
    });

    function display_ride_feature_data() {
        let id = $('#cab_types').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/display_ride_feature_data') ?>",
            data: {
                "id": $('#cab_types').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                $('.check_features').prop('checked', false);
                if (response.success) {
                    let data = response.data;
                    $.each(data, function(i) {
                        $('#check_' + data[i]).prop('checked', true);
                    });
                } else {
                    $('.check_features').prop('checked', false);
                }
            }
        });
    }

    function display_rental_details() {
        var ride_id = $('#cab_types').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_rental_details') ?>",
            data: {
                "ride_id": ride_id
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                let details = '';
                $.each(data, function(i, data) {
                    // uid ( slabs_id)
                    details += `
                    <tr>
                        <td class="text-center"><input type="checkbox" onclick="check(this, '${data.uid}', '${ride_id}')" id="slab_${data.uid}" style="cursor:pointer"></td>
                        <th class="text-center">${data.hr} hr ${data.km} km</th>
                        <th class="text-center">
                            <input type="text" class="form-control box" id="amount_${data.uid}" placeholder="Amount"></th>
                        <th class="text-center">
                            <input type="text" class="form-control box" id="extra_km_fare_${data.uid}" placeholder="Extra Km Fare"></th>
                        <th class="text-center">
                            <input type="text" class="form-control box" id="extra_ride_time_fare_${data.uid}" placeholder="Extra Ride Time Fare"></th>
                        <th class="text-center">
                        <button class="btn btn-primary access_update" id="btn_save_${data.uid}" onclick="save(this, '${data.uid}', '${ride_id}')" disabled>Save</button></th>
                    </tr>
                    `;
                    get_rental_details(data.uid, ride_id);
                });
                $('#table_details').html(details);

                $('#slab_details').show();

                get_checked_slabs(ride_id);

                get_panel_access_list();

            }
        });
    }

    function get_checked_slabs(ride_id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/get_checked_slabs') ?>",
            data: {
                "id": ride_id
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    let data = response.data;
                    $.each(data, function(i, data) {
                        $('#slab_' + data.rental_slabs_id).prop('checked', true);
                    })
                } else {
                    console.log(response);
                }
            }
        });
    }

    function get_rental_details(uid, ride_id) {
        $.ajax({
            url: "<?= base_url('Admin/get_rental_details') ?>",
            type: "post",
            data: {
                "id": uid,
                "ride_id": ride_id,
            },
            success: function(response) {
                if (response.success) {

                    let data = response.data;

                    $('#amount_' + uid).val(data.amount);
                    $('#extra_km_fare_' + uid).val(data.extraKmFare);
                    $('#extra_ride_time_fare_' + uid).val(data.extraRideTimeFare);

                } else {
                    $('#amount_' + uid).val('');
                    $('#extra_km_fare_' + uid).val('');
                    $('#extra_ride_time_fare_' + uid).val('');

                    $('#amount_' + uid).attr('disabled', "disabled");
                    $('#extra_km_fare_' + uid).attr('disabled', "disabled");
                    $('#extra_ride_time_fare_' + uid).attr('disabled', "disabled");
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }


    function check(state, uid, ride_id) {
        if (state.checked == true) {
            $.ajax({
                url: "<?= base_url('Admin/get_rental_details') ?>",
                type: "post",
                data: {
                    "id": uid,
                    "ride_id": ride_id,
                },
                success: function(response) {
                    if (response.success) {
                        state.removeAttribute("checked");
                        // console.log(response);
                        let data = response.data;

                        $('#amount_' + uid).val(data.amount);
                        $('#extra_km_fare_' + uid).val(data.extraKmFare);
                        $('#extra_ride_time_fare_' + uid).val(data.extraRideTimeFare);

                        $('#amount_' + uid).removeAttr('disabled');
                        $('#extra_km_fare_' + uid).removeAttr('disabled');
                        $('#extra_ride_time_fare_' + uid).removeAttr('disabled');
                    } else {
                        $('#amount_' + uid).val('');
                        $('#extra_km_fare_' + uid).val('');
                        $('#extra_ride_time_fare_' + uid).val('');

                        $('#amount_' + uid).removeAttr('disabled');
                        $('#extra_km_fare_' + uid).removeAttr('disabled');
                        $('#extra_ride_time_fare_' + uid).removeAttr('disabled');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        } else {
            $('#amount_' + uid).val('');
            $('#extra_km_fare_' + uid).val('');
            $('#extra_ride_time_fare_' + uid).val('');

            $('#amount_' + uid).attr('disabled', 'disabled');
            $('#extra_km_fare_' + uid).attr('disabled', 'disabled');
            $('#extra_ride_time_fare_' + uid).attr('disabled', 'disabled');
        }
    }

    function save(e, uid, ride_id) {
        $.ajax({
            url: "<?= base_url('Admin/save_rental_details') ?>",
            type: "post",
            data: {
                "id": uid,
                "ride_id": ride_id,
                "amount": $('#amount_' + uid).val(),
                "km_fare": $('#extra_km_fare_' + uid).val(),
                "time_fare": $('#extra_ride_time_fare_' + uid).val(),
            },
            error: function(response) {
                alert(JSON.stringify(response));
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    toast(response.message, "center");

                } else {
                    toast(response.message, "center");

                }
            }
        });
    }

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
</script>