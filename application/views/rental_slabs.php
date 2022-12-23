<style>
  .title {
    text-transform: capitalize;
  }
</style>

<body>
  <div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
      <div class="row align-items-center mb-4">
        <div class="col-md-8">
          <h3>Rental Slabs</h3>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center justify-content-end">

            <button type="button" class="btn bgred ml-3 btnround access_insert" data-toggle="modal" data-target="#addNewUsr1" id="add_new"  disabled>
              Add New <i class="fa fa-plus ml-2"></i>
            </button>

          </div>
        </div>
      </div>

      <div class="card py-2">
        <div class="table-responsive">
          <table class="table table-bordered" id="table">
            <thead class="thead-light">
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Hour</th>
                <th class="text-center">KM</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
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
  <!-- BEGIN THEME CONFIG PANEL-->

  <!-- END THEME CONFIG PANEL-->
  <!-- BEGIN PAGA BACKDROPS-->
  <div class="sidenav-backdrop backdrop"></div>
  <div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
  </div>
  <!-- END PAGA BACKDROPS-->
  <!-- CORE PLUGINS-->


  <div class="modal fade delemodel" id="deltmodl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content p-4 text-center">
        <h5 class="mb-4">Are you sure want to
          delete this user permanently ?</h5>
        <div class="d-flex align-items-center justify-content-center">
          <button class="btn-secondary btn" data-dismiss="modal" id="close_delete_modal">No</button>
          <button class="btn-success btn ml-3" id="btn_delete_data">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add new user modal -->

  <div class="modal fade custmmodl" id="addNewUsr1" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Slab</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add_data_form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Enter Hour" id='hour' name="" required="required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Enter KM" id='km' name="" required="required">
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_modal">Close</button>
          <button type="submit" class="btn btn-success" id="btn_add_data">Add New Slab</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit user modal -->
  <div class="modal fade custmmodl" id="edtView1" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Slab</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="update_form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="hidden" value="" placeholder="Your Name" id="edit_id">
                  <input class="form-control" type="text" value="Ramesh janha" placeholder="Enter Hour" id="edit_hour">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="number" value="" placeholder="Enter KM" id="edit_km">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
          <button type="button" class="btn btn-success" id="btn_update_data">Save Changes</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Banking details view modal -->
  <div class="modal fade custmmodl" id="bnkView1" tabindex="-1" role="dialog" aria-labelledby="bnkView1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title bank-modal-title" id="exampleModalLongTitle">Banking Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <strong class="ml-1 mb-1">Account Holder Name</strong>
                <input class="form-control" type="text" value="" placeholder="Account Holder Name" id="acc_name">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <strong class="ml-1 mb-1">Account Number</strong>
                <input class="form-control" type="text" value="" placeholder="Account Number" id="acc_number">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <strong class="ml-1 mb-1">IFSC</strong>
                <input class="form-control" type="text" value="" placeholder="IFSC" id="ifsc">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <strong class="ml-1 mb-1">Bank Name</strong>
                <input class="form-control" type="text" value="" placeholder="Bank Name" id="bank_name">
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal">Close</button>
        </div>
      </div>
    </div>
  </div>
