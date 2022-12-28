<script type="text/javascript">
    
    $('#recharge_page').addClass('active');

    

    // url: `https://jaduridedev.v-xplore.com/sarathi/users/${sarathi_id}/recharge/history`,

    $(document).ready(function() {
        var sarathi_id = $('#sarathi_id').val();
        $.ajax({
            type: "get",
            url: `<?= apiBaseUrl ?>sarathi/users/${sarathi_id}/recharge/history`,
            headers: {
                'x-api-key': '<?=const_x_api_key?>',
                'platform': 'web',
                'deviceid': ''
            },

            success: function(response) {
                console.log(response);
                let recharge_details = response.data;
                let recharge_history = '';
                $.each(recharge_details, function(i) {
                 
                    recharge_history += `<tr>
                        <td>${i+1}</td>
                        <td>${recharge_details[i].rechargeType}</td>
                        <td>${recharge_details[i].price}</td>                      
                        <td>${recharge_details[i].purchesedKm}</td>                      
                        <td>${recharge_details[i].description}</td>                      
                        <td>${recharge_details[i].date}</td>                                        
                        </tr>`;
                });
                $('#recharge_history').html(recharge_history);
                $("#table_recharge_history").dataTable();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });


 
</script>