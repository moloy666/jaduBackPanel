<style>
  .btn:focus{
    outline: none !important;
    box-shadow:none !important;
  }
</style>
<div class="content-wrapper">
  <div class="container py-5">
    <h3 class="mb-3 text-primary">Your Profile</h3>
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
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

              <h5 class="my-3" id="view_name"></h5>
              <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-sm btn-primary " id="btn_update_image" style="display:none;">Update Image</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
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
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Date of Birth</p>
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
              <button class="btn btn-primary" id="edit_btn">Edit Details</button>
              <button class="btn btn-primary" id="update_btn">Update</button>
              <button class="btn btn-primary ml-2" id="btn_change_pwd" data-toggle="modal" data-target="#changePassword">Change Password</button>
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
                  <img src="<?=base_url('assets/images/show.png')?>" alt="" width="16px" id="old_img">
                </button>
              </div>
            </div>

            <div class="input-group mb-3">
              <input class="form-control" type="password" placeholder="Enter New Password" id='new_password' name="new_password" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="btn_new">
                  <img src="<?=base_url('assets/images/show.png')?>" alt="" width="16px" id="new_img">
                </button>
              </div>
            </div>

          </div>
        </form>
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-sm btn-secondary mr-2" data-dismiss="modal" id="btn_close">Close</button>
          <button type="submit" class="btn btn-sm btn-success" id="btn_password">Confirm</button>
        </div>

      </div>

    </div>
  </div>
</div>

<!-- <div class="modal fade custmmodl" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
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

            <div class="col-lg-12">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Enter Old Password" id='old_password' name="old_password" autocomplete="off">
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Enter New Password" id='new_password' name="new_password" autocomplete="off">
              </div>
            </div>

          </div>
        </form>
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-sm btn-secondary mr-2" data-dismiss="modal" id="close_add_modal">Close</button>
          <button type="submit" class="btn btn-sm btn-success" id="btn_password">Confirm</button>
        </div>

      </div>

    </div>
  </div>
</div> -->