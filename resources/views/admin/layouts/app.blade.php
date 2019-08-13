<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | Admin Panel</title>
  
  <link rel="stylesheet" href="{{ asset('public/data-tables/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('public/data-tables/dataTables.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('public/admin-vendors/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin-vendors/css/vendor.bundle.base.css') }}">
 <!-- <link rel="stylesheet" href="{{ asset('public/admin-vendors/css/vendor.bundle.addons.css') }}">-->
  <link rel="stylesheet" href="{{ asset('public/admin-vendors/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin-vendors/css/font-awesome.css') }}">
  @yield('css')
  <script src="{{ asset('public/js/jquery-2.1.1.min.js') }}"></script>
  <script>
  $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  });
  </script> 
</head>


<body>
  <div class="container-scroller">
  
     @if(Session::get('admin_name')!='')
      @include('admin.includes.admin-header')
     @endif
   
    
    @yield('content')
  </div>
  
  
  <script src="{{ asset('public/admin-vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('public/admin-vendors/js/vendor.bundle.addons.js') }}"></script>
  
  <script src="{{ asset('public/admin-vendors/js/off-canvas.js') }}"></script>
  <script src="{{ asset('public/admin-vendors/js/misc.js') }}"></script>
  
  @stack('script')


  
</body>
</html>
