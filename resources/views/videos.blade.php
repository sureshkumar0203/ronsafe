@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(7)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(7)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(7)->meta_descr }} @stop

@section('content')
    
<section class="inner-banner">
   <div class="container text-center">
      <h2>Videos</h2>
   </div>
</section>
      
      
<section class="about-area sec-pad">
  <div class="container">
    <div class="row">
    
      
            @foreach($video_data as $video_res)
             <div class="col-md-4">
          <div class="about-content">
            
            <video  controls style="width:100%; height:250px; background:#000;">
              <source src="{{ asset('public/video') }}/{{ $video_res->video }}" type="video/mp4">
            </video>
            <h4 class="text-center">{{ $video_res->title }}</h4>
                      </div>
       </div>
            @endforeach

       
       
    </div>
  </div>
</section>



@stop