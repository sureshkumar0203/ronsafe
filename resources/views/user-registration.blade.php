@extends('includes.master')
@section('title')  {{ Helpers::getSeoInfo(5)->meta_title }} @stop
@section('keywords') {{ Helpers::getSeoInfo(5)->meta_keyword }} @stop
@section('description') {{ Helpers::getSeoInfo(5)->meta_descr }} @stop

@section('content')
     

<section class="about-area bx-shadow">
  <div class="container padtop20">
    <div class="row">
     <div class="sec-title mar0">
     	<h2 class="text-center">User <span>Registration</span></h2>
     </div>
     <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="hgt30">
        <div class="suc mar0" style="display:none;"></div>
        <div class="dan mar0" style="display:none;"></div>
      </div>
  
      <div class="about-content mar0 padr0">
      	{{ Form::open(array('url' => 'user-registration', 'role' => 'form', 'class' =>'well marbot30 reg', 'name' => 'user_frm', 'id' => 'user_frm','files'=>false, 'autocomplete' => 'off','onsubmit' => 'return validateUserSignup();')) }}
      
        <div class="form-group col-md-6">
          <label class="control-label">Full Name<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
              {!! Form::text('full_name',old('full_name'), array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
            </div>
              
              <div class="_error-text">
              @if ($errors->has('full_name')) {{ $errors->first('full_name') }} @endif
              </div>
              
          </div>
        </div>
                     
        <div class="form-group col-md-6">
          <label class="control-label">Email<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span> {!! Form::email('email',old('email'), array('id' => 'email','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
             </div>
             <div class="_error-text">
              @if ($errors->has('email')) {{ $errors->first('email') }} @endif
              </div>
          </div>
        </div>
                     
        <div class="form-group col-md-6">
          <label class="control-label">Password<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>{!! Form::password('password',array('id' => 'password','minlength' => 8,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','pattern' => "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}",'title' =>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters','onKeyUp' => '')) !!}
             </div>
             <div class="_error-text">
              @if ($errors->has('password')) {{ $errors->first('password') }} @endif
              </div>
          </div>
        </div>
        
        <div class="form-group col-md-6">
          <label class="control-label">Contact Number<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>{!! Form::text('contact_no',old('contact_no'), array('id' => 'contact_no','maxlength' => 14,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
             </div>
             <div class="_error-text">
              @if ($errors->has('contact_no')) {{ $errors->first('contact_no') }} @endif
              </div>
          </div>
        </div>
        
        <div class="form-group col-md-6">
          <label class="control-label">Address Line 1<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-home"></i></span>{!! Form::text('address1',old('address1'), array('id' => 'address1','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
             </div>
             <div class="_error-text">
              @if ($errors->has('address1')) {{ $errors->first('address1') }} @endif
              </div>
          </div>
        </div>
        
        <div class="form-group col-md-6">
          <label class="control-label">Address Line 2</label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-home"></i></span>{!! Form::text('address2',old('address2'), array('id' => 'address2','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
             </div>
            <div class="_error-text">
              @if ($errors->has('address2')) {{ $errors->first('address2') }} @endif
              </div>
          </div>
        </div>
        
        <div class="form-group col-md-6">
          <label class="control-label">City<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-building"></i></span>{!! Form::text('city',old('city'), array('id' => 'city','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
             </div>
             <div class="_error-text">
              @if ($errors->has('city')) {{ $errors->first('city') }} @endif
              </div>
          </div>
        </div>
        
        <div class="form-group col-md-6">
          <label class="control-label">Postal Code/ZIP<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-pin" aria-hidden="true"></i></span> {!! Form::text('post_code',old('post_code'), array('id' => 'post_code','maxlength' => 7,'required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
             </div>
            <div class="_error-text">
              @if ($errors->has('post_code')) {{ $errors->first('post_code') }} @endif
              </div>
          </div>
        </div>
        
        <div class="form-group col-md-6">
          <label class="control-label">State<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group"><span class="input-group-addon"><i class="fa fa-map"></i></span>{!! Form::text('state',old('state'), array('id' => 'state','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
             </div>
              <div class="_error-text">
              @if ($errors->has('state')) {{ $errors->first('state') }} @endif
              </div>
          </div>
        </div>
        
        <div class="form-group col-md-6">
          <label class=" control-label">Country<span>*</span></label>
          <div class="inputGroupContainer">
             <div class="input-group">
                <span class="input-group-addon" style="max-width: 100%;"><i class="fa fa-flag"></i></span>
                {!! Form::text('country',old('country'), array('id' => 'country','','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
             </div>
             <div class="_error-text">
              @if ($errors->has('country')) {{ $errors->first('country') }} @endif
              </div>
          </div>
        </div>
                     
                     
        <div class="form-group"> 
          
          <div class="controls col-md-12 text-right ">
          <a href="{{ URL::to('user-login') }}" class="pull-left">Returning customer click here to login.</a>
          {{ Form::submit('Sign Up', array('id'=>'btn_submit','class' => 'btn btn btn-primary sign-up-btn')) }}
          </div>
        </div>
        
        {{ Form::close() }}
        
      </div>
    </div>
     <div class="col-md-2"></div>
    </div>
  </div>
</section>
@stop