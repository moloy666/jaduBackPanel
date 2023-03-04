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
        get_specific_app_version_list('sarathi', 'saathi_table_details');
        get_specific_app_version_list('driver', 'driver_table_details');
        get_specific_app_version_list('customer', 'customer_table_details');

        get_all_app_current_version_list('', 'table_details');
    }

    var customer_link = '';
    var sathi_link = '';
    var driver_link = '';

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

                let data = response.data;
                let details;
                $.each(data, function(i, data) {

                    data.is_skipable = (data.is_skipable == 1) ? true : false;
                    data.version_for = (data.version_for == 'sarathi') ? 'sathi' : data.version_for;
                    details += `
                <tr>
                <td>${i+1}</td>
                <td class="uppercase">${data.version_for} </td>
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

    function get_all_app_current_version_list(for_app, table) {
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
                    sathi_link += (data.version_for == 'sarathi') ? data.play_store_link : "";
                    customer_link += (data.version_for == 'customer') ? data.play_store_link : "";
                    driver_link += (data.version_for == 'driver') ? data.play_store_link : "";

                    data.is_skipable = (data.is_skipable == 1) ? true : false;
                    data.version_for = (data.version_for == 'sarathi') ? 'sathi' : data.version_for;
                    details += `
                <tr>
                <td>${i+1}</td>
                <td class="uppercase">${data.version_for} </td>
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

        if (skipable == "") {
            toast('Select Is Skipable', 'center');
        } else {
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
                        customer_link = '';
                        sathi_link = '';
                        driver_link = '';
                    } else {
                        toast(response.message, 'center');
                    }
                }
            });
        }


    }


    $("#for_app").change(() => {
        let for_app = $('#for_app').val();
        if (for_app == '') {
            $('#link').val('');
        }
        if (for_app == 'sarathi') {
            $('#link').val(sathi_link);
        }
        if (for_app == 'driver') {
            $('#link').val(driver_link);
        }
        if (for_app == 'customer') {
            $('#link').val(customer_link);
        }

    });
</script>