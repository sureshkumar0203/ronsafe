<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Helpers;
use DB;
use Redirect;
use Session;

use App\Mail\MailBuilder;
use Mail;

use App\Banner;
use App\cmsContent;
use App\Training;
use App\OurService;
use App\UserRegistration;
use App\TrainingBooking;
use App\Videos;
use App\Testimonial;


class HomeController extends Controller
{
    public function showHome(){
		$banner_data = Banner::with(['cmsPageLink' => function($query) {
			$query->select(['id', 'page_title','content']);
		}])->orderBy('cp_id', 'DESC')->get();
		
		
		$abt_data = cmsContent::where('id', 1)->first();
		$cv_data = cmsContent::where('id', 11)->first();
		$training_data = Training::all()->sortByDesc("id")->take(4);
		$service_data = OurService::all()->sortByDesc("id")->take(3);
		$testi_data = Testimonial::orderBy('id', 'desc')->get();
		//dd($training_data);
		
		return view('home',compact('banner_data','abt_data','cv_data','training_data','service_data','testi_data'));
	}
	
	public function aboutUs(){
		$abt_data = cmsContent::where('id', 1)->first();
		$csr_data = cmsContent::where('id', 5)->first();
		return view('about-us',compact('abt_data','csr_data'));
	}
	
	public function viewTermsAndConditions(){
		$tc_data = cmsContent::where('id', 8)->first();
		return view('terms-and-conditions',compact('tc_data'));
	}
	
	public function viewPrivacyPolicy(){
		$pp_data = cmsContent::where('id', 9)->first();
		return view('privacy-policy',compact('pp_data'));
	}
	
	
	
	public function viewServices(){
		$rt_data = cmsContent::where('id', 6)->first();
		$so_data = cmsContent::where('id', 7)->first();
		
		$service_data = OurService::all()->sortByDesc("id");
		return view('services',compact('service_data','rt_data','so_data'));
	}
	
	public function viewTraining(){
		$training_inst_data = cmsContent::where('id', 10)->first();
		$training_data = Training::all()->sortByDesc("id");
		return view('training',compact('training_data','training_inst_data'));
	}
	
	
	
	public function viewBookTraining($training_id){
		$training_data = Training::where('id', $training_id)->first();
		if($training_data == NULL){
			return Redirect::to('training');
		}
		if(Session::get('user_id')!=''){
			$user_dtls =  UserRegistration::where('id', Session::get('user_id'))->first();
		}else{
			$user_dtls = "";
		}
		
		return view('book-a-training',compact('training_data','user_dtls'));
	}
	
	
	public function saveTrainingDetails(Request $request) {
		$all_input = $request->all();
		$this->validate($request, [
			'training_id' => 'required',
			'training_price' => 'required',
			'full_name' => 'required',
			'contact_no' => 'required', 
			'email' => 'required',
			'address1' => 'required',
			'city' => 'required',
			'post_code' => 'required|min:6|max:10',
			'state' => 'required',
			'country' => 'required'
		]);
		
		if(Session::get('user_id')==''){
			$this->validate($request, [
			  'contact_no' => 'required|string|unique:user_registrations,contact_no',
			  'password' => 'required',
			  'email' => 'required|string|unique:user_registrations,email'
		  ]);
		
			$all_input['password'] = bcrypt($request->password);
			$save_user_data = UserRegistration::create($all_input);
			
			// Store in SESSION
			Session::put('user_id', $save_user_data->id);
			Session::put('user_name', $save_user_data->full_name);
		}
		
		
		$all_input['user_id'] = Session::get('user_id');
		$save_training_data = TrainingBooking::create($all_input);
		
		Session::put('training_booking_id', $save_training_data->id);
		Session::put('training_amount', $save_training_data->training_price);
		
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
		
		return view('training-paypal');
	}
	
	
	public function viewTrainingPaypal(){
		return view('training-paypal');
	}
	
	
	public function updateTrainingTransactionDetails(){
		/*$fp=fopen("ipnresult.txt","w");
		foreach($_POST as $key => $value){
			fwrite($fp,$key.'===='.$value."\n");
		}*/
		
		$custom=$_POST['custom'];
		$txn_id=$_POST['txn_id'];
		
		/*$custom='1';
		$txn_id='TRNS43534OK24';*/
		
		//Booking Detail
		$booking_dtls = TrainingBooking::where('id', $custom)->first();
		$user_name = $booking_dtls->full_name;
		$user_email = $booking_dtls->email;
		
		//Update Paypal Transaction ID
		$update_trns_dtls = TrainingBooking::where('id', $custom)->update(['transaction_id' => $txn_id]);
		
	
		
		//###################### Training Booking mail goes to USER#################
		// Admin Details
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det->admin_name;
		$admin_email = $admin_det->alt_email;
		
		$current_year = date("Y");
		$subject = "Ronsafe :: Your Booking completed successfully";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 3)->get();
		$input = $res_template[0]->contents;
		
		$body_user = str_replace(array('%USERNAME%','%BOOKINGID%','%TRNSID%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($user_name,$custom,$txn_id,$admin_name,$admin_email, $current_year), $input);
		//echo $body_user;exit;
		
		$content = [
			'from_email' => $admin_email,
			'subject'=> $subject,
			'body'=> $body_user,
			'email_template' => 'emails.common_mail'
			];
		$ok=Mail::to($user_email)->send(new MailBuilder($content));
		
		//###################### Training Booking mail goes to ADMIN#################
		
		$subject_admin = "Ronsafe :: New Training Booking";
		
		//Email Template Details
		$res_template_admin = DB::table('email_template')->where('id', '=', 7)->get();
		$input_admin = $res_template_admin[0]->contents;
		
		$body_admin = str_replace(array('%ADMINNAME%','%BOOKINGID%','%TRNSID%','%USERNAME%','%USEREMAIL%','%CURRENTYEAR%'), array($admin_name,$custom,$txn_id,$user_name,$user_email, $current_year), $input_admin);
		//echo $body_admin;exit;
		
		$content_admin = [
			'from_email' => $user_email,
			'subject'=> $subject_admin,
			'body'=> $body_admin,
			'email_template' => 'emails.common_mail'
			];
		$ok=Mail::to($admin_email)->send(new MailBuilder($content_admin));
		
		Session::forget('training_booking_id');
		Session::forget('training_amount');
		
		return view('training-thank-you');
		
	}
	
	public function viewTrainingThankYou(){
		return view('training-thank-you');
	}
	
	public function viewTrainingPaymentFail(){
		return view('payment-failed');
	}
	
	public function viewContact(){
		return view('contact-us');
	}
	
	public function sendContactEmail(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'enquiry' => 'required',
        ]);
		
		$subject = $request->subject;
        $contact_no = $request->contact_no;
		$full_name = $request->name;
        $user_email = $request->email;
        $your_message = $request->enquiry;
		
		// Admin Details
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det->admin_name;
		$admin_email = $admin_det->alt_email;
		
		$current_year = date("Y");
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 2)->get();
		$input = $res_template[0]->contents;
		
		$body_admin = str_replace(array('%ADMINNAME%','%NAME%','%EMAIL%','%CONTACTNO%','%MESSAGE%','%ADMINEMAIL%','%CURRENTYEAR%'), array($admin_name,$full_name,$user_email,$contact_no,$your_message,$admin_email, $current_year), $input);
		//echo $body_admin;exit;
		
		$content = [
			'from_email' => $user_email,
			'subject'=> $subject,
			'body'=> $body_admin,
			'email_template' => 'emails.common_mail'
			];
		$ok=Mail::to($admin_email)->send(new MailBuilder($content));
		
		/*$ok = Mail::send('emails.common_mail', ['content' => $content], function ($message) use($user_email,$full_name,$admin_email,$admin_name,$subject) {
		  $message->from($user_email, $full_name);
		  $message->to($admin_email, $admin_name);
		  $message->subject($subject);
		  //$message->attach($pathToFile);
		});*/

	
        /*$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From:" . $full_name . " < " . $user_email . ">\n";
		$ok = mail($admin_email, $subject, $body_admin, $headers);*/
		
		
        return Redirect::to('contact-us')->with('success', true);
    }
	
	
	public function viewVideos(){
		$video_data = Videos::orderBy('id', 'desc')->get();
		return view('videos',compact('video_data'));
	}
	
}
