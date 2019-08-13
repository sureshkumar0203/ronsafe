@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')

<section class="dashboard bx-shadow">
<div class="container ">
  <div class="row mtb-50">
  @include('includes.user-sidebar')
  <div class="col-md-9 myaccount-box pad0">
  	<div class="_title">Training Booking History</div>
    
    <div class="marlr10">
    @if(count($booking_dtls) > 0)
    <table class="order-history table-striped mb-50  mt-20 mb-20" id="no-more-tables" width="100%">
    <thead>
        <tr>
        	<th>#ID</th>
            <th>Name</th>
            <th>Contact No.</th>
            <th>Training</th>
            <th>Booking Date</th>
            <th>Price</th>
            <th>Transaction  ID</th>
            <th>Details</th>
        </tr>
      </thead>
      
      <tbody>
        @foreach($booking_dtls as $booking_res)
      	<tr>
          <td data-title="Booking ID">{{ $booking_res->id }}</td>
          <td data-title="Name">{{ $booking_res->full_name }}</td>
          <td data-title="Contact No.">{{ $booking_res->contact_no }}</td>
          <td data-title="Training">{{ $booking_res->training->training_title }}</td>
          <td data-title="Booking Date">{{ date("jS M, Y",strtotime($booking_res->created_at)) }}</td>
          <td data-title="Price">&dollar; {{ $booking_res->training_price }}</td>
          <td data-title="Transaction  ID">{{ $booking_res->transaction_id }}</td>
          <td data-title="Details"><a href="user-booking-details/{{ $booking_res->id }}/details" class="btn btn-primary btn-sm "><i class="fa fa-eye text-white"></i></a></td>
         
          @endforeach
        </tr>
      </tbody>
    </table>
    @else
    <h3 class="text-center mb-50 text-blue f-size24 text-red"> <div class="red-bdr">No Bookings has been placed yet.</div></h3>
    @endif
    </div>
  </div>
  </div>
</div>
</section>
@stop