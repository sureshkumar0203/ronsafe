@extends('admin.layouts.app')
@section('title','Add Testimonial')
@section('content')
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Add Testimonial</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
            {{ Form::open(['route' => 'manage-testimonials.store','name' => 'frm_add', 'id' => 'frm_add','data-toggle'=>"validator", 'role' => 'form', 'files'=>true, 'autocomplete' => 'off','class' =>'']) }}
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('name',null,array('id' => 'name','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('name'))<p class="text-warning">{{ $errors->first('name') }}</p>@endif</div> 
              </div>
            </div>
            
           
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Message<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::textarea('message','',array('id' => 'message','required', 'class'=>' ckeditor form-control','size' => '30x15','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('message'))<p class="text-warning">{{ $errors->first('message') }}</p>@endif</div> 
              </div>
            </div>
            
            
            {{ Form::submit('Save', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-testimonials') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>
            
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>



@endsection