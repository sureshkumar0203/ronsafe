<footer class="footer">
  <div class="container">
    <div class="row">
       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="footer-widget about-widget">
             <div class="title"><h3>Contact Info</h3></div>
             <p>Email<br><i class="fa fa-envelope" aria-hidden="true"></i> {{ $admin_dtls->alt_email }}</p>
             <p>Phone<br><i class="fa fa-phone" aria-hidden="true"></i> {{ $admin_dtls->contact_no }}</p>
             <p>Mobile<br><i class="fa fa-phone" aria-hidden="true"></i> {{ $admin_dtls->mobile_no }}</p>
          </div>
       </div>
       
       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="footer-widget about-widget">
             <div class="title"><h3>Address</h3></div>
             <p>{!! $admin_dtls->address !!}</p>
          </div>
       </div>
       
       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="footer-widget link-widget">
             <div class="title"><h3>Quick Links</h3></div>
             <ul class="link-list">
             	<li><a href="{{ url('/') }}">Home</a></li>   
                <li><a href="{{ url('/') }}/about-us">About</a></li>          
                <li><a href="{{ url('/') }}/services">Service</a></li>                   
                <li><a href="{{ url('/') }}/training">Training</a></li>     
                <li><a href="{{ url('/') }}/contact-us">Contact Us</a></li>
             </ul>
          </div>
       </div>
       
       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="footer-widget social-widget">
             <div class="title"><h3>Follow Us</h3></div>
             <ul class="social list-inline">
                <li><a href="{{ $admin_dtls->facebook_url }}" class="fa fa-facebook"></a></li>
                <li><a href="{{ $admin_dtls->twitter_url }}" class="fa fa-youtube"></a></li>
                <li><a href="{{ $admin_dtls->instagram_url }}" class="fa fa-instagram"></a></li>
             </ul>
          </div>
       </div>
    </div>
  </div>
  
  <div class="footer-bottom">
    <div class="container">
       <div class="copy-text pull-left">Ronsafe  &copy;  2019 All Right Reserved</div>
       <div class="footer-menu pull-right">
          <ul class="list-inline">
             <li><a href="{{ url('/') }}/terms-and-conditions">Terms & Conditions</a></li>
             <li><a href="{{ url('/') }}/privacy-policy">Privacy Policy</a></li>
          </ul>
       </div>
    </div>
  </div>
</footer>