@extends('admin.layouts.app')
@section('title','Edit Membership & Affiliation')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit Membership & Affiliation</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {!! Form::model($ma_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off','route' => ['manage-ma.update', $ma_data->id]]) !!}
             
             

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Membership & Affiliation Photo<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::file('member_photo', ['id' => 'member_photo','onchange'=>'','required', 'class'=>'form-control file-upload-info','placeholder'=>'Upload Banner','accept'=>"jpg,png"]) !!}
                
                <div class="error-hgt">@if ($errors->has('member_photo'))<p class="text-warning">{{ $errors->first('member_photo') }}</p>@endif</div> 
              </div>
              <div class="col-md-12 mb15">
                <p class="text-danger">
                Note : Please upload 119*89 photo for better quality.Image extension should be .jpeg.jpg.png.gif only.
                </p>
                
                <div class="form-group">
                <img src="{{ asset('public/ma-photo/'.$ma_data->member_photo) }}" alt="Member Photo" style="width:15%"/>
                </div>
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