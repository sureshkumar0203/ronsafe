@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(1)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(1)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(1)->meta_descr }} @stop

@section('content')
      
<div id="minimal-bootstrap-carousel" class="carousel slide carousel-fade slider-home-one" data-ride="carousel">
   <!-- Wrapper for slides -->
   <div class="carousel-inner" role="listbox">
      
      @php 
      $i = 0; 
      foreach($banner_data as $banner_res){
      @endphp
      <div class="item @if($i==0) active @endif slide-{{ $i }}" style="background-image: url({{ asset('public/banners/'.$banner_res->banner_photo) }});background-position: right bottom;">
         <div class="carousel-caption">
            <div class="thm-container">
               <div class="box valign-middle">
                  <div class="content ">
                     <h3 data-animation="animated fadeInUp">@if($banner_res->cmsPageLink!=null) {{ $banner_res->cmsPageLink->page_title }} @endif</h3>
                     <p data-animation="animated fadeInDown">
                     @if($banner_res->cmsPageLink!=null) {!! $banner_res->cmsPageLink->content !!} @endif
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @php $i += 1; }  @endphp
      
   <!-- Controls -->
   <a class="left carousel-control" href="#minimal-bootstrap-carousel" role="button" data-slide="prev">
   <i class="fa fa-angle-left"></i>
   <span class="sr-only">Previous</span>
   </a>
   <a class="right carousel-control" href="#minimal-bootstrap-carousel" role="button" data-slide="next">
   <i class="fa fa-angle-right"></i>
   <span class="sr-only">Next</span>
   </a>
   
   <ul class="carousel-indicators list-inline custom-navigation">
   	  @php 
      $i = 0; 
      foreach($banner_data as $banner_res){
      
      @endphp
      <li data-target="#minimal-bootstrap-carousel" data-slide-to="{{ $i}}" class="active"></li>
     
      @php $i += 1; }  @endphp
   </ul>
</div>

<section class="about-area sec-pad pb0">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="about-content">
               <div class="sec-title">
                  <h2>{{ $abt_data->page_title }}</h2>
               </div>
               <p>{!! $abt_data->content !!}</p>
               <a href="{{ url('/') }}/about-us" class="thm-btn">Read More</a>
            </div>
         </div>
         <div class="col-md-4 ">
            <div class="about-images text-center">
               <image src="{{ asset('public/cms-photo/'.$abt_data->cms_photo) }}" alt=""/>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="features-area sec-mar">
   <div class="container">
      <div class="row">
         <div class="sec-title">
            <h2 class="text-center"><a href="#" style="color: #182345; text-decoration:none!important;">Training Programs</a></h2>
         </div>
         
         @foreach($training_data as $training_res)
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="single-feature-box">
               <i class=""><img src="{{ asset('public/training-icons/'.$training_res->training_icon) }}"  alt=""/></i>
               <h3>{{ $training_res->training_title }}</h3>
               <p class="price"><span>&dollar; {{ $training_res->training_price }}</span></p>
               <a href="{{ url('/') }}/book-a-training/{{ $training_res->id }}-{{ str_slug($training_res->training_title) }}" class="read-more">Book Now</a>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>


<section style="background:#161827; padding-top:30px;">

<div class="container">
 <div class="sec-title text-center">
         <p style="color:#fff;">What We Do</p>
         <h2><a href="#" style="color: #fff; text-decoration:none!important;">Our <span>Services</span></a></h2>
      </div>

</div>


</section>


<section class="service-title-box text-center">
  
</section>

<section class="service-area overlaped-top">
   <div class="container">
      <div class="row">
        @foreach($service_data as $service_res)
         <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-service">
               <div class="images-box">
                  <image src="{{ asset('public/service-photo/'.$service_res->service_photo) }}" alt=""/>
               </div>
               <div class="text-box">
                  <a href="#"><h3>{{ $service_res->service_title }}</h3></a>
                  {!! $service_res->service_details  !!}
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>


<section class="fun-fact-area core" style="padding:30px 0px;">
   <div class="container">
      <div class="row">
         <h2 class="text-center">{{ $cv_data->page_title }}</h2>
         <p>{!! $cv_data->content !!} </p>
      </div>
   </div>
</section>

<div class="clearfix"></div>



<section class="brand-area" style="background:#EDF0F3; padding-top:30px; padding-bottom:30px; margin:0px 0px 30px 0px; ">
   <div class="container">
   <div class="row">
   <div class="sec-title">
            <h2 class="text-center"><a href="#" style="color: #182345; text-decoration:none!important;">Our Testimonials</a></h2>
         </div>
         </div>
      <div class="testi owl-carousel owl-theme">
         @foreach($testi_data as $testi_res)
         <div class="item text-center">
            <p>{!! $testi_res->message !!}</p>
            <h4>{{ $testi_res->name }}</h4>
         </div>
         @endforeach
      </div>
   </div>
</section> 




@include('includes.ma')

@stop