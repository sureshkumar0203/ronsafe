@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(2)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(2)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(2)->meta_descr }} @stop

@section('content')
    
<section class="inner-banner">
   <div class="container text-center">
      <h2>Training</h2>
   </div>
</section>
      
      
<section class="features-area sec-mar">
   <div class="container">
      <div class="row">
       
       
         <div class="sec-title">
            <h2 class="text-center" style="margin-bottom:20px;">{{ $training_inst_data->page_title }}</h2>
		 </div>
         
         <span class="col-xs-12" style="margin-bottom:20px;">{!! $training_inst_data->content !!} </span>
       
         <div class="sec-title">
            <h2 class="text-center">Training Programs</h2>
		 </div>
        
         @foreach($training_data as $training_res)
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-feature-box">
           <i class=""><img src="{{ asset('public/training-icons/'.$training_res->training_icon) }}" alt=""></i>
           <h3>{{ $training_res->training_title }}</h3>
           <p class="price"><span>$  {{ $training_res->training_price }}</span></p>
           <a href="{{ url('/') }}/book-a-training/{{ $training_res->id }}-{{ str_slug($training_res->training_title) }}" class="read-more">Book Now</a>
        </div>
        </div>
         @endforeach
      </div>
   </div>
</section>

@include('includes.ma')

@stop