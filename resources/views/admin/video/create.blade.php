@extends('admin.layouts.app')
@section('title','Add Video')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Add Video</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
            {{ Form::open(['route' => 'manage-videos.store','name' => 'frm_add', 'id' => 'frm_add','data-toggle'=>"validator", 'role' => 'form', 'files'=>true, 'autocomplete' => 'off','class' =>'']) }}
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Video Title<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('title',null,array('id' => 'title','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('title'))<p class="text-warning">{{ $errors->first('title') }}</p>@endif</div> 
              </div>
            </div>
            
            
            
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Video<span class="text-danger">*</span></label>
              <div class="col-sm-5">
               {!! Form::file('video', ['id' => 'video','required','onchange'=>'','class'=>'form-control file-upload-info','placeholder'=>'Upload Video','accept'=>"mp4,mov"]) !!}
               
              <div class="error-hgt">@if ($errors->has('video')) <p class="text-warning">{{ $errors->first('video') }}</p> @endif </div>
              </div>
              
              <div class="col-md-12 mb15">
                <p class="text-danger">
                    Note : Video size most be less than 10 MB.Vedio extension should be .mp4 / .mov only.
                </p>
              </div>
                 
            </div>
          
            
            
            
              
            {{ Form::submit('Save', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-videos') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>
            
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>



@endsection