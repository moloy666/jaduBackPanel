<style>
    .title {
        text-transform: uppercase;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-3">
                <div class="col-md-8">
                    <ol class="breadcrumb" style="background-color:transparent;">
                        <li class="breadcrumb-item"><a href=<?= base_url("administrator/admin") ?>>Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>

            <div class="ml-2 mb-3">
                <h5 class="title text-primary"><?= $details['name'] ?></h5>
                <h6 class="text-primary"><?= $details['mobile'] ?></h6>
                <h6 class="text-primary"><?= $details['email'] ?></h6>
            </div>



            <div class="mt-4" id="accordionExample" style="cursor:pointer">
                <div class="card">
                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong class="text-primary">Access List</strong>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Permission</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center" id="table_details">
                                        <?php
                                        if (!empty($data)) {

                                            foreach ($data as $i => $value) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $i + 1 ?></td>
                                                    <td class="text-center"><?= ucwords($value['name']) ?></td>
                                                    <td class="text-center" id="status_<?= strtoupper($value['request_id']) ?>"><?= strtoupper($value['status']) ?></td>
                                                    <td class="text-center">
                                                        <div class="flex justify-content-center">

                                                            <button class="btn btn-primary mr-2 <?= strtoupper($value['status']) == const_active ? "btn-success" : "" ?>" id="allow_<?= strtoupper($value['request_id']) ?>" onclick="allow_request(this, '<?= strtoupper($value['user_id']) ?>', '<?= strtoupper($value['request_id']) ?>')" <?= strtoupper($value['status']) == const_active ? "disabled" : "" ?>>Allow</button>

                                                            <button class="btn btn-danger" id="deny_<?= strtoupper($value['request_id']) ?>" onclick="deny_request(this, '<?= strtoupper($value['user_id']) ?>' , '<?= strtoupper($value['request_id']) ?>')" <?= strtoupper($value['status']) == const_deactive ? "disabled" : "" ?>>Deny</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='4' class='text-center'> Don't Have Access For Any Permission </td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>





            <!-- <div class="card p-2">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Permission</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">
                            <?php
                            if (!empty($data)) {

                                foreach ($data as $i => $value) { ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?></td>
                                        <td class="text-center"><?= ucwords($value['name']) ?></td>
                                        <td class="text-center" id="status_<?= strtoupper($value['request_id']) ?>"><?= strtoupper($value['status']) ?></td>
                                        <td class="text-center">
                                            <div class="flex justify-content-center">

                                                <button class="btn btn-primary mr-2 <?= strtoupper($value['status']) == const_active ? "btn-success" : "" ?>" id="allow_<?= strtoupper($value['request_id']) ?>" onclick="allow_request(this, '<?= strtoupper($value['user_id']) ?>', '<?= strtoupper($value['request_id']) ?>')" <?= strtoupper($value['status']) == const_active ? "disabled" : "" ?>>Allow</button>

                                                <button class="btn btn-danger" id="deny_<?= strtoupper($value['request_id']) ?>" onclick="deny_request(this, '<?= strtoupper($value['user_id']) ?>' , '<?= strtoupper($value['request_id']) ?>')" <?= strtoupper($value['status']) == const_deactive ? "disabled" : "" ?>>Deny</button>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'> Don't Have Access For Any Permission </td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div> -->


            <div id="message"></div>

        </div>
        <!-- END PAGE CONTENT-->

    </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->

    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->


    <script>
        $('#admin_page').addClass('active');

        function allow_request(e, user_id, request_id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/allow_permission_request') ?>",
                data: {
                    "user_id": user_id,
                    "request_id": request_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    if (response.success) {
                        toast(response.message, "center");
                        $('#allow_' + request_id).attr('disabled', 'disabled');
                        $('#allow_' + request_id).addClass('btn-success');
                        $('#status_' + request_id).text('ACTIVE');
                    } else {
                        toast(response.message, "center");
                    }
                }
            });
        }

        function deny_request(e, user_id, request_id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('administrator/deny_permission_request') ?>",
                data: {
                    "user_id": user_id,
                    "request_id": request_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    if (response.success) {
                        toast(response.message, "center");
                        $('#deny_' + user_id).attr('disabled', 'disabled');
                        $('#allow_' + user_id).removeAttr('disabled');
                        $('#status_' + user_id).text('DEACTIVE');

                        display_request_permission_of_admin(user_id);
                    } else {
                        toast(response.message, "center");
                    }
                }
            });
        }

        function display_request_permission_of_admin(user_id) {
            $.ajax({
                type: "post",
                url: "<?= base_url('administrator/display_request_permission_of_admin') ?>",
                data: {
                    "user_id": user_id
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    console.log(response);
                    let data = response.data;
                    let details = '';
                    $.each(data, function(i, data) {
                        let status = '';
                        if (data.status == "ACTIVE") status = 'disabled';
                        details += `
                        <tr>
                            <td class="text-center">${i+1}</td>
                            <td class="text-center title">${data.name}</td>
                            <td class="text-center" id="status_${data.user_id}">${data.status}</td>
                            <td class="text-center">
                                <div class="flex justify-content-center">

                                    <button class="btn btn-primary mr-2" id="allow_${data.user_id}" onclick="allow_request(this, '${data.user_id}', '${data.request_id}')" ${status}>Allow</button>

                                    <button class="btn btn-danger" id="deny_${data.user_id}" onclick="deny_request(this, '${data.user_id}' , '${data.request_id}')">Deny</button>
                                </div>
                            </td>
                        </tr>
                        `;
                    });

                    $('#table_details').html(details);


                }
            });
        }
    </script>