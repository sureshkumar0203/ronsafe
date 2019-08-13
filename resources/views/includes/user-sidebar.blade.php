<?php $user_dtls = Helpers::getUserDetails(); ?>
<div class="col-md-3">
  <div class="myaccount-box" style="padding-top:7px;">
  <div class="my-acount-border">
   <h4><span>My Dashboard</span> <a href="{{ url('/user-dashboard') }}" class="pull-right"><i class="fa fa-home" aria-hidden="true"></i></a></h4>
   </div>
  
   <div class="my-acount-border">
      <h5><i class="fa fa-file-text-o" aria-hidden="true"></i> My Profile</h5>
      <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp; {{ Session::get('user_name') }}<br>
      <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; {{ $user_dtls->email }} <br>
      <i class="fa fa-phone" aria-hidden="true"></i>&nbsp; {{ $user_dtls->contact_no }}
    </div>
  
  
    <div class="my-acount-border">
      <h5><i class="fa fa-truck" aria-hidden="true"></i> My History</h5>
      <ul>
        <li class="{{ Request::is('user-order-history') ? 'dash-menu-active' : '' }}"><a href="{{ url('/user-order-history') }}">Order History</a></li>
        
        <li class="{{ Request::is('user-booking-history') ? 'dash-menu-active' : '' }}"><a href="{{ url('/user-booking-history') }}">Booking History</a></li>
      </ul>
    </div>
    
    <div class="my-acount-border">
      <h5><i class="fa fa-wrench" aria-hidden="true"></i> Account Settings</h5>
      <ul>
        <li class="{{ Request::is('user-my-account') ? 'dash-menu-active' : '' }}"><a href="{{ url('/user-my-account') }}">My account</a></li>
        
        <li class="{{ Request::is('user-change-password') ? 'dash-menu-active' : '' }}"><a href="{{ url('/user-change-password') }}">Change Password</a></li>
      </ul>
    </div>
    
    <div class="my-acount-border">
      <h5> <a href="{{ URL::to('user-logout') }}"><i class="fa fa-sign-out"></i> Logout</a></h5>
    </div>
  </div>
</div>