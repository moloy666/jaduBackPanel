<style>
    .title{
        text-transform: capitalize;
    }
</style>
<script>
    $(document).ready(function() {
        display_reports();
        $('#btn_modal').hide();
    });

    function display_reports() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_unresolved_reports') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                var str = '';
                if (response.success) {
                    var reports = response.data;
                    var status = '';
                    $.each(reports, function(i) {

                        str += `<tr>
                        <td class="title">${reports[i].driver.name}</td>
                        <td class="title">${reports[i].sarathi.name}</td>
                        <td>${reports[i].message}</td>
                                                
                        <td>
                        <div>
                            <div class="form-group">
                                <select name="for" class="form-control p-0 title changeStatus access_update" data="${reports[i].feedbackId}" disabled>
                                    <option value="${reports[i].status}">${reports[i].status}</option>                                        
                                    <option value="resolved">Resolved</option>                                        
                                                                      
                                </select>
                            </div>
                        </div>
                        </td>
                        </tr>`
                    });
                    $('#table_details').html(str);
                    $('#table').dataTable();
                    get_panel_access_list();
                } else {
                    $('#table_details').html(str);
                    $('#table').dataTable();
                }
            },
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
                    // console.log(data[i]);
                });
            }
        });
    }

    $('#btn_submit_comment').click(function() {
        let id = $('#feedback_id').val();
        let comment = $('#comment').val();
        let status = $('#status').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/submit_report_comment') ?>",
            data: {
                "id": id,
                "status": status,
                "comment": comment
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    $('#comment_form')[0].reset();
                    $('#cmtmodal').modal('hide');
                    toast(response.message, "center");
                    display_reports();

                } else {
                    // console.log(response);
                    toast(response.message, "center");
                }
            },
        });
    });

    $('#table_details').on('change', '.changeStatus', function() {

        $('#cmtmodal').modal('show');

        var id = $(this).attr('data');
        var value = $(this).val();

        $('#feedback_id').val(id);
        $('#status').val(value);

    });

    $('#cmtmodal').on('hidden.bs.modal', function() {
        $(".changeStatus").prop("selectedIndex", 0);
    });
</script>