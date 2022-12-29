<style type="text/css">
    .setting-box {
        height: 70px;
        text-align: center;
        
    }

    .settings-left-box {
        height: 100%;
        padding-top: 10%;
        cursor: pointer;
        font-weight: bold;
    }

    .settings-left-box:hover {
        font-size: medium;
        background-color: #50C878 !important;
        /*transition: 1s;*/
        color: #fff;
    }

    .txtarea {
        height: 480px;
    }

    .scroll-container{
        height: calc(100vh - 76px);
        overflow-y: auto;
    }
   
</style>

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up" style="padding:10px;">
        <div class="row" id="accordion">
            <div class="col-md-3" >
                <div class="row scroll-container">

                    <!-- delivery guidelines -->
                    <div class="col-md-12 setting-box" data-toggle="collapse" data-target="#delivery_guideline" aria-expanded="false" aria-controls="delivery_guide" id="delivery_guidelines">
                        <div class="shadow-lg bg-white rounded settings-left-box">Delivery Guidelines</div>
                    </div>

                    <!-- rezorpay key  js in privacy_term_js file -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#razorpay" aria-expanded="false" aria-controls="razorpay" id="razorpay_key">
                        <div class="shadow-lg bg-white rounded settings-left-box helpline_number">Razor Pay Key</div>
                    </div>

                    <!-- Google api key  js in privacy_term_js file -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#googleKey" aria-expanded="false" aria-controls="googleKey" id="google_key">
                        <div class="shadow-lg bg-white rounded settings-left-box helpline_number">Google Api Key</div>
                    </div>

                    <!-- sos number -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#sosNumber" aria-expanded="false" aria-controls="googleKey" id="sos_number">
                        <div class="shadow-lg bg-white rounded settings-left-box sos_number">SOS Number</div>
                    </div>

                    <!-- helpline number -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#manage_helpline_number" aria-expanded="false" aria-controls="helpline_number" id="helpline_number">
                        <div class="shadow-lg bg-white rounded settings-left-box helpline_number">Manage Helpline Number</div>
                    </div>

                    <!-- splash data starts -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#sarathi_splash_screen" aria-expanded="false" aria-controls="sarathi_splash_screen" id="sarathi">
                        <div class="shadow-lg bg-white rounded settings-left-box sarathi_splash_screen">Sarathi Splash Screen</div>
                    </div>

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#driver_splash_screen" aria-expanded="false" aria-controls="driver_splash_screen" id="driver">
                        <div class="shadow-lg bg-white rounded settings-left-box driver_splash_screen">Driver Splash Screen</div>
                    </div>

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#customer_splash_screen" aria-expanded="false" aria-controls="customer_splash_screen" id="customer">
                        <div class="shadow-lg bg-white rounded settings-left-box driver_splash_screen">Customer Splash Screen</div>
                    </div>

                    <!-- privacy policy starts -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#sarathi_privacy_policy" aria-expanded="false" aria-controls="sarathi_privacy_policy" id="sarathi_privacy">
                        <div class="shadow-lg bg-white rounded settings-left-box sarathi_privacy_policy">Sarathi Privacy Policy</div>
                    </div>

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#driver_privacy_policy" aria-expanded="false" aria-controls="driver_privacy_policy" id="driver_privacy">
                        <div class="shadow-lg bg-white rounded settings-left-box driver_privacy_policy">Driver Privacy Policy</div>
                    </div>

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#customer_privacy_policy" aria-expanded="false" aria-controls="customer_privacy_policy" id="customer_privacy">
                        <div class="shadow-lg bg-white rounded settings-left-box driver_privacy_policy">Customer Privacy Policy</div>
                    </div>

                    <!-- terms & condition starts -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#sarathi_terms_condition" aria-expanded="false" aria-controls="sarathi_terms_condition" id="sarathi_terms">
                        <div class="shadow-lg bg-white rounded settings-left-box sarathi_terms_condition">Sarathi Terms & Condition</div>
                    </div>

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#driver_terms_condition" aria-expanded="false" aria-controls="driver_terms_condition" id="driver_terms">
                        <div class="shadow-lg bg-white rounded settings-left-box driver_terms_condition">Driver Terms & Condition</div>
                    </div>

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#customer_terms_condition" aria-expanded="false" aria-controls="customer_terms_condition" id="customer_terms">
                        <div class="shadow-lg bg-white rounded settings-left-box customer_terms_condition">Customer Terms & Condition</div>
                    </div>

                    <!-- refund policy -->

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#driver_refund_policy" aria-expanded="false" aria-controls="driver_refund_policy" id="driver_refund">
                        <div class="shadow-lg bg-white rounded settings-left-box driver_refund_policy">Driver Refund Policy</div>
                    </div>

                    <div class="col-md-12 setting-box mt-3" data-toggle="collapse" data-target="#customer_refund_policy" aria-expanded="false" aria-controls="customer_refund_policy" id="customer_refund">
                        <div class="shadow-lg bg-white rounded settings-left-box customer_refund_policy">Customer Refund Policy</div>
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <input type="hidden" id="url_name">

                <div id="sosNumber" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">SOS Number</div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Key</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sosNumberUser" class=''>
                                        
                                    </tbody>
                                </table>

                            </div>
                            <h2 class="m-b-5 font-strong totalSarathi"></h2>
                        </div>
                    </div>
                </div>

                <!-- razorpay key  -->

                <div id="razorpay" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Razor Pay Key</div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Key</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="razorPayKey" class='key'>
                                        
                                    </tbody>
                                </table>

                            </div>
                            <h2 class="m-b-5 font-strong totalSarathi"></h2>
                        </div>
                    </div>
                </div>

                <div id="googleKey" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Google Api Key</div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Key</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="googleApiKey" class='key'>
                                        
                                    </tbody>
                                </table>

                            </div>
                            <h2 class="m-b-5 font-strong totalSarathi"></h2>
                        </div>
                    </div>
                </div>

                <!-- splash screen starts -->

                <div id="sarathi_splash_screen" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Sarathi Splash Screen</div>

                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" id="btn_add_splash" data-toggle="modal" data-target="#addSplh" data-toggle="tooltip" data-placement="bottom" title="Add New Splash">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                </button>
                            </div>

                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Cover Image</th>
                                            <th>Heading</th>
                                            <th>Body</th>
                                            <th>For</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sarathiSplash">

                                    </tbody>
                                </table>

                            </div>
                            <h2 class="m-b-5 font-strong totalSarathi"></h2>
                        </div>
                    </div>
                </div>

                <div id="driver_splash_screen" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Driver Splash Screen</div>

                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" id="btn_add_splash" data-toggle="modal" data-target="#addSplh" data-toggle="tooltip" data-placement="bottom" title="Add New Splash">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                </button>
                            </div>

                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Cover Image</th>
                                            <th>Heading</th>
                                            <th>Body</th>
                                            <th>For</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="driverSplash">

                                    </tbody>
                                </table>

                            </div>
                            <h2 class="m-b-5 font-strong totalDriver"></h2>
                        </div>
                    </div>
                </div>

                <div id="customer_splash_screen" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Customer Splash Screen</div>

                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" id="btn_add_splash" data-toggle="modal" data-target="#addSplh" data-toggle="tooltip" data-placement="bottom" title="Add New Splash">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                </button>
                            </div>

                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Cover Image</th>
                                            <th>Heading</th>
                                            <th>Body</th>
                                            <th>For</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerSplash">

                                    </tbody>
                                </table>

                            </div>
                            <h2 class="m-b-5 font-strong totalCustomer"></h2>
                        </div>
                    </div>
                </div>


                <!-- ===== Manage Helpline Number ======= -->

                <div id="manage_helpline_number" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Manage Helpline Number</div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>User Type</th>
                                            <th>Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="helpLineNumber">
                                        <tr>
                                            <th>Sarathi</th>
                                            <th>Number</th>
                                            <th><button>edit</button></th>
                                        </tr>
                                        <tr>
                                            <th>Driver</th>
                                            <th>Number</th>
                                            <th><button>edit</button></th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <h2 class="m-b-5 font-strong totalDriver"></h2>
                        </div>
                    </div>
                </div>

                <!-- ======================= -->

                <!-- privacy policy starts -->

                <div id="sarathi_privacy_policy" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Sarathi</div>
                            <button class="btn btn-success" id="btn_update_sarathi_privacy">Save</button>

                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control mb-2" id="sarathi_text_name_privacy">
                            <textarea name="" id="sarathi_text_value_privacy" cols="30" rows="10" class="form-control txtarea"></textarea>
                        </div>
                    </div>
                </div>

                <div id="driver_privacy_policy" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Driver</div>
                            <button class="btn btn-success" id="btn_update_driver_privacy">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control mb-2" id="driver_text_name_privacy">
                            <textarea name="" id="driver_text_value_privacy" cols="30" rows="10" class="form-control txtarea"></textarea>
                        </div>
                    </div>
                </div>

                <div id="customer_privacy_policy" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Customer</div>
                            <button class="btn btn-success" id="btn_update_customer_privacy">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control mb-2" id="customer_text_name_privacy">
                            <textarea name="" id="customer_text_value_privacy" cols="30" rows="10" class="form-control txtarea"></textarea>
                        </div>
                    </div>
                </div>

                <!-- terms & conditions starts -->

                <div id="sarathi_terms_condition" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Sarathi</div>
                            <button class="btn btn-success" id="btn_update_sarathi_term">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control mb-2" id="sarathi_text_name_term">
                            <textarea name="" id="sarathi_text_value_term" cols="30" rows="10" class="form-control txtarea"></textarea>
                        </div>
                    </div>
                </div>

                <div id="driver_terms_condition" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Driver</div>
                            <button class="btn btn-success" id="btn_update_driver_term">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control" id="driver_text_name_term">

                            <textarea name="" id="driver_text_value_term" cols="30" rows="10" class="form-control txtarea"></textarea>

                        </div>
                    </div>
                </div>

                <div id="customer_terms_condition" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Customer</div>
                            <button class="btn btn-success" id="btn_update_customer_term">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control" id="customer_text_name_term">
                            <textarea name="" id="customer_text_value_term" cols="30" rows="10" class="form-control txtarea"></textarea>
                        </div>
                    </div>
                </div>

                <!-- refund policy starts -->

                <div id="driver_refund_policy" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Driver</div>
                            <button class="btn btn-success" id="btn_update_driver_refund">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control" id="driver_text_name_refund">
                            <textarea name="" id="driver_text_value_refund" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div id="customer_refund_policy" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Customer</div>
                            <button class="btn btn-success" id="btn_update_customer_refund">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control" id="customer_text_name_refund">
                            <textarea name="" id="customer_text_value_refund" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <!-- delivery guidelines starts -->

                <div id="delivery_guideline" class="collapse" data-parent="#accordion">
                    <div class="ibox color-black widget-stat">
                        <div class="ibox-head">
                            <div class="ibox-title">Add Delivery Guidelines</div>
                            <button class="btn btn-success" id="btn_save_delivery_guide">Save</button>
                        </div>
                        <div class="ibox-body">
                            <input type="hidden" class="form-control" id="delivery_guide_lines">
                            <textarea name="" id="delivery_guide" cols="30" rows="20" class="form-control"></textarea>
                            <!-- <?= $delivery_guide ?> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- splash data edit modal -->

<div class="modal fade custmmodl" id="edtSplh" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Splash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_image" class="d-flex justify-content-center">
                                    <img src="<?= base_url('assets/images/splash_default.png') ?>" id="edit_output" width="25%" alt="">
                                </label>
                                <input type="file" name="splash_image" classs="form-control" id="edit_image" onchange="editLoadFile(event)" style="display:none;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" id="edit_id" name="id">

                                <input class="form-control" type="text" id="edit_heading" name="heading">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" name="for" id="edit_for">
                                    <option value="">Select Type </option>
                                    <option value="registration">Registration</option>
                                    <option value="get_started">Get Started</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="edit_body" class="form-control" cols="30" rows="10" name="body"></textarea>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                <button form="update_form" class="btn btn-success" id="btn_update_data">Save </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade custmmodl" id="addSplh" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Splash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add_image" class="d-flex justify-content-center">
                                    <img src="<?= base_url('assets/images/splash_default.png') ?>" id="output" width="25%" alt="">
                                </label>
                                <input type="file" name="splash_image" classs="form-control" id="add_image" onchange="loadFile(event)" style="display:none;">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="text" id="add_heading" name="heading" placeholder="Enter Heading">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" name="for" id="add_for">
                                    <option value="">Select Type </option>
                                    <option value="registration">Registration</option>
                                    <option value="get_started">Get Started</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <input type="hidden" id="splash_for" name="specific_for" class="form-control">

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="add_body" class="form-control" cols="30" rows="10" name="body" placeholder="Enter Body"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
                <button form="add_form" class="btn btn-success" id="btn_add_data">Save </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Helpline Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="help_for" name="help_for" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="edit_help_number" placeholder="Enter HelpLine Number">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="">Close</button>
                <button class="btn btn-success" id="btn_edit_help">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- update confirm modal -->

<div class="modal fade delemodel" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content p-4 text-center">
            <h5 class="mb-4">Are you sure want to update this content ?</h5>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <button class="btn-secondary btn" data-dismiss="modal" id="close_delete_modal">No</button>
                <button class="btn-success btn ml-3" id="btn_update_content">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace("delivery_guide");
    CKEDITOR.replace("customer_text_value_refund");
    CKEDITOR.replace("driver_text_value_refund");
    CKEDITOR.replace("customer_text_value_term");
    CKEDITOR.replace("driver_text_value_term");
    CKEDITOR.replace("sarathi_text_value_term");
    CKEDITOR.replace("sarathi_text_value_privacy");
    CKEDITOR.replace("driver_text_value_privacy");
    CKEDITOR.replace("customer_text_value_privacy");
</script>