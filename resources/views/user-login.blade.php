@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(6)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(6)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(6)->meta_descr }} @stop

@section('content')
      
<section class="about-area sec-pad bx-shadow">
  <div class="container">    
    <div class="row">    
      <div class="form-content">
          <h4> <strong>Login to your account</strong></h4> 
          <span class="user-login-error">
             @if(Session::has('invalid')) Invalid email / password / account blocked by admin. @endif	
          </span>
          
         {{ Form::open(array('url' => 'user-login', 'role' => 'form', 'class' =>'form-vertical login-form', 'autocomplete' => 'off')) }} 
           <div class="form-group">
              <div class="input-icon">
                    <span class="log-email-ico"><i class="fa fa-user"></i></span>
                    {!! Form::text('email', null, array('id' => 'email','required', 'class'=>'form-control','placeholder'=>'Email / Contact Number*')) !!}
                    
                    <div class="error-hgt"> @if ($errors->has('email')) <p class="text-warning">{{ $errors->first('email') }}</p> @endif</div> 
                </div>
            </div>  
                         
            <div class="form-group">
                <div class="input-icon">
                  <span class="log-email-ico"><i class="fa fa-key"></i></span>
                   {!! Form::password('password',  array('id' => 'password','required', 'class'=>'form-control', 'placeholder' => 'Password*')) !!}
                   
                   <div class="error-hgt"> @if ($errors->has('password')) <p class="text-warning">{{ $errors->first('password') }}</p> @endif</div> 
                </div>
            </div>   
                    
            <div class="form-actions">
                <a href="{{ URL::to('user-forgot-psw') }}" class="pull-left">Forgot Password?</a>
                {{ Form::submit('Sign In', array('class' => 'btn submit btn btn-primary pull-right color-blue')) }}
            </div>
         {{ Form::close() }}
         
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</section>

@include('includes.ma')
@stop







