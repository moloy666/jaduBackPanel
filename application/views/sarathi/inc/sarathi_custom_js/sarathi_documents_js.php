<style>
    .title{
        text-transform:lowercase;
        text-transform: capitalize;
    }
</style>
<script>
    $(document).ready(function() {
        display_sarathi_documents();
    });

    

    function display_sarathi_documents() {
        var baseUrl = '<?= apiBaseUrl ?>';
        $.ajax({
            type: "GET",
            url: "<?= base_url('sarathi/display_sarathi_documents') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                // console.log(response);

                var document = response.data;
                var str = '';
                $.each(document, function(i) {

                    if (document[i].name == "back_with_no_plate") {
                        document[i].name = "backside_with_number_plate";
                    }


                    str += `<div class="card mb-3">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between" id="${document[i].name}" data-toggle="collapse" data-target=".${document[i].name}" aria-expanded="false" aria-controls="${document[i].name}">
                                <h4 class="m-0 p-0 text-primary title">${(document[i].name.replaceAll("_", " "))}</h4>
                            </div>
                            <div id="" class="collapse ${document[i].name}" aria-labelledby="${document[i].name}" data-parent="#accordion">
                                <div class="card-body">
                                    <img class="xzoom" src="${baseUrl}${document[i].assets}" xoriginal="${document[i].assets}" alt="">
                                </div>
                            </div>
                        </div>`;
                });
                $('#accordion').html(str);
            }
        });
    }
</script>
<link type="text/css" rel="stylesheet" media="all" href="https://unpkg.com/xzoom/dist/xzoom.css" />
<script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            //Multiple Zooms on one page
            $('.xzoom').each(function() {
                var instance = $(this).xzoom(); //<-- Don't forget to add your options here
                $('.xzoom-gallery', $(this).parent()).each(function() {
                    instance.xappend($(this));
                });
            });
        });
    })(jQuery);
</script>
<style>
    .xzoom {
        width: 50%;
    }
</style>