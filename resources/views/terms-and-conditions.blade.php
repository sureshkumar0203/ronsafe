@extends('includes.master')
@section('title') {{ $tc_data->meta_title }} @stop
@section('keywords') {{ $tc_data->meta_keywords }} @stop
@section('description') {{ $tc_data->meta_description }} @stop

@section('content')   
<section class="about-area">
  <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="about-content">
             <div class="sec-title">
                <h2>{{ $tc_data->page_title }}</h2>
             </div>
             @if($tc_data->cms_photo!="")
             <img src="{{ asset('public/cms-photo/'.$tc_data->cms_photo) }}" alt="" style="float: left; margin-right: 20px; margin-bottom: 20px;"/>
             @endif
             
             {!! $tc_data->content !!}
             
          </div>
       </div>
    </div>    
  </div>
</section>
@include('includes.ma')
@stop