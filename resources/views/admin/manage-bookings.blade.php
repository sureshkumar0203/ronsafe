@extends('admin.layouts.app')
@section('title','Manage Training Bookings')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row mb15">
                <div class="col-lg-6"><h5 class="display-5">Manage Bookings</h5></div>
                <div class="col-lg-6"></div>
              </div>
              
              
              <div class="table-responsive">
                <table class="table table-hover" id="tbl_content">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Name </th>
                      <th>Training Title</th>
                      <th>Booking Date</th>
                      <th>Booking Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($booking_dtls as $booking_res)
                    <tr>
                      <td>{{ $booking_res->id }}</td>
                      <td>{{ $booking_res->full_name }}</td>
                      <td>{{ $booking_res->training->training_title }} </td>
                      <td>{{ date("jS M, Y",strtotime($booking_res->created_at)) }} </td>
                      <td>&dollar; {{ $booking_res->training_price }}</td>
                      <td><a href="booking-details/{{ $booking_res->id }}/details" class="btn btn-warning btn-sm view-btn"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@include('admin.includes.data-tables-lib')
<script>
$('#tbl_content').dataTable( {
  /*"paging":   false,
  "info":     false,
  "searchable": false,*/
  "order": [[ 0, "desc" ]],
  "columnDefs": [ {
      "targets": [6],
      "orderable": false,
    }]
} );
</script>
@endsection