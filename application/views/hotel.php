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
          <h3>Hotels</h3>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center justify-content-end">

            <!-- <button type="button" class="btn bgred ml-3 btnround" data-toggle="modal" data-target="#addNewUsr1">
              Add New <i class="fa fa-plus ml-2"></i>
            </button> -->
            <input type="hidden" value="<?= $this->session->userdata(field_user_id) ?>" id="user_id">
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
                <th class="text-center">Address</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
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

  <!-- Add new user modal -->

  <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Hotel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add_data_form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Enter Name" id='name' name="name">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="number" placeholder="Mobile Number" id='mobile' name="mobile">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="email" placeholder="Enter Email" id='email' name="email">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="email" placeholder="Enter Address" id='address' name="email">
                </div>
              </div>

            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
          <button form="add_data_form" class="btn btn-success" id="btn_add_data">Add Hotel</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Edit user modal -->
  <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Admin Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="hidden" value="" placeholder="Your Name" id="edit_id" name="id">
                <input class="form-control" type="text" value="" placeholder="Your Name" id="edit_name" name="name">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="number" value="" placeholder="Your Number" id="edit_number" name="mobile">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="email" value="" placeholder="Your Email" id="edit_email" name="email">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <select class="form-control title" id="edit_admin_access_list" multiple>
                  <option value="0">Select Management </option>
                  <option value="0">Select Management </option>
                  <option value="0">Select Management </option>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control title" id="edit_panel_access_list" multiple>
                  <option value="0">Select Management </option>
                </select>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
          <button type="submit" class="btn btn-success" id="btn_update_data">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    get_hotel_details();

    function get_hotel_details() {
      $.ajax({
        type: "post",
        url: "<?= base_url('administrator/get_hotel_details') ?>",
        success: function(response) {
          // console.log(response);
          let data = response.data;
          let details = '';
          let status = '';

          $.each(data, function(i, data) {
            if (data.status == 'ACTIVE' || data.status == 'active') {
              status = 'checked';
            } else {
              status = '';
            }
            details += `<tr>
                <td>${i+1}</td>
                <td class="title">${data.name}</td>
                <td>${data.email}</td>
                <td>${data.mobile}</td>
                <td class="title">${data.location}, ${data.district}, ${data.pincode}, ${data.state}</td>
                <td><label class="switch">
                  <input type="checkbox"  ${status}  class="access_status_change" onclick="status(this, '${data.uid}')" disabled>
                  <span class="slider round"></span></label>
                </td>
                <td>
                  <div>
                    
                      <button class="hdrbtn mx-2 delete access_delete" data-toggle="modal" data="${data.uid}" data-target="#deltmodl" data-toggle="tooltip" data-placement="top" title="Delete" disabled>

                        <svg width="20" height="20" fill="#ef242f" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                            <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                        </svg>
                    </button> 
                  </div>
                </td>

                </tr>
              `;
          });

          $('#table_details').html(details);
          $('#table').dataTable();
          get_panel_access_list();

        },
        error: function(response) {
          console.log(response);
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
            console.log(data[i]);
          });
        }
      });
    }


    // status change

    function status(state, uid) {
      if (state.checked == true) {
        $.ajax({
          url: "<?= base_url('administrator/active_hotel') ?>",
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

        $.ajax({
          url: "<?= base_url('administrator/deactive_hotel') ?>",
          type: "post",
          data: {
            "id": uid
          },
          error: function(data) {
            alert(JSON.stringify(data));
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

    // update 

    $('#btn_update_data').click(function(e) {
      e.preventDefault();

      let id = $('#edit_id').val();
      let name = $('#edit_name').val();
      let email = $('#edit_email').val();
      let mobile = $('#edit_number').val();
      let permission = $('#edit_admin_access_list').val();
      let panel_list = $('#edit_panel_access_list').val();

      let flag = 0;


      if (permission == '') {
        flag = 1;
        toast("Select Management", "center");
      }

      if (panel_list == '') {
        flag = 1;
        toast("Select Panel Access", "center");
      }

      if (email.indexOf('@') > -1) {
        flag = 0;
      } else {
        flag = 1;
        toast("Enter a valid email id", "center");
      }

      if (flag == 0) {
        $.ajax({
          url: "<?= base_url('Admin/update_admin') ?>",
          type: "post",
          data: {
            'id': id,
            'name': name,
            'email': email,
            'mobile': mobile,
            'permission': permission,
            'panel_list': panel_list
          },
          success: function(data) {
            // console.log(data);
            if (data.success) {
              toast(data.message, "center");
              $('#close_edit_modal').click();
              get_admin_details();
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

    // $('#add_data_form').on('submit', function(e) {

    //   e.preventDefault();

    //   let name = $('#add_name').val();
    //   let email = $('#add_email').val();
    //   let mobile = $('#add_mobile').val();

    //   let permission = $('#admin_access_list').val();

    //   let panel_list = $('#panel_access_list').val();

    //   let flag = 0;

    //   if (name.length < 3) {
    //     flag = 1;
    //     toast("Name should contain atleast three letters", "center");
    //   }

    //   if (mobile.length != 10) {
    //     flag = 1;
    //     toast("Mobile number must contain 10 digit", "center");
    //   }

    //   if (email == '') {
    //     flag = 1;
    //     toast("Email id is required", "center");
    //   }

    //   if (permission == '') {
    //     flag = 1;
    //     toast("Select Management", "center");
    //   }

    //   if (panel_list == '') {
    //     flag = 1;
    //     toast("Select Access Of Panel", "center");
    //   }

    //   if (flag == 0) {
    //     $.ajax({
    //       url: "<?= base_url('Admin/add_admin') ?>",
    //       type: "post",
    //       data: {
    //         "name": name,
    //         "mobile": mobile,
    //         "email": email,
    //         "permission": permission,
    //         "panel_list": panel_list
    //       },
    //       success: function(data) {
    //         console.log(data);
    //         if (data.success) {
    //           toast(data.message, "center");
    //           $('#close_add_modal').click();
    //           $('#add_data_form')[0].reset();
    //           get_admin_details();
    //         } else {
    //           toast(data.message, "center");
    //         }
    //       },
    //       error: function(data) {
    //         console.log(data);

    //       },
    //     });
    //   }
    // });

    //delete 

    $('#table_details').on('click', '.delete', function() {
      let id = $(this).attr('data');
      $('#btn_delete_data').click(function() {
        $.ajax({
          type: "post",
          url: "<?= base_url('Admin/delete_hotel') ?>",
          data: {
            'id': id
          },
          success: function(data) {
            if (data.success) {
              toast(data.message, 'center');
              get_hotel_details();
              $('#close_delete_modal').click();
            }
            else{
              toast(data.message, 'center');
            }

          },
          error: function(data) {
            console.log(JSON.stringify(data));
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
            $('.' + data[i]).removeAttr('disabled', 'disabled');
            // console.log(data[i]);
          });
        }
      });
    }
  </script>