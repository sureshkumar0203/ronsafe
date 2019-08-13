@extends('admin.layouts.app')
@section('title','Manage Banners')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6"><h5 class="display-5">Manage Banners</h5></div>
                <div class="col-lg-6"><a class="btn btn-primary btn-fw float-right" href="{{ route('manage-banners.create') }}"><i class="fa fa-plus"></i> Add Banner</a></div>
              </div>
              
              <div class="table-responsive">
                <table class="table table-hover" id="tbl_content">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Banner</th>
                      <th>CMS Link Page</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($banner_data as $banner_res)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td><img src="{{ asset('public/banners/'.$banner_res->banner_photo) }}" alt="Banner"/></td>
                      <td>@if($banner_res->cmsPageLink!=null) {{ $banner_res->cmsPageLink->page_title }} @endif</td>
                      <td>
                      <a href="{{ route('manage-banners.edit',$banner_res->id) }}" title="Edit"> <i class="fa fa-edit icon"></i></a>
                      
                       <a href="{{ URL::to('administrator') }}/manage-banners/{{ $banner_res->id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><i class="fa fa-trash-o delete"></i></a>
                       
                     
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection