@extends('admin.layouts.app')
@section('title','Manage Products')
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
                <div class="col-lg-6"><h5 class="display-5">Manage Products</h5></div>
                <div class="col-lg-6">
                  <a class="btn btn-primary btn-fw float-right" href="{{ route('manage-products.create') }}"><i class="fa fa-plus"></i> Add Product</a>
                </div>
              </div>
              
              
              <div class="table-responsive">
                <table class="table table-hover" id="tbl_content">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category Name</th>
                      <th>Product Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($prd_data as $prd_res)
                    <tr>
                      <td>{{ $prd_res->id }}</td>
                      <td>{{ $prd_res->category->cat_name }}</td>
                      <td>{{ $prd_res->prd_name }} </td>
                      <td>
                      <a href="{{ route('manage-products.edit',$prd_res->id) }}" title="Edit"> <i class="fa fa-edit icon"></i></a>
                      
                       <a href="{{ URL::to('administrator') }}/manage-products/{{ $prd_res->id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><i class="fa fa-trash-o delete"></i></a>
                       
                     
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
  "order": [[ 0, "desc" ]],
  "columnDefs": [ {
      "targets": [3],
      "orderable": false,
    }]
} );
</script>
@endsection