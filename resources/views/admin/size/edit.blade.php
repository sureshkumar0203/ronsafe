@extends('admin.layouts.app')
@section('title','Edit Size')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit Size</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {!! Form::model($size_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off','route' => ['manage-size.update', $size_data->id]]) !!}
             
             

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Size<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('size',$size_data->size,array('id' => 'size','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('size'))<p class="text-warning">{{ $errors->first('size') }}</p>@endif</div> 
              </div>
            </div>

            
            
            {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-size') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>
            

            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection