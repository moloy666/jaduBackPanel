<script>
    display_help_list();

    function display_help_list() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('administrator/display_help_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    let data = response.data;
                    let view = '';

                    $.each(data, function(i, data) {
                        view = `
                    <tr>
                        <td>${i+1}</td>
                        <td class="title">${data.name}</td>
                        <td>${data.email}</td>
                        <td class="title">${data.subject}</td>
                        <td>${data.message}</td>
                        <td>
                            <button class="btn btn-primary access_update" data-toggle="modal" data-target="#resolve_help" onclick="resolve_help(this, '${data.specific_level_user_id}', '${data.uid}')" disabled>Resolve</button>
                        </td>

                    </tr>
                    `;
                        $('#table_details').append(view);
                    });
                    $('#table').dataTable();
                    get_panel_access_list();
                } else {
                    $('#table').dataTable();
                }

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
                    // console.log(data[i]);
                });
            }
        });
    }

    function resolve_help(element, specific_id, uid) {
        $('#specific_id').val(specific_id);
        $('#uid').val(uid);
    }

    $('#btn_resolve').click(function() {
        let uid = $('#uid').val();
        let specific_id = $('#specific_id').val();
        let comment = $('#comment').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/resolve_help') ?>",
            data: {
                "uid": uid,
                "specific_id": specific_id,
                "comment": comment
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    toast(response.message);
                    $('#table_details').html('');
                    display_help_list();
                    $('#resolve_help').modal('hide');

                    $('#comment').val('');

                } else {
                    toast(response.message);
                }
            }
        });
    });
</script>