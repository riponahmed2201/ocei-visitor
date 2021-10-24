@extends('backend.master')

@section('title', 'All Appointment History')
@section('dashboard-title', 'All Appointment History')
@section('breadcrumb-title', 'All Appointment  History')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
      <!-- ./row -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <!-- <button class="btn btn-danger btn-sm float-sm-left" id="delete_all" style="margin:5px;"><i class="fa fa-trash"></i> Delete</button>&nbsp -->
             <button class="btn btn-success btn-sm float-sm-left" id="done_all" style="margin:5px;"><i class="fa fa-check"></i> Done?</button>&nbsp
             <button class="btn btn-warning btn-sm float-sm-left" id="pending_all" style="margin:5px;"><i class="fa fa-exclamation-circle"></i> Pending?</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="all-appointment-history" class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-success ">
                      <th>SL No</th>
                      <th>Id Card Number</th>
                      <th>Visitor Name</th>
                      <th>Phone</th>
                      <th>Approval Of</th>
                      <th>Purpose</th>
                      <th>Request Details</th>
                      <th>Date & Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                   @foreach($appointmentHistory as $appointmentHistoryData)
                    <tr>
                    <td><input type="checkbox" name="appointmentData_ids[]" value="{{$appointmentHistoryData->id}}"></td>
                    <td>{{$appointmentHistoryData->id_card_number}}</td>
                    <td>{{$appointmentHistoryData->visitorName}}</td>
                    <td>{{$appointmentHistoryData->visitorPhn}}</td>
                    <td>{{$appointmentHistoryData->firstName}}{{$appointmentHistoryData->lName}}</td>
                    <td>{{$appointmentHistoryData->purpose}}</td>
                    <td>{{$appointmentHistoryData->request_detail}}</td>
                    <td>{{ date('j F Y g:i A', strtotime($appointmentHistoryData->date_time)) }}</td>
                      @if ($appointmentHistoryData->status==1)
                        <td>
                            <button class="btn btn-sm btn-success btn-xs">Done</button>
                        </td>
                      @else
                        <td>
                            <button class="btn btn-sm btn-warning btn-xs">Pending</button>
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
  $(document).ready(function() {
    $('#all-appointment-history').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
  } );

  // done all
  $('#done_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='appointmentData_ids[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('receptionists/appointment/done') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to done this appointment?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Done'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"appointmentData_ids": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Done This Appointment.......',
                              showConfirmButton: false,
                              html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                              allowOutsideClick: false
                          });
                      },
                      success:function (response) {
                          Swal.close();
                          console.log(response);
                          if (response==="success"){
                              Swal.fire({
                                  title: 'Successfully Done',
                                  type: 'success',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok',
                                  allowOutsideClick: false
                              }).then(function(result) {
                                  if (result.value) {
                                      window.location.reload();
                                  }
                              });
                          }
                      },
                      error:function (error) {
                          Swal.close();
                          console.log(error);
                      }
                  })
              }
          });
      }else{
          Swal.fire(
              'Error',
              'Select The Appointment First!',
              'error'
          )
      }
  });

  // pending all selected
  $('#pending_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='appointmentData_ids[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('receptionists/appointment/pending') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to Pending?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Pending'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"appointmentData_ids": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Pending This Appointment.......',
                              showConfirmButton: false,
                              html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                              allowOutsideClick: false
                          });
                      },
                      success:function (response) {
                          Swal.close();
                          console.log(response);
                          if (response==="success"){
                              Swal.fire({
                                  title: 'Successfully Pending',
                                  type: 'success',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok',
                                  allowOutsideClick: false
                              }).then(function(result) {
                                  if (result.value) {
                                      window.location.reload();
                                  }
                              });
                          }
                      },
                      error:function (error) {
                          Swal.close();
                          console.log(error);
                      }
                  })
              }
          });
      }else{
          Swal.fire(
              'Error',
              'Select The Appointment First!',
              'error'
          )
      }
  });
</script>
@endsection