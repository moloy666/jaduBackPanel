<style>
  .title {
    text-transform: uppercase;
  }
</style>

<body>
  <div class="content-wrapper">
    <div class="page-content fade-in-up">
      <div class="row align-items-center mb-4">
        <div class="col-md-8">
          <h3>Deleted Saathi</h3>
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
                <th class="">Refferal Code</th>
                <th class="">Sub Franchise</th>
                <!-- <th class="">Actions</th> -->
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

  <script>
    show_deleted_sarathi();
    function show_deleted_sarathi(){
        $.ajax({
            type:"GET",
            url:"<?=base_url(WEB_PORTAL_ADMIN.'/show_deleted_sarathi')?>",
            error:function(resp){},
            success:function(resp){
                console.log(resp);
                let data=resp.data;
                let details='';
                $.each(data, function(i, data){
                    details+=`
                        <tr>
                            <td>${i+1}</td>
                            <td class="uppercase">${data.name}</td>
                            <td>${data.email}</td>
                            <td>${data.mobile}</td>
                            <td>${data.refferal_code}</td>
                            <td>${data.subfranchise.name}</td>
                        </tr>
                    `;
                });
                $('#table_details').html(details);
                $('#table').dataTable();
            }
        });
    }
  </script>

