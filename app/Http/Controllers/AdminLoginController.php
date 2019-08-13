<?php
namespace App\Http\Controllers;
use Helpers;
use Config;
//This line is used for getting the input box value
use Illuminate\Http\Request;
//This line is used for database connection
use DB;
//This line is used for session
use Session;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;
//custom user login middle ware
use App\Http\Middleware\RedirectIfAuthenticatedAdmin;

use App\Admin;
use Hash;
use Cookie;

class AdminLoginController extends Controller{
	public function __construct(){
		$this->middleware(RedirectIfAuthenticatedAdmin::class);
    }
	
	public function viewAdminLogin() {
        return view('admin.admin-login');
    }

    public function checkAdminLogin(Request $request) {
        $email = $request->input('email');
		$admin_password = $request->input('password');
		//dd($request->all());exit;
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        // Get records from core table with email address
		$result = Admin::where('email',$email)->first();
		if($result==null){
			return Redirect::to('administrator')->with('invalid', true);
		}
        $db_password = $result->password;
		$chk_psw = Hash::check($admin_password,$db_password);
		//dd($chk_psw);
		
        // If password does not macth in db_password
        if ($chk_psw==false) {
            return Redirect::to('administrator')->with('invalid', true);
        }
		
		$remember_me = ($request->input('remember_me'))?$request->input('remember_me'):'';
		if($remember_me!=''){
			Cookie::queue('cok_email', $email, 60);
			Cookie::queue('cok_psw', $admin_password, 60);
			Cookie::queue('cok_rm', $remember_me, 60);
		}else{
			Cookie::queue('cok_email', '', 60);
			Cookie::queue('cok_psw', '', 60);
			Cookie::queue('cok_rm', '', 60);
		}
		
        // Store in SESSION
        Session::put('admin_id', $result->admin_id);
        Session::put('admin_name', $result->admin_name);
        //return Redirect::to('admin-dashboard');
		return redirect()->route('admin.dashboard');
		
		//admin.dashboard
    }
	
	public function showForgotPasswordForm(){
      return view('admin.forgot-password');
    }
	
	public function adminForgotPassword(Request $request){
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
      ]);
   	  
	  $forgot_email = $request->email;
	  
	  // Get records from core table with email address
	  $admin_det = Helpers::getAdminDetails();
	  //print_r($admin_det);exit;
	  
	  // If record not exist
	  if ($admin_det==null) {
		  return redirect('administrator/forgot-password')->with('error', 'Invalid email address')->withInput($request->only('email'));
	  }
	
	  // Admin Details
	  $new_password = Helpers::createRandomPassword();
	  $db_password = Hash::make($new_password);
	 
	  //Password updated here
	  Admin::where('admin_id',1)->update(['password' => $db_password]);
	  
	  $admin_name = $admin_det->admin_name;
	  $admin_email = $admin_det->alt_email;
	  $current_year = date("Y");
	  
	  //Get Template details
	  $res_template = Helpers::getTemplateDetails('1');
	  
	  //print_r($res_template);exit;
	  $input = $res_template->contents;
	  
	  # Subject
	  $subject = "Ronsafe :: Password";
	
	  //echo $admin_email;exit;
	  $body = str_replace(array('%ADMINNAME%', '%ADMINEMAIL%', '%ADMINPASSWORD%', '%FROMEMAIL%', '%CURRENTYEAR%'), array($admin_name, $forgot_email, $new_password, $admin_email, $current_year), $input);
	  echo $body;exit;
	  
	  $headers  = 'MIME-Version: 1.0' . "\n";
	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  $headers .= "From:".$admin_email."\n";
	  $ok = mail($forgot_email, $subject, $body, $headers);
	
	  return redirect('administrator/forgot-password')->with('success', 'Password has been sent to your email address.');
	}

}