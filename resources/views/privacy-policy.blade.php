@extends('includes.master')
@section('title') {{ $pp_data->meta_title }} @stop
@section('keywords') {{ $pp_data->meta_keywords }} @stop
@section('description') {{ $pp_data->meta_description }} @stop

@section('content')
<section class="about-area">
  <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="about-content">
             <div class="sec-title">
                <h2>{{ $pp_data->page_title }}</h2>
             </div>
             @if($pp_data->cms_photo!="")
             <img src="{{ asset('public/cms-photo/'.$pp_data->cms_photo) }}" alt="" style="float: left; margin-right: 20px; margin-bottom: 20px;"/>
             @endif
             
             {!! $pp_data->content !!}
            
          </div>
       </div>
    </div>
  </div>
</section>
@include('includes.ma')

@stop