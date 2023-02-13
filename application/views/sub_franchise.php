<style>
    .title {
        text-transform: capitalize;
    }
</style>

<body onload="get_sub_franchise()">
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Sub Franchise</h3>
                    <input type="hidden" value="<?= $this->session->userdata(session_admin_specific_id) ?>" id="specific_id">
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="button" class="btn bgred ml-3 btnround access_insert" data-toggle="modal" data-target="#addNewUsr1" disabled>
                            Add New <i class="fa fa-plus ml-2"></i>
                        </button>
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
                                <th class="text-center">Franchise</th>
                                <th class="text-center">Status</th>
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

    <!-- Add new sub franchise modal -->
    <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Sub-Franchise</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_data_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control title" id="select_franchise">
                                        <option value="0">Select Franchise</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
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
                                    <input class="form-control" type="text" placeholder="Your Email" id='add_email' required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="pincode" placeholder="Enter Pincode">
                                </div>
                            </div>

                            <!-- panel access list -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="admin_access_list" multiple>
                                        <option value="0">Select Management</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control title" id="panel_access_list" multiple>
                                        <option value="0">Select Management</option>
                                    </select>
                                </div>
                            </div>

                            

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="address" rows="3" placeholder="Enter Address"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="country" class="form-control title">
                                        <option value="">Select Country</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="state" class="form-control title">
                                        <option value="">State Not Found</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="district" class="form-control title">
                                        <option value="">District Not Found</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 w-50">
                                <div class="form-group">
                                    <select name="" id="city" class="form-control title">
                                        <option value="">City Not Found</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button class="btn btn-success" id="btn_add_data">Add New Sub Franchise</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit sub franchise modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Franchise</h5>
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
                                    <input class="form-control" type="text" value="rameshj123@gmail.com" placeholder="Your Email" id="edit_email" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="edit_access_list" multiple>
                                        <option value="0">Select Management</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control title" id="edit_panel_access_list" multiple>
                                        <option value="0">Select Management</option>

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

    <!-- recharge details view modal -->
    <div class="modal fade custmmodl" id="rechView1" tabindex="-1" role="dialog" aria-labelledby="rechView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title bank-modal-title" id="exampleModalLongTitle">Rechage Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mx-4">

                        <div class="col-md-12">
                            <div class="form-group">

                                <input class="form-control  mb-3" type="text" placeholder="Sub Franchise Id" id='' style="height:40px;background-color:transparent;">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="select_package">
                                    <option value="0" class="form-control">Select Recharge Package</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                    <button type="button" class="btn  btn-success" id="btn_recharge">Recharge</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/display_all_franchise') ?>",
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    var franchise = JSON.parse(response);
                    var str = "";
                    str = `<option value=""> Select Franchise</option>`;
                    $.each(franchise, function(i) {
                        str += `<option class="title" value="${franchise[i].uid}">${franchise[i].name}</option>`;
                    });
                    $('#select_franchise').html(str);

                }
            });
        });

        get_permission_list();
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
                    $('#panel_access_list').html(details);
                    $('#edit_panel_access_list').html(details);
                }
            });
        }


        function get_permission_list() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/get_permission_list') ?>",
                data: {
                    'user_type': 'sub_franchise'
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
                <option value="${data.uid}" class="title">${data.name}</option>
                `;
                    });
                    $('#admin_access_list').html(details);
                }
            });
        }

        // edit
        function editSubFranchise(id, name, email, mobile) {
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
                    'user_type': "sub_franchise"
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

        function get_sub_franchise() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/get_sub_franchise') ?>",
                success: function(response) {
                    if (response.success) {

                        let subfranchise = response.data;

                        let str = '';
                        let count = 1;
                        let subfranchise_status = "";
                        $.each(subfranchise, function(i) {
                            if (subfranchise[i].status == "active" || subfranchise[i].status == "ACTIVE")
                                subfranchise_status = "checked";
                            else
                                subfranchise_status = "";
                            str += `<tr>
                                <td>${i+1}</td>
                                <td class="title"><a href="<?= base_url('administrator/subfranchise_details/') ?>${subfranchise[i].user_id}">${subfranchise[i].name}</a>
                                <span id="${subfranchise[i].user_id}"></span>
                                </td>
                                <td>${subfranchise[i].email}</td>
                                <td>${subfranchise[i].mobile}</td>
                                <td class="title">${subfranchise[i].franchise.name}</td>
                                <td><label class="switch">
                                <input type="checkbox"  ${subfranchise_status} onclick="status(this,'${subfranchise[i].user_id}')" class="access_status_change" disabled>
                                <span class="slider round"></span></label>
                                </td>
                                <td>
                                <div>

                                <button class="hdrbtn mx-2 view_user" id="viewbtn"  data-toggle="tooltip" data-placement="left" title="Download Recharge History" onclick="download_recharge_history('${subfranchise[i].user_id}')">            
                                <img src="<?= base_url('assets/images/pdf.png') ?>" alt="" width="20px" class="mb-3">         
                                </button>
                               
                                
                                <button class="hdrbtn mx-2 view_user  " data-toggle="modal" id=" viewbtn"  data-target="#bnkView1"  onclick="view_bank_details('${subfranchise[i].user_id}')" data-toggle="tooltip" data-placement="top" title="Bank details">                        
                                <img src="<?= base_url('assets/images/details-icon.svg') ?>" alt="" width="16px" class="mb-3">                  
                                </button>

                                <button class="hdrbtn mx-2 access_update" data-toggle="modal" id="editbtn"  data-target="#edtView1"  onclick="editSubFranchise('${subfranchise[i].user_id}' , '${subfranchise[i].name}' , '${subfranchise[i].email}' , '${subfranchise[i].mobile}')" disabled>

                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </button>
                                <button class="hdrbtn mx-2 delete_sub_franchise access_delete" data-toggle="modal" data="${subfranchise[i].user_id}" data-target="#deltmodl" disabled>

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

                        get_user_request_permission();

                        $('#admin_access_list').multiselect();
                        
                        $('#admin_access_list_input').attr('placeholder', 'Select Management');
                    } else {
                        // console.log(response);
                        get_panel_access_list();
                        $('#table').dataTable();
                    }

                },
                error: function(response) {
                    console.log(response);
                }
            });
        }


        function download_recharge_history(user_id) {
            var url = `<?= base_url('admin/download_sarathi_recharge_history/') ?>${user_id}`;
            window.open(url, '_blank');
        }

        function fetch_recharge_package(user_id) {
            let user_type = '<?= end($this->uri->segments) ?>';

            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/get_packages') ?>",
                data: {
                    "user_type": user_type
                },
                error: function(response) {},
                success: function(response) {
                    var data = response.data;
                    var details = ' <option value="">Select Recharge Package</option>';
                    $.each(data, function(i, data) {
                        details += `<option class="title" value="${data.uid}">${data.name}</option>`;
                    });
                    $('#select_package').html(details);

                }
            });
        }


        function status(state, uid) {

            if (state.checked == true) {
                $.ajax({
                    url: "<?= base_url('administrator/active_sub_franchise') ?>",
                    type: "post",
                    data: {
                        "id": uid
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
                    url: "<?= base_url('administrator/deactive_sub_franchise') ?>",
                    type: "post",
                    data: {
                        "id": uid
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

        // update
        $('#btn_update_data').on('click', function() {
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

            let user_type = '<?=$this->session->userdata(field_user_type)?>';
            if (flag == 0) {
                $.ajax({
                    url: "<?= base_url('administrator/update_sub_franchise') ?>",
                    type: "post",
                    data: {
                        "id": id,
                        "name": name,
                        "email": email,
                        "mobile": mobile,
                        "permission": permission,
                        "panel_list": panel_list,
                        'user_type':user_type
                    },
                    success: function(data) {
                        if (data.success) {
                            toast(data.message, "center");
                            $('#update_form')[0].reset();
                            $('#close_edit_modal').click();
                            get_sub_franchise();
                        } else {
                            toast(data.message, "center")
                        }


                    },
                    error: function(data) {
                        alert(JSON.stringify(data));
                        // toast(data);
                    },
                });
            }
        });

        // add new sub franchise
        $('#btn_add_data').on('click', function() {
            let franchise = $('#select_franchise').val();
            let admin_id = $('#specific_id').val();

            let name = $('#add_name').val();
            let email = $('#add_email').val();
            let mobile = $('#add_mobile').val();
            let permission = $('#admin_access_list').val();
            let panel_list = $('#panel_access_list').val();

            let pincode = $('#pincode').val();
            let address = $('#address').val();
            let country = $('#country').val();
            let state = $('#state').val();
            let district = $('#district').val();
            let city = $('#city').val();

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
                toast("Select Access Of Panel", "center");
            }

            if (flag == 0) {
                $.ajax({
                    url: "<?= base_url('administrator/add_sub_franchise') ?>",
                    type: "post",
                    beforeSend:function(){
                        $('#btn_add_data').html(`<img src="<?= base_url('assets/images/loader3.svg') ?>" width="30px">`);
                    },
                    data: {
                        "name": name,
                        "email": email,
                        "mobile": mobile,
                        "franchise_id": franchise,
                        "permission": permission,
                        "panel_list": panel_list,
                        "address":address,
                        "country":country,
                        "state":state,
                        "district":district,
                        "city":city,
                        "pincode":pincode,
                        "specific_id": admin_id,
                    },
                    async: false,
                    complete:function(){
                        $('#btn_add_data').html(`Add New Sub Franchise`);
                    },
                    success: function(data) {
                        if (data.success) {
                            toast(data.message, "center");
                            $('#add_data_form')[0].reset();
                            $('#close_add_modal').click();
                            get_sub_franchise();
                        } else {
                            toast(data.message, "center");
                        }
                    },
                    error: function(data) {
                        // console.log(data);
                    },
                });
            }
        });

        //delete
        $('#table_details').on('click', '.delete_sub_franchise', function() {
            let id = $(this).attr('data');
            $('#btn_delete_data').click(function() {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('administrator/delete_sub_franchise') ?>",
                    data: {
                        "id": id
                    },
                    async: false,
                    success: function(data) {
                        if (data.success) {
                            toast(data.message, "center");
                            $('#close_delete_modal').click();
                            get_sub_franchise();
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

        function get_user_request_permission() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/get_user_request_permission') ?>",
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    let data = response.data;
                    let detail = '';
                    let user_id = '';
                    $.each(data, function(i, data) {
                        detail = `<span class="badge badge-pill badge-warning">r</span>`;
                        user_id = data.user_id;
                        $('#' + user_id).html(detail);
                    });
                }
            });
        }

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

        // <button class="hdrbtn mx-2 view_user access_update" data-toggle="modal" id =" viewbtn"  data-target="#rechView1"  onclick="fetch_recharge_package('${subfranchise[i].user_id}')" data-toggle="tooltip" data-placement="top" title="Recharge ">                        
        // <img src="<?= base_url('assets/images/icon_rupee.png') ?>" alt="" width="18px" class="mb-2">                  
        // </button>
    </script>