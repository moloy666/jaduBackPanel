<style>
    .title{
        text-transform: capitalize;
    }
</style>
<script>
    $(document).ready(function(){
        display_feedback();
    });

    function display_feedback(){
        $.ajax({
            type:"POST",
            url:"<?=base_url('administrator/display_feedback')?>",
            data:{"specific_id":$('#specific_id').val()},
            error:function(response){
                console.log(response);
            },
            success:function(response){
                if(response.success){
                    
                    var feedback = response.data;
                    var str ='';
                    $.each(feedback, function(i){
                        if(feedback[i].rating > 3){
                            feedback[i].status = '';
                        }
                        str+=`<tr>
                        <td class="title">${feedback[i].driver.name}</td>
                        <td class="title">${feedback[i].sarathi.name}</td>
                        <td>${feedback[i].message}</td>
                        <td>${feedback[i].rating}</td>
                        <td>${feedback[i].status}</td>
                        
                        </tr>`
                    });
                    $('#table_details').html(str);
                    $('#table').dataTable();
                }
                else{
                    console.log(response);
                }
            },
        })
    }

 
</script>