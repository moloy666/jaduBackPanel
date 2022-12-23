<script>
    // var more_details = CKEDITOR.instances["more_details"].getData();

    $('#btn_save_delivery_guide').click(function(){
        var guideline = CKEDITOR.instances["delivery_guide"].getData();
       
        $.ajax({
            type:"post",
            url:"<?=base_url('administrator/save_delivery_guideline')?>",
            data:{
                "guide":guideline
            },
            error:function(response){
                console.log(response);
            },
            success:function(response){
               
                if(response.success){
                    toast(response.message, "center");
                }
                else{
                    toast(response.message, "center");
                }
            }
        });
    });

    // display_delivery_guideline();

    // function display_delivery_guideline(){
    //     $.ajax({
    //         type:"GET",
    //         url:"<?=base_url('administrator/display_delivery_guideline')?>",
    //         error:function(response){
    //             console.log(response);
    //         },
    //         success:function(response){
    //             console.log(response);
    //             let data=response.data;
                
    //             $('#delivery_guide').text(data);

    //             // CKEDITOR.instances['delivery_guide'].setData(data.value);

    //         }
    //     });
    // }
</script>