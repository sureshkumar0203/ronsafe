@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')

<section class="dashboard bx-shadow">
<div class="container">
  <div class="row mtb-50">
  	@include('includes.user-sidebar')
    <div class="col-md-9 myaccount-box pad0">
    	<div class="_title">
        <div class="pull-left">Training Booking Details </div>
        
        <a class="btn btn-info pull-right btn-txt" href="{{ url('user-booking-history')}}">
        <i class="fa fa-angle-left text-white"></i> <span class="text-white">Back</span></a>
        <div class="clearfix"></div>
        </div>
        
    	<div class="col-md-1"></div>
        <div class="col-md-10 mt-20 mb-20">         
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
          
  <div class="col-md-1"></div>
    </div>
  </div>
</div>



</section>

@include('includes.ma')
@stop