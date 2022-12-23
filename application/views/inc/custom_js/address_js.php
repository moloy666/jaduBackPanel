<script>
    $('#btn_search').click(function(){
        let mobile = $('#mobile').val();
        $.ajax({
            type:"POST",
            url:"<?=base_url('admin/display_address_by_mobile')?>",
            data:{
                "mobile":mobile
            },
            error:function(response){
                console.log(response);
            },
            success:function(response){
                console.log(response);
            }
        });
        
    });
</script>