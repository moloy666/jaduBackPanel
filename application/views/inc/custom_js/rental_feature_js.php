<script>
    $('#rental_page').addClass('active');

    var loadFile = function(event, id) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById(id);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    display_rental_features();
    var apiBaseUrl = '<?= apiBaseUrl ?>';

    function display_rental_features() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_rental_features') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                let details = '';
                user_status = '';
                $.each(data, function(i, data) {

                    details += `<tr>
                        <td>${i+1}</td>
                        <td><image src="${apiBaseUrl}${data.image}" width="60px"></td>
                        <td>${data.title}</td>
                        <td>
                        <div>

                        <button class="hdrbtn mx-2 edit_user access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1"  onclick="edit('${data.uid}' , '${data.image}' , '${data.title}')" data-toggle="tooltip" data-placement="top" title="Edit" disabled>

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

    function edit(id, image, title) {
        $('#edit_id').val(id);
        $('#edit_title').val(title);
        $('#edit_image').attr('src', apiBaseUrl + image);
    }

    $('#table_details').on('click', '.delete_user', function() {
        let id = $(this).attr('data');
        $('#btn_delete_data').click(function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('Admin/delete_rental_features') ?>",
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.success) {
                        toast(data.message, "center");
                        $('#deltmodl').modal('hide');
                        display_rental_features();
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

    $('#add_data_form').submit(function(e) {
        e.preventDefault();
        let form = document.getElementById('add_data_form');
        let formData = new FormData(form);
        let specific_id = '<?= $this->session->userdata(session_admin_specific_id) ?>';

        formData.append('specific_id', specific_id);

        $.ajax({
            type: "POST",
            url: "<?= apiBaseUrl ?>common/addFeatures",
            headers: {
                'x-api-key': '<?= const_x_api_key ?>',
                'platform': 'web',
                'deviceid': ''
            },
            data: formData,
            contentType: false,
            processData: false,
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.status) {
                    $('#addNewUsr1').modal('hide');
                    display_rental_features();
                    toast(response.message, 'center');
                    $('#add_data_form')[0].reset();
                    $('#add_image').attr('src', '<?= base_url('assets/images/add_image.png') ?>');


                } else {
                    toast(response.message, 'center');
                }

            }
        });
    });

    $('#update_form').submit(function(e) {
        e.preventDefault();
        let form = document.getElementById('update_form');
        let formData = new FormData(form);
        let specific_id = '<?= $this->session->userdata(session_admin_specific_id) ?>';

        formData.append('specific_id', specific_id);

        $.ajax({
            type: "POST",
            url: "<?= apiBaseUrl ?>common/editFeatures",
            headers: {
                'x-api-key': '<?= const_x_api_key ?>',
                'platform': 'web',
                'deviceid': ''
            },
            data: formData,
            contentType: false,
            processData: false,
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.status) {
                    $('#edtView1').modal('hide');
                    display_rental_features();
                    toast(response.message, 'center');
                    $('#update_form')[0].reset();
                    $('#edit_image').attr('src', '<?= base_url('assets/images/add_image.png') ?>');


                } else {
                    toast(response.message, 'center');
                }

            }
        });
    });
</script>