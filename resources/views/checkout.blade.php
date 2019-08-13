@extends('includes.master')
@section('title') {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keywords }} @stop
@section('description') {{ $seo_info->meta_description }} @stop
@section('page-script')
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
@endsection
@section('content')
<section class="about-area  bx-shadow">
  <div class="container cart-area">
    <div class="row">
      <h3>Place Your Order</h3>
      <hr />
      @if(session()->get('user_id') == "")
      <div class="col-md-12" style="margin-bottom:10px; padding: 0;"> <a style="text-decoration:none;" href="javascript:void('0');"  onclick="showUserLoginPopup();" title="User Login"> <span class="refrsh"> <i class="fa fa-undo" style="font-size: 16px;"></i> <strong>Returning customer click here to login.</strong></span> </a> </div>
      @endif
      <span id="err_msg"></span>
      <div class="col-md-12" style="padding: 0;">
        <div class="ajax_loader"><img src="{{ asset('public/images/paypal-lock.gif') }}"></div>
        {!! Form::open(['url' => 'place-order','onSubmit'=>'return validatePlaceOrder();','method'=>'post', 'name' => 'checkout-form', 'id' => 'checkout-form','files'=>true, 'autocomplete' => 'off']) !!}
        <div class="col-md-7 col-xs-12" style="padding-left: 0;">
          <div class="order-form fmhgt">
            <h3>ACCOUNT DETAILS</h3>
            <div class="col-md-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Full Name</label>
                {!! Form::text('full_name',(Session::get('user_id'))?$user_details->full_name:old('full_name'),['class' => 'form-control ord-frm', 'id' => 'full_name','placeholder'=>'Full Name']) !!} </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Email</label>
                {!! Form::text('email',(Session::get('user_id'))?$user_details->email:old('email'),['class' => 'form-control ord-frm', 'id' => 'email','placeholder'=>'Email']) !!} </div>
            </div>
            <div class="col-sm-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Contact No</label>
                {!! Form::text('contact_no',(Session::get('user_id'))?$user_details->contact_no:old('contact_no'),['class' => 'form-control ord-frm', 'id' => 'contact_no','placeholder'=>'Contact No.']) !!} </div>
            </div>
            @if(session()->get('user_id') == "")
            <div class="col-md-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Account Password</label>
                {!! Form::password('user_password',array('id' => 'user_password','minlength' => 7,'required','class'=>'form-control ord-frm','placeholder'=>'Account Password','autocomplete' => 'off','title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters')) !!}
                <span id="password_strength"></span>
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            <h3>ADDRESS DETAILS</h3>
            <div class="col-md-12 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Address 1</label>
                {!! Form::text('address1',(Session::get('user_id'))?$user_details->address1:old('address1'),['class' => 'form-control ord-frm', 'id' => 'address1','placeholder'=>'Address']) !!} </div>
            </div>
            <div class="col-md-12 col-xs-12">
              <div class="form-group">
                <label class="oder-lb"><span class="str"></span> Address 2</label>
                {!! Form::text('address2',(Session::get('user_id'))?$user_details->address2:old('address2'),['class' => 'form-control ord-frm', 'id' => 'address2','placeholder'=>'Address (Optional)']) !!} </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Town / City</label>
                {!! Form::text('city',(Session::get('user_id'))?$user_details->city:old('city'),['class' => 'form-control ord-frm', 'id' => 'city','placeholder'=>'Town / City']) !!} </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Post Code</label>
                {!! Form::text('post_code',(Session::get('user_id'))?$user_details->post_code:old('post_code'),['class' => 'form-control ord-frm', 'id' => 'post_code','placeholder'=>'Post Code']) !!} </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> Country</label>
                {!! Form::text('country',(Session::get('user_id'))?$user_details->country:old('country'),['class' => 'form-control ord-frm', 'id' => 'country','placeholder'=>'Country']) !!} </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb"><span class="str">*</span> State</label>
                {!! Form::text('state',(Session::get('user_id'))?$user_details->state:old('state'),['class' => 'form-control ord-frm', 'id' => 'state','placeholder'=>'State']) !!} </div>
            </div>
            <div class="col-md-12 col-xs-12">
              <div class="form-group required">
                <label class="oder-lb">Order Notes</label>
                {!! Form::textarea('order_notes', '', ['class' => 'form-control ord-frm', 'id' => 'order_notes','placeholder'=>'Order Notes', 'rows'=>'3']) !!} </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="col-md-5 col-xs-12" style="padding-right: 0;">
          <div class="order-form">
            <h3>ORDER SUMMERY</h3>
            <div class="table-responsive" style="padding:0 10px;">
              <table class="table">
                <thead>
                  <tr>
                    <td class="text-left"><span class="ord-sum">Product Name</span></td>
                    <td class="text-center"></td>
                    <td class="text-left"></td>
                    <td class="text-right"></td>
                    <td class="text-right"><span class="ord-sum">Total</span></td>
                  </tr>
                </thead>
                <tbody>
                
                @php 
                $cart_det = Helpers::commonCartInformation();
                @endphp
                @if(count($cart_det[0])>0)
                @foreach($cart_det[0] as $cart_info)
                <tr>
                  <td class="text-left"><a href="{{ url('/') }}/product-details/{{ $cart_info->productPrice->product->id }}-{{ $cart_info->productPrice->product->prd_slug }}"><img class="thumb-img" src="{{ asset('public/product-photo/'.$cart_info->productPrice->product->prd_photo) }}"  alt=""/> <span class="ord-sum">{{ $cart_info->productPrice->product->prd_name }}</span></a>
                  <span class="ord-sum"> X 
                    {{ $cart_info->qty }}
                  </span>
                  @if($cart_info->size != null) <span>{{ $cart_info->productPrice->size->size }}</span> @endif
                  @if($cart_info->color != null) <span class="cart-color" style="background:{{ $cart_info->productPrice->color->color_code }}"></span> @endif
                  </td>
                  <td class="text-center"></td>
                  <td class="text-left"></td>
                  <td class="text-right"></td>
                  <td class="text-right"><span class="ord-sum">$ {{ number_format($cart_info -> total_price,2,'.','') }}</span></td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td>Your shopping cart is empty...</td>
                </tr>
                @endif
                  </tbody>
                
                <tfoot>
                  <tr >
                    <td class="text-right" colspan="4"><span class="ord-sum">Item Total:</span></td>
                    <td class="text-right"><span class="ord-sum"> &dollar;  {{ number_format($cart_det[1],'2','.','') }}</span></td>
                  </tr>
                  <tr>
                    <td class="text-right" colspan="4"><span class="ord-sum">Delivery Charges:</span></td>
                    <td class="text-right"><span class="ord-sum"> &dollar; {{ number_format($cart_det[2],'2','.','') }}</span></td>
                  </tr>
                  <tr>
                    <td class="text-right" colspan="4"><span class="ord-sum">Amount Payable:</span></td>
                    <td class="text-right "><span class="ord-sum">$ {{ number_format($cart_det[3],'2','.','') }} </span></td>
                  </tr>
                </tfoot>
              </table>
              <div class="pull-right">
                <input type="button" name="pla_ord" value="Place order" onclick="submitForm();" class="btn plc-order-btn">
              </div>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog login-mdl"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4>Login to your Account</h4>
      </div>
      <div class="modal-body">
        <form style="padding:0 10px;" action="">
          <div class="col-md-12 col-xs-12">
            <div class="form-group required">
              <label class="oder-lb"> Login ID</label>
              <input type="text" class="form-control ord-frm" id="login" name="login" placeholder="">
            </div>
            <div class="form-group required">
              <label class="oder-lb">Password</label>
              <input type="password" class="form-control ord-frm" id="password" name="password" placeholder="">
            </div>
            <p>I lost my password. <a href="#"><span>Please email it to me</span></a></p>
            <a href="#" class="btn btn-primary lgn-btn">Login</a> </div>
        </form>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
</div>
@stop
@push('script')
<link rel="stylesheet" href="{{ asset('public/fancybox/jquery.fancybox.css?v=2.2.2') }}">
<script src="{{ asset('public/fancybox/jquery.fancybox.js?v=2.2.1') }}"></script> 
<script src="{{ asset('public/fancybox/wow.min.js') }}"></script> 
<script src="{{ asset('public/js/form/validator.js') }}"></script>
<script>
$(document).ready(function () {
    var x = $("#checkout-form").validate({
        rules: {
            full_name: "required",
            contact_no: "required",
      			// user_password: {
         //        required: true,
         //        minlength: 7
         //    },
            user_password: {
                  required: true,
                  pwcheck: true,
                  minlength: 7
              },
            address1: "required",
            city: "required",
            post_code: "required",
            country: "required",
            state: "required",
            email: {
                required: true,
                email: true
            },
        },

    });

$.validator.addMethod("pwcheck", function(value) {
return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
   && /[a-z]/.test(value) // has a lowercase letter
   && /\d/.test(value) // has a digit
});
});

</script>
@endpush