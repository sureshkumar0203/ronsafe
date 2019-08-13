@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(4)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(4)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(4)->meta_descr }} @stop

@section('content')
    
<section class="inner-banner contact-b">
  <div class="container text-center">
    <h2>Contact Us</h2>           
  </div>
</section>

<section class="contact-info-area sec-pad">
   <div class="container">
      <div class="row">
         <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-contact-info text-center">
               <i class="fa fa-map-marker"></i>
               <h3>Our Location</h3>
               <p>{{ $admin_dtls->address }}<br />
               &nbsp;
               </p>
            </div>
         </div>
         
         <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-contact-info text-center">
               <i class="fa fa-mobile"></i>
               <h3>Call Us Now</h3>
               <p>Phone : {{ $admin_dtls->contact_no }} <br />
                  Mobile :  {{ $admin_dtls->mobile_no }}</p>
            </div>
         </div>
         
         <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-contact-info text-center">
               <i class="fa fa-envelope" aria-hidden="true"></i>
               <h3>Write Us Now</h3>
               <p>{{ $admin_dtls->alt_email }} <br />
                   {{ $admin_dtls->email }}</p>
               
            </div>
         </div>
         
      </div>
   </div>
</section>
     
<section class="contact-section sec-pad">
   <div class="container">
   <div class="row">
   <div class="col-md-12"> 
    <div class="sec-title text-center">
         <p>Send Message</p>
         <h2>Get in <span>Touch</span></h2>
      </div> 
   </div>
   <div class="col-md-12">
    @if (Session::has('success'))
        <div class=" text-left">
          <span style="color:#030; padding-bottom:10px; font-size:16px; font-weight:bold; display:inline-block;">
              Your message has been send successfully.
          </span>
        </div>
        @endif
   
   
    </div>
   <div class="col-md-6"> 
      
      {!! Form::open(['url' => 'contact-us','class'=>"contact-form row",'data-toggle'=>"validator",'class','role' => 'form', 'name' => 'contact-us', 'id' => 'contact-us','files'=>false, 'autocomplete' => 'off']) !!}
      
      	<div class="col-md-6">
            {!! Form::text('subject', '', ['id' => 'subject','required', 'class'=>'form-control', 'placeholder'=>'Subject']) !!}
            @if ($errors->has('subject'))
            <span class="help-block">
                <strong>{{ $errors->first('subject') }}</strong>
            </span>
            @endif
         </div>
         
        <div class="col-md-6">
           {!! Form::text('contact_no',old('contact_no'), array('id' => 'contact_no','maxlength' => 14,'required','class'=>'form-control','placeholder'=>'Contact No.','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
            
            @if ($errors->has('contact_no'))
            <span class="help-block">
                <strong>{{ $errors->first('contact_no') }}</strong>
            </span>
            @endif
         </div>         
         
        <div class="col-md-6">
            {!! Form::text('name', '', ['id' => 'name','required', 'class'=>'form-control', 'placeholder'=>'Your Name']) !!}
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
         </div>
         
        <div class="col-md-6">
            {!! Form::email('email', '', ['id' => 'email','required', 'class'=>'form-control', 'placeholder'=>'E-Mail Address']) !!}
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
         </div>
         
        <div class="col-md-12">
          {!! Form::textarea('enquiry', '', ['rows'=>"10",'id' => 'enquiry','required', 'class'=>'form-control', 'placeholder'=>'Write your message']) !!} 
          
          @if ($errors->has('enquiry'))
          <span class="help-block">
          	<strong>{{ $errors->first('enquiry') }}</strong>
          </span>
          @endif
                                
          <div class="text-left">  
          {{ Form::submit('Submit Now', ['class' => 'thm-btn color-blue']) }} 
          </div>  
            
         </div>
      {!! Form::close() !!}     
      
    </div>  
    
    
    <div class="col-md-6">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.419186724163!2d-61.449499685716034!3d10.308298270479455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c358cc91cc89fe9%3A0x9cd19181d2df9f89!2sBattoo+Avenue+%26+2nd+St%2C+San+Fernando%2C+Trinidad+and+Tobago!5e0!3m2!1sen!2sin!4v1556517676591!5m2!1sen!2sin" width="600" height="309" frameborder="0" style="border:0;" allowfullscreen></iframe>
    </div>    
    </div>  
   </div>
</section>


@stop