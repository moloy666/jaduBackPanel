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
                    <h3>Saathi</h3>
                    <input type="hidden" value="<?= $specific_id ?>" id="specific_id">
                    <input type="hidden" value="<?= $this->session->userdata(session_franchise_table) ?>" id="specific_table">
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">

                        <button type="button" class="btn bgred ml-3 btnround access_insert" data-toggle="modal" data-target="#addNewUsr1" id="add_new" disabled>
                            Add New <i class="fa fa-plus ml-2"></i>
                        </button>

                    </div>
                </div>
            </div>

            <div class="card py-2">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="">#</th>
                                <th class="">Name</th>
                                <th class="">Mobile</th>
                                <th class="">Email</th>
                                <th class="">Refferal Code</th>
                                <th class="">Sub Franchise</th>
                                <th class="">Status</th>
                                <th class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="" id="table_details">

                            <?php
                            foreach ($sarathi_data as $i => $value) {

                                if (!empty($value)) { ?>
                                    <tr id="row_<?= $value[0]['user_id'] ?>">
                                        <td class=""><?= $i + 1 ?></td>

                                        <td class="title nowrap"><a href="<?= base_url($this->session->userdata(session_franchise_table) . "/saathi/driver/") ?><?= $value[0]['user_id'] ?>"><?= $value[0]['name'] ?></a></td>

                                        <td class=""><?= $value[0]['mobile'] ?></td>
                                        <td class=""><?= $value[0]['email'] ?></td>
                                        <td class=""><?= $value[0]['refferal_code'] ?></td>
                                        <td class=" title nowrap"><?= $value[0]['subfranchise']['name'] ?></td>
                                        <td class="">
                                            <label class="switch">
                                                <input type="checkbox" <?= ($value[0]['status'] == const_active) ? "checked" : "" ?> class="access_status_change" data="$<?= $value[0]['user_id'] ?>" onclick="status(this, '<?= $value[0]['user_id'] ?>')" disabled>
                                                <span class="slider round"></span></label>
                                        </td>
                                        <td class="nowrap">
                                            <div style="width:170px">

                                                <button class="hdrbtn mx-2 view_user" data-toggle="tooltip" data-placement="left" title="Download Recharge History" onclick="download_recharge_history('<?= $value[0]['user_id'] ?>')">
                                                    <img src="<?= base_url('assets/images/pdf.png') ?>" alt="" width="20px" class="mb-3">
                                                </button>

                                                <button class="hdrbtn mx-2 view_user" data-toggle="modal" id=" viewbtn" data-target="#bnkView1" onclick="view_bank_details('<?= $value[0]['user_id'] ?>')" data-toggle="tooltip" data-placement="top" title="Bank Details">
                                                    <img src="<?= base_url('assets/images/details-icon.svg') ?>" alt="" width="16px" class="mb-2">
                                                </button>

                                                <button class="hdrbtn mx-2" data-toggle="tooltip" data-placement="top" title="View Document" onclick="view_document('<?= $value[0]['user_id'] ?>')">
                                                    <img src="<?= base_url('assets/images/view_document.png') ?>" alt="" width="20px" class="mb-3">
                                                </button>

                                                <button class="hdrbtn mx-2 edit_user access_update" data-toggle="modal" id=" editbtn" data-target="#edtView1" onclick="edit_sarathi('<?= $value[0]['user_id'] ?>' , '<?= $value[0]['name'] ?>' , '<?= $value[0]['email'] ?>' , '<?= $value[0]['mobile'] ?>')" data-toggle="tooltip" data-placement="top" title="Edit" disabled>

                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M16.4745 5.40801L18.5917 7.52524M17.8358 3.54289L12.1086 9.27005C11.8131 9.56562 11.6116 9.94206 11.5296 10.3519L11 13L13.6481 12.4704C14.0579 12.3884 14.4344 12.1869 14.7299 11.8914L20.4571 6.16423C21.181 5.44037 21.181 4.26676 20.4571 3.5429C19.7332 2.81904 18.5596 2.81903 17.8358 3.54289Z" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M19 15V18C19 19.1046 18.1046 20 17 20H6C4.89543 20 4 19.1046 4 18V7C4 5.89543 4.89543 5 6 5H9" stroke="#ef242f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>

                                                <button class="hdrbtn mx-2 delete_user access_delete" data-toggle="modal" data="<?= $value[0]['user_id'] ?>" data-target="#deltmodl" data-toggle="tooltip" data-placement="top" title="Delete" disabled>

                                                    <svg width="20" height="20" fill="#ef242f" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon">
                                                        <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                                                    </svg>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                            <?php
                                } else {
                                }
                            } ?>

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
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Saathi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_data_form">
                        <div class="row">
                            <?php
                            if ($this->session->userdata(session_franchise_table) == table_franchise) { ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control title" id="select_subfranchise">
                                            <option value="0">Select Management </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Enter Name" id='add_name' name="name" required="required">
                                    </div>
                                </div>
                            <?php
                            } else { ?>

                                <input type="hidden" value="<?= $specific_id ?>" id="select_subfranchise">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Enter Name" id='add_name' name="name" required="required">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Mobile Number" id='add_mobile' name="mobile" required="required">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Enter Email" id='add_email' name="email" required="required">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="access_list" multiple>
                                        <option value="0">Select Management </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="panel_access_list" multiple>
                                        <option value="0">Select Management </option>

                                    </select>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
                    <button type="submit" class="btn btn-success" id="btn_add_data">Add New Saathi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit user modal -->
    <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Saathi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" value="" placeholder="Your Name" id="edit_id">
                                    <input class="form-control" type="text" value="Ramesh janha" placeholder="Your Name" id="edit_name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="number" value="" placeholder="Your Number" id="edit_number" disabled>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="email" value="rameshj123@gmail.com" placeholder="Your Email" id="edit_email" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="edit_access_list" placeholder="Select Management" multiple>
                                        <option value="0">Select Management </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control title" id="edit_panel_access_list" multiple>
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
                        <span aria-hidden="true">??</span>
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