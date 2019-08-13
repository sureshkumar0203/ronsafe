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
        <i class="fa fa-check-circle" style="font-size:48px;color:green;"></i><br>

         <strong class="green-text">Thank You.</strong>
           <h3 class="line-hgt33">Your transaction has been completed successfully.</h3>
            @if(Session::get('user_id'))
               <a href="user-dashboard">Click here </a> to view your Orders.
            @endif
        </div>
      </div>
    </div>
  </div>
</section>
@stop