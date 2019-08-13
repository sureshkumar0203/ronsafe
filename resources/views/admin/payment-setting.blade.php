@extends('admin.layouts.app')
@section('title','Payment Setting')
@section('css')
<style>
label{
  width: 22%;
  position: relative;
  top: 5px;
}
</style>
@endsection
@section('content')
<script type="text/javascript" src="{{ asset('public/admin-vendors/js/admin-custom-validation.js') }}"></script>
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Payment Setting</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
                  
            {{ Form::open(array('url' => 'administrator/update-payment-setting', 'role' => 'form', 'class' =>'forms-sample', 'name' => 'frm_adm_det', 'id' => 'frm_adm_det', 'autocomplete' => 'off')) }}

              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Paypal Enviroment<span class="text-danger">*</span></label>
                <div class="col-sm-5" style="margin-left: 20px;">
                  {!! Form::radio('paypal_environment',"1",$getPaymentSetting->paypal_environment == 1, ['id' => 'sandbox','required', 'class'=>'form-check-input']) !!}
                  <label class="form-check-label" for="sandbox">Sandbox</label>

                  {!! Form::radio('paypal_environment',"2",$getPaymentSetting->paypal_environment == 2, ['id' => 'live','required', 'class'=>'form-check-input']) !!}
                  <label class="form-check-label" for="live">Live</label>

                  <div class="help-block with-errors"></div>
                  <div class="error-hgt"> @if ($errors->has('paypal_environment')) <p class="text-warning">{{ $errors->first('paypal_environment') }}</p> @endif</div> 
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Paypal ID<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::email('paypal_email',$getPaymentSetting->paypal_email, ['id' => 'paypal_email','required', 'class'=>'form-control', 'placeholder'=>'Paypal Email']) !!}
                  <div class="error-hgt"> @if ($errors->has('paypal_email')) <p class="text-warning">{{ $errors->first('paypal_email') }}</p> @endif</div> 
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Shipping Charge<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::text('shipping_per',$getPaymentSetting->shipping_per,array('id' => 'shipping_per','required', 'class'=>'text-bdr','placeholder'=>'','onKeyUp' => 'validatePrice(this)', 'maxlength'=>'4','size'=>2)) !!} %
                  <div class="error-hgt"> @if ($errors->has('shipping_cost')) <p class="text-warning">{{ $errors->first('shipping_cost') }}</p> @endif</div> 
                </div>
              </div>
              
               
                              
                              
                              
              {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }}
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection