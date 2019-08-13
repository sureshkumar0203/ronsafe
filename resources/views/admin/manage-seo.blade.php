@extends('admin.layouts.app')
@section('title','Manage Seo')
@section('content')
 
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Manage Seo</h5>
            <!--.text-danger.text-warning .text-info-->
            
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
                  
            {{ Form::open(array('url' => 'administrator/update-seo-details', 'role' => 'form', 'class' =>'forms-sample', 'name' => 'frm_adm_det', 'id' => 'frm_adm_det', 'autocomplete' => 'off')) }}
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Title<span class="text-danger">*</span>:</label>
                <div class="col-sm-5">
                  {!! Form::textarea('meta_title',($seo_dtls->meta_title) ? $seo_dtls->meta_title : "" ,array('id' => 'meta_title','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                  
               <div class="error-hgt">@if ($errors->has('meta_title')) <p class="text-warning">{{ $errors->first('meta_title') }}</p> @endif </div>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Keyword<span class="text-danger">*</span>:</label>
                <div class="col-sm-5">
                  {!! Form::textarea('meta_keyword',$seo_dtls->meta_keyword,array('id' => 'meta_keyword','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                  
               <div class="error-hgt">@if ($errors->has('meta_keyword')) <p class="text-warning">{{ $errors->first('meta_keyword') }}</p> @endif </div>
                </div>
              </div>
              
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Description:<span class="text-danger">*</span>:</label>
                <div class="col-sm-5">
                  {!! Form::textarea('meta_descr',$seo_dtls->meta_descr,array('id' => 'meta_descr','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                  
               <div class="error-hgt">@if ($errors->has('meta_descr')) <p class="text-warning">{{ $errors->first('meta_descr') }}</p> @endif </div>
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