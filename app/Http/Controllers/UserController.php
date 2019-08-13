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
use App\Http\Middleware\checkUserLogin;
use Hash;

use App\UserRegistration;
use App\TrainingBooking;
use App\MasterOrder;
use App\OrderItem;
use App\TempCart;


class UserController extends Controller{
	
	public function __construct(){
        $this->middleware(checkUserLogin::class);
    }
	
	public function viewUserDashboard() {
		$booking_dtls = TrainingBooking::with(['training:id,training_title'])->where('user_id','=',Session::get('user_id'))->where('transaction_id', '!=', NULL)->orderBy('id', "DESC")->take(5)->get();
		//dd($booking_dtls);
		
		$order_info = MasterOrder::where('user_id', session()->get('user_id'))->where('transaction_id','!=',NULL)->orderBy('id', "DESC")->take(5)->get();
		
		return view('user-dashboard',compact('booking_dtls','order_info'));
	}
	
	public function viewMyAccount() {
		$user_dtls = UserRegistration::where('id', session()->get('user_id'))->orderBy('id', "DESC")->first();
		return view('user-my-account',compact('user_dtls','order_info'));
	}
	
	public function updateUserAccountDetails(Request $request) {
		//$all_inputs = $request->all();
		$all_inputs = request()->except(['_token', 'password']);
        $this->validate($request, [
            'full_name' => 'required',
			'contact_no' => 'required|string|unique:user_registrations,contact_no,'.Session::get('user_id'),			'email'  =>  'required|email|unique:user_registrations,email,'.Session::get('user_id'),
			'address1' => 'required',
			'city' => 'required',
			'post_code' => 'required|min:6|max:10',
			'state' => 'required',
			'country' => 'required'
        ]);
		
		//echo "ddddd";exit;
        $update_profile = UserRegistration::where('id', session()->get('user_id'))->update($all_inputs);
        if ($update_profile) {
			return Redirect::to('user-my-account')->with('success', true);
        }
	}
	
	
	public function viewUserChangePassword() {
		 return view('user-change-password');
	}
	
	public function updateUserPassword(Request $request) {
		$this->validate($request, [
            'old_psw' => 'required',
            'new_psw' => 'required',
            'conf_psw' => 'required|same:new_psw',
        ]);
        $user = UserRegistration::where('id', session()->get('user_id'))->select('id', 'password')->first();
        if (Hash::check($request->old_psw, $user->password)) {
            $user->fill(['password' => Hash::make($request->new_psw)])->save();
			return Redirect::to('user-change-password')->with('success', true);
        } else {
			return Redirect::to('user-change-password')->with('error', true);
        }
	}
	
	
	
	public function viewUserBookingHistory() {
		$booking_dtls = TrainingBooking::with(['training:id,training_title'])->where('user_id','=',Session::get('user_id'))->where('transaction_id', '!=', NULL)->orderBy('id', "DESC")->take(20)->get();
		//dd($booking_dtls);
		return view('user-booking-history',compact('booking_dtls'));
	}
	
	public function viewUserBookingDetails($id) {
		$booking_dtls = TrainingBooking::with(['training:id,training_title'])->where([['id','=',$id],['user_id','=',Session::get('user_id')]])->first();
		if($booking_dtls==NULL){
			return Redirect::to('user-booking-history');
        }else{
			return view('user-booking-details',compact('booking_dtls'));
		}
    }
	
	public function viewUserOrderHistory() {
		$order_info = MasterOrder::where('user_id', session()->get('user_id'))->where('transaction_id','!=',NULL)->orderBy('id', 'DESC')->get();
		//dd($order_info);
		return view('user-order-history',compact('order_info'));
	}
	
	public function viewUserOrderDetails($id) {
		//$chk_order = OrderItem::where('order_id', $id)->count();
		$user_id = Session::get('user_id');
		
		$order_dtls = MasterOrder::where('id', $id)->where('transaction_id', '!=','')->where('user_id', '=',$user_id)->first();
		
		
		if ($order_dtls != NULL) {
			$order_items = OrderItem::with('productPrice.size','productPrice.color','productPrice.product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        } else {
            return Redirect::to('user-order-history');
        }
        return view('user-order-details', compact('order_items', 'order_dtls'));
    }
	
	
    public function userLogout() {
		$session_id = session()->getId();
        $deleteSessdata = TempCart::where('session_id', $session_id)->delete();
		
		$user_id = session()->get('user_id');
        $order_dtls = MasterOrder::where([['user_id' , $user_id], ['transaction_id', NULL]])->get();
		//dd($order_dtls);
		
        foreach ($order_dtls as $order_info) {
            OrderItem::where('order_id', $order_info->id)->delete();
			MasterOrder::where('id', '=', $order_info->id)->delete();
        }
        session()->flush();
        return Redirect::to('user-login');
    }

}