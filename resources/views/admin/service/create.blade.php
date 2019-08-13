@extends('admin.layouts.app')
@section('title','Add Service')
@section('content')
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Add Service</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
            {{ Form::open(['route' => 'manage-services.store','name' => 'frm_add', 'id' => 'frm_add','data-toggle'=>"validator", 'role' => 'form', 'files'=>true, 'autocomplete' => 'off','class' =>'']) }}
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Service Title<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('service_title',null,array('id' => 'service_title','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('service_title'))<p class="text-warning">{{ $errors->first('service_title') }}</p>@endif</div> 
              </div>
            </div>
            
            
            
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Service Photo<span class="text-danger">*</span></label>
              <div class="col-sm-5">
               {!! Form::file('service_photo', ['id' => 'service_photo','required','onchange'=>'','class'=>'form-control file-upload-info','placeholder'=>'Upload Photo','accept'=>"jpg,png"]) !!}
               
              <div class="error-hgt">@if ($errors->has('service_photo')) <p class="text-warning">{{ $errors->first('service_photo') }}</p> @endif </div>
              </div>
              
              <div class="col-md-12 mb15">
                <p class="text-danger">
                    Note : Please upload  370*240 (W*H) image for better quality.Image extension should be .jpeg.jpg.png.gif only.
                </p>
              </div>
                 
            </div>
          
            
            <div class="form-group" style="margin-top:15px;">
              <label>Service Details<span class="text-danger">*</span></label>
              {!! Form::textarea('service_details','',array('id' => 'service_details','required', 'class'=>'ckeditor form-control','size' => '30x5','placeholder'=>'')) !!}
              
              <div class="error-hgt">@if ($errors->has('service_details')) <p class="text-warning">{{ $errors->first('service_details') }}</p> @endif</div>
            </div>
            
              
            {{ Form::submit('Save', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-services') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>
            
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>



@endsection