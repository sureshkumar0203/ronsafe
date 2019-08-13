@extends('admin.layouts.app')
@section('title','Add Banner')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Add Banner</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {{ Form::open(['route' => 'manage-banners.store','name' => 'frm_add', 'id' => 'frm_add','data-toggle'=>"validator", 'role' => 'form', 'files'=>true, 'autocomplete' => 'off','class' =>'']) }}

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Banner<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::file('banner_photo', ['id' => 'banner_photo','onchange'=>'','required', 'class'=>'form-control file-upload-info','placeholder'=>'Upload Banner','accept'=>"jpg,png"]) !!}
                
                <div class="error-hgt">@if ($errors->has('banner_photo'))<p class="text-warning">{{ $errors->first('banner_photo') }}</p>@endif</div> 
              </div>
               
               <div class="col-md-12 mb15">
                 <p class="text-danger">
                  Note : &nbsp;  Please upload 1920*600 banner for better quality.Image extension should be .jpeg.jpg.png.gif only.
                 </p>
               </div>
            
            </div>

           
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Link CMS Page</label>
              <div class="col-sm-5">
               {!! Form::select('cp_id',$cms_data,'', ['id' => 'cp_id', 'class'=>'form-control','placeholder'=>'Select CMS Page']) !!} 
               
                <div class="error-hgt">@if ($errors->has('cp_id'))<p class="text-warning">{{ $errors->first('cp_id') }}</p>@endif</div> 
              </div>
            </div>
              
           
              
            {{ Form::submit('Save', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-banners') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>

            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection