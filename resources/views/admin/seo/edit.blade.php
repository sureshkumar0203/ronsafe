@extends('admin.layouts.app')
@section('title','Edit Seo Information')
@section('content')
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit SEO Information</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            {!! Form::model($seo_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','route' => ['manage-seo-settings.update', $seo_data->id],'data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off']) !!}
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Page Title<span class="text-danger">*</span></label>
              <div class="col-sm-5"> {{ $seo_data->page_name }}
              </div>
            </div>
              
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Title<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('meta_title',$seo_data->meta_title, array('id' => 'meta_title','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
   <div class="error-hgt">@if ($errors->has('meta_title')) <p class="text-warning">{{ $errors->first('meta_title') }}</p> @endif</div> 
              </div>
            </div>
              
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Keywords<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::textarea('meta_keywords',$seo_data->meta_keywords,array('id' => 'meta_keywords', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('meta_keywords')) <p class="text-warning">{{ $errors->first('meta_keywords') }}</p> @endif</div> 
              </div>
            </div>
              
              
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Description<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::textarea('meta_description',$seo_data->meta_description,array('id' => 'meta_description','class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('meta_description')) <p class="text-warning">{{ $errors->first('meta_description') }}</p> @endif</div>
              </div>
            </div>
            
              
            {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-seo-settings') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>

            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection