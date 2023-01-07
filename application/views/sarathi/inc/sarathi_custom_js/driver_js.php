<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script>
    $('#driver_page').addClass('active');

    function edit(id, name, email, mobile) {
        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_number').val(mobile);
    }

    function get_sarathi_details() {
        // $('.pending_driver').hide();
        let sarathi_id = $('#sarathi_id').val();
        $.ajax({
            type: "post",
            url: "<?= base_url('administrator/get_driver') ?>",
            data: {
                "id": sarathi_id
            },
            success: function(response) {
                if (response.success) {
                    let driver = response.data;
                    let str = '';
                    let user_status = "";
                    $.each(driver, function(i) {
                        if (driver[i].status == "active" || driver[i].status == "ACTIVE")
                            user_status = "checked";
                        else
                            user_status = "";
                        str += `<tr>
                        <td>${i+1}</td>
                        <td class="title">${driver[i].name}</td>
                        <td>${driver[i].email}</td> 
                        <td>${driver[i].mobile}</td>
                        <td>${driver[i].total_km_purchased}</td>
                        <td><label class="switch">
                        <input type="checkbox"  ${user_status} data ="${driver[i].user_id}" onclick="status(this, '${driver[i].user_id}')" class="access_status_change" disabled>
                        <span class="slider round"></span></label>
                        </td>
                        <td>
                            <div>

                            <button class="hdrbtn mx-2 view_user" id="viewbtn"  data-toggle="tooltip" data-placement="left" title="Export as PDF" onclick="download_ride_history('${driver[i].user_id}')">            
                            <img src="<?= base_url('assets/images/pdf.png') ?>" alt="" width="20px" class="mb-3">         
                            </button>

                            <button class="hdrbtn mx-2 view_user" id="viewbtn"  data-toggle="tooltip" data-placement="left" title="Export as CSV" onclick="download_ride_history_csv('${driver[i].user_id}')">            
                            <img src="<?= base_url('assets/images/xls.png') ?>" alt="" width="20px" class="mb-3">         
                            </button>

                            </div>
                            </td>
                        <td>
                        <div>

                        <button class="hdrbtn mx-2 view_user access_update" data-toggle="modal" id =" viewbtn"  data-target="#rechView1"  onclick="fetch_recharge_package('${driver[i].user_id}')" data-toggle="tooltip" data-placement="top" title="Recharge Driver">                        
                          <img src="<?= base_url('assets/images/icon_rupee.png') ?>" alt="" width="18px" class="mb-2">                  
                        </button>

                        
                        <button class="hdrbtn mx-2 delete_user access_delete" data-toggle="modal" data="${driver[i].user_id}" data-target="#deltmodl"  data-toggle="tooltip" data-placement="top" title="Delete" disabled>

                        <svg width="20" height="20" fill="#ef242f" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                                    <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                                </svg>
                        </button> 
                        </div>
                        </td></tr>`;
                    });
                    $('#table_details').html(str);
                    $('#table').dataTable();
                    get_panel_access_list();
                } else {
                    // console.log(response);
                    $('#table').dataTable();

                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function download_ride_history(user_id) {
        var url = `<?= base_url('administrator/driver/ride_history/') ?>${user_id}`;
        window.open(url, '_blank');
    }

    function download_ride_history_csv(user_id) {
        var url = `<?= base_url('administrator/driver/ride_history_csv/') ?>${user_id}`;
        window.open(url, '_blank');
    }

    $('#pending_driver_details').click(function() {
        let sarathi_id = $('#sarathi_id').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_pending_drivers') ?>",
            data: {
                "id": sarathi_id
            },
            error: function(data) {
                // console.log(data);
            },
            success: function(response) {

                let user = response.data;
                let str = '';
                // open pending driver doument page
                $.each(user, function(i) {
                    str += `<tr>
                        <td>${i+1}</td>
                        <td><a href="<?= base_url("sarathi/pending_driver_document/") ?>${user[i].uid}">${user[i].name}</a></td>
                        <td>${user[i].email}</td>
                        <td>${user[i].mobile}</td>
                        </tr>`;
                });
                $('#pending_drivers').html(str);
                $('#pending_table').dataTable();
            }
        });
    });


    function status(state, uid) {
        let sarathi_id = $('#sarathi_id').val();

        if (state.checked == true) {

            $.ajax({
                url: "<?= base_url('administrator/active_driver') ?>",
                type: "post",
                data: {
                    "id": uid,
                    "sarathi_id": sarathi_id
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
                url: "<?= base_url('administrator/deactive_driver') ?>",
                type: "post",
                data: {
                    "id": uid,
                    "sarathi_id": sarathi_id
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

    $('#btn_update_data').click(function() {

        let id = $('#edit_id').val();
        let name = $('#edit_name').val();
        let email = $('#edit_email').val();
        let mobile = $('#edit_number').val();

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
        if (email.indexOf('@') > -1) {
            flag = 0;
        } else {
            flag = 1;
            toast("Invaild Email id", "center");
        }
        if (flag == 0) {
            $.ajax({
                url: "<?= base_url('administrator/update_driver') ?>",
                type: "post",
                data: {
                    "id": id,
                    "name": name,
                    "email": email,
                    "mobile": mobile,
                },
                async: false,
                success: function(data) {
                    toast('update successfull', 'center');
                    $('#update_form')[0].reset();
                    $('#close_edit_modal').click();
                    get_sarathi_details();

                },
                error: function(data) {
                    // console.log(data);

                },
            });
        }
    });

    //delete

    $('#table_details').on('click', '.delete_user', function() {
        let id = $(this).attr('data');
        let sarathi_id = $('#sarathi_id').val();
        console.log(sarathi_id);
        $('#btn_delete_data').click(function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/delete_driver') ?>",
                data: {
                    "id": id,
                    "sarathi_id": sarathi_id
                },
                async: false,
                success: function(data) {
                    if (data.success) {
                        toast(data.message, "center");
                        get_sarathi_details();
                        $('#close_delete_modal').click();
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


    function fetch_recharge_package(user_id) {
        $.ajax({
            type: "get",
            url: "<?=apiBaseUrl?>sarathi/driverPackages",
            headers: {
                'x-api-key': '<?=const_x_api_key?>',
                'platform': 'web',
                'deviceid': ''
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                get_specific_ids(user_id);
                var data = response.packages;
                var details = ' <option value="">Select Recharge Package</option>';
                $.each(data, function(i, data) {
                    details += `<option class="title" value="${data.id}">${data.name}</option>`;
                });
                $('#select_package').html(details);

            }
        });
    }

    function get_specific_ids(user_id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('sarathi/get_specific_id') ?>",
            data: {
                "user_id": user_id
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                var data = response.data;
                $('#driver_specific_id').val(data.driver_id);
                $('#sarathi_specific_id').val(data.sarathi_id);
                $('#recharge_driver_name').val(data.driver_name);
            }
        });
    }

    $('#btn_recharge').click(function() {
        let driver_id = $('#driver_specific_id').val();
        let sarathi_id = $('#sarathi_specific_id').val();
        let package_id = $('#select_package').val();
        $.ajax({
            type: "POST",
            url: `<?=apiBaseUrl?>sarathi/users/${sarathi_id}/recharge/driver/${driver_id}`,
            data: {
                "selectedPackageId": package_id,
                "paymentMode": "cash",
            },
            headers: {
                'x-api-key': '<?=const_x_api_key?>',
                'platform': 'web',
                'deviceid': ''
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.status) {
                    get_sarathi_km_purchased(sarathi_id);

                    $('#rechView1').modal('hide');
                    $('.loaderbg').show();
                    setTimeout(() => {
                        $('.loaderbg').hide();
                    }, 3000);
                    get_sarathi_details();
                } else {
                    toast('Something went wrong');
                }
            }
        });
    });

    function get_sarathi_km_purchased(sarathi_id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('sarathi/get_sarathi_km_purchased') ?>",
            data: {
                "sarathi_id": sarathi_id
            },
            error: function(response) {
                // console.log(response);
            },
            success: function(response) {
                var data = response.data;
                // console.log(data);
                $('#sarathi_km_purchased').html(data);
            }
        });
    }

    function get_panel_access_list() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_SARATHI . '/get_panel_access_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let permission = response.data.permission;
                let data = permission.split(",");
                $.each(data, function(i) {
                    $('.' + data[i]).removeAttr('disabled');
                    // console.log(data[i]);
                });
            }
        });
    }
</script>