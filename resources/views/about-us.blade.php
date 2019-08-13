@extends('includes.master')
@section('title') {{ $abt_data->meta_title }} @stop
@section('keywords') {{ $abt_data->meta_keywords }} @stop
@section('description') {{ $abt_data->meta_description }} @stop

@section('content')
    
<section class="inner-banner">
   <div class="container text-center">
      <h2>About Us</h2>
   </div>
</section>
      
      
<section class="about-area sec-pad">
  <div class="container">
    <div class="row">
       <div class="col-md-8">
          <div class="about-content">
             <div class="sec-title">
                <h2>{{ $abt_data->page_title }}</h2>
             </div>
             {!! $abt_data->content !!}
          </div>
       </div>
       <div class="col-md-4 ">
          <div class="about-img text-center">
             <img src="{{ asset('public/cms-photo/'.$abt_data->cms_photo) }}" alt=""/>
          </div>
       </div>
    </div>
    
    <div class="row">
       <div class="col-md-4 ">
          <div class="about-img text-center ">
             <img src="{{ asset('public/cms-photo/'.$csr_data->cms_photo) }}" alt=""/>
          </div>
       </div>
       <div class="col-md-8">
          <div class="about-content">
             <div class="sec-title">
                <h2>{{ $csr_data->page_title }}</h2>
             </div>
             {!! $csr_data->content !!}
          </div>
       </div>
    </div>
  </div>
</section>

@include('includes.ma')

@stop