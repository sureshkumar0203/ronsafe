<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Color;
use App\Size;
use App\ProductOptionalImage;
use App\ProductPrice;

use Illuminate\Http\Request;
use Image;

//custom user login middle ware
use App\Http\Middleware\checkAdminLogin;

class ProductController extends Controller
{
	public function __construct(){
         $this->middleware(checkAdminLogin::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prd_data = Product::with(['category:id,cat_name'])->orderBy('id', "DESC")->get();
		//dd($prd_data);
        return view('admin.product.index', compact('prd_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_input = $request->all();
        //dd($all_input);
        $this->validate($request, [
            'prd_cat_id' => 'required',
            'prd_name' => 'required',
			'prd_photo' => 'required|mimes:jpeg,bmp,png,jpg',
			//'opt_images' => 'nullable|mimes:jpeg,bmp,png,jpg',
            'prd_details' => 'required',
            'prd_meta_title' => 'required',
        ]);

        $prd_count = Product::where([['prd_name','=',$request->prd_name],['prd_cat_id','=',$request->prd_cat_id]])->count();

        if ($prd_count == 0) {
			######## Product Image upload section #############
            if($request->hasFile('prd_photo')) {
				$filename = 'P_'.rand(11111, 99999).'.'.$request->file('prd_photo')->getClientOriginalExtension();
                $image_resize = Image::make($request->file('prd_photo')->getRealPath())->resize(500, 500);
                $image_resize->save(public_path('product-photo/' . $filename));
                $all_input['prd_photo'] = $filename;
            }
			
			################ Save Product information  ###############
            $all_input['prd_slug'] = str_slug($request->prd_name, '-');
			$all_input['prd_cs_opt'] = $request->cs;
			
            $save_product_data = Product::create($all_input);

            ###################### Save multiple image ################
            if ($save_product_data) {
                if ($request->hasFile('opt_images')) {
                    $prod_images = $request->file('opt_images');
                    foreach ($prod_images as $prod_image) {
						$prod_filename = 'OPT_'.rand(11111, 99999).time().'.'.$prod_image->getClientOriginalExtension();
                        $prod_image_resize = Image::make($prod_image->getRealPath())->resize(500, 500);
                        $prod_image_resize->save(public_path('product-photo/' . $prod_filename));
                        $all_input['opt_images'] = $prod_filename;
                        $all_input['prd_id'] = $save_product_data->id;
                        $saveProductImage = ProductOptionalImage::create($all_input);
                    }
                }
            }
			
			if($request->cs == 1){
			  ######## Save Product size,color,price details record ##########
			  $prd_price_row_count = $request->input('prd_price_row_count');
			  for($s = 1;$s<=$prd_price_row_count; $s++){
			  $col="color_id".$s;
			  $color_id = $request->input($col);
			  
			  $siz="size_id".$s;
			  $size_id = $request->input($siz);
			  
			  $pri="prd_price".$s;
			  $prd_price = $request->input($pri);
			  
			  
			  $ppd_count = ProductPrice::where([['prd_id','=',$request->prd_id],['size_id','=',$request->size_id],['color_id','=',$request->color_id]])->count();
			   
			  if($ppd_count ==0 && $color_id!='' && $size_id!='' && $prd_price!=''){
				  $all_input['prd_id'] = $save_product_data->id;
				  $all_input['size_id'] = $size_id;
				  $all_input['color_id'] = $color_id;
				  $all_input['prd_price'] = $prd_price;
				  ProductPrice::create($all_input);
			  }
			}
		    }else{
				 $all_input['prd_id'] = $save_product_data->id;
				 $all_input['prd_price'] = $request->prd_price1;
				  ProductPrice::create($all_input);
			}
			
			
			return redirect('administrator/manage-products/create')->with('success', 'Saved successfully.');	
        } else {
            return redirect('administrator/manage-products/create')->with('error', 'This product exist in selected category.');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {
        if(Product::find($id)!=null){
			$prd_data = Product::where('id', $id)->with('productOptionalImages')->first();
            return view('admin.product.edit', compact('prd_data'));
        }else{
            return redirect('administrator/manage-products');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {
		$all_input = $request->all();
		$all_input_prd = [];
		
        $this->validate($request, [
            'prd_cat_id' => 'required',
            'prd_name' => 'required',
            'prd_details' => 'required',
            'prd_meta_title' => 'required',
        ]);
		
        $prd_count = Product::where([['prd_name','=',$request->prd_name],['prd_cat_id','=',$request->prd_cat_id],['id','!=',$id]])->count();
		//dd($prd_count);
		
        if ($prd_count ==0) {
			$prd_data = Product::where('id',$id)->first();
			######## Product Image upload section #############
			if ($request->hasFile('prd_photo')) {
			  if (!empty($prd_data->prd_photo)) {
				  $prd_path= public_path('product-photo/' . $prd_data->prd_photo);
				  if (file_exists($prd_path)) {
					  unlink($prd_path);
				  }
			  }
			  
			  $filename = 'P_'.rand(11111, 99999).'.'.$request->file('prd_photo')->getClientOriginalExtension();
			  $image_resize = Image::make($request->file('prd_photo')->getRealPath())->resize(500, 500);
			  $image_resize->save(public_path('product-photo/' . $filename));
			  $all_input_prd['prd_photo'] = $filename;
			} else {
				$all_input_prd['prd_photo'] = $prd_data->prd_photo;
			}
			
			
			######## Update product other information  ###########
            $all_input_prd['prd_slug'] = str_slug($request->prd_name, '-');
			$all_input_prd['prd_cat_id'] = $request->prd_cat_id;
			$all_input_prd['prd_name'] = $request->prd_name;
			$all_input_prd['prd_details'] = $request->prd_details;
			$all_input_prd['prd_meta_title'] = $request->prd_meta_title;
			$all_input_prd['prd_meta_keyword'] = $request->prd_meta_keyword;
			$all_input_prd['prd_meta_description'] = $request->prd_meta_description;
			$all_input_prd['prd_cs_opt'] = $request->cs;
			//dd($all_input_prd);
			$update_prd_dtls = Product::where('id', $id)->update($all_input_prd);
			
			
            ######## Multiple Image upload section #############
			if ($request->hasFile('opt_images')) {
				$prod_images = $request->file('opt_images');
				foreach ($prod_images as $prod_image) {
					$prod_filename = 'OPT_'.rand(11111, 99999).time().'.'.$prod_image->getClientOriginalExtension();
					$prod_image_resize = Image::make($prod_image->getRealPath())->resize(500, 500);
					$prod_image_resize->save(public_path('product-photo/' . $prod_filename));
					$all_input['opt_images'] = $prod_filename;
					$all_input['prd_id'] = $prd_data->id;
					$saveProductImage = ProductOptionalImage::create($all_input);
				}
			}
           
			
			######## Product Price details stored here ##########
			$prd_price_row_count = $request->input('prd_price_row_count');
			
			for($s = 1;$s<=$prd_price_row_count; $s++){
				
				$dbr="db_record".$s;
				$dbr_ppd_id = $request->input($dbr);
				
				$col="color_id".$s;
				$color_id = $request->input($col);
				
				$siz="size_id".$s;
				$size_id = $request->input($siz);
				
				$pri="prd_price".$s;
				$prd_price = $request->input($pri);
				
				
				if($dbr_ppd_id!=''){
					$ppd_count = ProductPrice::where([['id','<>',$dbr_ppd_id],['prd_id','=',$id],['size_id','=',$size_id],['color_id','=',$color_id]])->count();
					if($ppd_count==0){
						$pp_data = ['color_id'=>$color_id,'size_id'=>$size_id,'prd_price'=>$prd_price];
						$update_prd_dtls = ProductPrice::where('id', $dbr_ppd_id)->update($pp_data);
					}
				}else{
					$ppd_count_ins = ProductPrice::where([['prd_id','=',$id],['size_id','=',$size_id],['color_id','=',$color_id]])->count();
					if($ppd_count_ins ==0 && $color_id!='' && $size_id!='' && $prd_price!=''){
						$pp_data = ['prd_id'=>$id,'color_id'=>$color_id,'size_id'=>$size_id,'prd_price'=>$prd_price];
						ProductPrice::create($pp_data);
					}
				}
			}
			
			
			return redirect('administrator/manage-products/'.$id.'/edit')->with('success', 'Record updated successfully.');
        } else {
			return redirect('administrator/manage-products/'.$id.'/edit')->with('error', 'This record exist.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id)
    {
		$prd_data = Product::find($id);
        if (!empty($prd_data->prd_photo)) {
            $prd_path = public_path('product-photo/' . $prd_data->prd_photo);
            if (file_exists($prd_path)) {
                unlink($prd_path);
            }
        }
		
        $opt_images = ProductOptionalImage::where('prd_id', $prd_data->id)->get();
        if ($opt_images) {
            foreach ($opt_images as $opt_image) {
                if (!empty($opt_image->opt_images)) {
                    $opt_img_path = public_path('product-photo/' . $opt_image->opt_images);
                    if (file_exists($opt_img_path)) {
                        unlink($opt_img_path);
                    }
                }
                ProductOptionalImage::destroy($opt_image->id);
            }
        }
		ProductPrice::where('prd_id',$prd_data->id)->delete();
		Product::destroy($prd_data->id);
		
		return redirect('administrator/manage-products')->with('success', 'Record deleted successfully');
    }
	
}
