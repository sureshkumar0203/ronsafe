@extends('admin.layouts.app')
@section('title','Edit Color')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script>  

<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit Color</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {!! Form::model($color_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off','route' => ['manage-color.update', $color_data->id]]) !!}
             
             

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Color Name<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('color',$color_data->color,array('id' => 'color','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('color'))<p class="text-warning">{{ $errors->first('color') }}</p>@endif</div> 
              </div>
            </div>

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Color Code<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('color_code',$color_data->color_code,array('id' => 'color_code','required', 'class'=>'form-control colorpicker colorpicker-component','placeholder'=>'','readonly' => 'readonly')) !!}
                <span style="background:<?php echo $color_data->color_code; ?>;" class="color-box"></span>
                
                <div class="error-hgt">@if ($errors->has('color_code'))<p class="text-warning">{{ $errors->first('color_code') }}</p>@endif</div> 
              </div>
            </div>
            <div class="clearfix mt-20"></div>
            
            <div class="row"> 
           <div class="col-sm-12"> 
            {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-color') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>
            </div>
            </div>
            

            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
<script type="text/javascript">
  $('.colorpicker').colorpicker();
</script>
@endsection