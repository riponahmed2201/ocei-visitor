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
              <form action="{{route('appointment.list')}}" method="post">
                @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                  <label for="exampleInputFile">Status</label>
                                  <select class="form-control select2bs4" name="status" id="status" style="width: 100%;">
                                    <option value="-1">----Select Status----</option>
                                    <option value="2">Approved</option>
                                    <option value="1">Pending</option>
                                    <option value="3">Rejected</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-4" data-select2-id="22">
                                <div class="form-group">
                                  <label for="exampleInputFile">From Date</label>
                                  <div class="input-group">
                                      <input type="date" name="from_date" id="from_date" class="form-control">
                                  </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                  <label for="exampleInputFile">To Date</label>
                                  <div class="input-group">
                                      <input type="date" name="to_date" id="to_date" class="form-control">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                       <!-- <a href="#" class="btn btn-success float-left">Back</a> -->
                       <button type="submit" class="btn btn-primary float-right" style="margin-right: 10px">
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
                All Appontment List
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-appointment" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>SL No</th>
                      <th>Request By</th>
                      <th>Request To</th>
                      <th>Approval Of</th>
                      <th>Purpose</th>
                      <th>Request Details</th>
                      <th>Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $i=1; ?>
                     @foreach($appointmentData as $aptmentData)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$aptmentData->visitorName}}</td>
                        <td>{{$aptmentData->firstName}} {{$aptmentData->lName}}</td>
                        <td>{{$aptmentData->approval_of}}</td>
                        <td>{{$aptmentData->purpose}}</td>
                        <td>{{$aptmentData->request_detail}}</td>
                        <td> {{ date('j F Y g:i A', strtotime($aptmentData->date_time)) }} </td>
                            @if ($aptmentData->status==2)
                                <td>
                                    <button class="btn btn-sm btn-success btn-xs">Approved</button>
                                </td>
                            @elseif($aptmentData->status==1)
                                <td>
                                    <button class="btn btn-sm btn-warning btn-xs">Pending</button>
                                </td>
                            @else
                                <td>
                                    <button class="btn btn-sm btn-danger btn-xs">Rejected</button>
                                </td>
                            @endif
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
    $('#all-appointment').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
 } );
</script>
@endsection