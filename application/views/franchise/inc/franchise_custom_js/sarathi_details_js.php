<script>
    $('#sarathi_page').addClass('active');
    get_sarathi_all_details();

    function edit(id, name, email, mobile) {
        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_number').val(mobile);
    }

    function get_sarathi_all_details() {

        let sarathi_id = $('#sarathi_id').val();
        $.ajax({
            type: "post",
            url: "<?= base_url('administrator/get_driver') ?>",
            data: {
                "id": sarathi_id
            },
            success: function(response) {
                console.log(response);
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
                        <td><label class="switch">
                        <input type="checkbox"  ${user_status} class="access_status_change" data ="${driver[i].user_id}" onclick="status(this, '${driver[i].user_id}')" disabled>
                        <span class="slider round"></span></label>
                        </td>
                        <td>
                        <div>

                        <button class="hdrbtn mx-2 view_user " data-toggle="modal" id=" viewbtn"  data-target="#bnkView1"  onclick="view_bank_details('${driver[i].user_id}')" data-toggle="tooltip" data-placement="top" title="Bank Details">                        
                          <img src="<?= base_url('assets/images/details-icon.svg') ?>" alt="" width="16px" class="mb-2">                  
                        </button>

                        <button class="hdrbtn mx-2 edit_user access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1"  onclick="edit('${driver[i].user_id}' , '${driver[i].name}' , '${driver[i].email}' , '${driver[i].mobile}')" disabled>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        </button>
                        <button class="hdrbtn mx-2 delete_user access_delete" data-toggle="modal" data="${driver[i].user_id}" data-target="#deltmodl" disabled>
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
                    $('#table').dataTable();
                    get_panel_access_list();

                }
            },
            error: function(response) {
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

    $('#pending_driver_details').click(function() {

        let sarathi_id = $('#sarathi_id').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_pending_drivers') ?>",
            data: {
                "id": sarathi_id
            },
            error: function(data) {
                console.log(data);
            },
            success: function(response) {
                if (response.success) {
                    var user = response.data;
                    let str = '';
                    // open pending driver doument page
                    $.each(user, function(i) {
                        str += `<tr>
                        <td>${i+1}</td>
                        <td class="title"><a href="<?= base_url("administrator/pending_driver_document/") ?>${user[i].uid}">${user[i].name}</a></td>
                        <td>${user[i].email}</td>
                        <td>${user[i].mobile}</td>
                        </tr>`;
                    });
                    $('#pending_drivers').html(str);
                    $('.table').dataTable();
                } else {
                    $('.table').dataTable();
                }

            }
        });
    });


    function status(state, uid) {

        if (state.checked == true) {

            $.ajax({
                url: "<?= base_url('administrator/active_driver') ?>",
                type: "post",
                data: {
                    "id": uid
                },
                success: function(data) {
                    state.removeAttribute("checked");
                    toast("Active this user successfully", "center");
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
                    "id": uid
                },
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {
                    toast("De-active this user successfully", "center");
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


        if (email.indexOf('@') > -1) {
            flag = 0;
        } else {
            flag = 1;
            toast("Enter a valid email id", "center");
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
                    if (data.success) {
                        toast(data.message, 'center');
                        $('#update_form')[0].reset();
                        $('#close_edit_modal').click();
                        get_sarathi_all_details();
                    } else {
                        toast(data.message, 'center');

                    }
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
        $('#btn_delete_data').click(function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/delete_driver') ?>",
                data: {
                    "id": id
                },
                async: false,
                success: function(data) {
                    toast("Data deleted successfully", "center");
                    get_sarathi_all_details();
                    $('#close_delete_modal').click();
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
                console.log(response);
                if (response.success) {
                    let data = response.data[0];

                    $('.bank-modal-title').html("Banking Details");

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

    $(document).ready(function() {
        var sarathi_id = $('#sarathi_id').val();
        $.ajax({
            type: "get",
            url: `<?= apiBaseUrl ?>sarathi/users/${sarathi_id}/recharge/history`,
            headers: {
                'x-api-key': '<?= const_x_api_key ?>',
                'platform': 'web',
                'deviceid': ''
            },

            success: function(response) {
                console.log(response);
                let recharge_details = response.data;
                let recharge_history = '';
                $.each(recharge_details, function(i) {

                    recharge_history += `<tr>
                        <td>${i+1}</td>
                        <td>${recharge_details[i].rechargeType}</td>
                        <td>${recharge_details[i].price}</td>                      
                        <td>${recharge_details[i].purchesedKm}</td>                      
                        <td>${recharge_details[i].description}</td>    
                        <td>${recharge_details[i].rechargeNote}</td>                      
                        <td>${recharge_details[i].date}</td>                                        
                        </tr>`;
                });
                $('#recharge_history').html(recharge_history);
                $("#recharge_table").dataTable();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>