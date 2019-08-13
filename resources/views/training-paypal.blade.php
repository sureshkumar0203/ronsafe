@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')

<section class="about-area  bx-shadow">
  <div class="container padtopbtm100">
    <div class="row"> 
  
       <div class="col-md-12 col-sm-12">
        <div class="entry-content pt-20 text-center">
         <img src="{{ asset('public/images/ajax-loader.gif') }}">
         <h3 style="color:#0083c1; font-weight:400">
           Please Wait....<br />
           Do not refresh the page while we're redirecting you to PayPal.<br />
         </h3>
         <div class="row mt-20">         
         <img src="{{ asset('public/images/paypal-logo.png') }}" width="200">
         </div>
         
          @php
          $payment_det = Helpers::getPaymentDetails();
          $business_email = $payment_det->paypal_email;
          if($payment_det->paypal_environment=='1'){
              $paypal_red_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
          }else{
              $paypal_red_url = "https://www.paypal.com/cgi-bin/webscr";
          }
          $item_number = Session::get('training_booking_id');
          
          $training_amount = Session::get('training_amount');
          $amount = number_format($training_amount,2,'.','');
          
          $item_name="Training Booking";
          
          $site_url = Config::get('constants.site_url');
          
          $notify = $site_url."api/training-notify-paypal";
          $success = $site_url."training-thank-you";
          $cancel = $site_url."payment-failed";
          
          @endphp
        
         {!! Form::open(['url' => $paypal_red_url,'method' => 'post','name'=>'frm_paypal','id'=>'frm_paypal']) !!}
            {{ Form::hidden('cmd','_xclick', array('id' => 'cmd')) }}
            {{ Form::hidden('business',$business_email, array('id' => 'business')) }}
            {{ Form::hidden('item_number',$item_number, array('id' => 'item_number')) }}
            {{ Form::hidden('item_name',$item_name, array('id' => 'item_name')) }}
            {{ Form::hidden('currency_code','USD', array('id' => 'currency_code')) }}
         	{{ Form::hidden('amount',$amount, array('id' => 'amount')) }}
            {{ Form::hidden('notify_url',$notify, array('id' => 'notify_url')) }}
            {{ Form::hidden('return',$success, array('id' => 'return')) }}            
            {{ Form::hidden('cancel_return',$cancel, array('id' => 'cancel_return')) }} 
            {{ Form::hidden('custom',$item_number, array('id' => 'custom')) }} 
		 {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
    document.frm_paypal.submit();
</script>
@stop