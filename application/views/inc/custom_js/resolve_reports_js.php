<script>
    $(document).ready(function() {
        display_reports();
    });

    function display_reports() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/display_resolved_reports') ?>",
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                  
                    var reports = response.data;
                    var str = '';
                    $.each(reports, function(i) {
                        if (reports[i].rating > 3) {
                            reports[i].status = '';
                        }
                        str += `<tr>
                        <td>${reports[i].driver.name}</td>
                        <td>${reports[i].sarathi.name}</td>
                        <td>${reports[i].message}</td>                       
                        
                        </tr>`
                    });
                    $('#table_details').html(str);
                    $('#table').dataTable();
                } else {
                    console.log(response);
                }
            },
        });
    }

    $('#table_details').on('change', '.changeStatus', function() {
        var id = $(this).attr('data');
        var status_value = $(this).val();
        console.log(status_value);

        $.ajax({
            type: "POST",
            url: "<?= base_url('administrator/change_report_status') ?>",
            data: {
                "id": id,
                "value": status_value
            },
            error: function(response) {
                console.log(response);
            },
            success: function(response) {
                if (response.success) {
                    console.log(response);
                    toast(response.message);
                    
                } else {
                    console.log(response);
                    toast(response.message);
                }
            },
        });
    });

    // <td>
    //     <div>
    //         <div class="form-group">
    //             <select name="for" class="form-control p-0 changeStatus" data="${reports[i].feedbackId}">
    //                 <option value="">Change Status</option>
    //                 <option value="unresolved">Unresolved</option>
    //                 <option value="resolved">Resolved</option>
    //             </select>
    //         </div>
    //     </div>
    // </td> 
</script>