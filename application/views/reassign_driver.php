
<body>
  <div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
      <div class="row align-items-center mb-4">
        <div class="col-md-8">
          <h3>Reassign Driver</h3>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>

      <div class="card py-2">
        <div class="table-responsive">

          <table class="table table-bordered" id="table">
            <thead class="thead-light">
              <tr>
                <th class="">#</th>
                <th class="">Name</th>
                <th class="">Email</th>
                <th class="">Mobile</th>
                <th class="">Saathi</th>
                <th class="">Actions</th>
              </tr>
            </thead>
            <tbody class="" id="table_details">

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

  <div class="modal fade custmmodl" id="reasgnmodal" tabindex="-1" role="dialog" aria-labelledby="addNewUsr1Title" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Reassign Driver</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add_data_form">
            <div class="row">

              <div class="col-lg-12">
                <div class="form-group">
                  <select class="form-control uppercase" id="sarathi_list">
                    <option value="0">Saathi Not Found </option>
                  </select>
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btn_change_saathi">Change Saathi</button>
        </div>
      </div>
    </div>
  </div>
