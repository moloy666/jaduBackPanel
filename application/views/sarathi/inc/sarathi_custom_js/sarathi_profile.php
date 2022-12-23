<div class="content-wrapper">
    <div class="container py-5">
         <h3 class="mb-3 text-primary">Your Profile</h3>

        <div class="row">
            <!-- <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div> -->
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <form id="form_image">
                        <div class="card-body text-center">
                            <label for="image">
                                <?php
                                if (empty($this->session->userdata(session_sarathi_profile_image) || ($this->session->userdata(session_sarathi_profile_image)) == null) || ($this->session->userdata(session_sarathi_profile_image)) == '') { ?>

                                    <img src="<?= base_url('assets/images/admin-avatar.png') ?>" alt="avatar" id="output" class="rounded-circle img-fluid" style="width: 100px;">

                                <?php
                                } else { ?>
                                    <img src="<?= base_url($this->session->userdata(session_sarathi_profile_image)) ?>" alt="avatar" id="output" class="rounded-circle img-fluid" style="width: 100px;">


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
                                <p class="text-muted mb-0" id="txt_name">(097) 234-5678</p>
                                <input type="text" id="name" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="txt_email">(097) 234-5678</p>
                                <input type="text" id="email" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Mobile</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="txt_mobile">(097) 234-5678</p>
                                <input type="text" id="mobile" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date of Birth</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="txt_dob">(097) 234-5678</p>
                                <input type="text" id="dob" class="form-control" placeholder="Date of Birth">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Gender</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="txt_gender">(097) 234-5678</p>
                                <div class="form-group">
                                    <select class="form-control" id="gender">
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
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>