@extends('includes.master')
@section('title') {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keywords }} @stop
@section('description') {{ $seo_info->meta_description }} @stop

@section('content')
<section class="about-area  bx-shadow">
  <div class="container cart-area">
    <div class="row">            
      <div class="col-md-12 col-sm-12">
        <div class="entry-content pt-20">
          <div class="waiting_cart"><img src="{{ asset('public/images/cart_update__.gif') }}" /></div>
          <h3>MY CART</h3>
          <hr />
          @php 
          $cart_det = Helpers::commonCartInformation(); 
          // dd($cart_det);
          @endphp
          @if(count($cart_det[0])>0) 
          <div class="row" id="cart_sec">
            <div class="col-md-9 col-xs-12"> 
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr class="cart-heading">
                      <th style="width:7%">ITEM</th>
                      <th style="width:20%">&nbsp;</th>
                      <th style="width:2%">&nbsp;</th>
                      <th align="center" valign="middle" style="width:13%; text-align:left;">QTY</th>
                      <th align="left" valign="middle" style="width:10%">UNIT PRICE</th>
                      <th align="left" valign="middle" style="width:10%">TOTAL</th>
                      <th style="width:5%">&nbsp;</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($cart_det[0] as $cart_info)
                    <?php //dd($cart_info->total_price) ?>
                    <tr class="cart-rw" id="cart-{{ $cart_info->id }}">
                      <td><img class="cart-img" src="{{ asset('public/product-photo/'.$cart_info->productPrice->product->prd_photo) }}"  alt=""/></td>
                      <td>
                        <h4 class="cart-hd">{{ $cart_info->productPrice->product->prd_name }}</h4>
                        @if($cart_info->size != null)
                        <div>
                           <span class="cart-spn">Size </span>
                           {{ $cart_info->productPrice->size->size }}
                        </div>
                        @endif
                        @if($cart_info->color != null)
                        <div>
                          <span class="cart-spn">{{ $cart_info->productPrice->color->color }}</span>
                          <span class="cart-color" style="background:{{ $cart_info->productPrice->color->color_code }}"></span>
                        </div>
                        @endif
                      </td>
                      <td>&nbsp;</td>
                      <td>
                        <div class="input-group">
                          <span class="input-group-btn">
                              <button type="button" class="quantity-left-minus btn  btn-number qty-dec" data-id="{{ $cart_info->id }}"><span class="glyphicon glyphicon-minus"></span></button>
                          </span>
                          <input type="text" id="quantity{{ $cart_info->id }}" readonly name="quantity" class="form-control qunt input-number" value="{{ $cart_info->qty }}" min="1" max="100">
                          <span class="input-group-btn">
                          <button type="button" class="quantity-right-plus btn btn-number qty-inc" data-id="{{ $cart_info->id }}"><span class="glyphicon glyphicon-plus"></span></button>
                          </span>
                        </div>
                      </td>
                      <td>
                         <p class="price-show">
                            <span class="cartprc">
                            <span class="f-size17">$</span> 
                            {{ number_format($cart_info->productPrice->prd_price,2,'.','') }}
                            </span>
                         </p>
                      </td>
                      <td>
                         <p class="price-show">
                            <span class="cartprc prdtot{{ $cart_info->id }}">
                            <span class="f-size17">$</span> 
                            {{ number_format($cart_info -> total_price,2,'.','') }}
                            </span>
                         </p>
                      </td>
                      <td><a href="javascript:void(0);" onclick="deleteCartItem({{ $cart_info -> id }});"><span class="cartdlt"><i class="fa fa-trash-o"></i></span></a></td>
                    </tr>
                    @endforeach	        
                  </tbody>
                </table>
              </div>
               <hr /> 
               <a href="{{ url('/') }}/products" class="btn cart-shping pull-left">Continue Shopping</a>
            </div>
           
            <div class="col-md-3 col-xs-12"> 
              <div class="cart-summary">
                <h3>CART TOTALS</h3>                           
                <div class="det">
                  <div class="det-left">Item Total</div>
                  <div class="det-right total_price">&dollar; {{ number_format($cart_det[1],'2','.','') }}</div>
                </div>
                  
                <div class="det">
                    <div class="det-left">Shipping</div>
                    <div class="det-right">
                    <span id="disp_ship"> &dollar; {{ number_format($cart_det[2],'2','.','') }}</span>
                    </div>
                </div>
                <hr />
                
                <div class="tot-order">
                  <div class="det-left">Order Total</div>
                  <div class="det-right">
                    <span id="disp_gt" class="amount-bold">
                     &dollar; {{ number_format($cart_det[3],'2','.','') }} 
                    </span> 
                  </div>
                  <div class="clearfix"></div>
                </div>
                <a href="{{ url('/checkout') }}" class="btn  cart-chkout pull-right">Checkout</a>                  <div class="clearfix"></div>
                  </div>
            </div>
          </div>
          
          @else
          <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="empty-cart-box">
           <img class="cart-img bdr-none" src="{{ asset('public/images/empty-cart.png') }}"  alt=""/>
           
            <h2 style="text-align:center; color:#F00;">Your shopping cart is empty....</h2>

            <div style="text-align:center; color:#F00;">
              <a href="{{ url('/') }}/products" class="btn cart-shping"><i class="fa fa-hand-pointer-o"></i> Click Here to Continue Shopping</a>
            </div>
            </div>
          </div>
          @endif
          
          
          <div class="col-md-12 col-sm-12 col-xs-12" id="cart_emp_sec" style="display:none;">
           <div class="empty-cart-box">
           <img class="cart-img bdr-none" src="{{ asset('public/images/empty-cart.png') }}"  alt=""/>
           
            <h2 style="text-align:center; color:#F00;">Your shopping cart is empty....</h2>

            <div style="text-align:center; color:#F00;">
              <a href="{{ url('/') }}/products" class="btn cart-shping"><i class="fa fa-hand-pointer-o"></i> Click Here to Continue Shopping</a>
            </div>
            </div>
          </div>
          
      
      
        </div>
      </div>
    </div>
  </div>
</section>
@stop