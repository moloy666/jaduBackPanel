<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script type="text/javascript">
    var for_app;
    //////////// Privacy Policy

    $('#sarathi_privacy').click(function() {
        for_app = 'sarathi_privacy_policy';
        display_doumentation_content(for_app);
    });

    $('#driver_privacy').click(function() {
        for_app = 'driver_privacy_policy';
        display_doumentation_content(for_app);
    });

    $('#customer_privacy').click(function() {
        for_app = 'customer_privacy_policy';
        display_doumentation_content(for_app);
    });

    //////////// Terms & Conditions 

    $('#sarathi_terms').click(function() {
        for_app = 'sarathi_terms_and_condition';
        display_doumentation_content(for_app);
    });

    $('#driver_terms').click(function() {
        for_app = 'driver_terms_and_condition';
        display_doumentation_content(for_app);
    });

    $('#customer_terms').click(function() {
        for_app = 'customer_terms_and_condition';
        display_doumentation_content(for_app);
    });

    ////////////////////// Driver Refund Policy /////////////////////////////////////

    $('#driver_refund').click(function() {
        for_app = 'driver_refund_policy';
        display_doumentation_content(for_app);
    });

    $('#customer_refund').click(function() {
        for_app = 'customer_refund_policy';
        display_doumentation_content(for_app);
    });

    ///////////////////// Delivery Guidelines ////////////////////////////////////////
    $('#delivery_guidelines').click(function() {
        for_app = 'delivery_guidelines';
        display_doumentation_content(for_app);
    });

    // ===================================================================================== //

    function display_doumentation_content(for_app) {
        $.ajax({
            type: "POST",
            url: `<?= base_url('administrator/display_documentation_content') ?>`,
            data: {
                'for': for_app
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {

                    let value = response.data.value;
                    let id = response.data.id;
                    let name = response.data.name;
                    let str = '';

                    if (for_app == 'sarathi_privacy_policy') {
                        $('.ibox-title').text('Sarathi Privacy Policy');
                        $('#sarathi_text_name_privacy').val(name);
                        CKEDITOR.instances['sarathi_text_value_privacy'].setData(value);


                    }
                    if (for_app == 'driver_privacy_policy') {
                        $('.ibox-title').text('Driver Privacy Policy');
                        $('#driver_text_name_privacy').val(name);
                        CKEDITOR.instances['driver_text_value_privacy'].setData(value);
                    }

                    if (for_app == 'customer_privacy_policy') {
                        $('.ibox-title').text('Customer Privacy Policy');
                        $('#customer_text_name_privacy').val(name);
                        CKEDITOR.instances['customer_text_value_privacy'].setData(value);
                    }

                    if (for_app == 'sarathi_terms_and_condition') {
                        $('.ibox-title').text('Sarathi Terms & Condition');
                        $('#sarathi_text_name_term').val(name);
                        CKEDITOR.instances['sarathi_text_value_term'].setData(value);

                    }
                    if (for_app == 'driver_terms_and_condition') {
                        $('.ibox-title').text('Driver Terms & Condition');
                        $('#driver_text_name_term').val(name);
                        CKEDITOR.instances['driver_text_value_term'].setData(value);


                    }
                    if (for_app == 'customer_terms_and_condition') {
                        $('.ibox-title').text('Customer Terms & Condition');
                        $('#customer_text_name_term').val(name);
                        CKEDITOR.instances['customer_text_value_term'].setData(value);

                    }
                    if (for_app == 'driver_refund_policy') {
                        $('.ibox-title').text('Driver Refund Policy');
                        $('#driver_text_name_refund').val(name);
                        CKEDITOR.instances['driver_text_value_refund'].setData(value);

                    }
                    if (for_app == 'customer_refund_policy') {
                        $('.ibox-title').text('Customer Refund Policy');
                        $('#customer_text_name_refund').val(name);
                        CKEDITOR.instances['customer_text_value_refund'].setData(value);
                    }
                    if (for_app == 'delivery_guidelines') {
                        $('.ibox-title').text('Delivery Guidelines');
                        $('#delivery_guide_lines').val(name);
                        CKEDITOR.instances['delivery_guide'].setData(value);
                    }

                } else {
                    console.log(response);
                }
            }
        });
    }

    var confirm_documentation_value;
    var confirm_documentation_name;

    //////////////////////// term & condition //////////////////

    $('#btn_update_sarathi_term').click(function() {
        confirm_documentation_value = CKEDITOR.instances["sarathi_text_value_term"].getData();
        confirm_documentation_name = $('#sarathi_text_name_term').val();
        $('#sarathi_text_value_term').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });

    // ====================================================

    $('#btn_update_driver_term').click(function() {
        confirm_documentation_value = CKEDITOR.instances["driver_text_value_term"].getData();
        confirm_documentation_name = $('#driver_text_name_term').val();
        $('#driver_text_value_term').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });

    // ======================================================

    $('#btn_update_customer_term').click(function() {
        confirm_documentation_value = CKEDITOR.instances["customer_text_value_term"].getData();
        confirm_documentation_name = $('#customer_text_name_term').val();
        $('#customer_text_value_term').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });

    //////////////////////////// privacy policy ///////////////////////////////

    $('#btn_update_sarathi_privacy').click(function() {
        confirm_documentation_value = CKEDITOR.instances["sarathi_text_value_privacy"].getData();
        confirm_documentation_name = $('#sarathi_text_name_privacy').val();
        $('#sarathi_text_value_privacy').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });

    // ==============================================================

    $('#btn_update_driver_privacy').click(function() {
        confirm_documentation_value = CKEDITOR.instances["driver_text_value_privacy"].getData();
        confirm_documentation_name = $('#driver_text_name_privacy').val();
        $('#driver_text_value_privacy').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });
    // ==============================================================
    $('#btn_update_customer_privacy').click(function() {
        confirm_documentation_value = CKEDITOR.instances["customer_text_value_privacy"].getData();
        confirm_documentation_name = $('#customer_text_name_privacy').val();
        $('#customer_text_value_privacy').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });

    ////////////////////////// Refund policy ////////////////////////////////////////////

    $('#btn_update_driver_refund').click(function() {
        confirm_documentation_value =  CKEDITOR.instances["driver_text_value_refund"].getData();
        confirm_documentation_name = $('#driver_text_name_refund').val();
        $('#driver_text_value_refund').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });
    //======================================================

    $('#btn_update_customer_refund').click(function() {
        confirm_documentation_value =  CKEDITOR.instances["customer_text_value_refund"].getData();
        confirm_documentation_name = $('#customer_text_name_refund').val();
        $('#customer_text_value_refund').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });

   
    /////////////////////////// Delivery guidelines ////////////////////////////////

    $('#btn_save_delivery_guide').click(function() {
        confirm_documentation_value =  CKEDITOR.instances["delivery_guide"].getData();
        confirm_documentation_name = $('#delivery_guide_lines').val();
        $('#customer_text_value_refund').attr('disabled', 'disabled');
        $('#confirm_modal').modal('show');
    });


    //////////////////////// update documentation content ////////////////////

    $('#btn_update_content').click(function() {

        let name = confirm_documentation_name;
        let value = confirm_documentation_value;
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/update_documentation_content') ?>",
            data: {
                "name": name,
                "value": value
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    $('#confirm_modal').modal('hide');
                    toast(response.message, "center");

                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    /////////////////// Manage Helpline Number  //////////////////////
    manage_helpline_number();

    function manage_helpline_number() {
        $.ajax({
            type: "get",
            url: "<?= base_url('administrator/manage_helpline_number') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);

                let data = response.data;
                let sarathi = data.sarathi;
                let driver = data.driver;
                let customer = data.customer;

                let view = '';
                view = `
                <tr>
                    <th class="title">${sarathi.name}</th>
                    <th>${sarathi.value}</th>
                    <th>
                        <button class="btn btn-primary" id="btn_${sarathi.name}" data-toggle="modal" data-target="#help" onclick="edit_help(this, '${sarathi.name}', ${sarathi.value})">Edit</button>
                    </th>
                </tr>
                <tr>
                    <th class="title">${driver.name}</th>
                    <th>${driver.value}</th>
                    <th><button class="btn btn-primary" id="btn_${driver.name}" data-toggle="modal" data-target="#help" onclick="edit_help(this, '${driver.name}', ${driver.value})">Edit</button></th>
                </tr>
                <tr>
                    <th class="title">${customer.name}</th>
                    <th>${customer.value}</th>
                    <th><button class="btn btn-primary" id="btn_${customer.name}" data-toggle="modal" data-target="#help" onclick="edit_help(this, '${customer.name}', ${customer.value})">Edit</button></th>
                </tr>
                `;
                $('#helpLineNumber').html(view);

            }
        });
    }


    function edit_help(element, type, number) {
        $('#edit_help_number').val(number);
        $('#help_for').val(type + '_helpline_number');
    }

    $('#btn_edit_help').click(function() {
        let type = $('#help_for').val();
        let number = $('#edit_help_number').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/edit_helpline_number') ?>",
            data: {
                "type": type,
                "number": number
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if(response.success){
                    manage_helpline_number();
                    $('#help').modal('hide');
                    toast(response.message, "center");
                }
                else{
                    toast(response.message, "center");
                }
            },
        });
    });

    // ============================================
    $('#delivery_guidelines').click(function(){
        $('.ibox-title').text('Add Delivery Guidelines');
    });

    $('#helpline_number').click(function(){
        $('.ibox-title').text('Manage Helpline Numbers');
    });
</script>