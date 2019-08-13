@extends('includes.master')
@section('title')  {{ $rt_data->meta_title }} @stop
@section('keywords')  {{ $rt_data->meta_keywords }} @stop
@section('description')  {{ $rt_data->meta_description }} @stop

@section('content')
    
<section class="inner-banner service-b">
   <div class="container text-center"><h2>Services</h2></div>
</section>
  
<section class="about-area sec-pad">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="service-details-content">
          <h3>{{ $rt_data->page_title }}</h3>
          <div class="row">
            <div class="col-md-6">{!! $rt_data->content !!}</div>
            @if($rt_data->cms_photo!=null)
            <div class="col-md-6">
            	<img src="{{ asset('public/cms-photo/'.$rt_data->cms_photo) }}" alt=""/>
            </div>
            @endif
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <h4>{{ $so_data->page_title }}</h4>	
              {!! $so_data->content !!}
            </div>
            @if($so_data->cms_photo!=null)
            <div class="col-md-6">
            	<img src="{{ asset('public/cms-photo/'.$so_data->cms_photo) }}" alt=""/>
            </div>
            @endif
          </div>    
        </div>
      </div>
    </div>
  </div>
         
  <div class="container-fluid mt-50" style="background:#edf0f3;">         
     <div class="container mtb-50">
       <div class="row">
         @foreach($service_data as $service_res)
         <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-service">
               <div class="img-box">
                  <img src="{{ asset('public/service-photo/'.$service_res->service_photo) }}" alt=""/>
               </div>
               <div class="text-box">
                  <h3>{{ $service_res->service_title }}</h3>
                  {!! $service_res->service_details  !!}
               </div>
            </div>
         </div>
         @endforeach
       </div>
     </div>
  </div>
</section>
      
      
      
@include('includes.ma')

@stop