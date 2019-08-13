@extends('includes.master')
@section('title')  {{ $training_data->training_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(2)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(2)->meta_descr }} @stop

@section('content')
<section class="about-area  bx-shadow">
  <div class="container padtop20">
    <div class="sec-title mar0 mar-bot30">
    	<h2 class="text-center">Book <span>your training</span></h2>
    </div>
    
    <div class="row login-box mar-bot30">            
       <div class="col-md-6 training-detail">
          <div class="single-service"> 
            <div class="row"> 
              <div class="col-md-6"><h3>{{ $training_data->training_title }}</h3></div>
              <div class="col-md-6"><p class="price text-right"><span class="inline">$ {{ $training_data->training_price }}</span></p></div>
            </div>
            {!! $training_data->training_details !!}
          </div>
       </div>
       
       <div class="col-md-1 text-center"><span class="separator"></span></div>
       
      <div class="col-md-5">
        <div class="login-box-bdr-btm">   
          <h4>
            <span class="pull-left">Book now</span>    
            @if(Session::get('user_id')=='')
              <a class="fancybox pull-right" href="javascript:void('0');"  onclick="showUserLoginPopup();" title="User Login">
              <i class="fa fa-undo" style="font-size: 12px;"></i> 
              Returning customer click here to login.
              </a> 
            @endif
            
          </h4> 
        </div>
      
        {{ Form::open(array('url' => 'confirm-training', 'role' => 'form', 'class' =>'', 'name' => 'training_frm', 'id' => 'training_frm','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
        
          {!! Form::hidden('training_id',$training_data->id, array('id' => 'training_id','required')) !!}
          {!! Form::hidden('training_price',$training_data->training_price, array('id' => 'training_price','required')) !!}
          
          <div class="row">
            <div class="form-group col-sm-6">
              <label for="name" class=" control-label">Name<strong>*</strong></label>                 
              {!! Form::text('full_name',(Session::get('user_id'))?$user_dtls->full_name:old('full_name'), array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'Name','autocomplete' => 'off')) !!}
              <span class="_error-text">
              @if ($errors->has('full_name'))
              	{{ $errors->first('full_name') }}
              @endif
              </span>
            </div>
          
            <div class="form-group  col-sm-6">
              <label for="mobile number" class="control-label">Contact Number<strong>*</strong></label>
              @if(Session::get('user_id')!='')
              {!! Form::text('contact_no',(Session::get('user_id'))?$user_dtls->contact_no:old('contact_no'), array('id' => 'contact_no','required','class'=>'form-control','placeholder'=>'Contact Number','autocomplete' => 'off','maxlength' =>'14' ,'readonly' =>'readonly')) !!}
              @else
              {!! Form::text('contact_no',(Session::get('user_id'))?$user_dtls->contact_no:old('contact_no'), array('id' => 'contact_no','required','class'=>'form-control','placeholder'=>'Contact Number','autocomplete' => 'off','maxlength' =>'14' ,'onKeyUp' => 'validatephone(this)')) !!}
              @endif
              
              
              <span class="_error-text">
              @if ($errors->has('contact_no'))
              	{{ $errors->first('contact_no') }}
              @endif
              </span>
            </div>
          </div>
      
          <div class="row">
            @if(Session::get('user_id')=='')
              <div class="form-group col-sm-6">
              <label for="password" class=" control-label"> Password<strong>*</strong></label>
              {!! Form::password('password',array('id' => 'password','minlength' => 8,'required','class'=>'form-control','placeholder'=>'Password','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters','onKeyUp' => '')) !!}
              
              
              <span class="_error-text">
              @if ($errors->has('password'))
              	{{ $errors->first('password') }}
              @endif
              </span>
              </div>
            @endif
            
             @if(Session::get('user_id')!='')
               <div class="form-group  col-sm-12">
                  <label for="email" class="control-label">Email<strong>*</strong> </label>                
                  {!! Form::email('email',(Session::get('user_id'))?$user_dtls->email:old('email'), array('id' => 'email','required','class'=>'form-control','placeholder'=>'Email','autocomplete' => 'off','readonly' =>'readonly')) !!}
                  <span class="_error-text">
                  @if ($errors->has('email'))
                    {{ $errors->first('email') }}
                  @endif
                  </span>
              </div>
            @else
              <div class="form-group  col-sm-6">
                  <label for="email" class="control-label">Email<strong>*</strong> </label>                
                  {!! Form::email('email',(Session::get('user_id'))?$user_dtls->email:old('email'), array('id' => 'email','required','class'=>'form-control','placeholder'=>'Email','autocomplete' => 'off')) !!}
                  <span class="_error-text">
                  @if ($errors->has('email'))
                    {{ $errors->first('email') }}
                  @endif
                  </span>
              </div>
            @endif 
          </div>
      
          <div class="row">
            <div class="form-group col-sm-12">
            <label for="Address1" class=" control-label"> Address Line1<strong>*</strong></label> 
            {!! Form::text('address1',(Session::get('user_id'))?$user_dtls->address1:old('address1'), array('id' => 'address1','required','class'=>'form-control','placeholder'=>'Address Line1','autocomplete' => 'off')) !!}
            <span class="_error-text">
            @if ($errors->has('address1'))
              {{ $errors->first('address1') }}
            @endif
            </span>
            </div>
          </div>  
      
          <div class="row">
            <div class="form-group col-sm-12">
            <label for="Address2" class=" control-label"> Address Line2</label> 
            {!! Form::text('address2',(Session::get('user_id'))?$user_dtls->address2:old('address2'), array('id' => 'address2','class'=>'form-control','placeholder'=>'Address Line2','autocomplete' => 'off')) !!}
            <span class="_error-text">
            @if ($errors->has('address2'))
              {{ $errors->first('address2') }}
            @endif
            </span>
            </div>
          </div>  
      
          <div class="row">
            <div class="form-group col-sm-6">
                <label for="City" class="control-label"> City<strong>*</strong></label>               {!! Form::text('city',(Session::get('user_id'))?$user_dtls->city:old('city'), array('id' => 'city','required','class'=>'form-control','placeholder'=>'City','autocomplete' => 'off')) !!}
                <span class="_error-text">
                @if ($errors->has('city'))
                  {{ $errors->first('city') }}
                @endif
                </span>
            </div>
            
            
            <div class="form-group  col-sm-6">
                <label for="Postal Code/ZIP" class=" control-label"> Postal Code/ZIP<strong>*</strong></label>                {!! Form::text('post_code',(Session::get('user_id'))?$user_dtls->post_code:old('post_code'), array('id' => 'post_code','maxlength' =>'10','required','class'=>'form-control','placeholder'=>'Postal Code/ZIP','autocomplete' => 'off')) !!}
                <span class="_error-text">
                @if ($errors->has('post_code'))
                  {{ $errors->first('post_code') }}
                @endif
                </span>
            </div>
          </div>
      
          <div class="row">
            <div class="form-group col-sm-6">
               <label for="State" class=" control-label"> State<strong>*</strong></label>
               {!! Form::text('state',(Session::get('user_id'))?$user_dtls->state:old('state'), array('id' => 'state','required','class'=>'form-control','placeholder'=>'State','autocomplete' => 'off')) !!}
               <span class="_error-text">
                @if ($errors->has('state'))
                  {{ $errors->first('state') }}
                @endif
               </span>
            </div>
            
            <div class="form-group  col-sm-6">
                <label for="Country" class=" control-label"> Country<strong>*</strong></label>                {!! Form::text('country',(Session::get('user_id'))?$user_dtls->country:old('country'), array('id' => 'country','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                
                <span class="_error-text">
                @if ($errors->has('country'))
                  {{ $errors->first('country') }}
                @endif
               </span>
            </div>
          </div>
          
        {{ Form::submit('Pay Now', array('id'=>'btn_submit','class' => 'btn btn-primary pull-right pay-now')) }}
        {{ Form::close() }}
      </div>
    </div>
  </div>
</section>
@include('includes.ma')
@stop
@push('script')
<link rel="stylesheet" href="{{ asset('public/fancybox/jquery.fancybox.css?v=2.2.2') }}">
<script src="{{ asset('public/fancybox/jquery.fancybox.js?v=2.2.1') }}"></script> 
<script src="{{ asset('public/fancybox/wow.min.js') }}"></script> 
@endpush