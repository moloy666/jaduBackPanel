<script>
    show_driver_without_recharge_ride_history();

    function show_driver_without_recharge_ride_history() {
        $.ajax({
            type: "GET",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/show_driver_without_recharge_ride_history') ?>",
            beforeSend: function() {
                $('#table_details').html('<tr><td class="text-center" colspan="6">Loading...</td></tr>');
            },
            error: function(resp) {
                console.log(resp);
            },
            success: function(resp) {

                // console.log(resp);
                let data = resp.data;
                let details = '';
                let count = 0;
                $.each(data, function(i, data) {
                    count++;
                    details += `
                    <tr>
                        <td>${count}</td>
                        <td class="uppercase">${data.name}</td>
                        <td>${data.email}</td>
                        <td>${data.mobile}</td>
                        <td class="uppercase">${data.sarathi}</td>
                        <td>
                        <button class="btn btn-primary" onclick="Show_sarathi_list('${data.uid}' ,'${data.district_id}')">Reassign Driver</button>
                        </td>
                    </tr>
                    `;
                })
                $('#table_details').html(details);
                $('#table').dataTable();
            }
        })
    }

    var driverId = '';

    function Show_sarathi_list(user_id, district_id) {
        driverId = user_id;
        // console.log(district_id);
        $('#reasgnmodal').modal('show');
        $.ajax({
            type: "GET",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/show_sarathi_list_by_district_id') ?>?id=" + district_id,
            error: function(resp) {},
            success: function(resp) {
                if (resp.success) {
                    let data = resp.data;
                    let details = '<option value="">Select New Saathi For Driver</option>';
                    $.each(data, function(i, data) {
                        details += `<option value="${data.sarathi_id}" class="uppercase">${data.name}</option>`
                    });
                    $('#sarathi_list').html(details);
                }
                else{
                    let details = '<option value="">Saathi not available in this district</option>';
                    $('#sarathi_list').html(details);
                }

            }
        });
    }

    $('#btn_change_saathi').click(function() {
        let sarathi_id = $('#sarathi_list').val();
        // console.log(sarathi_id, driverId);
        $.ajax({
            type: "GET",
            url: `<?= base_url(WEB_PORTAL_ADMIN . '/reassign_driver_to_new_sarathi') ?>?id=${driverId}&sarathi_id=${sarathi_id}`,
            error: function(resp) {},
            success: function(resp) {
                console.log(resp);
                if (resp.success) {
                    $('#reasgnmodal').modal('hide');
                    toast(resp.message, 'center');
                    show_driver_without_recharge_ride_history();
                } else {
                    toast(resp.message, 'center');
                }
            }
        });
    });
</script>