@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(7)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(7)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(7)->meta_descr }} @stop

@section('content')
      
<section class="about-area sec-pad bx-shadow">
  <div class="container">    
    <div class="row">    
      <div class="form-content">
          <h4> <strong>Forgot Password</strong></h4> 
          
          <div class="hgt30">
          @if(Session::has('invalid'))
          <span class="user-login-error">
              Invalid email address.
          </span>
           @endif
           
           @if(Session::has('success')) 
          <span class="user-login-success">
             Password has been send to your email address.
          </span>
           @endif
           </div>
           
         {{ Form::open(array('route' => 'user.forgot.submit', 'role' => 'form', 'class' =>'form-vertical usr_for_psw', 'autocomplete' => 'off')) }}  
           <div class="form-group">
              <div class="input-icon">
                    <span class="log-email-ico"><i class="fa fa-user"></i></span>
                    {!! Form::email('email',  old('email'), array('id' => 'email','required', 'class'=>'form-control','placeholder'=>'Your email address*')) !!}
                    
                    <div class="error-hgt"> @if ($errors->has('email')) <p class="text-warning">{{ $errors->first('email') }}</p> @endif</div> 
                </div>
            </div>  
                         
            
                    
            <div class="form-actions">
                <a href="{{ URL::to('user-login') }}" class="pull-left">Click here to Login?</a>
                {{ Form::submit('Reset Password', array('class' => 'btn submit btn btn-primary pull-right color-blue')) }}
            </div>
         {{ Form::close() }}
         
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</section>

@include('includes.ma')
@stop