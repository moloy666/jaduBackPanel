<script>
    display_new_sarathi();

    function display_new_sarathi() {
        $.ajax({
            type: "GET",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/show_new_sarathi_request') ?>",
            error: function(resp) {
                console.log(resp);
            },
            success: function(resp) {
                // console.log(resp);
                if (resp.success) {
                    let data = resp.data;
                    let details = '';
                    $.each(data, function(i, data) {
                        if(data.district_id) {
                            var onclick_func = `show_subfranchise_by_district_id('${data.district_id}', '${data.uid}')`;
                        }
                        else{
                            var onclick_func = `show_subfranchise_by_district_id('', '${data.uid}')`;
                        }

                        details += `
                                <tr>
                                <td class="text-center">${i+1}</td>
                                <td class="text-center uppercase">${data.name}</td>
                                <td class="text-center">${data.email}</td>
                                <td class="text-center">${data.mobile}</td>
                                <td class="text-center">
                                <button class="btn btn-success" onclick="${onclick_func}">
                                    Allocate Subfranchise</button>
                                </td>
                                </tr>
                        `
                    });
                    $('#table_details').html(details);
                    $('#table').dataTable();
                }

            }
        });
    }

    function show_subfranchise_by_district_id(district_id, sarathi_id) {
        let specific_id = $('#specific_id').val();
        $('#sarathi_id').val(sarathi_id);
        $('#sfmodal').modal('show');
        $.ajax({
            type: "POST",
            url: `<?= base_url(WEB_PORTAL_ADMIN . '/show_subfranchise_by_district_id') ?>`,
            data: {
                "id": district_id,
                "specific_id":specific_id
            },
            error: function(resp) {
                console.log(resp);
            },
            success: function(resp) {
                // console.log(resp);
                if (resp.success) {
                    let data = resp.data;
                    let details = '<option value="">Select Subfranchise</option>';
                    $.each(data, function(i, data) {
                        details += `
                    <option value="${data.sf_id}">${data.name}</option>
                    `;
                    });
                    $('#subfranchise').html(details);
                }
                else{
                    let details = '<option value="">Subfranchise Not Found</option>';
                    $('#subfranchise').html(details);
                }

            }
        });
    }

    $('#btn_allocate').click(function() {
        allowcate_subfranchise_to_sarathi();
    });

    function allowcate_subfranchise_to_sarathi() {
        let sf_id = $('#subfranchise').val();
        let sarathi_id = $('#sarathi_id').val();
        console.log(sf_id, sarathi_id);
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/allocate_subfranchise_to_sarathi') ?>",
            data: {
                "id": sarathi_id,
                "sf_id": sf_id
            },
            error: function(resp) {
                console.log(resp);
            },
            success: function(resp) {
                if (resp.success) {
                    display_new_sarathi();
                    toast(resp.message, 'center');
                    $('#sarathi_id').val('');
                    $('#sfmodal').modal('hide');
                } else {
                    toast(resp.message, 'center');
                }

            }
        });
    }
</script>