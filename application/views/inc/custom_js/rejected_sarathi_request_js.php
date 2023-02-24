<script>
    $('#sarathi_page').addClass('active');
    show_rejected_sarathi_request();
    function show_rejected_sarathi_request(){
        $.ajax({
            type:"GET",
            url:"<?=base_url(WEB_PORTAL_ADMIN.'/show_rejected_sarathi_request')?>",
            error:function(){},
            success:function(response){
                console.log(response);
                let data = response.data;
                let details='';
                $.each(data, function(i, data){
                    details+=`
                        <tr>
                            <td>${i+1}</td>
                            <td>${data.name}</td>
                            <td>${data.mobile}</td>
                            <td>${data.email}</td>
                            <td>
                            <button class="btn btn-primary">
                                Add To New Request List
                            </button>
                            </td>
                        </tr>
                    `;
                });
                $('#table_details').html(details);
                $('#table').dataTable();
            }
        });
    }
</script>