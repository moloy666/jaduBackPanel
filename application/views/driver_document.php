<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background:transparent">
                    <?php $base_link = $this->uri->segment(1);?>
                    <li class="breadcrumb-item"><a href="<?= base_url($base_link.'/driver') ?>">Driver</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Documents</li>
                </ol>
            </nav>

            <div class="row align-items-center mb-4">
                <div class="col-md-10 d-flex flex-column ml-3">
                    <h5 class="text-primary">Driver Information</h5>
                    <strong><span style="color:#898989;"><?= $info[0]->name ?></span></strong>
                    <strong><span style="color:#898989;"><?= $info[0]->email ?></span></strong>
                    <strong><span style="color:#898989;"><?= $info[0]->mobile ?></span></strong>

                    <input type="hidden" value="<?= $user_id ?>" id="user_id">
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-md-10">
                    <?php if (empty($documents)) { ?>
                        <h5 class="text-primary ml-3">Driver Documents Not Available</h5>
                    <?php
                    } 
                    else{?>
                        <h5 class="text-primary ml-3">Driver Documents </h5>
                    <?php
                    }
                    ?>
                    <input type="hidden" value="<?= $user_id ?>" id="user_id">
                </div>
            </div>

            <div id="accordion">
                <?php
                $baseUrl = apiBaseUrl;

                foreach ($documents as $i => $document) {
                    if (!empty($document)) { ?>
                        <div class="card mb-3">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between" id="<?= $document->name ?>" data-toggle="collapse" data-target=".<?= $document->uid ?>" aria-expanded="false" aria-controls="<?= $document->name ?>" style="cursor:pointer">
                                <h4 class="m-0 p-0 text-primary"><?= ucwords(str_replace('_', ' ', $document->name)) ?></h4>
                                <?php
                                if ($document->verified == 'pending') { ?>
                                    <div class="float-right action_btn<?= $document->uid ?>">
                                        <button class="btn btn-primary mr-3" id="<?= $document->uid ?>" onclick="approved_document(this.id, '<?= $document->name ?>', event)">Approve</button>
                                        <button class="btn btn-danger" id="<?= $document->uid ?>" onclick="deny_document(this.id, '<?= $document->name ?>', event)">Deny</button>
                                    </div>
                                    <?php
                                } else {
                                    if ($document->verified == 'submit') { ?>
                                        <div class="float-right action_btn<?= $document->uid ?>">
                                            <p class="text-success"><b>Approved</b></p>
                                        </div>
                                    <?php
                                    } else { ?>
                                        <div class="float-right action_btn<?= $document->uid ?>">
                                            <p class="text-danger"><b>Denied</b></p>
                                        </div>
                                        <!-- <script>$('#btn_authenticate').hide()</script> -->
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div id="" class="collapse <?= ($i == 0) ? "show" : "" ?> <?= $document->uid ?>" aria-labelledby="<?= $document->name ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <img class="xzoom" src="<?= $baseUrl . $document->assets ?>" xoriginal="<?= $baseUrl . $document->assets ?>" alt="">
                                </div>
                            </div>
                        </div>
                <?php
                    } else {
                    }
                }
                ?>
            </div>
            <div class="sidenav-backdrop backdrop"></div>
            <div class="preloader-backdrop">
                <div class="page-preloader">Loading</div>
            </div>
      
            <script>
                $('#driver_page').addClass('active');
                $('#btn_authenticate').click(function() {
                    let user_id = $('#user_id').val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('administrator/activate_pending_driver') ?>",
                        data: {
                            "id": user_id
                        },
                        error: function(data) {
                            console.log(data);
                        },
                        success: function(data) {
                            // console.log(data);
                            
                            location.href = "<?= base_url('administrator/saathi') ?>";
                        }
                    });
                });

                function approved_document(document_id, document_name, event) {
                    event.stopPropagation();
                    let user_id = $('#user_id').val();
                    if (document_name == 'backside_with_number_plate') {
                        document_name = 'back_with_no_plate';
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('administrator/approved_driver_documents') ?>",
                        data: {
                            "id": user_id,
                            "document_id": document_id,
                        },
                        error: function(data) {
                            console.log(data);
                        },
                        success: function(data) {
                            let document = data.document;
                            if (document == 'back_with_no_plate') {
                                document = 'backside_with_number_plate';
                            }
                            $('.action_btn' + document_id).html('');
                            $('.action_btn' + document_id).html('Approved').addClass('text-success').addClass('font-weight-bold');
                        }
                    });
                }

                function deny_document(document_id, document_name, event) {
                    event.stopPropagation();
                    let user_id = $('#user_id').val();
                    if (document_name == 'backside_with_number_plate') {
                        document_name = 'back_with_no_plate';
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('administrator/deny_driver_documents') ?>",
                        data: {
                            "id": user_id,
                            "document_id": document_id,
                        },
                        error: function(data) {
                            console.log(data);
                        },
                        success: function(data) {
                            
                            // toast(data.message,'center');
                            if (data.success) {
                                let document = data.document;
                                if (document == 'back_with_no_plate') {
                                    document = 'backside_with_number_plate';
                                }
                                $('.action_btn' + document).html('');
                                $('.action_btn' + document).html('Denied').addClass('text-danger').addClass('font-weight-bold');
                                // $('#btn_authenticate').hide();

                            } else {
                                toast(data.message, 'center');
                            }

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
                    width: 40%;
                }
            </style>