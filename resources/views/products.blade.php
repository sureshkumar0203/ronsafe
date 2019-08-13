@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(3)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(3)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(3)->meta_descr }} @stop
@section('page-script')
<link href="{{ asset('public/css/jplist.core.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/jplist.textbox-filter.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/jplist.pagination-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/jplist.filter-toggle-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0-rc.1/themes/smoothness/jquery-ui.css" />
<link href="{{ asset('public/css/jplist.jquery-ui-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')
<section class="about-area sec-pad bx-shadow">
  <div class="container">
    <div id="demo" class="box jplist">
      <div class="jplist-panel box panel-top">
        <div class="row"> 
          <!-- Left Part category section-->
          <aside id="column-left" class="col-sm-3 hidden-xs">
            <h3 class="subtitle"><span>Categories</span></h3>
            <div class="box-category">
              <div class="jplist-group" data-control-type="checkbox-group-filter" data-control-action="filter" data-control-name="themes">
                <ul id="categoey-item">
                  @foreach($lp_cat as $lp_cat_det)
                  <li>
                    <input  data-path=".{{ "cls".$lp_cat_det->
                    id }}" id="{{ "cls".$lp_cat_det->cat_id }}"   type="checkbox" />
                    <label for="{{ "cls".$lp_cat_det->id }}">{{ $lp_cat_det->cat_name }}</label>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </aside>
          <div id="content" class="col-sm-9">
            <h3 class="subtitle"><span>Refine Search</span></h3>
            <div class="product-filter">
              <div class="row">
                <div class="col-md-12">
                  <div class="jplist-ios-button"> <i class="fa fa-sort"></i>jPList Actions </div>
                  <button type="button" class="jplist-reset-btn" data-control-type="reset" data-control-name="reset" data-control-action="reset"> Reset &nbsp;<i class="fa fa-share"></i> </button>
                  <!-- items per page dropdown -->
                  <div class="jplist-drop-down" data-control-type="items-per-page-drop-down" data-control-name="paging" data-control-action="paging">
                    <ul>
                      <li><span data-number="20" data-default="true"> 20 Per Page </span></li>
                      <li><span data-number="40"> 40 Per Page </span></li>
                      <li><span data-number="60"> 60 Per Page </span></li>
                      <li><span data-number="all"> View All </span></li>
                    </ul>
                  </div>
                  <!-- sort dropdown -->
                  <div class="jplist-drop-down" data-control-type="sort-drop-down" data-control-name="sort" data-control-action="sort" data-datetime-format="{month}/{day}/{year}"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->
                    <ul>
                      <li><span data-path="default">Sort by</span></li>
                      <li><span data-path=".newest" data-order="desc" data-type="number" data-default="true">Newest</span></li>
                      <li><span data-path=".price" data-order="asc" data-type="number">Price--Low to High</span></li>
                      <li><span data-path=".price_max" data-order="desc" data-type="number">Price--High to Low</span></li>
                    </ul>
                  </div>
                  <div class="text-filter-box"> <i class="fa fa-search  jplist-icon"></i>
                    <input data-path=".title" type="text" value="" placeholder="By Product Name" data-control-type="textbox" data-control-name="title-filter" data-control-action="filter" />
                  </div>
                  <div class="jplist-range-slider" data-control-type="range-slider" data-control-name="range-slider-prices" data-control-action="filter" data-path=".price" data-slider-func="pricesSlider" data-setvalues-func="priesValues">
                    <div class="value" data-type="prev-value"></div>
                    <div class="ui-slider" data-type="ui-slider"></div>
                    <div class="value" data-type="next-value"></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Product ends Search-->
            <div class="row products-category">
              <div class="list box text-shadow"> {!! Form::open(['url'=>'add-to-cart','METHOD'=>'POST','id'=>'frm_cart']) !!}
                {{ Form::hidden('price_id', '',['id'=>'price_id'])}}                
                {{ Form::hidden('qty', "1",['id'=>'qty']) }}
                {!! Form::close() !!}
                @foreach($prd_data as $prd_res)
                <?php  
				 $min_max_price_ary = Helpers::eachProductsMinMaxPrice($prd_res->id); 
				 $min_price = $min_max_price_ary['min_price_rec'][0]->prd_price;
				 $max_price = $min_max_price_ary['max_price_rec'][0]->prd_price;
				 
				 $price_id = $min_max_price_ary['max_price_rec'][0]->id;
				 
				// dd($min_max_price_ary.min_price_rec);
				 ?>
                <div class="list-item box"> 
              <span class="price" style="display:none;"> {{ number_format($min_price,2,'.','') }} </span>
              <span class="price_max" style="display:none;"> {{ number_format($max_price,2,'.','') }} </span>
              
              <span class="newest" style="display:none;">{{ $prd_res['id'] }} </span>
              
                  <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xs-12 {{ "cls".$prd_res->prd_cat_id }}">
                    <div class="product-thumb clearfix">
                      <div class="image"> <a href="{{ url('/') }}/product-details/{{ $prd_res->id }}-{{ $prd_res->prd_slug }}"><img src="{{ asset('public/product-photo/'.$prd_res->prd_photo) }}"  alt=""/></a> </div>
                      <div class="caption">
                        <h4 class="title item-title"> <a href="{{ url('/') }}/product-details/{{ $prd_res->id }}-{{ $prd_res->prd_slug }}">{{ $prd_res->prd_name }}</a> </h4>
                        <p class="price-show">
                        	<span>
                            	<i class="fa fa-dollar"></i> 
                                @if($prd_res->prd_cs_opt == 0)
                                {{ number_format($min_price,2,'.','') }}
                                @else
                                {{ number_format($min_price,2,'.','') }} - 
                                {{ number_format($max_price,2,'.','') }}
                                @endif 
                           </span> 
                        </p>
                      </div>
                      <div class="button-group"> @if($prd_res->prd_cs_opt == 0) <a href="javascript:void(0);" onclick="addToBasket({{ $price_id }});" class="btn-primary f-none single-action"><span>Add to Cart</span></a> @else <a class="btn-primary f-none single-action" href="{{ url('/') }}/product-details/{{ $prd_res->id }}-{{ $prd_res->prd_slug }}"><span>Select Option</span></a> @endif </div>
                    </div>
                  </div>
                </div>
                @endforeach </div>
            </div>
            <div class="row">
              <div class="box jplist-no-results text-shadow text-center jplist-hidden">
                <p>No results found</p>
              </div>
            </div>
            
            <!-- pagination results -->
            <div class="row">
              <div class="col-sm-6 text-left">
                <div
                  class="jplist-label"
                  data-type="Page {current} of {pages}"
                  data-control-type="pagination-info"
                  data-control-name="paging"
                  data-control-action="paging"> </div>
              </div>
              <div class="col-sm-6 text-right">
                <div
                  class="jplist-pagination"
                  data-control-type="pagination"
                  data-control-name="paging"
                  data-control-action="paging"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
@push('script')
<script src="{{ asset('public/js/jplist.core.min.js') }}"></script>
<script src="{{ asset('public/js/jplist.sort-bundle.min.js') }}"></script>
<script src="{{ asset('public/js/jplist.textbox-filter.min.js') }}"></script>
<script src="{{ asset('public/js/jplist.pagination-bundle.min.js') }}"></script>
<script src="{{ asset('public/js/jplist.history-bundle.min.js') }}"></script>
<script src="{{ asset('public/js/jplist.filter-toggle-bundle.min.js') }}"></script>
<script  src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js"></script>
<script src="{{ asset('public/js/jplist.jquery-ui-bundle.min.js') }}"></script>
<script>
$('document').ready(function(){
jQuery.fn.jplist.settings = {
pricesSlider: function ($slider, $prev, $next){
  $slider.slider({
     min: <?php echo $pr_info['min_price']; ?>
    ,max: <?php echo $pr_info['max_price']; ?>
    ,range: true
    ,values: [<?php echo $pr_info['min_price']; ?>, <?php echo $pr_info['max_price']; ?>]
    ,slide: function (event, ui){
      $prev.text('₹' + ui.values[0]);
      $next.text('₹' + ui.values[1]);
    }
  });
}
,priesValues: function ($slider, $prev, $next){
  $prev.text('₹' + $slider.slider('values', 0));
  $next.text('₹' + $slider.slider('values', 1));
}
};

$('#demo').jplist({
  itemsBox: '.list'
  ,itemPath: '.list-item'
  ,panelPath: '.jplist-panel'

  ,redrawCallback: function(collection, $dataview, statuses){
    $.each(statuses, function(index, status){
      //console.log(status);
    });
  }
});
});
</script>
@endpush