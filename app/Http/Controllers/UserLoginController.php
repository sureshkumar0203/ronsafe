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
use App\Http\Middleware\RedirectIfAuthenticatedUser;

use App\UserRegistration;
use Hash;

use App\Mail\MailBuilder;
use Mail;

class UserLoginController extends Controller{
	public function __construct(){
		$this->middleware(RedirectIfAuthenticatedUser::class);
    }
	
	public function viewUserRegistration() {
        return view('user-registration');
    }
	
	public function saveUserData(Request $request) {
		$all_input = $request->all();
		
        $this->validate($request, [
            'full_name' => 'required',
			'email' => 'required|string|unique:user_registrations,email', 
			'password' => 'required',
			'contact_no' => 'required|string|unique:user_registrations,contact_no', 
			'address1' => 'required',
			'city' => 'required',
			'post_code' => 'required|min:6|max:10',
			'state' => 'required',
			'country' => 'required'
        ]);
		
		$all_input['password'] = bcrypt($request->password);
		$save_user_data = UserRegistration::create($all_input);
		
		// Store in SESSION
        Session::put('user_id', $save_user_data->id);
        Session::put('user_name', $save_user_data->full_name);
		
		//###################### User Registration mail goes to USER#################
		// Admin Details
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det->admin_name;
		$admin_email = $admin_det->alt_email;
		
		$current_year = date("Y");
		$subject = "Ronsafe :: Your Registration completed successfully";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 8)->get();
		$input = $res_template[0]->contents;
		
		$user_name = $request->full_name;
		$user_email = $request->email;
		$user_contact_no = $request->contact_no;
		$user_password = $request->password;
		
		$body_user = str_replace(array('%USERNAME%','%USEREMAIL%','%USERCONTACTNO%','%USERPASSWORD%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($user_name,$user_email,$user_contact_no,$user_password,$admin_name,$admin_email, $current_year), $input);
		//echo $body_user;exit;
		
		$content = [
			'from_email' => $admin_email,
			'subject'=> $subject,
			'body'=> $body_user,
			'email_template' => 'emails.common_mail'
			];
		$ok=Mail::to($user_email)->send(new MailBuilder($content));
		
		
        return Redirect::to('user-dashboard');
		
    }
	
	
	public function viewUserLogin() {
        return view('user-login');
    }

    public function checkUserLogin(Request $request) {
        $email = $request->input('email');
		$user_password = $request->input('password');
		//dd($request->all());exit;
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        // Get records from core table with email address
		$result = UserRegistration::where('active_status','=','0')->where('email','=',$email)->orwhere('contact_no','=',$email)->first();
		//dd($result);exit;
		
		if($result==null){
			return Redirect::to('user-login')->with('invalid', true);
		}
		
		/*if($result_cn==null){
			return Redirect::to('user-login')->with('invalid', true);
		}*/
		
        $db_password = $result->password;
		$chk_psw = Hash::check($user_password,$db_password);
		//dd($chk_psw);
		
        // If password does not macth in db_password
        if ($chk_psw==false) {
            return Redirect::to('user-login')->with('invalid', true);
        }
		
		
        // Store in SESSION
        Session::put('user_id', $result->id);
        Session::put('user_name', $result->full_name);
        $session_id = session()->getId();
        $update_cart = \App\TempCart::where('session_id', $session_id)->update(['user_id'=>$result->id, 'session_id'=>NULL]);
        return Redirect::to('user-dashboard');
    }
	
	public function viewUserLoginPopup(Request $request) {
		return  view('user-login-popup');
	}
	
	public function checkPopupUserLogin(Request $request) {
		$this->validate($request, [
            'login_email' => 'required',
            'login_psw' => 'required'
        ]);
		$result = UserRegistration::where('active_status','=','0')->where('email','=',$request->login_email)->orwhere('contact_no','=',$request->login_email)->count();
        if($result > 0){
            $check_login = UserRegistration::where('active_status','=','0')->where('email','=',$request->login_email)->orwhere('contact_no','=',$request->login_email)->first();
			
            if(Hash::check($request->login_psw, $check_login->password)){
                Session::put('user_id', $check_login->id);
                Session::put('user_name', $check_login->full_name);
                $session_id = session()->getId();
                $update_cart = \App\TempCart::where('session_id', $session_id)->update(['user_id'=>$check_login->id]);
                return response()->json(['response' => 'success', 'msg' => 'Login Success']);
            }else{
                return response()->json(['response' => 'error', 'msg' => 'Invalid login credential / account blocked by admin.
']);
            }
        }else{
            return response()->json(['response' => 'error', 'msg' => 'Invalid Login credentials']);
        }

	}
	
	
	
	
	
	public function viewUserForgotPassword() {
		return view('user-forgot-psw');
	}
	
	public function userForgotPassword(Request $request) {
		//$2y$10$HRhDli1iy1w5IAYndE4tluXeuMJdawoWI9uetAamzp2tyZbR9b0by
		
		$forgot_email = $request->input('email');
		 
        $this->validate($request, [
            'email' => 'required',
        ]);
		
		
		// Get records from core table with email address
		$result = UserRegistration::where('email',$forgot_email)->first();
		//echo "<pre>";print_r($result);exit;
		
	    if($result==null) {
			return Redirect::to('user-forgot-psw')->with('invalid', true);
		}else{
			$user_id = $result->id;
			$user_name = $result->full_name;
			
			$password = Helpers::randomPassword();
			$user_password=bcrypt($password);
			
			$data = ['password'=>$user_password];
			UserRegistration::where('id', $user_id)->update($data);

			
			// Admin Details
			$admin_det = Helpers::getAdminDetails();
			$admin_name = $admin_det->admin_name;
			$admin_email = $admin_det->alt_email;
			
			$current_year = date("Y");
				
			$subject ="User :: Forget Password";
		
			$headers = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=UTF-8\n";
			$headers .= "From:" . $admin_name . " < " . $admin_email . ">\n";
			
			//subject and content
			$res_email_template = Helpers::getTemplateDetails('4');
			$input=$res_email_template->contents;
						
			$body_user = str_replace(array('%USERNAME%','%USEREMAIL%','%USERPASSWORD%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'),array($user_name,$forgot_email,$password,$admin_name,$admin_email,$current_year),$input);
			echo $body_user;exit;
			
			$content = [
			'from_email' => $admin_email,
			'subject'=> $subject,
			'body'=> $body_user,
			'email_template' => 'emails.common_mail'
			];
			$ok=Mail::to($forgot_email)->send(new MailBuilder($content));
		
			return Redirect::to('user-forgot-psw')->with('success', true);
			
			}
	}
	 
}