@extends('admin.layouts.app')
@section('title','Training Booking Details')
@section('content')
 
<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Order Details  <a class="btn btn-primary pull-right" href="{{ url('/administrator/manage-orders')}}">
            <i class="fa fa-angle-left"></i><span class="btn-txt">Back</span></a></h5>
            <!--.text-danger.text-warning .text-info-->
            
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
              <div class="form-group row">
              <div class="col-md-12" >
              <?php //dd($order_dtls); ?>
                <strong>Order ID</strong> : {{ $order_dtls->id }}<br />
                <strong style="color:#F00;">Note </strong> : {{ $order_dtls->order_notes }}
                <hr>
                </div><br><br>
                <div class="clearfix"></div>
           
                <div class="col-md-4" >
                <strong>Contact Information</strong>  <br />
                <hr>
                <span class="desc">
                <strong>Contact No</strong>. : {{ $order_dtls->contact_no }}  <br />
                <strong>Email</strong> : {{ $order_dtls->email }}  <br /> <br />
                
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
                   <strong>Nmae</strong> : {{ $order_dtls->full_name }}  <br />           
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
                <strong>Order Date : </strong> {{ date("jS M, Y",strtotime($order_dtls->created_at)) }}  <br />
                <strong>Transaction ID : </strong> {{ $order_dtls->transaction_id }}  <br />
                <strong>Item Total : </strong>&dollar; {{ number_format($order_dtls->total_amount,'2','.','') }}  <br />
                <strong>Shipping : </strong>&dollar; {{ number_format($order_dtls->shipping_amount,'2','.','') }}  <br />
                <strong>Grand Total : </strong>&dollar; {{ number_format($order_dtls->grand_total,'2','.','') }}  <br />
                </span>
                </div>
                
                @if($order_items)
                <div class="clearfix" style="margin-top:30px;"></div>
                <hr class="marlr15">
                  <div class="_title  col-md-12"><strong>Item Information</strong></div>
                  <hr class="marlr15">
                  <div class="clearfix"></div> 
                  <div class="_title  col-md-12">
                  <table class="order-history table-striped mb-20 oh" width="100%" border="1">
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
                  </div>
                @endif 
                
                
            {{ Form::open(array('url' => 'administrator/update-order-status', 'role' => 'form', 'class' =>'form-horizontal row-border half-block', 'name' => 'frm_od', 'id' => 'frm_od','files'=>true, 'autocomplete' => 'off')) }} 
            
            {!! Form::hidden('order_id',$order_dtls->id, ['id' => 'order_id']) !!}
             
             

            <div class="form-group row" style="margin-top:25px;">
              <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Order Status</label>
              <div class="col-sm-8">
                {!! Form::select('order_status', ['1'=>'Shipped',0=>"Not Shipped"], $order_dtls->order_status, [($order_dtls->order_status ? 'disabled':''),'id' => 'order_status','class' => 'form-control','required','placeholder'=>'Choose Order Status']) !!}
                
                <div class="error-hgt">@if ($errors->has('order_status'))<p class="text-warning">{{ $errors->first('order_status') }}</p>@endif</div> 
              </div>
            </div>
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Tracking URL</label>
              <div class="col-sm-8">
                {!! Form::url('shipping_url',$order_dtls->shipping_url,array('id' => 'shipping_url', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('shipping_url'))<p class="text-warning">{{ $errors->first('shipping_url') }}</p>@endif</div> 
              </div>
            </div>
            
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Tracking No.</label>
              <div class="col-sm-8">
                {!! Form::text('tracking_id',$order_dtls->training_title,array('id' => 'tracking_id', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('tracking_id'))<p class="text-warning">{{ $errors->first('tracking_id') }}</p>@endif</div> 
              </div>
            </div>
            
            <div>
            @if (Session::has('success'))
            	<span style="color:#090;">Order status has been changed successfully.</span>
            @endif
            
            @if (Session::has('failed'))
            	<span style="color:#F00;">Please change order status.</span>
            @endif
            
            
            </div>
            
            @if($order_dtls->order_status==0)
             {{ Form::submit('Update', ['class' => 'btn btn-success','id'=>'updt_btn']) }}
            @else
            {{ Form::submit('Update', [('disabled'),'class' => 'btn btn-success','id'=>'updt_btn']) }}
            @endif
            
            
            {{ Form::close() }}  
              
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection