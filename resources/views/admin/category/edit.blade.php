@extends('admin.layouts.app')
@section('title','Edit Category')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit Category</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {!! Form::model($cat_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off','route' => ['manage-category.update', $cat_data->id]]) !!}
             
             

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category Name<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('cat_name',$cat_data->cat_name,array('id' => 'cat_name','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('cat_name'))<p class="text-warning">{{ $errors->first('cat_name') }}</p>@endif</div> 
              </div>
            </div>

            
            
            {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }}
              
            <a href="{{ URL::to('administrator/manage-category') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>
            

            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection