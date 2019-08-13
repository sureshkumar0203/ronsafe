@extends('admin.layouts.app')
@section('title','Manage Users')
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
                <div class="col-lg-6"><h5 class="display-5">Manage Users</h5></div>
                <div class="col-lg-6"></div>
              </div>              
              
              <div class="table-responsive">
                <table class="table table-hover" id="tbl_content">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Name </th>
                      <th>Email</th>
                      <th>Contact No.</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($usr_dtls as $usr_res)
                    <tr>
                      <td>{{ $usr_res->id }}</td>
                      <td>{{ $usr_res->full_name }}</td>
                      <td>{{ $usr_res->email }} </td>
                      <td>{{ $usr_res->contact_no }} </td>
                      <td>
                      {{ $usr_res->address1 }} <br />
                      @if($usr_res->address2) ,{{ $usr_res->address2 }}  @endif <br />
                      {{ $usr_res->city }} -  {{ $usr_res->post_code }}  <br />
                      {{ $usr_res->state }} , {{ $usr_res->country }} 
                      </td>
                      <td class="act-inact">@if($usr_res->active_status==1)
                          <a href="{{ URL::to('administrator') }}/manage-users/{{ $usr_res->id }}/unblock" class="linktext"><img src="{{ asset('public/images/red-circle.png') }}" border="0" title="Inactive User"></a>
                          @else
                          <a href="{{ URL::to('administrator') }}/manage-users/{{ $usr_res->id }}/block" class="linktext" onClick="return confirm('Are you sure you want to block this user?')"><img src="{{ asset('public/images/circle-green.png') }}" width="18" height="18" border="0" title="Active User"></a>
                          @endif </td>
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
      "targets": [4,5],
      "orderable": false,
    }]
} );
</script>
@endsection