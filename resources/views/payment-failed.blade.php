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
        <i class="fa fa-exclamation-triangle red-text"></i><br>

         <h3 class="line-hgt33">Sorry.Due to some inconvenience problem we are not able to process you booking.<br />
         Please try again..</h3>
        </div>
      </div>
    </div>
  </div>
</section>
@stop