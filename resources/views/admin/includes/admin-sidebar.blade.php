<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
          	<img src="{{ asset('public/images/face4.jpg') }}" alt="profile image">
          </div>
          
          <div class="text-wrapper">
            <p class="profile-name">{{ Session::get('admin_name') }}</p>
            <div>
              <small class="designation text-muted">Administrator</small>
              <span class="status-indicator online"></span>
            </div>
          </div>
        </div>
        
        <a class="btn btn-success btn-block" href="{{ URL::to('administrator/dashboard') }}"><i class="menu-icon mdi mdi-television"></i><span class="btn-txt">Dashboard</span></a>
      </div>
    </li>
    
    
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#cms" aria-expanded="false" aria-controls="cms">
        <i class="menu-icon  fa fa-bars"></i>
        <span class="menu-title">CMS</span>
        <i class="menu-arrow"></i>
      </a>
      
      <div class="collapse" id="cms">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-contents') }}">Manage Contents</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-services') }}">Manage Services</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-banners') }}">Manage Banners</a>
          </li>
          
           <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-ma') }}">Members & Affiliation</a>
           </li>
           
           <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-testimonials') }}">Manage Testimonials</a>
           </li>
           
           <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-videos') }}">Manage Videos</a>
           </li>
           
        </ul>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#customer" aria-expanded="false" aria-controls="training">
        <i class="menu-icon fa fa-user-o"></i>
        <span class="menu-title">Customer Management</span>
        <i class="menu-arrow"></i>
      </a>
      
      <div class="collapse" id="customer">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-users') }}">Manage Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-orders') }}">Manage Orders</a>
          </li>
        </ul>
      </div>
    </li>
    
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
        <i class="menu-icon fa fa-hdd-o"></i>
        <span class="menu-title">Product Management</span>
        <i class="menu-arrow"></i>
      </a>
      
      <div class="collapse" id="product">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-category') }}">Manage Category</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-size') }}">Manage Size</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-color') }}">Manage Color</a>
          </li>
          
         
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-products') }}">Manage Products</a>
          </li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#training" aria-expanded="false" aria-controls="training">
        <i class="menu-icon fa fa-file-text-o" aria-hidden="true"></i>
        <span class="menu-title">Training Programs</span>
        <i class="menu-arrow"></i>
      </a>
      
      <div class="collapse" id="training">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-trainings') }}">Manage Trainings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('administrator/manage-bookings') }}">Manage Bookings</a>
          </li>
        </ul>
      </div>
    </li>
    
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#myac" aria-expanded="false" aria-controls="myac">
        <i class="menu-icon fa fa-wrench"></i>
        <span class="menu-title">SETTINGS</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="myac">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ URL::to('administrator/my-account') }}">My Account</a></li>
          
          <li class="nav-item"><a class="nav-link" href="{{ URL::to('administrator/change-password') }}"> Change Password </a></li>
          
          <li class="nav-item"><a class="nav-link" href="{{ URL::to('administrator/manage-seo-settings') }}">Manage Seo </a></li>
          <li class="nav-item"><a class="nav-link" href="{{ URL::to('administrator/payment-setting') }}">Payment Setting </a></li>
          
        </ul>
      </div>
    </li>
  </ul>
</nav>