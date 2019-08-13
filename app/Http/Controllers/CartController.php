<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\productPrice;
use App\Product;
use App\TempCart;
use App\UserRegistration;
use App\MasterOrder;
use App\OrderItem;
use Helpers;
use DB;
use Session;
use App\Mail\MailBuilder;
use Mail;
use Config;

class CartController extends Controller
{
	public function addToCart(Request $request) {
		//dd($request->all());
        $all_input = request()->except(['_token']);
        $session_id = session()->getId();
       
	    $qty = ($request->input('qty'))?trim($request->input('qty')):1;
        $price_id = $request->price_id;
		
        if ($qty == 0 || $price_id == "") {
            return redirect("products");
        }

		$prd_opt_price_dtls = productPrice::with(['size','color'])->where('id',$price_id)->first();
		$prd_id = $prd_opt_price_dtls->prd_id;
		$unit_price = $prd_opt_price_dtls->prd_price;

		if($prd_opt_price_dtls->size != null && $prd_opt_price_dtls->color != null){
			$size = $prd_opt_price_dtls->size->size;
			$color = $prd_opt_price_dtls->color->color;
			$all_input['size'] = $size;
			$all_input['color'] = $color;
		}

		//Total price is  calculated according to inputed quantity
		$total_price=$unit_price*$qty;
		
		//Here i have checked selected product exist in the cart or not
		$count = TempCart::where([['price_id', $price_id], ['session_id', $session_id]])->count();
		
		//fetching the selected product information from the cart table	
		$cart_info = TempCart::where([['price_id', $price_id], ['session_id', $session_id]])->get();
		
		if(count($cart_info)>0){
			$cart_total=$total_price+$cart_info[0]->total_price;
			$total_qty= $qty+$cart_info[0]->qty;
		}else{
			$cart_total=$total_price;
			$total_qty= $qty;
		}
		
		$user_id = Session::get('user_id');
		$all_input['user_id'] = $user_id;
        $all_input['session_id'] = $session_id;
		$all_input['price_id'] = $price_id;
        $all_input['qty'] = $total_qty;
		$all_input['unit_price'] = $unit_price;
        $all_input['total_price'] = $cart_total;

        if ($count == 0) {
            TempCart::create($all_input);
        } else {
            TempCart::where([['price_id', $price_id], ['session_id', $session_id]])->update(['qty'=>$total_qty, 'total_price'=>$cart_total]);
        }
        return redirect('cart');
    }
	
	public function viewCart() {
		return view('cart');
	}
	
	public function viewCheckout() {
		$session_id = session()->getId();
		if(Helpers::getCartTotalItems() == 0){
			return redirect('products');
		}
        $user_details = UserRegistration::where('id', session()->get('user_id'))->first();
        return view('checkout', compact('user_details'));
	}

	public function qntyInc(Request $request){
		if($request->input('cart_id') != '' && $request->input('cart_id') != null){
			$cart_det = TempCart::where('id', $request->input('cart_id'))->first();
			$qty = $cart_det->qty+1;
			$price = number_format($cart_det->unit_price*$qty,2,'.','');
			$update_cart = TempCart::where('id', $request->input('cart_id'))->update(['qty'=>$qty,'total_price'=>$price]);
			$tot_price = TempCart::where('session_id', $cart_det->session_id)->select('id', 'total_price')->sum('total_price');
			$tot_qty = TempCart::where('session_id', $cart_det->session_id)->select('id', 'qty')->sum('qty');
			
			
			$payment_det = Helpers::getPaymentDetails();
			$shipping_info = ($tot_price*$payment_det->shipping_per)/100;
            $shipping_cost = number_format($shipping_info,'2','.',''); 
			
			$grand_total = number_format($tot_price + $shipping_cost,'2','.','');
			
			
			return response()->json(['response' => 'success', 'qty' => $qty, 'total_price' => $price, 'tot_price' => $tot_price, 'shipping_cost' => $shipping_cost, 'grand_total' => $grand_total, 'tot_qty' => $tot_qty]);
		}else{
			return response()->json(['response' => "error"]);
		}
    }

    public function qntyDec(Request $request){
		if($request->input('cart_id') != '' && $request->input('cart_id') != null){
			$cart_det = TempCart::where('id', $request->input('cart_id'))->first();
			$qty = $cart_det->qty-1;
			$price = number_format($cart_det->unit_price*$qty,2,'.','');
			$update_cart = TempCart::where('id', $request->input('cart_id'))->update(['qty'=>$qty,'total_price'=>$price]);
			$tot_price = TempCart::where('session_id', $cart_det->session_id)->select('id', 'total_price')->sum('total_price');
			$tot_qty = TempCart::where('session_id', $cart_det->session_id)->select('id', 'qty')->sum('qty');
			
			
			$payment_det = Helpers::getPaymentDetails();
			$shipping_info = ($tot_price*$payment_det->shipping_per)/100;
            $shipping_cost = number_format($shipping_info,'2','.',''); 
			
			$grand_total = number_format($tot_price + $shipping_cost,'2','.','');
			
			
			return response()->json(['response' => 'success', 'qty' => $qty, 'total_price' => $price, 'tot_price' => $tot_price, 'shipping_cost' => $shipping_cost, 'grand_total' => $grand_total, 'tot_qty' => $tot_qty]);
		}else{
			return response()->json(['response' => "error"]);
		}
    }

    public function deleteItem(Request $request){
    	if($request->input('cart_id') != '' && $request->input('cart_id') != null){
    		$session_id = Session::getId();
    		TempCart::destroy($request->input('cart_id'));
			$tot_price = TempCart::where('session_id', $session_id)->select('id', 'total_price')->sum('total_price');
			$tot_qty = TempCart::where('session_id', $session_id)->select('id', 'qty')->sum('qty');
			
			
			
			$payment_det = Helpers::getPaymentDetails();
			$shipping_info = ($tot_price*$payment_det->shipping_per)/100;
            $shipping_cost = number_format($shipping_info,'2','.',''); 
			
			$grand_total = number_format($tot_price + $shipping_cost,'2','.','');
			
			
			return response()->json(['response' => 'success', 'tot_price' => $tot_price, 'shipping_cost' => $shipping_cost, 'grand_total' => $grand_total, 'tot_qty' => $tot_qty]);
		}else{
			return response()->json(['response' => "error"]);
		}
    }

    public function placeOrder(Request $request) {
        $session_id = session()->getId();
        $allInput = $request->all();
        $userCount = UserRegistration::where('email', '=', $request->email)->count();

        if ($request->full_name == "" || $request->email == "" || $request->contact_no == "" || $request->address1 == "" || $request->city == "" || $request->post_code == "" || $request->country == "" || $request->state == "") {
            return response()->json(['status' => 'blank', 'msg' => "Required fields are blank."]);
        } else if ($request->user_password == "" && session()->get('user_id') == "") {
            return response()->json(['status' => 'pass_blank', 'msg' => "Password fields are blank."]);
        } else if ($userCount > 0 && session()->get('user_id') == "") {
            return response()->json(['status' => 'email_exists', 'msg' => "Email already already exists."]);
        } else {
            if (session()->get('user_id') == "") {
                $user_password = bcrypt($request->user_password);
                $email = $request->email;
                $allInput['password'] = $user_password;

                $saveReg = UserRegistration::create($allInput);
                $user_id = $saveReg->id;

                session(['user_id' => $user_id]);
                session(['user_name' => $request->full_name]);

                //###################### User Registration mail goes to USER#################
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
            }
            $total_amount = TempCart::where('session_id', $session_id)->select('id', 'total_price')->sum('total_price');
           
           
			
			$payment_det = Helpers::getPaymentDetails();
			$shipping_info = ($total_amount*$payment_det->shipping_per)/100;
            $shipping_amount = number_format($shipping_info,'2','.',''); 
			
			$grand_total = $total_amount + $shipping_amount;
			
            $allInput['user_id'] = session()->get('user_id');
            $allInput['total_amount'] = $total_amount;
            $allInput['shipping_amount'] = $shipping_amount;
            $allInput['grand_total'] = $grand_total;
            $saveMasterAll = MasterOrder::create($allInput);
            $orderID = $saveMasterAll->id;
            session(['order_id' => $orderID]);
			
            $cartDatas = TempCart::where('session_id', $session_id)->get();
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
            $deleteTempProduct = TempCart::where('session_id', $session_id)->delete();
            return response()->json(['status' => 'success', 'msg' => "Ordered Successfully."]);
        }
    }

    public function viewPaypal(){
		$order_id = Session::get('order_id');
		$order_dtls = MasterOrder::where('id', $order_id)->first();
		//dd($order_dtls);
		if(Session::get('order_id')=='' || $order_dtls==NULL){
			return redirect('products');
		}
		
		
		$order_items = OrderItem::with('productPrice.size','productPrice.color','productPrice.product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
		//dd($order_items);
		
        return view('paypal', compact('order_items','order_dtls'));
    }
	
	
	public function updateTransactionDetails(){
        $fp = fopen("ipnresult1.txt", "w");
        foreach ($_POST as $key => $value) {
            fwrite($fp, $key . '====' . $value . "\n");
        }
		
        $order_id = $_POST['custom'];
        $txn_id = $_POST['txn_id'];
		
		/*$order_id = 1;
        $txn_id = "TRNS325423423OK";*/

        $update_trns_dtls = MasterOrder::where('id', $order_id)->update(['transaction_id' => $txn_id]);
		
		$order_dtls = MasterOrder::where('id', $order_id)->where('transaction_id', '!=','')->first();
		$user_name = $order_dtls->full_name;
		$user_email = $order_dtls->email;	
		
		
		$order_items = OrderItem::with('productPrice.size','productPrice.color','productPrice.product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
			
		//###################### RDER MAIL GOES TO ADMIN#################
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det->admin_name;
		$admin_email = $admin_det->alt_email;
		
		$current_year = date("Y");
		
		
		//Email Template Details
		$res_template_admin = DB::table('email_template')->where('id', '=', 10)->get();
		$input_admin = $res_template_admin[0]->contents;
		
		$body_admin = str_replace(array('%ADMINNAME%','%ORDERID%','%TRNSID%','%USERNAME%','%USEREMAIL%','%CURRENTYEAR%'), array($admin_name,$order_id,$txn_id,$user_name,$user_email, $current_year), $input_admin);
		//echo $body_admin;exit;
		$subject_admin = "Ronsafe :: New Order Placed";
		$content = [
			'from_email' => $user_email,
			'subject'=> $subject_admin,
			'body'=> $body_admin,
			'email_template' => 'emails.common_mail'
			];
		Mail::to($admin_email)->send(new MailBuilder($content));
		

		//###################### ORDER MAIL GOES TO USER#################
		$body1='<table width="100%" style=" background-color:#FFF;font-size: 12px!important; " cellpadding="0" cellspacing="0">
<tbody>
  <tr>
    <td align="left" style="padding:10px 10px 10px 10px; text-align:center; background:#dbe0fd; background-position:bottom;"><img src="https://www.bletechnolabs.com/projects/ronsafe/public/images/logo.png"/></td>
  </tr>
  
  <tr>
    <td style="background-color:#ffffff; padding:10px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td width="33%" height="30"  style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; font-weight: bold;">Order Information </td>
      
       <td width="33%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; font-weight: bold;">Shipping Address </td>
      
      <td width="33%" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; font-weight: bold;">Cobtact Information</td>
      
      </tr>
      
      <tr>
      <td height="30" style="font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;">Date :<span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;font-size: 12px;">'.date("jS M, Y",strtotime($order_dtls->created_at)).'</span></td>
	  
       <td><span style="font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-weight: normal;font-size: 12px;">'.$order_dtls->full_name.'</span></td>
	   
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">Contact No. : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">'.$order_dtls->contact_no.'</span></td>
      </tr>
      
      <tr>
      <td height="30" style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold;font-size: 12px;">Order ID : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">'.$order_dtls->id.'</span></td>
	  
      <td><span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;font-size: 12px;">'.$order_dtls->address1.' , '.$order_dtls->address2.'</span></td>
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold;font-size: 12px;">Email : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">'.$order_dtls->email.'</span>
      </td>
      </tr>
      
      <tr>
      <td height="30" style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">Transaction ID : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">'.$order_dtls->transaction_id.'</span></td>
	  
       <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">City : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal; font-size: 12px;">'.$order_dtls->city.'</span>
      
      &nbsp; &nbsp; Post Code : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal; font-size: 12px;">'.$order_dtls->post_code.'</span></td>
	  
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold;">&nbsp;</td>
      </tr>
      
      <tr>
      <td height="30" style="font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-weight: bold; font-size: 12px;">Item Total  :   <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">$  '.number_format($order_dtls->total_amount,'2','.','').'</span></td>
	  
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">State : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">'.$order_dtls->state.'</span>
      
      &nbsp; &nbsp; Country : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">'.$order_dtls->country.'</span>
      </td>
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">&nbsp;</td>
      </tr>
      
      
      <tr>
      <td height="30" style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">Shipping Price : <span style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;">$  '.number_format($order_dtls->shipping_amount,'2','.','').'</span></td>
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">&nbsp;</td>
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">&nbsp;</td>
      </tr>
      <tr>
      <td height="30" style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">Grand Total : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-weight: normal;">$  '.number_format($order_dtls->grand_total,'2','.','').'</span></td>
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">&nbsp;</td>
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold; font-size: 12px;">&nbsp;</td>
      </tr>
      <tr>
      <td height="30" style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold;">&nbsp;</td>
      <td>&nbsp;</td>
      <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold;">&nbsp;</td>
      </tr>
      
      
      
      
      
      
      <tr>
      <td height="30" style="font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-weight: bold;">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
      </table>
      
      
      
      
      
    
      <div style="line-height:22px; padding:0px 0px 30px 0px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0px solid #707A54;">
        <tr style="font-family: Verdana, Arial, Helvetica, sans-serif;  color:#000000; font-weight: bold;" bgcolor="#ffffff">
        <td width="32%" height="30" style="padding-left:10px; font-size: 12px;">Item Details</td>
        <td width="34%">&nbsp;</td>
        <td width="34%">&nbsp;</td>
        </tr>
        <tr>
        <td height="20" colspan="3"></td>
        </tr>';
        
        
        
        
       
		$site_url = Config::get('constants.site_url');
        foreach($order_items as $item_det){
			
			
        $body1 =$body1.'<tr><td valign="top" style="padding-left:10px; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;border-bottom: 1px solid #e6e6e6;">
        
        <img src="'.$site_url."public/product-photo/".$item_det->productPrice->product->prd_photo.'"  style=" font-size: 12px; height:80px; width:80px; margin:10px; padding:10px; border: 1px solid #eaeaea;"/>
        
        
        
        
        
        
        
        </td>
          <td style="padding-left:20px; padding-top:10px; padding-bottom:10px; font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal; line-height:20px; font-size: 12px; border-bottom: 1px solid #e6e6e6;" valign="top">';
		  
		 $body1 =$body1.'<strong>Product Name :</strong>'.$item_det->productPrice->product->prd_name."<br>";
		 
		  if($item_det->productPrice->size != null){
			  
         $body1 =$body1.'<strong>Size:</strong>'.$item_det->productPrice->size->size."<br>";
		   
		  }
         
		  if($item_det->productPrice->color != null){
			  
			  
          $body1 =$body1.'<span style="left: 10px;
    height: 22px;
    width: 22px;
    border: 1px solid #fff;
    border-radius: 50%;
    display: inline-block;
    font-size: 12px;
    position: relative;
    left: 0px;
    top: 5px; background:'.$item_det->productPrice->color->color_code.'"></span>';
		  
           $body1 =$body1.$item_det->productPrice->color->color ;
		   
		   
		  }
         
		  
		  
		 
		  
		 
		  
		  $body1 =$body1.'</td>
        <td style=" padding-left:20px; padding-top:10px; padding-bottom:10px; font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal; line-height:20px; font-size: 12px;border-bottom: 1px solid #e6e6e6; " valign="top">
        <strong>Product Name : </strong>'.$item_det->productPrice->product->prd_name.'<br>
        <strong>Unit Price : &nbsp; $</strong> '.number_format($item_det -> unit_price,2,'.','').'<br>
        <strong>Qty : &nbsp;</strong> '.$item_det -> qty.' <br>
        <strong>Total Price : &nbsp; $</strong> '.number_format($item_det -> total_price,2,'.','').'
        </td>
        </tr>
        ';
        
        //$body3 = $body3.$body2;
        }
        $body1 =$body1.'<tr>
        <td colspan="3" align="right" style="padding-right:30px;"></td>
        </tr>
        
        <tr>
        <td height="1" colspan="3" align="right">
            <table width="50%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </td>
        </tr>
        
        <tr style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: bold;">
        <td height="10">&nbsp;</td>
        <td style="font-family: Verdana, Arial, Helvetica, sans-serif;  color: #000000; font-weight: normal;"></td>
        <td style="font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-weight: normal;"></td>
        </tr>
        </table>
      </div>';
    
    
      $body1 =$body1.'<div style="padding:10px 0px 10px 0px;  line-height:22px; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;">
      <strong>Thank you,</strong><br />
      <span style="color:#000; font-size: 12px;">'.$admin_name.'</span><br />
      <span><a href="mailto:'.$admin_email.'" style="color:#000; text-decoration:none;">'.$admin_email.'</a></span><br />
      </div>
    
    </td>
  </tr>
  
  <tr>
   <td style="text-align:center; color:#000; background-color:#dbe0fd; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;" height="30">
    All rights &copy; ronsafett.com.  '.date("Y").'
  </td>
  </tr>
</tbody>
</table>';

	    //echo $body1;exit;
		
		$subject_user ="Ronsafe :: Thank You for your order";
		
		$headers_user  = 'MIME-Version: 1.0' . "\n";
		$headers_user .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers_user .= "From:".$admin_email."\n";
		//Mail for user
	    mail($user_email,$subject_user,$body1,$headers_user);
		
        session()->forget('order_id');
		return view('order-thank-you');

	}
	
	
	
	public function viewOrderThankYou(){
		return view('order-thank-you');
	}
	
}
