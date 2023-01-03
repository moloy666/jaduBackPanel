<script>
    $('#update_btn').hide();
    $('.txtbox').hide();

    $(document).ready(function() {
        display_user_profile();
        get_permission_request_of_user();

        display_banking_details();

    });

    $('#edit_btn').click(function() {

        $('#edit_btn').hide();
        $('#update_btn').show();
        $('.txtbox').show();
        $('.text-muted').hide();

        let name = $('#txt_name').text();
        let email = $('#txt_email').text();
        let mobile = $('#txt_mobile').text();
        let dob = $('#txt_dob').text();
        let gender = $('#txt_gender').text();

        $('#name').val(name);
        $('#email').val(email);
        $('#mobile').val(mobile);
        $('#dob').val(dob);
        $('#gender').val(gender);
    });

    function display_user_profile() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('Admin/get_user_profile') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {

                var data = JSON.parse(response);
                var str = '';

                $('#name').val(toTitleCase(data[0].name));
                $('#email').val(data[0].email);
                $('#mobile').val(data[0].mobile);
                $('#dob').val(data[0].dob);
                $('#gender').val(data[0].gender);

                $('#txt_name').text(toTitleCase(data[0].name));
                $('#txt_email').text(data[0].email);
                $('#txt_mobile').text(data[0].mobile);
                $('#txt_dob').text(data[0].dob);
                $('#txt_gender').text(data[0].gender);

                $('#view_name').text(toTitleCase(data[0].name));
            }
        });
    }

    $('#update_btn').on('click', function(e) {

        let name = $('#name').val();
        let email = $('#email').val();
        let mobile = $('#mobile').val();
        let dob = $('#dob').val();
        let gender = $('#gender').val();

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
        $.ajax({
            url: "<?= base_url('administrator/update_user_profile') ?>",
            type: "post",
            data: {
                "name": name,
                "email": email,
                "mobile": mobile,
                "dob": dob,
                "gender": gender
            },
            async: false,
            success: function(data) {
                if (data.success) {
                    toast(data.message, "center");
                    display_user_profile();
                    $('#update_btn').hide();
                    $('#edit_btn').show();
                    $('.txtbox').hide();
                    $('.text-muted').show();
                    location.reload(true);
                } else {
                    toast(data.message, "center");
                    $('#update_btn').hide();
                    $('#edit_btn').show();
                    $('.txtbox').hide();
                    $('.text-muted').show();
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
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= base_url('Admin/update_profile_image') ?>",
            data: formData,
            contentType: false,
            processData: false,
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    toast(response.message);
                    location.reload(true);
                } else {
                    toast(response.message);
                }

            }
        })
    });

    function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
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



    $('#btn_password').click(function() {
        let flag = 0;
        let old_pwd = $('#old_password').val();
        let new_pwd = $('#new_password').val();

        let table = $('#specific_table').val();
        let specific_id = $('#specific_id').val();

        // console.log(old_pwd);
        // console.log(new_pwd);
        // console.log(table);
        // console.log();


        if (old_pwd.length == 0) {
            flag = 1;
            toast("Enter Your Old Password", "center");
        }

        if (new_pwd.length == 0) {
            flag = 1;
            toast("Enter a New Password", "center");
        }

        if (new_pwd.length < 6) {
            flag = 1;
            toast("Password must contain atleast 6 characters", "center");
        }

        if (new_pwd.length > 20) {
            flag = 1;
            toast("Password not exceeds more than 20 character", "center");
        }

        if (flag == 0) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Admin/change_user_password') ?>",
                data: {
                    "old_password": old_pwd,
                    "new_password": new_pwd,
                    "specific_id": specific_id,
                    "table": table
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    if (response.success) {
                        toast(response.message, "center");
                        $('#changePassword').modal('hide');
                        $('#old_password').val('');
                        $('#new_password').val('');
                    } else {
                        toast(response.message, "center");
                    }
                }
            });
        }
    });



    $('#btn_new').click(function() {
        var x = document.getElementById("new_password");
        if (x.type === "password") {
            x.type = "text";
            $('#new_img').attr('src', '<?= base_url('assets/images/hide.png') ?>');

        } else {
            x.type = "password";
            $('#new_img').attr('src', '<?= base_url('assets/images/show.png') ?>');
        }
    });

    $('#btn_old').click(function() {
        var x = document.getElementById("old_password");
        if (x.type === "password") {
            x.type = "text";
            $('#old_img').attr('src', '<?= base_url('assets/images/hide.png') ?>');

        } else {
            x.type = "password";
            $('#old_img').attr('src', '<?= base_url('assets/images/show.png') ?>');
        }
    });

    ////////////////////// Access Permissions ///////////////////////

    $.ajax({
        type: "get",
        url: "<?= base_url('administrator/get_permission_list') ?>",
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

    function send_request(e, permission_id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/send_permission_request') ?>",
            data: {
                "id": permission_id,
                "specific_id": $('#specific_id').val(),
                "user_id": $('#user_id').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                get_permission_request_of_user();
            }
        });
    }

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
                // console.log(response);
                if (response.success) {
                    let data = response.data[0];
                    $('#account_number').val(data.account_number);
                    $('#ifsc').val(data.ifsc);
                    $('#bank_name').val(data.bank_name);
                    $('#branch').val(data.branch_name);
                    $('.disabled').attr('disabled', 'disabled');

                } else {
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
                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    get_panel_access_list();

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
                let access='';

                $.each(data, function(i) {

                    access = data[i].slice(7, (data[i].length)).replace('_', ' ')  +' || '+access;

                });
                $('#panel').html(access);

            }
        });
    }
</script>