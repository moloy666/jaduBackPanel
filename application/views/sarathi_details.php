<style>
    .title {
        text-transform: uppercase;
    }
</style>

<body onload="get_sarathi_all_details()">
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color:transparent;">
                            <li class="breadcrumb-item"><a href="<?= base_url('administrator/saathi') ?>">Saathi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Drivers</li>
                        </ol>
                    </nav>
                    <h5 class="text-primary ml-3" id="sarathi_name">
                        <?php
                        foreach ($sarathi_data as $data) {
                            echo strtoupper($data->name);
                            $sarathi_id = $data->sarathi_id;
                        }
                        ?>
                    </h5>

                    <strong class="text-primary ml-3">
                        <?php
                        foreach ($sarathi_data as $data) {
                            echo ($data->mobile);
                        }
                        ?>
                    </strong>
                    <br>
                    <strong class="text-primary ml-3">
                        <?php
                        foreach ($sarathi_data as $data) {
                            echo ($data->email);
                        }
                        ?>
                    </strong>

                </div>

                <input type="hidden" value="<?= $sarathi_id ?>" id="sarathi_id">
                <input type="hidden" value="<?= $user_id ?>" id="user_id">

            </div>


            <div align="right">
                <button type="button" class="btn bgred ml-3 btnround mb-3 access_update" id="pending_driver_details" data-toggle="collapse" href="#collapseExample" aria-expanded="true" aria-controls="collapseExample" disabled>
                    Driver Request Pending : <?= $driver_pending; ?>
                </button>
            </div>

            <div class="collapse" id="collapseExample">
                <div class="card mb-3 p-3">
                    <div class="table-responsive">
                        <h5 class="text-warning mb-2">Pending Driver List</h5>
                        <table class="table table-bordered" id="pending_table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Mobile</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="pending_drivers">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="card my-2 p-3">
                <div class="table-responsive">
                    <h5 class="text-danger mb-4">Driver List</h5>
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
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
                <div class="table-responsive" >
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
    <!-- BEGIN THEME CONFIG PANEL-->
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->

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

    <!-- Edit driver modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Driver</h5>
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
                                    <select class="form-control" id="">
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

    <!-- Banking details view modal -->
    <div class="modal fade custmmodl" id="bnkView1" tabindex="-1" role="dialog" aria-labelledby="bnkView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title bank-modal-title" id="exampleModalLongTitle">Banking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">Account Holder Name</strong>
                                <input class="form-control" type="text" value="" placeholder="Account Holder Name" id="acc_name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">Account Number</strong>
                                <input class="form-control" type="text" value="" placeholder="Account Number" id="acc_number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">IFSC</strong>
                                <input class="form-control" type="text" value="" placeholder="IFSC" id="ifsc">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong class="ml-1 mb-1">Bank Name</strong>
                                <input class="form-control" type="text" value="" placeholder="Bank Name" id="bank_name">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("sarathi_page").classList.add('active');

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
                        } else {
                            allow_btn = 'btn-primary';
                            allow_btn_status = '';
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
                    // console.log(response);

                    if (response.success) {
                        let data = response.data;
                        let details = '';
                        let user_status = '';

                        $.each(data, function(i, data) {
                            if (data.status == 'active' || data.status == "ACTIVE") {
                                user_status = "checked";
                            } else {
                                user_status = "";
                            }

                            details += `<tr>
                        <td >${i+1}</td>
                        <td class="title">${data.name}</td>
                        <td>${data.email}</td>
                        <td>${data.mobile}</td>
                                             
                        <td><label class="switch">
                        <input type="checkbox"  ${user_status} data ="${data.user_id}" onclick="status(this, '${data.user_id}')" class="access_status_change" disabled>
                        <span class="slider round"></span></label>
                        </td>
                        <td>
                        <div>

                       
                        <button class="hdrbtn mx-2 view_user" data-toggle="modal" id=" viewbtn"  data-target="#bnkView1"  onclick="view_bank_details('${data.user_id}')" data-toggle="tooltip" data-placement="top" title="Bank Details">                        
                          <img src="<?= base_url('assets/images/details-icon.svg') ?>" alt="" width="16px" class="mb-2">                  
                        </button>


                        <button class="hdrbtn mx-2 edit_user access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1"  onclick="edit('${data.user_id}' , '${data.name}' , '${data.email}' , '${data.mobile}')" data-toggle="tooltip" data-placement="top" title="Edit" disabled>

                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        </button>

                        <button class="hdrbtn mx-2 delete_user access_delete" data-toggle="modal" data="${data.user_id}" data-target="#deltmodl" data-toggle="tooltip" data-placement="top" title="Delete" disabled>

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

                    $('#pending_table').dataTable();


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
                    // console.log(response);
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
                    // console.log(response);
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
                    $("#table_recharge_history").dataTable();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>