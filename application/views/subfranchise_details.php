<style>
    .title {
        text-transform: uppercase;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color:transparent;">
                            <li class="breadcrumb-item"><a href="<?= base_url('administrator/sub_franchise') ?>">Sub Franchise</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Saathi</li>
                        </ol>
                    </nav>
                    <h5 class="text-primary ml-3" id="sarathi_name">
                        <?php
                        foreach ($subfranchise_data as $data) {
                            echo strtoupper($data->name);
                            $subfranchise_id = $data->subfranchise_id;
                        }
                        ?>
                    </h5>
                </div>
                <input type="hidden" value="<?= $subfranchise_id ?>" id="subfranchise_id">
                <input type="hidden" value="<?= $user_id ?>" id="user_id">
            </div>

            <div class="card  my-2 p-3">
                <div class="table-responsive">
                    <h5 class="text-danger mb-4">Saathi List</h5>
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Refferal Code</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card my-2 p-3">
                <div class="table-responsive">
                    <h5 class="text-danger mb-4">Recharge History</h5>
                    <table class="table table-bordered" id="table_recharge_history">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Recharge Type</th>
                                <th>Price</th>
                                <th>Purchased KM</th>
                                <th>Description</th>
                                <th>Recharge Note</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="recharge_history">

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="mt-4" id="accordionExample" style="cursor:pointer">
                <div class="card">
                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong class="text-primary">Access List</strong>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Permission</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center" id="table_access">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT-->

    </div>
    </div>
    <div class="modal fade delemodel" id="deltmodl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content p-4 text-center">
                <h5 class="mb-4">Are you sure want to
                    delete this user permanently ?</h5>
                <div class="d-flex align-items-center justify-content-center">
                    <button class="btn-secondary btn" data-dismiss="modal" id="close_delete_modal">No</button>
                    <button class="btn-success btn ml-3" id="btn_delete_data">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->

    <!-- Edit sarathi modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Sarathi List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" value="" placeholder="Your Id" id="edit_id">

                                    <input class="form-control" type="text" value="Ramesh janha" placeholder="Your Name" id="edit_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="987-654-3210" placeholder="Your Number" id="edit_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="rameshj123@gmail.com" placeholder="Your Email" id="edit_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="edit_access_list" multiple>
                                        <option value="0">Select Management </option>
                                        <option value="Role Management ">Role Management </option>
                                        <option value="0">Sub Admin Management</option>
                                        <option value="0">Franchise Management</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" id="edit_panel_access_list" multiple>
                                        <option value="0">Select Management </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn_update_data">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#sub_franchise_page').addClass('active');

        get_subfranchise_details();
        display_panel_access_list();
        display_request_permission_of_user();

        function display_request_permission_of_user() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/display_request_permission_of_admin') ?>",
                data: {
                    "user_id": $('#user_id').val()
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    // console.log(response);
                    let data = response.data;
                    let details = '';
                    let allow_btn = '';
                    let allow_btn_status = '';
                    let deny_btn_status = '';
                    $.each(data, function(i, data) {
                        if (data.status == 'ACTIVE') {
                            allow_btn = 'btn-success';
                            allow_btn_status = 'disabled';
                            deny_btn_status = '';
                        } else {
                            allow_btn = 'btn-primary';
                            allow_btn_status = '';
                            deny_btn_status = 'disabled';

                        }
                        details += `
                        <tr>
                        <td class="text-center">${i + 1} </td>
                        <td class="text-center title">${data.name}</td>
                        <td class="text-center" id="status_${data.request_id}">${data.status}</td>
                        <td class="text-center">
                            <div class="flex justify-content-center">

                                <button class="btn btn-primary mr-2 ${allow_btn}" id="allow_${data.request_id}" onclick="allow_request(this, '${data.user_id}', '${data.request_id}')" ${allow_btn_status}>Allow</button>

                                <button class="btn btn-danger" id="deny_${data.request_id}" onclick="deny_request(this, '${data.user_id}' , '${data.request_id}')">Deny</button>
                            </div>
                        </td>
                    </tr>
                        `;
                    });

                    $('#table_access').html(details);
                }
            });
        }


        function allow_request(e, user_id, request_id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/allow_permission_request') ?>",
                data: {
                    "user_id": user_id,
                    "request_id": request_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    if (response.success) {
                        toast(response.message, "center");
                        $('#allow_' + request_id).attr('disabled', 'disabled');
                        $('#allow_' + request_id).addClass('btn-success');
                        $('#status_' + request_id).text('ACTIVE');
                    } else {
                        toast(response.message, "center");
                    }
                }
            });
        }

        function deny_request(e, user_id, request_id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/deny_permission_request') ?>",
                data: {
                    "user_id": user_id,
                    "request_id": request_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    if (response.success) {
                        toast(response.message, "center");
                        $('#deny_' + user_id).attr('disabled', 'disabled');
                        $('#allow_' + user_id).removeAttr('disabled');
                        $('#status_' + user_id).text('DEACTIVE');

                        display_request_permission_of_user();
                    } else {
                        toast(response.message, "center");
                    }
                }
            });
        }


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
                    // console.log(response);
                    let data = response.data;
                    let details = '';
                    $.each(data, function(i, data) {

                        details += `<option  ${data.status} value="${data.uid}"  class="title">${data.name}</option> `;
                    });

                    $('#edit_access_list').html(details);
                    $('#edit_access_list').multiselect();

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
                        <td class='title'>${sarathi[i].name}</td>
                        <td>${sarathi[i].email}</td>
                        <td>${sarathi[i].mobile}</td>
                        <td>${sarathi[i].refferal_code}</td>
                        <td><label class="switch">
                        <input type="checkbox"  ${user_status} onclick="status(this, '${sarathi[i].user_id}')" class="access_status_change" disabled>
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

                    }
                },
                error: function(data) {
                    // console.log(data);
                }
            });
        }

        function status(state, uid) {

            if (state.checked == true) {

                $.ajax({
                    url: "<?= base_url('administrator/active_sarathi') ?>",
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
                    url: "<?= base_url('administrator/deactive_sarathi') ?>",
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
            $('#btn_delete_data').click(function() {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('administrator/delete_sarathi') ?>",
                    data: {
                        "id": id
                    },
                    async: false,
                    success: function(data) {
                        toast("Data deleted successfully", "center");
                        get_subfranchise_details();
                        $('#close_delete_modal').click();
                    },
                    error: function() {
                        console.log(data);
                    }
                });
            });
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

                        $('.' + data[i]).removeAttr('disabled');
                        // console.log(data[i]);
                    });
                }
            });
        }


        $.ajax({
            type: "post",
            url: "<?= base_url('admin/recharge_history_sf') ?>",
            data: {
                "id": $('#user_id').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                let recharge_details = response.data;
                let details = ''
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

                $("#table_recharge_history").dataTable();
            }
        });
    </script>