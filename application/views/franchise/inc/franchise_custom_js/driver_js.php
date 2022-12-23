<script>
    var table = $('#specific_table').val();

    if (table == 'franchise') {
        get_subfranchise_ids();
    } else {
        let subfranchise_id = $('#specific_id').val();
        get_sarathi_id(subfranchise_id);
    }

    function get_subfranchise_ids() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('franchise/get_subfranchise_id') ?>",
            data: {
                "id": $('#specific_id').val(),
            },
            error: function(response) {
                console.log(response)
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                $.each(data, function(i, data) {
                    get_sarathi_id(data.uid);
                });
            }
        });
    }


    function get_sarathi_id(uid) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('franchise/get_sarathi_id') ?>",
            data: {
                "id": uid,
            },
            error: function(response) {
                console.log(response)
            },
            success: function(response) {
                let data = response.data;
                $.each(data, function(i, data) {
                    get_driver_ids(data.uid);
                    // console.log(data.uid);
                });
            }
        });
    }

    function get_driver_ids(sarathi_id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('admin/get_driver_ids_by_sarathi_id') ?>",
            data: {
                'id': sarathi_id
            },
            success: function(response) {

                let data = response.data;
                $.each(data, function(i, data) {
                    get_driver_details_by_user_id(data.user_id);
                    // console.log(data.user_id);

                });
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function get_driver_details_by_user_id(user_id) {
        console.log(user_id);
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/get_driver_details_by_user_id') ?>",
            data: {
                'id': user_id
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
            }
        });
    }


    function get_panel_access_list() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_FRANCHISE . '/get_panel_access_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                let permission = response.data.permission;
                let data = permission.split(",");
                $.each(data, function(i) {
                    $('.' + data[i]).removeAttr('disabled');
                    // console.log(data[i]);
                });
            }
        });
    }


    function download_qrCode(driver_id) {
        location.href = `<?= apiBaseUrl ?>/Qrcode?driverId=${driver_id}`;
        window.open(url, '_blank');

    }

    function download_ride_history(user_id) {
        var url = `<?= base_url('administrator/driver/ride_history/') ?>${user_id}`;
        window.open(url, '_blank');
    }

    function download_ride_history_csv(user_id) {
        var url = `<?= base_url('administrator/driver/ride_history_csv/') ?>${user_id}`;
        window.open(url, '_blank');
    }

    function edit_driver(id, name, email, mobile) {
        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_number').val(mobile);
    }

    function status(state, user_id) {
        let table = $('#specific_table').val();
        let specific_id = $('#specific_id').val();
        if (state.checked == true) {
            $.ajax({
                url: "<?= base_url($this->session->userdata(session_franchise_table) . '/active_driver') ?>",
                type: "post",
                data: {
                    "id": user_id,
                    "specific_id": specific_id,
                    "table": table
                },
                success: function(data) {
                    if (data.success) {
                        state.removeAttribute("checked");
                        toast(data.message, "center");
                    } else {
                        toast(data.message, "center");
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {
            $.ajax({
                url: "<?= base_url($this->session->userdata(session_franchise_table) . '/deactive_driver') ?>",
                type: "post",
                data: {
                    "id": user_id,
                    "specific_id": specific_id,
                    "table": table
                },
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {
                    if (data.success) {
                        toast(data.message, "center");
                    } else {
                        toast(data.message, "center");
                    }
                }
            });
        }
    }

    ///////////////// update /////////////////////

    $('#btn_update_data').on('click', function() {
        let id = $('#edit_id').val();
        let name = $('#edit_name').val();
        let email = $('#edit_email').val();
        let mobile = $('#edit_number').val();

        let table = $('#specific_table').val();
        let specific_id = $('#specific_id').val();

        let flag = 0;


        if (email.indexOf('@') > -1) {
            flag = 0;
        } else {
            flag = 1;
            toast("Enter a valid email id", "center");
        }

        if (flag == 0) {
            $.ajax({
                url: "<?= base_url($this->session->userdata(session_franchise_table) . '/update_driver') ?>",
                type: "post",
                data: {
                    "id": id,
                    "name": name,
                    "email": email,
                    "mobile": mobile,
                    "specific_id": specific_id,
                    "table": table
                },
                async: false,
                success: function(data) {
                    if (data.success) {
                        toast(data.message, "center");
                        $('#update_form')[0].reset();
                        $('#close_edit_modal').click();
                        get_driver_details();
                    } else {
                        toast(data.message, "center");
                    }
                },
                error: function(data) {
                    // console.log(data);
                },
            });
        } else {
            // toast("Fill all details");
        }
    });

    // add new user
    $('#btn_add_data').on('click', function() {
        let name = $('#add_name').val();
        let email = $('#add_email').val();
        let mobile = $('#add_mobile').val();
        let flag = 0;
        if (name.length < 3) {
            flag = 1;
            toast("Name should contain atleast three letters", "center");
        }
        if (mobile.length != 10) {
            flag = 1;
            toast("Mobile number must contain 10 digit", "center");
        }
        if (email == '') {
            flag = 1;
            toast("Email id is required", "center");
        }
        if (flag == 0) {
            $.ajax({
                url: "<?= base_url('administrator/add_driver') ?>",
                type: "post",
                data: {
                    "name": name,
                    "email": email,
                    "mobile": mobile,
                },
                async: false,
                success: function(data) {
                    toast("Data added successfully", "center");
                    $('#add_data_form')[0].reset();
                    $('#close_add_modal').click();
                    get_driver_details();
                },
                error: function(data) {
                    console.log(JSON.stringify(data));
                },
            });
        }
    });
    //delete
    $('#table_details').on('click', '.delete_driver', function() {
        let id = $(this).attr('data');
        $('#btn_delete_data').click(function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('Admin/delete_driver') ?>",
                data: {
                    "id": id
                },
                success: function(data) {
                    if (data.success) {
                        toast(data.message, "center");
                        $('#close_delete_modal').click()
                        get_driver_details();
                    } else {
                        toast(data.message, "center");
                    }
                },
                error: function() {
                    console.log(data);
                }
            });
        });
    });

    function view_bank_details(user_id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/display_bank_details') ?>",
            data: {
                "id": user_id
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    let data = response.data[0];

                    $('.bank-modal-title').html("Banking Details of " + data.account_holder_name);

                    $('#acc_name').val(data.account_holder_name);
                    $('#acc_number').val(data.account_number);
                    $('#ifsc').val(data.ifsc);
                    $('#bank_name').val(data.bank_name);
                    $('#branch_name').val(data.branch_name);

                } else {
                    $('.bank-modal-title').html("Banking Details Not Found");
                    $('#acc_name').val('');
                    $('#acc_number').val('');
                    $('#ifsc').val('');
                    $('#bank_name').val('');
                    $('#branch_name').val('');
                }
            }
        });
    }
</script>