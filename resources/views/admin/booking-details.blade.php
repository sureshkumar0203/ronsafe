@extends('admin.layouts.app')
@section('title','Training Booking Details')
@section('content')
 
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Booking Details  <a class="btn btn-primary pull-right" href="{{ url('/administrator/manage-bookings')}}">
            <i class="fa fa-angle-left"></i><span class="btn-txt">Back</span></a></h5>
            <!--.text-danger.text-warning .text-info-->
            
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
              <div class="form-group row">
              <div class="col-md-12" >
                <strong>Booked Training</strong> : {{ $booking_dtls->training->training_title }}
                <hr>
                </div><br><br>


                
                <div class="clearfix"></div>
           
                <div class="col-md-4" >
                <strong>Contact Information</strong>  <br />
                <hr>
                <span class="desc">
                Nmae : {{ $booking_dtls->full_name }}  <br />
                Contact No. : {{ $booking_dtls->contact_no }}  <br />
                Email : {{ $booking_dtls->email }}  <br /> <br />
                </span>
                </div>
                
                <div class="col-md-4" >                
                <strong>Address</strong>  <br /> 
                  <hr>   
                  <span class="desc">             
                {{ $booking_dtls->address1 }} , {{ $booking_dtls->address2 }} <br />
                {{ $booking_dtls->city }} - {{ $booking_dtls->post_code }} <br />
                {{ $booking_dtls->state }} , {{ $booking_dtls->country }}
                </span>
                </div>
                
   
                 
                <div class="col-md-4" >
                <strong>Booking Information</strong><br>
                  <hr>
                  <span class="desc">
                <strong>Booking Date :</strong> {{ date("jS M, Y",strtotime($booking_dtls->created_at)) }}  <br />
                <strong>Transaction ID :</strong> {{ $booking_dtls->transaction_id }}  <br />
                <strong>Booking Amount :</strong>&dollar; {{ $booking_dtls->training_price }}  <br />
                </span>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection