<?php 
if($_REQUEST['choice']=='login'){?>
<div class="login-sec " style="padding:20px;">
	<h5 class="text-center"  style="margin-bottom:0px; margin-top:0px; font-size:16px;"><strong>Login to your Account</strong></h5>
    {{ Form::open(array('url' => '','method' => 'post','role' => 'form', 'class' =>'', 'name' => 'frm_login', 'id' => 'frm_login','files'=>false, 'autocomplete' => 'off','onsubmit' => 'return validatefancyLogin()')) }}
    <div id="msg_div_login" style="color:#F00; height:22px; font-size:13px;"></div>
    <div class="regis_grup">
    	<label>Login ID</label>
        {!! Form::email('login_email',old('login_email'), array('id' => 'login_email','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
        
        <label>Password</label>
        {!! Form::password('login_psw',array('id' => 'login_psw','required','class'=>'form-control','placeholder'=>'','autocomplete' => 'off')) !!}
        
        <div class="clearfix" style="margin-top:10px;"></div>
        
        <p class="pull-left" style="padding-top:10px"><a href="{{ url('/user-forgot-psw') }}">Forgot Password?</a></p>
        <input id="login_btn" type="button" value="Sign in" class="butn_2 lgn-btn btn btn-primary pull-right" onclick="submitLoginForm();"/>
    </div>
    {{ Form::close() }}
</div>
<?php } ?>