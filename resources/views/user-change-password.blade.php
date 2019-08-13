@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')

<section class="dashboard bx-shadow">
<div class="container ">
  <div class="row mtb-50">
  
  @include('includes.user-sidebar')
  
  <div class="col-md-9 myaccount-box pad0">
  <div class="_title">Change Your Password</div>

<div class="change-pass-card">
	  	
          <span style="height:20px; display:block;">
            @if (Session::has('success'))          
                <div style="color:#069e06;">Password changed successfully.</div>             
            @endif
            
            @if (Session::has('error'))          
                <div style="color:#F00;">Old password mismatch.</div>             
            @endif
          </span>



      {{ Form::open(array('url' => 'update-password', 'method'=>'post', 'role' => 'form', 'class' =>'', 'name' => 'frm_cp', 'id' => 'frm_cp','files'=>false, 'autocomplete' => 'off', 'onSubmit'=>'')) }}
      
      <div class="row">
      <div class="form-group col-sm-12">
      <label for="" class=" control-label">Old Password</label>
       {!! Form::password('old_psw',array('id' => 'old_psw','minlength' => 8,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
       
       <div class="_error-text">
           @if ($errors->has('old_psw')) {{ $errors->first('old_psw') }} @endif
       </div>
      </div>
      
      <div class="form-group  col-sm-12">
      <label for="" class=" control-label">New Password</label>
      {!! Form::password('new_psw',array('id' => 'new_psw','minlength' => 8,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters','onKeyUp' => '')) !!}
      
       <div class="_error-text">
           @if ($errors->has('new_psw')) {{ $errors->first('new_psw') }} @endif
       </div>
      </div>
      
      <div class="form-group  col-sm-12">
      <label for="" class=" control-label">Confirm Password</label> 
      {!! Form::password('conf_psw',array('id' => 'conf_psw','minlength' => 8,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters','onKeyUp' => '')) !!}
      
       <div class="_error-text">
           @if ($errors->has('conf_psw')) {{ $errors->first('conf_psw') }} @endif
       </div>
      </div>
      
      <div class="form-group  col-sm-12 text-right">
      {{ Form::submit('Change Password', array('id'=>'btn_submit','class' => 'btn submit btn btn-primary color-blue')) }}
</div>
</div>
  
  	{{ Form::close() }}   
  </div>
</div>



</section>

@include('includes.ma')
@stop