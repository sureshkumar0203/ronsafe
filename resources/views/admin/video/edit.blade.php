@extends('admin.layouts.app')
@section('title','Edit Video')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit Video</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
            {!! Form::model($video_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','route' => ['manage-videos.update', $video_data->id],'data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off']) !!}
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Title<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('title',$video_data->title, array('id' => 'title', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('title'))<p class="text-warning">{{ $errors->first('title') }}</p>@endif</div> 
              </div>
            </div>
             
             <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Video</label>
              <div class="col-sm-5">
                {!! Form::file('video', ['id' => 'video','onchange'=>'','class'=>'form-control file-upload-info','placeholder'=>'Upload Video','accept'=>"mp4,mov"]) !!}
                
                <div class="error-hgt">@if ($errors->has('video')) <p class="text-warning">{{ $errors->first('video') }}</p> @endif</div>
              </div>
              
              <div class="col-md-12 mb15">
                <p class="text-danger">
                    Note : Video size most be less than 10 MB.Vedio extension should be .mp4 / .mov only.
                  </p>
                
                  @if($video_data->video)
                  <div class="form-group">
                  <video width="400" controls>
                    <source src="{{ asset('public/video') }}/{{ $video_data->video }}" type="video/mp4">
                  </video>
                  </div>
                  @endif
              </div>
              </div>
            
            
        
        
              
            {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }}
              
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