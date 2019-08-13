@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')

<section class="dashboard bx-shadow">
<div class="container">
  <div class="row mtb-50">
  	@include('includes.user-sidebar')
    <div class="col-md-9 myaccount-box pad0">
    	<div class="_title">
        <div class="pull-left">Order Details </div>
        
        <a class="btn btn-info pull-right btn-txt" href="{{ url('user-order-history')}}">
        <i class="fa fa-angle-left text-white"></i> <span class="text-white">Back</span></a>
        <div class="clearfix"></div>
        </div>
        
    	<div class="col-md-1"></div>
        <div class="col-md-10 mt-20 mb-20">         
         <div class="form-group row">
              <div class="col-md-12" >
                <strong>Order ID</strong> : {{ $order_dtls->id }} <br />
                <strong style="color:#F00;">Order Note</strong> : {{ $order_dtls->order_notes }}
                <hr>
                </div><br><br>
                <div class="clearfix"></div>
           
                <div class="col-md-4" >
                <strong>Contact Information</strong>  <br />
                <hr>
                <span class="desc">
                Contact No. : {{ $order_dtls->contact_no }}  <br />
                Email : {{ $order_dtls->email }}  <br /> <br />
                
                <strong>Order Status </strong> <br />
                @if($order_dtls->order_status==0) 
                  <span style="font-weight:bold; color:#F00;">Not Yet Shipped</span>
                @else
                  <span style="font-weight:bold; color:#060;">Shipped</span>
                @endif
                
                </span>
                </div>
                
                <div class="col-md-4" >                
                <strong>Shipping Address</strong>  <br /> 
                  <hr>   
                  <span class="desc">             
               		 Nmae : {{ $order_dtls->full_name }}  <br />           
                  {{ $order_dtls->address1 }} <br />
                  @if($order_dtls->address2!=NULL) {{ $order_dtls->address2 }} <br />@endif
                  {{ $order_dtls->city }} - {{ $order_dtls->post_code }} <br />
                  {{ $order_dtls->state }} , {{ $order_dtls->country }}
                </span>
                </div>
                
                <div class="col-md-4" >
                <strong>Order Information</strong><br>
                  <hr>
                  <span class="desc">
               <strong>Order Date :</strong> {{ date("jS M, Y",strtotime($order_dtls->created_at)) }}  <br />
                <strong>Transaction ID : </strong> {{ $order_dtls->transaction_id }}  <br />
                <strong>Item Total : </strong>&dollar; {{ number_format($order_dtls->total_amount,'2','.','') }}  <br />
                <strong>Shipping : </strong>&dollar; {{ number_format($order_dtls->shipping_amount,'2','.','') }}  <br />
                <strong>Grand Total : </strong>&dollar; {{ number_format($order_dtls->grand_total,'2','.','') }}  <br />
                </span>
                </span>
                </div>
               
               <div class="clearfix"></div> 
                <hr>
                @if($order_items)
                  <div class="_title mt-20">Item Information</div> 
                  <table class="order-history table-striped mb-20" width="100.1%">
                    <thead>
                      <tr>
                        <th>Product photo</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($order_items as $item_det)
                      <tr>
                        <td align="center">
                        	<a href="{{ url('/') }}/product-details/{{ $item_det->productPrice->product->id }}-{{ $item_det->productPrice->product->prd_slug }}"><img src="{{ asset('public/product-photo/'.$item_det->productPrice->product->prd_photo) }}"  alt="" height="30"/></a>
                        </td>
                        <td>{{ $item_det->productPrice->product->prd_name }}</td>
                         <td>
                         @if($item_det->productPrice->size != null)
                         	{{ $item_det->productPrice->size->size }}
                         @endif
                         </td>
                         <td align="center">
                          @if($item_det->productPrice->color != null)
                          <span class="item-color" style="background:<?php echo $item_det->productPrice->color->color_code; ?>;"></span>
                          {{ $item_det->productPrice->color->color }}
                          @endif
                        </td>
                        <td>{{ $item_det -> qty }}</td>
                        <td>&dollar; {{ number_format($item_det -> unit_price,2,'.','') }}</td>
                        <td>&dollar; {{ number_format($item_det -> total_price,2,'.','') }}</td>
                      </tr>
                      @endforeach	  			  
                    </tbody>
                  </table>
                @endif 
            
            
            </div>
          
        </div>
          
  <div class="col-md-1"></div>
    </div>
  </div>
</div>



</section>

@include('includes.ma')
@stop