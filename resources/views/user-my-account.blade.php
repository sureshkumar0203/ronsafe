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
    	<div class="_title">My Account</div>
    	<div class="col-md-1"></div>
        <div class="col-md-10">
          <span style="height:20px; margin-top:10px; display:block;">
            @if (Session::has('success'))          
                <div style="color:#069e06;">Profile information updated successfully.</div>             
            @endif
          </span>
          {{ Form::open(array('url' => 'update-details', 'role' => 'form', 'class' =>'', 'name' => 'profile_frm', 'id' => 'profile_frm','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
          
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="name" class=" control-label">Name<strong>*</strong></label>                 
                {!! Form::text('full_name',old('full_name',$user_dtls->full_name), array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'Name','autocomplete' => 'off')) !!}
                <span class="_error-text">
                @if ($errors->has('full_name'))
                  {{ $errors->first('full_name') }}
                @endif
                </span>
              </div>
            
              <div class="form-group  col-sm-6">
                <label for="mobile number" class="control-label">Contact Number<strong>*</strong></label>
                {!! Form::text('contact_no',old('contact_no',$user_dtls->contact_no), array('id' => 'contact_no','required','class'=>'form-control','placeholder'=>'Contact Number','autocomplete' => 'off','maxlength' =>'14' ,'onKeyUp' => 'validatephone(this)')) !!}
                <span class="_error-text">
                @if ($errors->has('contact_no'))
                  {{ $errors->first('contact_no') }}
                @endif
                </span>
              </div>
            </div>
          
            <div class="row">
              <div class="form-group  col-sm-12">
                <label for="email" class="control-label">Email<strong>*</strong> </label>                
                {!! Form::email('email',old('email',$user_dtls->email), array('id' => 'email','required','class'=>'form-control','placeholder'=>'Email','autocomplete' => 'off')) !!}
                <span class="_error-text">
                @if ($errors->has('email'))
                  {{ $errors->first('email') }}
                @endif
                </span>
              </div>
            </div>
          
            <div class="row">
              <div class="form-group col-sm-12">
              <label for="Address1" class=" control-label"> Address Line1<strong>*</strong></label> 
              {!! Form::text('address1',old('address1',$user_dtls->address1), array('id' => 'address1','required','class'=>'form-control','placeholder'=>'Address Line1','autocomplete' => 'off')) !!}
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
              {!! Form::text('address2',old('address2',$user_dtls->address2), array('id' => 'address2','class'=>'form-control','placeholder'=>'Address Line2','autocomplete' => 'off')) !!}
              <span class="_error-text">
              @if ($errors->has('address2'))
                {{ $errors->first('address2') }}
              @endif
              </span>
              </div>
            </div>  
          
            <div class="row">
              <div class="form-group col-sm-6">
                  <label for="City" class="control-label"> City<strong>*</strong></label>               
                  {!! Form::text('city',old('city',$user_dtls->city), array('id' => 'city','required','class'=>'form-control','placeholder'=>'City','autocomplete' => 'off')) !!}
                  <span class="_error-text">
                  @if ($errors->has('city'))
                    {{ $errors->first('city') }}
                  @endif
                  </span>
              </div>
              
              
              <div class="form-group  col-sm-6">
                  <label for="Postal Code/ZIP" class=" control-label"> Postal Code/ZIP<strong>*</strong></label>                {!! Form::text('post_code',old('post_code',$user_dtls->post_code), array('id' => 'post_code','maxlength' =>'10','required','class'=>'form-control','placeholder'=>'Postal Code/ZIP','autocomplete' => 'off')) !!}
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
                 {!! Form::text('state',old('state',$user_dtls->state), array('id' => 'state','required','class'=>'form-control','placeholder'=>'State','autocomplete' => 'off')) !!}
                 <span class="_error-text">
                  @if ($errors->has('state'))
                    {{ $errors->first('state') }}
                  @endif
                 </span>
              </div>
              
              <div class="form-group  col-sm-6">
                  <label for="Country" class=" control-label"> Country<strong>*</strong></label>                {!! Form::text('country',old('country',$user_dtls->country), array('id' => 'country','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
                  
                  <span class="_error-text">
                  @if ($errors->has('country'))
                    {{ $errors->first('country') }}
                  @endif
                 </span>
              </div>
            </div>
            
          {{ Form::submit('Update', array('id'=>'btn_submit','class' => 'btn updt-btn pull-right mb-20')) }}
          {{ Form::close() }}
                </div>
          
  <div class="col-md-1"></div>
    </div>
  </div>
</div>



</section>

@include('includes.ma')
@stop