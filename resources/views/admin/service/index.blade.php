@extends('admin.layouts.app')
@section('title','Manage Services')
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
                <div class="col-lg-6"><h5 class="display-5">Manage Services</h5></div>
                <div class="col-lg-6">
                  <a class="btn btn-primary btn-fw float-right" href="{{ route('manage-services.create') }}"><i class="fa fa-plus"></i> Add Service</a>
                </div>
              </div>
              
              <div class="table-responsive">
                <table id="tbl_content" class="table table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Service Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($service_data as $service_res)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $service_res->service_title }}</td>
                      <td>
                      <a href="{{ route('manage-services.edit',$service_res->id) }}" title="Edit"> <i class="fa fa-edit icon"></i></a>
                      
                     <a href="{{ URL::to('administrator') }}/manage-services/{{ $service_res->id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><i class="fa fa-trash-o delete"></i></a>
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
      "targets": [0,2],
      "orderable": false,
    }]
} );
</script>
@endsection