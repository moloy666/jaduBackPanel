<div class="content-wrapper">
    <div class="container py-5">
        <h3 class="mb-3 text-primary">Your Profile</h3>
        <input type="hidden" id="user_id" value="<?= $this->session->userdata(session_sarathi_user_id) ?>">

        <!-- <input type="hidden" id="specific_id" value="<?= $sarathi_id ?>"> -->

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <form id="form_image">
                        <div class="card-body text-center">
                            <label for="image">
                                <?php
                                $apiBaseUrl = apiBaseUrl;
                                if (empty($this->session->userdata(session_sarathi_profile_image) || ($this->session->userdata(session_sarathi_profile_image)) == null) || ($this->session->userdata(session_sarathi_profile_image)) == '') { ?>

                                    <img src="<?= base_url('assets/images/admin-avatar.png') ?>" alt="avatar" id="output" class="rounded-circle img-fluid" style="width: 100px;">

                                <?php
                                } else { ?>
                                    <img src="<?= $apiBaseUrl . $this->session->userdata(session_sarathi_profile_image) ?>" alt="avatar" id="output" class="rounded-circle img-fluid" style="width: 100px;">


                                <?php
                                }
                                ?>

                                <input type="file" name="profile_image" id="image" onchange="loadFile(event)" style="display:none">

                            </label>


                            <p class="text-muted m-0" id="txt_mobile">mobile</p>
                            <p class="text-muted" id="txt_email">email</p>


                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-sm btn-primary " id="btn_update_image" style="display:none;">Update Image</button>
                            </div>
                            <input type="hidden" value="<?= $this->session->userdata(session_sarathi_user_id) ?>" id="user_id">
                            <input type="hidden" value="<?= $sarathi_id ?>" id="specific_id">
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
                                <input type="text" id="name" class="form-control edit_details">
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="row">
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
                        <hr> -->
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date of Birth</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" id="txt_dob">(097) 234-5678</p>
                                <input type="text" id="dob" class="form-control edit_details" placeholder="Date of Birth">
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
                                    <select class="form-control edit_details" id="gender">
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
                        <button class="btn btn-primary" style="display:none" id="btn_update_bank_details">Save</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="mt-2" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor:pointer">
                    <strong class="text-primary">Access List</strong>
                </div>

                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
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


        <!-- <div class="mt-2" id="bnkaccordionExample">
            <div class="card">
                <div class="card-header" id="bank" data-toggle="collapse" data-target="#bankDetails" aria-expanded="true" aria-controls="bank" style="cursor:pointer">
                    <h2 class="mb-0">
                        <small class="text-primary">Banking Details</small>
                    </h2>
                </div>

                <div id="bankDetails" class="collapse " aria-labelledby="bank" data-parent="#bnkaccordionExample">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Account Number</th>
                                        <th class="text-center">IFSC</th>
                                        <th class="text-center">Bank</th>
                                        <th class="text-center">Branch</th>
                                    </tr>
                                </thead>
                                <tbody id="bank_details">

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</div>