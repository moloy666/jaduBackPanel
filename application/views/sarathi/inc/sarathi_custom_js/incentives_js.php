<style>
    .title {
        text-transform: capitalize;
    }
</style>
<script>
    display_incentives_scheme();

    function display_incentives_time_list(incentives_id, time) {

        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_incentives_time_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                let data = response.data;
                let details = '<option>Select Timespan</option>';
                let modal_details = '<option>Select Timespan</option>';
                $.each(data, function(i, data) {
                    if (data.uid == time) {
                        var selected = "selected";
                    } else {
                        selected = "";
                    }
                    details += `
                    <option ${selected} class="title" value="${data.uid}">${data.name}</option>
                    `;

                    modal_details += `
                    <option class="title" value="${data.uid}">${data.name}</option>
                    `;
                });
                $('#time_' + incentives_id).html(details);

                $('#add_time_list').html(modal_details);
            }
        });
    }

    function display_incentives_scheme() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_incentives_scheme') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                var data = response.data;
                var details = '';

                $('#incentives').html('');
                $.each(data, function(i, data) {
                    if (data.status == "ACTIVE") {
                        var checked = "checked";
                    }
                    details = `
                    <div class="card p-1 mb-2">
                    <div class="card-body">
                        <div class="column">
                            <div class="row mb-2">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <h5>Scheme : ${data.name}</h5>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-1 ">
                                    <div class="form-group float-right">
                                        <label for="status_${data.uid}" class="switch">
                                            <input type="checkbox" class="access_status_change" id="status_${data.uid}" onclick="change_status(this, '${data.uid}')" ${checked} disabled>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <strong class="mx-2">KM</strong>
                                        <input type="text" class="form-control" placeholder="KM" style="height:40px" value="${data.value}" id="value_${data.uid}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <strong class="mx-2">Time</strong>
                                        <select name="" id="time_${data.uid}" class="form-control title incentives_time">
                                            <option value="${data.time}" class="title">${data.time.replace("_", " ")}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <strong class="mx-2">Amount</strong>
                                        <input type="text" class="form-control" placeholder="Amount" style="height:40px" value="${data.amount}" id="amount_${data.uid}">
                                    </div>
                                </div>

                                <div class="col-lg-2 pl-0">
                                    <div class="form-group">
                                        <button class="btn btn-primary mt-4 mr-2 access_update" onclick="edit_scheme(this, '${data.uid}')" data-toggle="modal" data-target="#update" disabled>Save</button>

                                        <button class="btn btn-danger scheme_delete_btn mt-4 mr-2 access_delete" onclick="delete_scheme(this, '${data.uid}')" data-toggle="modal" data-target="#deleteModal" disabled>Delete</button>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                    `;
                    $('#incentives').append(details);
                    display_incentives_time_list(data.uid, data.time);
                    get_panel_access_list();
                });
            }
        });
    }

    function get_panel_access_list() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_SARATHI.'/get_panel_access_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                let permission = response.data.permission;
                let data = permission.split(",");
                $.each(data, function(i) {

                    $('.' + data[i]).removeAttr('disabled');
                    // console.log(data[i]);
                });
            }
        });
    }

    function edit_scheme(element, scheme_id) {

        let value = $('#value_' + scheme_id).val();
        let time = $('#time_' + scheme_id).val();
        let amount = $('#amount_' + scheme_id).val();

        $('#update_id').val(scheme_id);
        $('#update_value').val(value);
        $('#update_time').val(time);
        $('#update_amount').val(amount);
    }

    $('#btn_update_scheme').click(function() {
        let scheme_id = $('#update_id').val();
        let value = $('#update_value').val();
        let time = $('#update_time').val();
        let amount = $('#update_amount').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/update_incentive_scheme_details') ?>",
            data: {
                "id": scheme_id,
                "value": value,
                "time": time,
                "amount": amount,
                "specific_id":$('#specific_id').val(),
                "table":$('#specific_table').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    toast(response.message, "center");
                    $('#update').modal('hide');
                    $('#update_id').val('');
                    $('#update_value').val('');
                    $('#update_time').val('');
                    $('#update_amount').val('');
                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    function change_status(state, scheme_id) {
        if (state.checked == true) {
            $.ajax({
                url: "<?= base_url('administrator/active_incentive_scheme') ?>",
                type: "post",
                data: {
                    "id": scheme_id,
                    "specific_id":$('#specific_id').val(),
                    "table":$('#specific_table').val()
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
                url: "<?= base_url('administrator/deactive_incentive_scheme') ?>",
                type: "post",
                data: {
                    "id": scheme_id,
                    "specific_id":$('#specific_id').val(),
                    "table":$('#specific_table').val()
                },
                error: function(data) {
                    alert(JSON.stringify(data));
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

    $('#btn_add_scheme').click(function() {
        let name = $('#add_name').val();
        let value = $('#add_value').val();
        let amount = $('#add_amount').val();
        let time = $('#add_time_list').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/add_incentives_scheme') ?>",
            data: {
                "name": name,
                "value": value,
                "amount": amount,
                "time": time,
                "specific_id":$('#specific_id').val(),
                "table":$('#specific_table').val()
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    toast(response.message, "center");
                    $('#addModal').modal('hide');
                    display_incentives_scheme();
                } else {
                    toast(response.message, "center");
                }
            }
        });
    });

    function delete_scheme(element, scheme_id){
        $('#delete_id').val(scheme_id);
    }

    $('#btn_delete_scheme').click(function(){
        let scheme_id=$('#delete_id').val();
        $.ajax({
            type:"POST",
            url:"<?=base_url('administrator/delete_incentives_scheme')?>",
            data:{
                "id":scheme_id
            },
            error:function(response){
                console.log(response);
            },
            success:function(response){
                console.log(response);
                if(response.success){
                    $('#incentives').html('');
                    display_incentives_scheme();
                    $('#deleteModal').modal('hide');
                    toast(response.message, "center");
                }
                else{
                    toast(response.message, "center");
                }
            }
        });
    });

    function get_panel_access_list() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_SARATHI.'/get_panel_access_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                let permission = response.data.permission;
                let data = permission.split(",");
                $.each(data, function(i) {

                    $('.' + data[i]).removeAttr('disabled');
                    // console.log(data[i]);
                });
            }
        });
    }
</script>