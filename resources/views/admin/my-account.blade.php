@extends('admin.layouts.app')
@section('title','My Account')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">My Account</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
                  
            {{ Form::open(array('url' => 'administrator/update-admin-details', 'role' => 'form', 'class' =>'forms-sample', 'name' => 'frm_adm_det', 'id' => 'frm_adm_det', 'autocomplete' => 'off')) }}
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::text('admin_name',$admin_dtls->admin_name, array('id' => 'admin_name','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
                  <div class="error-hgt"> @if ($errors->has('admin_name')) <p class="text-warning">{{ $errors->first('admin_name') }}</p> @endif</div> 
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">login Email<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::email('email',$admin_dtls->email, array('id' => 'email','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
                   <div class="error-hgt">@if ($errors->has('email')) <p class="text-warning">{{ $errors->first('email') }}</p> @endif</div>
                </div>
              </div>
              
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Contact Email<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::email('alt_email',$admin_dtls->alt_email, array('id' => 'alt_email','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
     <div class="error-hgt">@if ($errors->has('alt_email')) <p class="text-warning">{{ $errors->first('alt_email') }}</p> @endif</div> 
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Contact No.<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::text('contact_no',$admin_dtls->contact_no, array('id' => 'contact_no','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
          <div class="error-hgt">@if ($errors->has('contact_no')) <p class="text-warning">{{ $errors->first('contact_no') }}</p> @endif</div> 
                </div>
              </div>
              
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Mobile No.<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::text('mobile_no',$admin_dtls->mobile_no, array('id' => 'mobile_no','required', 'class'=>'form-control','placeholder'=>'')) !!}
                  
          <div class="error-hgt">@if ($errors->has('mobile_no')) <p class="text-warning">{{ $errors->first('mobile_no') }}</p> @endif</div>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Address<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  {!! Form::textarea('address',$admin_dtls->address,array('id' => 'address','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                  
               <div class="error-hgt">@if ($errors->has('address')) <p class="text-warning">{{ $errors->first('address') }}</p> @endif </div>
                </div>
              </div>
              
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Facebook URL</label>
                <div class="col-sm-5">
                  {!! Form::url('facebook_url',$admin_dtls->facebook_url, array('id' => 'facebook_url', 'class'=>'form-control','placeholder'=>'')) !!}
                  
   <div class="error-hgt">@if ($errors->has('facebook_url')) <p class="text-warning">{{ $errors->first('facebook_url') }}</p> @endif</div>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Twitter URL</label>
                <div class="col-sm-5">
                  {!! Form::text('twitter_url',$admin_dtls->twitter_url, array('id' => 'twitter_url', 'class'=>'form-control','placeholder'=>'')) !!}
                  
              <div class="error-hgt"> @if ($errors->has('twitter_url')) <p class="text-warning">{{ $errors->first('twitter_url') }}</p> @endif </div>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Instagram URL</label>
                <div class="col-sm-5">
                  {!! Form::url('instagram_url',$admin_dtls->instagram_url, array('id' => 'instagram_url', 'class'=>'form-control','placeholder'=>'')) !!}
                  
          <div class="error-hgt">@if ($errors->has('instagram_url')) <p class="text-warning">{{ $errors->first('instagram_url') }}</p> @endif</div> 
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