@extends('admin.layouts.app')
@section('title','Add Training')
@section('content')
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Add Training</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {{ Form::open(['route' => 'manage-trainings.store','name' => 'frm_add', 'id' => 'frm_add','data-toggle'=>"validator", 'role' => 'form', 'files'=>true, 'autocomplete' => 'off','class' =>'']) }}

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Training Title</label>
              <div class="col-sm-5">
                {!! Form::text('training_title',null,array('id' => 'training_title','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('training_title'))<p class="text-warning">{{ $errors->first('training_title') }}</p>@endif</div> 
              </div>
            </div>

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Price</label>
              <div class="col-sm-5">
                {!! Form::text('training_price',null,array('id' => 'training_price','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('training_price'))<p class="text-warning">{{ $errors->first('training_price') }}</p>@endif</div> 
              </div>
            </div>
           
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Icon</label>
              <div class="col-sm-5">
                {!! Form::file('training_icon', ['id' => 'training_icon','onchange'=>'','required', 'class'=>'form-control file-upload-info','placeholder'=>'Upload Icon','accept'=>"jpg,png"]) !!}
                
                <div class="error-hgt">@if ($errors->has('training_icon'))<p class="text-warning">{{ $errors->first('training_icon') }}</p>@endif</div> 
              </div>
              <div class="col-md-12 mb15">
                 <p class="text-danger">
                  Note : &nbsp;  Please upload 100*100 banner for better quality.Image extension should be .jpeg.jpg.png.gif only.
                 </p>
               </div>
            </div>
            
            
            <div class="form-group">
              <label>Description<span class="text-danger">*</span></label>
              {!! Form::textarea('training_details','',array('id' => 'training_details','required', 'class'=>'ckeditor form-control','size' => '30x5','placeholder'=>'')) !!}
              
              <div class="error-hgt">@if ($errors->has('training_details')) <p class="text-warning">{{ $errors->first('training_details') }}</p> @endif</div>
            </div>
              
            {{ Form::submit('Save', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-trainings') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>

            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection