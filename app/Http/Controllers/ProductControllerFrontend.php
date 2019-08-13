<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Product;
use App\Category;
use App\ProductOptionalImage;

class ProductControllerFrontend extends Controller
{
    
	public function viewProducts(){
		$lp_cat = Category::all()->sortByDesc("id");
		$prd_data = Product::orderBy('id', 'DESC')->get();
		//dd($prd_data);
		return view('products',compact('prd_data','lp_cat'));
	}
	
	public function viewProductDetails($prd_id){
		if ($prd_id) {
			//$prd_dtls = Product::with(['productOptionalImages','productPrice.size','productPrice.color'])->where('id', $prd_id)->first();
			$prd_dtls = Product::with(array(
					'productOptionalImages'=>function($query1){
						$query1->select('prd_id','opt_images');
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
				
        }
		//dd($prd_dtls);
		$pcs_dtls = $prd_dtls->productPrice;
		//dd($pcs_dtls);
		
		/*$price_ary = [];
		$size_ary = [];
		$color_ary = [];
		foreach($pcs_dtls as $val){
			$price_ary[$val->id] = $val->prd_price;
			$size_ary[$val->size->id] = $val->size->size;
			$color_ary[$val->color->id] = $val->color->color;
		}
		asort($price_ary);
		$prd_cs_price_ary = array_slice($price_ary, 0, 1, true);
		$prd_cs_id = key($prd_cs_price_ary);
		$prd_cs_price = $prd_cs_price_ary[$prd_cs_id];
		$min_price = min($price_ary);*/
		
		$similar_prd_data = Product::where([['id','!=',$prd_id],['prd_cat_id',$prd_dtls->prd_cat_id]])->orderBy('id', 'DESC')->limit(10)->get();
		//dd($similar_prd_data);
        return view('product-details', compact('prd_dtls','similar_prd_data'));
	}
	
}

