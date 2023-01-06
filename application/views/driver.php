<style>
    .title {
        text-transform: capitalize;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Drivers</h3>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">
                    </div>
                </div>
            </div>
            <div class="card p-2">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Sarathi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Ride History</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">
                        </tbody>
                    </table>
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
    <!-- Add new user modal -->
    <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_data_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Your Name" id='add_name'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="number" placeholder="Your Number" id='add_mobile'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Your Email" id='add_email'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option value="0">Select Management </option>
                                        <option value="0">Role Management </option>
                                        <option value="0">Sub Admin Management</option>
                                        <option value="0">Franchise Management</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn_add_data">Add New Driver</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit user modal -->
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
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option value="0">Select Management </option>
                                        <option value="Role Management ">Role Management </option>
                                        <option value="0">Sub Admin Management</option>
                                        <option value="0">Franchise Management</option>
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
        $(document).ready(function() {
            get_driver_details();
            $('#add_new').hide();
        });

        function edit_driver(id, name, email, mobile) {
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_number').val(mobile);
        }

        function get_driver_details() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/get_driver') ?>",
                success: function(response) {
                    if (response.success) {
                        // console.log(response);
                        let driver = response.data;
                        let str = '';
                        let count = 1;
                        let user_status = "";

                        for (let i = 0; i < driver.length; i++) {
                            if (driver[i].name == null || driver[i].name == '') driver[i].name = "";
                            if (driver[i].email == null || driver[i].email == '') driver[i].email = "";
                            if (driver[i].sarathi.name == null || driver[i].sarathi.name == '') driver[i].sarathi.name = "_____";

                            if (driver[i].status == "active" || driver[i].status == "ACTIVE")
                                driver_status = "checked";
                            else
                                driver_status = "";
                            str += `<tr>
                                <td>${count}</td>
                                <td class="title"><a href="<?=base_url('administrator/driver/display_ride_history/')?>${driver[i].user_id}">${driver[i].name}</a></td>
                                <td>${driver[i].email}</td>
                                <td>${driver[i].mobile}</td>
                                <td class="title">${driver[i].sarathi.name}</td> 
                                <td><label class="switch">
                                <input type="checkbox"  ${driver_status} onclick="status(this,'${driver[i].user_id}')" class="access_status_change" disabled>
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

                                <button target="_blank" class="hdrbtn mx-2 view_user" id="viewbtn"  data-toggle="tooltip" data-placement="left" title="Download QR Code" onclick="download_qrCode('${driver[i].driver_id}')">            
                                <img src="<?= base_url('assets/images/qr_code.png') ?>" alt="" width="15px" class="mb-3">         
                                </button>

                                                                
                                <button class="hdrbtn mx-2 view_user" data-toggle="modal" id=" viewbtn"  data-target="#bnkView1"  onclick="view_bank_details('${driver[i].user_id}')" data-toggle="tooltip" data-placement="top" title="Bank details">                        
                                <img src="<?= base_url('assets/images/details-icon.svg') ?>" alt="" width="16px" class="mb-3">                  
                                </button>


                                <button class="hdrbtn mx-2 editUser access_update" data-toggle="modal" id=" editbtn"  data-target="#edtView1"  onclick="edit_driver('${driver[i].user_id}' , '${driver[i].name}' , '${driver[i].email}' , '${driver[i].mobile}')" data-toggle="tooltip" data-placement="top" title="Edit" disabled>

                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </button>

                                <button class="hdrbtn mx-2 delete_driver access_delete" data-toggle="modal" data="${driver[i].user_id}" data-target="#deltmodl" data-toggle="tooltip" data-placement="top" title="Delete" disabled>

                                <svg width="20" height="20" fill="#ef242f" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                                            <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                                        </svg>
                                </button> 
                                
                                </div>
                                </td></tr>`;
                            count++;
                        }
                        $('#table_details').html(str);
                        $('#table').dataTable();
                        get_panel_access_list();
                        
                    } else {
                        console.log(response);
                    }

                },
                error: function(response) {
                    console.log(response);
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

        function status(state, user_id) {
            if (state.checked == true) {
                $.ajax({
                    url: "<?= base_url('administrator/active_driver') ?>",
                    type: "post",
                    data: {
                        "id": user_id
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
                        "id": user_id
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
        ///////////////// update /////////////////////

        $('#btn_update_data').on('click', function() {
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
    </script>