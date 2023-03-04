<style>
    .title {
        text-transform: uppercase;
        cursor: pointer;
    }
</style>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h3>App Release</h3>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-end">
                    <button type="button" class="btn bgred ml-3 btnround" data-toggle="modal" data-target="#add_new_release" id="add_new">
                        New Release<i class="fa fa-plus ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <h5 class="text-success p-2">Current Version</h5>
        <div class="card p-2 mb-3">
            <div class="table-responsive">
                <table class="table table-bordered" id="table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>For App</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Skipable</th>
                        </tr>
                    </thead>
                    <tbody id="table_details">

                    </tbody>
                </table>
            </div>
        </div>

        <h5 class="text-warning mb-2">Version History</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="card p-2 mb-3">
                    <div class="table-responsive">
                        <!-- <h5 class="text-primary mb-3 ml-2">Customer</h5> -->
                        <table class="table table-bordered" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">For App</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Skipable</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="customer_table_details">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-2 mb-3">
                    <div class="table-responsive">
                        <!-- <h5 class="text-primary mb-3 ml-2">Sathi</h5> -->
                        <table class="table table-bordered" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">For App</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Skipable</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="saathi_table_details">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-2 mb-3">
                    <div class="table-responsive">
                        <!-- <h5 class="text-primary mb-3 ml-2">Driver</h5> -->
                        <table class="table table-bordered" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">For App</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Skipable</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="driver_table_details">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>


<div class="modal fade custmmodl" id="add_new_release" tabindex="-1" role="dialog" aria-labelledby="edtView1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Release</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="version_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="for_app">
                                    <option value="">Select App</option>
                                    <option value="customer">Customer</option>
                                    <option value="driver">Driver</option>
                                    <option value="sarathi">Sathi</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="skipable">
                                    <option value="">Is Skipable </option>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Version Name" id="name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Enter Code" id="code">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Play Store link" id="link" disabled>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btn_submit">Release</button>
            </div>
        </div>
    </div>
</div>

