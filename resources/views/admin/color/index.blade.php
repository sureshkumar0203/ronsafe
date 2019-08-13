@extends('admin.layouts.app')
@section('title','Manage Color')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row mb15">
                <div class="col-lg-6"><h5 class="display-5">Manage Color</h5></div>
                <div class="col-lg-6"><a class="btn btn-primary btn-fw float-right" href="{{ route('manage-color.create') }}"><i class="fa fa-plus"></i> Add Color</a></div>
              </div>
              <div class="clearfix"></div>
              
              <div class="table-responsive">
                <table id="tbl_content" class="table table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Color</th>
                      <th>Color Code</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($color_data as $color_res)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $color_res->color }} </td>
                      <td> <span style="background:<?php echo $color_res->color_code; ?>; height:20px; width:20px; border:1px solid #ccc; display:inline-block;"></span> </td>
                      <td>
                      <a href="{{ route('manage-color.edit',$color_res->id) }}" title="Edit"> <i class="fa fa-edit icon"></i></a>
                      
                       <a href="{{ URL::to('administrator') }}/manage-color/{{ $color_res->id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><i class="fa fa-trash-o delete"></i></a>
                       
                     
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
@include('admin.includes.data-tables-lib')
<script>
$('#tbl_content').dataTable( {
  /*"paging":   false,
  "info":     false,
  "searchable": false,*/
  "order": [[ 1, "desc" ]],
  "columnDefs": [ {
      "targets": [0,2,3],
      "orderable": false,
    }]
} );
</script>
@endsection