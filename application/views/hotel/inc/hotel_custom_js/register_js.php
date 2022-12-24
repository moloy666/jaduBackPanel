<script>
    $('#register_form').submit(function(e) {
        e.preventDefault();
        let form = document.getElementById('register_form');
        let formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?= base_url(WEB_PORTAL_HOTEL . '/register_details') ?>",
            data: formData,
            contentType: false,
            processData: false,
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    toast(response.message, 'right');
                    $('#message').text('Use Mobile Number As Default Password');

                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 2000);

                } else {
                    toast(response.message, 'right');
                }
            }
        });
    });
</script>