@extends('admin.layouts.app')
@section('title','Edit Content')
@section('content') 
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<div class="container-fluid page-body-wrapper"> @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit Content</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            {!! Form::model($cms_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','route' => ['manage-contents.update', $cms_data->id],'data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off']) !!}
             
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Page Title<span class="text-danger">*</span></label>
              <div class="col-sm-5"> {!! Form::text('page_title',$cms_data->page_title, array('id' => 'page_title', 'class'=>'form-control','placeholder'=>'')) !!}
                <div class="error-hgt">@if ($errors->has('page_title'))
                  <p class="text-warning">{{ $errors->first('page_title') }}</p>
                  @endif</div>
              </div>
            </div>
            <div class="form-group">
              <label>Description<span class="text-danger">*</span></label>
              {!! Form::textarea('content',$cms_data->content,array('id' => 'content','required', 'class'=>'ckeditor form-control','size' => '30x5','placeholder'=>'')) !!}
              <div class="error-hgt">@if ($errors->has('content'))
                <p class="text-warning">{{ $errors->first('content') }}</p>
                @endif</div>
            </div>
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Title<span class="text-danger">*</span></label>
              <div class="col-sm-5"> {!! Form::text('meta_title',$cms_data->meta_title, array('id' => 'meta_title','required', 'class'=>'form-control','placeholder'=>'')) !!}
                <div class="error-hgt">@if ($errors->has('meta_title'))
                  <p class="text-warning">{{ $errors->first('meta_title') }}</p>
                  @endif</div>
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Keywords<span class="text-danger">*</span></label>
              <div class="col-sm-5"> {!! Form::textarea('meta_keywords',$cms_data->meta_keywords,array('id' => 'meta_keywords','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                <div class="error-hgt">@if ($errors->has('meta_keywords'))
                  <p class="text-warning">{{ $errors->first('meta_keywords') }}</p>
                  @endif</div>
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Description<span class="text-danger">*</span></label>
              <div class="col-sm-5"> {!! Form::textarea('meta_description',$cms_data->meta_description,array('id' => 'meta_description','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                <div class="error-hgt">@if ($errors->has('meta_description'))
                  <p class="text-warning">{{ $errors->first('meta_description') }}</p>
                  @endif</div>
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Photo</label>
              <div class="col-sm-5"> {!! Form::file('cms_photo', ['id' => 'cms_photo','onchange'=>'','class'=>'form-control file-upload-info','placeholder'=>'Upload Photo if any','accept'=>"jpg,png"]) !!}
                <div class="error-hgt">@if ($errors->has('cms_photo'))
                  <p class="text-warning">{{ $errors->first('cms_photo') }}</p>
                  @endif</div>
              </div>
              <div class="col-md-12 mb15">
                <p class="text-danger"> Note : Please upload  W=286 & H=394 image for better quality.Image extension should be .jpeg.jpg.png.gif only. </p>
                @if($cms_data->cms_photo)
                <div class="form-group"> 
                  <img class="cms-img" src="{{ asset('public/cms-photo/'.$cms_data->cms_photo) }}" alt="Photo" style="height:100px;"/><br>
                  <a href="javascript:void(0);" data-id="{{ $cms_data->id }}" class="trash" style="font-size: 19px;color: #fb584f;text-align: center;margin-left: 3.5%;"><i class="fa fa-trash-o"></i></a>
                </div>
                @endif </div>
            </div>
            {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }} <a href="{{ URL::to('administrator/manage-contents') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a> {{ Form::close() }} </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer') </div>
</div>
@endsection
@push('script')
<script>
  $('.trash').on('click', function(){
  var id = $(this).attr('data-id');
  if(id != ''){
    $.ajax({
      type:'POST',
      url: '{{ url("delete-cms-img") }}',
      data: {'id': id},
      dataType:'JSON',
      success:function(data){                        
        if(data.response == 'success'){
          $('.cms-img').remove();
          $('.trash').remove();
        }else{
          alert('Something went wrong!');
        }
       }
    });
  }else{
    alert('Something went wrong!');
  }
});
</script>
@endpush