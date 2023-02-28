<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background:transparent">
                    <?php $user = $this->uri->segment(1); ?>
                    <li class="breadcrumb-item"><a href="<?= base_url($user.'/saathi') ?>">Saathi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Documents</li>
                </ol>
            </nav>

            <div class="row align-items-center mb-4">
                <div class="col-md-10 d-flex flex-column ml-3">
                    <strong><span style="color:#898989;"><?= $info[0]->name ?></span></strong>
                    <strong><span style="color:#898989;"><?= $info[0]->email ?></span></strong>
                    <strong><span style="color:#898989;"><?= $info[0]->mobile ?></span></strong>

                    <input type="hidden" value="<?= $user_id ?>" id="user_id">
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-md-10">
                    <?php if (empty($documents)) { ?>
                        <h5 class="text-primary ml-3">Documents Not Available</h5>
                    <?php
                    } 
                    else{?>
                        <h5 class="text-primary ml-3">Documents </h5>
                    <?php
                    }
                    ?>
                    <input type="hidden" value="<?= $user_id ?>" id="user_id">
                </div>
                <!-- <div class="col-md-2">
                    <button id="btn_authenticate" class="btn btn-success float-right" style="display:<?= empty($documents)?"none":""?>">
                        Active Driver
                    </button>
                </div> -->
            </div>

            <div id="accordion">
                <?php
                $baseUrl = apiBaseUrl;

                foreach ($documents as $i => $document) {
                    if (!empty($document)) { ?>
                        <div class="card mb-3">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between" id="<?= $document->name ?>" data-toggle="collapse" data-target=".<?= $document->uid ?>" aria-expanded="false" aria-controls="<?= $document->name ?>" style="cursor:pointer">
                                <h4 class="m-0 p-0 text-primary"><?= ucwords(str_replace('_', ' ', $document->name)) ?></h4>
                                <!-- <?php
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
                                <?php
                                    }
                                }
                                ?> -->
                            </div>
                            <div id="" class="collapse <?= ($i == 0) ? "show" : "" ?> <?= $document->uid ?>" aria-labelledby="<?= $document->name ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <img class="xzoom" src="<?= $baseUrl . $document->assets ?>" xoriginal="<?= $baseUrl . $document->assets ?>" alt="documents">
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
                    width: 40% !important;
                }
            </style>