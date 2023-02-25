<style>
  .title {
    text-transform: uppercase;
  }
</style>

<body>
  <div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
      <div class="row align-items-center mb-4">
        <div class="col-md-8">
          <h3>Rejected Saathi Requests</h3>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center justify-content-end">
          </div>
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
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="" id="table_details">

            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="sidenav-backdrop backdrop"></div>
  <div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
  </div>

  <div class="modal fade delemodel" id="deltmodl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content p-4 text-center">
        <h5 class="mb-4">Are you sure want to
          remove this user from rejected list ?</h5>
        <div class="d-flex align-items-center justify-content-center">
          <button class="btn-secondary btn" data-dismiss="modal" id="close_delete_modal">No</button>
          <button class="btn-success btn ml-3" id="btn_remove_from_reject_list">Yes</button>
        </div>
      </div>
    </div>
  </div>


