@extends('admin.layouts.app')
@section('title','Admin Login')
@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
  <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
    <div class="row w-100">
      <div class="col-lg-4 mx-auto">
        <div class="auto-form-wrapper">
          {{ Form::open(array('route' => 'admin.login.submit', 'role' => 'form', 'class' =>'form-vertical login-form', 'autocomplete' => 'off')) }}  
          <div class="form-group">
            <label class="label">Email Address*</label>
            <div class="input-group">
              {!! Form::email('email',Cookie::get('cok_email') , array('id' => 'email','required','autofocus','class'=>'form-control','placeholder'=>'Email*')) !!}
              
              <div class="error-hgt">@if ($errors->has('email')) <p class="text-warning">{{ $errors->first('email') }}</p> @endif</div> 
              
              
              <div class="input-group-append">
                <span class="input-group-text"><i class="mdi mdi-check-circle-outline"></i></span>
              </div>
            </div>
          </div>
            
          <div class="form-group">
            <label class="label">Password*</label>
            <div class="input-group">
              {!! Form::input('password', 'password',Cookie::get('cok_psw'),array('id' => 'password','required', 'class'=>'form-control', 'placeholder' => 'Password*')) !!}
              
             
              <div class="input-group-append">
                <span class="input-group-text"><i class="mdi mdi-check-circle-outline"></i></span>
              </div>
              
              <div class="error-hgt">@if ($errors->has('password')) <p class="text-warning">{{ $errors->first('password') }}</p> @endif</div>
            </div>
          </div>
            
          <div class="form-group">
          {{ Form::submit('Login', array('class' => 'btn btn-primary submit-btn btn-block')) }}
          </div>
            
          <div class="form-group d-flex justify-content-between">
            <div class="form-check form-check-flat mt-0">
              <label class="form-check-label">
                <input type="checkbox" name="remember_me" id="remember_me" value="1" class="form-check-input" <?php if(Cookie::get('cok_rm')== 1){ echo "checked"; }?>> Keep me signed in 
              </label>
            </div>
            <a href="{{ URL::to('administrator/forgot-password') }}" class="text-small forgot-password text-black">Forgot Password</a>
          </div>
          
         
          <div style="height:25px;" class="text-danger"> @include('admin.includes.error-mesg') </div>
         
         <!-- <div class="form-group">
            <button class="btn btn-block g-login">
                <img class="mr-3" src="../../images/file-icons/icon-google.svg" alt="">Log in with Google
            </button>
          </div>
            
          <div class="text-block text-center my-3">
            <span class="text-small font-weight-semibold">Not a member ?</span>
            <a href="register.html" class="text-black text-small">Create new account</a>
          </div>-->
          
          {{ Form::close() }}
        </div>
    
        <!--<ul class="auth-footer">
          <li><a href="#">Conditions</a></li>
          <li><a href="#">Help</a></li>
          <li><a href="#">Terms</a></li>
        </ul>-->
        
        
    	<p class="footer-text text-center">
          copyright &copy; {{ date('Y')}} <a href="https://www.bletechnolabs.com/" target="_blank">BLET</a>. All rights reserved.</span>
        </p>
        
      </div>
    </div>
  </div>
</div>
@endsection
