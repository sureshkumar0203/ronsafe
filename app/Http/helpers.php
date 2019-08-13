<?php
use App\Category;
use App\Color;
use App\Size;
use App\MembershipAffiliation;
use App\Admin;
use App\UserRegistration;


use App\ProductPrice;
use App\PaymentSetting;
use App\TempCart;
use \App\SeoPageSetting;

class Helpers {
	public static function getAdminDetails(){
		$admin_info = Admin::first();
		return $admin_info;
	}
	
	public static function categoryList(){
		$cat_data = Category::orderBy('cat_name', "ASC")->pluck('cat_name', 'id');
		return $cat_data;
	}
	
	public static function sizeList(){
		$size_data = Size::orderBy('size', "ASC")->pluck('size', 'id');
		return $size_data;
	}
	
	public static function colorList(){
		$color_data = Color::orderBy('color', "ASC")->pluck('color', 'id');
		return $color_data;
	}

	public static function productPriceList($prdid){
		$pp_data = ProductPrice::where('prd_id', $prdid)->get();
		return $pp_data;
	}
	
	public static function maList(){
		$ma_data  = MembershipAffiliation::orderBy('id', 'DESC')->get();
		return $ma_data;
	}
	
	public static function getPaymentDetails() {
		$payment_det  = PaymentSetting::where('id', '>', 0)->first();
		return $payment_det;
    }
	
	public static function createRandomPassword(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789ABCDEWFGHJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;		
		while ($i <= 6){
			$num = rand() % 70;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		 }
		return $pass;
	}
	
	public static function randomPassword($len = 8) {
	  //enforce min length 8
	  if($len < 8)
		  $len = 8;
  
	  //define character libraries - remove ambiguous characters like iIl|1 0oO
	  $sets = array();
	  $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
	  $sets[] = 'abcdefghjkmnpqrstuvwxyz';
	  $sets[] = '23456789';
	  $sets[]  = '!@#$%^&*(){}[]/?';
  
	  $password = '';
	  
	  //append a character from each set - gets first 4 characters
	  foreach ($sets as $set) {
		  $password .= $set[array_rand(str_split($set))];
	  }
  
	  //use all characters to fill up to $len
	  while(strlen($password) < $len) {
		  //get a random set
		  $randomSet = $sets[array_rand($sets)];
		  
		  //add a random char from the random set
		  $password .= $randomSet[array_rand(str_split($randomSet))]; 
	  }
	  
	  //shuffle the password string before returning!
	  return str_shuffle($password);
	}
	
	public static function getTemplateDetails($template_id) {
		$templ_det = DB::table('email_template')->where('id', '=', $template_id)->first();
		return $templ_det;
    }
	
	public static function getUserDetails() {
		$user_data = UserRegistration::where('id', session()->get('user_id'))->first();
		return $user_data;
    }
	
	public static function minMaxPriceRange(){
		$min_price = ProductPrice::min('prd_price');
		$max_price = ProductPrice::max('prd_price');
		$result = array('min_price'=>$min_price,'max_price'=>$max_price);
		return $result;
	}
	
	public static function eachProductsMinMaxPrice($prd_id){
		$min_price_rec = ProductPrice::where('prd_id',$prd_id)->orderBy('prd_price','ASC')->take('1')->get();
		$max_price_rec = ProductPrice::where('prd_id',$prd_id)->orderBy('prd_price','DESC')->take('1')->get();
		$result = array('min_price_rec'=>$min_price_rec,'max_price_rec'=>$max_price_rec);
		
		return $result;
	}
	
	
	public static function getColorSizeDetails($prd_cs_id) {
		$prd_price_data = ProductPrice::where('id', $prd_cs_id)->first();
		return $prd_price_data;
    }
	
	public static function getCartTotalItems() {
		$session_id = Session::getId();
		$total_cart_items_top = TempCart::where('session_id',$session_id)->sum('qty');
		//dd($total_cart_items_top);
		return $total_cart_items_top;
	}
	
	public static function commonCartInformation() {
		$session_id = Session::getId();
	 	$cart_temp_det = TempCart::with('productPrice.size','productPrice.color','productPrice.product')->where('session_id', $session_id)->orderBy('id', 'DESC')->get();	
	 	$item_total = TempCart::where('session_id', $session_id)->sum('total_price');
		 
		

		$item_total = number_format($item_total,2,'.','');
		
		/*$order_below = 50;
		$db_shipping_cost = 10;
		
		if($item_total >= $order_below){
			$shipping_cost = "Free";
			$grand_total = number_format($item_total,2,'.','');
		}else{
			$shipping_cost = number_format($db_shipping_cost,2,'.','');
			$grand_total_temp = $item_total+$db_shipping_cost;
			$grand_total = number_format($grand_total_temp,2,'.','');
			
		}*/
		
		$payment_det = Helpers::getPaymentDetails();
		$shipping_info = ($item_total*$payment_det->shipping_per)/100;
		$shipping_cost = number_format($shipping_info,'2','.',''); 
		
		$grand_total = $item_total + $shipping_cost;
			
		
	   $data_array = array();
	   array_push($data_array,$cart_temp_det,$item_total,$shipping_cost,$grand_total);
	   return $data_array;
    }
	
	public static function getSeoInfo($id) {
	  return SeoPageSetting::where('id', $id)->first();
	}

}

?>