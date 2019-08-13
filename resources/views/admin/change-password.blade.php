@extends('admin.layouts.app')
@section('title','Change Password')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Change Password</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
                  
            {{ Form::open(array('url' => 'administrator/update-password', 'role' => 'form', 'class' =>'forms-sample', 'name' => 'frm_cp', 'id' => 'frm_cp', 'autocomplete' => 'off')) }}
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Old Password<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::password('old_password', array('id' => 'old_password','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
                  <div class="error-hgt"> @if ($errors->has('old_password')) <p class="text-warning">{{ $errors->first('old_password') }}</p> @endif</div> 
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">New Password<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::password('new_password',array('id' => 'new_password','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
                   <div class="error-hgt">@if ($errors->has('new_password')) <p class="text-warning">{{ $errors->first('new_password') }}</p> @endif</div>
                </div>
              </div>
              
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Confirm Password<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::password('confirm_password',array('id' => 'confirm_password','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
                <div class="error-hgt">@if ($errors->has('confirm_password')) <p class="text-warning">{{ $errors->first('confirm_password') }}</p> @endif</div> 
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