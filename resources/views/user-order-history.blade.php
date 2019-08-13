@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')
<section class="dashboard bx-shadow">
<div class="container ">
  <div class="row mtb-50">
  @include('includes.user-sidebar')
  <div class="col-md-9 myaccount-box pad0">
  	<div class="_title">Order History</div>
    <div class="marlr10">
      <table width="100%" class="order-history table-striped mb-50  mt-20 mb-20" id="no-more-tables">
        <thead>
          <tr>
              <th>Order Id</th>
              <th>Order Date</th>
              <th>Transaction  ID</th>
              <th>Grand Total</th>
              <th>Shipping Status</th>
              <th>Details</th>
          </tr>
        </thead>
        
        <tbody>
         @if($order_info->count() > 0)
         @foreach($order_info as $order_res)
          <tr>
            <td data-title="Order Id">{{ $order_res->id }} </td>
            <td data-title="Order Date">{{ date("jS M, Y",strtotime($order_res->created_at)) }}</td>
            <td data-title="Payer ID">{{ $order_res->transaction_id }}</td>
            <td data-title="Grand Total">
            	&dollar; {{ number_format($order_res->grand_total,2,'.','') }}
            </td>
            <td>
            @if($order_res->order_status==0) 
              <span style="font-weight:bold; color:#F00;">Not Yet Shipped</span>
            @else
              <span style="font-weight:bold; color:#060;">Shipped</span>
            @endif
            </td>
            <td align="center" data-title="Deatils">
            	<a href="user-order-details/{{ $order_res->id }}/details" class="btn btn-primary btn-sm "><i class="fa fa-eye text-white"></i></a>
            </td>
          </tr>
          @endforeach
          @else
          	<tr><td colspan="6" class="no-ord-f red">No Order Found !!</td></tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>
</section>
@stop