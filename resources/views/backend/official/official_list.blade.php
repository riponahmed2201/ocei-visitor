@extends('backend.master')

@section('title', 'All Appointment List')
@section('dashboard-title', 'All Appointment List')
@section('breadcrumb-title', 'All Appointment  Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Please Select Status, From Date And To Date
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="enhanced-results.html">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                  <label for="exampleInputFile">Department</label>
                                  <select class="form-control select2bs4" name="department" id="department" style="width: 100%;">
                                    <option value="">----Select Department----</option>
                                    <option value="">fdfdfdfd</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-6" data-select2-id="22">
                                <div class="form-group">
                                  <label for="exampleInputFile">Sub Depatment</label>
                                  <input id="fromDate" name="fromDate" placeholder="From Date" type="date" class="form-control input-sm datepicker hasDatepicker" value="">
                                </div>
                            </div>
                        </div>
                    </div>
              </form>
            </div>
            <div class="card-footer">
               <a href="#" class="btn btn-success float-left">Back</a>
               <button id="buttonSearch" type="button" class="btn btn-primary float-right" style="margin-right: 10px">
                <span class="fas fa-search"></span>&nbsp;Search
               </button> 
            </div>
          </div>
          </div>
        </div>
      <!-- ./row -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                All List Here
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-product" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>SL No</th>
                      <th>Profile</th>
                      <th>Name</th>
                      <th>Office</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Appointment</th>
                    </tr>
                  </thead>
              </table>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
@endsection

@section('custom_script')
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
})
</script>
@endsection