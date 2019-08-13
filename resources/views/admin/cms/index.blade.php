@extends('admin.layouts.app')
@section('title','Manage Contents')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h5 class="display-5 mb15">Manage Contents</h5>
              <!--<p class="card-description">Add class<code>.table-striped</code></p>-->
              <div class="table-responsive">
                <table id="tbl_content" class="table table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Page Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($cms_data as $cms_res)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $cms_res->page_title }}</td>
                      <td><a href="{{ route('manage-contents.edit',$cms_res->id) }}" title="Edit"> <i class="fa fa-edit icon"></i></a></td>
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