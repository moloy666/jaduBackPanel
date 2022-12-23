<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h3>Unresolve Reports</h3>
                    <input type="hidden" value="<?=$specific_id?>" id="specific_id">
                </div>
            </div>

            <div class="card py-2">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>                
                                <th class="text-center">Driver</th>
                                <th class="text-center">Sarathi</th>
                                <th class="text-center">Message</th>     
                                <th class="text-center">Action</th>    
                               
                            </tr>
                        </thead>
                        <tbody class="text-center" id="table_details">

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT-->

    </div>
    </div>
    
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->

    <!-- comment modal  -->

    <div class="modal fade cmtmodal" id="cmtmodal" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="comment_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" id="feedback_id"  placeholder="id">
                                <input class="form-control" type="hidden" id="status" placeholder="status">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="comment" class="form-control" cols="30" rows="10" name="comment" placeholder="Leave a comment"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" id="close_edit_modal">Cancle</button>
                    <button class="btn btn-success" id="btn_submit_comment">Resolve</button>
                </div>
            </div>
            
        </div>
    </div>
</div>