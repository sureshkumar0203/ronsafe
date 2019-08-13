@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')

{!! Form::open(['url'=>'add-to-cart','METHOD'=>'POST','id'=>'frm_cart']) !!}
  {{ Form::hidden('price_id', $prd_dtls->productPrice[0]->id,['id'=>'price_id'])}}                
  {{ Form::hidden('qty', "1",['id'=>'qty']) }}
{!! Form::close() !!}

<section class="about-area sec-pr-pad bx-shadow">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="about-content">
          <div class="sec-title"> 
              <!-- <h2>dfgdf</h2>--> 
          </div>
          <div class="exzoom hidden" id="exzoom">
            <div class="exzoom_img_box">
              <ul class='exzoom_img_ul'>
                <li><img src="{{ asset('public/product-photo/'.$prd_dtls->prd_photo) }}"  alt=""/></li>
                @foreach($prd_dtls->productOptionalImages as $opt_ph)
                <li><img src="{{ asset('public/product-photo/'.$opt_ph->opt_images) }}"  alt=""/></li>
              @endforeach
              </ul>
            </div>
            <div class="exzoom_nav"></div>
            
            <p class="exzoom_btn"> <a href="javascript:void(0);" class="exzoom_prev_btn"><i class="fa fa-arrow-circle-left"></i></a> <a href="javascript:void(0);" class="exzoom_next_btn"><i class="fa fa-arrow-circle-right"></i></a> </p>
          </div>
        </div>
      </div>
      
      <div class="col-md-8 col-sm-6 col-xs-12">
        <div class="pr-detal">
          <h3>{{ $prd_dtls->prd_name }}</h3>
          <hr />
          
          @if($prd_dtls->prd_cs_opt==0)
          <div> <span class="prc-new"><i class="fa fa-dollar"></i> {{ number_format($prd_dtls->productPrice[0]->prd_price,'2','.','') }} </span> </div>
          @endif
          
          
          <div class="row">
            <div class="col-md-3">
              <!--<table class="table">
                <tr class="pr-det">
                  <td class="bdr-btm pad5">Qty</td>
                </tr>
              
                <tr>
                  <td>
                    <div class="input-group padtop20"> 
                      <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn  btn-number"  data-type="minus" data-field=""><span class="glyphicon glyphicon-minus"></span></button>
                      </span>
                      
                      <input type="text" name="quantity" value="1" size="2" id="quantity" class="form-control qunt input-number" onKeyPress="return numbersonly(event);" readonly/>
                      
                      <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn  btn-number" data-type="plus" data-field=""><span class="glyphicon glyphicon-plus"></span></button>
                      </span> 
                    </div>
                  </td>
                </tr>
              </table>-->
              <div class="clearfix"></div>
              <div class="error-msg"></div>
            </div>
            
            <div class="col-sm-9 col-xs-12">
              <div class="table-responsive">
                @if($prd_dtls->prd_cs_opt==1)
                  {{ Form::hidden('check_prd', 1, ['id'=>'check_prd']) }}
                  <table class="table">
                    <tr class="pr-det">
                      <td class="bdr-btm pad5">Color</td>
                      <td class="bdr-btm pad5">Size</td>
                      <td class="bdr-btm pad5">Price</td>
                    </tr>
                    @foreach($prd_dtls->productPrice as $prd_price_dtls)
                    <tr class="bdr-btm">
                      <td class="pad5"><label class="st"> {{ Form::radio('prd_price_id', $prd_price_dtls->id , false, array('id'=>'prd_price_id','class'=>'','placeholder'=>'')) }} <span class="checkmark" style="background:<?php echo $prd_price_dtls->color->color_code;?>;"></span> </label></td>
                      <td class="pad5"> {{ $prd_price_dtls->size->size }} </td>
                      <td class="pad5"><span class="prc-dtl"><i class="fa fa-dollar"></i> {{ number_format($prd_price_dtls->prd_price,2,'.','') }} </span></td>
                    </tr>
                    @endforeach
                  </table>
                @endif 
              </div>
            </div>
          </div>
          
          <div class="add-sec"> <a href="javascript:void(0);" onclick="addToBasketPrdDetails();" class="btn btn-primary ad-to">ADD TO CART</a> </div>
          
          <hr />
          
          
          
          <div class="desc"> {!! $prd_dtls->prd_details !!} </div>
          
          
          
        </div>
      </div>
      
    </div>
    </div>
</section>


<section class="similar-product">
  <div class="container">
      <h3>Similar Products</h3>
      <hr />
      <div class="row">
      <div class="product owl-carousel owl-theme">
          <div class="list-item box">
          <div class="product-layout product-grid col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
              <div class="product-thumb clearfix">
              <div class="image"> <a href="#"><img src="{{ asset('public/images/products/2.jpg') }}" alt=""></a> </div>
              <div class="caption">
                  <h4 class="title item-title"> <a href="#">Test PID3</a> </h4>
                  <p class="price" style="display:none;"> 5 </p>
                  <p class="price-show"> <span class="price-new"> <i class="fa fa-dollar"></i>5.00 </span> </p>
                </div>
              <p class="newest" style="display:none"> 3</p>
              <div class="button-group">
                  <button class="btn-primary f-none single-action similar-ad-to" type="button" onclick="addToBasket(3);"><span>Add to Cart</span></button>
                </div>
            </div>
            </div>
        </div>
          <div class="list-item box">
          <div class="product-layout product-grid col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
              <div class="product-thumb clearfix">
              <div class="image"> <a href="#"><img src="{{ asset('public/images/products/2.jpg') }}" alt=""></a> </div>
              <div class="caption">
                  <h4 class="title item-title"> <a href="#">Test PID3</a> </h4>
                  <p class="price" style="display:none;"> 5 </p>
                  <p class="price-show"> <span class="price-new"> <i class="fa fa-dollar"></i>5.00 </span> </p>
                </div>
              <p class="newest" style="display:none"> 3</p>
              <div class="button-group">
                  <button class="btn-primary f-none single-action similar-ad-to" type="button" onclick="addToBasket(3);"><span>Add to Cart</span></button>
                </div>
            </div>
            </div>
        </div>
          <div class="list-item box">
          <div class="product-layout product-grid col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
              <div class="product-thumb clearfix">
              <div class="image"> <a href="#"><img src="{{ asset('public/images/products/2.jpg') }}" alt=""></a> </div>
              <div class="caption">
                  <h4 class="title item-title"> <a href="#">Test PID3</a> </h4>
                  <p class="price" style="display:none;"> 5 </p>
                  <p class="price-show"> <span class="price-new"> <i class="fa fa-dollar"></i>5.00 </span> </p>
                </div>
              <p class="newest" style="display:none"> 3</p>
              <div class="button-group">
                  <button class="btn-primary f-none single-action similar-ad-to" type="button" onclick="addToBasket(3);"><span>Add to Cart</span></button>
                </div>
            </div>
            </div>
        </div>
          <div class="list-item box">
          <div class="product-layout product-grid col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
              <div class="product-thumb clearfix">
              <div class="image"> <a href="#"><img src="{{ asset('public/images/products/2.jpg') }}" alt=""></a> </div>
              <div class="caption">
                  <h4 class="title item-title"> <a href="#">Test PID3</a> </h4>
                  <p class="price" style="display:none;"> 5 </p>
                  <p class="price-show"> <span class="price-new"> <i class="fa fa-dollar"></i>5.00 </span> </p>
                </div>
              <p class="newest" style="display:none"> 3</p>
              <div class="button-group">
                  <button class="btn-primary f-none single-action similar-ad-to" type="button" onclick="addToBasket(3);"><span>Add to Cart</span></button>
                </div>
            </div>
            </div>
        </div>
          <div class="list-item box">
          <div class="product-layout product-grid col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
              <div class="product-thumb clearfix">
              <div class="image"> <a href="#"><img src="{{ asset('public/images/products/2.jpg') }}" alt=""></a> </div>
              <div class="caption">
                  <h4 class="title item-title"> <a href="#">Test PID3</a> </h4>
                  <p class="price" style="display:none;"> 5 </p>
                  <p class="price-show"> <span class="price-new"> <i class="fa fa-dollar"></i>5.00 </span> </p>
                </div>
              <p class="newest" style="display:none"> 3</p>
              <div class="button-group">
                  <button class="btn-primary f-none single-action similar-ad-to" type="button" onclick="addToBasket(3);"><span>Add to Cart</span></button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
@include('includes.ma')
@stop
@push('script')
<script src="{{ asset('public/js/jquery.exzoom.js') }}"></script> 
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript">
$('.container').imagesLoaded( function() {
  $("#exzoom").exzoom({
        autoPlay: false,
    });
  $("#exzoom").removeClass('hidden')
});
</script>
@endpush