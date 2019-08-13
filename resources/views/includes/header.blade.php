<section class="top-bar">
  <div class="container">
    <div class="contact-info pull-left"> <a href="#"><i class="fa fa-envelope"></i>{{ $admin_dtls->alt_email }} / {{ $admin_dtls->email }}</a> <a href="#"><i class="fa fa-phone"></i> {{ $admin_dtls->contact_no }}</a> </div>
    
    <div class="social pull-right"> 
    <a href="{{ url('/cart') }}" class="cart"> <i class="fa fa-shopping-bag" style="color:#ffec4e;"></i> <span id="disp_tot_items"> {{ Helpers::getCartTotalItems() }} item(s) </span> </a>
    
     @if(Session::get('user_id')=='') 
     <a href="{{ url('/') }}/user-login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a> 
     
      | 
     
     <a href="{{ url('/') }}/user-registration"><i class="fa fa-user-plus"></i> Register</a> 
     
     @else 
     
     <a href="{{ url('/') }}/user-dashboard"><i class="fa fa-user-plus"></i> {{ Session::get('user_name') }} </a>&nbsp;&nbsp; 
     
     <a href="{{ url('/') }}/user-logout" class="lg-out"><i class="fa fa-power-off "></i> Logout</a> @endif 
    </div>
  </div>
</section>

<header class="header header-fixed header-1 stricky">
  <nav class="navbar navbar-default header-navigation ">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-bar" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('public/images/logo.png') }}" alt=""/></a> </div>
      <div class="collapse navbar-collapse" id="main-nav-bar">
        <ul class="nav navbar-nav navigation-box main-navigation mainmenu pull-right">
          <li class="{{ Request::is('/') ? 'current' : "" }}"><a href="{{ url('/') }}">Home</a></li>
          <li class="{{ Request::is('about-us') ? 'current' : "" }}"><a href="{{ url('/') }}/about-us">About</a></li>
          <li class="{{ Request::is('services') ? 'current' : "" }}"><a href="{{ url('/') }}/services">Service</a></li>
          <li class="{{ Request::is('training') ? 'current' : "" }}"><a href="{{ url('/') }}/training">Training</a></li>
          <li class="{{ Request::is('products') ? 'current' : "" }}"><a href="{{ url('/') }}/products">Products</a></li>
          <li class="{{ Request::is('videos') ? 'current' : "" }}"><a href="{{ url('/') }}/videos">Videos</a></li>
          <li class="{{ Request::is('contact-us') ? 'current' : "" }}"><a href="{{ url('/') }}/contact-us">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
