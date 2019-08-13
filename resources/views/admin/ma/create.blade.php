@extends('admin.layouts.app')
@section('title','Add Membership & Affiliation')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Add Membership & Affiliation</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {{ Form::open(['route' => 'manage-ma.store','name' => 'frm_add', 'id' => 'frm_add','data-toggle'=>"validator", 'role' => 'form', 'files'=>true, 'autocomplete' => 'off','class' =>'']) }}

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Membership & Affiliation Photo<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::file('member_photo', ['id' => 'member_photo','onchange'=>'','required', 'class'=>'form-control file-upload-info','placeholder'=>'Upload Photo','accept'=>"jpg,png"]) !!}
                
                <div class="error-hgt">@if ($errors->has('member_photo'))<p class="text-warning">{{ $errors->first('member_photo') }}</p>@endif</div> 
              </div>
              
              <div class="col-md-12 mb15">
                <p class="text-danger">
                Note : &nbsp;  Please upload 119*89 photo for better quality.Image extension should be .jpeg.jpg.png.gif only.
                </p>
              </div>
            
            </div>
			
            
            
              
           
              
            {{ Form::submit('Save', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-ma') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>

            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection