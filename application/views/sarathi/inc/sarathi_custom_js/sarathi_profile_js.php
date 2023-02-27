<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script>
    $('#update_btn').hide();
    $('.edit_details').hide();

    display_sarathi_profile();
    display_banking_details();

    $('#edit_btn').click(function() {
        $('#edit_btn').hide();
        $('#update_btn').show();
        $('.edit_details').show();
        $('.text-muted').hide();
    });


    function display_sarathi_profile() {
        $.ajax({
            type: "GET",
            url: "<?= base_url(WEB_PORTAL_SARATHI . '/manage_sarathi_profile') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                var data = response.data;
                var str = '';

                $('#user_id').val(data[0].uid);
                $('#name').val(data[0].name).addClass('title');;
                $('#email').val(data[0].email);
                $('#mobile').val(data[0].mobile);
                $('#dob').val(data[0].dob);
                $('#gender').val(data[0].gender);

                $('#txt_name').text(data[0].name).addClass('title');;
                $('#txt_email').text(data[0].email);
                $('#txt_mobile').text(data[0].mobile);
                $('#txt_dob').text(data[0].dob);
                $('#txt_gender').text(data[0].gender);

                $('#view_name').text(data[0].name).addClass('title');
            }
        });
    }

    $('#update_btn').on('click', function(e) {

        let id = $('#user_id').val();
        let name = $('#name').val();
        // let email = $('#email').val();
        // let mobile = $('#mobile').val();
        let dob = $('#dob').val();
        let gender = $('#gender').val();

        if (name.length < 3) {
            flag = 1;
            toast("Name should contain atleast three letters", "center");
        }
        // if (mobile.length != 10) {
        //     flag = 1;
        //     toast("Mobile number must contain 10 digit", "center");
        // }
        // if (email == '') {
        //     flag = 1;
        //     toast("Email id is required", "center");
        // }
        $.ajax({
            url: "<?= base_url('sarathi/update_user_profile') ?>",
            type: "post",
            data: {
                "id": id,
                "name": name,
                // "email": email,
                // "mobile": mobile,
                "dob": dob,
                "gender": gender
            },
            async: false,
            success: function(data) {
                if (data.success) {
                    toast(data.message, "center");

                    display_sarathi_profile();
                    $('#update_btn').hide();
                    $('#edit_btn').show();
                    $('.edit_details').hide();
                    $('.text-muted').show();

                    location.reload(true);
                } else {
                    toast(data.message, "center");
                }
            },
            error: function(data) {
                console.log(data);
            },
        });
    });

    $('#form_image').submit(function(e) {
        e.preventDefault();
        let form = document.getElementById('form_image');
        let formData = new FormData(form);
        let user_id = $('#user_id').val();

        // url: "https://jaduridedev.v-xplore.com/service/updateProfilePicture",

        formData.append('user_id', user_id);
        $.ajax({
            type: "post",
            url: "<?= apiBaseUrl ?>service/updateProfilePicture",
            headers: {
                'x-api-key': '4c174057-0a6b-4fe8-98df-5699fac7c51a',
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
                    toast(response.message, "center");
                    let image_path = response.isSubmitted;
                    change_image_session(image_path);
                    $('#btn_update_image').hide();
                } else {
                    toast(response.message, "center");
                }
                // console.log(response);
            }
        })
    });

    function change_image_session(image_path) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('sarathi/change_image_session') ?>",
            data: {
                "path": image_path
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                location.reload(true);
            }
        });
    }

    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        $('#btn_update_image').show();
    };

    ////////////////////// Access Permissions ///////////////////////

    $.ajax({
        type: "POST",
        url: "<?= base_url('administrator/get_permission_list') ?>",
        data: {
            'user_type': '<?= user_type_sarathi ?>'
        },
        error: function(response) {
            console.log(response);
        },
        success: function(response) {
            // console.log(response);
            let data = response.data;
            let details = '';
            $.each(data, function(i, data) {
                details += `
                <tr>
                    <td class="text-center">${i+1}</td>
                    <td class="text-center title">${data.name}</td>
                    <td class="text-center title" id="status_${data.uid}">DEACTIVE</td>
                    <td class="text-center">
                        <button class="btn btn-primary w-50" id="request_${data.uid}" onclick="send_request(this, '${data.uid}')">Send</button>
                    </td>
                  </tr>
                `;
            });
            $('#permission_list').html(details);
            get_permission_request_of_user();
        }
    });


    function get_permission_request_of_user() {
        $.ajax({
            type: "post",
            url: "<?= base_url('administrator/get_permission_request_of_user') ?>",
            data: {
                "specific_id": $('#specific_id').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                $.each(data, function(i, data) {
                    $('#request_' + data.permission_id).attr('disabled', 'disabled');
                    $('#status_' + data.permission_id).html(data.status);
                    if (data.status == "ACTIVE") {
                        $('#request_' + data.permission_id).text('Allowed').addClass('btn-success');
                    }

                });
            }
        });
    }

    function send_request(element, permission_id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/send_permission_request') ?>",
            data: {
                "id": permission_id,
                "user_id": $('#user_id').val(),
                "specific_id": $('#specific_id').val(),
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                get_permission_request_of_user();
            }
        });
    }

    //////////////// View Bank Details ////////////////////


    function display_banking_details() {
        $.ajax({
            type: "post",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/display_bank_details') ?>",
            data: {
                "id": $('#user_id').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    let data = response.data[0];
                    $('#account_number').val(data.account_number);
                    $('#ifsc').val(data.ifsc);
                    $('#bank_name').val(data.bank_name);
                    $('#branch').val(data.branch_name);
                    $('.disabled').attr('disabled', 'disabled');

                }else{
                    $('#message').text('Not Available');
                    $('.disabled').attr('disabled', 'disabled');
                }

            }
        });
    }

    $('#btn_edit_bank_details').click(function(response) {
        $('.disabled').removeAttr('disabled');
        $('#btn_update_bank_details').show();
        $('#btn_edit_bank_details').hide();
    });

    $('#btn_update_bank_details').click(function(response) {
        let account_number = $('#account_number').val();
        let ifsc = $('#ifsc').val();
        let bank_name = $('#bank_name').val();
        let branch = $('#branch').val();
        let user_id = $('#user_id').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/save_bank_details') ?>",
            data: {
                "account_number": account_number,
                "ifsc": ifsc,
                "bank_name": bank_name,
                "branch": branch,
                "user_id": user_id,
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    $('.disabled').attr('disabled', 'disabled');
                    $('#btn_update_bank_details').hide();
                    $('#btn_edit_bank_details').show();
                    toast(response.message, "center");
                    $('#message').text('');
                }
                else{
                    toast(response.message, "center");
                }
            }
        });
    });

    get_panel_access_list();

    function get_panel_access_list() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_SARATHI.'/get_panel_access_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                let permission = response.data.permission;
                let data = permission.split(",");
                let access='';

                $.each(data, function(i) {
                    // text.slice(0, 5);

                    access = data[i].slice(7, (data[i].length)).replace('_', ' ')  +' || '+access;
                });
                $('#panel').html(access);
            }
        });
    }


</script>