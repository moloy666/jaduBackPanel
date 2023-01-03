<style>
  .btn:focus {
    outline: none !important;
    box-shadow: none !important;
  }

  .title {
    text-transform: capitalize;
  }
</style>
<div class="content-wrapper">
  <div class="container py-5">
    <h3 class="mb-3 ml-3 text-primary">Your Profile</h3>

    <div class="row">
      <div class="col-lg-3">
        <div class="card mb-2 p-2">
          <form id="form_image">
            <div class="card-body text-center">
              <label for="image">
                <?php
                if (empty($this->session->userdata(field_profile_image) || ($this->session->userdata(field_profile_image)) == null) || ($this->session->userdata(field_profile_image)) == '') { ?>

                  <img src="<?= base_url('assets/images/admin-avatar.png') ?>" alt="avatar" id="output" class="rounded-circle img-fluid" style="width: 100px;">

                <?php
                } else { ?>
                  <img src="<?= base_url($this->session->userdata(field_profile_image)) ?>" alt="avatar" id="output" class="rounded-circle img-fluid" style="width: 100px;">


                <?php
                }
                ?>

                <input type="file" name="image" id="image" onchange="loadFile(event)" style="display:none">

              </label>

              <input type="hidden" value="<?= $this->session->userdata(session_admin_specific_id) ?>" id="specific_id">
              <input type="hidden" value="<?= $this->session->userdata(session_table) ?>" id="specific_table">
              <input type="hidden" value="<?= $this->session->userdata(field_user_id) ?>" id="user_id">

              <!-- <h5 class="my-3" id="view_name"></h5> -->
              <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-sm btn-primary mt-1" id="btn_update_image" style="display:none;">Update Image</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card mb-6">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="txt_name"></p>
                <input type="text" id="name" class="form-control txtbox">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="txt_email"></p>
                <input type="text" id="email" class="form-control txtbox">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="txt_mobile"></p>
                <input type="text" id="mobile" class="form-control txtbox">
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card mb-6">
          <div class="card-body">

            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">D.O.B</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="txt_dob"></p>
                <input type="text" id="dob" class="form-control txtbox" placeholder="Date of Birth">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="txt_gender"></p>
                <div class="form-group">
                  <select class="form-control txtbox" id="gender">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row float-right mr-2">
              <button class="btn btn-primary" id="edit_btn">Edit</button>
              <button class="btn btn-primary" id="update_btn">Update</button>
              <button class="btn btn-primary ml-2" id="btn_change_pwd" data-toggle="modal" data-target="#changePassword">Change Password</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="mb-3">
      <div class="card">
        <div class="card-header">
          <strong class="text-primary">Bank Details <span id="message"></span></strong>
        </div>
        <div class="card-body d-flex">
          <div class="form-group mr-3">
            <strong class="ml-2 mb-2">Account Number</strong>
            <input type="text" class="form-control disabled" placeholder="Account number" id="account_number" autocomplete="off">
          </div>
          <div class="form-group mr-3">
            <strong class="ml-2 mb-2">IFSC</strong>

            <input type="text" class="form-control disabled" placeholder="IFSC" id="ifsc" autocomplete="off">
          </div>
          <div class="form-group mr-3">
            <strong class="ml-2 mb-2">Name</strong>

            <input type="text" class="form-control disabled" placeholder="Bank Name" id="bank_name" autocomplete="off">
          </div>
          <div class="form-group mr-3">
            <strong class="ml-2 mb-2">Branch</strong>

            <input type="text" class="form-control disabled" placeholder="Branch Name" id="branch" autocomplete="off">
          </div>
          <div class="form-group mr-3 mt-4">
            <button class="btn btn-primary" id="btn_edit_bank_details">Edit</button>
            <button class="btn btn-primary" style="display:none" id=btn_update_bank_details>Save</button>
          </div>
        </div>
      </div>
    </div>



    <div class="mt-2" id="accordionExample" style="display : <?= ($this->session->userdata(field_type_id) != "user_admin") ? "none" : ""  ?>">
      <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <strong class="text-primary">Access List : <span id="panel" class="title"></span></strong>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-bordered" id="table">
                <thead class="thead">
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Permission</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Request</th>
                  </tr>
                </thead>
                <tbody id="permission_list">

                </tbody>

              </table>
            </div>
            
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
</div>


<!-- change password modal -->

<div class="modal fade custmmodl" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_data_form">
          <div class="col">

            <div class="input-group mb-3">
              <input class="form-control" type="password" placeholder="Enter Old Password" id='old_password' name="old_password" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btn_old">
                  <img src="<?= base_url('assets/images/show.png') ?>" alt="" width="16px" id="old_img">
                </button>
              </div>
            </div>

            <div class="input-group mb-3">
              <input class="form-control" type="password" placeholder="Enter New Password" id='new_password' name="new_password" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btn_new">
                  <img src="<?= base_url('assets/images/show.png') ?>" alt="" width="16px" id="new_img">
                </button>
              </div>
            </div>

          </div>
        </form>
        <div class="d-flex justify-content-end">
          <!-- <button type="button" class="btn btn-sm btn-secondary mr-2" data-dismiss="modal" id="btn_close">Close</button> -->
          <button type="button" class="btn btn-success mr-2" id="btn_password">Confirm</button>
        </div>

      </div>

    </div>
  </div>
</div>