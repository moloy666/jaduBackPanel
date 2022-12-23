<script>
    $('#subfranchise_page').addClass('active');
    get_subfranchise_details();
    display_panel_access_list();

    function display_panel_access_list() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_panel_access_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                let details = '';
                $.each(data, function(i, data) {
                    details += `
              <option value="${data.uid}">${data.name}</option>
            `;
                });
                $('#edit_panel_access_list').html(details);
            }
        });
    }

    function edit(id, name, email, mobile) {
        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_number').val(mobile);

        get_user_permission_access_list(id);
        get_user_panel_access(id);

    }

    function get_user_panel_access(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_user_panel_access') ?>",
            data: {
                "id": id,
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                let permission = response.data.permission;
                let data = permission.split(",");
                // console.log(data);
                $('#edit_panel_access_list').val('');
                $('#edit_panel_access_list').val(data);
            }
        });
    }

    function get_user_permission_access_list(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_user_permission_access_list') ?>",
            data: {
                "id": id,
                'user_type': "sarathi"
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                let data = response.data;
                let details = '';
                $.each(data, function(i, data) {

                    details += `<option  ${data.status} value="${data.uid}"  class="title">${data.name}</option> `;
                });

                $('#edit_access_list').html(details);
                // $('#edit_access_list').multiselect(); 

                $('#edit_access_list_input').attr('placeholder', 'Select Management');
            }
        });
    }


    function get_subfranchise_details() {

        var subfranchise_id = $('#subfranchise_id').val();

        $.ajax({
            type: "post",
            url: "<?= base_url('administrator/get_sarathi') ?>",
            data: {
                'subfranchise_id': subfranchise_id
            },
            success: function(response) {
                if (response.success) {

                    let sarathi = response.data;
                    let str = '';
                    let user_status = "";
                    $.each(sarathi, function(i) {
                        if (sarathi[i].status == "active" || sarathi[i].status == "ACTIVE")
                            user_status = "checked";
                        else
                            user_status = "";
                        str += `<tr>
                <td>${i+1}</td>
                <td>${sarathi[i].name}</td>
                <td>${sarathi[i].email}</td>
                <td>${sarathi[i].mobile}</td>
                <td><label class="switch">
                <input type="checkbox"  ${user_status} class="access_status_change" data ="${sarathi[i].user_id}" onclick="status(this, '${sarathi[i].user_id}')" disabled>
                <span class="slider round"></span></label>
                </td>
                <td>
                <div>
                <button class="hdrbtn mx-2 edit_user access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1"  onclick="edit('${sarathi[i].user_id}' , '${sarathi[i].name}' , '${sarathi[i].email}' , '${sarathi[i].mobile}')" disabled>

                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                </button>

                <button class="hdrbtn mx-2 delete_user access_delete" data-toggle="modal" data="${sarathi[i].user_id}" data-target="#deltmodl" disabled>
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
                    get_panel_access_list();

                }
            },
            error: function(data) {
                // console.log(data);
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

    function status(state, uid) {
        let table = $('#specific_table').val();
        let specific_id = $('#specific_id').val();

        if (state.checked == true) {

            $.ajax({
                url: "<?= base_url('administrator/active_sarathi') ?>",
                type: "post",
                data: {
                    "id": uid,
                    "specific_id": specific_id,
                    "table": table
                },
                success: function(data) {
                    if (data.success) {
                        state.removeAttribute("checked");
                        toast(data.message, 'center');
                    } else {
                        toast(data.message, 'center');
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {

            $.ajax({
                url: "<?= base_url('administrator/deactive_sarathi') ?>",
                type: "post",
                data: {
                    "id": uid,
                    "specific_id": specific_id,
                    "table": table
                },
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {
                    if (data.success) {
                        toast(data.message, 'center');
                    } else {
                        toast(data.message, 'center');
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

        let table = $('#specific_table').val();
        let specific_id = $('#specific_id').val();

        let permission = $('#edit_access_list').val();
        let panel_list = $('#edit_panel_access_list').val();

        let flag = 0;


        if (email.indexOf('@') > -1) {
            flag = 0;
        } else {
            flag = 1;
            toast("Enter a valid email id", "center");
        }

        if (permission == '') {
            flag = 1;
            toast("Select Management", "center");
        }

        if (panel_list == '') {
            flag = 1;
            toast("Select Panel Access", "center");
        }
        if (flag == 0) {
            $.ajax({
                url: "<?= base_url('administrator/update_sarathi') ?>",
                type: "post",
                data: {
                    "id": id,
                    "name": name,
                    "email": email,
                    "mobile": mobile,
                    "specific_id": specific_id,
                    "table": table,
                    "permission": permission,
                    "panel_list": panel_list

                },
                async: false,
                success: function(data) {
                    if (data.success) {
                        toast(data.message, 'center');
                        $('#update_form')[0].reset();
                        $('#close_edit_modal').click();
                        get_subfranchise_details();
                    } else {
                        toast(data.message, 'center');
                    }

                },
                error: function(data) {
                    console.log(data);
                },
            });
        }
    });

    //delete

    $('#table_details').on('click', '.delete_user', function() {
        let id = $(this).attr('data');
        let table = $('#specific_table').val();
        let specific_id = $('#specific_id').val();
        $('#btn_delete_data').click(function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/delete_sarathi') ?>",
                data: {
                    "id": id,
                    "specific_id": specific_id,
                    "table": table
                },
                async: false,
                success: function(data) {
                    if (data.success) {
                        toast(data.message, "center");
                        get_subfranchise_details();
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
</script>