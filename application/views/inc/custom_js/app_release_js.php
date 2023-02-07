<style>
    .uppercase {
        text-transform: uppercase;
    }

    .title {
        text-transform: capitalize;
    }
</style>
<script>
    get_all_app_version_list();

    function get_all_app_version_list() {
        get_specific_app_version_list('', 'table_details');
        get_specific_app_version_list('sarathi', 'saathi_table_details');
        get_specific_app_version_list('driver', 'driver_table_details');
        get_specific_app_version_list('customer', 'customer_table_details');
    }

    var customer_link;
    var sathi_link;
    var driver_link;

    function get_specific_app_version_list(for_app, table) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/get_app_version_list') ?>",
            data: {
                'for_app': for_app
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);

                let data = response.data;
                let details;
                $.each(data, function(i, data) {
                    
                    data.is_skipable = (data.is_skipable == 0) ? true : false;
                    data.version_for = (data.version_for == 'sarathi') ? 'sathi' : data.version_for;
                    details += `
                <tr>
                <td>${i+1}</td>
                <td class="title">${data.version_for} </td>
                <td>${data.name}</td>
                <td>${data.code}</td>
                <td class="uppercase">${data.is_skipable}</td>
                </tr>
                `;
                });
                $('#' + table).html(details);
            }
        });
    }


    $('#btn_submit').click(function() {
        save_new_app_version_release();
    });


    function save_new_app_version_release() {
        let for_app = $('#for_app').val();
        let name = $('#name').val();
        let link = $('#link').val();
        let code = $('#code').val();
        let skipable = $('#skipable').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/save_new_app_release') ?>",
            data: {
                "for_app": for_app,
                "name": name,
                "play_store_link": link,
                "code": code,
                "skipable": skipable
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    get_all_app_version_list();
                    $('#add_new_release').modal('hide');
                    toast(response.message, 'center');
                    $('#version_form')[0].reset();
                } else {
                    toast(response.message, 'center');
                }
            }
        });
    }


    $("#for_app").change(() => {
        let for_app = $('#for_app').val();
        

    });
</script>