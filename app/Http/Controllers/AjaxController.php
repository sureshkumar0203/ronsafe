<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductPrice;
use App\ProductOptionalImage;


class AjaxController extends Controller {
	public function deletePpdRecord(Request $request)
	{
		$ppd_id = $request->input('ppd_id');
		ProductPrice::where('id',$ppd_id)->delete();
		return 'success';
	}
	
    public function delOptImages(Request $request) {
        $getMulImage = ProductOptionalImage::where('id', $request->id)->first();
        if (!empty($getMulImage)) {
            $prodMulImage = public_path('product-photo/' . $getMulImage->opt_images);
            if (file_exists($prodMulImage)) {
                unlink($prodMulImage);
            }
        }
        $delMulImg = ProductOptionalImage::destroy($request->id);
        if ($delMulImg) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

}
