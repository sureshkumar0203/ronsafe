@extends('includes.master')
@section('title')  {{ $seo_info->meta_title }} @stop
@section('keywords') {{ $seo_info->meta_keyword }} @stop
@section('description') {{ $seo_info->meta_descr }} @stop

@section('content')

<section class="about-area  bx-shadow">
  <div class="container padtopbtm100">
    <div class="row">            
       <div class="col-md-12 col-sm-12">
        <div class="entry-content pt-20 text-center">      
         <strong class="black-text">4<span style="COLOR: #253595;">0</span>4 - PAGE NOT FOUND</strong>
           <h3 class="line-hgt33">THE PAGE YOU REQUESTED COULD NOT FOUND</h3><br>            

            <a href="{{ url('/') }}" class="thm-btn color-blue">GO TO HOME PAGE</a>
        </div>
      </div>
    </div>
  </div>
</section>
@stop