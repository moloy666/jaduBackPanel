<script>
    show_driver_without_recharge_ride_history();

    function show_driver_without_recharge_ride_history() {
        $.ajax({
            type: "GET",
            url: "<?= base_url(WEB_PORTAL_ADMIN . '/show_driver_without_recharge_ride_history') ?>",
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
                        <td>${data.sarathi}</td>
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
    function Show_sarathi_list(user_id, district_id){
        driverId = user_id;
        $('#reasgnmodal').modal('show');
        $.ajax({
            type:"GET",
            url:"<?=base_url(WEB_PORTAL_ADMIN.'/show_sarathi_list_by_district_id')?>?id="+district_id,
            error:function(resp){},
            success:function(resp){
                let data = resp.data;
                let details = '<option value="">Select New Saathi For Driver</option>';
                $.each(data, function(i, data){
                    details+=`<option value="${data.sarathi_id}" class="uppercase">${data.name}</option>`
                });
                $('#sarathi_list').html(details);
            }
        });
    }

    $('#btn_change_saathi').click(function(){
        let sarathi_id = $('#sarathi_list').val();
        console.log(driverId, sarathi_id);

    });


    
</script>