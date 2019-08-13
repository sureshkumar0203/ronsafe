<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Hash;

use App\Product;
use \App\Category;
use \App\ProductOptionalImage;


use \App\UserRegistration;
use \App\Training;
use App\Banner;
use \App\MasterOrder;
use \App\OrderItem;
use \App\TrainingBooking;
use \App\productPrice;
use \App\TempCart;



use Helpers;
use App\Mail\MailBuilder;
use Mail;

class ApiController extends Controller {
  //http://192.168.0.170/ronsafe/api/user-sign-up [POST METHOD]	 
  public function userSignup(Request $request){
	  $bodyData = $request->all();
	  
	  $full_name = $bodyData['full_name'];
	  $email = $bodyData['email'];
	  $password = bcrypt($bodyData['password']);
	  $contact_no = $bodyData['contact_no'];
	  $address1 = $bodyData['address1'];
	  $address2 = $bodyData['address2'];
	  $city = $bodyData['city'];
	  $post_code = $bodyData['post_code'];
	  $state = $bodyData['state'];
	  $country = $bodyData['country'];
	  
		  
	  $user_count_email = UserRegistration::where('email', $email)->count();
	  
	  if($full_name=="" || $email=="" || $password=="" || $contact_no=="" || $address1=="" ||  $city=="" || $post_code=="" || $state=="" ||  $country==""){
		  return response()->json(['status' => 'error', 'message' => 'Please enter all mandotory fileds value.']);
	  }else if($user_count_email > 0){
		  return response()->json(['status' => 'error', 'message' => 'This email already exist.']);
	  }else{
		  UserRegistration::create([
		  'full_name' => $full_name,
		  'email' => $email,
		  'password' => $password,
		  'contact_no' => $contact_no,
		  'address1' => $address1,
		  'address2' => $address2,
		  'city' => $city,
		  'post_code' => $post_code,
		  'state' => $state,
		  'country' => $country
		  ]);
		  return response()->json(['status' => 'success', 'message' => 'Registered successfully.']); 
	  }
  }
  
  //http://192.168.0.170/ronsafe/api/user-login?data={"login_email":"suresh@bletindia.com","login_psw":"Demo@123"}
  public function userLogin(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  
	  $user_email = $jsonData->login_email;
	  $user_password = $jsonData->login_psw;
  
	  if ($user_email == "" || $user_password == "") {
		  return response()->json(['status' => 'error', 'message' => 'Please enter email & password']);
	  }
  
	  // Get records from core table with email address
	  $result = UserRegistration::select(DB::raw("id,password,full_name"))->where('email', $user_email)->first();
  
	  if ($result == NULL) {
		  return response()->json(['status' => 'error', 'message' => 'Invalid email/password.']);
	  } else if ($result != NULL && Hash::check($user_password, $result->password) == false) {
		  return response()->json(['status' => 'error', 'message' => 'Invalid email/password.']);
	  } else {
		  unset($result['password']);
		  return response()->json(['status' => 'success', 'dataResponse' => $result]);
	  }
  }
  
  //http://192.168.0.170/ronsafe/api/user-details?data={"user_id":1}
  public function userDetails(Request $request) {
        $jsonData = json_decode($request->input('data'));
        $user_id = $jsonData->user_id;

        //$result_array = array();
        $user_details = UserRegistration::select('id', 'full_name','email', 'contact_no', 'address1', 'address2', 'city', 'post_code', 'state', 'country')->where('id', $user_id)->first();

        if($user_details != ''){
            return response()->json(['status' => 'success', 'dataResponse' => $user_details]);
        } else {
            echo '{"status":"error","message":"No Record found"}';
            exit;
        }
    }
	
  //http://192.168.0.170/ronsafe/api/update-user-details [POST METHOD]	 
  public function updateUserDetails(Request $request){
	  $bodyData = $request->all();
	  $id = $bodyData['user_id'];
	  $full_name = $bodyData['full_name'];
	  $email = $bodyData['email'];
	  $contact_no = $bodyData['contact_no'];
	  $address1 = $bodyData['address1'];
	  $address2 = $bodyData['address2'];
	  $city = $bodyData['city'];
	  $post_code = $bodyData['post_code'];
	  $state = $bodyData['state'];
	  $country = $bodyData['country'];
	  
	  $user_count_id = UserRegistration::where('id', '=', $id)->count();
	  $user_count_email = UserRegistration::where('email', $email)->where('id', '!=', $id)->count();
	  
	  if($full_name=="" || $email=="" || $contact_no=="" || $address1=="" ||  $city=="" || $post_code=="" || $state=="" ||  $country=="" || $id==""){
		  return response()->json(['status' => 'error', 'message' => 'Please enter all mandotory fileds value.']);
	  }else if($user_count_id == 0){
		  return response()->json(['status' => 'error', 'message' => 'Invalid user id.']);
	  }else if($user_count_email > 0){
		  return response()->json(['status' => 'error', 'message' => 'This email already exist.']);
	  }else{
		  UserRegistration::where('id',$id)->update([
		  'full_name' => $full_name,
		  'email' => $email,
		  'contact_no' => $contact_no,
		  'address1' => $address1,
		  'address2' => $address2,
		  'city' => $city,
		  'post_code' => $post_code,
		  'state' => $state,
		  'country' => $country
		  ]);
		  return response()->json(['status' => 'success', 'message' => 'Record updated successfully.']); 
	  }
  }
	
  //http://192.168.0.170/ronsafe/api/user-forgot-password?data={"forgot_email":"suresh@bletindia.com"}	
  public function userForgotPassword(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  $forgot_email = $jsonData->forgot_email;
  
	  if ($forgot_email == "") {
		  return response()->json(['status' => 'error', 'message' => 'Please enter email address.']);
	  }
	  $result = UserRegistration::where('email',$forgot_email)->first();
	  
	  if($result==null) {
		  return response()->json(['status' => 'error', 'message' => 'Invalid email address.']);
	  }else{
		  $user_id = $result->id;
		  $user_name = $result->full_name;
		  
		  $password = Helpers::randomPassword();
		  $user_password=bcrypt($password);
		  
		  $data = ['password'=>$user_password];
		  //UserRegistration::where('id', $user_id)->update($data);
  
		  
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
		  //echo $body_user;exit;
		  
		  $content = [
		  'from_email' => $admin_email,
		  'subject'=> $subject,
		  'body'=> $body_user,
		  'email_template' => 'emails.common_mail'
		  ];
		  $ok=Mail::to($forgot_email)->send(new MailBuilder($content));
	  
		  return response()->json(['status' => 'success', 'message' => 'Password has been send to your email.']);
		  
		  }
  }

 //http://192.168.0.170/ronsafe/api/user-change-password?data={"user_id":1,"old_psw":"Demo@123","new_psw":"Suresh@1983"}	
  public function userChangePassword(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  $user_id = $jsonData->user_id;
	  $old_psw = $jsonData->old_psw;
	  $new_psw = $jsonData->new_psw;
  
	  if ($old_psw == "" || $new_psw == "") {
		  return response()->json(['status' => 'error', 'message' => 'Please enter old & new password']);
	  }
  
	  $user_data = UserRegistration::select(DB::raw("id,password,full_name"))->where('id', $user_id)->first();
	  //print_r($user_data);exit;
	  if($user_data == ''){
		  return response()->json(['status' => 'error', 'message' => 'Invalid user id.']);
	  }else if ($user_data != '' && Hash::check($old_psw, $user_data->password) == false) {
		  return response()->json(['status' => 'error', 'message' => 'Invalid old password.']);
	  } else {
		  //UserRegistration::where('id', $user_id)->update(['password' => Hash::make($new_psw)]);
		  return response()->json(['status' => 'success', 'message' => 'Password has been changed successfully.']);
	  }
  }
	
  //http://192.168.0.170/ronsafe/api/training-list
  public function trainingList() {
	$all_training_rec = Training::select('id','training_title','training_price','training_icon','training_details')->get();
	if ($all_training_rec->count() > 0) {
		$training_ary = [];
		foreach ($all_training_rec as $key => $training_res) {
			$training_ary[] = $training_res;
			$training_ary[$key]['training_icon'] = asset('public/training-icons/' . $training_res->training_icon);
		}
		return response()->json(['status' => 'success', 'dataResponse' => $training_ary]);
	} else {
		return response()->json(['status' => 'error', 'message' => 'No products uploadd']);
	}
  }
  
  //http://192.168.0.170/ronsafe/api/home-latest-training
   public function homeLatestTraining() {
	$all_training_rec = Training::select('id','training_title','training_price','training_icon','training_details')->orderBy('id','DESC')->limit(3)->get();
	
	$banners = Banner::orderBy('id','DESC')->get();
	
	$training_ary = [];
	$banner_ary = [];
	if ($all_training_rec->count() > 0) {
	  foreach ($all_training_rec as $key => $training_res) {
		  $training_ary[] = $training_res;
		  $training_ary[$key]['training_icon'] = asset('public/training-icons/' . $training_res->training_icon);
	  }
	  
	  foreach($banners as $banner_key => $banner_val){
		  array_push($banner_ary,asset('public/banners/'.$banner_val->banner_photo));
		  //$banner_ary['banner_photo'] = asset('public/banners/'.$banner_val->banner_photo);
	  }
	 
			
			
	  return response()->json(['status' => 'success', 'dataResponse' => $training_ary,'dataBanner'=>$banner_ary]);
	} else {
		return response()->json(['status' => 'error', 'message' => 'No products uploadd']);
	}
  }
   
   
  //http://192.168.0.170/ronsafe/api/categories
  public function categoryList(Request $request){
		$jsonData = json_decode($request->input('data'));
		$cat_ary = Category::orderBy('id', 'DESC')->get();
		//dd($cat_ary);
		if(count($cat_ary) > 0){
			$result_cat_array = array();
			foreach($cat_ary as $cat_det){
				$id = $cat_det->id;
				$cat_name = $cat_det->cat_name;
				
				$cat_info = array('id'=>$id,'cat_name'=>$cat_name);
				array_push($result_cat_array, $cat_info);
			}
			echo '{"status":"success","categories":'.json_encode($result_cat_array).'}';exit;
		}else{
			echo '{"status":"error","message":"No category found."}';exit;
		}
	}
	
  //http://192.168.0.170/ronsafe/api/products
  public function productList(Request $request){
		$jsonData = json_decode($request->input('data'));
		$prd_ary = Product::where('active_status',0)->get();
		
		if(count($prd_ary) > 0){
			$result_array = array();
			foreach($prd_ary as $prd_det){
				$id = $prd_det->id;
				$prd_cat_id = $prd_det->prd_cat_id;
				$prd_name = $prd_det->prd_name;
				$prd_photo = asset('public/product-photo/' . $prd_det->prd_photo);
				$prd_cs_opt = $prd_det->prd_cs_opt;
				
				$min_max_price_ary = Helpers::eachProductsMinMaxPrice($prd_det->id); 
				$min_price = $min_max_price_ary['min_price_rec'][0]->prd_price;
				$max_price = $min_max_price_ary['max_price_rec'][0]->prd_price;
				
				$price_id = $min_max_price_ary['max_price_rec'][0]->id;
				 
				 
				$prd_info = array('id'=>$id,'prd_cat_id'=>$prd_cat_id,'prd_name'=>$prd_name,'prd_photo'=>$prd_photo,'prd_cs_opt'=>$prd_cs_opt,'min_price'=>$min_price,'max_price'=>$max_price,'price_id'=>$price_id);
				array_push($result_array, $prd_info);
			}
			echo '{"status":"success","products":'.json_encode($result_array).'}';exit;
		}else{
			echo '{"status":"error","message"=>"No products found","allProducts":'.'[]'.'}';exit;
		}
	}
  
  //http://192.168.0.170/ronsafe/api/product-details?data={"prd_id":11}
  public function productDetails(Request $request) {
        $jsonData = json_decode($request->input('data'));
        $prd_id = $jsonData->prd_id;
		$prd_det = Product::with(array(
					'productOptionalImages'=>function($query1){
						$query1->select('id','prd_id','opt_images');
					},
					
					'productPrice.size'=>function($query2){
						$query2->select('id','size');
						$query2->orderBy('id', 'asc');
					},
					
					'productPrice.color'=>function($query3){
						$query3->select('id','color','color_code');
						$query3->orderBy('id', 'asc');
					}
					
					
					))->where('id', $prd_id)->orderBy('id', 'DESC')->first();

        if ($prd_det!= NULL) {
			$prd_info = array();
			
			$id = $prd_det->id;
			$prd_cat_id = $prd_det->prd_cat_id;
			$prd_name = $prd_det->prd_name;
			$prd_photo = asset('public/product-photo/' . $prd_det->prd_photo);
			$prd_details = $prd_det->prd_details;
			$prd_cs_opt = $prd_det->prd_cs_opt;
			
			
			$min_max_price_ary = Helpers::eachProductsMinMaxPrice($prd_det->id); 
			$min_price = $min_max_price_ary['min_price_rec'][0]->prd_price;
			$max_price = $min_max_price_ary['max_price_rec'][0]->prd_price;
			$price_id = $min_max_price_ary['max_price_rec'][0]->id;
			 
			 
			$prd_info = array('id'=>$id,'prd_cat_id'=>$prd_cat_id,'prd_name'=>$prd_name,'prd_photo'=>$prd_photo,'prd_details'=>$prd_details,'prd_cs_opt'=>$prd_cs_opt,'min_price'=>$min_price,'max_price'=>$max_price,'price_id'=>$price_id);
			
			$opt_ph_array = array();
			foreach($prd_det->productOptionalImages as $opt_ph){
				//$ph_id = $opt_ph->id;
				$opt_ph_path = asset('public/product-photo/'.$opt_ph->opt_images);
				
				$opt_ph_info = array('ph_id'=> $opt_ph->id,'prd_id'=> $opt_ph->prd_id,'opt_ph_path'=>$opt_ph_path);
				array_push($opt_ph_array, $opt_ph_info);
			}
			
			$price_array = array();
			foreach($prd_det->productPrice as $prd_price_dtls){	
				$price = number_format($prd_price_dtls->prd_price,2,'.','');
				$cs_id = $prd_price_dtls->id;
				$prd_id = $prd_price_dtls->prd_id;
				
				if($prd_det->prd_cs_opt==1){
				  $color_code = $prd_price_dtls->color->color_code;
				  $size = $prd_price_dtls->size->size;
				}else{
					 $color_code = "";
					 $size = "";
				}
				
				$price_info = array('cs_id'=> $cs_id,'prd_id'=>$prd_id,'size'=> $size,'color_code'=> $color_code,'price'=>$price);
				array_push($price_array, $price_info);
			}
			
			
			$similar_prd_data = Product::where([['id','!=',$id],['prd_cat_id',$prd_cat_id]])->orderBy('id', 'DESC')->limit(10)->get();
			$similar_prd_array = array();
			foreach($similar_prd_data as $prd_val){
				$id = $prd_val->id;
				$prd_cat_id = $prd_val->prd_cat_id;
				$prd_name = $prd_val->prd_name;
				$prd_photo = asset('public/product-photo/' . $prd_val->prd_photo);
				$prd_details = $prd_val->prd_details;
				$prd_cs_opt = $prd_val->prd_cs_opt;
				
				$min_max_price_ary = Helpers::eachProductsMinMaxPrice($prd_val->id); 
				$min_price = $min_max_price_ary['min_price_rec'][0]->prd_price;
				$max_price = $min_max_price_ary['max_price_rec'][0]->prd_price;
				$price_id = $min_max_price_ary['max_price_rec'][0]->id;
			
				$similar_prd_info = array('id'=>$id,'prd_cat_id'=>$prd_cat_id,'prd_name'=>$prd_name,'prd_photo'=>$prd_photo,'prd_details'=>$prd_details,'prd_cs_opt'=>$prd_cs_opt,'min_price'=>$min_price,'max_price'=>$max_price,'price_id'=>$price_id);
				
				array_push($similar_prd_array, $similar_prd_info);
			}
			
			//dd($similar_prd_array);
			
			
            return response()->json(['status' => 'success', 'productDetails' => $prd_info,'optionalPhoto' => $opt_ph_array,'colorSizeOption' => $price_array,'similarProducts'=>$similar_prd_array]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No record found']);
        }
    }

  //http://192.168.0.170/ronsafe/api/order-history?data={"user_id":1}
  public function orderHistory(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  $user_id = $jsonData->user_id;

	  if ($user_id == "") {
		  return response()->json(['status' => 'error', 'message' => 'Provide valid user ID']);
	  }

	  //Fetch master order information from master order table
	  //1 = Shipped
	  $order_info = MasterOrder::select('id', 'created_at', 'transaction_id', 'grand_total', 'order_status')->where('user_id', $user_id)->where('transaction_id','!=',null)->orderBy('id', 'DESC')->take(10)->get();
	  //dd($order_info);

	  //$result_response = array('order_info' => $order_info);
	  return response()->json(['status' => 'success', 'dataResponse' => $order_info]);
  }

  //http://192.168.0.170/ronsafe/api/order-details?data={"user_id":1,"order_id":2}
  public function orderDetails(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  $user_id = $jsonData->user_id;
	  $order_id = $jsonData->order_id;
	  //echo $user_id."--".$order_id;exit;
	  
	  if ($user_id == "" || $order_id == "") {
		  return response()->json(['status' => 'error', 'message' => 'Invalid user ID & order ID.']);
	  }

	  $order_chk = MasterOrder::where([['user_id',$user_id],['id', $order_id]])->count();
	  //dd($order_chk);

	  if($order_chk > 0){
		  //Fetch master order information from master order table
		  $order_info = [];
		  $order_info = MasterOrder::where('user_id', $user_id)->where('id', $order_id)->orderBy('id', 'DESC')->first();
		  //dd($order_info);

		  //Fetch item & product information from order items & product table
		  $path = asset('public/product-photo/') . "/";
		  $item_ary = [];

		  $item_info = OrderItem::with('productPrice.size','productPrice.color','productPrice.product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

		  foreach ($item_info as $item_key => $item_dtls) {
			  //$item_ary[$item_key]['prd_id'] = $item_dtls->products->id;

			  $item_ary[$item_key]['prd_img'] = $path . $item_dtls->productPrice->product->prd_photo;
			  $item_ary[$item_key]['prd_name'] = $item_dtls->productPrice->product->prd_name;
			  $item_ary[$item_key]['size'] = ($item_dtls->productPrice->size)?$item_dtls->productPrice->size->size:'';
			  $item_ary[$item_key]['color'] = ($item_dtls->productPrice->color)?$item_dtls->productPrice->color->color:'';
			  $item_ary[$item_key]['color_code'] = ($item_dtls->productPrice->color)?$item_dtls->productPrice->color->color_code:'';
			  $item_ary[$item_key]['qty'] = $item_dtls->qty;
			  $item_ary[$item_key]['unit_price'] = $item_dtls->unit_price;
			  $item_ary[$item_key]['total_price'] = $item_dtls->total_price;
		  }
		  $order_info['item_details'] = $item_ary;

		  $order_info['payment_status'] = ($order_info->payment_status)?$order_info->payment_status:'';
		  $order_info['order_notes'] = ($order_info->order_notes)?$order_info->order_notes:'';
		  $order_info['ship_date'] = ($order_info->ship_date)?$order_info->ship_date:'';
		  $order_info['shipping_url'] = ($order_info->shipping_url)?$order_info->shipping_url:'';
		  $order_info['tracking_id'] = ($order_info->tracking_id)?$order_info->tracking_id:'';

		  return response()->json(['status' => 'success', 'order_info' => $order_info]);
	  }else{
		  return response()->json(['status' => 'error', 'message' => 'Invalid user ID/Order ID']);
	  }
  }
	 
  //http://192.168.0.170/ronsafe/api/booking-history?data={"user_id":1}
  public function bookingHistory(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  $user_id = $jsonData->user_id;

	  $chk_usd_id = TrainingBooking::where('user_id',$user_id)->count();
	  if ($chk_usd_id == 0) {
		  return response()->json(['status' => 'error', 'message' => 'Provide valid user ID']);
	  }

	  //Fetch booking information from training_bookings table
	  //1 = Shipped
	  $booking_dtls = TrainingBooking::with(['training:id,training_title'])->where('user_id','=',$user_id)->where('transaction_id', '!=', NULL)->orderBy('id', "DESC")->take(20)->get();
	  //dd($booking_dtls);

	  $booking_ary = [];
	  foreach($booking_dtls as $bk =>$bv){
		  $booking_ary[$bk]['id'] = $bv->id;
		  $booking_ary[$bk]['training_id'] = $bv->training_id;
		  $booking_ary[$bk]['user_id'] = $bv->user_id;
		  $booking_ary[$bk]['training_price'] = $bv->training_price;
		  $booking_ary[$bk]['full_name'] = $bv->full_name;
		  $booking_ary[$bk]['contact_no'] = $bv->contact_no;
		  $booking_ary[$bk]['email'] = $bv->email;
		  $booking_ary[$bk]['address1'] = $bv->address1;
		  $booking_ary[$bk]['address2'] = $bv->address2;
		  $booking_ary[$bk]['city'] = $bv->city;
		  $booking_ary[$bk]['post_code'] = $bv->post_code;
		  $booking_ary[$bk]['state'] = $bv->state;
		  $booking_ary[$bk]['country'] = $bv->country;
		  $booking_ary[$bk]['transaction_id'] = $bv->transaction_id;
		  $booking_ary[$bk]['training_title'] = $bv->training->training_title;
		  $booking_ary[$bk]['booking_date'] = date("Y-m-d",strtotime($bv->created_at));
		  
	  }
	  //dd($booking_ary);       
	  return response()->json(['status' => 'success', 'dataResponse' => $booking_ary]);
  }

  //http://192.168.0.170/ronsafe/api/add-to-cart?data={"user_id":1,"price_id":11,"qty":1}
  public function addProductsToCart(Request $request){
	  $jsonData = json_decode($request->input('data'));
	  
	  $user_id = $jsonData->user_id;
	  $price_id = $jsonData->price_id;
	  $qty = ($jsonData->qty)?$jsonData->qty:1;

	  $price_id_chk = ProductPrice::where('id', $price_id)->count();
	  if ($price_id_chk == 0) {
		  return response()->json(['status' => 'error', 'message' => 'Invalid Price ID']);
	  }

	  $save_ary = [];
	  $prd_opt_price_dtls = productPrice::with(['size','color'])->where('id',$price_id)->first();
	  //dd($prd_opt_price_dtls);
	  $prd_id = $prd_opt_price_dtls->prd_id;
	  $unit_price = $prd_opt_price_dtls->prd_price;

	  if($prd_opt_price_dtls->size != null && $prd_opt_price_dtls->color != null){
		  $size = $prd_opt_price_dtls->size->size;
		  $color = $prd_opt_price_dtls->color->color;
		  $save_ary['size'] = $size;
		  $save_ary['color'] = $color;
	  }

	  //Total price is  calculated according to inputed quantity
	  $total_price=$unit_price*$qty;
	  
	  
	  
	  //fetching the selected product information from the cart table	
	  $cart_info = TempCart::where([['price_id', $price_id], ['user_id', $user_id]])->get();
	  
	  if(count($cart_info)>0){
		  $cart_total=$total_price+$cart_info[0]->total_price;
		  $total_qty= $qty+$cart_info[0]->qty;
	  }else{
		  $cart_total=$total_price;
		  $total_qty= $qty;
	  }

	  //Here i have checked selected product exist in the cart or not
	  $count = TempCart::where([['price_id', $price_id], ['user_id', $user_id]])->count();

	  
	  $save_ary['user_id'] = $user_id;
	  $save_ary['price_id'] = $price_id;
	  $save_ary['qty'] = $total_qty;
	  $save_ary['unit_price'] = $unit_price;
	  $save_ary['total_price'] = $cart_total;

	  //dd($save_ary);exit;


	  if ($count == 0) {
		  $cart_ins = TempCart::create($save_ary);
	  } else {
		  TempCart::where([['price_id', $price_id], ['user_id', $user_id]])->update(['qty'=>$total_qty, 'total_price'=>$cart_total]);
	  }

	  $cart_det = TempCart::where([['price_id', $price_id], ['user_id', $user_id]])->first();
	  //dd($cart_det->id);exit;

	  //echo "here";exit;
	  echo '{"status":"success","message":"Product added to cart successfully","cart_id":'.$cart_det->id.'}';exit;
  }

  //http://192.168.0.170/ronsafe/api/cart-items?data={"user_id":1}
  public function cartItems(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  $user_id = $jsonData->user_id;
	  //$cart_items = TempCart::with('productPrice.product')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();	
	  
	  $cart_items = TempCart::with('productPrice.color','productPrice.product')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();	
	  
	  if (count($cart_items) >= 0) {
		  $result_cart_array = [];
		  $payment_det = Helpers::getPaymentDetails();
		  $shipping_per = $payment_det->shipping_per;
		  foreach($cart_items as $cart_key=>$cart_det){
			  $result_cart_array[$cart_key]['id'] = $cart_det->id;
			  $result_cart_array[$cart_key]['user_id'] = $cart_det->user_id;
			  $result_cart_array[$cart_key]['price_id'] = $cart_det->price_id;
			  $result_cart_array[$cart_key]['size'] = ($cart_det->size)?$cart_det->size:'';
			  $result_cart_array[$cart_key]['color'] = ($cart_det->color)?$cart_det->color:'';
			  $result_cart_array[$cart_key]['color_code'] = ($cart_det->color)?$cart_det->productPrice->color->color_code:'';

			  $result_cart_array[$cart_key]['unit_price'] = $cart_det->unit_price;
			  $result_cart_array[$cart_key]['qty'] = $cart_det->qty;
			  $result_cart_array[$cart_key]['total_price'] = $cart_det->total_price;
				
			  $result_cart_array[$cart_key]['prd_name'] = $cart_det->productPrice->product->prd_name;
			  $result_cart_array[$cart_key]['prd_img'] = asset('public/product-photo/'.$cart_det->productPrice->product->prd_photo);
		  }
		  
		  return response()->json(['status' => 'success', 'cart_items' => $result_cart_array,'shipping_per' =>$shipping_per]);
	  }else{
		  return response()->json(['status' => 'error', 'message' => 'Provide valid user ID']);
	  }
  }
  
  //http://192.168.0.170/ronsafe/api/decrement-cart-qty?data={"cart_id":5}
  public function decrementCartQty(Request $request) {
	  $jsonData = json_decode($request->input('data'));
	  $cart_id = $jsonData->cart_id;
	  
	  if($cart_id != '' && $cart_id != null){
			$cart_det = TempCart::where('id', $cart_id)->first();
			//dd($cart_det);
			$qty = $cart_det->qty-1;
			$price = number_format($cart_det->unit_price*$qty,2,'.','');
			$update_cart = TempCart::where('id', $cart_id)->update(['qty'=>$qty,'total_price'=>$price]);
			
			return response()->json(['status' => 'success', 'message' => 'Qty updated successfully']);
		}else{
			return response()->json(['status' => "error",'message' => 'Invalid Cart ID']);
	   } 
  }
  
  
  //http://192.168.0.170/ronsafe/api/delete-item-from-cart?data={"del_cart_id":"111"}	 
  public function deleteCartItem(Request $request){
	  $jsonData = json_decode($request->input('data'));
	  $cart_id = $jsonData->del_cart_id;
	  $response = TempCart::where('id', '=', $cart_id)->delete();
	  //dd($response);

	  if($response){
		  echo '{"status":"success","message":"Item deleted successfully"}';exit;
	  }else{
		  echo '{"status":"error","message":"Invalid cart ID"}';exit;
	  }	
  }
	
  //http://192.168.0.170/ronsafe/api/place-user-order 
  public function placeUserOrder(Request $request){
  	$bodyData = $request->all();
    $user_id = $bodyData['user_id'];
    
    if ($bodyData['user_id'] == "" || $bodyData['full_name'] == "" || $bodyData['email'] == "" || $bodyData['contact_no'] == "" || $bodyData['address1'] == "" || $bodyData['city'] == "" || $bodyData['post_code'] == "" || $bodyData['country'] == "" ||  $bodyData['state'] == "") {
        echo '{"status":"error","message":"Provide all required data"}';exit;
    } else {
        
        $total_amount = TempCart::where('user_id', $user_id)->select('id', 'total_price')->sum('total_price');

		$payment_det = Helpers::getPaymentDetails();
		$shipping_info = ($total_amount*$payment_det->shipping_per)/100;
        $shipping_amount = number_format($shipping_info,'2','.',''); 
		
		$grand_total = $total_amount + $shipping_amount;
		
        $bodyData['user_id'] = $user_id;
        $bodyData['total_amount'] = $total_amount;
        $bodyData['shipping_amount'] = $shipping_amount;
        $bodyData['grand_total'] = $grand_total;

        //dd($bodyData);exit;

        $saveMasterAll = MasterOrder::create($bodyData);
        $orderID = $saveMasterAll->id;
		
        $cartDatas = TempCart::where('user_id', $user_id)->get();
        $allItemData = [];
        foreach ($cartDatas as $cartData) {
            $allItemData['order_id'] = $orderID;
            $allItemData['price_id'] = $cartData->price_id;
            $allItemData['size'] = $cartData->size;
            $allItemData['color'] = $cartData->color;
            $allItemData['unit_price'] = $cartData->unit_price;
            $allItemData['qty'] = $cartData->qty;
            $allItemData['total_price'] = $cartData->total_price;
            $saveCartItems = OrderItem::create($allItemData);
        }
        $deleteTempProduct = TempCart::where('user_id', $user_id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Order Placed successfully','order_id' =>$orderID]);
    }
  }


  //http://192.168.0.170/ronsafe/api/book-a-training 
  public function bookTraining(Request $request){
  	$bodyData = $request->all();
  	$user_id = $bodyData['user_id'];
  	$training_id = $bodyData['training_id'];
  	$training_price = $bodyData['training_price'];


  	if ($bodyData['user_id'] == "" || $bodyData['training_id'] == "" || $bodyData['training_price'] == "" || $bodyData['full_name'] == "" || $bodyData['contact_no'] == "" || $bodyData['email'] == "" || $bodyData['address1'] == "" || $bodyData['city'] == "" ||  $bodyData['post_code'] == "" ||  $bodyData['state'] == "" ||  $bodyData['country'] == "") {
        echo '{"status":"error","message":"Provide all required data"}';exit;
    } else {
    	//dd($bodyData);
    	$save_training_data = TrainingBooking::create($bodyData);
    	$bookingID = $save_training_data->id;
    	return response()->json(['status' => 'success', 'message' => 'Booking Placed successfully','booking_id' =>$bookingID]);
    }
  }






}
	
 
