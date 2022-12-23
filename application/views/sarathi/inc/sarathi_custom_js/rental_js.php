<script>
    $('#rental_page').addClass('active');

    display_rental_slabs();

    function display_rental_slabs() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_rental_slabs') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                let details = '';
                user_status = '';
                $.each(data, function(i, data) {
                    if (data.status == "active" || data.status == "ACTIVE")
                        user_status = "checked";
                    else
                        user_status = "";

                    details += `<tr>
                        <td>${i+1}</td>
                        <td>${data.hr} hr</td>
                        <td>${data.km} km</td>
                     
                        <td><label class="switch">
                        <input type="checkbox"  ${user_status} class="access_status_change" data ="${data.uid}" onclick="status(this, '${data.uid}')" disabled>
                        <span class="slider round"></span></label>
                        </td>
                        <td>
                        <div>

                        <button class="hdrbtn mx-2 edit_user access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1"  onclick="edit('${data.uid}' , '${data.hr}' , '${data.km}')" data-toggle="tooltip" data-placement="top" title="Edit" disabled>

                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        </button>

                        <button class="hdrbtn mx-2 delete_user access_delete" data-toggle="modal" data="${data.uid}" data-target="#deltmodl" data-toggle="tooltip" data-placement="top" title="Delete" disabled>

                        <svg width="20" height="20" fill="#ef242f" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                                    <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                                </svg>
                        </button> 
                        </div>
                        </td>
                    </tr>`;
                });

                $('#table_details').html(details);
                $('#table').dataTable();
                get_panel_access_list();
            }
        });
    }

    function get_panel_access_list() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_SARATHI.'/get_panel_access_list') ?>",
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

    function edit(id, hour, km) {
        $('#edit_id').val(id);
        $('#edit_hour').val(hour);
        $('#edit_km').val(km);
    }

    $('#btn_update_data').on('click', function() {

        $.ajax({
            url: "<?= base_url('Admin/update_rental_slab') ?>",
            type: "post",
            data: {
                "id": $('#edit_id').val(),
                "hour": $('#edit_hour').val(),
                "km": $('#edit_km').val()
            },
            success: function(data) {
                if (data.success) {
                    toast(data.message, "center");
                    display_rental_slabs();
                    $('#edtView1').modal('hide');


                } else {
                    toast(data.message, "center");
                }

            },
            error: function(data) {
                // console.log(data);
            },
        });

    });

    $('#btn_add_data').click(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/add_rental_slabs') ?>",
            data: {
                "hour": $('#hour').val(),
                "km": $('#km').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    toast(response.message, "center");
                    $('#addNewUsr1').modal('hide');
                    display_rental_slabs();
                    $('#hour').val('');
                    $('#km').val('');
                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    function status(state, uid) {
        if (state.checked == true) {
            $.ajax({
                url: "<?= base_url('administrator/active_slab_status') ?>",
                type: "post",
                data: {
                    "id": uid
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
                    alert(JSON.stringify(data));
                }
            });
        } else {
            console.log('false');
            $.ajax({
                url: "<?= base_url('administrator/deactive_slab_status') ?>",
                type: "post",
                data: {
                    "id": uid
                },
                error: function(data) {
                    alert(JSON.stringify(data));
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

    $('#table_details').on('click', '.delete_user', function() {
        let id = $(this).attr('data');
        $('#btn_delete_data').click(function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('Admin/delete_slab_status') ?>",
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.success) {
                        toast(data.message, "center");
                        $('#deltmodl').modal('hide');
                        display_rental_slabs();
                    } else {
                        toast(data.message, "center");
                    }

                },
                error: function() {
                    alert(JSON.stringify(data));
                }
            });

        });
    });
</script>