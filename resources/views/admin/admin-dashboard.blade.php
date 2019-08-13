@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row mb15">
      <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
            <div class="card-body">
      
        <div class="col-lg-6"><h5 class="display-5">New Orders</h5></div>
        <div class="col-lg-6"></div>
              
        <div class="table-responsive">
          <table class="table table-hover nwod" id="tbl_content">
            <thead>
              <tr>
                <th>Name </th>
                <th>#Order ID</th>
                <th>Order Date</th>
                <th>Grand Total</th>
                <th>Order Status</th>
                <th>Action</th>
              </tr>
            </thead>
            
            <tbody>
              @foreach($order_dtls as $order_res)
              <tr>
                <td align="left" valign="middle">{{ $order_res->full_name }}</td>
                <td style="text-align:center;">{{ $order_res->id }}</td>
                <td>{{ date("jS M, Y",strtotime($order_res->created_at)) }} </td>
                <td style="text-align:right;">
                &dollar; {{ number_format($order_res->grand_total,2,'.','') }}
                </td>
                <td style="text-align:center;">
                @if($order_res->order_status==0) 
                  <span style="font-weight:bold; color:#F00;">Not Yet Shipped</span>
                @else
                  <span style="font-weight:bold; color:#060;">Shipped</span>
                @endif
                </td>
                <td class="act-inact">
                <a href="order-details/{{ $order_res->id }}/details" class="btn btn-warning btn-sm view-btn"><i class="fa fa-eye"></i></a>
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