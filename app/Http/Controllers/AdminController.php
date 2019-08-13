<?php
namespace App\Http\Controllers;
use Helpers;
use Config;
use Hash;
//This line is used for getting the input box value
use Illuminate\Http\Request;

use App\Admin;
use App\Seo;
use App\TrainingBooking;
use App\UserRegistration;
use App\MasterOrder;
use App\PaymentSetting;
use App\OrderItem;
use App\TempCart;

use App\Mail\MailBuilder;
use Mail;

//This line is used for database connection
use DB;
//This line is used for session
use Session;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;
//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;





class adminController extends Controller{
	
	public function __construct(){
        $this->middleware(checkAdminLogin::class);
    }
	
	public function viewAdminDashboard() {
		//$booking_dtls = TrainingBooking::with(['training:id,training_title'])->where('transaction_id', '!=', NULL)->orderBy('id', "DESC")->get();
		
		$order_dtls = MasterOrder::where([['transaction_id', '!=', NULL],['order_status',0]])->orderBy('id', 'DESC')->get();
		return view('admin.admin-dashboard', compact('order_dtls'));
	}
	
    public function adminLogout() {
		//Delete data from cart_temp table
		$yesterday=date('Y-m-d', strtotime("-5 day"));
		$delete_cart_rec = TempCart::whereDate('created_at', '<=',$yesterday)->delete();
		
		
		//Delete data from master order & order items table
		$order_recs = MasterOrder::where('transaction_id',NULL)->whereDate('created_at', '<=',$yesterday)->get();
		//dd($order_recs);
		
		foreach($order_recs as $del_rec){
			$delete_cart_rec = OrderItem::where('order_id', '=',$del_rec->id)->delete();
			$delete_cart_rec = MasterOrder::where('id', '=',$del_rec->id)->delete();
		}	
		
		//Delete data from training bookings
		TrainingBooking::where('transaction_id',NULL)->whereDate('created_at', '<=',$yesterday)->delete();

        Session::flush();
        Session::forget('admin_id');
        Session::forget('admin_name');
        return Redirect::to('administrator');
    }
	
	public function viewAccount(){
		$admin_dtls = Admin::where('admin_id', Session::get('admin_id'))->first();
		//print_r($admin_dtls);exit;
        return view('admin.my-account', compact('admin_dtls'));
	}
	
	public function updateAccountDetails(Request $request) {
        //dd($request->all());exit;
        $this->validate($request, [
            'admin_name' => 'required',
            'email' => 'required',
            'alt_email' => 'required',
            'contact_no' => 'required|min:10|max:50',
            'address' => 'required',
            'facebook_url' => 'url|nullable',
            'twitter_url' => 'url|nullable',
            'instagram_url' => 'url|nullable',
        ]);
		
        $data = request()->except(['_token']);
        $updated = Admin::where('admin_id', Session::get('admin_id'))->update($data);
		
		if ($updated) {
			return Redirect::to('administrator/my-account')->with('success', 'Records has been saved successfully');
        } else {
            return Redirect::to('administrator/my-account')->with('error', 'Records updation failed.');
        }
    }
	
	public function viewChangePassword(){
        return view('admin.change-password');
	}
	
	public function updatePassword(Request $request) {
        //dd($request->all());exit;
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
			'confirm_password' => 'required|same:new_password|min:6',
        ]);
		
		
        $adm_dtls = Admin::where('admin_id',Session::get('admin_id'))->first();
		//echo "<pre>";print_r($adm_dtls);exit;
		
		if (Hash::check($request->old_password, $adm_dtls->password)) {
			Admin::where(['admin_id' => Session::get('admin_id')])->update(['password' => Hash::make($request->new_password)]);
			
            return Redirect::to('administrator/change-password')->with('success', 'Password has been changed successfully');
        } else {
            return Redirect::to('administrator/change-password')->with('error', 'Password chnage failed.');
        }
    }
	
	public function viewSeo(){
		$seo_dtls = Seo::where('id',1)->first();
        return view('admin.manage-seo', compact('seo_dtls'));
	}
	
	public function updateSeoDetails(Request $request) {
        //dd($request->all());exit;
        $this->validate($request, [
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_descr' => 'required',
        ]);
		
        $data = request()->except(['_token']);
        $updated = Seo::where('id', Session::get('admin_id'))->update($data);
		
		if ($updated) {
			return Redirect::to('administrator/manage-seo')->with('success', 'Records has been updated successfully');
        } else {
            return Redirect::to('administrator/manage-seo')->with('error', 'Records updation failed.');
        }
    }

    public function paymentSetting(){
    	$getPaymentSetting = PaymentSetting::first();
        return view('admin.payment-setting', compact('getPaymentSetting'));
    }

    public function updatePaymentSetting(Request $request) {
        $this->validate($request, [
            'paypal_environment' => 'required',
            'paypal_email' => 'required|email',
        ]);
        $data = request()->except(['_token']);
        $paymentSettingUpdate = PaymentSetting::where('id', 1)
                ->update($data);
        if ($paymentSettingUpdate) {
            $request->session()->flash('success', 'PaymentSetting updated successfully.');
            return back();
        } else {
            $request->session()->flash('error', 'Error occured updation.');
            return back();
        }
    }
	
	public function viewTrainingBookings() {
		$booking_dtls = TrainingBooking::with(['training:id,training_title'])->where('transaction_id', '!=', NULL)->orderBy('id', "DESC")->get();
        return view('admin.manage-bookings', compact('booking_dtls'));
	}
	
	public function viewTrainingBookingDetails($id) {
		if(TrainingBooking::find($id)==null){
			 return redirect('administrator/manage-bookings');
        }else{
			$booking_dtls = TrainingBooking::with(['training:id,training_title'])->where('id','=',$id)->where('transaction_id', '!=', NULL)->orderBy('id', "DESC")->first();
			return view('admin.booking-details', compact('booking_dtls'));
		}
    }
	
	
	public function viewManageUsers(){
		$usr_dtls = UserRegistration::orderBy('id', 'DESC')->get();
        return view('admin.manage-users', compact('usr_dtls'));
	}
	
	public function blockUser($id) {
		UserRegistration::where('id', $id)->update(['active_status' => 1]);
        return Redirect::to('administrator/manage-users');
    }

    public function unblockUser($id) {
        UserRegistration::where('id', $id)->update(['active_status' => 0]);
        return Redirect::to('administrator/manage-users');
    }

    public function deleteUser($id) {
		UserRegistration::destroy($id);
        return Redirect::to('administrator/manage-users');
    }
	
	public function viewManageOrders() {
		$order_dtls = MasterOrder::where('transaction_id', '!=', NULL)->orderBy('id', 'DESC')->get();
		return view('admin.manage-orders',compact('order_dtls'));
	}
	
	public function viewOrderDetails($id) {
		$user_id = Session::get('user_id');
		$order_dtls = MasterOrder::where('id', $id)->where('transaction_id', '!=','')->first();
		if ($order_dtls != NULL) {
			$order_items = OrderItem::with('productPrice.size','productPrice.color','productPrice.product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        } else {
            return Redirect::to('manage-order');
        }
		return view('admin.order-details', compact('order_items', 'order_dtls'));
	}
	
	public function updateOrderStatus(Request $request) {
		$all_input = request()->except(['_token', 'order_id']);
        $all_input['ship_date'] = date("Y-m-d");
		$order_id = $request->order_id;
		
        if($request->order_status==1 && $order_id > 0) {
			$update_Shipping = MasterOrder::where('id', $request->order_id)->update($all_input);

			//Order Details
			$order_det = MasterOrder::where('id', $request->order_id)->select('email','full_name')->first();
			//dd($order_det);exit;
			$user_email = $order_det->email;
			$user_name = $order_det->full_name;
		
		
			// Admin Details
			$admin_det = Helpers::getAdminDetails();
			$admin_name = $admin_det->admin_name;
			$admin_email = $admin_det->alt_email;
		
			$current_year = date("Y");
			
			# Subject
			$subject = "Ronsafe :: Your order has been despatched.";
		
			//Email Template Details
			$res_template = DB::table('email_template')->where('id', '=', 5)->get();
			$input = $res_template[0]->contents;
			
			
	  
		   
			$body_user = str_replace(array('%USERNAME%', '%ORDERNUMBER%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($user_name,$order_id,$admin_name,$admin_email, $current_year), $input);
		    //echo $body_user;exit;
			
			$content = [
			'from_email' => $admin_email,
			'subject'=> $subject,
			'body'=> $body_user,
			'email_template' => 'emails.common_mail'
			];
			$ok=Mail::to($user_email)->send(new MailBuilder($content));
			
			return Redirect::to('administrator/order-details/' . $order_id . '/details')->with('success', true);
		}else{
			return Redirect::to('administrator/order-details/' . $order_id . '/details')->with('failed', true);
		}
		

	}


	 public function deleteCmsImage(Request $request){
        $id = $request->id;
        if($id != ''){
            $path = \App\cmsContent::where('id', $id)->first();
            if (!empty($path->cms_photo)) {
                $cms_ph_path = public_path('cms-photo/' . $path->cms_photo);
                if (file_exists($cms_ph_path)) {
                    unlink($cms_ph_path);
                }
            }
            $update = \App\cmsContent::where('id', $id)->update(['cms_photo' => '']);
            return response()->json(['response' => "success", 'msg' => "success"]);  
        }else{
            return response()->json(['response' => "error", 'msg' => "error"]);
        }
    }
	
	

}