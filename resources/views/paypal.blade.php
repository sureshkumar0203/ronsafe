@extends('includes.master')
@section('title') {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keywords }} @stop
@section('description') {{ $seo_info->meta_description }} @stop
@section('content')
  
<section class="about-area sec-pad" style="padding:10px 0px 40px 0px">
  <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="about-content">
             <div class="sec-title text-center">
                <h2> <img src="{{ asset('public/images/paypal-logo2.png') }}"> Processing...</h2>
             </div>
          </div>
       </div>
    </div>
    
    <div class="row text-center">
      <div class="col-md-12 col-sm-12">
          <div class="entry-content">
           <img src="{{ asset('public/images/paypal-lock.gif') }}" style="height:100px;">
           <h3 style="color:#002c8a; font-size:29px;">
             Please Wait....<br />
             Do not refresh the page while we're redirecting you to PayPal.<br />
           </h3>
           
            @php
            $payment_det = Helpers::getPaymentDetails();
            $business_email = $payment_det->paypal_email;
            if($payment_det->paypal_environment=='1'){
                $paypal_red_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
            }else{
                $paypal_red_url = "https://www.paypal.com/cgi-bin/webscr";
            }
            $order_id = Session::get('order_id');
            //dd($order_items);
            //dd($order_dtls->total_amount);
            //exit;
            
           
			$shipping_info = ($order_dtls->total_amount*$payment_det->shipping_per)/100;
            $shipping_amount = number_format($shipping_info,'2','.','');
            
             
            $site_url = Config::get('constants.site_url');
            $notify = $site_url."api/order-notify-paypal";
            $success = $site_url."order-thank-you";
            $cancel = $site_url."payment-failed";
            
           
            @endphp
            
           {!! Form::open(['url' => $paypal_red_url,'method' => 'post','name'=>'frm_paypal','id'=>'frm_paypal']) !!}
             
              {{ Form::hidden('cmd','_cart', array('id' => 'cmd')) }}
              {{ Form::hidden('upload','1', array('id' => 'upload')) }}
              {{ Form::hidden('business',$business_email, array('id' => 'business')) }}
              
              @foreach($order_items as $item_info)
              <input type="hidden" name="item_number_{{ $loop->iteration }}" value="{{ $item_info->id }}">
              <input type="hidden" name="item_name_{{ $loop->iteration }}" value="{{ $order_items['0']->productPrice->product->prd_name }}">
              <input type="hidden" name="quantity_{{ $loop->iteration }}" value="{{ $item_info->qty }}">
              <input type="hidden" name="amount_{{ $loop->iteration }}" value="{{ $item_info->unit_price }}">		
              @endforeach
              
              {{ Form::hidden('shipping_1',$shipping_amount) }}
              {{ Form::hidden('discount_amount_cart','0.00') }}
              {{ Form::hidden('tax_cart','0.00') }}
              
              {{ Form::hidden('currency_code','USD', array('id' => 'currency_code')) }}
              {{ Form::hidden('custom',$order_id, array('id' => 'custom')) }} 
              {{ Form::hidden('notify_url',$notify, array('id' => 'notify_url')) }}
              {{ Form::hidden('return',$success, array('id' => 'return')) }}            
              {{ Form::hidden('cancel_return',$cancel, array('id' => 'cancel_return')) }}
             
              
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