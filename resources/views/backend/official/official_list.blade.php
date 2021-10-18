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
                Please Select Department
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{route('official.list')}}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                              <label for="exampleInputFile">Department</label>
                              <select class="form-control select2bs4" name="designation_name" id="designation_name" style="width: 100%;">
                                <option value="">----Select Department----</option>
                                @foreach ($designations as $designation)
                                    <option value="{{$designation->designation_name}}">{{$designation->designation_name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <!--  <a href="#" class="btn btn-primary float-left">Search</a> -->
                   <button id="buttonSearch" type="submit" class="btn btn-primary float-right" style="margin-right: 10px">
                    <span class="fas fa-search"></span>&nbsp;Search
                   </button> 
                </div>
              </form>
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
                Please Take Appointment
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-employee" class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-success ">
                      <th>SL No</th>
                      <th>Profile</th>
                      <th>Name</th>
                      <th>Office</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Appointment</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                  @foreach($employee as $emplyee)
                    <tr>
                    <td>{{$i++}}</td>
                    <td><img src="{{ asset('images/avatar.png') }}" style="width: 80px;height: 80px"></td>
                    <td>{{$emplyee->firstName}} {{$emplyee->lName}}</td>
                    <td>{{$emplyee->designation_name}} {{$emplyee->employee_id}}</td>
                    <td>{{$emplyee->ephn}}</td>
                    <td>{{$emplyee->eemail}}</td>
                    <td>
                      <a href="{{url('appointment/create',$emplyee->employee_id)}}" title="Appointment" class="btn btn-success btn-xs"> Get Appointment </a>
                    </td>
                   </tr>
                  @endforeach
               </tbody>
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
  $(document).ready(function() {
    $('#all-employee').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
} );
</script>
@endsection