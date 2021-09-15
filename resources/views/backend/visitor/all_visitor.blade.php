@extends('backend.master')

@section('title', 'All Visitor List')
@section('dashboard-title', 'All visitor List')
@section('breadcrumb-title', 'All Visitor  Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <p>All visitor List</p>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-banner" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>Serial No</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Department</th>
              <th>Designation</th>
            </tr>
          </thead>
          <tbody>
            @foreach($visitors as $visitor)
            <tr role="row" class="odd">
               <td>{{$loop->iteration}}</td>
               <td>{{$visitor->name}}</td>
               <td>{{$visitor->mobile}}</td>
               <td>{{$visitor->gender}}</td>
               <td><button class="btn btn-success btn-xs">{{$visitor->deptName}}</button>  
               <td><button class="btn btn-warning btn-xs">{{$visitor->desigName}}</button>  
              </td>
            </tr>  
            @endforeach             
          </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

@section('custom_script')


@endsection