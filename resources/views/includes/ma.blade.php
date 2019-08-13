<section class="brand-area">
   <div class="container">
      <div class="brand-carousel owl-carousel owl-theme">
         @foreach(Helpers::maList() as $ma_res)
         <div class="item">
            <image src="{{ asset('public/ma-photo/'.$ma_res->member_photo) }}" alt=""/>
         </div>
         @endforeach
      </div>
   </div>
</section>   