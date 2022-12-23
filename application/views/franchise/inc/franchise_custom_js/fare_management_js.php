<style>
    .title{
        text-transform: capitalize;
    }
</style>
<script>
    $(document).ready(function() {
        display_fare_list();

        $('#fare_list_page').addClass('active');

    });


    function display_fare_list() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_fare_list') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                var data = response.data;
                var str = '';
                $.each(data, function(i, details) {

                    str += `<tr>
                    <td>${i+1}</td>
                    <td class="title">${details.vehicle_type}</td>

                    <td>
                    <input type="text" value="${details.base_fare}" class="form-control fare ${details.uid}" id="updated_base_fare_${details.uid}" disabled>
                    <input type="hidden" value="${details.base_fare}" class="form-control ${details.uid}" id="base_fare_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.slab_1}" class="form-control fare ${details.uid}" id="updated_slab_1_${details.uid}" disabled>
                    <input type="hidden" value="${details.slab_1}" class="form-control fare ${details.uid}" id="slab_1_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.slab_2}" class="form-control fare ${details.uid}" id="updated_slab_2_${details.uid}" disabled>
                    <input type="hidden" value="${details.slab_2}" class="form-control fare ${details.uid}" id="slab_2_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.slab_3}" class="form-control fare ${details.uid}" id="updated_slab_3_${details.uid}" disabled>
                    <input type="hidden" value="${details.slab_3}" class="form-control fare ${details.uid}" id="slab_3_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.slab_4}" class="form-control fare ${details.uid}" id="updated_slab_4_${details.uid}" disabled>
                    <input type="hidden" value="${details.slab_4}" class="form-control fare ${details.uid}" id="slab_4_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.per_minute}" class="form-control fare ${details.uid}" id="updated_per_minute_${details.uid}" disabled>
                    <input type="hidden" value="${details.per_minute}" class="form-control fare ${details.uid}" id="per_minute_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.extra_time_fare}" class="form-control fare ${details.uid}" id="updated_extra_time_fare_${details.uid}" disabled>
                    <input type="hidden" value="${details.extra_time_fare}" class="form-control fare ${details.uid}" id="extra_time_fare_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.arriving_free_km}" class="form-control fare ${details.uid}" id="updated_arriving_free_km_${details.uid}" disabled>
                    <input type="hidden" value="${details.arriving_free_km}" class="form-control fare ${details.uid}" id="arriving_free_km_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.arriving_fare}" class="form-control fare ${details.uid}" id="updated_arriving_fare_${details.uid}" disabled>
                    <input type="hidden" value="${details.arriving_fare}" class="form-control fare ${details.uid}" id="arriving_fare_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.airport_fare}" class="form-control fare ${details.uid}" id="updated_airport_fare_${details.uid}" disabled>
                    <input type="hidden" value="${details.airport_fare}" class="form-control fare ${details.uid}" id="airport_fare_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.night}" class="form-control fare ${details.uid}" id="updated_night_${details.uid}" disabled>
                    <input type="hidden" value="${details.night}" class="form-control fare ${details.uid}" id="night_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.cancle_fee}" class="form-control fare ${details.uid}" id="updated_cancle_fee_${details.uid}" disabled>
                    <input type="hidden" value="${details.cancle_fee}" class="form-control fare ${details.uid}" id="cancle_fee_${details.uid}" disabled>
                    </td>

                    <td>
                    <input type="text" value="${details.jadu_fee}" class="form-control fare ${details.uid}" id="updated_jadu_fee_${details.uid}" disabled>
                    <input type="hidden" value="${details.jadu_fee}" class="form-control fare ${details.uid}" id="jadu_fee_${details.uid}" disabled>
                    </td>
                  
                    <td>
                        <button class="btn btn-primary edit edit_btn_${details.uid} access_update" data="${details.uid}" id="edit_btn_${details.uid}" disabled>
                            <i class="sidebar-item-icon fa fa-file-text-o"></i>
                        </button>
                        <button class="btn btn-primary save save_btn_${details.uid}" data="${details.uid}" id="save_btn_${details.uid}" style="display:none">
                            save
                        </button>
                    </td>
                    </tr>`;
                });

                $('#table_details').html(str);
                $('#table').dataTable();

                $('.fare').attr("disabled", 'disabled');
                $('.save').hide();

                get_panel_access_list();

            },

        });
    }

    function get_panel_access_list() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_FRANCHISE.'/get_panel_access_list') ?>",
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



    $('#table_details').on('click', '.edit', function() {  // enable textbox
        let vehicle_id = $(this).attr('data');

        if ($('.' + vehicle_id).attr("disabled", true)) {

            $('.' + vehicle_id).attr("disabled", false);

            $('.save_btn_' + vehicle_id).show();

            $('.edit_btn_' + vehicle_id).hide();
        }

    });

    $('#table_details').on('click', '.save', function() { // for update 
        let vehicle_id = $(this).attr('data');

        var updateData = {};

        let base_fare = $('#base_fare_' + vehicle_id).val();
        let updated_base_fare = $('#updated_base_fare_' + vehicle_id).val();

        let slab_1 = $('#slab_1_' + vehicle_id).val();
        let updated_slab_1 = $('#updated_slab_1_' + vehicle_id).val();

        let slab_2 = $('#slab_2_' + vehicle_id).val();
        let updated_slab_2 = $('#updated_slab_2_' + vehicle_id).val();

        let slab_3 = $('#slab_3_' + vehicle_id).val();
        let updated_slab_3 = $('#updated_slab_3_' + vehicle_id).val();

        let slab_4 = $('#slab_4_' + vehicle_id).val();
        let updated_slab_4 = $('#updated_slab_4_' + vehicle_id).val();

        let per_minute = $('#per_minute_' + vehicle_id).val();
        let updated_per_minute = $('#updated_per_minute_' + vehicle_id).val();

        let extra_time_fare = $('#extra_time_fare_' + vehicle_id).val();
        let updated_extra_time_fare = $('#updated_extra_time_fare_' + vehicle_id).val();

        let arriving_free_km = $('#arriving_free_km_' + vehicle_id).val();
        let updated_arriving_free_km = $('#updated_arriving_free_km_' + vehicle_id).val();

        let arriving_fare = $('#arriving_fare_' + vehicle_id).val();
        let updated_arriving_fare = $('#updated_arriving_fare_' + vehicle_id).val();

        let airport_fare = $('#airport_fare_' + vehicle_id).val();
        let updated_airport_fare = $('#updated_airport_fare_' + vehicle_id).val();

        let night = $('#night_' + vehicle_id).val();
        let updated_night = $('#updated_night_' + vehicle_id).val();

        let cancle_fee = $('#cancle_fee_' + vehicle_id).val();
        let updated_cancle_fee = $('#updated_cancle_fee_' + vehicle_id).val();

        let jadu_fee = $('#jadu_fee_' + vehicle_id).val();
        let updated_jadu_fee = $('#updated_jadu_fee_' + vehicle_id).val();


        if (base_fare != updated_base_fare) {
            updateData.base_fare = updated_base_fare
        }

        if (slab_1 != updated_slab_1) {
            updateData.slab_1 = updated_slab_1
        }

        if (slab_2 != updated_slab_2) {
            updateData.slab_2 = updated_slab_2
        }

        if (slab_3 != updated_slab_3) {
            updateData.slab_3 = updated_slab_3
        }

        if (slab_4 != updated_slab_4) {
            updateData.slab_4 = updated_slab_4
        }

        if (per_minute != updated_per_minute) {
            updateData.per_minute = updated_per_minute
        }

        if (extra_time_fare != updated_extra_time_fare) {
            updateData.extra_time_fare = updated_extra_time_fare
        }

        if (arriving_free_km != updated_arriving_free_km) {
            updateData.arriving_free_km = updated_arriving_free_km
        }

        if (arriving_fare != updated_arriving_fare) {
            updateData.arriving_fare = updated_arriving_fare
        }

        if (airport_fare != updated_airport_fare) {
            updateData.airport_fare = updated_airport_fare
        }

        if (night != updated_night) {
            updateData.night = updated_night
        }

        if (cancle_fee != updated_cancle_fee) {
            updateData.cancle_fee = updated_cancle_fee
        }

        if (jadu_fee != updated_jadu_fee) {
            updateData.jadu_fee = updated_jadu_fee
        }

        if (Object.keys(updateData).length == 0) {
            toast("No changes detucted");
            $('.save_btn_' + vehicle_id).hide();
            $('.edit_btn_' + vehicle_id).show();
            $('.' + vehicle_id).attr("disabled", true);

        } else {
            console.log(updateData);
            $.ajax({
                type: "POST",
                url: "<?= base_url('Admin/update_fare_price') ?>",
                data: {
                    "id": vehicle_id,
                    "data": JSON.stringify(updateData),
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    if (response.success) {
                        toast(response.message);
                        display_fare_list();
                        $('.save_btn_' + vehicle_id).hide();
                        $('.edit_btn_' + vehicle_id).show();
                        $('.' + vehicle_id).attr("disabled", true);
                    } else {
                        toast(response.message);
                        $('.save_btn_' + vehicle_id).hide();
                        $('.edit_btn_' + vehicle_id).show();
                    }
                },
            });
        }
    });
</script>