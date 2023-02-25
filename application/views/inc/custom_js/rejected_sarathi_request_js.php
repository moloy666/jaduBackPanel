<script>
    $(document).ready(function() {
        show_rejected_sarathi_request();
    });

    function show_rejected_sarathi_request() {
        $.ajax({
            type: "GET",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/show_rejected_sarathi_request') ?>",
            error: function() {},
            success: function(response) {
                let data = response.data;
                let details = '';
                $.each(data, function(i, data) {
                    details += `
                        <tr>
                            <td>${i+1}</td>
                            <td>${data.name}</td>
                            <td>${data.email}</td>
                            <td>${data.mobile}</td>
                            <td align="center">
                            <div>
                            <button class="btn btn-primary" onclick="add_to_new_sarathi_list('${data.uid}')">
                                Remove From Reject List
                            </button>
                            </div>
                            </td>
                        </tr>
                    `;
                });
                $('#table_details').html(details);
                $('#table').dataTable();
            }
        });
    }

    var userId = '';

    function add_to_new_sarathi_list(user_id) {
        $('#deltmodl').modal('show');
        userId = user_id;
    }

    $('#btn_remove_from_reject_list').click(function() {
        remove_from_reject_list(userId);
    });

    function remove_from_reject_list(userId) {
        $.ajax({
            type: "GET",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/add_to_new_sarathi_list') ?>?id=" + userId,
            error: function(resp) {
                console.log(resp);
            },
            success: function(resp) {
                if (resp.success) {
                    toast(resp.message, 'centter');
                    show_rejected_sarathi_request();
                    $('#deltmodl').modal('hide');

                    userId = '';

                } else {
                    toast(resp.message, 'centter');
                }
            }
        });
    }
</script>