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
                    <h3>Dormant Account</h3>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">

                        <!-- <button type="button" class="btn bgred ml-3 btnround" data-toggle="modal" data-target="#addNewUsr1">
              Add New <i class="fa fa-plus ml-2"></i>
            </button> -->

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
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">

                        </tbody>
                    </table>

                </div>
            </div>
            <div id="message"></div>

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


    <script>
        // get_permission_list();
        // display_panel_access_list();

        get_dormant_account_details();

        function get_permission_list() {
            $.ajax({
                type: "GET",
                url: "<?= base_url('administrator/get_permission_list') ?>",
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
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
                    "id": id
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
            <option  ${data.status} value="${data.uid}"  class="title">${data.name}</option>
            `;
                    });

                    $('#edit_admin_access_list').html(details);
                    $('#edit_admin_access_list').multiselect();

                    $('#edit_admin_access_list_input').attr('placeholder', 'Select Management');
                }
            });
        }


        function get_dormant_account_details() {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/get_dormant_account_details') ?>",
                success: function(response) {

                 let data=response.data;
                 let details='';
                 let status='';

                    $.each(data, function(i, data){
                        if(data.status =='ACTIVE' || data.status=='active'){
                            status='checked';
                        }
                        else{
                            status='';
                        }
                        details+=`
                        <tr>
                        <td>${i+1}</td>
                        <td class="title">${data.name}</td>
                        <td>${data.email}</td>
                        <td>${data.mobile}</td>
                    
                        <td><label class="switch">
                        <input type="checkbox"  ${status}  data ="${data.uid}" onclick="status(this, '${data.uid}')">

                        <span class="slider round"></span></label>
                        </td>
                        </tr>`;
                        ;
                    })

                    $('#table_details').html(details);
                    $('#table').dataTable();
                    // get_user_request_permission();
                },
                error: function(data) {
                    // alert(JSON.stringify(data));
                }
            });
        }


        // status change

        function status(state, uid) {
            if (state.checked == true) {
                $.ajax({
                    url: "<?= base_url('Admin/active_admin') ?>",
                    type: "post",
                    data: {
                        "id": uid
                    },
                    success: function(data) {
                        state.removeAttribute("checked");
                        toast("Active this user successfully", "center");
                    },
                    error: function(data) {
                        // alert(JSON.stringify(data));
                    }
                });
            } else {

                $.ajax({
                    url: "<?= base_url('Admin/deactive_admin') ?>",
                    type: "post",
                    data: {
                        "id": uid
                    },
                    error: function(data) {
                        // alert(JSON.stringify(data));
                    },
                    success: function(data) {
                        toast("De-active this user successfully", "center");
                    }
                });
            }
        }

    </script>